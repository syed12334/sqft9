<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {
    protected $data;
      public function __construct() {
        date_default_timezone_set("Asia/Kolkata");
        parent::__construct();
        $this->load->helper('utility_helper');
        $this->load->model('master_db');   
        $this->load->model('home_db'); 
        $this->data['detail']="";
        $this->data['session'] = ADMIN_SESSION; 
        if (!$this->session->userdata($this->data['session'])) {
            redirect('Login', 'refresh');
        }else{
                $sessionval = $this->session->userdata($this->data['session']);
                $details = $this->home_db->getlogin($sessionval['name']);
                if(count($details)){
                    $this->data['detail']=$details;
                }else{
                    $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">&times;</button>Invalid Credentials.</div>');
                    redirect(base_url()."login/logout");
                }
        } 
        $this->data['header']=$this->load->view('includes/header', $this->data , TRUE);
        $this->data['footer']=$this->load->view('includes/footer', $this->data , TRUE);
  }
	public function index() {
		$this->load->view('index',$this->data);
	}
  /* Subscription  */
    public function subscription() {
        $this->load->view('subscription-list',$this->data);
    }
    public function getSubscriptionlist() {
         $where = "where status !=2";
            if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
                $where .= " and (title like '%$val%') ";
                $where .= " or (pprice like '%$val%') ";
                $where .= " or (nmonths like '%$val%') ";
                $where .= " or (nproperties like '%$val%') ";
                $where .= " or (npictures like '%$val%') ";
            }
            $order_by_arr[] = "title";
            $order_by_arr[] = "";
            $order_by_arr[] = "id";
            $order_by_def   = " order by id desc";
            $query = "select * from packages ".$where."";           
            $fetchdata = $this->home_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
            //echo $this->db->last_query();exit;
            $data = array();
            $i = $_POST["start"]+1;
            foreach ($fetchdata as $r) {
                $action ="";
                $sub_array = array();
                 $action .= '<a href='.base_url()."master/editpackage/".sqftEncrypt($r->id)."".' class="btns1" title="Edit Details"><i class="fas fa-pencil-alt"></i></a>&nbsp;';
                  $status='';$type = "";

                  if($r->type ==1) {
                    $type ="Rent";
                  }
                  else if($r->type==2) {
                    $type ="Sale";
                  }
                   else if($r->type==3) {
                    $type ="Buy";
                  }
                   if( (int)$r->status == 0 ){
                $status = "<span class='text-success'><i class='fas fa-check'></i> Active</span>";
                $action .= "<button title='Deactive' class='btns' onclick='updateStatus(".$r->id.", -1)' ><i class='fas fa-times-circle'></i></button>&nbsp;";
            }else{
                $status = "<span class='text-warning'><i class='fas fa-times-circle'></i> In-Active</span>";
                $action .= "<button title='Activate' class='btns' onclick='updateStatus(".$r->id.", 0)' ><i class='fas fa-check'></i></button>&nbsp;";
            }
             $action .= "<button title='Delete' class='btns' onclick='updateStatus(".$r->id.", 2)' ><i class='fas fa-trash'></i></button>&nbsp;";
             $sub_array[] = $i++;
             $sub_array[] = $action;
             $sub_array[] = $type;
             $sub_array[] = $r->title;
             $sub_array[] = $r->pprice;
             $sub_array[] = $r->nmonths;
             $sub_array[] = $r->nproperties;
             $sub_array[] = $r->npictures;
              $data[] = $sub_array;
            }

            $res    = $this->home_db->run_manual_query_result($query);
        $total  = count($res);
        $output = array(
            "draw"              =>  intval($_POST["draw"]),
             "recordsTotal"          => $total,  
                "recordsFiltered"     => $total,  
            "data"              =>  $data
        );
        $output['csrf_token'] = $this->security->get_csrf_hash();
        echo json_encode($output);
    }

  public function addsubscription() {
    $this->load->view('add-subcription',$this->data);
  }
  public function register() {
    //echo "<pre>";print_r($_POST);exit;
     $type = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('type', true))));
     $title = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('title', true))));
     $price = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('price', true))));
     $vmonths = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('vmonths', true))));
     $noftype = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('noftype', true))));
     $noofpics = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('noofpics', true))));
     $id = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('id', true))));
     if(!empty($id)) {
        $db['type'] = $type;
        $db['title'] = $title;
        $db['pprice'] = $price;
        $db['nmonths'] = $vmonths;
        $db['nproperties'] = $noftype;
        $db['npictures'] = $noofpics;
        $db['modified_date'] = date('Y-m-d H:i:s');
        $update = $this->master_db->updateRecord('packages',$db,['id'=>$id]);
          if($update) {
          $results = ['status'=>true,'msg'=>'Updated successfully'];
          $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Updated successfully</div>');
           echo json_encode($results);
        }else {
          $results = ['status'=>false,'msg'=>'Error in updating '];
           echo json_encode($results);
        }
     }else {
        if(!empty($type) && !empty($title) && !empty($price) && !empty($vmonths) && !empty($noftype)) {
            $db['type'] = $type;
            $db['title'] = $title;
            $db['pprice'] = $price;
            $db['nmonths'] = $vmonths;
            $db['nproperties'] = $noftype;
            $db['npictures'] = $noofpics;
           
            $db['status'] = 0;
            $db['created_date'] = date('Y-m-d H:i:s');
            $in = $this->master_db->insertRecord('packages',$db);
            if($in) {
              $result = ['status'=>true,'msg'=>'Inserted successfully'];
              echo json_encode($result);
              $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Inserted successfully</div>');
            }else {
              $result = ['status'=>false,'msg'=>'Error in inserting '];
            }
       }else {
          $result = ['status'=>false,'msg'=>'Required fields are missing'];
          echo json_encode($result);
       }
     }
  }

    public function setSubscribeStatus() {
    $id = trim($this->input->post('id'));
        //echo "<pre>";print_r($_POST);exit;

        $status = trim($this->input->post('status'));
        if($status ==2) {
                $this->master_db->deleterecord('packages',['id'=>$id]);
                
               echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }else if($status ==-1){
            $where_data = array(
            'status'=>$status,
            'modified_date'=>date('Y-m-d H:i:s'),
            
        );
        $this->master_db->updateRecord('packages',$where_data,array('id'=>$id));
        echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }else  if($status ==0){
             $where_data = array(
            'status'=>$status,
            'modified_date'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('packages',$where_data,array('id'=>$id));
        echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }

  }
  public function editpackage() {
    $id =  sqftDcrypt($this->uri->segment(3));
    //echo $id;exit;
    $getPackage = $this->master_db->getRecords('packages',['id'=>$id],'*');
    //echo $this->db->last_query();exit;
    $this->data['package'] = $getPackage;
    $this->load->view('add-subcription',$this->data);
  }
    /* Property Category  */
  public function propertycategory() {
    $this->load->view('propertycategory',$this->data);
  }
  public function propertyaddcategory() {
    $this->load->view('addpropertycategory',$this->data);
  }
  public function addcategorysave() {
    //echo "<pre>";print_r($_POST);exit;
     $title = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('title', true))));
     $id = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('id', true))));
     if(!empty($id)) {
        $db['name'] = $title;       
        $db['modified_date'] = date('Y-m-d H:i:s');
        $update = $this->master_db->updateRecord('property_category',$db,['id'=>$id]);
          if($update) {
          $results = ['status'=>true,'msg'=>'Updated successfully','csrf_token'=>$this->security->get_csrf_hash()];
          $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Updated successfully</div>');
           echo json_encode($results);
        }else {
          $results = ['status'=>false,'msg'=>'Error in updating ','csrf_token'=>$this->security->get_csrf_hash()];
           echo json_encode($results);
        }
     }else {
        if(!empty($title)) {
            $db['name'] = $title;
            $db['status'] = 0;
            $db['created_at'] = date('Y-m-d H:i:s');
            $in = $this->master_db->insertRecord('property_category',$db);
            if($in) {
              $result = ['status'=>true,'msg'=>'Inserted successfully','csrf_token'=>$this->security->get_csrf_hash()];
              echo json_encode($result);
              $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Inserted successfully</div>');
            }else {
              $result = ['status'=>false,'msg'=>'Error in inserting ','csrf_token'=>$this->security->get_csrf_hash()];
            }
       }else {
          $result = ['status'=>false,'msg'=>'Required fields are missing','csrf_token'=>$this->security->get_csrf_hash()];
          echo json_encode($result);
       }
     }
  }
  public function getPropertycategory() {
         $where = "where status !=2";
            if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
                $where .= " and (name like '%$val%') ";
            }
            $order_by_arr[] = "name";
            $order_by_arr[] = "";
            $order_by_arr[] = "id";
            $order_by_def   = " order by id desc";
            $query = "select * from property_category ".$where."";           
            $fetchdata = $this->home_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
            //echo $this->db->last_query();exit;
            $data = array();
            $i = $_POST["start"]+1;
            foreach ($fetchdata as $r) {
                $action ="";
                $sub_array = array();
                 $action .= '<a href='.base_url()."master/editpropertycategory?id=".sqftEncrypt($r->id)."".' class="btns1" title="Edit Details"><i class="fas fa-pencil-alt"></i></a>&nbsp;';
                  $status='';$type = "";
                   if( (int)$r->status == 0 ){
                $status = "<span class='text-success'><i class='fas fa-check'></i> Active</span>";
                $action .= "<button title='Deactive' class='btns' onclick='updateStatus(".$r->id.", -1)' ><i class='fas fa-times-circle'></i></button>&nbsp;";
            }else{
                $status = "<span class='text-warning'><i class='fas fa-times-circle'></i> In-Active</span>";
                $action .= "<button title='Activate' class='btns' onclick='updateStatus(".$r->id.", 0)' ><i class='fas fa-check'></i></button>&nbsp;";
            }
             $action .= "<button title='Delete' class='btns' onclick='updateStatus(".$r->id.", 2)' ><i class='fas fa-trash'></i></button>&nbsp;";
             // $action .= "<button title='View Detail' class='btns' onClick='popUp()'><i class='fas fa-eye' ></i></button>&nbsp;";
             $sub_array[] = $i++;
             $sub_array[] = $action;
             $sub_array[] = $r->name;
             $sub_array[] = date('d-m-Y',strtotime($r->created_at));
              $data[] = $sub_array;
            }
            $res    = $this->home_db->run_manual_query_result($query);
            $total  = count($res);
            $output = array(
              "draw"              =>  intval($_POST["draw"]),
              "recordsTotal"          => $total,  
              "recordsFiltered"     => $total,  
              "data"              =>  $data
            );
            $output['csrf_token'] = $this->security->get_csrf_hash();
        echo json_encode($output);
    }
    public function editpropertycategory() {
        $this->load->library('encrypt');
        $id =  sqftDcrypt($_GET['id']);
        //echo $id;exit;
        $getPackage = $this->master_db->getRecords('property_category',['id'=>$id],'*');
        //echo $this->db->last_query();exit;
        $this->data['property'] = $getPackage;
        $this->load->view('addpropertycategory',$this->data);
    }
    public function setpropertycategoryStatus() {
      $id = trim($this->input->post('id'));
        //echo "<pre>";print_r($_POST);exit;
        $status = trim($this->input->post('status'));
        if($status ==2) {
            $this->master_db->deleterecord('property_category',['id'=>$id]);
             echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }else if($status ==-1){
            $where_data = array(
            'status'=>$status,
            'modified_date'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('property_category',$where_data,array('id'=>$id));
          echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }else  if($status ==0){
             $where_data = array(
            'status'=>$status,
            'modified_date'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('property_category',$where_data,array('id'=>$id));
        echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }
  }
  /* Amenities */
    public function propertyamenity() {

    $this->load->view('propertyamenity',$this->data);
  }
  public function propertyaddamenity() {
    $this->data['category'] = $this->master_db->getRecords('property_category',['status !='=>-1],'id,name');
    $this->load->view('addpropertyamenity',$this->data);
  }
  public function addamenitysave() {
    //echo "<pre>";print_r($_POST);exit;
     $title = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('title', true))));
     $type = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('type', true))));
     $id = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('id', true))));
     if(!empty($id)) {
         $db['title'] = $title;
        $db['ptype'] = $type;       
        $db['modified_date'] = date('Y-m-d H:i:s');
        $update = $this->master_db->updateRecord('amenities',$db,['id'=>$id]);
          if($update) {
          $results = ['status'=>true,'msg'=>'Updated successfully'];
          $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Updated successfully</div>');
           echo json_encode($results);
        }else {
          $results = ['status'=>false,'msg'=>'Error in updating '];
           echo json_encode($results);
        }
     }else {
        if(!empty($title)) {
            $db['title'] = $title;
            $db['ptype'] = $type;
            $db['status'] = 0;
            $db['created_at'] = date('Y-m-d H:i:s');
            $in = $this->master_db->insertRecord('amenities',$db);
            if($in) {
              $result = ['status'=>true,'msg'=>'Inserted successfully'];
              echo json_encode($result);
              $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Inserted successfully</div>');
            }else {
              $result = ['status'=>false,'msg'=>'Error in inserting '];
            }
       }else {
          $result = ['status'=>false,'msg'=>'Required fields are missing'];
          echo json_encode($result);
       }
     }
  }
  public function getPropertyamenity() {
         $where = "where a.status !=2";
            if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
                $where .= " and (a.title like '%$val%') ";
                $where .= " or (pc.name like '%$val%') ";
                $where .= " or (a.created_at like '%$val%') ";
            }
            $order_by_arr[] = "a.title";
            $order_by_arr[] = "";
            $order_by_arr[] = "a.id";
            $order_by_def   = " order by a.id desc";
            $query = "select a.title,a.id,pc.name,a.created_at,a.status from amenities a left join property_category pc on pc.id = a.ptype ".$where."";           
            $fetchdata = $this->home_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
            //echo $this->db->last_query();exit;
            $data = array();
            $i = $_POST["start"]+1;
            foreach ($fetchdata as $r) {
                $action ="";
                $sub_array = array();
                 $action .= '<a href='.base_url()."master/editpropertyamenity?id=".sqftEncrypt($r->id)."".' class="btns1" title="Edit Details"><i class="fas fa-pencil-alt"></i></a>&nbsp;';
                  $status='';$type = "";
                   if( (int)$r->status == 0 ){
                $status = "<span class='text-success'><i class='fas fa-check'></i> Active</span>";
                $action .= "<button title='Deactive' class='btns' onclick='updateStatus(".$r->id.", -1)' ><i class='fas fa-times-circle'></i></button>&nbsp;";
            }else{
                $status = "<span class='text-warning'><i class='fas fa-times-circle'></i> In-Active</span>";
                $action .= "<button title='Activate' class='btns' onclick='updateStatus(".$r->id.", 0)' ><i class='fas fa-check'></i></button>&nbsp;";
            }
             $action .= "<button title='Delete' class='btns' onclick='updateStatus(".$r->id.", 2)' ><i class='fas fa-trash'></i></button>&nbsp;";
             $sub_array[] = $i++;
             $sub_array[] = $action;
             $sub_array[] = $r->name;
             $sub_array[] = $r->title;
             $sub_array[] = date('d-m-Y',strtotime($r->created_at));
              $data[] = $sub_array;
            }
            $res    = $this->home_db->run_manual_query_result($query);
            $total  = count($res);
            $output = array(
              "draw"              =>  intval($_POST["draw"]),
              "recordsTotal"          => $total,  
              "recordsFiltered"     => $total,  
              "data"              =>  $data
            );
            $output['csrf_token'] = $this->security->get_csrf_hash();
        echo json_encode($output);
    }
    public function editpropertyamenity() {
        $id =  sqftDcrypt($_GET['id']);
        $this->data['category'] = $this->master_db->getRecords('property_category',['status !='=>-1],'id,name');
        //echo $id;exit;
        $getPackage = $this->master_db->getRecords('amenities',['id'=>$id],'*');
        //echo $this->db->last_query();exit;
        $this->data['amenities'] = $getPackage;
        $this->load->view('addpropertyamenity',$this->data);
    }
    public function setpropertyamenityStatus() {
      $id = trim($this->input->post('id'));
        //echo "<pre>";print_r($_POST);exit;
        $status = trim($this->input->post('status'));
        if($status ==2) {
            $this->master_db->deleterecord('amenities',['id'=>$id]);
             echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }else if($status ==-1){
            $where_data = array(
            'status'=>$status,
            'modified_date'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('amenities',$where_data,array('id'=>$id));
         echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }else  if($status ==0){
             $where_data = array(
            'status'=>$status,
            'modified_date'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('amenities',$where_data,array('id'=>$id));
         echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }
  }
  /* Property List */
  public function propertyList() {
    $this->load->view('propertyList',$this->data);
  }
  public function getPropertylist() {
            $where = "where p.status !=2";
            if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
                $where .= " and (p.title like '%$val%') ";
                $where .= " or (p.oname like '%$val%') ";
                $where .= " or (p.ptype like '%$val%') ";
                $where .= " or (pc.name like '%$val%') ";
                $where .= " or (pt.name like '%$val%') ";
                

            }
            $order_by_arr[] = "p.title";
            $order_by_arr[] = "";
            $order_by_arr[] = "p.id";
            $order_by_def   = " order by p.id desc";
            $query = "select  p.id,p.title,p.oname,p.ptype,p.created_at,p.status,p.uid,p.publish,pc.name as pname,pt.name as ptname,p.pplaces,p.pfeature,p.ppopular from properties p left join property_category pc on pc.id = p.ptype left join property_type pt on pt.id = p.type  ".$where."";           
            $fetchdata = $this->home_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
           // echo $this->db->last_query();exit;
            $data = array();
            $i = $_POST["start"]+1;
            foreach ($fetchdata as $r) {
              $uid = $r->uid;
                $action ="";
                $sub_array = array();
                  $status='';$type = "";
                   if( (int)$r->publish == -1 ){
                $action .= "<button title='Publish' class='btns' onclick='updateStatus(".$r->id.",0)' ><i class='fas fa-ban'></i></button>&nbsp;";
            }else{
                $action .= "<button title='Un Publish' class='btns'  onclick='updateStatus(".$r->id.", -1)' ><i class='fas fa-check-circle'></i></button>&nbsp;";
            }
            if( (int)$r->pfeature == 0 ){
              $action .= '<button title="Show in featured property"  onclick="showfeature('.$r->id.',1,2)" > <i class="fas fa-star"></i></button>&nbsp;';
            }else {

             $action .= '<button title="Dont show in featured property"  onclick="showfeature('.$r->id.',0,2)" style="border:1px solid red"> <i class="fas fa-star" ></i></button>&nbsp;';
            }
            if( (int)$r->pplaces == 0 ){
               $action .= '<button title="Show in Places properties"  onclick="showfeature('.$r->id.',1,3)" > <img src="'.app_asset_url().'images/recent.png'.'"  style="width:20px"/></button>&nbsp;';
            }else {
                 $action .= '<button title="Dont show in Places properties"  onclick="showfeature('.$r->id.',0,3)" style="border:1px solid red"> <img src="'.app_asset_url().'images/recent.png'.'"  style="width:20px"/></button>&nbsp;';
            }
           if( (int)$r->ppopular == 0 ){
              $action .= '<button title="Show in Popular Properties"  onclick="showfeature('.$r->id.',1,4)" > <img src="'.app_asset_url().'images/popular.png'.'"  style="width:20px"/></button>&nbsp;';
           }else {
              $action .= '<button title="Dont show in Popular Properties"  onclick="showfeature('.$r->id.',0,4)" style="border:1px solid red"> <img src="'.app_asset_url().'images/popular.png'.'"  style="width:20px"/></button>&nbsp;';
           }
            
             $action .= "<button title='View Property Details'  onclick='view(".$r->id.")' ><i class='fas fa-eye'></i></button>&nbsp;";
             $sub_array[] = $i++;
             $sub_array[] = $action;
             $sub_array[] = $r->oname;
             $sub_array[] = $r->pname;
             $sub_array[] = $r->title;
            
             $sub_array[] = $r->ptname;
             $sub_array[] = date('d-m-Y',strtotime($r->created_at));
              $data[] = $sub_array;
            }
            $res    = $this->home_db->run_manual_query_result($query);
            $total  = count($res);
            $output = array(
              "draw"              =>  intval($_POST["draw"]),
              "recordsTotal"          => $total,  
              "recordsFiltered"     => $total,  
              "data"              =>  $data
            );
            $output['csrf_token'] = $this->security->get_csrf_hash();
        echo json_encode($output);
    }

    public function setpropertylistview() {
      $id = trim($this->input->post('id'));
        //echo "<pre>";print_r($_POST);exit;
        $status = trim($this->input->post('status'));
        if($status ==2) {
            $this->master_db->deleterecord('properties',['id'=>$id]);
             echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }else if($status ==-1){
            $where_data = array(
            'publish'=>$status,
            'modified_at'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('properties',$where_data,array('id'=>$id));
        //echo $this->db->last_query();exit;
         echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }else  if($status ==0){
             $where_data = array(
            'publish'=>$status,
            'modified_at'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('properties',$where_data,array('id'=>$id));
         //echo $this->db->last_query();exit;
         echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }
  }

  public function setpropertyviewstatus() {
         $id = trim($this->input->post('id'));
      $pid = trim($this->input->post('pid'));
        //echo "<pre>";print_r($_POST);exit;
        $status = trim($this->input->post('status'));
        if($pid ==2) {
              $where_data = array(
            'pfeature'=>$status,
            );
               $this->master_db->updateRecord('properties',$where_data,array('id'=>$id));
                echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }else if($pid ==3){
            $where_data = array(
            'pplaces'=>$status,
        );
        $this->master_db->updateRecord('properties',$where_data,array('id'=>$id));
                echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }else  if($pid ==4){
             $where_data = array(
            'ppopular'=>$status,
        );
        $this->master_db->updateRecord('properties',$where_data,array('id'=>$id));
                echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        
        }
  }
  public function viewDetails() {
    $id = $this->input->post('id');
    $getProperty = $this->master_db->getRecords('properties',['id'=>$id],'*');
    $getAmenities = $this->master_db->getRecords('property_amenities',['prid'=>$id],'*');
    $getGallery = $this->master_db->getRecords('property_gallery',['prid'=>$id],'*');
    $atype = $this->master_db->getRecords('apartmenttype',['id'=>$getProperty[0]->atype],'id,name');
    $cperiod = $this->master_db->getRecords('cperiod',['id'=>$getProperty[0]->cperiod],'id,cperiod');
     $area = $this->master_db->getRecords('area',['id'=>$getProperty[0]->areaid],'id,areaname');
    $this->data['property'] = $getProperty;
    $this->data['amentites'] = $getAmenities;
    $this->data['gallery'] = $getGallery;
    $this->data['property'] = $getProperty;
    $this->data['atype'] =  $atype;
     $this->data['area'] =  $area;
        $this->data['cperiod'] =  $cperiod;
    if(!empty($id)) {
       $getpro =  $this->load->view('getPropertyviewdetails',$this->data,true);
        echo json_encode(['status'=>true,'msg'=>$getpro,'csrf_token'=>$this->security->get_csrf_hash()]);
    }
  }
  public function users() {
      $this->load->view('users',$this->data);
  }
  public function getuserlist() {
         $where = "where status !=2";
            if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
                $where .= " and (name like '%$val%') ";
                $where .= " or (email like '%$val%') ";
                $where .= " or (phone like '%$val%') ";
                $where .= " or (address like '%$val%') ";
            }
            $order_by_arr[] = "b=name";
            $order_by_arr[] = "";
            $order_by_arr[] = "id";
            $order_by_def   = " order by id desc";
            $query = "select * from users ".$where."";           
            $fetchdata = $this->home_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
            //echo $this->db->last_query();exit;
            $data = array();
            $i = $_POST["start"]+1;
            foreach ($fetchdata as $r) {
              $id = $r->id;$getpid ="";
              $getPayid = $this->master_db->getRecords('payment_log',['user_id'=>$id],'pay_id');
              if(count($getPayid) >0) {
                $getpid .=$getPayid[0]->pay_id;
                
              }
                $action ="";
                $sub_array = array();
                   if( (int)$r->status == 0 ){
               
                $action .= "<button title='Deactive' class='btns' onclick='updateStatus(".$r->id.", -1)' ><i class='fas fa-times-circle'></i></button>&nbsp;";
            }else{
                $action .= "<button title='Activate' class='btns' onclick='updateStatus(".$r->id.", 0)' ><i class='fas fa-check'></i></button>&nbsp;";
            }
            $terms = "";
            if($r->terms ==1) {
              $terms .="Agreed";
            }
             $sub_array[] = $i++;
             $sub_array[] = $action;
             $sub_array[] = $r->name;
             $sub_array[] = $r->email;
             $sub_array[] = $r->phone;
             $sub_array[] = $r->address;
             $sub_array[] = $terms;
             $sub_array[] = $getpid;
             $sub_array[] = date('d-m-Y',strtotime($r->created_at));
              $data[] = $sub_array;
            }

            $res    = $this->home_db->run_manual_query_result($query);
        $total  = count($res);
        $output = array(
            "draw"              =>  intval($_POST["draw"]),
             "recordsTotal"          => $total,  
                "recordsFiltered"     => $total,  
            "data"              =>  $data
        );
        $output['csrf_token'] = $this->security->get_csrf_hash();
        echo json_encode($output);
    }
        public function setusersStatus() {
    $id = trim($this->input->post('id'));
        //echo "<pre>";print_r($_POST);exit;
        $status = trim($this->input->post('status'));
         $where_data = array(
            'status'=>$status,
            'modified_date'=>date('Y-m-d H:i:s')
        );
        $this->master_db->updateRecord('users',$where_data,array('id'=>$id));
        echo json_encode(['status'=>1,"csrf_token"=>$this->security->get_csrf_hash()]);
  }
  public function getuserreviews() {
         $where = "where status !=2";
            if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
                $where .= " and (name like '%$val%') ";
                $where .= " or (email like '%$val%') ";
                $where .= " or (phone like '%$val%') ";
                $where .= " or (address like '%$val%') ";
            }
            $order_by_arr[] = "b=name";
            $order_by_arr[] = "";
            $order_by_arr[] = "id";
            $order_by_def   = " order by id desc";
            $query = "select * from users ".$where."";           
            $fetchdata = $this->home_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
            //echo $this->db->last_query();exit;
            $data = array();
            $i = $_POST["start"]+1;
            foreach ($fetchdata as $r) {
                $action ="";
                $sub_array = array();
                 
               
                   if( (int)$r->status == 0 ){
               
                $action .= "<button title='Deactive' class='btns' onclick='updateStatus(".$r->id.", -1)' ><i class='fas fa-times-circle'></i></button>&nbsp;";
            }else{
            
                $action .= "<button title='Activate' class='btns' onclick='updateStatus(".$r->id.", 0)' ><i class='fas fa-check'></i></button>&nbsp;";
            }
           
             $sub_array[] = $i++;
             $sub_array[] = $action;
             $sub_array[] = $r->name;
             $sub_array[] = $r->email;
             $sub_array[] = $r->phone;
             $sub_array[] = $r->address;
             $sub_array[] = date('d-m-Y',strtotime($r->created_at));
              $data[] = $sub_array;
            }

            $res    = $this->home_db->run_manual_query_result($query);
        $total  = count($res);
        $output = array(
            "draw"              =>  intval($_POST["draw"]),
             "recordsTotal"          => $total,  
                "recordsFiltered"     => $total,  
            "data"              =>  $data
        );
        $output['csrf_token'] = $this->security->get_csrf_hash();
        echo json_encode($output);
    }

    /****** States ******/
    public function states() {
      $this->load->view('masters/states/states',$this->data);
    }
      public function getStates() {
         $where = "where status !=2";
            if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
                $where .= " and (name like '%$val%') ";
            }
            $order_by_arr[] = "name";
            $order_by_arr[] = "";
            $order_by_arr[] = "id";
            $order_by_def   = " order by id desc";
            $query = "select * from states ".$where."";           
            $fetchdata = $this->home_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
            //echo $this->db->last_query();exit;
            $data = array();
            $i = $_POST["start"]+1;
            foreach ($fetchdata as $r) {
                $action ="";
                $sub_array = array();
                 $action .= '<a href='.base_url()."master/editstates?id=".sqftEncrypt($r->id)."".' class="btns1" title="Edit Details"><i class="fas fa-pencil-alt"></i></a>&nbsp;';
                  $status='';$type = "";
                   if( (int)$r->status == 0 ){
                $status = "<span class='text-success'><i class='fas fa-check'></i> Active</span>";
                $action .= "<button title='Deactive' class='btns' onclick='updateStatus(".$r->id.", -1)' ><i class='fas fa-times-circle'></i></button>&nbsp;";
            }else{
                $status = "<span class='text-warning'><i class='fas fa-times-circle'></i> In-Active</span>";
                $action .= "<button title='Activate' class='btns' onclick='updateStatus(".$r->id.", 0)' ><i class='fas fa-check'></i></button>&nbsp;";
            }
             $action .= "<button title='Delete' class='btns' onclick='updateStatus(".$r->id.", 2)' ><i class='fas fa-trash'></i></button>&nbsp;";
             // $action .= "<button title='View Detail' class='btns' onClick='popUp()'><i class='fas fa-eye' ></i></button>&nbsp;";
             $sub_array[] = $i++;
             $sub_array[] = $action;
             $sub_array[] = $r->name;
             $sub_array[] = date('d-m-Y',strtotime($r->created_at));
              $data[] = $sub_array;
            }
            $res    = $this->home_db->run_manual_query_result($query);
            $total  = count($res);
            $output = array(
              "draw"              =>  intval($_POST["draw"]),
              "recordsTotal"          => $total,  
              "recordsFiltered"     => $total,  
              "data"              =>  $data
            );
            $output['csrf_token'] = $this->security->get_csrf_hash();
        echo json_encode($output);
    }
    public function stateadd() {
      $this->load->view('masters/states/statesadd',$this->data);
    }
    public function savestates() {
          //echo "<pre>";print_r($_POST);exit;
     $title = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('title', true))));
     $id = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('id', true))));
     if(!empty($id)) {
        $db['name'] = $title;       
        $db['modified_date'] = date('Y-m-d H:i:s');
        $update = $this->master_db->updateRecord('states',$db,['id'=>$id]);
          if($update) {
          $results = ['status'=>true,'msg'=>'Updated successfully','csrf_token'=>$this->security->get_csrf_hash()];
          $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Updated successfully</div>');
           echo json_encode($results);
        }else {
          $results = ['status'=>false,'msg'=>'Error in updating ','csrf_token'=>$this->security->get_csrf_hash()];
           echo json_encode($results);
        }
     }else {
        if(!empty($title)) {
            $db['name'] = $title;
            $db['status'] = 0;
            $db['created_at'] = date('Y-m-d H:i:s');
            $in = $this->master_db->insertRecord('states',$db);
            if($in) {
              $result = ['status'=>true,'msg'=>'Inserted successfully','csrf_token'=>$this->security->get_csrf_hash()];
              echo json_encode($result);
              $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Inserted successfully</div>');
            }else {
              $result = ['status'=>false,'msg'=>'Error in inserting ','csrf_token'=>$this->security->get_csrf_hash()];
            }
       }else {
          $result = ['status'=>false,'msg'=>'Required fields are missing','csrf_token'=>$this->security->get_csrf_hash()];
          echo json_encode($result);
       }
     }
    }
        public function setstatesStatus() {
      $id = trim($this->input->post('id'));
        //echo "<pre>";print_r($_POST);exit;
        $status = trim($this->input->post('status'));
        if($status ==2) {
            $this->master_db->deleterecord('states',['id'=>$id]);
             echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }else if($status ==-1){
            $where_data = array(
            'status'=>$status,
            'modified_date'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('states',$where_data,array('id'=>$id));
          echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }else  if($status ==0){
             $where_data = array(
            'status'=>$status,
            'modified_date'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('states',$where_data,array('id'=>$id));
        echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }
  }

  public function editstates() {
      $this->load->library('encrypt');
        $id =  sqftDcrypt($_GET['id']);
        //echo $id;exit;
        $getStates = $this->master_db->getRecords('states',['id'=>$id],'*');
        //echo $this->db->last_query();exit;
        $this->data['property'] = $getStates;
        $this->load->view('masters/states/statesadd',$this->data);
  }
     /****** City ******/
    public function city() {
      $this->load->view('masters/city/cities',$this->data);
    }
          public function getcity() {
        $where = "where c.status !=2";
            if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
                $where .= " and (c.cname like '%$val%') ";
                $where .= " or (s.name like '%$val%') ";
                $where .= " or (c.created_at like '%$val%') ";
            }
            $order_by_arr[] = "c.name";
            $order_by_arr[] = "";
            $order_by_arr[] = "c.id";
            $order_by_def   = " order by c.id desc";
            $query = "select c.id,c.cname,s.name as sname,c.created_at,c.status from cities c left join states s on s.id = c.sid  ".$where."";           
            $fetchdata = $this->home_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
            //echo $this->db->last_query();exit;
            $data = array();
            $i = $_POST["start"]+1;
            foreach ($fetchdata as $r) {
                $action ="";
                $sub_array = array();
                 $action .= '<a href='.base_url()."master/editcity?id=".sqftEncrypt($r->id)."".' class="btns1" title="Edit Details"><i class="fas fa-pencil-alt"></i></a>&nbsp;';
                  $status='';$type = "";
                   if( (int)$r->status == 0 ){
                $status = "<span class='text-success'><i class='fas fa-check'></i> Active</span>";
                $action .= "<button title='Deactive' class='btns' onclick='updateStatus(".$r->id.", -1)' ><i class='fas fa-times-circle'></i></button>&nbsp;";
            }else{
                $status = "<span class='text-warning'><i class='fas fa-times-circle'></i> In-Active</span>";
                $action .= "<button title='Activate' class='btns' onclick='updateStatus(".$r->id.", 0)' ><i class='fas fa-check'></i></button>&nbsp;";
            }
             $action .= "<button title='Delete' class='btns' onclick='updateStatus(".$r->id.", 2)' ><i class='fas fa-trash'></i></button>&nbsp;";
             // $action .= "<button title='View Detail' class='btns' onClick='popUp()'><i class='fas fa-eye' ></i></button>&nbsp;";
             $sub_array[] = $i++;
             $sub_array[] = $action;
             $sub_array[] = $r->cname;
             $sub_array[] = $r->sname;
             $sub_array[] = date('d-m-Y',strtotime($r->created_at));
              $data[] = $sub_array;
            }
            $res    = $this->home_db->run_manual_query_result($query);
            $total  = count($res);
            $output = array(
              "draw"              =>  intval($_POST["draw"]),
              "recordsTotal"          => $total,  
              "recordsFiltered"     => $total,  
              "data"              =>  $data
            );
            $output['csrf_token'] = $this->security->get_csrf_hash();
        echo json_encode($output);
    }
    public function cityadd() {
        $getStates = $this->master_db->getRecords('states',['status'=>0],'id,name','name asc');
      $this->data['states'] = $getStates;
      $this->load->view('masters/city/cityadd',$this->data);
    }

         public function setcityStatus() {
      $id = trim($this->input->post('id'));
        //echo "<pre>";print_r($_POST);exit;
        $status = trim($this->input->post('status'));
        if($status ==2) {
            $this->master_db->deleterecord('cities',['id'=>$id]);
             echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }else if($status ==-1){
            $where_data = array(
            'status'=>$status,
            'modified_date'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('cities',$where_data,array('id'=>$id));
          echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }else  if($status ==0){
             $where_data = array(
            'status'=>$status,
            'modified_date'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('cities',$where_data,array('id'=>$id));
        echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }
  }

      public function savecity() {
          //echo "<pre>";print_r($_POST);exit;
     $state = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('state', true))));
     $city = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('city', true))));
     $id = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('id', true))));
     if(!empty($id)) {
        $db['sid'] = $state;       
        $db['cname'] = $city;       
        $db['modified_date'] = date('Y-m-d H:i:s');
        $update = $this->master_db->updateRecord('cities',$db,['id'=>$id]);
          if($update) {
          $results = ['status'=>true,'msg'=>'Updated successfully','csrf_token'=>$this->security->get_csrf_hash()];
          $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Updated successfully</div>');
           echo json_encode($results);
        }else {
          $results = ['status'=>false,'msg'=>'Error in updating ','csrf_token'=>$this->security->get_csrf_hash()];
           echo json_encode($results);
        }
     }else {
        if(!empty($city)) {
            $db['sid'] = $state;
            $db['cname'] = $city;
            $db['status'] = 0;
            $db['created_at'] = date('Y-m-d H:i:s');
            $in = $this->master_db->insertRecord('cities',$db);
            if($in) {
              $result = ['status'=>true,'msg'=>'Inserted successfully','csrf_token'=>$this->security->get_csrf_hash()];
              echo json_encode($result);
              $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Inserted successfully</div>');
            }else {
              $result = ['status'=>false,'msg'=>'Error in inserting ','csrf_token'=>$this->security->get_csrf_hash()];
            }
       }else {
          $result = ['status'=>false,'msg'=>'Required fields are missing','csrf_token'=>$this->security->get_csrf_hash()];
          echo json_encode($result);
       }
     }
    }

  public function editcity() {
        $id =  sqftDcrypt($_GET['id']);
         $getStates = $this->master_db->getRecords('states',['status'=>0],'id,name','name asc');
      $this->data['states'] = $getStates;
        //echo $id;exit;
        $cities = $this->master_db->getRecords('cities',['id'=>$id],'*');
        //echo $this->db->last_query();exit;
        $this->data['city'] = $cities;
        $this->load->view('masters/city/cityadd',$this->data);
  }


  /****** Sliders ******/
    public function sliders() {
      $this->load->view('masters/sliders/slider',$this->data);
    }
          public function getslider() {
        $where = "where status !=2";
            if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
                $where .= " and (image like '%$val%') ";
                $where .= " or (created_at like '%$val%') ";
            }
            $order_by_arr[] = "image";
            $order_by_arr[] = "";
            $order_by_arr[] = "id";
            $order_by_def   = " order by id desc";
            $query = "select id,image, created_at,status from slider_img   ".$where."";           
            $fetchdata = $this->home_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
            //echo $this->db->last_query();exit;
            $data = array();
            $i = $_POST["start"]+1;
            foreach ($fetchdata as $r) {
                $action ="";
                $sub_array = array();
                 $action .= '<a href='.base_url()."master/editslider?id=".sqftEncrypt($r->id)."".' class="btns1" title="Edit Details"><i class="fas fa-pencil-alt"></i></a>&nbsp;';
                  $status='';$type = "";
                   if( (int)$r->status == 0 ){
                $status = "<span class='text-success'><i class='fas fa-check'></i> Active</span>";
                $action .= "<button title='Deactive' class='btns' onclick='updateStatus(".$r->id.", -1)' ><i class='fas fa-times-circle'></i></button>&nbsp;";
            }else{
                $status = "<span class='text-warning'><i class='fas fa-times-circle'></i> In-Active</span>";
                $action .= "<button title='Activate' class='btns' onclick='updateStatus(".$r->id.", 0)' ><i class='fas fa-check'></i></button>&nbsp;";
            }
             $action .= "<button title='Delete' class='btns' onclick='updateStatus(".$r->id.", 2)' ><i class='fas fa-trash'></i></button>&nbsp;";
             // $action .= "<button title='View Detail' class='btns' onClick='popUp()'><i class='fas fa-eye' ></i></button>&nbsp;";
             $image = "";
             if(!empty($r->image)) {
              $image .= "<img src='".app_url().$r->image."' style='width:100px'/>";
             }
             $sub_array[] = $i++;
             $sub_array[] = $action;
             $sub_array[] = $image;
             $sub_array[] = date('d-m-Y',strtotime($r->created_at));
              $data[] = $sub_array;
            }
            $res    = $this->home_db->run_manual_query_result($query);
            $total  = count($res);
            $output = array(
              "draw"              =>  intval($_POST["draw"]),
              "recordsTotal"          => $total,  
              "recordsFiltered"     => $total,  
              "data"              =>  $data
            );
            $output['csrf_token'] = $this->security->get_csrf_hash();
        echo json_encode($output);
    }
    public function slideradd() {
        $getStates = $this->master_db->getRecords('states',['status'=>0],'id,name','name asc');
      $this->data['states'] = $getStates;
      $this->load->view('masters/sliders/slideradd',$this->data);
    }

         public function setsliderStatus() {
      $id = trim($this->input->post('id'));
        //echo "<pre>";print_r($_POST);exit;
        $status = trim($this->input->post('status'));
        if($status ==2) {
            $this->master_db->deleterecord('slider_img',['id'=>$id]);
             echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }else if($status ==-1){
            $where_data = array(
            'status'=>$status,
            'modified_date'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('slider_img',$where_data,array('id'=>$id));
          echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }else  if($status ==0){
             $where_data = array(
            'status'=>$status,
            'modified_date'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('slider_img',$where_data,array('id'=>$id));
        echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }
  }

      public function saveslider() {
          // echo "<pre>";print_r($_FILES);print_r($_POST);exit;
     
     $id = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('id', true))));
     if(!empty($id)) {
         if(!empty($_FILES['sfile']['name'])) {
                        $uploadPath = '../assets/sliders/';
                        $config['upload_path'] = $uploadPath;
                        $config['allowed_types'] = 'jpg|png|PNG|JPEG';
                        $config['max_width']            = 1920;
                        $config['max_height']           = 750;
                        $ext = pathinfo($_FILES["sfile"]['name'], PATHINFO_EXTENSION);
                        $new_name = "sqft9".rand(11111,99999).'.'.$ext; 
                        $config['file_name'] = $new_name;
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if(!$this->upload->do_upload('sfile')){
                            $this->session->set_flashdata("message","<div class='alert alert-danger'>".$this->upload->display_errors()."</div>");
                                redirect('slideradd');  
                        }else {
                            $upload_data = $this->upload->data();
                            $db['image'] =  'assets/sliders/'.$upload_data['file_name']; 
                        }
                    }
        $db['modified_date'] = date('Y-m-d H:i:s');
        $update = $this->master_db->updateRecord('slider_img',$db,['id'=>$id]);
          if($update >0) {
          $results = ['status'=>true,'msg'=>'Updated successfully','csrf_token'=>$this->security->get_csrf_hash()];
          $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Updated successfully</div>');
        }else {
          $results = ['status'=>false,'msg'=>'Error in updating ','csrf_token'=>$this->security->get_csrf_hash()];
           echo json_encode($results);
        }
     }else {
       
             if(!empty($_FILES['sfile']['name'])) {
                        $uploadPath = '../assets/sliders/';
                        $config['upload_path'] = $uploadPath;
                        $config['allowed_types'] = 'jpg|png|PNG|JPEG';
                        $config['max_width']            = 1920;
                        $config['max_height']           = 750;
                        $ext = pathinfo($_FILES["sfile"]['name'], PATHINFO_EXTENSION);
                        $new_name = "sqft9".rand(11111,99999).'.'.$ext; 
                        $config['file_name'] = $new_name;
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if(!$this->upload->do_upload('sfile')){
                            $this->session->set_flashdata("message","<div class='alert alert-danger'>".$this->upload->display_errors()."</div>");
                                redirect('slideradd');  
                        }else {
                            $upload_data = $this->upload->data();
                            $db['image'] =  'assets/sliders/'.$upload_data['file_name']; 
                        }
                    }
        
            $db['created_at'] = date('Y-m-d H:i:s');
            $in = $this->master_db->insertRecord('slider_img',$db);
            if($in) {
              $result = ['status'=>true,'msg'=>'Inserted successfully','csrf_token'=>$this->security->get_csrf_hash()];
              echo json_encode($result);
              $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Inserted successfully</div>');
            }else {
              $result = ['status'=>false,'msg'=>'Error in inserting ','csrf_token'=>$this->security->get_csrf_hash()];
            }
     
     }
