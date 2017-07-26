<?php

/*
 * 联系我们模型
 * MyDivine
 * 2016-09-29
 */

class Contact_model extends CI_Model{
		
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function create_contact($form = array()){
		$this->db->insert('tbl_contact',$form);
		$res = $this->db->insert_id();
		if($res > 0)return true;
		return false;
	}
	public function update_contact($form=array(),$contact_id,$action='update'){
		$contact_id = intval($contact_id);
		$this->db->where('contact_id',$contact_id);//ID
		//删除的时候不考虑是否已读
		if($action != 'delete'){
			$this->db->where('status',0);//ID
		}
		if(!$this->db->update('tbl_contact',$form)) return false;
		if($this->db->affected_rows() == 1) return true;
		return false;
	}
	
	//参数
	//0=全部 -1=未读 1=已读 2=收藏
	public function get_contact_count($status = 0){
		$status = intval($status);
		//数据库中0=未读 1=已读 2=删除
		$sql = 'SELECT count(*) as total FROM tbl_contact WHERE 1=1 ';
		if($status == 0){
			$sql .= ' AND status != 2';
		}else if($status == -1){
			$sql .= ' AND status = 0';
		}else if($status == 1){
			$sql .= ' AND status = 1';
		}
		$query = $this->db->query($sql);
		$res = $query->result_array();
		return $res[0]['total'];
	}
	public function get_contact_list($page = 1,$per = 20,$status = 0){
		$status = intval($status);
		//数据库中0=未读 1=已读 2=删除
		$sql = 'SELECT * FROM tbl_contact WHERE 1=1 ';
		if($status == 0){
			$sql .= ' AND status != 2';
		}else if($status == -1){
			$sql .= ' AND status = 0';
		}else if($status == 1){
			$sql .= ' AND status = 1';
		}
		$sql .= ' ORDER BY contact_id DESC LIMIT '.($page-1)*$per.','.$per;
		$query = $this->db->query($sql);
		$res = $query->result_array();
		return $res;
	}
	
}