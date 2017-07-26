<?php

/*
 * 申请条件模型
 * MyDivine
 * 2016-09-16
 */

class Condi_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	//condi -------------------start---------------------------
	public function get_condi_count($valid = false){
		$sql = 'SELECT count(*) as total FROM tbl_condi WHERE 1=1 ';
		if($valid) $sql .= ' AND valid = 1';
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if($res) return $res[0]['total'];
		return 0;
	}
	public function get_condi_by_id($condi_id){
		$condi_id = intval($condi_id);
		if($condi_id < 1) return array();
		//执行查询
		$sql = 'SELECT * 
				FROM tbl_condi 
				WHERE condi_id = '.$condi_id;
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if($res) return $res[0];
		return array();
	}
	public function get_condi_list($valid_require = false,$page = 0,$per_page = 0){
		$sql = ' SELECT a.*,b.admin_username as cer 
				 
				FROM tbl_condi as a ';
		$sql .= ' LEFT JOIN tbl_admin as b ON a.cer = b.admin_id ';
		$sql .= ' WHERE 1=1 ';		
		//如果需要查询有效的
		if($valid_require === true){
			$sql .= ' AND a.valid = 1 ';
		}
		$sql .= ' ORDER BY sort DESC, condi_id DESC ';
		//如果需要分页查询
		if($page > 0 && $per_page > 0){
			$sql .= ' LIMIT '.($page-1)*$per_page.','.$per_page;
		}
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if($res) return $res;
		return array();
	}
	public function create_condi($form = array()){
		$this->db->insert('tbl_condi',$form);
		$res = $this->db->insert_id();
		if($res > 0)return $res;
		return false;
	}
	public function update_condi($form = array(),$condi_id = 0){
		$condi_id = intval($condi_id);
		$this->db->where('condi_id',$condi_id);//ID
		if(!$this->db->update('tbl_condi',$form)) return false;
		if($this->db->affected_rows() == 1) return true;
		return false;
	}
	public function delete_condi($condi_id = 0){
		if(intval($condi_id) < 1) return false;
		//////////删除该文章下所有内容模块
		//查询内容
		$condi = $this->get_condi_by_id($condi_id);
		if(!$condi) return false;
		//根据内容查询模块LIST
		$module_array = json_decode($condi['condi_module'],true);
		if(!$module_array)$module_array = array();;
		$this->load->model('module_model');
		$this->module_model->delete_module_by_id_array($module_array);
		//执行删除
		$sql = 'DELETE FROM tbl_condi where condi_id = '.intval($condi_id);
		return $this->db->query($sql);
	}
	public function condi_valid($condi_id = 0){
		if(intval($condi_id) < 1) return false;
		$sql = 'UPDATE tbl_condi SET valid = 1-valid where condi_id = '.intval($condi_id);
		return $this->db->query($sql);
	}
	//condi -------------------end---------------------------
	
	
	
}