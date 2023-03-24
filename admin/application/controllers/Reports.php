<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {
    protected $data;
      public function __construct() {
        date_default_timezone_set("Asia/Kolkata");
        parent::__construct();
        $this->load->helper('utility_helper');
        $this->load->model('master_db');   
        $this->load->model('home_db'); 
        $this->data['detail']="";
        $this->data['session'] = ADMIN_SESSION; 
         $this->load->library("excel");
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


    /***** Property Reports ******/
     public function propertyReports() {

        $this->data['propertytype'] = $this->master_db->getRecords('property_category',['status'=>0],'id,name','name asc');
        $this->load->view('reports/propertyreports',$this->data);
    }
    public function getPropertyreports() {
      //echo "<pre>";print_r($_POST);exit;
      $form = $this->input->post('form');
      $fdate = $form[0]['value']." 00:00:00";
      $tdate = $form[1]['value']." 23:59:59";
      $ptype = $form[2]['value'];
      //echo "<pre>";print_r($form[2]['value']);exit;

        $where = "where p.status !=2";
            if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
                $where .= " and (p.title like '%$val%') ";
                 $where .= " or (u.name like '%$val%') ";
                $where .= " or (u.email like '%$val%') ";
                $where .= " or (u.phone like '%$val%') ";
                $where .= " or (p.ownerrole like '%$val%') ";
                $where .= " or (p.ptype like '%$val%') ";
                $where .= " or (ot.name like '%$val%') ";
                $where .= " or (pc.name like '%$val%') ";
             
            }

            if(!empty($form[0]['value']) && !empty($form[1]['value'])) {
                 $where .= " and p.created_at between '".$fdate."' and '".$tdate."' ";
            }

            if(isset($ptype) && !empty($ptype)) {
                 $where .= " and p.ptype =".$ptype."";
            }
           
            $order_by_arr[] = "p.title";
            $order_by_arr[] = "";
            $order_by_arr[] = "p.id";
            $order_by_def   = " order by p.id desc";
            $query = "select p.title,pc.name as pname, ot.name as oname,p.ownerrole,p.created_at,p.ptype,u.name as cname,u.id as uid,p.pid from properties p left join users u on u.id =p.uid left join owner_type ot on ot.id = p.ownerrole left join property_category pc on pc.id =p.ptype ".$where." group by p.title";           
            $fetchdata = $this->home_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
            //echo $this->db->last_query();exit;
            $data = array();
            $i = $_POST["start"]+1;
            foreach ($fetchdata as $r) {
              $pid = $r->pid;

              $getUserpackage = $this->master_db->getRecords('packages',['id'=>$pid],'title,pprice');
              $title = [];$price = [];
              if(count($getUserpackage) >0) {
                foreach ($getUserpackage as $value) {
                  $title[] = $value->title;  
                  $price[] = $value->pprice;  
                }
              }
              $titlecomma = implode(",", $title);
              $pricecomma = implode(",", $price);
                $sub_array = array();
             $sub_array[] = $i++;
             $sub_array[] = "<div onclick='return viewCustomer(".$r->uid.")' style='cursor:pointer'>".ucfirst($r->cname)."</div>";
             $sub_array[] = $r->oname;
             $sub_array[] = $r->pname;
             $sub_array[] = $r->title;
             $sub_array[] = $titlecomma."(Rs. ".$pricecomma.")";
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
    public function exportpropertyreport() {
      //echo "<pre>";print_r($_GET);exit;
      $fdate = $this->input->get('fdate');
      $tdate = $this->input->get('tdate');
      $ptype = $this->input->get('ptype');
      $fdates = $fdate." 00:00:00";
      $tdates = $tdate." 23:59:59";
       $where = "where p.status !=2";
      if(!empty($fdate) && isset($fdate) && !empty($tdate) && isset($tdate)) {
        $where .= " and p.created_at between '".$fdates."' and '".$tdates."' ";
      }

       if(isset($ptype) && !empty($ptype)) {
                 $where .= " and p.ptype =".$ptype."";
            }

     $query = "select p.title,pc.name as pname, ot.name as oname,p.ownerrole,p.created_at,p.ptype,u.name as cname,p.pid from properties p left join users u on u.id =p.uid left join owner_type ot on ot.id = p.ownerrole left join property_category pc on pc.id =p.ptype ".$where." group by p.title"; 
        $arr = $this->master_db->sqlExecute($query);
         $count = 1;
        $table_columns = array("Sl No","Customer Name","Customer Role","Property Type","Package Name","Created Date");
        $count = 1;
      $object = new PHPExcel();
      $object->setActiveSheetIndex(0);
      $column = 0;
  foreach($table_columns as $field)
  {
   $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
   $column++;
  }

  $count_row = 2;

      foreach($arr as $r)
      {


$pid = $r->pid;

              $getUserpackage = $this->master_db->getRecords('packages',['id'=>$pid],'title,pprice');
              $title = [];$price =[];
              if(count($getUserpackage) >0) {
                foreach ($getUserpackage as $value) {
                  $title[] = $value->title;  
                  $price[] = $value->pprice;
                }
              }
              $titlecomma = implode(",", $title);
               $pricecomma = implode(",", $price);
     $role ="";$ptype = "";
                 
    
              
       $object->getActiveSheet()->setCellValueByColumnAndRow(0, $count_row, strval($count++));
       $object->getActiveSheet()->setCellValueByColumnAndRow(1, $count_row, $r->cname);
       $object->getActiveSheet()->setCellValueByColumnAndRow(2, $count_row,$r->oname);
       $object->getActiveSheet()->setCellValueByColumnAndRow(3, $count_row, $r->pname);
       $object->getActiveSheet()->setCellValueByColumnAndRow(4, $count_row, $titlecomma."(Rs. ".$pricecomma.")");
       $object->getActiveSheet()->setCellValueByColumnAndRow(5, $count_row, date('d-m-Y',strtotime($r->created_at)));
       $count_row++;
      }
      $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="Propertyreports.xls"');
      header('Cache-Control: max-age=0');
      ob_end_clean();
      $object_writer->save('php://output');

    }

    /***** Customer Reports ******/

     public function customerReports() {
      $this->load->view('reports/customerreports',$this->data);
    }

        public function getCustomersreports() {
    
      $form = $this->input->post('form');
      $fdate = $form[0]['value']." 00:00:00";
      $tdate = $form[1]['value']." 23:59:59";
      //echo "<pre>";print_r($tdate);exit;

        $where = "where u.status !=2";
            if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
                $where .= " and (u.name like '%$val%') ";
                $where .= " or (u.email like '%$val%') ";
                $where .= " or (u.phone like '%$val%') ";
                $where .= " or (u.created_at like '%$val%') ";
             
            }

            if(!empty($form[0]['value']) && !empty($form[1]['value'])) {
                 $where .= " and u.created_at between '".$fdate."' and '".$tdate."' ";
            }
           
            $order_by_arr[] = "u.name";
            $order_by_arr[] = "";
            $order_by_arr[] = "u.id";
            $order_by_def   = " order by u.id desc";
            $query = "select u.created_at,u.id as uid,u.name as cname,u.email,u.phone from  users u ".$where." group by u.name";           
            $fetchdata = $this->home_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
           // echo $this->db->last_query();exit;
            $data = array();
            $i = $_POST["start"]+1;
            foreach ($fetchdata as $r) {

              $uid = $r->uid;
              $getUserpackage = $this->master_db->sqlExecute('select p.title,p.pprice from user_package u left join packages p on p.id=u.pid where u.user_id='.$uid.'');
              $title = [];
              if(count($getUserpackage) >0) {
                foreach ($getUserpackage as $value) {

                  $title[] = $value->title."(Rs ".$value->pprice.")"; 
                 
                }
              }
              $titlecomma = implode(",", $title);
               $role ="";$ptype = "";
                $sub_array = array();
                 
              

               
           
             $sub_array[] = $i++;
             $sub_array[] = $r->cname;

             $sub_array[] = $r->phone;
             $sub_array[] = $r->email;
             $sub_array[] = $titlecomma;
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

        public function exportcustomerreport() {
      //echo "<pre>";print_r($_POST);exit;
      $fdate = $this->input->get('fdate');
      $tdate = $this->input->get('tdate');
      $fdates = $fdate." 00:00:00";
      $tdates = $tdate." 23:59:59";
       $where = "where u.status !=2";
      if(!empty($fdate) && isset($fdate) && !empty($tdate) && isset($tdate)) {
        $where .= " and u.created_at between '".$fdates."' and '".$tdates."' ";
      }

       $query = "select u.created_at,u.id as uid,u.name as cname,u.email,u.phone from  users u ".$where." group by u.name";
        $arr = $this->master_db->sqlExecute($query);
        $table_columns = array("Sl No","Customer Name","Mobile Number","Email","Package Taken", "Created Date");
     
         
       
  $object = new PHPExcel();

  $object->setActiveSheetIndex(0);
  $column = 0;
  foreach($table_columns as $field)
  {
   $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
   $column++;
  }

  $count_row = 2;
  $count = 1;
      foreach($arr as $r)
      {
        $uid = $r->uid;
             $getUserpackage = $this->master_db->sqlExecute('select p.title,p.pprice from user_package u left join packages p on p.id=u.pid where u.user_id='.$uid.'');
              $title = [];
              if(count($getUserpackage) >0) {
                foreach ($getUserpackage as $value) {
                   $title[] = $value->title."(Rs ".$value->pprice.")"; 
                }
              }
              $titlecomma = implode(",", $title);
            $data[] = array(strval($count),$r->cname,$r->phone,$r->email,$titlecomma,date('d-m-Y',strtotime($r->created_at)));
       $object->getActiveSheet()->setCellValueByColumnAndRow(0, $count_row, strval($count++));
       $object->getActiveSheet()->setCellValueByColumnAndRow(1, $count_row, $r->cname);
       $object->getActiveSheet()->setCellValueByColumnAndRow(2, $count_row, $r->phone);
       $object->getActiveSheet()->setCellValueByColumnAndRow(3, $count_row, $r->email);
       $object->getActiveSheet()->setCellValueByColumnAndRow(4, $count_row, $titlecomma,date('d-m-Y',strtotime($r->created_at)));
        $object->getActiveSheet()->setCellValueByColumnAndRow(5, $count_row, date('d-m-Y',strtotime($r->created_at)));
       $count_row++;
      }

      $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="Customerreports.xls"');
      header('Cache-Control: max-age=0');
      ob_end_clean();
      $object_writer->save('php://output');
    }


    /***** Customer Review Reports ******/
     public function customerreviewReport() {
       $this->load->view('reports/customerreviewreport',$this->data);
    }

    public function customerreviewsexport() {
         $form = $this->input->post('form');
      $fdate = $form[0]['value']." 00:00:00";
      $tdate = $form[1]['value']." 23:59:59";
      //echo "<pre>";print_r($tdate);exit;

        $where = "where pr.status !=2";
            if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
                $where .= " and (p.title like '%$val%') ";
                $where .= " or (u.name like '%$val%') ";
                $where .= " or (u.email like '%$val%') ";
                $where .= " or (u.phone like '%$val%') ";
             
            }

            if(!empty($form[0]['value']) && !empty($form[1]['value'])) {
                 $where .= " and pr.created_at between '".$fdate."' and '".$tdate."' ";
            }
           
            $order_by_arr[] = "p.title";
       
            $order_by_arr[] = "p.id";
            $order_by_def   = " order by pr.id desc";
            $query = "select u.name as cname,p.oname,p.title,pr.created_at,u.id as uid,pr.reviews,pr.id as prid,pr.status from  property_review pr left join properties p on p.id=pr.prid left join users u on u.id =pr.uid  $where ";           
            $result = $this->home_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
            // echo $this->db->last_query();exit;
            $action  ="";
            $rowarr = array();
            $cr = $_POST["start"]+1;
            foreach($result as $r) {
               $new_array = array();
               $action = "";
                      if( (int)$r->status == -1 ){
                $action .= "<button title='Publish' class='btns' onclick='publishReview(".$r->prid.",0)' ><i class='fas fa-ban'></i></button>&nbsp;";
            }else{
                $action .= "<button title='Un Publish' class='btns'  onclick='publishReview(".$r->prid.", -1)' ><i class='fas fa-check-circle'></i></button>&nbsp;";
            }
             $new_array[] = $cr++;
             $new_array[] = $action;
             $new_array[] = $r->uid;
             $new_array[] = "<div onclick='return viewCustomer(".$r->uid.")' style='cursor:pointer'>".ucfirst($r->cname)."</div>";
             $new_array[] = $r->title;
             $new_array[] = $r->oname;
             $new_array[] = $r->reviews;
             $new_array[] = date('d-m-Y',strtotime($r->created_at));
              $rowarr[] = $new_array;
            }

            $creviews    = $this->home_db->run_manual_query_result($query);
        $total  = count($creviews);
        $output = array(
            "draw"              =>  intval($_POST["draw"]),
             "recordsTotal"          => $total,  
                "recordsFiltered"     => $total,  
            "data"              =>  $rowarr
        );
        $output['csrf_token'] = $this->security->get_csrf_hash();
        echo json_encode($output);
    }

     function exportcustomerreviewreport()
 {
  //echo "<pre>";print_r($_GET);exit;
      $fdate = $this->input->get('fdate');
      $tdate = $this->input->get('tdate');
      $fdates = $fdate." 00:00:00";
      $tdates = $tdate." 23:59:59";
       $where = "where p.status !=2";
      if(!empty($fdate) && isset($fdate) && !empty($tdate) && isset($tdate)) {
        $where .= " and pr.created_at between '".$fdates."' and '".$tdates."' ";
      }
      $query = "select u.name as cname,p.oname,p.title,pr.created_at,u.id as uid,pr.reviews from  property_review pr left join properties p on p.id=pr.prid left join users u on u.id =p.uid  $where ";  
      $arr = $this->master_db->sqlExecute($query);
      //echo $this->db->last_query();exit;
      $count = 1;
      $table_columns = array("Sl No","Customer ID","Customer Name","Property Name","Property Owner","Reviews", "Created Date");
      $object = new PHPExcel();
      $object->setActiveSheetIndex(0);
      $column = 0;
      foreach($table_columns as $field)
      {
       $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
       $column++;
      }
      $count_row = 2;
      foreach($arr as $r)
      {    
       $object->getActiveSheet()->setCellValueByColumnAndRow(0, $count_row, strval($count++));
       $object->getActiveSheet()->setCellValueByColumnAndRow(1, $count_row, $r->uid);
       $object->getActiveSheet()->setCellValueByColumnAndRow(2, $count_row, $r->cname);
       $object->getActiveSheet()->setCellValueByColumnAndRow(3, $count_row, $r->title);
       $object->getActiveSheet()->setCellValueByColumnAndRow(4, $count_row, $r->oname);
       $object->getActiveSheet()->setCellValueByColumnAndRow(5, $count_row, $r->reviews);
       $object->getActiveSheet()->setCellValueByColumnAndRow(6, $count_row, date('d-m-Y',strtotime($r->created_at)));
       $count_row++;
      }
      $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="Customerreviewsexport.xls"');
      header('Cache-Control: max-age=0');
      ob_end_clean();
      $object_writer->save('php://output');
 }

  /***** Revenue Reports ******/
    public function revenueReports() {
      $this->data['reportstotal'] = $this->master_db->getRecords('packages',['status !='=>2],'*');
      $this->data['state'] = $this->master_db->getRecords('states',['status'=>0],'*','name asc');
      $package = $this->master_db->sqlExecute('select pid from user_package group by pid');
      $ar = [];
      foreach ($package as $key => $value) {
       $ar[] = $value->pid;
      }
      $im = implode(",", $ar);
      $this->data['unsubscribed'] = $this->master_db->sqlExecute("select * from user_package p where p.pid not in ('".$im."') ");
      //echo $this->db->last_query();exit;
      $this->load->view('reports/revenueReports',$this->data);
    }
    public function getrevenuereports() {
      //echo "<pre>";print_r($_POST);exit;
      $form = $this->input->post('form');
      $fdate = $form[0]['value'];
      $tdate = $form[1]['value'];
      $ptype = $form[2]['value'];
        $where = "where p.status !=2";
            if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
                $where .= " and (p.title like '%$val%') ";
                $where .= " or (p.pprice like '%$val%') ";
                $where .= " or (p.nmonths like '%$val%') ";
                $where .= " or (p.nproperties like '%$val%') ";
            }
            if(!empty($form[0]['value']) && !empty($form[1]['value'])) {
                 $where .= " and up.created_at between '".$fdate."' and '".$tdate."' ";
            }

            if(isset($ptype) && !empty($ptype)) {
                 $where .= " and p.id =".$ptype."";
            }
            $order_by_arr[] = "p.title";
            $order_by_arr[] = "";
            $order_by_arr[] = "p.id";
            $order_by_def   = " order by p.id desc";
            $query = "select p.id,p.title,p.pprice,up.created_at,up.pid  from user_package up left join packages p on p.id = up.pid  ".$where." group by up.pid";           
            $fetchdata = $this->home_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
            //echo $this->db->last_query();exit;
            $data = array();
            $i = $_POST["start"]+1;
            $total_order = 0;
            foreach($fetchdata as $key => $row) {
              $id = $row->id;
              $properties = $this->master_db->getRecords('properties',['pid'=>$id],'*');
              $owner = $this->master_db->getRecords('user_package',['pid'=>$id],'*');
             // echo $this->db->last_query();

              $count = "";
           if(!empty($properties) && $properties !="0") {
              $count .=count($properties);
           }
           if(!empty($owner) && $owner !="0") {
            $count .=count($owner);
           }else {
            $count .="0";
           }
           $revenueGen = (int)$row->pprice * (int)count($owner);
           $revenue ="";
           if(!empty($revenueGen) && $revenueGen !="0") {
              $revenue .="<i class='fa fa-rupee-sign'></i> ".number_format((int)$row->pprice * (int)count($owner));
           }else {
             $revenue .="<i class='fa fa-rupee-sign'></i> "."0";
           }
           $totalam = (int)$row->pprice * (int)count($owner);
           $total_order = $total_order + floatval($totalam);
           $sub_array = array();
             $sub_array[] = $i++;
             $sub_array[] = $row->title." (Rs. ".$row->pprice.")";
             $sub_array[] = count($owner);
            $sub_array[] = $revenue;
             $sub_array[] = date('d-m-Y',strtotime($row->created_at));
              $data[] = $sub_array;
            }
            $res    = $this->home_db->run_manual_query_result($query);
            //echo $this->db->last_query();exit();
        $total  = count($res);
        //echo $total;exit;
        $output = array(
            "draw"              =>  intval($_POST["draw"]),
             "recordsTotal"          => $total,  
            "recordsFiltered"     => $total,  
            "data"              =>  $data,
            'total'    => number_format($total_order, 2)
        );
        $output['csrf_token'] = $this->security->get_csrf_hash();
        //echo "<pre>";print_r($output);exit;
        echo json_encode($output);
    }

    public function exportrevenuereport() {
      $fdate = $this->input->get('fdate');
      $tdate = $this->input->get('tdate');
      $ptype = $this->input->get('ptype');
      $fdates = $fdate;
      $tdates = $tdate;
       $where = "where p.status !=2";
        if(!empty($fdate) && !empty($tdate)) {
                 $where .= " and up.created_at between '".$fdates."' and '".$tdates."' ";
            }

            if(isset($ptype) && !empty($ptype)) {
                 $where .= " and p.id =".$ptype."";
            }
        $query = "select p.id,p.title,p.pprice,up.created_at,up.pid  from user_package up left join packages p on p.id = up.pid  ".$where." group by up.pid ";
        $arr = $this->master_db->sqlExecute($query);
       // echo $this->db->last_query();exit;
         $count = 1;
         
        $table_columns = array("Sl No","Package Name","Total Customer Subscribed","Revenue", "Package Created Date","Total Revenue");
       
  $object = new PHPExcel();

  $object->setActiveSheetIndex(0);
  $column = 0;
  foreach($table_columns as $field)
  {
   $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
   $column++;
  }

  $count_row = 2;

      foreach($arr as $r)
      {

         $id = $r->id;
                  $properties = $this->master_db->getRecords('properties',['pid'=>$id],'*');
                  $owner = $this->master_db->getRecords('user_package',['pid'=>$id],'*');
                 // echo $this->db->last_query();

                  $countres = "";
               if(!empty($properties) && $properties !="0") {
                  $countres .=count($properties);
               }

               if(!empty($owner) && $owner !="0") {
                $countres .=count($owner);
               }
               $revenueGen = (int)$r->pprice * (int)count($owner);
               $revenue ="";

               if(!empty($revenueGen) && $revenueGen !="0") {
                  $revenue .="Rs. ".number_format((int)$r->pprice * (int)count($owner));
               }
               $totalRevenue[] = (int)$r->pprice * (int)count($owner);
              
       $object->getActiveSheet()->setCellValueByColumnAndRow(0, $count_row, strval($count++));
       $object->getActiveSheet()->setCellValueByColumnAndRow(1, $count_row, $r->title." (Rs. ".$r->pprice.")");
       $object->getActiveSheet()->setCellValueByColumnAndRow(2, $count_row, $countres);
       $object->getActiveSheet()->setCellValueByColumnAndRow(3, $count_row, $revenue);
       $object->getActiveSheet()->setCellValueByColumnAndRow(4, $count_row, date('d-m-Y',strtotime($r->created_at)));
       $count_row++;
      }
      $object->getActiveSheet()->setCellValueByColumnAndRow(5, 2, "Rs.".number_format(array_sum($totalRevenue)));

      $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="Revenuereports.xls"');
      header('Cache-Control: max-age=0');
      ob_end_clean();
      $object_writer->save('php://output');
    }


    public function expiryreports() {
      $this->load->view('reports/expiryreports',$this->data);
    }
    public function getexpiryreports() {
      $cdate = date('Y-m-d');
      $form = $this->input->post('form');
      $fdate = $form[0]['value']." 00:00:00";
      $tdate = $form[1]['value']." 23:59:59";
        $where = "where u.status !=2 and up.expire_date <= '".$cdate."' ";
            if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
                $where .= " and (u.name like '%$val%') ";
                $where .= " or (up.expire_date like '%$val%') ";
                $where .= " or (p.pprice like '%$val%') ";
                $where .= " or (p.title like '%$val%') ";
            }
            if(!empty($form[0]['value']) && !empty($form[1]['value'])) {
                 $where .= " and u.created_at between '".$fdate."' and '".$tdate."' ";
            }
            $order_by_arr[] = "u.name";
            $order_by_arr[] = "";
            $order_by_arr[] = "u.id";
            $order_by_def   = " order by u.id desc";
            $query = "select u.name,p.title,up.expire_date,p.pprice,u.id as uid from users u left join user_package up on up.user_id = u.id left join packages p on p.id=up.pid ".$where."";           
            $fetchdata = $this->home_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
           // echo $this->db->last_query();exit;
            $data = array();
            $i = $_POST["start"]+1;
            foreach($fetchdata as $key => $row) {
   
          $expiry ="";
          if(!empty($row->expire_date) && $row->expire_date !="") {
            $expiry .=date('d-m-Y',strtotime($row->expire_date));
          }
    
           $sub_array = array();
             $sub_array[] = $i++;
             $sub_array[] = "<div onclick='return viewCustomer(".$row->uid.")' style='cursor:pointer'>".ucfirst($row->name)."</div>";

             $sub_array[] = $row->title."(Rs. ".$row->pprice.")";
             $sub_array[] =$expiry;
              $data[] = $sub_array;
            }

            $res    = $this->home_db->run_manual_query_result($query);
        $total  = count($res);
        //echo $total;exit;
        $output = array(
            "draw"              =>  intval($_POST["draw"]),
             "recordsTotal"          => $total,  
                "recordsFiltered"     => $total,  
            "data"              =>  $data
        );
        $output['csrf_token'] = $this->security->get_csrf_hash();
        echo json_encode($output);
    }

    public function exportexpirereport() {
        

$cdate = date('Y-m-d');
  
      //echo "<pre>";print_r($_POST);exit;
      $fdate = $this->input->get('fdate');
      $tdate = $this->input->get('tdate');
      $fdates = $fdate." 00:00:00";
      $tdates = $tdate." 23:59:59";
       $where = "where u.status !=2 and up.expire_date <= '".$cdate."'";
      if(!empty($fdate) && !empty($tdate)) {
                 $where .= " and u.created_at between '".$fdates."' and '".$tdates."' ";
            }
$query = "select u.name,p.title,up.expire_date,p.pprice from users u left join user_package up on up.user_id = u.id left join packages p on p.id=up.pid ".$where."";
        $arr = $this->master_db->sqlExecute($query);
        $table_columns =array("Sl No","Customer Name","Package Name", "Expire Date");


         $count = 1;
        
       
  $object = new PHPExcel();

  $object->setActiveSheetIndex(0);
  $column = 0;
  foreach($table_columns as $field)
  {
   $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
   $column++;
  }

  $count_row = 2;

      foreach($arr as $r)
      {

         $expiry ="";
          if(!empty($r->expire_date) && $r->expire_date !="") {
            $expiry .=date('d-m-Y',strtotime($r->expire_date));
          }
              
       $object->getActiveSheet()->setCellValueByColumnAndRow(0, $count_row, strval($count++));
       $object->getActiveSheet()->setCellValueByColumnAndRow(1, $count_row, $r->name);
       $object->getActiveSheet()->setCellValueByColumnAndRow(2, $count_row, $r->title."(Rs. ".$r->pprice.")");
       $object->getActiveSheet()->setCellValueByColumnAndRow(3, $count_row, $expiry);
       $count_row++;
      }

      $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="Expiryreports.xls"');
      header('Cache-Control: max-age=0');
      ob_end_clean();
      $object_writer->save('php://output');
     
    }

    public function getTotalrevenue() {
     // echo "<pre>";print_r($_POST);exit;
      $where = "where status !=2";
      $fdate = $this->input->post('fdate');
      $tdate = $this->input->post('tdate');
      $ptype = $this->input->post('ptype');

      $fdates = $fdate." 00:00:00";
      $tdates = $tdate." 23:59:59";

       if(!empty($fdate) && !empty($tdate)) {
                 $where .= " and created_date between '".$fdates."' and '".$tdates."' ";
            }
 if(isset($ptype) && !empty($ptype)) {
                 $where .= " and id =".$ptype."";
            }
            $query = "select * from packages ".$where."";
        $arr = $this->master_db->sqlExecute($query);
        $totalRevenue=[];
          foreach($arr as $r)
      {

         $id = $r->id;
                  $properties = $this->master_db->getRecords('properties',['pid'=>$id],'*');
                  $owner = $this->master_db->getRecords('owner_address',['pid'=>$id],'*');
                 // echo $this->db->last_query();

                  $countres = "";
               if(!empty($properties) && $properties !="0") {
                  $countres .=count($properties);
               }

               if(!empty($owner) && $owner !="0") {
                $countres .=count($owner);
               }
               $revenueGen = (int)$r->pprice * (int)$countres;
               $revenue ="";

               if(!empty($revenueGen) && $revenueGen !="0") {
                  $revenue .="Rs. ".number_format((int)$r->pprice * (int)$countres);
               }
               $totalRevenue[] = (int)$r->pprice * (int)$countres;
      }
      echo json_encode(['status'=>true,'total'=>number_format(array_sum($totalRevenue)),'csrf_token' => $this->security->get_csrf_hash()]);
    }
    /** Get Visitors */
    public function visitors() {
      $this->load->view('reports/visitors',$this->data);
    }

    public function getVisitors() {
        $where = "where status !=2";
            if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
                $where .= " and (ip like '%$val%') ";
                $where .= " or (vcount like '%$val%') ";
            }
            $order_by_arr[] = "ip";
            $order_by_arr[] = "";
            $order_by_arr[] = "id";
            $order_by_def   = " order by id desc";
            $query = "select ip,vcount,created_at from ip_address ".$where."";           
            $fetchdata = $this->home_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
           // echo $this->db->last_query();exit;
            $data = array();
            $i = $_POST["start"]+1;
            foreach($fetchdata as $key => $row) {
                $sub_array = array();
                $sub_array[] = $i++;
                $sub_array[] = $row->ip;
                $sub_array[] =$row->vcount;
                $sub_array[] =date('d-m-Y',strtotime($row->created_at));
                $data[] = $sub_array;
            }

            $res    = $this->home_db->run_manual_query_result($query);
        $total  = count($res);
        //echo $total;exit;
        $output = array(
            "draw"              =>  intval($_POST["draw"]),
             "recordsTotal"          => $total,  
                "recordsFiltered"     => $total,  
            "data"              =>  $data
        );
        $output['csrf_token'] = $this->security->get_csrf_hash();
        echo json_encode($output);
    }
    /** Zone wise rreport **/
    public function zonewisereport() {
      $this->data['reportstotal'] = $this->master_db->getRecords('packages',['status !='=>2],'*');
      $this->data['state'] = $this->master_db->getRecords('states',['status'=>0],'*','name asc');
      $this->data['totalRevenue'] = $this->master_db->sqlExecute('select p.pprice from users u left join user_package up on up.user_id = u.id left join packages p on p.id = up.pid left join states s on s.id = u.state_id where u.status !=2 group by u.name');
      $this->load->view('reports/zonewisereport',$this->data);
    }

    public function getzonewiseports() {
     // echo "<pre>";print_r($_POST);exit;
      $form = $this->input->post('form');
      $fdate = $form[0]['value']." 00:00:00";
      $tdate = $form[1]['value']." 23:59:59";
      $ptype = $form[2]['value'];
      $state = $form[3]['value'];
        $where = "where u.status !=2";
            if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
                $where .= " and (u.name like '%$val%') ";
                $where .= " or (p.title like '%$val%') ";
                $where .= " or (u.created_at like '%$val%') ";
                $where .= " or (p.pprice like '%$val%') ";
                $where .= " or (s.name like '%$val%') ";
            }
            if(!empty($form[0]['value']) && !empty($form[1]['value'])) {
                 $where .= " and u.created_at between '".$fdate."' and '".$tdate."' ";
            }
            if(isset($state) && !empty($state)) {
                 $where .= " and u.state_id =".$state."";
            }

            if(isset($ptype) && !empty($ptype)) {
                 $where .= " and up.pid =".$ptype."";
            }
            $order_by_arr[] = "u.title";
            $order_by_arr[] = "";
            $order_by_arr[] = "u.id";
            $order_by_def   = " order by u.id desc";
            $query = "select u.name,p.title,p.pprice,u.created_at,s.name as sname,u.id as uid from users u left join user_package up on up.user_id = u.id left join packages p on p.id = up.pid left join states s on s.id = u.state_id ".$where." group by u.name";           
            $fetchdata = $this->home_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
            //echo $this->db->last_query();exit;
            $data = array();
            $i = $_POST["start"]+1;
            $total_order = 0;
            foreach($fetchdata as $key => $row) {
              
             // echo $this->db->last_query();

              $count = "";$price ="";

              if(!empty($row->pprice)) {
                $price .=("Rs. ".$row->pprice);
              }else {
               
              }
         $totalam = (int)$row->pprice;
           $total_order = $total_order + floatval($totalam);
           $sub_array = array();
             $sub_array[] = $i++;
             $sub_array[] ="<div onclick='return viewCustomer(".$row->uid.")' style='cursor:pointer'>".ucfirst( $row->name)."</div>";
             $sub_array[] = $row->title. $price;
             $sub_array[] = $row->sname;
            $sub_array[] = $price;
             $sub_array[] = date('d-m-Y',strtotime($row->created_at));
              $data[] = $sub_array;
            }
            $res    = $this->home_db->run_manual_query_result($query);

            //echo $this->db->last_query();exit();
        $total  = count($res);
        //echo $total;exit;
        $output = array(
            "draw"              =>  intval($_POST["draw"]),
             "recordsTotal"          => $total,  
            "recordsFiltered"     => $total,  
            "data"              =>  $data,
            "total"            =>number_format($total_order,2)
        );
        $output['csrf_token'] = $this->security->get_csrf_hash();
        //echo "<pre>";print_r($output);exit;
        echo json_encode($output);
    }
    public function getTotalzonewise() {
      //echo "<pre>";print_r($_POST);exit;

       $fdate = $this->input->post('fdate');
      $tdate = $this->input->post('tdate');
      $ptype = $this->input->post('ptype');
      $state = $this->input->post('state');
      $fdates = $fdate." 00:00:00";
      $tdates = $tdate." 23:59:59";
       $where = "where u.status !=2";


          if(!empty($fdate) && !empty($tdate)) {
                 $where .= " and u.created_at between '".$fdates."' and '".$tdates."' ";
            }
            if(isset($state) && !empty($state)) {
                 $where .= " and u.state_id =".$state."";
            }

            if(isset($ptype) && !empty($ptype)) {
                 $where .= " and p.id =".$ptype."";
            }
        $query = "select p.pprice from users u left join user_package up on up.user_id = u.id left join packages p on p.id = up.pid left join states s on s.id = u.state_id ".$where." group by u.name";
        $arr = $this->master_db->sqlExecute($query);

        $totalRevenue =[];
        foreach ($arr as $key => $value) {
            $totalRevenue[] = $value->pprice;
        }
         echo json_encode(['status'=>true,'total'=>number_format(array_sum($totalRevenue)),'csrf_token'=>$this->security->get_csrf_hash()]);
    }
    public function exportzonewisereport() {
      $cdate = date('Y-m-d');
  
      //echo "<pre>";print_r($_GET);exit;
      $fdate = $this->input->get('fdate');
      $tdate = $this->input->get('tdate');
      $ptype = $this->input->get('ptype');
      $state = $this->input->get('state');
      $fdates = $fdate." 00:00:00";
      $tdates = $tdate." 23:59:59";
       $where = "where u.status !=2";


          if(!empty($fdate) && !empty($tdate)) {
                 $where .= " and u.created_at between '".$fdates."' and '".$tdates."' ";
            }
            if(isset($state) && !empty($state)) {
                 $where .= " and u.state_id =".$state."";
            }

            if(isset($ptype) && !empty($ptype)) {
                 $where .= " and up.pid =".$ptype."";
            }
        $query = "select u.name,p.title,p.pprice,u.created_at,s.name as sname from users u left join user_package up on up.user_id = u.id left join packages p on p.id = up.pid left join states s on s.id = u.state_id ".$where." group by u.name";
        $arr = $this->master_db->sqlExecute($query);
        $table_columns =array("Sl No","Username","Package Name", "State","Amount","Created On","Total Revenue");


         $count = 1;
        
       
  $object = new PHPExcel();

  $object->setActiveSheetIndex(0);
  $column = 0;
  foreach($table_columns as $field)
  {
   $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
   $column++;
  }

  $count_row = 2;

  $totalRevenue =[];
      foreach($arr as $r)
      {

       $revenue ="";

               if(!empty($revenueGen) && $revenueGen !="0") {
                  $revenue .="Rs. ".number_format((int)$r->pprice * (int)$countres);
               }
               $totalRevenue[] = (int)$r->pprice;
              
       $object->getActiveSheet()->setCellValueByColumnAndRow(0, $count_row, strval($count++));
       $object->getActiveSheet()->setCellValueByColumnAndRow(1, $count_row, $r->name);
       $object->getActiveSheet()->setCellValueByColumnAndRow(2, $count_row, $r->title."(Rs. ".$r->pprice.")");
$object->getActiveSheet()->setCellValueByColumnAndRow(3, $count_row, $r->sname);
       $object->getActiveSheet()->setCellValueByColumnAndRow(4, $count_row, "Rs.".$r->pprice);
       $object->getActiveSheet()->setCellValueByColumnAndRow(5, $count_row,date('d-m-Y',strtotime($r->created_at)));
       $count_row++;
      }
$object->getActiveSheet()->setCellValueByColumnAndRow(6, 2, "Rs.".number_format(array_sum($totalRevenue)));
      $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="Zonewisereport.xls"');
      header('Cache-Control: max-age=0');
      ob_end_clean();
      $object_writer->save('php://output');
    }

    public function viewcontacts() {
    	//echo "<pre>";print_r($_POST);exit;
    	$id = $this->input->post('id');
    	$token = $this->security->get_csrf_hash();
    	$getUsers = $this->master_db->getRecords('users',['id'=>$id],'name,email,phone,address');
    	//echo $this->db->last_query();exit;
    	if(is_array($getUsers) && count($getUsers) >0) {
    		foreach ($getUsers as $key => $value) {
    			$name = "<h4>Name : ".$value->name."</h4>";
    			$name .= "<h4>Email : ".$value->email."</h4>";
    			$name .= "<h4>Phone : ".$value->phone."</h4>";
    			$name .= "<h4>Address : ".$value->address."</h4>";
    			echo json_encode(['status'=>true,'res'=>$name,"csrf_token"=>$token]);
    		}
    		
    	}else {
    		echo json_encode(['status'=>false,'res'=>"","csrf_token"=>$token]);
    	}
    }
    public function publishReviews() {
      $id = trim($this->input->post('id'));
      $status = trim($this->input->post('status'));

      $db['status'] = $status;
      $db['modified_at'] = date('Y-m-d H:i:s');
      $update = $this->master_db->updateRecord('property_review',$db,['id'=>$id]);
      if($update) {
        echo json_encode(['status'=>true]);
      }else {
        echo json_encode(['status'=>false]);
      }
    }
}
