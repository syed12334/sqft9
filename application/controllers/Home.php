<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
		protected $data;
		public function __construct() {
			date_default_timezone_set('Asia/Kolkata');
			parent::__construct();
			$this->data['detail']="";
			$this->load->model('home_db');
	        $this->load->model('master_db');
	        $this->load->helper('utility_helper');
	         $this->data['contact'] = $this->master_db->getRecords('contactus',['status'=>0],'*','id desc');
	        $this->data['header']=$this->load->view('includes/header', $this->data , TRUE);
	        $this->data['header1']=$this->load->view('includes/header1', $this->data , TRUE);
	        $this->data['footer']=$this->load->view('includes/footer', $this->data , TRUE);
		}
		public function index()
		{
			 $this->data['popularplaces'] = $this->master_db->getRecords('properties',['publish '=>0,'pplaces'=>1],'id,title,slug','id desc','','','8');

	        $this->data['featureproperties'] = $this->master_db->getRecords('properties',['publish '=>0,'pfeature'=>1],'id,title,slug,paddress,bedrooms,bathrooms,area,price,balcony,pid,videotype,video_path,face,ptype','id desc','','','4');
	       //echo $this->db->last_query();exit;
	        $this->data['popularproperties'] = $this->master_db->getRecords('properties',['publish '=>0,'ppopular'=>1],'id,title,slug,paddress,bedrooms,bathrooms,area,price,balcony,pid,videotype,video_path,face,ptype','id desc');
	        //echo $this->db->last_query();exit;
	         $this->data['pcategory'] = $this->master_db->getRecords('property_category',['status'=>0],'id,name','name asc');
	         $this->data['testimonials'] = $this->master_db->getRecords('testimonials',['status'=>0],'*','id desc');
	         $this->data['partners'] = $this->master_db->getRecords('partners',['status'=>0],'*','id desc');
	        
    		 $this->data['ptype'] = $this->master_db->getRecords('property_type',['status'=>0],'id,name','id asc');
    		 $this->data['sliders'] = $this->master_db->getRecords('slider_img',['status'=>0],'id,image','id desc');
	        //echo $this->db->last_query();exit;
	        $this->load->view('index',$this->data);
	        $ip = $this->input->ip_address();
	        $getIp = $this->master_db->getRecords('ip_address',['ip'=>$ip],'ip,id,vcount');
	        if(count($getIp) >0) {
	        	$dbs['vcount'] = (int)$getIp[0]->vcount +1;
	        	$where = ['id'=>$getIp[0]->id];
	        	$up = $this->master_db->updateRecord('ip_address',$dbs,$where);
	        }else {
	        	$db['ip'] = $ip;
	        	$db['vcount'] = 1;
	        	$db['created_at'] = date('Y-m-d H:i:s');
	        	$in = $this->master_db->insertRecord('ip_address',$db);
	        }
		}
		public function register() {
			$this->data['package'] = $this->master_db->getRecords('packages',['status !='=>-1],'*','id asc');
			$this->data['state'] = $this->master_db->getRecords('states',['status'=>0],'id,name','name asc');
			//echo $this->db->last_query();exit;
			$this->load->view('register',$this->data);
		}
		public function getCity() {
			$id = trim($this->input->post('sid'));
			$getCity = $this->master_db->getRecords('cities',['sid'=>$id],'id,cname');
			$result ='';
			if(count($getCity) >0) {
				$result .= "<option value=''>Select City</option>";
				foreach ($getCity as $key => $value) {
					$options = "<option value='".$value->id."'>".$value->cname."</option>";
					$result .= $options;
				}
			}
			echo json_encode(['status'=>true,'csrf_token'=>$this->security->get_csrf_hash(),'msg'=>$result]);
		}
		public function login() {
			$this->load->view('login_view',$this->data);
		}
		// public function payment() {
		// 	$name = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('name', true))));
		// 	$email = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('email', true))));
		// 	$phone = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('phone', true))));
		// 	$pass = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('pass', true))));
		// 	$state = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('state', true))));
		// 	$city = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('city', true))));
		// 	$aadharno = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('aadharno', true))));
		// 	$package = $this->input->post('package');
		// 	$terms = $this->input->post('terms');
		// 	$this->session->set_userdata('payment',$package);
		// 	$getEmail = $this->master_db->getRecords('users',['email'=>$email],'*');
		// 	if(count($getEmail) >0) {
		// 			echo json_encode(['status'=>false,'msg'=>'Email already exists try another','csrf_token'=>$this->security->get_csrf_hash()]);
		// 	}else {
		// 		$pacid ="";
		// 		if(is_array($package)) {
		// 			$pacid .= implode(",", $package);
		// 		}

		// 		if(!is_array($package)) {
		// 			echo json_encode(['status'=>false,'msg'=>'Please select atleast one package','csrf_token'=>$this->security->get_csrf_hash()]); exit;
		// 		}
		// 		//echo $pacid;exit;
				
		// 		$db['name'] = $name;
		// 		$db['email'] = $email;
		// 		$db['phone'] = $phone;
		// 		$db['password'] = password_hash($pass,PASSWORD_BCRYPT);
		// 		$db['invoiceno'] = "sqft9".rand(1234,9876);
		// 		$db['state_id'] = $state;
		// 		$db['city_id'] = $city;
		// 		$db['aadharno'] = $aadharno;
		// 		if($pacid =="2,13" || $pacid =="2" || $pacid =="13") {
		// 			$db['status'] =0;
		// 		}else {
		// 			$db['status'] =1;
		// 		}
		// 		$db['created_at'] = date('Y-m-d H:i:s');
		// 		$db['terms'] = $terms;
		// 		$in = $this->master_db->insertRecord('users',$db);
		// 		if($in) {
		// 			if(is_array($package)) {
		// 				foreach ($package as $key => $value) {
		// 					$plist = $this->master_db->sqlExecute('select * from packages where id in ('.$value.')');
		// 					$month = (int)filter_var($plist[0]->nmonths,FILTER_SANITIZE_NUMBER_INT);
		// 					$dbs['user_id'] = $in;
		// 					$dbs['pid'] = $value;
		// 					$dbs['price'] = $plist[0]->pprice;
		// 					$dbs['months'] = (int)filter_var($plist[0]->nmonths,FILTER_SANITIZE_NUMBER_INT);
		// 					$dbs['pictures'] = (int)filter_var($plist[0]->npictures,FILTER_SANITIZE_NUMBER_INT);
		// 					$dbs['properties'] = (int)filter_var($plist[0]->nproperties,FILTER_SANITIZE_NUMBER_INT);
		// 					$dbs['expire_date'] = date('Y-m-d',strtotime('+'.$month.' month'));
		// 					$dbs['type'] = $plist[0]->type;
		// 					$dbs['orderno'] = "sqft9".$in;
		// 					$dbs['created_at'] = date('Y-m-d');
		// 					$ins = $this->master_db->insertRecord('user_package',$dbs);
		// 				}
		// 			}
		// 			$payment['user_id'] = $in;
		// 			$payment['status'] = -1;
		// 			$this->master_db->insertRecord('payment_log',$payment);
		// 			echo json_encode(['status'=>true,'csrf_token'=>$this->security->get_csrf_hash()]);
		// 		}else {
		// 			echo json_encode(['status'=>false,'msg'=>'Error in inserting','csrf_token'=>$this->security->get_csrf_hash()]);
		// 		}
		// 	}
		// }

		public function payment() {
			$name = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('name', true))));
			$email = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('email', true))));
			$phone = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('phone', true))));
			$pass = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('pass', true))));
			$state = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('state', true))));
			$city = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('city', true))));
			$aadharno = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('aadharno', true))));
			$package = $this->input->post('package');
			$getEmail = $this->master_db->getRecords('users',['email'=>$email],'*');
			if(count($getEmail) >0) {
					echo json_encode(['status'=>false,'msg'=>'Email already exists try another']);
			}else {
						$ar = array(
						"name"=>$name,
						"email"=>$email,
						"phone"=>$phone,
						"pass"=>$pass,
						"package"=>$package,
						"state"=>$state,
						"city"=>$city,
						"aadharno"=>$aadharno
				);
				$this->session->set_userdata('payment',$ar);
				if(is_array($package)) {
					$im = implode(",",$package);
					$this->data['package'] = $this->master_db->sqlExecute('select * from packages where id in ('.$im.')');
					$this->data['postData'] = $_POST;
					$new = $this->load->view('package-summary',$this->data,true);
					echo json_encode(['status'=>true,'msg'=>$new]);
				}else {
					echo json_encode(['status'=>false,'msg'=>'Please select atleast one package']);
				}
			}
		}
		public function thankyou() {
			$this->load->view('payment-thankyou',$this->data);
		}
		public function insertdata() {
			//echo "<pre>";print_r($_POST);exit;
			$payid = $this->input->post('payid');
			$pay = $this->session->userdata('payment');
			$package = $pay['package'];
			$pacid = implode(",", $package);
			$db['name'] = $pay['name'];
			$db['email'] = $pay['email'];
			$db['phone'] = $pay['phone'];
			$db['password'] = password_hash($pay['pass'],PASSWORD_BCRYPT);
			$db['invoiceno'] = "sqft9".rand(1234,9876);
			$db['state_id'] = $pay['state'];
			$db['city_id'] = $pay['city'];
			$db['aadharno'] = $pay['aadharno'];
			if($pacid =="2,13" || $pacid =="2" || $pacid =="13") {
				$db['status'] =0;
			}else {
				$db['status'] =1;
			}
			$db['created_at'] = date('Y-m-d H:i:s');
			$package = $pay['package'];
			$in = $this->master_db->insertRecord('users',$db);
			if($in) {
				if(is_array($package)) {
					foreach ($package as $key => $value) {
						$plist = $this->master_db->sqlExecute('select * from packages where id in ('.$value.')');
						$month = (int)filter_var($plist[0]->nmonths,FILTER_SANITIZE_NUMBER_INT);
						$dbs['user_id'] = $in;
						$dbs['pid'] = $value;
						$dbs['price'] = $plist[0]->pprice;
						$dbs['months'] = (int)filter_var($plist[0]->nmonths,FILTER_SANITIZE_NUMBER_INT);
						$dbs['pictures'] = (int)filter_var($plist[0]->npictures,FILTER_SANITIZE_NUMBER_INT);
						$dbs['properties'] = (int)filter_var($plist[0]->nproperties,FILTER_SANITIZE_NUMBER_INT);
						$dbs['expire_date'] = date('Y-m-d',strtotime('+'.$month.' month'));
						$dbs['type'] = $plist[0]->type;
						$dbs['orderno'] = "sqft9".$in;
						$dbs['created_at'] = date('Y-m-d');
						$ins = $this->master_db->insertRecord('user_package',$dbs);
					}
				}
				$payment['user_id'] = $in;
				if(!empty($payid)) {
					$payment['pay_id'] = $payid;
					$payment['status'] = 0;
					$payment['created_at'] = date('Y-m-d H:i:s');
				}else {
					$payment['status'] = -1;
				}
				$this->master_db->insertRecord('payment_log',$payment);
				echo json_encode(['status'=>true,'msg'=>'msg','csrf_token'=>$this->security->get_csrf_hash()]);
			}else {
				echo json_encode(['status'=>false,'msg'=>'msg','csrf_token'=>$this->security->get_csrf_hash()]);
			}
		}
		public function emailvalid() {
			//echo "<pre>";print_r($_POST);exit;
			$email = $this->input->post('email');
			//$token = $this->security->get_csrf_hash();
			$getEmail = $this->master_db->getRecords('users',['email'=>$email],'*');
			//print_r($getEmail);exit;
			if(count($getEmail) >0) {
				echo json_encode(['status'=>false,'msg'=>'Email already exist try another','csrf_token'=>$this->security->get_csrf_hash()]);
			}else {
				echo json_encode(['status'=>true,'csrf_token'=>$this->security->get_csrf_hash()]);
			}
		}
		 public function propertyview() {
	        $slug = $this->uri->segment(1);
	        //echo $slug;exit;
	         $this->session->set_userdata('slugurl',$slug);
	        if(!empty($slug) && isset($slug)) {
	        	
	        $getProperty = $getproper =  $this->master_db->getRecords('properties',['slug'=>$slug,'publish'=>0],'*');

	        if(count($getProperty) >0 && isset($getProperty)) {
		        	$recentProperty  =  $this->master_db->getRecords('properties',['slug !='=>$slug,'publish'=>0],'id,title,price,slug,area','id desc','',"",'3');
		        //echo $this->db->last_query();exit;
		        $getRentcount = $this->master_db->getRecords('contact_count',['pid'=>$getproper[0]->pid,'prid'=>$getproper[0]->id],'*');
		        //echo $this->db->last_query();exit;
		        $userPackage = $this->master_db->getRecords('user_package',['pid'=>$getproper[0]->pid],'id,properties');
		        $reviews = $this->master_db->getRecords('property_review',['prid'=>$getproper[0]->id,'status'=>0],'id,rating,reviews,name,created_at');
		        $atype = $this->master_db->getRecords('apartmenttype',['id'=>$getproper[0]->atype],'id,name');
		        $cperiod = $this->master_db->getRecords('cperiod',['id'=>$getproper[0]->cperiod],'id,cperiod');
		        $area = $this->master_db->getRecords('area',['id'=>$getproper[0]->areaid],'id,areaname');
		        $this->data['pcategory'] = $this->master_db->getRecords('property_category',['status'=>0],'id,name','name asc');
	    		 $this->data['ptype'] = $this->master_db->getRecords('property_type',['status'=>0],'id,name','id asc');
		       // echo $this->db->last_query();exit;
		        $this->data['property'] =  $getProperty;
		        $this->data['userPackage'] =  $userPackage;
		        $this->data['reviews'] =  $reviews;
		        $this->data['recentProperty'] =  $recentProperty;
		        $this->data['propertyPackcount'] =  $getRentcount;
		        $this->data['atype'] =  $atype;
		        $this->data['cperiod'] =  $cperiod;
		        $this->data['area'] =  $area;
		        $this->data['packagetype'] = $this->master_db->getRecords('packages',['id'=>$getProperty[0]->pid],'type');
		        $this->data['similar'] = $this->master_db->getRecords('properties',['id !='=>$getProperty[0]->id,'publish'=>0],'id,title,slug,paddress,bedrooms,bathrooms,area,price,balcony,pid,videotype,video_path,face,ptype','id desc','id','','3');
		   
		        //echo $this->db->last_query();exit;
		        $this->load->view('projects',$this->data);
	        }else {
	        	redirect(base_url());
	        }
	        
	    }else {
	    	redirect(base_url());
	    }
	       
	    }
		
		 public function reviews() {
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

	        if(!$this->session->userdata(ADMIN_SESSION)) {
	        	echo json_encode(['status'=>-1]);
	        }else {
	        	 $in = $this->master_db->insertRecord('property_review',$db);
		        if($in) {
		            echo json_encode(['status'=>true,'msg'=>'Review submitted successfully','csrf_token'=>$this->security->get_csrf_hash()]);
		        }else {
		           echo json_encode(['status'=>false,'msg'=>'Error in submitting reviews','csrf_token'=>$this->security->get_csrf_hash()]); 
		        }
	        }
	       
	    }
	  public function categorylist() {
//echo "<pre>";print_r($_GET);exit;
	  	$id ="";$pid ="";$bitype ="";
	  	if(!empty(@$_GET['id'])) {
	  		$id .= @$_GET['id'];
	  		
	  	}
        if(!empty(@$_GET['pid'])) {
        	$pid .= @$_GET['pid'];
        }
        if(!empty(@$_GET['bitype'])) {
        	$bitype .=sqftDcrypt($_GET['bitype']);
        }
        $catid =  sqftDcrypt($id);
        $type =  sqftDcrypt($pid);
         $this->data['amenities'] = $this->master_db->getRecords('amenities',['status'=>0,'ptype'=>$catid],'id,title');
         $this->data['pcategory'] = $this->master_db->getRecords('property_category',['status'=>0],'id,name','name asc');
         $this->data['ptype'] = $this->master_db->getRecords('property_type',['status'=>0],'id,name','id asc');
         $this->data['otype'] = $this->master_db->getRecords('owner_type',['status'=>0],'id,name','id asc');
         //echo $this->db->last_query();exit;
         $perpage = "";
        	if(!empty(@$_GET['per_page'])) {
        		$perpage .= @$_GET['per_page'];
        	}
        $this->load->library('pagination');
		$config=[
		        'base_url' => base_url().'home/categorylist?id='.$id.'&pid='.$pid.'',
		        'per_page' =>20,
		        'uri_segment'=>3,
		        'use_page_numbers'=>TRUE,
		        'page_query_string'=>TRUE,
		        'total_rows' => $this->home_db->properteis_rows($catid, $type),
		        'full_tag_open'=>"<ul class='pagination'>",
		        'full_tag_close'=>"</ul>",
		        'next_tag_open' =>"<li>",
		        'next_tag_close' =>"</li>",
		        'prev_tag_open' =>"<li>",
		        'prev_tag_close' =>"</li>",
		        'num_tag_open' =>"<li>",
		        'num_tag_close' =>"<li>",
		        'cur_tag_open' =>"<li class='active'><a>",
		        'cur_tag_close' =>"</a></li>"
		 ];

		$this->pagination->initialize($config);
		$this->data['property']=$this->home_db->getPropertylistbyid($config['per_page'],$perpage, $catid, $type);
		//echo $this->db->last_query();exit;
       $this->data["links"] = $this->pagination->create_links();
       $this->data["countproperty"] = $this->home_db->getPropertylistbycount($catid, $type);
       // echo $this->db->last_query();
        $this->load->view('category',$this->data);
    }
  public function getFilters() {
  	//echo "<pre>";print_r($_POST);exit();
  		$id = $this->input->post('id');
  		$pid = $this->input->post('pid');
  		$where ="";

  		$amenities = $this->input->post('amenities');
  			if(is_array($amenities)) {
  				$amenity = implode(",", $amenities);
  				$where .=" and pa.p_amenities in (".$amenity.")";
  			}
  		
  		$bhk = $this->input->post('bhk');
  		if(is_array($bhk)) {
  			$bhk = implode(",", $bhk);
  			$where .=" and p.bedrooms in ('".$bhk."')";
  		}
  		
  		$facing = $this->input->post('facing');
  		if(is_array($facing)) {
  			$facing = implode(",", $facing);
  			$where .=" and p.face in ('".$facing."')";
  		}
  		
  		$furnish = $this->input->post('furnish');
  		if(is_array($furnish)) {
  			$furnish = implode(",", $furnish);
  			$where .=" and p.furnished in ('".$furnish."')";
  		}
  		
  		$floors = $this->input->post('floors');
  		if(is_array($floors)) {
  		$floors = implode(",", $floors);
  		$where .=" and p.floors in ('".$floors."')";
  	}

  	$role = $this->input->post('role');
  		if(is_array($role)) {
  		$role = implode(",", $role);
  		$where .=" and p.ownerrole in ('".$role."')";
  	}

  		$availablefrom = $this->input->post('availablefrom');
  		if(is_array($availablefrom)) {
  		$availablefrom = implode(",", $availablefrom);
  		$where .=" and p.availability in ('".$availablefrom."')";
  	}
  		$carpark = $this->input->post('carpark');
  		if(is_array($carpark)) {
  			$carpark = implode(",", $carpark);
  			$where .=" and p.carpark in ('".$carpark."')";
  		}
        $catid =  sqftDcrypt($id);
        $type =  sqftDcrypt($pid);
         $this->data['amenities'] = $this->master_db->getRecords('amenities',['status'=>0,'ptype'=>$catid],'id,title');
          $perpage = "";
        	if(!empty(@$_GET['per_page'])) {
        		$perpage .= @$_GET['per_page'];
        	}
        $this->load->library('pagination');
		$config=[
		        'base_url' => base_url().'home/categorylist?id='.$id.'&pid='.$pid.'',
		        'per_page' =>12,
		        'uri_segment'=>3,
		        'use_page_numbers'=>TRUE,
		        'page_query_string'=>TRUE,
		        'total_rows' => $this->home_db->properteis_rows($catid, $type),
		        'full_tag_open'=>"<ul class='pagination'>",
		        'full_tag_close'=>"</ul>",
		        'next_tag_open' =>"<li>",
		        'next_tag_close' =>"</li>",
		        'prev_tag_open' =>"<li>",
		        'prev_tag_close' =>"</li>",
		        'num_tag_open' =>"<li>",
		        'num_tag_close' =>"<li>",
		        'cur_tag_open' =>"<li class='active'><a>",
		        'cur_tag_close' =>"</a></li>"
		 ];

		$this->pagination->initialize($config);
		$configper = $config['per_page'];
		
		$getproperty = $this->master_db->sqlExecute('select p.id,p.title,p.price,p.ptype,p.paddress,p.pid,p.slug,p.videotype,p.video_path,p.face from properties p left join  property_amenities pa on pa.prid=p.id where p.ptype = '.$catid.' and p.type='.$type.' and p.publish=0 '.$where.' group by p.id order by p.id');
		$this->data['property']=$getproperty;
		//echo $this->db->last_query();exit;
       $this->data["links"] = $this->pagination->create_links();
        $html = $this->load->view('getfilters',$this->data,true);
        echo json_encode(['status'=>true,'msg'=>$html,'csrf_token'=>$this->security->get_csrf_hash()]);
  }
 
  public function search() {
  	$this->output->set_header('HTTP/1.0 200 OK');
$this->output->set_header('HTTP/1.1 200 OK');
$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
$this->output->set_header('Cache-Control: post-check=0, pre-check=0');
$this->output->set_header('Pragma: no-cache');
  	//echo "<pre>";print_r($_POST);exit;
  	$location  = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('location', true))));
  	$pcat  = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('pcat', true))));
  	$ptype  = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('ptype', true))));
  	$area  = trim($this->input->post('area'));
  	$getArea = $this->master_db->getRecords('area',['areaname'=>$area],'id');
  	$this->data['otype'] = $this->master_db->getRecords('owner_type',['status'=>0],'id,name','id asc');
  	//echo $this->db->last_query();exit;
  	$where = "";
  	if(is_array($getArea) && count($getArea) >0) {
  			if(!empty($area)) {
  				$where .=" and areaid  =".$getArea[0]->id."";
  			}
  	}
  	
  	if(!empty($location)) {
  		$where .=' and title like "%'.$location.'%"  or pcity like "%'.$location.'%" or pstate like "%'.$location.'%" or bedrooms like "%'.$location.'%" or paddress like "%'.$location.'%" '.$where.'';
  	}
  	if(!empty($pcat)) {
  		$where .=" and ptype =".$pcat." ";
  	}
  	if(!empty($ptype)) {
  		$where .=" and type =".$ptype." ";
  	}
  	$this->data['searchpage'] = $getsearchbar = $this->master_db->sqlExecute('select id,title,price,ptype,carpark,paddress,pid,slug,face,videotype,video_path,face,ptype from properties where publish =0 '.$where.'  order by id desc');
  	//echo $this->db->last_query();exit;
  	
  	$this->data['amenities'] = $this->master_db->getRecords('amenities',['status'=>0,'ptype'=>$pcat],'id,title');
    $this->data['pcategory'] = $this->master_db->getRecords('property_category',['status'=>0],'id,name','name asc');
    $this->data['ptype'] = $this->master_db->getRecords('property_type',['status'=>0],'id,name','id asc');
   
  	$this->load->view('searchpage',$this->data);
  }
  public function wishlist() {
  	//echo "<pre>";print_r($_POST);
  	$prid = sqftDcrypt($this->input->post('id'));
  	$session = $this->session->userdata(ADMIN_SESSION);

  
  	if(!$session) {
  		echo json_encode(['status'=>false]);
  	}else {
  			$uid = $session['id'];
  		$getProperty = $this->master_db->getRecords('property_wishlist',['user_id'=>$uid,'prid'=>$prid],'*');
//echo $this->db->last_query();exit;
  		if(count($getProperty) >0) {

  		}else {
  			$db['user_id'] = $uid;
  			$db['prid'] = $prid;
  			$db['created_at'] = date('Y-m-d H:i:s');
  			$this->master_db->insertRecord('property_wishlist',$db);
  			echo json_encode(['status'=>true,'csrf_token'=>$this->security->get_csrf_hash()]);
  		}
  		
  	}
  }

  public function getserachFilters() {
  	//echo "<pre>";print_r($_POST);exit;
  
        	$location  = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('location', true))));
  	$pcat  = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('pcat', true))));
  	$ptype  = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('ptype', true))));
  		$where ="";
  		 	if(!empty($location)) {
	  		$where .=' and title like "%'.$location.'%"  or paddress like "%'.$location.'%" ';
	  	}
	  	if(!empty($pcat)) {
	  		$where .=" and ptype =".$pcat." ";
	  	}
	  	if(!empty($ptype)) {
	  		$where .=" and type =".$ptype." ";
	  	}

  		$amenities = $this->input->post('amenities');
  			if(is_array($amenities)) {
  				$amenity = implode(",", $amenities);
  				$where .=" and pa.id in (".$amenity.")";
  			}
  		
  		$bhk = $this->input->post('bhk');
  		if(is_array($bhk)) {
  			$bhk = implode(",", $bhk);
  			$where .=" and p.bedrooms in ('".$bhk."')";
  		}
  		
  		$facing = $this->input->post('facing');
  		if(is_array($facing)) {
  			$facing = implode(",", $facing);
  			$where .=" and p.face in ('".$facing."')";
  		}

  		 	$role = $this->input->post('role');
  		if(is_array($role)) {
  		$role = implode(",", $role);
  		$where .=" and p.ownerrole in ('".$role."')";
  	}

  		$availablefrom = $this->input->post('availablefrom');
  		if(is_array($availablefrom)) {
  		$availablefrom = implode(",", $availablefrom);
  		$where .=" and p.availability in ('".$availablefrom."')";
  	}
  		
  		$furnish = $this->input->post('furnish');
  		if(is_array($furnish)) {
  			$furnish = implode(",", $furnish);
  			$where .=" and p.furnished in ('".$furnish."')";
  		}
  		
  		$floors = $this->input->post('floors');
  		if(is_array($floors)) {
  		$floors = implode(",", $floors);
  		$where .=" and p.floors in ('".$floors."')";
  	}
  		$carpark = $this->input->post('carpark');
  		if(is_array($carpark)) {
  			$carpark = implode(",", $carpark);
  			$where .=" and p.carpark in ('".$carpark."')";
  		}
        $getproperty = $this->master_db->sqlExecute('select p.id,p.title,p.bedrooms,p.bathrooms,p.area,p.price,p.ptype,p.paddress,p.pid,p.slug,p.videotype,p.video_path,p.face from properties p left join  property_amenities pa on pa.prid=p.id where  p.publish=0 '.$where.' group by p.id order by p.id');
        //echo $this->db->last_query();exit;
        $this->data['property']=$getproperty;
        $html = $this->load->view('getfilters',$this->data,true);
         echo json_encode(['status'=>true,'msg'=>$html,'csrf_token'=>$this->security->get_csrf_hash()]);
  }

  public function newsletter() {
  	$email = trim($this->input->post('email'));
  	$getemail = $this->master_db->getRecords('newsletter',['email'=>$email],'*');
  	if(count($getemail) >0) {
  		echo json_encode(['status'=>false,'msg'=>'<div class="alert alert-danger">Email already exists</div>']);
  	}else {
  		$db['email'] = $email;
  		$db['created_at'] = date('Y-m-d H:i:s');
  		$in = $this->master_db->insertRecord('newsletter',$db);
  		if($in) {
  			echo json_encode(['status'=>true,'msg'=>'<div class="alert alert-success">Subscribed successfully</div>','csrf_token'=>$this->security->get_csrf_hash()]);
  		}else {
  			echo json_encode(['status'=>false,'msg'=>'<div class="alert alert-danger">Error in subscribing</div>','csrf_token'=>$this->security->get_csrf_hash()]);
  		}
  	}
  }

  public function autocomplete() {
  	//echo "<pre>";print_r($_POST);exit;
  	$area = $this->input->post('auto');
  	$getarea = 	$this->master_db->sqlExecute('select id,areaname FROM area WHERE areaname like "%'.$area.'%"  order by areaname asc');
  	$this->data['area'] = $getarea;
  	$html = $this->load->view('autocomplete',$this->data,true);
  	echo json_encode(['status'=>true,'msg'=>$html,'csrf_token'=>$this->security->get_csrf_hash()]);
  }
  public function aboutus() {
  	$this->data['about'] = $this->master_db->getRecords('aboutus',['id !='=>-1],'*');
  	$this->load->view('about',$this->data);
  }
   public function terms() {
  	$this->data['terms'] = $this->master_db->getRecords('terms',['id !='=>-1],'*');
  	$this->load->view('terms',$this->data);
  }
    public function privacy() {
  	$this->data['privacy'] = $this->master_db->getRecords('privacypolicy',['id !='=>-1],'*');
  	$this->load->view('privacy',$this->data);
  }
   public function returnpolicy() {
  	$this->data['return'] = $this->master_db->getRecords('returnpolicy',['id !='=>-1],'*');
  	$this->load->view('return-policy',$this->data);
  }
  public function getpass() {
        $pass ="royinvigor@123";
        echo password_hash($pass, PASSWORD_BCRYPT);
    }
}
