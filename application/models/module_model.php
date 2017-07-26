<?php

/*
 * 首页模型
 * MyDivine
 * 2016-09-06
 */

class Module_model extends CI_Model{
		
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function create_module($form = array()){
		$this->db->insert('tbl_module',$form);
		$res = $this->db->insert_id();
		if($res > 0)return $res;
		return false;
	}
	public function update_module($form = array(),$module_id = 0){
		$module_id = intval($module_id);
		$this->db->where('module_id',$module_id);//ID
		if(!$this->db->update('tbl_module',$form)) return false;
		if($this->db->affected_rows() == 1) return true;
		return false;
	}
	public function delete_module($module_id = 0){
		if(intval($module_id) < 1) return false;
		$sql = 'DELETE FROM tbl_module where module_id = '.intval($module_id);
		return $this->db->query($sql);
	}
	
	//获取所述内容类型的content布局
	public function get_parent_module($parent = '',$id = 0){
		$sql = 'SELECT * FROM tbl_'.$parent.' 
				WHERE '.$parent.'_id = '.intval($id);
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if(!$res) return false;
		else return $res[0][$parent.'_module'];
	}
	public function get_parent_module_school($type = '',$id = 0){
		$sql = 'SELECT * FROM tbl_school 
				WHERE school_id = '.intval($id);
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if(!$res) return false;
		else return $res[0]['school_'.$type.'_module'];
	}
	//保存所属的内容类型的文章布局
	public function save_parent_module($module = '',$table='',$id=0){
		$sql = 'UPDATE tbl_'.$table.' 
				SET '.$table.'_module = "'.$module.'" 
				WHERE '.$table.'_id = '.intval($id);
		return $this->db->query($sql);
	}
	public function save_parent_module_school($module = '',$type = '',$id = 0){
		$sql = 'UPDATE tbl_school  
				SET school_'.$type.'_module = "'.$module.'" 
				WHERE school_id = '.intval($id);
		return $this->db->query($sql);
	}
	
	//按照ID 使用IN查询获取文章布局
	public function get_module_by_id_array($module_id_array = array()){
		
		foreach($module_id_array as $k=>$v){
			if($v == 0) unset($module_id_array[$k]);
		}
		if(!$module_id_array) return array();
		$module_id = '('.implode(',', $module_id_array).')';
		$sql = 'SELECT * FROM tbl_module WHERE module_id IN '.$module_id;
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if($res) return $res;
		return array();
	}
	//根据ID 删除所有模块 ----其他model调用----
	public function delete_module_by_id_array($module_array = array()){
		
		if(!$module_array) return;
		//去掉所有0
		foreach($module_array as $k=>$v){
			if($v == 0) unset($module_array[$k]);
		}
		if(!$module_array) return;
		//查询所有需要删除的图片		
		$sql = 'SELECT * FROM tbl_module WHERE
				module_type = 2 AND module_id IN ('.implode(',', $module_array).')';
		$query = $this->db->query($sql);
		$res = $query->result_array();
		//如果有需要删除的图片
		if($res){
			foreach($res as $k=>$v){
				$path = $this->path->get_path('module_img',$v['module_id']);
				$this->files->del_d($path);//更新时先清除旧文件夹
			}
		}
		//删除所有相关module
		$sql = 'DELETE FROM tbl_module WHERE module_id IN  ('.implode(',', $module_array).')';
		$this->db->query($sql);
		return true;
	}
}