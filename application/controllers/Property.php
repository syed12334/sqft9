<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Property extends CI_Controller {
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
                $details = $this->home_db->getlogin($sessionval['email']);
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
    public function index() {
        $this->load->view('admin/index',$this->data);
    }
    public function addproperty() {
        $det = $this->data['detail'];
        $id = $det[0]->id;
        $getPackage = $this->master_db->getRecords('user_package',['user_id'=>$id],'id,pictures,pid,properties');
        //echo $this->db->last_query($getPackage);exit;
        $this->data['getPicture'] = $getPackage;
        $this->data['type'] = "add";
        $this->data['uid'] = $id;
        $getProperty = $this->master_db->getRecords('properties',['uid'=>$id],'*');
        //echo $this->db->last_query();exit;
        $this->data['propertycount'] =count($getProperty);
        $this->data['category'] = $this->master_db->getRecords('property_category',['status'=>0],'id,name','name asc');
        $this->data['states'] = $this->master_db->getRecords('states',['status'=>0],'id,name','name asc');
        $this->data['city'] = $this->master_db->getRecords('cities',['status'=>0],'id,cname','cname asc');
        $amenities = $this->master_db->getRecords('amenities',['status!='=>-1],'id,title');
         $this->data['amenities'] = $amenities;
        $area = $this->master_db->getRecords('area',['status'=>0],'id,areaname');
        $this->data['area'] = $area;
    	$this->load->view('admin/add-property',$this->data);
    }
    public function registerproperty() {
            $det = $this->data['detail'];
            $id = $det[0]->id;
        //echo "<pre>";print_r($_POST);print_r($_FILES);exit;
            $title = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('title', true))));
            $package = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('package', true))));
            $ptype = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('ptype', true))));
            $ownerrole = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('ownerrole', true))));
            $face = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('face', true))));
            $rtype = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('rtype', true))));
            $bitype = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('bitype', true))));
            $prodesc = $this->input->post('prodesc');
            $bed = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('bed', true))));
            $bed1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('bed1', true))));
            $bed2 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('bed2', true))));
            $bath = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('bath', true))));
            $bath1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('bath1', true))));
            $bath2 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('bath2', true))));
            $area = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('area', true))));
            $area1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('area1', true))));
            $area2 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('area2', true))));
            $area3 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('area3', true))));
            $area4 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('area4', true))));
            $area5 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('area5', true))));
            $area6 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('area6', true))));
            $avail = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('avail', true))));
            $avail1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('avail1', true))));
            $avail2 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('avail2', true))));
            $carpark = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('carpark', true))));
            $carpark1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('carpark1', true))));
            $carpark2 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('carpark2', true))));
            $carpark3 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('carpark3', true))));
            $carpark4 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('carpark4', true))));
            $carpark5 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('carpark5', true))));
            $carpark6 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('carpark6', true))));
            $carpark7 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('carpark7', true))));
            $price = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('price', true))));
            $price1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('price1', true))));
            $floors = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('floors', true))));
            $floors1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('floors1', true))));
            $floors2 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('floors2', true))));
            $floors3 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('floors3', true))));
            $floors4 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('floors4', true))));
            $floors5 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('floors5', true))));
            $furnished = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('furnished', true))));
            $furnished1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('furnished1', true))));
            $furnished2 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('furnished2', true))));
            $furnished3 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('furnished3', true))));
            $furnished4 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('furnished4', true))));
            $furnished5 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('furnished5', true))));
            $balcony = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('balcony', true))));
            $balcony1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('balcony1', true))));
            
            $leedcertificate = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('leedcertificate', true))));
            $cornerproperty = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('cornerproperty', true))));
            $cornerproperty11 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('cornerproperty1', true))));
            $cornerproperty2 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('cornerproperty2', true))));
            $overlooking = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('overlooking', true))));
            $overlooking1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('overlooking1', true))));
            $overlooking2 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('overlooking2', true))));
            $overlooking3 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('overlooking3', true))));
            $lockperiod = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('lockperiod', true))));
            $lockperiod1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('lockperiod1', true))));
            $lockperiod2 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('lockperiod2', true))));
            $buildingclass = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('buildingclass', true))));
            $buildingclass1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('buildingclass1', true))));
            $projectname = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('projectname', true))));
            $electricity = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('electricity', true))));
            $ttype = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('ttype', true))));
            $highlights = $this->input->post('highlights');
            $overlooking = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('overlooking', true))));
            $plotarea = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('plotarea', true))));
            $plotarea1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('plotarea1', true))));
            $unitofloor = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('unitofloor', true))));
            $unitofloor1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('unitofloor1', true))));
            $maintenance = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('maintenance', true))));
            $maintenance1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('maintenance1', true))));
            $parkingratio = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('parkingratio', true))));
        
            $carpetarea = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('carpetarea', true))));
            $nooflift = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('nooflift', true))));
            $address = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('address', true))));
            $city = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('city', true))));
            $state = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('state', true))));
            $country = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('country', true))));
            $cperiod = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('cperiod', true))));
            $atype = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('atype', true))));
            $areaname = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('areaname', true))));
            $vtype = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('vtype', true))));
            $ylink = $this->input->post('ylink');

            if(!empty($ylink)) {
                $url = parse_url($ylink);
            $vid = parse_str($url['query'], $output);
            $video_id = $output['v']; 
            }
           
            $ownerAddress = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('owneraddress', true))));
            $maps = $this->input->post('maps');
            $amenities =$this->input->post('amenities');
            $nearby = $this->input->post('nearby');
            $slug = $this->home_db->create_unique_slug($title,'properties','slug');
            $getPackagetype = $this->master_db->getRecords('packages',['id'=>$package],'type');
            if(!empty($package)) {
                 $db['pid'] = $package;
            }
             if(!empty($ptype)) {
                 $db['ptype'] = $ptype;
            }
            $db['type'] = $getPackagetype[0]->type;
               if(!empty($ownerrole)) {
                 $db['ownerrole'] = $ownerrole;
            }
            if(!empty($cperiod)) {
                $db['cperiod'] = $cperiod;
            }
            if(!empty($atype)) {
                $db['atype'] = $atype;
            }
            if(!empty($areaname)) {
                $db['areaid'] = $areaname;
            }
            if(!empty($title)) {
                $db['title'] = $title;
            }
            if(!empty($face)) {
                $db['face'] = $face;
            }
            if(!empty($rtype)) {
                $db['rtype'] = $rtype;
            }
            if(!empty($bitype)) {
                $db['bitype'] = $bitype;
            }
             if(!empty($bed)) {
                $db['bedrooms'] = $bed;
            }
             if(!empty($bed1)) {
                $db['bedrooms'] = $bed1;
            }
             if(!empty($bed2)) {
                $db['bedrooms'] = $bed2;
            }
             if(!empty($bath)) {
                $db['bathrooms'] = $bath;
            }
              if(!empty($bath1)) {
                $db['bathrooms'] = $bath1;
            }
              if(!empty($bath2)) {
                $db['bathrooms'] = $bath2;
            }
             if(!empty($area)) {
                $db['area'] = $area;
            }
            if(!empty($area1)) {
                $db['area'] = $area1;
            }
            if(!empty($area2)) {
                $db['area'] = $area2;
            }
             if(!empty($area3)) {
                $db['area'] = $area3;
            }
            if(!empty($area4)) {
                $db['area'] = $area4;
            }
            if(!empty($area5)) {
                $db['area'] = $area5;
            }
            if(!empty($area6)) {
                $db['area'] = $area6;
            }
             if(!empty($avail)) {
                $db['availability'] = $avail;
            }
             if(!empty($avail1)) {
                $db['availability'] = $avail1;
            }
             if(!empty($avail2)) {
                $db['availability'] = $avail2;
            }
             if(!empty($balcony)) {
                $db['balcony'] = $balcony;
            }
            if(!empty($balcony1)) {
                $db['balcony'] = $balcony1;
            }
             if(!empty($furnished)) {
                $db['furnished'] = $furnished;
            }
            if(!empty($furnished1)) {
                $db['furnished'] = $furnished1;
            }
            if(!empty($furnished2)) {
                $db['furnished'] = $furnished2;
            }
            if(!empty($furnished3)) {
                $db['furnished'] = $furnished3;
            }
            if(!empty($furnished4)) {
                $db['furnished'] = $furnished4;
            }
            if(!empty($furnished5)) {
                $db['furnished'] = $furnished5;
            }
             if(!empty($leedcertificate)) {
                $db['leedcertificate'] = $leedcertificate;
            }
             if(!empty($price)) {
                $db['price'] = $price;
            }
             if(!empty($price1)) {
                $db['price'] = $price1;
            }
             if(!empty($carpark)) {
                $db['carpark'] = $carpark;
            }
             if(!empty($carpark1)) {
                $db['carpark'] = $carpark1;
            }
             if(!empty($carpark2)) {
                $db['carpark'] = $carpark2;
            }
             if(!empty($carpark3)) {
                $db['carpark'] = $carpark3;
            }
             if(!empty($carpark4)) {
                $db['carpark'] = $carpark4;
            }
             if(!empty($carpark5)) {
                $db['carpark'] = $carpark5;
            }
             if(!empty($carpark6)) {
                $db['carpark'] = $carpark6;
            }
             if(!empty($carpark7)) {
                $db['carpark'] = $carpark7;
            }
           
             if(!empty($overlooking)) {
                $db['overlooking'] = $overlooking;
            }

             if(!empty($overlooking1)) {
                $db['overlooking'] = $overlooking1;
            }

              if(!empty($overlooking2)) {
                $db['overlooking'] = $overlooking2;
            }

              if(!empty($overlooking3)) {
                $db['overlooking'] = $overlooking3;
            }
           
             if(!empty($projectname)) {
                $db['pname'] = $projectname;
            }
             if(!empty($ttype)) {
                $db['ttype'] = $ttype;
            }
             if(!empty($lockperiod)) {
                $db['lockperiod'] = $lockperiod;
            }
             if(!empty($lockperiod1)) {
                $db['lockperiod'] = $lockperiod1;
            }
             if(!empty($lockperiod2)) {
                $db['lockperiod'] = $lockperiod2;
            }
             if(!empty($lockperiod3)) {
                $db['lockperiod'] = $lockperiod3;
            }
             if(!empty($plotarea)) {
                $db['plotarea'] = $plotarea;
            }
            if(!empty($plotarea1)) {
                $db['plotarea'] = $plotarea1;
            }
             if(!empty($unitoffloor)) {
                $db['unitoffloor'] = $unitoffloor;
            }
             if(!empty($unitoffloor1)) {
                $db['unitoffloor'] = $unitoffloor1;
            } 
           
             if(!empty($maintenance)) {
                $db['maintenancecharge'] = $maintenance;
            }
             if(!empty($maintenance1)) {
                $db['maintenancecharge'] = $maintenance1;
            }
            if(!empty($address)) {
                $db['paddress'] = $address;
            }
             if(!empty($city)) {
                $db['pcity'] = $city;
            }
             if(!empty($state)) {
                $db['pstate'] = $state;
            }
             if(!empty($country)) {
                $db['pcountry'] = $country;
            }
             if(!empty($maps)) {
                $db['embedmap'] = $maps;
            }
             if(!empty($parkingratio)) {
                $db['parkratio'] = $parkingratio;
            }
            
                $db['oname'] = $det[0]->name;
            
                $db['ophone'] = $det[0]->phone;
           
            
                $db['oemail'] = $det[0]->email;
          
            
             if(!empty($carpetarea)) {
                $db['carpetarea'] = $carpetarea;
            }
             if(!empty($nooflift)) {
                $db['nooflift'] = $nooflift;
            }
             if(!empty($nearby)) {
                $db['nearbyarea'] = $nearby;
            }
             if(!empty($cornerproperty)) {
                $db['cornerproperty'] = $cornerproperty;
            }
            if(!empty($cornerproperty1)) {
                $db['cornerproperty'] = $cornerproperty1;
            }
            if(!empty($cornerproperty2)) {
                $db['cornerproperty'] = $cornerproperty2;
            }
             if(!empty($buildingclass)) {
                $db['buildingclass'] = $buildingclass;
            }
             if(!empty($buildingclass1)) {
                $db['buildingclass'] = $buildingclass1;
            }
             if(!empty($prodesc)) {
                $db['prodesc'] = $prodesc;
            }
            if(!empty($highlights)) {
                $db['prohights'] = $highlights;
            }
             if(!empty($floors)) {
                $db['floors'] = $floors;
            }
            if(!empty($floors1)) {
                $db['floors'] = $floors1;
            }
            if(!empty($floors2)) {
                $db['floors'] = $floors2;
            }
            if(!empty($floors3)) {
                $db['floors'] = $floors3;
            }
            if(!empty($floors4)) {
                $db['floors'] = $floors4;
            }
            if(!empty($floors5)) {
                $db['floors'] = $floors5;
            }
           
            $db['uid'] = $id;
            $db['slug'] =$slug;
            $db['status'] = 0;
            $db['publish'] = -1;
            if(!empty($vtype)) {
                    $db['videotype'] = $vtype;
                    if(!empty($_FILES['uvideo']['name'])) {
                        $uploadPath = './assets/images/property_gallery/';
                        $config['upload_path'] = $uploadPath;
                        $config['allowed_types'] = 'mp4';
                        $config['max_size'] = '2000000';
                        $ext = pathinfo($_FILES["uvideo"]['name'], PATHINFO_EXTENSION);
                        $new_name = "sqft9".rand(11111,99999).'.'.$ext; 
                        $config['file_name'] = $new_name;
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if(!$this->upload->do_upload('uvideo')){
                            $this->session->set_flashdata("message","<div class='alert alert-danger'>".$this->upload->display_errors()."</div>");
                                redirect('property/myproperty');  
                        }else {
                            $upload_data = $this->upload->data();
                            $db['video_path'] =  'assets/images/property_gallery/'.$upload_data['file_name']; 
                        }
                    }
                    if(!empty($ylink)) {
                        $d['video_path'] = $video_id;
                    }
            }
            
            $db['created_at'] = date('Y-m-d H:i:s');
            $getPackage = $this->master_db->getRecords('user_package',['user_id'=>$id,'pid'=>$package],'pictures,properties,expire_date');
           // echo $this->db->last_query();exit;
            $this->session->set_userdata('properties',$getPackage[0]->properties);
            $this->session->set_userdata('propictures',$getPackage[0]->pictures);
            $cdate = date('Y-m-d');
            $getProperty = $this->master_db->getRecords('properties',['pid'=>$package,'uid'=>$id],'*');
            $count = count($getProperty);
            if($cdate  >=$getPackage[0]->expire_date ) {
                $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Package expired renew now</div>');
                redirect('property/myproperty');
            }else {
                 if($count == $getPackage[0]->properties) {
                        $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Dear, Member you have already reached the '.$this->session->userdata('properties').' properties limit in this package. Kindly upgrade your  subscription package to post more properties. Thanks</div>');
                        redirect('property/myproperty');
                 }
                else {
                  
                    $getImages = $this->master_db->getRecords('property_gallery',['user_id'=>$id,'pid'=>$package],'*');
                   // echo $this->db->last_query();exit;
                        $getImagecount = 5;
                         $countimg = count($_FILES['gallery']['name']);
                
                            $in = $this->master_db->insertRecord('properties',$db);
                        
                         
                    if($in) {
                        $orderNo = $this->home_db->generateOrderNo($in);
                         $db = array('orderid' => $orderNo);
                        $this->master_db->updateRecord('properties',$db,['id'=>$in]);
                        if( is_array($amenities)) {
                            foreach ($amenities as $key =>$val) { 
                               $dbs['user_id'] = $id;
                               $dbs['prid'] = $in;
                               $dbs['p_amenities'] = $val;
                               $dbs['created_at'] = date('Y-m-d H:i:s');
                               $this->master_db->insertRecord('property_amenities',$dbs);
                            }
                        }
                        if(count($_FILES['gallery']['name']) >0) {
                                   
                                    for($i = 0; $i < count($_FILES["gallery"]["name"]); $i++){ 
                                        $_FILES['files']['name']       = $_FILES['gallery']['name'][$i];
                                        $_FILES['files']['type']       = $_FILES['gallery']['type'][$i];
                                        $_FILES['files']['tmp_name']   = $_FILES['gallery']['tmp_name'][$i];
                                        $_FILES['files']['error']      = $_FILES['gallery']['error'][$i];
                                        $_FILES['files']['size']       = $_FILES['gallery']['size'][$i];
                                        $uploadPath = './assets/images/property_gallery/';
                                        $config1 = array();
                                        $config1['upload_path'] = $uploadPath;
                                        $config1['allowed_types'] = 'jpg|jpeg|png|JPEG|JPG|PNG';
                                         $config1['max_size'] = '20000000';
                                        $ext = pathinfo($_FILES["gallery"]['name'][$i], PATHINFO_EXTENSION);
                                        $new_name = "sqft9".rand(11111,99999).'.'.$ext; 
                                        $config1['file_name'] = $new_name;
                                        $this->load->library('upload', $config1);
                                        $this->upload->initialize($config1);
                                        if(!$this->upload->do_upload('files')){
                                            $this->session->set_flashdata("message","<div class='alert alert-danger'>".$this->upload->display_errors()."</div>");
                                                redirect('property/myproperty');  
                                        }else {
                                            $upload_data = $this->upload->data();
                                             $this->load->library('image_lib'); 
                                              $this->load->library('image_lib'); 
                                                $configwm['source_image'] = './assets/images/property_gallery/'.$upload_data["file_name"];
                                                $configwm['wm_overlay_path'] = './assets/images/watermark.png';
                                                $configwm['wm_type'] = 'overlay';
                                                $configwm['wm_opacity'] = '70';
                                                $configwm['wm_vrt_alignment'] = 'middle';
                                                $configwm['wm_hor_alignment'] = 'center';
                                                $configwm['wm_vrt_offset'] = 0;
                                                $configwm['wm_hor_offset'] = 0;
                                                $this->image_lib->initialize($configwm);
                                                $this->image_lib->watermark();
                                            $config['image_library'] = 'gd2';  
                                                $config['source_image'] = './assets/images/property_gallery/'.$upload_data["file_name"];  
                                                $config['create_thumb'] = FALSE;  
                                                $config['maintain_ratio'] = FALSE;  
                                                $config['quality'] = '70%';  
                                                $config['width'] = 650;  
                                                $config['height'] = 450;  
                                                $config['new_image'] = './assets/images/property_gallery/'.$upload_data["file_name"];  
                                                
                                                $this->image_lib->initialize($config);
                                                $this->image_lib->resize();
                                                $this->image_lib->clear();

                                             $uploadData['user_id'] = $id; 
                                             $uploadData['prid'] = $in; 
                                             $uploadData['pid'] = $package;
                                            $uploadData['p_img'] = 'assets/images/property_gallery/'.$upload_data['file_name']; 
                                            $uploadData['created_at'] = date("Y-m-d H:i:s"); $this->master_db->insertRecord('property_gallery',$uploadData);
                                        }
                                        
                                    } 

                                }

                         }
$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Inserted successfully</div>');
                        redirect('property/myproperty');
                }   
            }              
    }
    public function getProperties() {
        $det = $this->data['detail'];
        $ids = $det[0]->id;
        $where = "where status !=2";
            if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
                $where .= " and (title like '%$val%') ";
                $where .= " or (ptype like '%$val%') ";
            }
            $order_by_arr[] = "title";
            $order_by_arr[] = "";
            $order_by_arr[] = "id";
            $order_by_def   = " order by id desc";
            $where .=" and uid =".$ids."";
            $query = "select id,pid,ptype,title,status,created_at from properties ".$where."";           
            $fetchdata = $this->home_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
            //echo $this->db->last_query();exit;
            $data = array();
            $i = $_POST["start"]+1;
            foreach ($fetchdata as $r) {
                $getPackage = $this->master_db->getRecords('user_package',['pid'=>$r->pid],'expire_date');
                $action ="";
                $sub_array = array();$property = "";
                if($r->ptype ==1) 
                {
                    $property = "Apartment";
                }
                else if($r->ptype ==2) {
                    $property = "House";
                }
                else if($r->ptype ==3) {
                    $property = "Office Space";
                }
                else if($r->ptype ==4) {
                    $property = "Commercial ";
                }
                else if($r->ptype ==5) {
                    $property = "Plot & Land";
                }
                else if($r->ptype ==6) {
                    $property = "Plot & Land";
                }
                else if($r->ptype ==7) {
                    $property = "Building";
                }
                 $action .= '<a href='.base_url()."property/editproperty?id=".sqftEncrypt($r->id)."".' title="Edit Details" style="float:left;color:#000;border: 1px solid #111;padding: 5px 6px;border-radius: 3px;"><i class="fas fa-pencil-alt"></i></a>&nbsp;';
              
                 $action .= "<div title='Delete' onclick='deleteProperty(".$r->id.")'  style='float:left;margin-left:10px;cursor:pointer;border: 1px solid #111;padding: 5px 6px;border-radius: 3px;'><i class='fas fa-trash'></i></div>&nbsp;";
                 $sub_array[] = $i++;
                 $sub_array[] = $r->title;
                 $sub_array[] = $property;
                 $sub_array[] = date('d-m-Y',strtotime($r->created_at));
                 $sub_array[] = date('d-m-Y',strtotime($getPackage[0]->expire_date));
                  $sub_array[] = $action;
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
       // $output[$csrf_name] = $csrf_hash; 
        echo json_encode($output);
    }
    public function editproperty() {
        $id = $_GET['id'];
        $det = $this->data['detail'];
        $pacid = $det[0]->id;
        $getPackage = $this->master_db->getRecords('user_package',['user_id'=>$pacid],'id,pictures,pid');
      
       // echo $this->db->last_query();exit;
        $this->data['getPicture'] = $getPackage;
        $this->data['type'] = "edit";
        $this->data['states'] = $this->master_db->getRecords('states',['status'=>0],'id,name','name asc');
        $this->data['city'] = $this->master_db->getRecords('cities',['status'=>0],'id,cname','cname asc');
        $this->data['category'] = $this->master_db->getRecords('property_category',['status'=>0],'id,name','name asc');
        $pid = sqftDcrypt($id);
        $getProperty = $getproper = $this->master_db->getRecords('properties',['id'=>$pid],'*');
        $getImgpic = $this->master_db->getRecords('user_package',['pid'=>$getproper[0]->pid,'user_id'=>$getproper[0]->uid],'pictures');
        //echo $this->db->last_query();exit;
        $this->data['getProperty'] = $getProperty;
        $getProimg = $this->master_db->getRecords('property_gallery',['prid'=>$pid,'user_id'=>$pacid],'id as ppid,p_img');
        //echo $this->db->last_query();exit;
        $getProamenities = $this->master_db->getRecords('property_amenities',['prid'=>$pid],'id as paid,p_amenities as amenities');
        $amenities = $this->master_db->getRecords('amenities',['status!='=>-1],'id,title');
        $this->data['getImage'] = $getProimg;
        $imgcount = $getPackage[0]->pictures - count($getProimg);
        //echo $imgcount;exit;
        $this->data['getAmenities'] = $getProamenities;
        $this->data['amenities'] = $amenities;
        $this->data['picturecount'] = $getImgpic;
        $this->data['amenitylist'] = $this->master_db->getRecords('property_amenities',['prid'=>$pid],'p_amenities as paid');
         $area = $this->master_db->getRecords('area',['status'=>0],'id,areaname');
        $this->data['area'] = $area;
        $this->load->view('admin/editproperty',$this->data);
    }
    public function saveeditProperty() {
            $det = $this->data['detail'];
            $id = $det[0]->id;
        //echo "<pre>";print_r($_POST);print_r($_FILES);exit;
            $title = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('title', true))));
            $ppid = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('ppid', true))));
            $package = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('package', true))));
            $ptype = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('ptype', true))));
            $ownerrole = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('ownerrole', true))));
            $cperoid = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('cperoid', true))));
            $face = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('face', true))));
            $rtype = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('rtype', true))));
            $bitype = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('bitype', true))));
            $prodesc = $this->input->post('prodesc');
            $bed = $this->input->post('bed');
            $bedim = implode("", $bed);
            $bath =$this->input->post('bath');
            $bathim = implode("", $bath);
            $area = $this->input->post('area');
            $areaim = implode("", $area);
            $avail = $this->input->post('avail');
            $availim = implode("",$avail);
            $carpark = $this->input->post('carpark');
            $carparkim = implode("",$carpark);
            $price = $this->input->post('price');
            $priceim = implode("",$price);
            $floors = $this->input->post('floors');
            $floorsim = implode("", $floors);
            $furnished = $this->input->post('furnished');
            $furnishedim = implode("", $furnished);
            $balcony = $this->input->post('balcony');
            $balconyim = implode("", $balcony);
            $washroom = $this->input->post('washroom');
            $washroomim = implode("", $washroom);
            $leedcertificate = $this->input->post('leedcertificate');
            $leedcertificateim = implode("", $leedcertificate);
            $cornerproperty = $this->input->post('cornerproperty');
            $cornerpropertyim = implode("", $cornerproperty);
            $overlooking = $this->input->post('overlooking');
             $overlooking1 =  implode("", $overlooking);
            $lockperiod = $this->input->post('lockperiod');
            $lockperiodim = implode("", $lockperiod);
            $buildingclass = $this->input->post('buildingclass');
            $buildingclassim = implode("", $buildingclass);
            $wateravail = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('wateravail', true))));
            $projectname = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('projectname', true))));
            $electricity = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('electricity', true))));
            $ttype = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('ttype', true))));
            $highlights = $this->input->post('highlights');
            $overlooking = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('overlooking', true))));
            $overlooking1 = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('overlooking1', true))));
            $plotarea = $this->input->post('plotarea');
            $plotareaim = implode("", $plotarea);
            $unitofloor = $this->input->post('unitofloor');
            $unitofloorim = implode("", $unitofloor);
            $maintenance = $this->input->post('maintenance');
            $maintenanceim = implode("", $maintenance);
            $parkingratio = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('parkingratio', true))));
            $seats = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('seats', true))));
            $pantry = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('pantry', true))));
            $carpetarea = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('carpetarea', true))));
            $nooflift = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('nooflift', true))));
            $address = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('address', true))));
            $city = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('city', true))));
            $state = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('state', true))));
            $country = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('country', true))));
           	$vtype = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('vtype', true))));
            $atype = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('atype', true))));
            $areaname = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('areaname', true))));
            $ylink = $this->input->post('ylink');
			$url = parse_url($ylink);
			$vid = parse_str($url['query'], $output);
			$video_id = $output['v'];
            $ownerAddress = $this->input->post('owneraddress');
            $maps = $this->input->post('maps');
            $amenities =$this->input->post('amenities');
            $loading =$this->input->post('loading');
            $nearby = $this->input->post('nearby');
            $pimgid = $this->input->post('pimgid');
            if(!empty($package)) {
                 $db['pid'] = $package;
            }
             if(!empty($ptype)) {
                 $db['ptype'] = $ptype;
            }
            if(!empty($ownerrole)) {
                 $db['ownerrole'] = $ownerrole;
            }
            if(!empty($cperoid)) {
                 $db['cperiod'] = $cperoid;
            }
              if(!empty($atype)) {
                $db['atype'] = $atype;
            }
            if(!empty($areaname)) {
                $db['areaid'] = $areaname;
            }
            if(!empty($title)) {
                $db['title'] = $title;
            }
            if(!empty($face)) {
                $db['face'] = $face;
            }
            if(!empty($rtype)) {
                $db['rtype'] = $rtype;
            }
            if(!empty($bitype)) {
                $db['bitype'] = $bitype;
            }
             if(is_array($bed)) {
                $db['bedrooms'] = $bedim;
            }
           
             if(is_array($bath)) {
                $db['bathrooms'] = $bathim;
            }
             if(is_array($area)) {
                $db['area'] = $areaim;
            }
            
             if(is_array($avail)) {
                $db['availability'] = $availim;
            }
           
             if(is_array($balcony)) {
                $db['balcony'] = $balconyim;
            }
           
             if(is_array($furnished)) {
                $db['furnished'] = $furnishedim;
            }
            
             if(is_array($leedcertificate)) {
                $db['leedcertificate'] = $leedcertificateim;
            }
           
             if(is_array($price)) {
                $db['price'] = $priceim;
            }
            
             if(is_array($carpark)) {
                $db['carpark'] = $carparkim;
            }
            if(!empty($overlooking)) {
                $db['overlooking'] = $overlooking1;
            }
             if(!empty($projectname)) {
                $db['pname'] = $projectname;
            }
             if(!empty($ttype)) {
                $db['ttype'] = $ttype;
            }
             if(is_array($lockperiod)) {
                $db['lockperiod'] = $lockperiodim;
            }
            
             if(is_array($plotarea)) {
                $db['plotarea'] = $plotareaim;
            }
           
             if(is_array($unitofloor)) {
                $db['unitoffloor'] = $unitofloorim;
            }
           
             if(!empty($maintenance)) {
                $db['maintenancecharge'] = $maintenanceim;
            }
            
            if(!empty($address)) {
                $db['paddress'] = $address;
            }
             if(!empty($city)) {
                $db['pcity'] = $city;
            }
             if(!empty($state)) {
                $db['pstate'] = $state;
            }
             if(!empty($country)) {
                $db['pcountry'] = $country;
            }
             if(!empty($maps)) {
                $db['embedmap'] = $maps;
            }
             if(!empty($parkingratio)) {
                $db['parkratio'] = $parkingratio;
            }
             if(!empty($carpetarea)) {
                $db['carpetarea'] = $carpetarea;
            }
             if(!empty($nooflift)) {
                $db['nooflift'] = $nooflift;
            }
             if(!empty($nearby)) {
                $db['nearbyarea'] = $nearby;
            }
             if(is_array($cornerproperty)) {
                $db['cornerproperty'] = $cornerpropertyim;
            }
            
             if(is_array($buildingclass)) {
                $db['buildingclass'] = $buildingclassim;
            }
            
             if(!empty($prodesc)) {
                $db['prodesc'] = $prodesc;
            }
            if(!empty($highlights)) {
                $db['prohights'] = $highlights;
            }

            if(!empty($floors)) {
                $db['floors'] = $floorsim;
            }


            $db['uid'] = $id;
             if(!empty($vtype)) {
                    $db['videotype'] = $vtype;
                    if(!empty($_FILES['uvideo']['name'])) {
                        $uploadPath = './assets/videos/';
                        $config['upload_path'] = $uploadPath;
                        $config['allowed_types'] = 'mp4';
                        $config['max_size'] = '2000000';
                        $ext = pathinfo($_FILES["uvideo"]['name'], PATHINFO_EXTENSION);
                        $new_name = "sqft9".rand(11111,99999).'.'.$ext; 
                        $config['file_name'] = $new_name;
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if(!$this->upload->do_upload('uvideo')){
                            $this->session->set_flashdata("message","<div class='alert alert-danger'>".$this->upload->display_errors()."</div>");
                                redirect('property/myproperty');  
                        }else {
                            $upload_data = $this->upload->data();
                            $db['video_path'] =  'assets/videos/'.$upload_data['file_name']; 
                        }
                    }
                    if(isset($ylink) && !empty($ylink)) {
                        $db['video_path'] = $video_id;
                    }
            }
            $db['modified_at'] = date('Y-m-d H:i:s');
            $getPackage = $this->master_db->getRecords('user_package',['user_id'=>$id,'pid'=>$package],'pictures,properties,expire_date');
            $this->session->set_userdata('properties',$getPackage[0]->properties);
            $getImagesview = $this->master_db->getRecords('property_gallery',['prid'=>$ppid],'*');
            //echo $this->db->last_query();exit;
            $pimgids = [];
            foreach ($getImagesview as $key => $value) {
                $pimgids[] = $value->id;
            }
            $cdate = date('Y-m-d');
            $getProperty = $this->master_db->getRecords('properties',['pid'=>$package,'uid'=>$id],'*');
            $count = count($getProperty);
            
                 $getImages = $this->master_db->getRecords('property_gallery',['prid'=>$ppid],'*');
                 //echo $this->db->last_query();exit;
                 $getAmenities = $this->master_db->getRecords('property_amenities',['prid'=>$ppid],'*');
                 $amid = [];
                 foreach ($getAmenities as $key => $value) {
                     $amid[] = $value->id;
                 }
                 if(count($amenities) >0) {
                    foreach ($amenities as $key => $am) {
                            if(in_array($am, $amid)) {
                                $dbpr['p_amenities'] = $am;
                                // $dbpr['status'] = -1;
                                $this->master_db->updateRecord('property_amenities',$dbpr,['id'=>$am]);
                            }else {
                                //echo "Inseretd";
                                $dbsr['user_id'] = $id;
                               $dbsr['prid'] = $ppid;
                               $dbsr['p_amenities'] = $am;
                               $dbsr['created_at'] = date('Y-m-d H:i:s');
                               $this->master_db->insertRecord('property_amenities',$dbsr);
                            }
                    }
                 }
                
                
                    foreach ($pimgid as $i => $new) {
                    if(in_array($new, $pimgids)) {
                       // echo "updated";exit;
                        if(!empty($_FILES['gallery']['name'][$i]) && $_FILES['gallery']['size'][$i] >0) {

                 $uploadPath = './assets/images/property_gallery/';
                                  
                                        $_FILES['file']['name']       = $_FILES['gallery']['name'][$i];
                                        $_FILES['file']['type']       = $_FILES['gallery']['type'][$i];
                                        $_FILES['file']['tmp_name']   = $_FILES['gallery']['tmp_name'][$i];
                                        $_FILES['file']['error']      = $_FILES['gallery']['error'][$i];
                                        $_FILES['file']['size']       = $_FILES['gallery']['size'][$i];
                                        $uploadPath = './assets/images/property_gallery/';
                                        $config['upload_path'] = $uploadPath;
                                        $config['allowed_types'] = 'jpg|jpeg|png';
                                        $config['max_size'] = '20000000';
                                        $ext = pathinfo($_FILES["gallery"]['name'][$i], PATHINFO_EXTENSION);
                                        $new_name = "sqft9".rand(11111,99999).'.'.$ext; 
                                        $config['file_name'] = $new_name;
                                        $this->load->library('upload', $config);
                                        $this->upload->initialize($config);
                                        if(!$this->upload->do_upload('file')){
                                            $this->session->set_flashdata("message","<div class='alert alert-danger'>".$this->upload->display_errors()."</div>");
                                                redirect('property/myproperty');  
                                        }else {
                                            $upload_data = $this->upload->data();
                                            $this->load->library('image_lib'); 
                                              $this->load->library('image_lib'); 
                                                $configwm['source_image'] = './assets/images/property_gallery/'.$upload_data["file_name"];
                                                $configwm['wm_overlay_path'] = './assets/images/watermark.png';
                                                $configwm['wm_type'] = 'overlay';
                                                $configwm['wm_opacity'] = '70';
                                                $configwm['wm_vrt_alignment'] = 'right';
                                                $configwm['wm_hor_alignment'] = 'right';
                                                $configwm['wm_vrt_offset'] = 20;
                                                $configwm['wm_hor_offset'] = 20;
                                                $this->image_lib->initialize($configwm);
                                                $this->image_lib->watermark();
                                            $config['image_library'] = 'gd2';  
                                                $config['source_image'] = './assets/images/property_gallery/'.$upload_data["file_name"];  
                                                $config['create_thumb'] = FALSE;  
                                                $config['maintain_ratio'] = FALSE;  
                                                $config['quality'] = '70%';  
                                                $config['width'] = 650;  
                                                $config['height'] = 450;  
                                                $config['new_image'] = './assets/images/property_gallery/'.$upload_data["file_name"];  
                                                $this->image_lib->initialize($config);
                                                $this->image_lib->resize();
                                                $this->image_lib->clear();

                                             
                                            $uploadData['p_img'] = 'assets/images/property_gallery/'.$upload_data['file_name']; 
                                           $imgid = $this->master_db->updateRecord('property_gallery',$uploadData,['id'=>$new]);
                                        } 
                                        
                                }
                    }else {
                        //echo "inserted";exit;
                        if(!empty($_FILES['gallery']['name'][$i]) && $_FILES['gallery']['size'][$i] >0) {
                        
                                    $config1["upload_path"] = '../assets/images/property_gallery/';
                                    $config1["allowed_types"] = 'jpeg|jpg|png';
                                    $this->load->library('upload', $config1);
                                    $this->upload->initialize($config1);
                                        $_FILES['files']['name']       = $_FILES['gallery']['name'][$i];
                                        $_FILES['files']['type']       = $_FILES['gallery']['type'][$i];
                                        $_FILES['files']['tmp_name']   = $_FILES['gallery']['tmp_name'][$i];
                                        $_FILES['files']['error']      = $_FILES['gallery']['error'][$i];
                                        $_FILES['files']['size']       = $_FILES['gallery']['size'][$i];
                                        $uploadPath = './assets/images/property_gallery/';
                                        $config1['upload_path'] = $uploadPath;
                                        $config1['allowed_types'] = 'jpg|jpeg|png';
                                        $config1['max_size'] = '20000000';
                                         $ext = pathinfo($_FILES["gallery"]['name'][$i], PATHINFO_EXTENSION);
                                        $new_name = "sqft9".rand(11111,99999).'.'.$ext; 
                                        $config1['file_name'] = $new_name;
                                        $this->load->library('upload', $config1);
                                        $this->upload->initialize($config1);
                                        $uploadData['user_id'] = $id; 
                                        $uploadData['prid'] = $ppid; 
                                        $uploadData['pid'] = $package; 
                                        if(!$this->upload->do_upload('files')){
                                            $this->session->set_flashdata("message","<div class='alert alert-danger'>".$this->upload->display_errors()."</div>");
                                                redirect('property/myproperty');  
                                        }else {
                                            $upload_data = $this->upload->data();
                                             $this->load->library('image_lib'); 
                                                $configwm['source_image'] = './assets/images/property_gallery/'.$upload_data["file_name"];
                                                $configwm['wm_overlay_path'] = './assets/images/watermark.png';
                                                $configwm['wm_type'] = 'overlay';
                                                $configwm['wm_opacity'] = '70';
                                                $configwm['wm_vrt_alignment'] = 'middle';
                                                $configwm['wm_hor_alignment'] = 'center';
                                                $configwm['wm_vrt_offset'] = 0;
                                                $configwm['wm_hor_offset'] = 0;
                                                $this->image_lib->initialize($configwm);
                                                $this->image_lib->watermark();
                                            $config['image_library'] = 'gd2';  
                                                $config['source_image'] = './assets/images/property_gallery/'.$upload_data["file_name"];  
                                                $config['create_thumb'] = FALSE;  
                                                $config['maintain_ratio'] = FALSE;  
                                                $config['quality'] = '70%';  
                                                $config['width'] = 650;  
                                                $config['height'] = 450;  
                                                $config['new_image'] = './assets/images/property_gallery/'.$upload_data["file_name"];  
                                                $this->image_lib->initialize($config);
                                                $this->image_lib->resize();
                                                $this->image_lib->clear();

                                             
                                            $uploadData['p_img'] = 'assets/images/property_gallery/'.$upload_data['file_name']; 
                                            $uploadData['created_at'] = date("Y-m-d H:i:s"); $this->master_db->insertRecord('property_gallery',$uploadData);
                                        } 
                                }
                        }
                    }
            $up = $this->master_db->updateRecord('properties',$db,['id'=>$ppid]);
            //echo $this->db->last_query();exit;
            $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Updated successfully</div>');
            redirect('property/myproperty');                     
    }
    public function subscriptionList() {
        $det = $this->data['detail'];
        $uid = $det[0]->id;
        $this->data['getSubscription'] = $this->master_db->sqlExecute('select p.title,up.price,up.expire_date,up.created_at,up.properties,up.pid,p.pprice from packages p left join user_package up on up.pid = p.id where up.user_id='.$uid.'');
        //echo $this->db->last_query();exit;
        $this->data['uid'] = $uid;
        $this->load->view('admin/subscription',$this->data);
    }

    public function getPackagepiccount() {
        $det = $this->data['detail'];
        $uid = $det[0]->id;
        $id = $this->input->post('id');
        $getPackagepic = $this->master_db->getRecords('user_package',['pid'=>$id,'user_id'=>$uid],'pictures');
        $getPropertygallery = $this->master_db->getRecords('property_gallery',['pid'=>$id,'user_id'=>$uid],'*');
        $this->session->set_userdata('piccount',$getPackagepic[0]->pictures);
        if(count($getPropertygallery) >0) {
            $total = (int)$getPackagepic[0]->pictures - (int)count($getPropertygallery);
            echo json_encode(['piccount'=>$total]);
        }else {
            echo json_encode(['piccount'=>$getPackagepic[0]->pictures]);
        }
    }
    public function deleteProgallery() {
        $id = $this->input->post('id');
        //echo "<pre>";print_r($_POST);exit;
        $del = $this->master_db->deleterecord('property_gallery',['id'=>$id]);
        echo json_encode(['status'=>true,'msg'=>'Deleted successfully','csrf_token'=>$this->security->get_csrf_hash()]);
    }
    public function myproperty() {
        $this->load->view('admin/my-listing',$this->data);
    }
    public function owneraddress() {
        $det = $this->data['detail'];
        $uid = $det[0]->id;
        $getdata = $this->master_db->getPropertyview($uid);
        //echo $this->db->last_query();exit;
        $this->data['owner'] = $getdata;
        $this->load->view('admin/owner-address',$this->data);
    }

