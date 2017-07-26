<?php

/*
 * 申请流程模型
 * MyDivine
 * 2016-09-16
 */

class Intro_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	//intro -------------------start---------------------------
	public function get_intro_count($valid = false){
		$sql = 'SELECT count(*) as total FROM tbl_intro WHERE 1=1 ';
		if($valid) $sql .= ' AND valid = 1';
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if($res) return $res[0]['total'];
		return 0;
	}
	public function get_intro_by_id($intro_id){
		$intro_id = intval($intro_id);
		if($intro_id < 1) return array();
		//执行查询
		$sql = 'SELECT * 
				FROM tbl_intro 
				WHERE intro_id = '.$intro_id;
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if($res) return $res[0];
		return array();
	}
	public function get_intro_list($valid_require = false,$page = 0,$per_page = 0){
		$sql = ' SELECT a.*,b.admin_username as cer 
				 
				FROM tbl_intro as a ';
		$sql .= ' LEFT JOIN tbl_admin as b ON a.cer = b.admin_id ';
		$sql .= ' WHERE 1=1 ';		
		//如果需要查询有效的
		if($valid_require === true){
			$sql .= ' AND a.valid = 1 ';
		}
		$sql .= ' ORDER BY sort DESC, intro_id DESC ';
		//如果需要分页查询
		if($page > 0 && $per_page > 0){
			$sql .= ' LIMIT '.($page-1)*$per_page.','.$per_page;
		}
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if($res) return $res;
		return array();
	}
	public function create_intro($form = array()){
		$this->db->insert('tbl_intro',$form);
		$res = $this->db->insert_id();
		if($res > 0)return $res;
		return false;
	}
	public function update_intro($form = array(),$intro_id = 0){
		$intro_id = intval($intro_id);
		$this->db->where('intro_id',$intro_id);//ID
		if(!$this->db->update('tbl_intro',$form)) return false;
		if($this->db->affected_rows() == 1) return true;
		return false;
	}
	public function delete_intro($intro_id = 0){
		if(intval($intro_id) < 1) return false;
		//////////删除该文章下所有内容模块
		//查询内容
		$intro = $this->get_intro_by_id($intro_id);
		if(!$intro) return false;
		//根据内容查询模块LIST
		$module_array = json_decode($intro['intro_module'],true);
		if(!$module_array)$module_array = array();;
		$this->load->model('module_model');
		$this->module_model->delete_module_by_id_array($module_array);
		//执行删除
		$sql = 'DELETE FROM tbl_intro where intro_id = '.intval($intro_id);
		return $this->db->query($sql);
	}
	public function intro_valid($intro_id = 0){
		if(intval($intro_id) < 1) return false;
		$sql = 'UPDATE tbl_intro SET valid = 1-valid where intro_id = '.intval($intro_id);
		return $this->db->query($sql);
	}
	//intro -------------------end---------------------------
	
	
	
}