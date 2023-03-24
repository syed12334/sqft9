<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_db extends CI_Model{
	  public function getwishlist($uid) {
      $q=$this->db->select('p.id,p.type,p.slug,p.title,pw.created_at as added_on')
                ->from('properties p')
                ->join('property_wishlist pw','pw.prid=p.id','left')
                ->where(['pw.user_id'=>$uid])
                ->order_by('p.id desc')
                ->get();
               return $q->result();
  }
     public function getContactlist($uid) {
   			$getProperty =  $this->db->select('p.title,p.oname as owner_name,p.ophone as phone,p.oemail as email,p.slug')
                ->from('properties p')
                ->join('owner_address oa','oa.prid = p.id','left')
                ->where(array('oa.uid'=>$uid))
                ->order_by('oa.id desc')
                ->get();
        return $getProperty->result();
   }
   public function getAmenities($prid) {
    $query = $this->db->select('a.title')
                      ->from('property_amenities pa')
                      ->join('amenities a','a.id = pa.p_amenities','left')
                      ->where(['pa.prid'=>$prid])
                      ->group_by('pa.p_amenities')
                      ->order_by('pa.id asc')
                      ->get();
    return $query->result();
   }
}