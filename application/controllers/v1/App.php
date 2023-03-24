<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST,DELETE,UPDATE");
header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
header('Content-type: application/json; charset=UTF-8');
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
class App extends CI_Controller { 
		public function __construct() {
			parent::__construct();	
			date_default_timezone_set('Asia/Kolkata');
			$this->load->model('master_db');
			$this->load->model('home_db');
			$this->load->model('app_db');
		}
		public function register() {
		 	$result = array('status'=>'failure','msg'=>'Required fields are missing.');
		 	$bodys = file_get_contents('php://input');
			$data = json_decode($bodys, true);
			$password = trim(preg_replace('!\s+!', '',@$data['password']));
			$name = @$data['name'];
			$aadhaar = trim(preg_replace('!\s+!', '',@$data['aadhaar']));
			$phone = trim(preg_replace('!\s+!', '',@$data['mobile']));
			$email = trim(preg_replace('!\s+!', '',@$data['email']));
			$state_id = trim(preg_replace('!\s+!', '',@$data['state_id']));
			$city_id = trim(preg_replace('!\s+!', '',@$data['city_id']));
			if(!empty($name) && !empty($email) && !empty($aadhaar) && !empty($phone) && !empty($password) && !empty($state_id) && !empty($city_id)) {
		 	$users = $this->master_db->getRecords('users',['email'=>$email],'*');
		 	if(count($users) >0) {
		 		$result = array('status'=>'failure','msg'=>'Email already exists.');
		 	}else {
		 		if(preg_match("/[a-zA-Z]/",$name)) {
		 			$db['name'] = $name;
		 		}else {
		 			$result = array('status'=>'failure','msg'=>'Only characters are allowed');
		 			echo json_encode($result);exit;
		 		}
		 		if(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i",$email)) {
		 				$db['email'] = $email;
		 		}else {
		 			$result = array('status'=>'failure','msg'=>'Enter valid email');
		 			echo json_encode($result);exit;
		 		}
		 		if(preg_match("/[0-9]{10}/",$phone)) {
		 				$db['phone'] = $phone;
		 		}else {
		 			$result = array('status'=>'failure','msg'=>'Enter 10 digit phone number');
		 			echo json_encode($result);exit;
		 		}
		 		$db['password'] = password_hash($password, PASSWORD_BCRYPT);
		 		$db['invoiceno'] = "sqft9".rand(1234,9876);
		 		$db['state_id'] =$state_id;
		 		$db['city_id'] = $city_id;
		 		if(preg_match("/[0-9]{12}/",$aadhaar)) {
		 			$db['aadharno'] = $aadhaar;
		 		}else {
		 			$result = array('status'=>'failure','msg'=>'Please enter 12 digit aadhar number');
		 			echo json_encode($result);exit;
		 		}
		 		$db['created_at'] = date('Y-m-d H:i:s');
		 		$insert = $this->master_db->insertRecord('users',$db);
		 		if($insert) {
		 			$userdata = ['user_id'=>$insert,'name'=>$name,'email'=>$email];
		 			$result = array('status'=>'success','data'=>$userdata);
		 		}
		 	}
		}
		 echo json_encode($result);
	}
	public function login() {
			$result = array('status'=>'failure','msg'=>'Required fields are missing.');
		 	$bod = file_get_contents('php://input');
			$data = json_decode($bod, true);
			$email = trim(preg_replace('!\s+!', '',@$data['email_id']));
			$pass = trim(preg_replace('!\s+!', '',@$data['password']));
		 if(!empty($email) && !empty($pass)) {
		 	$details = $this->home_db->getlogin($email);
				if(count($details) >0 ){
					if(password_verify($pass, $details[0]->password)) {
						$userdata = ['user_id'=>$details[0]->id,'name'=>$details[0]->name,'email'=>$details[0]->email];
						$result = array('status'=>'success','data'=>$userdata);
					}else {
						$result = array('status'=>'failure','msg'=>'Password is incorrect try another');
					}
				}else {
					$result = array('status'=>'failure','msg'=>'Email not exists try another');
				}
		 }
		 echo json_encode($result);
	}
	public function city() {
		$result = array('status'=>'failure','msg'=>'Required fields are missing.');
		$city = file_get_contents('php://input');
		$data = json_decode($city, true);
		$state_id = trim(preg_replace('!\s+!', '',@$data['state_id']));
		$getcity = $this->master_db->getRecords('cities',['status'=>0,'sid'=>$state_id],'id as city_id, cname','cname asc');
		if(count($getcity)>0) {
			$result = array('status'=>'success','city_data'=>$getcity);
		}else {
			$result = array('status'=>'failure','msg'=>'No data found');
		}
		echo json_encode($result);
	}
	public function states() {
		$getcity = $this->master_db->getRecords('states',['status'=>0],'id as state_id, name','name asc');
		if(count($getcity)>0) {
			$result = array('status'=>'success','state_data'=>$getcity);
		}else {
			$result = array('status'=>'failure','msg'=>'No data found');
		}
		echo json_encode($result);
	}
	public function packages() {
			$getpackage = $this->master_db->getRecords('packages',['status'=>0],'id as pid, title,pprice as price,nmonths as validity','id desc');
		if(count($getpackage)>0) {
			$result = array('status'=>'success','package_data'=>$getpackage);
		}else {
			$result = array('status'=>'failure','msg'=>'No data found');
		}
		echo json_encode($result);
	} 
	public function homepage() {
		$recentplaces = $this->master_db->getRecords('properties',['publish '=>0,'pplaces'=>1],'id,title as name','id desc','','','8');
		$featureplaces = $this->master_db->getRecords('properties',['publish '=>0,'pfeature'=>1],'id,title as name,paddress as location,price,video_path,face as facing,ptype as type','id desc','','','4');
		$discover = $this->master_db->getRecords('properties',['publish '=>0,'ppopular'=>1],'id,title as name,paddress as location,price,video_path,face as facing,ptype as type','id desc');
		$sliders = $this->master_db->getRecords('slider_img',['status '=>0],'image','id desc');
		$recent = "";$feature = "";$discovernew = "";$msg="";
		/**** Recent properties *****/
		if(count($recentplaces) >0) {
			foreach ($recentplaces as $recent) {
			  $id = $recent->id;
			  $rimg = $this->master_db->getRecords('property_gallery',['prid'=>$id],'p_img as image','id asc','','','1');
			  $recent->image = base_url($rimg[0]->image);
			}
		}else {
			$msg .= "No data found";
		}
				/**** Feature properties *****/
		if(count($featureplaces) >0) {
			foreach ($featureplaces as $feature) {
				if(!empty($feature->video_path)) {
					$feature->video_path = base_url($feature->video_path);
				}
			  $type = $feature->type;
			  if($type ==1) {
				$feature->type = "Rent";
			  }
			  else if($type ==2) {
				$feature->type = "Sale";
			  }
			  $id = $feature->id;
			  $rimg = $this->master_db->getRecords('property_gallery',['prid'=>$id],'p_img as image','id asc','','','1');
			 
			  $feature->image = base_url($rimg[0]->image);
			}
		}else {
			$msg .= "No data found";
		}
				/**** Discover properties *****/
		if(count($discover) >0) {
			foreach ($discover as $dis) {
				if(!empty($dis->video_path)) {
					$dis->video_path = base_url($dis->video_path);
				}
			  $type = $dis->type;
			  if($type ==1) {
				$dis->type = "Rent";
			  }
			  else if($type ==2) {
				$dis->type = "Sale";
			  }
			  $id = $dis->id;
			  $rimg = $this->master_db->getRecords('property_gallery',['prid'=>$id],'p_img as image','id asc','','','1');
			  $dis->image = base_url($rimg[0]->image);
			}
		}else {
			$msg .= "No data found";
		}

						/**** Discover properties *****/
		if(count($sliders) >0) {
			foreach ($sliders as $val) {
			  $val->image = base_url($val->image);
			}
		}else {
			$msg .= "No data found";
		}
		echo json_encode(['status'=>'success','recent_properties'=>$recentplaces,'feature_properties'=>$featureplaces,'discover_properties'=>$discover,'banners'=>$sliders]);
	}
	public function propertycategory() {
		$getcategory = $this->master_db->getRecords('property_category',['status'=>0],'id, name','name asc');
		if(count($getcategory)>0) {
			$result = array('status'=>'success','pcategory_data'=>$getcategory);
		}else {
			$result = array('status'=>'failure','msg'=>'No data found');
		}
		echo json_encode($result);
	}
	public function subscriptionplan() {
		 $result = array('status'=>'failure','msg'=>'Required fields are missing.');
		$renewpackage = file_get_contents('php://input');
		$data = json_decode($renewpackage, true);
		$user_id = trim(preg_replace('!\s+!', '',@$data['user_id']));
		$p_id = trim(preg_replace('!\s+!', '',@$data['p_id']));
		if(!empty($user_id) && !empty($p_id)) {
			$getPackage = $this->master_db->sqlExecute('select * from packages where status =0 and id in ('.$p_id.')');
			$getUsers = $this->master_db->getRecords('users',['id'=>$user_id],'*');
			if(count($getUsers) >0) {
					if(count($getPackage) >0) {
						$inid =[];$amt =[];
						foreach ($getPackage as $key => $value) {
							$amt[] = $value->pprice;
							$month = (int)filter_var($value->nmonths,FILTER_SANITIZE_NUMBER_INT);
							$dbs['user_id'] = $user_id;
							$dbs['pid'] = $value->id;
							$dbs['price'] = $value->pprice;
							$dbs['months'] = (int)filter_var($value->nmonths,FILTER_SANITIZE_NUMBER_INT);
							$dbs['pictures'] = (int)filter_var($value->npictures,FILTER_SANITIZE_NUMBER_INT);
							$dbs['properties'] = (int)filter_var($value->nproperties,FILTER_SANITIZE_NUMBER_INT);
							$dbs['expire_date'] = date('Y-m-d',strtotime('+'.$month.' month'));
							$dbs['type'] = $value->type;
							$dbs['orderno'] = "sqft9".rand(12345,98765);
							$dbs['created_at'] = date('Y-m-d');
							$ins = $this->master_db->insertRecord('user_package',$dbs);
						}
								$api = new Api(TEST_MERCHANT_KEY, TEST_MERCHANT_SECRET);
        						$order  = $api->order->create(array('receipt' =>rand(11111,99999), 'amount' => array_sum($amt)*100, 'currency' => "INR"));
        						$orderId = $order['id'];
								$payment['user_id'] = $user_id;
								if(!empty($orderId)) {
									$payment['status'] =-1;
									$payment['created_at'] = date('Y-m-d H:i:s');
									$payment['pamount'] =array_sum($amt);
									$payment['porderid'] = $orderId;
									$payment['pstatus'] = "pending";
								}else {
									$payment['status'] = -1;
								}
								$this->master_db->insertRecord('payment_log',$payment);
								$paid_amount['paid_amount'] = array_sum($amt);
								$paid_amount['payment_mode'] = "Online";
								$paid_amount['order_id'] =  $orderId;
								$paid_amount['razorpay_apikey'] = TEST_MERCHANT_KEY;
								$paid_amount['currency_type'] = 'INR';
								$paid_amount['razor_callback'] = base_url().'v1/razorpayResponse';
								$result = ['status'=>'success','payment_response'=>$paid_amount];
					}else {
						$result = array('status'=>'failure','msg'=>'No package found');
					}
			}else {
				$result = ['status'=>'failure','msg'=>'Userid not exists'];
			}
		}
		echo json_encode($result);
	}
	public function propertysearch() {
		$result = array();
		$psearch = file_get_contents('php://input');
		$datas = json_decode($psearch, true);
		$location = $datas['key_word'];
		$pcat = trim(preg_replace('!\s+!', '',$datas['property_category_id']));
		$ptype = trim(preg_replace('!\s+!', '',$datas['property_type']));
		$area = @$datas['area'];
		//echo "<pre>";print_r($data);exit;
		$where = "";
		if(!empty($area)) {
			$getArea = $this->master_db->getRecords('area',['areaname'=>$area],'id');
			if(is_array($getArea) && count($getArea) >0) {
  				if(!empty($area)) {
  					$where .=" and p.areaid  =".$getArea[0]->id."";
  				}
  			}
		}
  		if(!empty($location)) {
  			$where .=' and p.title like "%'.$location.'%"  or p.pcity like "%'.$location.'%" or p.pstate like "%'.$location.'%" or p.bedrooms like "%'.$location.'%" or p.paddress like "%'.$location.'%" ';
  		}
  		if(!empty($pcat)) {
  			$where .=" and p.ptype =".$pcat." ";
  		}
  		if(!empty($ptype)) {
  			$where .=" and p.type =".$ptype." ";
  		}
  		$getSearch = $this->master_db->sqlExecute('select p.id,p.title as name,p.price,p.paddress as location,p.videotype as vtype,p.video_path as video_link,p.face as facing,pc.name as property_type,p.type from properties p left join property_category pc on pc.id = p.ptype where p.publish =0 '.$where.'  order by p.id desc');
  		//echo $this->db->last_query();exit;
  		if(count($getSearch) >0 && is_array($getSearch)) {
  			foreach ($getSearch as $key => $value) {
  				 $id = $value->id;
                 $getImg = $this->master_db->getRecords('property_gallery',['prid'=>$id],'p_img','id desc','','',1);
                 $value->image = base_url($getImg[0]->p_img);
  				if($value->type ==1) {
  					$value->type = "Rent";
  				}else if($value->type ==2) {
  					$value->type = "Buy";
  				}
  			}
  			$result = ['status'=>'success','search_data'=>$getSearch];
  			echo json_encode($result);
  		}else {
  			$result = ['status'=>'failure','msg'=>'No data found'];
  			echo json_encode($result);
  		}
	}
	public function properties() {
		$result = array('status'=>'failure','msg'=>'Required fields are missing.');
		$properties = file_get_contents('php://input');
		$data = json_decode($properties, true);
		$ptype = trim(preg_replace('!\s+!', '',@$data['property_category_id']));
		$pid = trim(preg_replace('!\s+!', '',@$data['property_type']));
		$user_id = trim(preg_replace('!\s+!', '',@$data['user_id']));
		$amenities = @$data['amenities'];
		$bhk = @$data['bhk'];
		$facing = @$data['facing'];
		$furnish = @$data['furnish'];
		$floors = @$data['floors'];
		$role = @$data['role'];
		$availablefrom = @$data['availablefrom'];
		$carpark = @$data['carpark'];
		//echo "<pre>";print_r($data);exit;
		if(!empty($pid) && !empty($ptype)) {
			$where ="";$amenity="";
			if(!empty($user_id) && $user_id !="") {
				$where .=" and p.uid=".$user_id."";
			}
  			if(!empty($amenities)) {
  				$where .=" and pa.p_amenities in ('".$amenities."')";
  				$amenity .= " left join property_amenities pa on pa.prid=p.id";
  			}
  			if(!empty($bhk)) {
  				$where .=" and p.bedrooms ='".$bhk."'";
  			}
	  		if(!empty($facing)) {
  				$where .=" and p.face ='".$facing."'";
  			}
  			if(!empty($furnish)) {
  				$where .=" and p.furnished ='".$furnish."'";
  			}
  			if(!empty($floors)) {
  				$where .=" and p.floors in ('".$floors."')";
  			}
			if(!empty($role)) {
  				$where .=" and p.ownerrole ='".$role."'";
  			}
			if(!empty($availablefrom)) {
  				$where .=" and p.availability ='".$availablefrom."'";
  			}
  			if(!empty($carpark)) {
  				$where .=" and p.carpark ='".$carpark."'";
  			 }
			 $amenitiess = $this->master_db->getRecords('amenities',['status'=>0,'ptype'=>$ptype],'id,title');
			 $bhks[] = ['1 Bhk'=>1,'2 Bhk'=>2,'3 Bhk'=>3];
			 $facings[] = ['East'=>'East','West'=>'West','North'=>'North','South'=>'South'];
			 $floorss[] = ['1st Floor'=>1,'2nd Floor'=>2,'3rd Floor'=>3];
			 $ownerroles = $this->master_db->getRecords('owner_type',['status'=>0],'id,name as role');
			 $availablefroms[] = ['Immediate'=>'Immediate','15 days'=>'15 days','1 month'=>'1 month'];
			 $parkings[] = ['Available'=>'Available','Un Available'=>'Un Available'];
			 $furnishs[] = ['Furnished'=>'Furnished','Un Furnished'=>'Un Furnished'];
			 $filters = ['amenities'=>$amenitiess,'bhk' =>$bhks,'facing'=>$facings,'floors'=>$floorss,'role'=>$ownerroles,'availablefrom'=>$availablefroms,'parking'=>$parkings,'furnish'=>$furnishs];
			 $getProperty = $this->master_db->sqlExecute('select p.id,p.title as name,p.price,p.paddress as location,p.videotype as vtype,p.video_path as video_link,p.face as facing,pc.name as property_type,p.type,p.uid as user_id from properties p left join property_category pc on pc.id = p.ptype '.$amenity.' where p.ptype = '.$ptype.' and p.type ='.$pid.' and p.publish =0 '.$where.'  order by p.id desc');

			if(count($getProperty) >0) {
				foreach ($getProperty as $key => $value) {
					$id = $value->id;
					 $getRecentimg = $this->master_db->getRecords('property_gallery',['prid'=>$id],'p_img as images','id desc','','','1');
					 $value->image = base_url($getRecentimg[0]->images);
				}
				$result = ['status'=>'success','property_data'=>$getProperty,'filters'=>$filters];
			}else {
				$result = ['status'=>'failure','msg'=>'No data found'];
			}
		}
		echo json_encode($result);
	}
	public function propertyfilters() {
		$result = array('status'=>'failure','msg'=>'Required fields are missing.');
		$filters = file_get_contents('php://input');
		$data = json_decode($filters, true);
		$catid = trim(preg_replace('!\s+!', '',@$data['category_id']));
		$where ="";
		if(!empty($catid)) {
			$where .= " and ptype=".$catid."";
		}
		 	$amenities = $this->master_db->sqlExecute('select id,title from amenities where status =0 '.$where.' ');
			 $bhk = [['id'=>'1','title'=>'1 Bhk'],['id'=>'2','title'=>'2 Bhk'],['id'=>'3','title'=>'3 Bhk']];
			 $facing = [['id'=>'East','title'=>'East'],['id'=>'West','title'=>'West'],['id'=>'North','title'=>'North'],['id'=>'South','title'=>'South']];
			 $floors = [['id'=>'1','title'=>'1st Floor'],['id'=>'2','title'=>'2nd Floor'],['id'=>'3','title'=>'3rd Floor']];
			 $ownerrole = $this->master_db->getRecords('owner_type',['status'=>0],'id,name as role');
			 $availablefrom = [['id'=>'Immediate','title'=>'Immediate'],['id'=>'15 days','title'=>'15 days'],['id'=>'1 month','title'=>'1 month']];
			 $parking = [['id'=>'Available','title'=>'Available'],['id'=>'Un Available','title'=>'Un Available']];
			 $furnish = [['id'=>'Furnished','title'=>'Furnished'],['id'=>'Un Furnished','title'=>'Un Furnished']];
			 $filters = ['amenities'=>$amenities,'bhk' =>$bhk,'facing'=>$facing,'floors'=>$floors,'role'=>$ownerrole,'availablefrom'=>$availablefrom,'parking'=>$parking,'furnish'=>$furnish];
			 echo json_encode(['status'=>'success','filters'=>$filters]);
		}
	public function wishlist() {
		$result = array('status'=>'failure','msg'=>'Required fields are missing.');
		$wishlist = file_get_contents('php://input');
		$data = json_decode($wishlist, true);
		$user_id = trim(preg_replace('!\s+!', '',@$data['user_id']));
		$property_id = trim(preg_replace('!\s+!', '',@$data['property_id']));
		if(!empty($user_id) && !empty($property_id)) {
			$getWishlist = $this->master_db->getRecords('property_wishlist',['user_id'=>$user_id,'prid'=>$property_id],'*');
			$getUsers = $this->master_db->getRecords('users',['id'=>$user_id],'*');
			if(count($getUsers) >0) {
				if(count($getWishlist) >0) {
					$result = array('status'=>'failure','msg'=>'Propertyid already exists in wishlist');
				}else {
					$db['user_id'] = $user_id;
	  				$db['prid'] = $property_id;
	  				$db['created_at'] = date('Y-m-d H:i:s');
	  				$in = $this->master_db->insertRecord('property_wishlist',$db);
	  				if($in) {
	  					$result = array('status'=>'success','msg'=>'Added to wishlist');
	  				}else {
	  					$result = array('status'=>'failure','msg'=>'Not added to wishlist');
	  				}
				}	
			}else {
				$result = array('status'=>'failure','msg'=>'Userid not exists');
			}
		}
		echo json_encode($result);
	}
	public function addreviews() {
		$addrevi = file_get_contents("php://input");
		$datas = json_decode($addrevi, true);
		$property_id = trim(@$datas['propertyid']);
		$user_id = trim($datas['userid']);
		$star_rate = trim(@$datas['starrate']);
		$comment = @$datas['comment'];
		//echo "<pre>";print_r($data);exit;
		if(!empty($user_id) && !empty($property_id) && !empty($star_rate)) {
			$getUsers = $this->master_db->getRecords('users',['id'=>$user_id],'*');
			if(count($getUsers) >0) {
				$db['name'] = $getUsers[0]->name;
	        	$db['uid'] = $user_id;
	        	$db['prid'] = $property_id;
	        	$db['rating'] = $star_rate;
	        	$db['reviews'] = $comment;
	        	$db['status'] = -1;
	        	$db['created_at'] = date('Y-m-d H:i:s');
	        	$in = $this->master_db->insertRecord('property_review',$db);
	        	$result = array('status'=>'success','msg'=>'Inserted successfully');
				echo json_encode($result);
			}else {
				$result = array('status'=>'failure','msg'=>'Userid not exists');
				echo json_encode($result);
			}
		}else {
			$result = array('status'=>'failure','msg'=>'Required fields are missing.');
			echo json_encode($result);
		}
	}
	public function reviews() {
		$result = array('status'=>'failure','msg'=>'Required fields are missing.');
		$reviews = file_get_contents('php://input');
		$data = json_decode($reviews, true);
		$property_id = trim(preg_replace('!\s+!', '',@$data['property_id']));
		$user_id = trim(preg_replace('!\s+!', '',@$data['user_id']));
		if(!empty($user_id) && !empty($property_id)) {
			$getUsers = $this->master_db->getRecords('users',['id'=>$user_id],'*');
			if(count($getUsers) >0) {
				$getReviews = $reviews = $this->master_db->getRecords('property_review',['prid'=>$property_id,'uid'=>$user_id,'status'=>0],'id as rid,name as user_name,rating as star_rate,reviews as comment,created_at as added_on');
				if(count($getReviews) >0) {
					foreach ($getReviews as $key => $value) {
						$value->added_on = date('M d Y',strtotime($value->added_on));
					}
					$result = array('status'=>'success','msg'=>$getReviews);
				}else {
					$result = array('status'=>'failure','msg'=>'No data found');
				}
			}else {
				$result = array('status'=>'failure','msg'=>'Userid not exists');
			}
		}
		echo json_encode($result);
	}
	public function autocomplete() {
		$result = array('status'=>'failure','msg'=>'Required fields are missing.');
		$auto = file_get_contents('php://input');
		$data = json_decode($auto, true);
		$searchterm = trim(preg_replace('!\s+!', '',@$data['searchterm']));
		if(!empty($searchterm)) {
			$area = $searchterm;
  			$getarea = 	$this->master_db->sqlExecute('select id,areaname FROM area WHERE areaname like "%'.$area.'%"  order by areaname asc');
  			if(count($getarea) >0) {
  				$result = ['status'=>'success','data'=>$getarea];
  			}else {
  				$result = ['status'=>'failure','msg'=>'No data found'];
  			}
		}
		echo json_encode($result);
	}
	public function propertydetails() {
		$result = array('status'=>'failure','msg'=>'Required fields are missing.');
		$propertydetails = file_get_contents('php://input');
		$data = json_decode($propertydetails, true);
		$property_id = trim(preg_replace('!\s+!', '',@$data['property_id']));
		$user_id = trim(preg_replace('!\s+!', '',@$data['user_id']));
		if(!empty($property_id)) {
			$getProperty = $this->master_db->sqlExecute('select p.id as pid,p.pid as pckid,p.title,p.face as facing,p.bedrooms,p.bathrooms,p.areaid as area,p.availability,p.balcony,p.furnished,p.leedcertificate,p.wateravail as wateravailability,p.price,p.carpark,p.washroom,p.overlooking,p.electricity,p.pname as propertyname,p.ttype,p.lockperiod,p.plotarea,p.unitoffloor,p.seats,p.pantry,p.maintenancecharge,p.paddress as address,p.pcity as city,p.pstate as state,p.pcountry as country,p.parkratio,p.carpetarea,p.nooflift,p.nearbyarea,p.cornerproperty,p.buildingclass,p.prodesc as description,p.prohights,p.floors,p.loading,p.videotype as vtype,p.video_path,pt.name as type,p.cperiod as commission_period,p.status as pstatus,p.orderid as property_id from properties p left join property_type pt on pt.id = p.type left join property_category pc on pc.id = p.ptype where p.id = '.$property_id.' and p.publish=0');
			$recentProperty  =  $this->master_db->getRecords('properties',['id !='=>$property_id,'publish'=>0],'id as pid,title,price,slug','id desc','',"",'3');
			$similar = $this->master_db->getRecords('properties',['id !='=>$getProperty[0]->pid,'publish'=>0],'id as pid,title as name,paddress as location,price,video_path,face as facing,ptype as type','id desc','id','','3');
			$reviews = $this->master_db->getRecords('property_review',['prid'=>$property_id,'status'=>0],'id as rid,name as user_name,rating as star_rate,reviews as comment,created_at as added_on');
			$ownerDetails = [];
			if(!empty($user_id)) {
				$ownerp = [];
				
				$getRentcountinsert = $this->master_db->getRecords('contact_count',['pid'=>$getProperty[0]->pckid,'uid'=>$user_id,'prid'=>$property_id],'*');
				$userPackage = $this->master_db->sqlExecute('select id,properties,pid,expire_date from  user_package where user_id='.$user_id.' and pid in (2,13) order by id desc');
				//echo $this->db->last_query();exit;
				$getRentcount = $this->master_db->getRecords('owner_address',['uid'=>$user_id],'*');
				$getowneraddress = $this->master_db->getRecords('owner_address',['uid'=>$user_id,'prid'=>$getProperty[0]->pid],'*');
         		if(count($getRentcountinsert) >0) {
            	}else {
                	$db['pid'] = $getProperty[0]->pckid;
                	$db['uid'] =$user_id;
                	$db['prid'] = $getProperty[0]->pid;
                	$db['cid'] = 1;
                	$db['status'] = 0;
                	$db['created_at'] = date('Y-m-d H:i:s');
                	$this->master_db->insertRecord('contact_count',$db);
            	}
              	$ar = [];
                 if(count($userPackage) >0) {
                    foreach ($userPackage as $key => $value) {
                        $ar[] = $value->properties;
                    }
                }
                if(count($getRentcount)  >=  array_sum($ar)) {
                }else {
                	if(count($userPackage) >0) {
                		$getOwnerList = $this->master_db->sqlExecute('select p.oname as owner_name,p.oemail as owner_email,p.ophone as owner_phone,p.oaddress as owner_address from properties p where p.id = '.$property_id.' and p.publish=0');
                	 	if(count($getOwnerList) >0) {
                			$ownerp[] =$getOwnerList;
                	 	}
                	}
                	 	
                	 if(count($getowneraddress)>0) {
                    }else { 
                        $dbs['uid'] =$user_id;
                        $dbs['prid'] = $getProperty[0]->pid;
                         $dbs['pid'] = $getProperty[0]->pckid;
                        $dbs['status'] = 0;
                        $dbs['created_at'] = date('Y-m-d H:i:s');
                         $this->master_db->insertRecord('owner_address',$dbs);
                    }
                }
                $ownerDetails[]=$ownerp;
			}
			if(count($getProperty) >0) {
				$re = [];
				foreach ($recentProperty as $recent) {
						$id = $recent->pid; 
						 $getRecentimg = $this->master_db->getRecords('property_gallery',['prid'=>$id],'p_img as images','id desc','','','1');
						 $getRecentimg[0]->images = base_url($getRecentimg[0]->images);
						 $recent->recent_properties = $getRecentimg[0]->images;
						 if(!empty($recent->price)) {
							$recent->price = @number_format($recent->price,2);
						}
				}
				foreach ($similar as $sim) {
						$id = $sim->pid; 
						 $getRecentimg = $this->master_db->getRecords('property_gallery',['prid'=>$id],'p_img as images','id desc','','','1');
						 $getRecentimg[0]->images = base_url($getRecentimg[0]->images);
						 $sim->recent_properties = $getRecentimg[0]->images;
						 if(!empty($sim->price)) {
							$sim->price = @number_format($sim->price,2);
						}
				}
				foreach ($getProperty as $key => $value) {

					$getarea = $this->master_db->getRecords('area',['id'=>$value->area],'id,areaname');
					$value->area = $getarea[0]->areaname;
					if(!empty($value->price)) {
						$value->price = @number_format($value->price,2);
					}
					$cperiod = $value->commission_period;
					$pstatus = $value->pstatus;
					if($value->commission_period == 1) {
						$value->commission_period = "15 Days";
					}else if($value->commission_period == 2) {
						$value->commission_period = "1 Month";
					}
					else if($value->commission_period == 3) {
						$value->commission_period = "No Commission";
					}

					if($pstatus ==0) {
						$value->pstatus ="Active";
					}else if($pstatus ==1) {
						$value->pstatus ="Deactive";
					}
					$id = $value->pid;
					$vtype = $value->vtype;
					$pstate = $value->state;
					$pcity = $value->city;
					$image = $this->master_db->getRecords('property_gallery',['prid'=>$id],'p_img as image');
					$state = $this->master_db->getRecords('states',['id'=>$pstate],'name');
					$city = $this->master_db->getRecords('cities',['id'=>$pcity],'cname as name');
					$amenity = $this->app_db->getAmenities($id);
					foreach ($image as $img) {
						$img->image = base_url($img->image);
					}
					$value->gallery = $image;
					$value->amenity = $amenity;
					$value->state = $state[0]->name;
					$value->city = $city[0]->name;
					if($vtype ==1) {
						$value->vtype = "Upload Video";
					}
					else if($vtype ==2) {
						$value->vtype = "Youtube Link";
					}
					else if($vtype ==0) {
						$value->vtype = "";
					}
					$value->reviewcount = count($reviews);
				}
				foreach ($reviews as $rev) {
					$rev->added_on = date('M d Y',strtotime($rev->added_on));
				}
				$ownerKit =[];
				if(is_array($ownerDetails) && count($ownerDetails)) {
					$ownerKit[]=['owner_name'=>@$ownerDetails[0][0][0]->owner_name,'owner_email'=>@$ownerDetails[0][0][0]->owner_email,'owner_phone'=>@$ownerDetails[0][0][0]->owner_phone,'owner_address'=>@$ownerDetails[0][0][0]->owner_address];
				}
				
					$result = ['status'=>'success','banner_img'=>base_url('assets/images/bg/home-171.jpg'),'property_data'=>$getProperty,'recent_properties'=>$recentProperty,'similar_properties'=>$similar,'reviews'=>$reviews,'ownerDetails'=>$ownerKit];
			
				}else {
				$result = array('status'=>'failure','msg'=>'No data found.');
			}
		//echo "<pre>";print_r();exit;
		}
		echo json_encode($result);
	}
	public function profile() {
		$result = array('status'=>'failure','msg'=>'Required fields are missing.');
		$profile = file_get_contents('php://input');
		$data = json_decode($profile, true);
		$user_id = trim(preg_replace('!\s+!', '',@$data['user_id']));
		if(!empty($user_id)) {
			$getUsers = $this->master_db->getRecords('users',['id'=>$user_id],'name,email,phone as mobile,address');
			if(count($getUsers) >0) {
				$result = ['status'=>'success','name'=>$getUsers[0]->name,'email'=>$getUsers[0]->email,'mobile'=>$getUsers[0]->mobile,'address'=>$getUsers[0]->address];
			}else {
				$result = ['status'=>'failure','msg'=>'Userid not exists'];
			}
		}
		echo json_encode($result);
	}
	public function updateprofile() {
		$result = array('status'=>'failure','msg'=>'Required fields are missing.');
		$updatep = file_get_contents('php://input');
		$data = json_decode($updatep, true);
		$user_id = trim(preg_replace('!\s+!', '',@$data['user_id']));
		$name = trim(preg_replace('!\s+!', '',@$data['name']));
		$email = trim(preg_replace('!\s+!', '',@$data['email']));
		$mobile = trim(preg_replace('!\s+!', '',@$data['mobile']));
		$address = trim(preg_replace('!\s+!', '',@$data['address']));
		if(!empty($user_id) && !empty($name) && !empty($mobile)) {
			$getUsers = $this->master_db->getRecords('users',['id'=>$user_id],'*');
			if(count($getUsers) >0) {
				$db['name'] = $name;
				$db['email'] = $email;
				$db['phone'] = $mobile;
				$db['address'] = $address;
				$db['modified_date'] = date('Y-m-d H:i:s');
				$upd = $this->master_db->updateRecord('users',$db,['id'=>$user_id]);
				$result = ['status'=>'success','msg'=>'Profile updated successfully'];
			}else {
				$result = ['status'=>'failure','msg'=>'Userid not exists'];
			}
		}
		echo json_encode($result);
	}
	public function subscriptionplanlist() {
		$result = array('status'=>'failure','msg'=>'Required fields are missing.');
		$subscribeplan = file_get_contents('php://input');
		$data = json_decode($subscribeplan, true);
		$user_id = trim(preg_replace('!\s+!', '',@$data['user_id']));
		if(!empty($user_id)) {
			$getUsers = $this->master_db->getRecords('users',['id'=>$user_id],'*');
			if(count($getUsers) >0) {
				$getSubscribe = $this->master_db->sqlExecute('select p.id as pid,p.title,up.price,up.expire_date,up.created_at,up.properties,p.pprice as price from packages p left join user_package up on up.pid = p.id where up.user_id='.$user_id.'');
				if(count($getSubscribe) >0) {
					foreach ($getSubscribe as $key => $value) {
						  $date1 = date_create($value->expire_date);
                          $date2 = date_create($value->created_at);
                          $date3 = date_create(date('Y-m-d'));
                          $datediff = date_diff($date1,$date2);
                          $datediff1 = date_diff($date1,$date3);
                          $validdays = $datediff1->format('%a Days');
                          $validity = $datediff->format('%a Days');
                          $packageexpire = date('d-m-Y',strtotime($value->expire_date));
                          $value->validity =$validity;
                          $value->noofdaysleft = $validdays;
                          $value->packageexpiredate = $packageexpire;
                          $value->expire_date = date('d-m-Y',strtotime($value->expire_date));
                          $value->created_at = date('d-m-Y',strtotime($value->created_at));
					}
					$result = ['status'=>'success','msg'=>$getSubscribe];
				}else {
					$result = ['status'=>'failure','msg'=>'No data found'];
				}
			}else {
				$result = ['status'=>'failure','msg'=>'Userid not exists'];
			}
		}
		echo json_encode($result);
	}
	public function favouriteproperties() {
		$result = array('status'=>'failure','msg'=>'Required fields are missing.');
		$favouritep = file_get_contents('php://input');
		$data = json_decode($favouritep, true);
		$user_id = trim(preg_replace('!\s+!', '',@$data['user_id']));
		if(!empty($user_id)) {
			 $getWishlist = $this->app_db->getwishlist($user_id);
			 foreach ($getWishlist as $key => $value) {
			 	$id = $value->id;
			 	$value->added_on = date('d-m-Y',strtotime($value->added_on));
			 	$getImg = $this->master_db->sqlExecute('select p_img from property_gallery where prid='.$id.' order by id asc limit 1');
			 	$getImg[0]->p_img = base_url($getImg[0]->p_img);
			 	$value->image = $getImg[0]->p_img ;
			 }
			 $result = ['status'=>'success','favourite_property'=>$getWishlist];
		}
		echo json_encode($result);
	}
	public function deletefavouriteproperty() {
		$result = array('status'=>'failure','msg'=>'Required fields are missing.');
		$deletepr = file_get_contents('php://input');
		$data = json_decode($deletepr, true);
		$user_id = trim(preg_replace('!\s+!', '',@$data['user_id']));
		$property_id = trim(preg_replace('!\s+!', '',@$data['property_id']));
		if(!empty($user_id) && !empty($property_id)) {
			$getUsers = $this->master_db->getRecords('users',['id'=>$user_id],'*');
			if(count($getUsers) >0) {
				$del = $this->master_db->deleterecord('property_wishlist',['user_id'=>$user_id,'prid'=>$property_id]);
				$result = ['status'=>'success','msg'=>'Deleted successfully'];
			}else {
				$result = ['status'=>'failure','msg'=>'Userid not exists'];
			}
		}
		echo json_encode($result);
	}
	public function contactlist() {
		$result = array('status'=>'failure','msg'=>'Required fields are missing.');
		$contactlist = file_get_contents('php://input');
		$data = json_decode($contactlist, true);
		$user_id = trim(preg_replace('!\s+!', '',@$data['user_id']));
		if(!empty($user_id)) {
			$getUsers = $this->master_db->getRecords('users',['id'=>$user_id],'*');
			if(count($getUsers) >0) {
				$getContact = $this->app_db->getContactlist($user_id);
				if(count($getContact) >0) {
					$result = ['status'=>'success','contact_data'=>$getContact];
				}else {
					$result = ['status'=>'failure','msg'=>'Zero contacts'];
				}
			}else {
				$result = ['status'=>'failure','msg'=>'Userid not exists'];
			}
		}
		echo json_encode($result);
	}
	public function changepassword() {
		$result = array('status'=>'failure','msg'=>'Required fields are missing.');
		$cpass = file_get_contents('php://input');
		$data = json_decode($cpass, true);
		$user_id = trim(preg_replace('!\s+!', '',@$data['user_id']));
		$cpass = trim(preg_replace('!\s+!', '',@$data['cpass']));
		$npass = trim(preg_replace('!\s+!', '',@$data['npass']));
		if(!empty($user_id)) {
			$getUsers = $this->master_db->getRecords('users',['id'=>$user_id],'*');
			if(count($getUsers) >0) {
				if(password_verify($cpass, $getUsers[0]->password)) {
					$hash = password_hash($npass, PASSWORD_BCRYPT);
        			$db['password'] = $hash;
        			$this->master_db->updateRecord('users',$db,['id'=>$user_id]);
        			$result = ['status'=>'success','msg'=>'Password updated successfully'];
				}else {
					$result = ['status'=>'failure','msg'=>'Current password not match'];
				}
			}else {
				$result = ['status'=>'failure','msg'=>'Userid not exists'];
			}
		}
		echo json_encode($result);
	}
	public function addpackage() {
		 $result = array('status'=>'failure','msg'=>'Required fields are missing.');
		$renewpackage = file_get_contents('php://input');
		$data = json_decode($renewpackage, true);
		$user_id = trim(preg_replace('!\s+!', '',@$data['user_id']));
		$p_id = trim(preg_replace('!\s+!', '',@$data['p_id']));
		if(!empty($user_id) && !empty($p_id)) {
			$getPackage = $this->master_db->sqlExecute('select * from packages where status =0 and id in ('.$p_id.')');
			$getUsers = $this->master_db->getRecords('users',['id'=>$user_id],'*');
			if(count($getUsers) >0) {
					if(count($getPackage) >0) {
						$inid =[];$amt =[];
						foreach ($getPackage as $key => $value) {
							$amt[] = $value->pprice;
							$month = (int)filter_var($value->nmonths,FILTER_SANITIZE_NUMBER_INT);
							$dbs['user_id'] = $user_id;
							$dbs['pid'] = $value->id;
							$dbs['price'] = $value->pprice;
							$dbs['months'] = (int)filter_var($value->nmonths,FILTER_SANITIZE_NUMBER_INT);
							$dbs['pictures'] = (int)filter_var($value->npictures,FILTER_SANITIZE_NUMBER_INT);
							$dbs['properties'] = (int)filter_var($value->nproperties,FILTER_SANITIZE_NUMBER_INT);
							$dbs['expire_date'] = date('Y-m-d',strtotime('+'.$month.' month'));
							$dbs['type'] = $value->type;
							$dbs['orderno'] = "sqft9".rand(12345,98765);
							$dbs['created_at'] = date('Y-m-d');
							$ins = $this->master_db->insertRecord('user_package',$dbs);
						}
								$api = new Api(TEST_MERCHANT_KEY, TEST_MERCHANT_SECRET);
        						$order  = $api->order->create(array('receipt' =>rand(11111,99999), 'amount' => array_sum($amt)*100, 'currency' => "INR"));
        						$orderId = $order['id'];
								$payment['user_id'] = $user_id;
								if(!empty($orderId)) {
									$payment['status'] =-1;
									$payment['created_at'] = date('Y-m-d H:i:s');
									$payment['pamount'] =array_sum($amt);
									$payment['porderid'] = $orderId;
									$payment['pstatus'] = "pending";
								}else {
									$payment['status'] = -1;
								}
								$this->master_db->insertRecord('payment_log',$payment);
								$paid_amount['paid_amount'] = array_sum($amt);
								$paid_amount['payment_mode'] = "Online";
								$paid_amount['order_id'] =  $orderId;
								$paid_amount['razorpay_apikey'] = TEST_MERCHANT_KEY;
								$paid_amount['currency_type'] = 'INR';
								$paid_amount['razor_callback'] = base_url().'v1/razorpayResponse';
								$result = ['status'=>'success','payment_response'=>$paid_amount];
					}else {
						$result = array('status'=>'failure','msg'=>'No package found');
					}
			}else {
				$result = ['status'=>'failure','msg'=>'Userid not exists'];
			}
		}
		echo json_encode($result);
	}
	public function renewpackage() {
		 $result = array('status'=>'failure','msg'=>'Required fields are missing.');
		$renewpackage = file_get_contents('php://input');
		$data = json_decode($renewpackage, true);
		$user_id = trim(preg_replace('!\s+!', '',@$data['user_id']));
		$p_id = trim(preg_replace('!\s+!', '',@$data['p_id']));
		if(!empty($user_id) && !empty($p_id)) {
			$getPackage = $this->master_db->sqlExecute('select * from packages where status =0 and id in ('.$p_id.')');
			$getUsers = $this->master_db->getRecords('users',['id'=>$user_id],'*');
			if(count($getUsers) >0) {
					if(count($getPackage) >0) {
						$inid =[];$amt =[];
						foreach ($getPackage as $key => $value) {
							$amt[] = $value->pprice;
							$month = (int)filter_var($value->nmonths,FILTER_SANITIZE_NUMBER_INT);
							$dbs['user_id'] = $user_id;
							$dbs['pid'] = $value->id;
							$dbs['price'] = $value->pprice;
							$dbs['months'] = (int)filter_var($value->nmonths,FILTER_SANITIZE_NUMBER_INT);
							$dbs['pictures'] = (int)filter_var($value->npictures,FILTER_SANITIZE_NUMBER_INT);
							$dbs['properties'] = (int)filter_var($value->nproperties,FILTER_SANITIZE_NUMBER_INT);
							$dbs['expire_date'] = date('Y-m-d',strtotime('+'.$month.' month'));
							$dbs['type'] = $value->type;
							$dbs['orderno'] = "sqft9".rand(12345,98765);
							$dbs['created_at'] = date('Y-m-d');
							$ins = $this->master_db->insertRecord('user_package',$dbs);
						}
								$api = new Api(TEST_MERCHANT_KEY, TEST_MERCHANT_SECRET);
        						$order  = $api->order->create(array('receipt' =>rand(11111,99999), 'amount' => array_sum($amt)*100, 'currency' => "INR"));
        						$orderId = $order['id'];
								$payment['user_id'] = $user_id;
								if(!empty($orderId)) {
									$payment['status'] =-1;
									$payment['created_at'] = date('Y-m-d H:i:s');
									$payment['pamount'] =array_sum($amt);
									$payment['porderid'] = $orderId;
									$payment['pstatus'] = "pending";
								}else {
									$payment['status'] = -1;
								}
								$this->master_db->insertRecord('payment_log',$payment);
								$paid_amount['paid_amount'] = array_sum($amt);
								$paid_amount['payment_mode'] = "Online";
								$paid_amount['order_id'] =  $orderId;
								$paid_amount['razorpay_apikey'] = TEST_MERCHANT_KEY;
								$paid_amount['currency_type'] = 'INR';
								$paid_amount['razor_callback'] = base_url().'v1/razorpayResponse';
								$result = ['status'=>'success','payment_response'=>$paid_amount];
					}else {
						$result = array('status'=>'failure','msg'=>'No package found');
					}
			}else {
				$result = ['status'=>'failure','msg'=>'Userid not exists'];
			}
		}
		echo json_encode($result);
	}
	public function forgotpassword() {
		$result = array('status'=>'failure','msg'=>'Required fields are missing.');
		$forgot = file_get_contents('php://input');
		$data = json_decode($forgot, true);
		$email_id = trim(preg_replace('!\s+!', '',@$data['email_id']));
		if(!empty($email_id)) {
			$getUsers = $this->master_db->getRecords('users',['email'=>$email_id],'*');
			if(count($getUsers) >0) {
				$result = ['status'=>'success','msg'=>'Email sent successfully'];
			}else {
				$result = ['status'=>'failure','msg'=>'Email not exists'];
			}
		}
		echo json_encode($result);
	}
	public function apilist() {
        $result = array('status'=>'failure','msg'=>'Required fields are missing.');
		$renewpackage = file_get_contents('php://input');
		$data = json_decode($renewpackage, true);
		$user_id = trim(preg_replace('!\s+!', '',@$data['user_id']));
		$p_id = trim(preg_replace('!\s+!', '',@$data['p_id']));
		if(!empty($user_id) && !empty($p_id)) {
			$getPackage = $this->master_db->sqlExecute('select * from packages where status =0 and id in ('.$p_id.')');
			$getUsers = $this->master_db->getRecords('users',['id'=>$user_id],'*');
			if(count($getUsers) >0) {
					if(count($getPackage) >0) {
						$inid =[];$amt =[];
						foreach ($getPackage as $key => $value) {
							$amt[] = $value->pprice;
							$month = (int)filter_var($value->nmonths,FILTER_SANITIZE_NUMBER_INT);
							$dbs['user_id'] = $user_id;
							$dbs['pid'] = $value->id;
							$dbs['price'] = $value->pprice;
							$dbs['months'] = (int)filter_var($value->nmonths,FILTER_SANITIZE_NUMBER_INT);
							$dbs['pictures'] = (int)filter_var($value->npictures,FILTER_SANITIZE_NUMBER_INT);
							$dbs['properties'] = (int)filter_var($value->nproperties,FILTER_SANITIZE_NUMBER_INT);
							$dbs['expire_date'] = date('Y-m-d',strtotime('+'.$month.' month'));
							$dbs['type'] = $value->type;
							$dbs['orderno'] = "sqft9".rand(12345,98765);
							$dbs['created_at'] = date('Y-m-d');
							$ins = $this->master_db->insertRecord('user_package',$dbs);
						}
								$api = new Api(TEST_MERCHANT_KEY, TEST_MERCHANT_SECRET);
        						$order  = $api->order->create(array('receipt' =>rand(11111,99999), 'amount' => array_sum($amt)*100, 'currency' => "INR"));
        						$orderId = $order['id'];
								$payment['user_id'] = $user_id;
								if(!empty($orderId)) {
									$payment['status'] =-1;
									$payment['created_at'] = date('Y-m-d H:i:s');
									$payment['pamount'] =array_sum($amt);
									$payment['porderid'] = $orderId;
									$payment['pstatus'] = "pending";
								}else {
									$payment['status'] = -1;
								}
								$this->master_db->insertRecord('payment_log',$payment);
								$paid_amount['paid_amount'] = array_sum($amt);
								$paid_amount['payment_mode'] = "Online";
								$paid_amount['order_id'] =  $orderId;
								$paid_amount['razorpay_apikey'] = TEST_MERCHANT_KEY;
								$paid_amount['currency_type'] = 'INR';
								$paid_amount['razor_callback'] = 'razorpayResponse';
								$result = ['status'=>'success','payment_response'=>$paid_amount];
					}else {
						$result = array('status'=>'failure','msg'=>'No package found');
					}
			}else {
				$result = ['status'=>'failure','msg'=>'Userid not exists'];
			}
		}
		echo json_encode($result);
	}
	public function razorpayResponse() {
			//error_reporting(1);ini_set('display_errors', TRUE);
			$result = array('status'=>'failure','msg'=>'Required fields are missing.');
			$response = file_get_contents('php://input');
			$razorresponse = json_decode($response, true);
			$user_id = trim(preg_replace('!\s+!', '',$razorresponse['user_id']));
			$paymentID = trim(preg_replace('!\s+!', '',$razorresponse['paymentID']));
			$orderID = trim(preg_replace('!\s+!', '',$razorresponse['orderID']));
			$signature = trim(preg_replace('!\s+!', '',$razorresponse['signature']));
			if(!empty($user_id) && !empty($paymentID) && !empty($signature)) {
				$getOrder = $this->master_db->getRecords('payment_log',['porderid'=>$orderID],'*');
				 $new = new Api(TEST_MERCHANT_KEY, TEST_MERCHANT_SECRET);
				 $payid =$new->payment->fetch($paymentID);
				 $generatedHash = hash_hmac('sha256',$orderID."|".$paymentID,TEST_MERCHANT_SECRET);
				 if($generatedHash ==$signature) {
					 $payarr = array(
					 		"pay_id"=>$paymentID,
					 		'status' => 1,
					 		"signature"=>$signature,
					 		"pstatus"=>'success',
					 );
					 $this->master_db->updateRecord('payment_log',$payarr,['user_id' =>$user_id,'id'=>$getOrder[0]->id]);
					 $result = ['status'=>'success','response'=>'success'];
				 }else{
					 $payarr = array(
					 		"status"=>'-1',
					 		'pstatus'=>"failure"
					 );
					 $this->master_db->updateRecord('payment_log',$payarr,['user_id' =>$user_id,'id'=>$getOrder[0]->id]);
					 $result = ['status'=>'failure','response'=>'failure'];
				}
			}
			echo json_encode($result);
		}
}