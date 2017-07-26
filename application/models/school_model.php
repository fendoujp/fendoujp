<?php

/*
 * 学校介绍模型
 * MyDivine
 * 2016-09-16
 */

class School_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	//school -------------------start---------------------------
	public function get_school_count($category_id = 0 ,$valid = false){
		$sql = 'SELECT count(*) as total FROM tbl_school WHERE 1=1 ';
		if($valid) $sql .= ' AND valid = 1';
		if($category_id > 0) $sql .= ' AND school_category_id = '.$category_id;
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if($res) return $res[0]['total'];
		return 0;
	}
	public function get_school_by_id($school_id){
		$school_id = intval($school_id);
		if($school_id < 1) return array();
		//执行查询
		$sql = 'SELECT a.*,b.school_category_name  
				FROM tbl_school as a left join tbl_school_category as b 
				ON a.school_category_id = b.school_category_id 
				WHERE school_id = '.$school_id;
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if($res) return $res[0];
		return array();
	}
	public function get_school_list($category = 0,$valid_require = false,$page = 0,$per_page = 0){
		$sql = ' SELECT a.*,b.admin_username as cer 
				 ,c.school_category_name 
				FROM tbl_school as a ';
		$sql .= ' LEFT JOIN tbl_admin as b ON a.cer = b.admin_id 
				  LEFT JOIN tbl_school_category as c on a.school_category_id = c.school_category_id';
		$sql .= ' WHERE 1=1 ';
		//分类处理--查询未分类
		if($category < 0){
			$sql .= ' AND a.school_category_id = 0';
		}else if($category > 0){
			$sql .= ' AND a.school_category_id = '.intval($category);
		}		
		//如果需要查询有效的
		if($valid_require === true){
			$sql .= ' AND a.valid = 1 ';
		}
		$sql .= ' ORDER BY sort DESC, school_id DESC ';
		//如果需要分页查询
		if($page > 0 && $per_page > 0){
			$sql .= ' LIMIT '.($page-1)*$per_page.','.$per_page;
		}
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if($res) return $res;
		return array();
	}
	public function create_school($form = array()){
		$this->db->insert('tbl_school',$form);
		$res = $this->db->insert_id();
		if($res > 0)return $res;
		return false;
	}
	public function update_school($form = array(),$school_id = 0){
		$school_id = intval($school_id);
		$this->db->where('school_id',$school_id);//ID
		if(!$this->db->update('tbl_school',$form)) return false;
		if($this->db->affected_rows() == 1) return true;
		return false;
	}
	public function delete_school($school_id = 0){
		if(intval($school_id) < 1) return false;
		//////////删除该文章下所有内容模块
		//查询内容
		$school = $this->get_school_by_id($school_id);
		if(!$school) return false;
		//根据内容查询模块LIST
		$module_array_1 = json_decode($school['school_intro_module'],true);
		if(!$module_array_1)$module_array_1 = array();
		$module_array_2 = json_decode($school['school_enrol_module'],true);
		if(!$module_array_2)$module_array_2 = array();
		$module_array_3 = json_decode($school['school_envmt_module'],true);
		if(!$module_array_3)$module_array_3 = array();
		$module_array = array_merge($module_array_1,$module_array_2,$module_array_3);
		$this->load->model('module_model');
		$this->module_model->delete_module_by_id_array($module_array);
		//执行删除
		$sql = 'DELETE FROM tbl_school where school_id = '.intval($school_id);
		return $this->db->query($sql);
	}
	public function school_valid($school_id = 0){
		if(intval($school_id) < 1) return false;
		$sql = 'UPDATE tbl_school SET valid = 1-valid where school_id = '.intval($school_id);
		return $this->db->query($sql);
	}
	//school -------------------end---------------------------
	
	
	
}