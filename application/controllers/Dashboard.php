<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
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
        $this->data['contact'] = $this->master_db->getRecords('contactus',['status'=>0],'*','id desc');
        $this->data['category'] = $this->master_db->getRecords('property_category',['status'=>0],'id,name','name asc');
        $this->data['header']=$this->load->view('includes/header', $this->data , TRUE);
        $this->data['footer']=$this->load->view('includes/footer', $this->data , TRUE);
	}
    public function index() {
       
        $det = $this->data['detail'];
        $id = $det[0]->id;
        $userPackage = $this->master_db->getRecords('user_package',['user_id'=>$id],'id,properties');
        $this->data['popularplaces'] = $this->master_db->getRecords('properties',['publish '=>0,'pplaces'=>1],'id,title,slug','id desc','','','8');
        $this->data['featureproperties'] = $this->master_db->getRecords('properties',['publish '=>0,'pfeature'=>1],'id,title,slug,paddress,bedrooms,bathrooms,area,price,balcony,pid,videotype,video_path,face,ptype','id desc','','','4');
        $this->data['pcategory'] = $this->master_db->getRecords('property_category',['status'=>0],'id,name','name asc');
             $this->data['ptype'] = $this->master_db->getRecords('property_type',['status'=>0],'id,name','id asc');
             $this->data['testimonials'] = $this->master_db->getRecords('testimonials',['status'=>0],'*','id desc');
             $this->data['partners'] = $this->master_db->getRecords('partners',['status'=>0],'*','id desc');

        $this->data['popularproperties'] = $this->master_db->getRecords('properties',['publish '=>0,'ppopular'=>1],'id,title,slug,paddress,bedrooms,bathrooms,area,price,balcony,pid,videotype,video_path,face,ptype','id desc');

        //echo $this->db->last_query();exit;
        $this->load->view('admin/homepage',$this->data);
    }
    public function addproperty() {
    	$this->load->view('admin/add-property',$this->data);
    }
    public function propertyview() {
        $det = $this->data['detail'];
        $uid = $det[0]->id;
        $slug = $this->uri->segment(2);
       
         //echo $this->db->last_query();exit;
        if(!empty( $slug) &&  $slug !='') {
             $this->data['pcategory'] = $this->master_db->getRecords('property_category',['status'=>0],'id,name','name asc');
             $this->data['ptype'] = $this->master_db->getRecords('property_type',['status'=>0],'id,name','id asc');
        $getProperty  =  $this->master_db->getRecords('properties',['slug'=>$slug],'*');

        if(count($getProperty) >0 && isset($getProperty)) {
                $recentProperty  =  $this->master_db->getRecords('properties',['slug !='=>$slug,'publish'=>0],'id,title,price,slug,area','id desc','',"",'3');
        //echo $this->db->last_query();exit;
        $getRentcountinsert = $this->master_db->getRecords('contact_count',['pid'=>$getProperty[0]->pid,'uid'=>$uid,'prid'=>$getProperty[0]->id],'*');
        //echo $this->db->last_query();exit;
        $getRentcount = $this->master_db->getRecords('owner_address',['uid'=>$uid],'*');
        //echo $this->db->last_query();exit;
        $getowneraddress = $this->master_db->getRecords('owner_address',['uid'=>$uid,'prid'=>$getProperty[0]->id],'*');
        //echo $this->db->last_query();exit;
        $userPackage = $this->master_db->sqlExecute('select id,properties,pid,expire_date from  user_package where user_id='.$uid.' and pid in (2,13) order by id desc');
       // echo $this->db->last_query();exit;
        $reviews = $this->master_db->getRecords('property_review',['prid'=>$getProperty[0]->id,'status'=>0],'id,rating,reviews,name,created_at');
        //echo $this->db->last_query();exit;
        $usersList = $this->master_db->getRecords('users',['id'=>$uid],'name,id');
        $atype = $this->master_db->getRecords('apartmenttype',['id'=>$getProperty[0]->atype],'id,name');
        $cperiod = $this->master_db->getRecords('cperiod',['id'=>$getProperty[0]->cperiod],'id,cperiod');
         $area = $this->master_db->getRecords('area',['id'=>$getProperty[0]->areaid],'id,areaname');
       // echo $this->db->last_query();exit;
         $ar = [];$uids=[];
        if(count($userPackage) >0) {
                foreach ($userPackage as $key => $value) {
                    $ar[] = $value->properties;
                    $uids[]=$value->pid;
                }
        }
        $uidin = implode(",", $uids);
        $this->data['property'] =  $getProperty;
        $this->data['userPackage'] =  $userPackage;
        $this->data['userList'] =  $usersList;
        $this->data['reviews'] =  $reviews;
        $this->data['recentProperty'] =  $recentProperty;
        $this->data['propertyPackcount'] =  $getRentcount;
        $this->data['atype'] =  $atype;
        $this->data['area'] =  $area;
        $this->data['cperiod'] =  $cperiod;
        $this->data['packagetype'] = $this->master_db->getRecords('packages',['id'=>$getProperty[0]->pid],'type');
         $this->data['similar'] = $this->master_db->getRecords('properties',['id !='=>$getProperty[0]->id,'publish'=>0],'id,title,slug,paddress,bedrooms,bathrooms,area,price,balcony,pid,videotype,video_path,face,ptype','id desc','id','','3');
            if(count($getRentcountinsert) >0) {
            }else {
                $db['pid'] = $getProperty[0]->pid;
                $db['uid'] =$uid;
                $db['prid'] = $getProperty[0]->id;
                $db['cid'] = 1;
                $db['status'] = 0;
                $db['created_at'] = date('Y-m-d H:i:s');
                $this->master_db->insertRecord('contact_count',$db);
            }
                if(count($getRentcount)  >=  array_sum($ar)) {
                   
                }else {
                     if(count($getowneraddress)>0) {
                    }else { 
                        $dbs['uid'] =$uid;
                        $dbs['prid'] = $getProperty[0]->id;
                         $dbs['pid'] = $uidin;
                        $dbs['status'] = 0;
                        $dbs['created_at'] = date('Y-m-d H:i:s');
                         $this->master_db->insertRecord('owner_address',$dbs);
                    }
                }
                $this->load->view('admin/project_view',$this->data);
        }else {
             redirect('dashboard');
        }
        
        }else {
            redirect('dashboard');
        }
        //echo $this->db->last_query();exit;
        
    }
    public function reviews() {
        //echo "<pre>";print_r($_POST);exit;
        $reviews = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('reviews', true))));
        $ratings = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('ratings', true))));
        $uid = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('uid', true))));
        $prid = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('prid', true))));
        $uname = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('uname', true))));
        $db['name'] = $uname;
        $db['uid'] = $uid;
        $db['prid'] = $prid;
        $db['rating'] = $ratings;
        $db['reviews'] = $reviews;
        $db['status'] = -1;
        $db['created_at'] = date('Y-m-d H:i:s');
        $in = $this->master_db->insertRecord('property_review',$db);
        if($in) {
            echo json_encode(['status'=>true,'msg'=>'Review submitted successfully']);
        }else {
           echo json_encode(['status'=>false,'msg'=>'Error in submitting reviews']); 
        }
    }
    public function categorylist() {
       // echo "<pre>";print_r($_GET);exit;
        $id = $_GET['id'];
        $type = $_GET['pid'];
        $catid =  sqftDcrypt($id);
        $pid =  sqftDcrypt($pid);
       $this->data['property'] =  $this->master_db->getPropertylistbyid($catid,$type);
        echo $this->db->last_query();
        $this->load->view('admin/category',$this->data);
    }
}