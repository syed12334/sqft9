<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	protected $data;
	public function __construct() {
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
		$this->load->helper('utility_helper');
        $this->load->model('master_db');   
        $this->load->model('home_db'); 
        $this->data['session'] = ADMIN_SESSION; 
        $this->data['style']=$this->load->view('includes/style', $this->data , TRUE);
        $this->data['header']=$this->load->view('includes/header', $this->data , TRUE);
        $this->data['footer']=$this->load->view('includes/footer', $this->data , TRUE); 
	}
	public function index() {
		if(!$this->session->userdata($this->data['session'])){
	        $this->load->view('login_view',$this->data);
	    }else{
	    	redirect(base_url());
	    }
	}
	public	function checklogin(){
	 	$email = trim(preg_replace('!\s+!', ' ',html_escape($this->input->post('email', true))));
	    $password = trim(preg_replace('!\s+!', '',$this->input->post('password',true)));
		$details = $this->home_db->getlogin($email);
		if(count($details)){		
			if(password_verify($password, $details[0]->password)) {
				$savesession =array('id'=>$details[0]->id,'email'=>$details[0]->email,'phone'=>$details[0]->phone,'name'=>$details[0]->name);
				$this->session->set_userdata(ADMIN_SESSION, $savesession);	
				echo json_encode(['msg'=>1,'csrf_token'=>$this->security->get_csrf_hash()]);
			}else {
				echo json_encode(['msg'=>0,'csrf_token'=>$this->security->get_csrf_hash()]);
			}			
		}else{
			echo json_encode(['msg'=>-1,'csrf_token'=>$this->security->get_csrf_hash()]);
		}
	}
	public function logout()
	{
	    $this->session->unset_userdata($this->data['session']);
	    redirect(base_url().'login');
	}
}