redirect('sliders');
    }

  public function editslider() {
        $id =  sqftDcrypt($_GET['id']);
         
        //echo $id;exit;
        $cities = $this->master_db->getRecords('slider_img',['id'=>$id],'*');
        //echo $this->db->last_query();exit;
        $this->data['city'] = $cities;
        $this->load->view('masters/sliders/slideradd',$this->data);
  }

       /****** Area ******/
    public function area() {
      $this->load->view('masters/area/area',$this->data);
    }
          public function getarea() {
         $where = "where a.status !=2";
            if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
                $where .= " and (c.cname like '%$val%') ";
                $where .= " or (a.areaname like '%$val%') ";
                $where .= " or (a.created_at like '%$val%') ";
            }
            $order_by_arr[] = "a.areaname";
            $order_by_arr[] = "";
            $order_by_arr[] = "a.id";
            $order_by_def   = " order by a.id desc";
            $query = "select a.areaname,a.created_at,a.status,c.cname,a.id from area a left join  cities c on c.id = a.cid  ".$where."";           
            $fetchdata = $this->home_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
            //echo $this->db->last_query();exit;
            $data = array();
            $i = $_POST["start"]+1;
            foreach ($fetchdata as $r) {
                $action ="";
                $sub_array = array();
                 $action .= '<a href='.base_url()."master/editarea?id=".sqftEncrypt($r->id)."".' class="btns1" title="Edit Details"><i class="fas fa-pencil-alt"></i></a>&nbsp;';
                  $status='';$type = "";
                   if( (int)$r->status == 0 ){
                $status = "<span class='text-success'><i class='fas fa-check'></i> Active</span>";
                $action .= "<button title='Deactive' class='btns' onclick='updateStatus(".$r->id.", -1)' ><i class='fas fa-times-circle'></i></button>&nbsp;";
            }else{
                $status = "<span class='text-warning'><i class='fas fa-times-circle'></i> In-Active</span>";
                $action .= "<button title='Activate' class='btns' onclick='updateStatus(".$r->id.", 0)' ><i class='fas fa-check'></i></button>&nbsp;";
            }
             $action .= "<button title='Delete' class='btns' onclick='updateStatus(".$r->id.", 2)' ><i class='fas fa-trash'></i></button>&nbsp;";
             // $action .= "<button title='View Detail' class='btns' onClick='popUp()'><i class='fas fa-eye' ></i></button>&nbsp;";
             $sub_array[] = $i++;
             $sub_array[] = $action;
             $sub_array[] = $r->cname;
             $sub_array[] = $r->areaname;
             $sub_array[] = date('d-m-Y',strtotime($r->created_at));
              $data[] = $sub_array;
            }
            $res    = $this->home_db->run_manual_query_result($query);
            $total  = count($res);
            $output = array(
              "draw"              =>  intval($_POST["draw"]),
              "recordsTotal"          => $total,  
              "recordsFiltered"     => $total,  
              "data"              =>  $data
            );
            $output['csrf_token'] = $this->security->get_csrf_hash();
        echo json_encode($output);
    }
    public function areaadd() {
        $getcities = $this->master_db->getRecords('cities',['status'=>0],'id,cname','cname asc');
      $this->data['cities'] = $getcities;
      $this->data['type'] = "add";
      $this->load->view('masters/area/areaadd',$this->data);
    }

         public function setareaStatus() {
      $id = trim($this->input->post('id'));
        //echo "<pre>";print_r($_POST);exit;
        $status = trim($this->input->post('status'));
        if($status ==2) {
            $this->master_db->deleterecord('area',['id'=>$id]);
             echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }else if($status ==-1){
            $where_data = array(
            'status'=>$status,
            'modified_at'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('area',$where_data,array('id'=>$id));
          echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }else  if($status ==0){
             $where_data = array(
            'status'=>$status,
            'modified_at'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('area',$where_data,array('id'=>$id));
        echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }
  }

      public function savearea() {
          //echo "<pre>";print_r($_POST);exit;
     $city = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('city', true))));
     $area = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('area', true))));
     $id = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('id', true))));
     if(!empty($id)) {
        $db['cid'] = $city;       
        $db['areaname'] = $area;       
        $db['modified_at'] = date('Y-m-d H:i:s');
        $update = $this->master_db->updateRecord('area',$db,['id'=>$id]);
          if($update) {
          $results = ['status'=>true,'msg'=>'Updated successfully','csrf_token'=>$this->security->get_csrf_hash()];
          $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Updated successfully</div>');
           echo json_encode($results);
        }else {
          $results = ['status'=>false,'msg'=>'Error in updating ','csrf_token'=>$this->security->get_csrf_hash()];
           echo json_encode($results);
        }
     }else {
        if(!empty($city)) {
            $db['cid'] = $city;
            $db['areaname'] = $area;
            $db['created_at'] = date('Y-m-d H:i:s');
            $in = $this->master_db->insertRecord('area',$db);
            if($in) {
              $result = ['status'=>true,'msg'=>'Inserted successfully','csrf_token'=>$this->security->get_csrf_hash()];
              echo json_encode($result);
              $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Inserted successfully</div>');
            }else {
              $result = ['status'=>false,'msg'=>'Error in inserting ','csrf_token'=>$this->security->get_csrf_hash()];
            }
       }else {
          $result = ['status'=>false,'msg'=>'Required fields are missing','csrf_token'=>$this->security->get_csrf_hash()];
          echo json_encode($result);
       }
     }
    }

  public function editarea() {
        $id =  sqftDcrypt($_GET['id']);
        //echo $id;exit;
        $cities = $this->master_db->getRecords('cities',['status'=>0],'*');
        $area = $this->master_db->getRecords('area',['id'=>$id],'id,areaname,cid');
        //echo $this->db->last_query();exit;
        $this->data['cities'] = $cities;
        $this->data['type'] = "edit";
        $this->data['area'] = $area;
        $this->load->view('masters/area/areaadd',$this->data);
  }
  /*** Testimonials *******/
  public function testimonials() {
    $this->load->view('masters/testimonials/testimonials',$this->data);
  }
  public function testimonialsadd() {
    $this->load->view('masters/testimonials/testimonialsadd',$this->data);
  }
   public function testimonialssave() {
      // echo "<pre>";print_r($_POST);exit;
     $name = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('name', true))));
     $location = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('location', true))));
     $msg = trim($this->input->post('msg'));
    $id = $this->input->post('id');
      if(!empty($id)) {
      $getTestimonials = $this->master_db->getRecords('testimonials',['id'=>$id],'image');
      $images = app_url().$getTestimonials[0]->image;

        $db['name'] = $name;
        $db['location'] = $location;
               if(!empty($_FILES['file']['name'])) {
                        //unlink("$images");
                        $uploadPath = '../assets/testimonials/';
                        $config['upload_path'] = $uploadPath;
                        $config['allowed_types'] = 'jpg|png|PNG|JPEG';
                        $ext = pathinfo($_FILES["file"]['name'], PATHINFO_EXTENSION);
                        $new_name = "sqft9".rand(11111,99999).'.'.$ext; 
                        $config['file_name'] = $new_name;
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if(!$this->upload->do_upload('file')){
                            $this->session->set_flashdata("message","<div class='alert alert-danger'>".$this->upload->display_errors()."</div>");
                                redirect('property/myproperty');  
                        }else {
                            $upload_data = $this->upload->data();
                            $db['image'] =  'assets/testimonials/'.$upload_data['file_name']; 
                        }
                    }
        $db['tdesc'] = $msg;
      
        $db['modified_at'] = date('Y-m-d H:i:s');
        $update = $this->master_db->updateRecord('testimonials',$db,['id'=>$id]);
          if($update) {
          $results = ['status'=>true,'msg'=>'Updated successfully'];
          $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Updated successfully</div>');
          
        }else {
          $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Errro in updating</div>');
        }
     }else {
        if(!empty($name) && !empty($location)) {
            $db['name'] = $name;
            $db['location'] = $location;
             if(!empty($_FILES['file']['name'])) {
                        $uploadPath = '../assets/testimonials/';
                        $config['upload_path'] = $uploadPath;
                        $config['allowed_types'] = 'jpg|png|PNG|JPEG';
                        $ext = pathinfo($_FILES["file"]['name'], PATHINFO_EXTENSION);
                        $new_name = "sqft9".rand(11111,99999).'.'.$ext; 
                        $config['file_name'] = $new_name;
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if(!$this->upload->do_upload('file')){
                            $this->session->set_flashdata("message","<div class='alert alert-danger'>".$this->upload->display_errors()."</div>");
                                
                        }else {
                            $upload_data = $this->upload->data();
                            $db['image'] =  'assets/testimonials/'.$upload_data['file_name']; 
                        }
                    }
            $db['tdesc'] = $msg;
          
           
            $db['status'] = 0;
            $db['created_at'] = date('Y-m-d H:i:s');
            $in = $this->master_db->insertRecord('testimonials',$db);
            if($in) {
              
              $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Inserted successfully</div>');
            }else {
               $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Errro in inserting</div>');
            }
       }else {
           $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Required fields are missing</div>');
          
       }
     }
      redirect('testimonials'); 
  }

   public function getTestimonials() {
         $where = "where status !=2";
            if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
                $where .= " and (name like '%$val%') ";
                $where .= " or (location like '%$val%') ";
                $where .= " or (tdesc like '%$val%') ";
            }
            $order_by_arr[] = "name";
            $order_by_arr[] = "";
            $order_by_arr[] = "id";
            $order_by_def   = " order by id desc";
            $query = "select * from testimonials ".$where."";           
            $fetchdata = $this->home_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
            //echo $this->db->last_query();exit;
            $data = array();
            $i = $_POST["start"]+1;
            foreach ($fetchdata as $r) {
                $action ="";
                $sub_array = array();
                 $action .= '<a href='.base_url()."master/edittestimonials?id=".sqftEncrypt($r->id)."".' class="btns1" title="Edit Details"><i class="fas fa-pencil-alt"></i></a>&nbsp;';
                  $status='';$type = "";
                   if( (int)$r->status == 0 ){
                $status = "<span class='text-success'><i class='fas fa-check'></i> Active</span>";
                $action .= "<button title='Deactive' class='btns' onclick='updateStatus(".$r->id.", -1)' ><i class='fas fa-times-circle'></i></button>&nbsp;";
            }else{
                $status = "<span class='text-warning'><i class='fas fa-times-circle'></i> In-Active</span>";
                $action .= "<button title='Activate' class='btns' onclick='updateStatus(".$r->id.", 0)' ><i class='fas fa-check'></i></button>&nbsp;";
            }
             $action .= "<button title='Delete' class='btns' onclick='updateStatus(".$r->id.", 2)' ><i class='fas fa-trash'></i></button>&nbsp;";
             $image = "<img src='".app_url().$r->image."' style='width:80px'/>";
             $sub_array[] = $i++;
             $sub_array[] = $action;
             $sub_array[] = $image;

             $sub_array[] = $r->name;
             $sub_array[] = $r->location;
             $sub_array[] = $r->tdesc;
             $sub_array[] = date('d-m-Y',strtotime($r->created_at));
              $data[] = $sub_array;
            }
            $res    = $this->home_db->run_manual_query_result($query);
            $total  = count($res);
            $output = array(
              "draw"              =>  intval($_POST["draw"]),
              "recordsTotal"          => $total,  
              "recordsFiltered"     => $total,  
              "data"              =>  $data
            );
            $output['csrf_token'] = $this->security->get_csrf_hash();
        echo json_encode($output);
    }
    public function edittestimonials() {
        $id =  sqftDcrypt($_GET['id']);
        $this->data['category'] = $this->master_db->getRecords('testimonials',['status !='=>-1],'id,name');
        //echo $id;exit;
        $getTestimonials = $this->master_db->getRecords('testimonials',['id'=>$id],'*');
        //echo $this->db->last_query();exit;
        $this->data['testimonials'] = $getTestimonials;
        $this->load->view('masters/testimonials/testimonialsadd',$this->data);
    }
  
            public function settestimonialStatus() {
      $id = trim($this->input->post('id'));
        //echo "<pre>";print_r($_POST);exit;
        $status = trim($this->input->post('status'));
        if($status ==2) {
            $this->master_db->deleterecord('testimonials',['id'=>$id]);
             echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }else if($status ==-1){
            $where_data = array(
            'status'=>$status,
            'modified_at'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('testimonials',$where_data,array('id'=>$id));
          echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }else  if($status ==0){
             $where_data = array(
            'status'=>$status,
            'modified_at'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('testimonials',$where_data,array('id'=>$id));
        echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }
  }

    /*** Partners *******/
  public function partners() {
    $this->load->view('masters/partners/partners',$this->data);
  }
     public function getPartners() {
         $where = "where status !=2";
            if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
                $where .= " and (id like '%$val%') ";
                $where .= " or (created_at like '%$val%') ";
            }
            $order_by_arr[] = "image";
            $order_by_arr[] = "";
            $order_by_arr[] = "id";
            $order_by_def   = " order by id desc";
            $query = "select * from partners ".$where."";           
            $fetchdata = $this->home_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
            //echo $this->db->last_query();exit;
            $data = array();
            $i = $_POST["start"]+1;
            foreach ($fetchdata as $r) {
                $action ="";
                $sub_array = array();
                 $action .= '<a href='.base_url()."master/editpartners?id=".sqftEncrypt($r->id)."".' class="btns1" title="Edit Details"><i class="fas fa-pencil-alt"></i></a>&nbsp;';
                  $status='';$type = "";
                   if( (int)$r->status == 0 ){
                $status = "<span class='text-success'><i class='fas fa-check'></i> Active</span>";
                $action .= "<button title='Deactive' class='btns' onclick='updateStatus(".$r->id.", -1)' ><i class='fas fa-times-circle'></i></button>&nbsp;";
            }else{
                $status = "<span class='text-warning'><i class='fas fa-times-circle'></i> In-Active</span>";
                $action .= "<button title='Activate' class='btns' onclick='updateStatus(".$r->id.", 0)' ><i class='fas fa-check'></i></button>&nbsp;";
            }
             $action .= "<button title='Delete' class='btns' onclick='updateStatus(".$r->id.", 2)' ><i class='fas fa-trash'></i></button>&nbsp;";
             $image = "<img src='".app_url().$r->image."' style='width:80px'/>";
             $sub_array[] = $i++;
             $sub_array[] = $action;
             $sub_array[] = $image;

             $sub_array[] = date('d-m-Y',strtotime($r->created_at));
              $data[] = $sub_array;
            }
            $res    = $this->home_db->run_manual_query_result($query);
            $total  = count($res);
            $output = array(
              "draw"              =>  intval($_POST["draw"]),
              "recordsTotal"          => $total,  
              "recordsFiltered"     => $total,  
              "data"              =>  $data
            );
            $output['csrf_token'] = $this->security->get_csrf_hash();
        echo json_encode($output);
    }

    public function partnersadd() {
    $this->load->view('masters/partners/partnersadd',$this->data);
  }
  public function partnerssave() {
     
    $id = $this->input->post('id');
      if(!empty($id)) {
      
               if(!empty($_FILES['file']['name'])) {
                        //unlink("$images");
                        $uploadPath = '../assets/partners/';
                        $config['upload_path'] = $uploadPath;
                        $config['allowed_types'] = 'jpg|png|PNG|JPEG';
                        $ext = pathinfo($_FILES["file"]['name'], PATHINFO_EXTENSION);
                        $new_name = "sqft9".rand(11111,99999).'.'.$ext; 
                        $config['file_name'] = $new_name;
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if(!$this->upload->do_upload('file')){
                            $this->session->set_flashdata("message","<div class='alert alert-danger'>".$this->upload->display_errors()."</div>");
                                redirect('property/myproperty');  
                        }else {
                            $upload_data = $this->upload->data();
                            $db['image'] =  'assets/partners/'.$upload_data['file_name']; 
                        }
                    }
        
      
        $db['modified_at'] = date('Y-m-d H:i:s');
        $update = $this->master_db->updateRecord('partners',$db,['id'=>$id]);
          if($update) {
          $results = ['status'=>true,'msg'=>'Updated successfully'];
          $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Updated successfully</div>');
          
        }else {
          $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Errro in updating</div>');
        }
     }else {
        if(!empty($_FILES['file']['name'])) {
          
             if(!empty($_FILES['file']['name'])) {
                        $uploadPath = '../assets/partners/';
                        $config['upload_path'] = $uploadPath;
                        $config['allowed_types'] = 'jpg|png|PNG|JPEG';
                        
                        $ext = pathinfo($_FILES["file"]['name'], PATHINFO_EXTENSION);
                        $new_name = "sqft9".rand(11111,99999).'.'.$ext; 
                        $config['file_name'] = $new_name;
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if(!$this->upload->do_upload('file')){
                            $this->session->set_flashdata("message","<div class='alert alert-danger'>".$this->upload->display_errors()."</div>");
                                
                        }else {
                            $upload_data = $this->upload->data();
                            $db['image'] =  'assets/partners/'.$upload_data['file_name']; 
                        }
                    }
      
            $db['created_at'] = date('Y-m-d H:i:s');
            $in = $this->master_db->insertRecord('partners',$db);
            if($in) {
              
              $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Inserted successfully</div>');
            }else {
               $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Errro in inserting</div>');
            }
       }else {
           $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Required fields are missing</div>');
          
       }
     }
      redirect('partners'); 
  }
    public function editpartners() {
        $id =  sqftDcrypt($_GET['id']);
        //echo $id;exit;
        $getTestimonials = $this->master_db->getRecords('partners',['id'=>$id],'*');
        //echo $this->db->last_query();exit;
        $this->data['partners'] = $getTestimonials;
        $this->load->view('masters/partners/partnersadd',$this->data);
    }
  
            public function setpartnersStatus() {
      $id = trim($this->input->post('id'));
        //echo "<pre>";print_r($_POST);exit;
        $status = trim($this->input->post('status'));
        if($status ==2) {
            $this->master_db->deleterecord('partners',['id'=>$id]);
             echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }else if($status ==-1){
            $where_data = array(
            'status'=>$status,
            'modified_at'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('partners',$where_data,array('id'=>$id));
          echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }else  if($status ==0){
             $where_data = array(
            'status'=>$status,
            'modified_at'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('partners',$where_data,array('id'=>$id));
        echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }
  }

    /*** Pincodes *******/
  public function pincodes() {
    $this->load->view('masters/pincodes/pincodes',$this->data);
  }
  public function pincodeadd() {
    $this->load->view('masters/pincodes/pincodesadd',$this->data);
  }
   public function getPincodes() {
         $where = "where status !=2";
            if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
                $where .= " and (pincode like '%$val%') ";
            }
            $order_by_arr[] = "name";
            $order_by_arr[] = "";
            $order_by_arr[] = "id";
            $order_by_def   = " order by id desc";
            $query = "select * from pincodes ".$where."";           
            $fetchdata = $this->home_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
            //echo $this->db->last_query();exit;
            $data = array();
            $i = $_POST["start"]+1;
            foreach ($fetchdata as $r) {
                $action ="";
                $sub_array = array();
                 $action .= '<a href='.base_url()."master/editpincodes?id=".sqftEncrypt($r->id)."".' class="btns1" title="Edit Details"><i class="fas fa-pencil-alt"></i></a>&nbsp;';
                  $status='';$type = "";
                   if( (int)$r->status == 0 ){
                $status = "<span class='text-success'><i class='fas fa-check'></i> Active</span>";
                $action .= "<button title='Deactive' class='btns' onclick='updateStatus(".$r->id.", -1)' ><i class='fas fa-times-circle'></i></button>&nbsp;";
            }else{
                $status = "<span class='text-warning'><i class='fas fa-times-circle'></i> In-Active</span>";
                $action .= "<button title='Activate' class='btns' onclick='updateStatus(".$r->id.", 0)' ><i class='fas fa-check'></i></button>&nbsp;";
            }
             $action .= "<button title='Delete' class='btns' onclick='updateStatus(".$r->id.", 2)' ><i class='fas fa-trash'></i></button>&nbsp;";
             // $action .= "<button title='View Detail' class='btns' onClick='popUp()'><i class='fas fa-eye' ></i></button>&nbsp;";
             $sub_array[] = $i++;
             $sub_array[] = $action;
             $sub_array[] = $r->pincode;
             $sub_array[] = date('d-m-Y',strtotime($r->created_at));
              $data[] = $sub_array;
            }
            $res    = $this->home_db->run_manual_query_result($query);
            $total  = count($res);
            $output = array(
              "draw"              =>  intval($_POST["draw"]),
              "recordsTotal"          => $total,  
              "recordsFiltered"     => $total,  
              "data"              =>  $data
            );
            $output['csrf_token'] = $this->security->get_csrf_hash();
        echo json_encode($output);
    }
    public function pincodesave() {
          //echo "<pre>";print_r($_POST);exit;
     $pincode = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('pincode', true))));
     $id = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('id', true))));
     if(!empty($id)) {
        $db['pincode'] = $pincode;       
        $db['modified_at'] = date('Y-m-d H:i:s');
        $update = $this->master_db->updateRecord('pincodes',$db,['id'=>$id]);
          if($update) {
          $results = ['status'=>true,'msg'=>'Updated successfully','csrf_token'=>$this->security->get_csrf_hash()];
          $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Updated successfully</div>');
           echo json_encode($results);
        }else {
          $results = ['status'=>false,'msg'=>'Error in updating ','csrf_token'=>$this->security->get_csrf_hash()];
           echo json_encode($results);
        }
     }else {
        if(!empty($pincode)) {
            $db['pincode'] = $pincode;
            $db['created_at'] = date('Y-m-d H:i:s');
            $in = $this->master_db->insertRecord('pincodes',$db);
            if($in) {
              $result = ['status'=>true,'msg'=>'Inserted successfully','csrf_token'=>$this->security->get_csrf_hash()];
              echo json_encode($result);
              $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Inserted successfully</div>');
            }else {
              $result = ['status'=>false,'msg'=>'Error in inserting ','csrf_token'=>$this->security->get_csrf_hash()];
            }
       }else {
          $result = ['status'=>false,'msg'=>'Required fields are missing','csrf_token'=>$this->security->get_csrf_hash()];
          echo json_encode($result);
       }
     }
    }
    public function editpincodes() {
        $this->load->library('encrypt');
        $id =  sqftDcrypt($_GET['id']);
        //echo $id;exit;
        $getPackage = $this->master_db->getRecords('pincodes',['id'=>$id],'*');
        //echo $this->db->last_query();exit;
        $this->data['pincodes'] = $getPackage;
        $this->load->view('masters/pincodes/pincodesadd',$this->data);
    }
    public function setpincodesStatus() {
      $id = trim($this->input->post('id'));
        //echo "<pre>";print_r($_POST);exit;
        $status = trim($this->input->post('status'));
        if($status ==2) {
            $this->master_db->deleterecord('pincodes',['id'=>$id]);
             echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }else if($status ==-1){
            $where_data = array(
            'status'=>$status,
            'modified_at'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('pincodes',$where_data,array('id'=>$id));
          echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }else  if($status ==0){
             $where_data = array(
            'status'=>$status,
            'modified_at'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('pincodes',$where_data,array('id'=>$id));
        echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }
  }
  /****** FAQ ******/
  public function faq() {
      $this->load->view('masters/faq/faq',$this->data);
  }
  public function getFaq() {
       $where = "where status !=2";
            if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
                $where .= " and (title like '%$val%') ";
                $where .= " or (fdesc like '%$val%') ";
            }
            $order_by_arr[] = "title";
            $order_by_arr[] = "";
            $order_by_arr[] = "id";
            $order_by_def   = " order by id desc";
            $query = "select * from faq ".$where."";           
            $fetchdata = $this->home_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
            //echo $this->db->last_query();exit;
            $data = array();
            $i = $_POST["start"]+1;
            foreach ($fetchdata as $r) {
                $action ="";
                $sub_array = array();
                 $action .= '<a href='.base_url()."master/faqedit?id=".sqftEncrypt($r->id)."".' class="btns1" title="Edit Details"><i class="fas fa-pencil-alt"></i></a>&nbsp;';
                  $status='';$type = "";
                   if( (int)$r->status == 0 ){
                $status = "<span class='text-success'><i class='fas fa-check'></i> Active</span>";
                $action .= "<button title='Deactive' class='btns' onclick='updateStatus(".$r->id.", -1)' ><i class='fas fa-times-circle'></i></button>&nbsp;";
            }else{
                $status = "<span class='text-warning'><i class='fas fa-times-circle'></i> In-Active</span>";
                $action .= "<button title='Activate' class='btns' onclick='updateStatus(".$r->id.", 0)' ><i class='fas fa-check'></i></button>&nbsp;";
            }
             $action .= "<button title='Delete' class='btns' onclick='updateStatus(".$r->id.", 2)' ><i class='fas fa-trash'></i></button>&nbsp;";
             // $action .= "<button title='View Detail' class='btns' onClick='popUp()'><i class='fas fa-eye' ></i></button>&nbsp;";
             $sub_array[] = $i++;
             $sub_array[] = $action;
             $sub_array[] = $r->title;
             $sub_array[] = $r->fdesc;
             $sub_array[] = date('d-m-Y',strtotime($r->created_at));
              $data[] = $sub_array;
            }
            $res    = $this->home_db->run_manual_query_result($query);
            $total  = count($res);
            $output = array(
              "draw"              =>  intval($_POST["draw"]),
              "recordsTotal"          => $total,  
              "recordsFiltered"     => $total,  
              "data"              =>  $data
            );
            $output['csrf_token'] = $this->security->get_csrf_hash();
        echo json_encode($output);
  }
  public function faqadd() {
     $this->load->view('masters/faq/faqadd',$this->data);
  }
  public function faqsave() {
          //echo "<pre>";print_r($_POST);exit;
     $title = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('title', true))));
     $id = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('id', true))));
     $content = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('content', true))));
     if(!empty($id)) {
        $db['title'] = $title;
         $db['fdesc'] = $content;       
        $db['modified_at'] = date('Y-m-d H:i:s');
        $update = $this->master_db->updateRecord('faq',$db,['id'=>$id]);
          if($update) {
          $results = ['status'=>true,'msg'=>'Updated successfully','csrf_token'=>$this->security->get_csrf_hash()];
          $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Updated successfully</div>');
           echo json_encode($results);
        }else {
          $results = ['status'=>false,'msg'=>'Error in updating ','csrf_token'=>$this->security->get_csrf_hash()];
           echo json_encode($results);
        }
     }else {
        if(!empty($title) && !empty($content)) {
            $db['title'] = $title;
            $db['fdesc'] = $content;
            $db['created_at'] = date('Y-m-d H:i:s');
            $in = $this->master_db->insertRecord('faq',$db);
            if($in) {
              $result = ['status'=>true,'msg'=>'Inserted successfully','csrf_token'=>$this->security->get_csrf_hash()];
              echo json_encode($result);
              $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Inserted successfully</div>');
            }else {
              $result = ['status'=>false,'msg'=>'Error in inserting ','csrf_token'=>$this->security->get_csrf_hash()];
            }
       }else {
          $result = ['status'=>false,'msg'=>'Required fields are missing','csrf_token'=>$this->security->get_csrf_hash()];
          echo json_encode($result);
       }
     }
  }
  public function faqedit() {
        $id =  sqftDcrypt($_GET['id']);
        //echo $id;exit;
        $getPackage = $this->master_db->getRecords('faq',['id'=>$id],'*');
        //echo $this->db->last_query();exit;
        $this->data['faq'] = $getPackage;
        $this->load->view('masters/faq/faqadd',$this->data);
  }
  public function faqstatus() {
       $id = trim($this->input->post('id'));
        //echo "<pre>";print_r($_POST);exit;
        $status = trim($this->input->post('status'));
        if($status ==2) {
            $this->master_db->deleterecord('faq',['id'=>$id]);
             echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }else if($status ==-1){
            $where_data = array(
            'status'=>$status,
            'modified_at'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('faq',$where_data,array('id'=>$id));
          echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }else  if($status ==0){
             $where_data = array(
            'status'=>$status,
            'modified_at'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('faq',$where_data,array('id'=>$id));
        echo json_encode(['status'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
        }
  }
  /**** About *******/
  public function about() {
    $this->data['about'] = $this->master_db->getRecords('aboutus',['id'=>1],'*');
    $this->load->view('homepage/about',$this->data);
  }
  public function aboutussave() {
   $id = 1;
   $about = trim($this->input->post('content'));
   $db['adesc'] = $about;
   $db['modified_at'] = date('Y-m-d H:i:s');
   $update = $this->master_db->updateRecord('aboutus',$db,array('id'=>$id));
   if($update) {
      $this->session->set_flashdata('message','<div class="alert alert-success">Updated successfully</div>');
      redirect('aboutus');
   }else {
      $this->session->set_flashdata('message','<div class="alert alert-danger">Error in updating</div>');
      redirect('aboutus');
   }
  }

    /**** Terms *******/
  public function terms() {
    $this->data['terms'] = $this->master_db->getRecords('terms',['id'=>1],'*');
    $this->load->view('homepage/terms-condition',$this->data);
  }
  public function termssave() {
   $id = 1;
   $about = trim($this->input->post('content'));
   $db['tdesc'] = $about;
   $db['modified_at'] = date('Y-m-d H:i:s');
   $update = $this->master_db->updateRecord('terms',$db,array('id'=>$id));
   if($update) {
      $this->session->set_flashdata('message','<div class="alert alert-success">Updated successfully</div>');
      redirect('terms');
   }else {
      $this->session->set_flashdata('message','<div class="alert alert-danger">Error in updating</div>');
      redirect('terms');
   }
  }

      /**** Privacy *******/
  public function privacy() {
    $this->data['privacy'] = $this->master_db->getRecords('privacypolicy',['id'=>1],'*');
    $this->load->view('homepage/privacy-policy',$this->data);
  }
  public function privacysave() {
   $id = 1;
   $about = trim($this->input->post('content'));
   $db['pdesc'] = $about;
   $db['modified_at'] = date('Y-m-d H:i:s');
   $update = $this->master_db->updateRecord('privacypolicy',$db,array('id'=>$id));
   if($update) {
      $this->session->set_flashdata('message','<div class="alert alert-success">Updated successfully</div>');
      redirect('privacy');
   }else {
      $this->session->set_flashdata('message','<div class="alert alert-danger">Error in updating</div>');
      redirect('privacy');
   }
  }

        /**** Cancellation *******/
  public function cancellationpolicy() {
    $this->data['cancellation'] = $this->master_db->getRecords('cancellation',['id'=>1],'*');
    $this->load->view('homepage/cancellation-policy',$this->data);
  }
  public function cancellationsave() {
   $id = 1;
   $about = trim($this->input->post('content'));
   $db['cdesc'] = $about;
   $db['modified_at'] = date('Y-m-d H:i:s');
   $update = $this->master_db->updateRecord('cancellation',$db,array('id'=>$id));
   if($update) {
      $this->session->set_flashdata('message','<div class="alert alert-success">Updated successfully</div>');
      redirect('cancellationpolicy');
   }else {
      $this->session->set_flashdata('message','<div class="alert alert-danger">Error in updating</div>');
      redirect('cancellationpolicy');
   }
  }
/******** Return policy *******/
public function returnpolicy() {
    $this->data['return'] = $this->master_db->getRecords('returnpolicy',['id'=>1],'*');
    $this->load->view('homepage/return-policy',$this->data);
  }
    public function returnpolicysave() {
   $id = 1;
   $about = trim($this->input->post('content'));
   $db['rdesp'] = $about;
   $db['created_at'] = date('Y-m-d H:i:s');
   $update = $this->master_db->updateRecord('returnpolicy',$db,array('id'=>$id));
   if($update) {
      $this->session->set_flashdata('message','<div class="alert alert-success">Updated successfully</div>');
      redirect('master/returnpolicy');
   }else {
      $this->session->set_flashdata('message','<div class="alert alert-danger">Error in updating</div>');
      redirect('master/returnpolicy');
   }
  }


       /**** Brochure *******/
  public function brochure() {
    $this->data['brochure'] = $this->master_db->getRecords('brochure',['id'=>1],'*');
    $this->load->view('homepage/brochure',$this->data);
  }
  public function brochuresave() {
   $id = 1;
            if(!empty($_FILES['file']['name'])) {
                        //unlink("$images");
                        $uploadPath = '../assets/brochure/';
                        $config['upload_path'] = $uploadPath;
                        $config['allowed_types'] = 'pdf';
                        $config['max_size']       = 2048;

                        
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if(!$this->upload->do_upload('file')){
                            $this->session->set_flashdata("message","<div class='alert alert-danger'>".$this->upload->display_errors()."</div>");
                                redirect('brochure');  
                        }else {
                            $upload_data = $this->upload->data();
                            $db['pdf'] =  'assets/brochure/'.$upload_data['file_name']; 
                        }
                    }
   $update = $this->master_db->updateRecord('brochure',$db,array('id'=>$id));
   if($update) {
      $this->session->set_flashdata('message','<div class="alert alert-success">Updated successfully</div>');
      redirect('brochure');
   }else {
      $this->session->set_flashdata('message','<div class="alert alert-danger">Error in updating</div>');
      redirect('brochure');
   }
  }


          /**** Contact us *******/
  public function contactus() {
    $this->data['contact'] = $this->master_db->getRecords('contactus',['id'=>1],'*');
    $this->load->view('homepage/contact-us',$this->data);
  }
  public function contactsave() {
   $id = 1;
   $email = trim($this->input->post('email'));
   $phone = trim($this->input->post('phone'));
   $address = trim($this->input->post('address'));
   $db['email'] = $email;
   $db['phone'] = $phone;
   $db['address'] = $address;
   $db['modified_at'] = date('Y-m-d H:i:s');
   $update = $this->master_db->updateRecord('contactus',$db,array('id'=>$id));
   if($update) {
      $this->session->set_flashdata('message','<div class="alert alert-success">Updated successfully</div>');
      redirect('contactus');
   }else {
      $this->session->set_flashdata('message','<div class="alert alert-danger">Error in updating</div>');
      redirect('contactus');
   }
  }

            /**** Social Links  *******/
  public function sociallinks() {
    $this->data['sociallinks'] = $this->master_db->getRecords('sociallinks',['id'=>1],'*');
    $this->load->view('homepage/sociallinks',$this->data);
  }
  public function sociallinksave() {
   $id = 1;
   $facebook = trim($this->input->post('facebook'));
   $twitter = trim($this->input->post('twitter'));
   $linkedin = trim($this->input->post('linkedin'));
   $instagram = trim($this->input->post('instagram'));
   $youtube = trim($this->input->post('youtube'));
   $db['facebook'] = $facebook;
   $db['twitter'] = $twitter;
   $db['linkedin'] = $linkedin;
   $db['instagram'] = $instagram;
   $db['modified_at'] = date('Y-m-d H:i:s');
   $db['youtube'] = $youtube;
   $update = $this->master_db->updateRecord('sociallinks',$db,array('id'=>$id));
   if($update) {
      $this->session->set_flashdata('message','<div class="alert alert-success">Updated successfully</div>');
      redirect('sociallinks');
   }else {
      $this->session->set_flashdata('message','<div class="alert alert-danger">Error in updating</div>');
      redirect('sociallinks');
   }
  }
  /****** Newsletter *****/
  public function newsletter() {
    $this->load->view('homepage/newsletter',$this->data);
  }
  public function getNewletter() {
     $where = "where status !=2";
            if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
                $where .= " and (email like '%$val%') ";
            }
            $order_by_arr[] = "email";
            $order_by_arr[] = "";
            $order_by_arr[] = "id";
            $order_by_def   = " order by id desc";
            $query = "select * from newsletter ".$where."";           
            $fetchdata = $this->home_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
            //echo $this->db->last_query();exit;
            $data = array();
            $i = $_POST["start"]+1;
            foreach ($fetchdata as $r) {
                $action ="";
                $sub_array = array();
               
             $sub_array[] = $i++;
         
             $sub_array[] = $r->email;
             $sub_array[] = date('d-m-Y',strtotime($r->created_at));
              $data[] = $sub_array;
            }
            $res    = $this->home_db->run_manual_query_result($query);
            $total  = count($res);
            $output = array(
              "draw"              =>  intval($_POST["draw"]),
              "recordsTotal"          => $total,  
              "recordsFiltered"     => $total,  
              "data"              =>  $data
            );
            $output['csrf_token'] = $this->security->get_csrf_hash();
        echo json_encode($output);
  }
}
?>