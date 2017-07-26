<?php

/*
 * 导航模型
 * MyDivine
 * 2016-09-26
 */

class Nav_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	//menu--------------------start----------------
	public function create_menu($form = array()){
		$this->db->insert('tbl_menu',$form);
		$res = $this->db->insert_id();
		if($res > 0)return $res;
		return false;
	}
	public function get_menu_list(){
		$query = $this->db->query('SELECT * FROM tbl_menu ORDER BY sort DESC, menu_id DESC ');
		$res = $query->result_array();
		if($res) return $res;
		return array();
	}
	public function update_menu($form = array(),$menu_id = 0){
		$menu_id = intval($menu_id);
		$this->db->where('menu_id',$menu_id);//ID
		if(!$this->db->update('tbl_menu',$form)) return false;
		if($this->db->affected_rows() == 1) return true;
		return false;
	}
	public function delete_menu($menu_id = 0){
		if(intval($menu_id) < 1) return false;		
		//执行删除
		$sql = 'DELETE FROM tbl_menu where menu_id = '.intval($menu_id);
		return $this->db->query($sql);
	}
	//menu----------------end----------------------
	
	//查询已经使用过的type
	public function get_used_const_nav(){
		$query = $this->db->query('SELECT DISTINCT(nav_type) as use_nav FROM tbl_nav');
		$res = $query->result_array();
		if(!$res) return array();
		//去掉0  降维
		$return = array();
		foreach($res as $k=>$v){
			if($v['use_nav'] == 0) continue;
			$return[] = $v['use_nav'];
		}
		return $return;
	}
	
	//nav -------------------start---------------------------
	public function get_nav_by_id($nav_id = 0){
		$nav_id = intval($nav_id);
		$sql = 'SELECT * FROM tbl_nav WHERE nav_id ='.intval($nav_id);
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if(!$res) return array();
		return $res[0];
	}
	public function get_nav_list(){
		$sql = ' SELECT * FROM tbl_nav 
				 ORDER BY sort DESC, nav_id DESC ';
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if($res) return $res;
		return array();
	}
	public function get_nav_list_by_menu_id($menu_id = 0){
		$menu_id = intval($menu_id);
		$sql = 'SELECT * FROM tbl_nav WHERE nav_menu_id ='.intval($menu_id).' ORDER BY sort DESC, nav_id DESC ';
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if(!$res) return array();
		return $res;
	}
	public function create_nav($form = array()){
		$this->db->insert('tbl_nav',$form);
		$res = $this->db->insert_id();
		if($res > 0)return $res;
		return false;
	}
	public function update_nav($form = array(),$nav_id = 0){
		$nav_id = intval($nav_id);
		$this->db->where('nav_id',$nav_id);//ID
		if(!$this->db->update('tbl_nav',$form)) return false;
		if($this->db->affected_rows() == 1) return true;
		return false;
	}
	public function delete_nav($nav_id = 0){
		if(intval($nav_id) < 1) return false;
		//////////删除该文章下所有内容模块
		//查询内容
		$nav = $this->get_nav_by_id($nav_id);
		if(!$nav) return false;
		//根据内容查询模块LIST
		$module_array = json_decode($nav['nav_module'],true);
		if(!$module_array)$module_array = array();;
		$this->load->model('module_model');
		$this->module_model->delete_module_by_id_array($module_array);
		//执行删除
		$sql = 'DELETE FROM tbl_nav where nav_id = '.intval($nav_id);
		return $this->db->query($sql);
	}
	//nav -------------------end---------------------------
	
	
	
}