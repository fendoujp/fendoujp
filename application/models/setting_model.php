<?php
/*
 * 设定模型
 * MyDivine
 * 2016-09-28
 */

class Setting_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function update_seo($form){
		$this->db->where('seo_id',1);//ID
		if(!$this->db->update('tbl_seo',$form)) return false;
		return true;
	}
	public function get_seo(){
		$sql = 'SELECT * FROM tbl_seo WHERE seo_id = 1';
		$query = $this->db->query($sql);
		$res = $query->result_array();
		return $res[0];
	}
	public function update_head($form){
		$this->db->where('head_id',1);//ID
		if(!$this->db->update('tbl_head',$form)) return false;
		return true;
	}
	public function get_head(){
		$sql = 'SELECT * FROM tbl_head WHERE head_id = 1';
		$query = $this->db->query($sql);
		$res = $query->result_array();
		return $res[0];
	}
	public function update_foot($form){
		$this->db->where('foot_id',1);//ID
		if(!$this->db->update('tbl_foot',$form)) return false;
		return true;
	}
	public function get_foot(){
		$sql = 'SELECT * FROM tbl_foot WHERE foot_id = 1';
		$query = $this->db->query($sql);
		$res = $query->result_array();
		return $res[0];
	}
	public function get_link(){
		$sql = 'SELECT * FROM tbl_link';
		$query = $this->db->query($sql);
		$res = $query->result_array();
		return $res;
	}
	public function update_link($form=array(),$link_id = 0){
		$this->db->where('link_id',intval($link_id));//ID
		if(!$this->db->update('tbl_link',$form)) return false;
		return true;
	}
	public function update_rate($rate){
		if(strlen($rate) != 5) return false;
		return $this->db->query('UPDATE tbl_head SET rate = "'.$rate.'" WHERE head_id = 1');
	}
	
}