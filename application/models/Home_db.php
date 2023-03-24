<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_db extends CI_Model{

	    public function rows_by_paginations($query,$order_by,$order_by_arr,$db="default")
    {
        $this->load->database($db);

        if(isset($_POST["order"]))
        {
            $order_by = " order by ".$order_by_arr[$_POST['order']['0']['column']]." ".$_POST['order']['0']['dir'];
        }
        
        $limit = " ";
        if($_POST["length"] != -1)
        {
            $limit = " limit {$_POST['length']}";
            if($_POST['start'] > 0){
                $limit = " limit {$_POST['start']}, {$_POST['length']}";
            }
        }
        $query = $this->db->query($query.$order_by.$limit);
        
        return $query->result();
    }   
  
    public function run_manual_query_result($query,$db="default")
    {
        $this->load->database($db);
        $query = $this->db->query($query);
        return $query->result();
    }
    
        public function create_unique_slug($string,$table,$field,$key=NULL,$value=NULL)
    {
        $t =& get_instance();
        $slug = url_title($string);
        $slug = strtolower($slug);
        $i = 0;
        $params = array ();
        $params[$field] = $slug;
    
        if($key)$params["$key !="] = $value;
    
        while ($t->db->where($params)->get($table)->num_rows())
        {
            if (!preg_match ('/-{1}[0-9]+$/', $slug ))
                $slug .= '-' . ++$i;
            else
                $slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
             
            $params [$field] = $slug;
        }
        return $slug;
    }
   function getlogin($email){
        //try {
        //$username = $this->db->escape($db['username']);
        $this->db->select("id, name, email,password,phone, status")
                 ->from('users')
                 ->where(['email'=>$email,'status'=>0]);
        $q = $this->db->get();
        return $q !== FALSE ? $q->result() : array();
    }

        function generateOrderNo($oid){
        $sql = "SELECT CONCAT(  'SQFT9', INSERT( LPAD( id, 5,  '0' ) , 0, 3,  'SQFT9' ) ) AS OrderNo FROM properties WHERE id=$oid";
        $q=$this->db->query($sql);
        if($q->num_rows()>0){
            $res = $q->result();
            return $res[0]->OrderNo;
        }
        else
            return 'SQFT9000001';
    }

     public function properteis_rows($pid,$type)
  {
   $q=$this->db->select('*')
            ->from('properties')
            ->where(['ptype'=>$pid,'type'=>$type,'publish'=>0])
            ->get();
           return $q->num_rows();

  }

      public function getPropertylistbyid($limit,$offset,$pid,$type="")
  {

       $q=$this->db->select('id,title,bedrooms,bathrooms,area,availability,balcony,furnished,leedcertificate,wateravail,price,ptype,face,carpark,washroom,overlooking,electricity,seats,pantry,unitoffloor,paddress,pid,slug,video_path,videotype')
                ->from('properties')
                ->where(['ptype'=>$pid,'type'=>$type,'publish'=>0])
                ->order_by('id desc')
                ->limit($limit,$offset)
                ->get();
               return $q->result();
  }

  public function getwishlist($uid) {
      $q=$this->db->select('p.id,p.type,p.title,p.bedrooms,p.bathrooms,p.area,p.availability,p.balcony,p.furnished,p.leedcertificate,p.wateravail,p.price,p.ptype,p.carpark,p.washroom,p.overlooking,p.electricity,p.seats,p.pantry,p.unitoffloor,p.paddress,p.pid,p.slug,pw.id as wid,pw.created_at')
                ->from('properties p')
                ->join('property_wishlist pw','pw.prid=p.id','left')
                ->where(['pw.user_id'=>$uid])
                ->order_by('p.id desc')
                ->get();
               return $q->result();
  }

       public function getPropertylistfiltersbyid($array)
  {
   // echo "<pre>";print_r($array);exit;
      $limit = $array['configper'];
      $offset = $array['perpage'];
      $where = "";
      
      // if(!empty($amenity)) {
      //   $where .=" ";
      // }
      if(!empty($array['amenity'])) {
          $amenity = $array['amenity'];
      }
      if(!empty($array['bhk'])) {
          $bhk = $array['bhk'];
      }

       if(!empty($array['facing'])) {
          $facing = $array['facing'];
      }

       if(!empty($array['furnish'])) {
          $furnish = $array['furnish'];
      }

       if(!empty($array['floors'])) {
          $floors = $array['floors'];
      }

       if(!empty($array['carpark'])) {
          $carpark = $array['carpark'];
      }
      
     $q =  $this->db->query('');
     return $q !== FALSE ? $q->result() : array();
  }

     public function getPropertylistbycount($pid,$type)
  {

       $q=$this->db->select('id,title,bedrooms,bathrooms,area,availability,balcony,furnished,leedcertificate,wateravail,price,ptype,carpark,washroom,overlooking,electricity,seats,pantry,unitoffloor,paddress,pid,slug')
                ->from('properties')
                ->where(['ptype'=>$pid,'type'=>$type,'publish'=>0])
                ->order_by('id asc')
                ->get();
               return $q->result();
  }

    
}