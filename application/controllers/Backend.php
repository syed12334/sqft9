<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend extends CI_Controller {
  protected $data;
      public function __construct() {
    parent::__construct();
        date_default_timezone_set("Asia/Kolkata");
    $this->load->helper('utility_helper');
        $this->load->model('master_db');   
        $this->load->model('home_db'); 
        $this->data['detail']="";
        $this->data['session'] = ADMIN_SESSION; 
        if (!$this->session->userdata($this->data['session'])) {
            redirect('Login', 'refresh');
        }else{
            $sessionval = $this->session->userdata($this->data['session']);
               // echo $pword;exit;
                $details = $this->home_db->getlogin($sessionval['email']);
               // echo $this->db->last_query();exit;
                if(count($details)){
                    $this->data['detail']=$details;
                }else{
                    $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">&times;</button>Invalid Credentials.</div>');
                    redirect(base_url()."login/logout");
                }
        } 
        $this->data['category'] = $this->master_db->getRecords('property_category',['status'=>0],'id,name','name asc');
        $this->data['header']=$this->load->view('admin/header', $this->data , TRUE);
        $this->data['footer']=$this->load->view('admin/footer', $this->data , TRUE);
  }
	public function index()
	{
  
		$this->load->view('admin/index',$this->data);
	}
	public function addsubscription() {
		$this->load->view('admin/add-subcription',$this->data);
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
	public function subscriptionList() {
		$this->load->view('admin/subscription-list',$this->data);
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
                 $action .= '<a href='.base_url()."admin/editpackage/".base64_encode($r->id)."".' title="Edit Details"  class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></a>&nbsp;';
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
                $action .= "<button title='Deactive' onclick='updateStatus(".$r->id.", -1)' class='btn btn-warning btn-sm'><i class='fas fa-times-circle'></i></button>&nbsp;";
            }else{
                $status = "<span class='text-warning'><i class='fas fa-times-circle'></i> In-Active</span>";
                $action .= "<button title='Activate' onclick='updateStatus(".$r->id.", 0)' class='btn btn-success btn-sm'><i class='fas fa-check'></i></button>&nbsp;";
            }
             $action .= "<button title='Delete' onclick='updateStatus(".$r->id.", 2)' class='btn btn-danger btn-sm'><i class='fas fa-trash'></i></button>&nbsp;";
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
        echo json_encode($output);
	}
	public function setSubscribeStatus() {
		$id = trim($this->input->post('id'));
        //echo "<pre>";print_r($_POST);exit;
        $status = trim($this->input->post('status'));
        if($status ==2) {
                $this->master_db->deleterecord('packages',['id'=>$id]);
             
               echo 1;
        }else if($status ==-1){
            $where_data = array(
            'status'=>$status,
            'modified_date'=>date('Y-m-d H:i:s'),
            
        );
        $this->master_db->updateRecord('packages',$where_data,array('id'=>$id));
        echo 1;
        }else  if($status ==0){
             $where_data = array(
            'status'=>$status,
            'modified_date'=>date('Y-m-d H:i:s'),
        );
        $this->master_db->updateRecord('packages',$where_data,array('id'=>$id));
        echo 1;
        }
	}
	public function editpackage() {
		$id =  base64_decode($this->uri->segment(3));
		$getPackage = $this->master_db->getRecords('packages',['id'=>$id],'*');
		//echo $this->db->last_query();exit;
		$this->data['package'] = $getPackage;
		$this->load->view('admin/add-subcription',$this->data);
	}
  public function myproperty() {
    $this->load->view('admin/my-listing',$this->data);
  }
}