public function getownerList() {
        $det = $this->data['detail'];
        $ids = $det[0]->id;
        $where = "where oa.uid='".$ids."'";
            if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]) )
            { 
                $val    = trim($_POST["search"]["value"]);
                $where .= " and (p.title like '%$val%') ";
                $where .= " and (p.oname like '%$val%') ";
                $where .= " and (p.oemail like '%$val%') ";
                $where .= " and (p.ophone like '%$val%') ";
                $where .= " and (p.oaddress like '%$val%') ";
            }
            $order_by_arr[] = "p.title";
            $order_by_arr[] = "";
            $order_by_arr[] = "oa.id";
            $order_by_def   = " order by oa.id desc";
            $query = "select p.title,p.oname,p.oaddress,p.ophone,p.oemail,p.id,p.slug from properties p left join owner_address oa on p.id =oa.prid  ".$where."";           
            $fetchdata = $this->home_db->rows_by_paginations($query,$order_by_def,$order_by_arr);
            //echo $this->db->last_query();exit;
            $data = array();
            $i = $_POST["start"]+1;
            foreach ($fetchdata as $r) {
                 $sub_array[] = $i++;
                 $sub_array[] = "<a href=".base_url().'dashboard/propertyview/'.$r->slug." title='View Property'>".$r->title."</a>";
                 $sub_array[] = $r->oname;
                 $sub_array[] = $r->oaddress;
                 $sub_array[] = $r->oemail;
                 $sub_array[] = $r->ophone;
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
    public function deleteData() {
        //echo "<pre>";print_r($_POST);exit;
        $id = $this->input->post('id');
        $del = $this->master_db->deleterecord('properties',['id'=>$id]);
        $getGal = $this->master_db->getRecords('property_gallery',['prid'=>$id],'p_img');
        // foreach ($getGal as $value) {
        // 	$img = $value->p_img;
        // 	unlink('./'.$img);
        // }
        if($del) {
            echo json_encode(['status'=>true,'csrf_token'=>$this->security->get_csrf_hash()]);
        }else {
            echo json_encode(['status'=>false,'csrf_token'=>$this->security->get_csrf_hash()]);
        }
    }
   public function addpackages() {
        $det = $this->data['detail'];
        $this->data['userdata'] = $det;
        $this->session->set_userdata('rand',rand(12345,99999));
        $this->data['package'] = $this->master_db->getRecords('packages',['status !='=>-1],'*','id asc');
        $this->load->view('admin/packages',$this->data);
   }
   public function payment() {
   // echo "<pre>";print_r($_POST);exit;
    $det = $this->data['detail'];
    $package = $this->input->post('package');
        $ar = array(
                        "package"=>$package,
                );
                $this->session->set_userdata('payment',$ar);
                if(is_array($package) && count($package) >0) {
                    $im = implode(",",$package);
                    $this->data['package'] = $this->master_db->sqlExecute('select * from packages where id in ('.$im.')');
                    $this->data['postData'] = $_POST;
                    $new = $this->load->view('admin/summary',$this->data,true);
                    echo json_encode(['status'=>true,'msg'=>$new,'csrf_token'=>$this->security->get_csrf_hash()]);
                }else {
                    echo json_encode(['status'=>false,'msg'=>'Please select atleast one package','csrf_token'=>$this->security->get_csrf_hash()]);
                }
        }
   public function addNewpackage() {
        $det  = $this->data['detail'];
        $pay = $this->session->userdata('payment');
        $uid = $det[0]->id;
        $payid = $this->input->post('payid');
        //echo "<pre>";print_r($pay);print_r($_POST);exit;
        $package = $pay['package'];
        if(is_array($package) && count($package) >0) {
            $result = [];
                $ids = implode(',',$package);
                 $list = $this->master_db->sqlExecute('select * from packages where id in ('.$ids.')');
                 $pacname = [];
                 foreach ($list as $key => $value) {
                     $pacname[] = $value->title;
                 }
                 $patitle = implode(",", $pacname);
                 $this->session->set_userdata('packagename',$patitle);
                $getUserpackage = $this->master_db->sqlExecute('select * from user_package where pid in('.$ids.') and user_id='.$uid.' ');
                //echo $this->db->last_query();exit;
                $ar = [];
                foreach ($getUserpackage as $key => $value) {
                    $ar[] = $value->pid;
                }
                $rand = rand(12345,99999);
                //echo "<pre>";print_r($ar);exit;
                foreach ($package as $key => $value) {
                      if(in_array($value,$ar)) {
                       // echo "Updated";exit;
                           $plist = $this->master_db->sqlExecute('select * from packages where id in ('.$value.')');
                           $upack = $this->master_db->sqlExecute('select * from user_package where pid in ('.$value.')');
                           $cdate = date('Y-m-d');
                           $price = $upack[0]->price;
                           $pcitures = $upack[0]->pictures;
                           $umonths = $upack[0]->months;
                           $expire_date = $upack[0]->expire_date;
                           $properties = $upack[0]->properties;
                           $umonths = $upack[0]->months;
                           $pdate = $upack[0]->created_at;
                           if($cdate == $pdate) {
                                 $month = (int)filter_var($plist[0]->nmonths,FILTER_SANITIZE_NUMBER_INT);
                                   $dbs['user_id'] = $uid;
                                   $dbs['pid'] = $value;
                                   $dbs['price'] = $plist[0]->pprice;
                                   $dbs['months'] = (int)filter_var($plist[0]->nmonths,FILTER_SANITIZE_NUMBER_INT);
                                   $dbs['pictures'] = (int)filter_var($plist[0]->npictures,FILTER_SANITIZE_NUMBER_INT);
                                   $dbs['properties'] = (int)filter_var($plist[0]->nproperties,FILTER_SANITIZE_NUMBER_INT);
                                   $dbs['expire_date'] = date('Y-m-d',strtotime('+'.$month.' month'));
                                   $dbs['type'] = $plist[0]->type;
                                   $dbs['orderno'] = "sqft9".$this->session->userdata('rand');
                                   $dbs['created_at'] = date('Y-m-d');
                                   $dbs['renewed_on'] = date('Y-m-d H:i:s');
                                   $updated = $this->master_db->insertRecord('user_package',$dbs);
                           }else {
                                 $month = (int)filter_var($plist[0]->nmonths,FILTER_SANITIZE_NUMBER_INT);
                                   $dbs['user_id'] = $uid;
                                   $dbs['pid'] = $value;
                                   $dbs['price'] = $plist[0]->pprice;
                                   $dbs['months'] = (int)filter_var($plist[0]->nmonths,FILTER_SANITIZE_NUMBER_INT);
                                   $dbs['pictures'] = (int)filter_var($plist[0]->npictures,FILTER_SANITIZE_NUMBER_INT);
                                   $dbs['properties'] = (int)filter_var($plist[0]->nproperties,FILTER_SANITIZE_NUMBER_INT);
                                   $dbs['expire_date'] = date('Y-m-d',strtotime('+'.$month.' month'));
                                   $dbs['type'] = $plist[0]->type;
                                   $dbs['orderno'] = "sqft9".$this->session->userdata('rand');
                                   $dbs['created_at'] = date('Y-m-d');
                                   $dbs['renewed_on'] = date('Y-m-d H:i:s');
                                   $updated = $this->master_db->insertRecord('user_package',$dbs);
                           }
                           $result = ['status'=>true,'msg'=>'Added successfully','csrf_token'=>$this->security->get_csrf_hash()];
                      }else {
                            $plist = $this->master_db->sqlExecute('select * from packages where id in ('.$value.')');
                            $month = (int)filter_var($plist[0]->nmonths,FILTER_SANITIZE_NUMBER_INT);
                            $dbs['user_id'] = $uid;
                            $dbs['pid'] = $value;
                            $dbs['price'] = $plist[0]->pprice;
                            $dbs['months'] = (int)filter_var($plist[0]->nmonths,FILTER_SANITIZE_NUMBER_INT);
                            $dbs['pictures'] = (int)filter_var($plist[0]->npictures,FILTER_SANITIZE_NUMBER_INT);
                            $dbs['properties'] = (int)filter_var($plist[0]->nproperties,FILTER_SANITIZE_NUMBER_INT);
                            $dbs['expire_date'] = date('Y-m-d',strtotime('+'.$month.' month'));
                            $dbs['type'] = $plist[0]->type;
                            $dbs['orderno'] = "sqft9".$this->session->userdata('rand');
                            $dbs['created_at'] = date('Y-m-d');
                            $dbs['renewed_on'] = date('Y-m-d H:i:s');
                            $ins = $this->master_db->insertRecord('user_package',$dbs);
                            $result = ['status'=>true,'msg'=>'Added successfully','csrf_token'=>$this->security->get_csrf_hash()];
                       // echo "inserted";exit;
                      }
                }
                    $payment['user_id'] = $uid;
                            if(!empty($payid)) {
                                $payment['pay_id'] = $payid;
                                $payment['status'] = 0;
                                $payment['created_at'] = date('Y-m-d H:i:s');
                            }else {
                                $payment['status'] = -1;
                            }
                            $this->master_db->insertRecord('payment_log',$payment);
        }else {
            $result = ['status'=>true,'msg'=>'Please select atleast one package','csrf_token'=>$this->security->get_csrf_hash()];
        }
        echo json_encode($result);
}
public function thankyou() {
    $this->load->view('admin/payment-thankyou',$this->data);
}

public function wishlist() {
    $det = $this->data['detail'];
    $uid = $det[0]->id;
    $getWishlist = $this->home_db->getwishlist($uid);
    //echo $this->db->last_query();
    $this->data['wishlist'] = $getWishlist;
    $this->load->view('admin/wishlist',$this->data);
}
public function deletewishlist() {
    $id = $this->uri->segment(3);
    $wid =  sqftDcrypt($id);
    $this->master_db->deleterecord('property_wishlist',['id'=>$wid]);
    redirect('property/wishlist');
}
public function editprofile() {
    $det = $this->data['detail'];
    $uid = $det[0]->id;
    $getUsers = $this->master_db->getRecords('users',['id'=>$uid],'id,name,email,phone,address');
    $this->data['getUsers'] = $getUsers;
    $this->load->view('admin/editprofile',$this->data);  
}
public function editsave() {
    $name = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('name', true))));
    $email = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('email', true))));
    $phone = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('phone', true))));
    $address = $this->input->post('address');
    $uid = $this->input->post('uid');
    $db['name'] = $name;
    $db['email'] = $email;
    $db['phone'] = $phone;
    $db['address'] = $address;
    $update = $this->master_db->updateRecord('users',$db,['id'=>$uid]);
    if($update ==true) {
        $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button> Profile updated successfully</div>');
        redirect('property/editprofile');
    }
    else {
        $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button> Profile not updated</div>');
        redirect('property/editprofile');
    }
}
public function invoicelist() {
     $det = $this->data['detail'];
     $encid = $this->uri->segment(3);
    $uid = sqftDcrypt($encid);

    $getUsers = $this->master_db->getRecords('users',['id'=>$uid],'id,name,email,phone,address,invoiceno');
    $getUserpackage = $this->master_db->sqlExecute('select p.title,up.orderno,p.pprice,up.price,up.user_id from user_package up left join packages p on up.pid = p.id where up.orderno="'.$uid.'"');
   // echo $this->db->last_query();exit;
    $this->data['getUsers'] = $getUsers;
    $this->data['getuserpackage'] = $getUserpackage;
    $this->load->view('admin/invoice',$this->data);
}
public function invoice() {
    $det = $this->data['detail'];
    $uid = $det[0]->id;
    $this->data['userpackage'] =  $this->master_db->sqlExecute('select p.title,up.orderno,up.price,up.created_at as date,up.expire_date,up.user_id,up.id from user_package up left join packages p on up.pid = p.id where up.user_id='.$uid.' group by up.orderno');
   //echo $this->db->last_query();exit;
    $this->load->view('admin/invoicelist',$this->data);
}
public function changepass(){
    $det = $this->data['detail'];
    $this->data['uid'] = $det[0]->id;
    $this->load->view('admin/changepass',$this->data);
}
public function passsave() {
    $det = $this->data['detail'];
    $uid = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('uid', true))));
    $npass = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('npass', true))));
    $cpass = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('cpass', true))));
    $getUsers = $this->master_db->getRecords('users',['id'=>$uid],'password');
    if(password_verify($cpass, $getUsers[0]->password)) {
        $hash = password_hash($npass, PASSWORD_BCRYPT);
        $db['password'] = $hash;
        $this->master_db->updateRecord('users',$db,['id'=>$uid]);
        $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button> Updated successfully</div>');
       redirect('property/changepass');
    }else {
       $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Current password is incorrect</div>');
       redirect('property/changepass');
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
         //echo $this->db->last_query();exit;
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
        $this->data['property']=$this->home_db->getPropertylistbyid($config['per_page'],$perpage, $catid, $type);
        //echo $this->db->last_query();exit;
       $this->data["links"] = $this->pagination->create_links();
       $this->data["countproperty"] = $this->home_db->getPropertylistbycount($catid, $type);
       // echo $this->db->last_query();
        $this->load->view('category',$this->data);
    }
    public function getcity() {
        //echo "<pre>";print_r($_POST);exit;
        $id = trim($this->input->post('id'));
        $getCity = $this->master_db->getRecords('cities',['sid'=>$id],'id,cname');
        $result = [];
        $html = "<option value=''>Select City</option>";
        if(count($getCity) >0) {
            foreach ($getCity as $key => $value) {
                $html .= "<option value=".$value->id.">".$value->cname."</option>";
            }
        }
        echo json_encode(['status'=>true,'msg'=>$html,'csrf_token'=>$this->security->get_csrf_hash()]);
    }

    public function getarea() {
        //echo "<pre>";print_r($_POST);exit;
        $id = trim($this->input->post('id'));
        $getarea = $this->master_db->getRecords('area',['cid'=>$id,'status'=>0],'id,areaname');
        //echo $this->db->last_query();exit;
        $result = [];
        $html = "<option value=''>Select Area</option>";
        if(count($getarea) >0) {
            foreach ($getarea as $key => $value) {
                $html .= "<option value=".$value->id.">".$value->areaname."</option>";
               
            }
        }
       echo json_encode(['status'=>true,'msg'=>$html,'csrf_token'=>$this->security->get_csrf_hash()]);
    }
    public function getAmenities() {
        //echo "<pre>";print_r($_POST);
        $id = trim($this->input->post('id'));
        $getAmenity = $this->master_db->getRecords('amenities',['ptype'=>$id,'status'=>0],'id,title');
        $this->data['amenity'] = $getAmenity;
       $html = $this->load->view('amenityview',$this->data,true);
       echo json_encode(['status'=>true,'msg'=>$html,'csrf_token'=>$this->security->get_csrf_hash()]);
    }
}
?>