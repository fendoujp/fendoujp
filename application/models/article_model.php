<?php

/*
 * 发帖模型
 * MyDivine
 * 2016-09-21
 */

class Article_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	//article -------------------start---------------------------
	public function get_article_count($category_id = 0 ,$valid = false){
		$sql = 'SELECT count(*) as total FROM tbl_article WHERE 1=1 ';
		if($valid) $sql .= ' AND valid = 1';
		if($category_id > 0) $sql .= ' AND article_category_id = '.$category_id;
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if($res) return $res[0]['total'];
		return 0;
	}
	public function get_article_by_id($article_id){
		$article_id = intval($article_id);
		if($article_id < 1) return array();
		//执行查询
		$sql = 'SELECT a.*,b.article_category_name  
				FROM tbl_article as a left join tbl_article_category as b 
				ON a.article_category_id = b.article_category_id 
				WHERE article_id = '.$article_id;
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if($res) return $res[0];
		return array();
	}
	public function get_article_list($category = 0,$valid_require = false,$page = 0,$per_page = 0){
		$sql = ' SELECT a.*,b.admin_username as cer 
				 ,c.article_category_name 
				FROM tbl_article as a ';
		$sql .= ' LEFT JOIN tbl_admin as b ON a.cer = b.admin_id 
				  LEFT JOIN tbl_article_category as c on a.article_category_id = c.article_category_id';
		$sql .= ' WHERE 1=1 ';
		//分类处理--查询未分类
		if($category < 0){
			$sql .= ' AND a.article_category_id = 0';
		}else if($category > 0){
			$sql .= ' AND a.article_category_id = '.intval($category);
		}		
		//如果需要查询有效的
		if($valid_require === true){
			$sql .= ' AND a.valid = 1 ';
		}
		$sql .= ' ORDER BY sort DESC, article_id DESC ';
		//如果需要分页查询
		if($page > 0 && $per_page > 0){
			$sql .= ' LIMIT '.($page-1)*$per_page.','.$per_page;
		}
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if($res) return $res;
		return array();
	}
	public function create_article($form = array()){
		$this->db->insert('tbl_article',$form);
		$res = $this->db->insert_id();
		if($res > 0)return $res;
		return false;
	}
	public function update_article($form = array(),$article_id = 0){
		$article_id = intval($article_id);
		$this->db->where('article_id',$article_id);//ID
		if(!$this->db->update('tbl_article',$form)) return false;
		if($this->db->affected_rows() == 1) return true;
		return false;
	}
	public function delete_article($article_id = 0){
		if(intval($article_id) < 1) return false;
		//////////删除该文章下所有内容模块
		//查询内容
		$article = $this->get_article_by_id($article_id);
		if(!$article) return false;
		//根据内容查询模块LIST
		$module_array = json_decode($article['article_module'],true);		
		$this->load->model('module_model');
		$this->module_model->delete_module_by_id_array($module_array);
		//执行删除
		$sql = 'DELETE FROM tbl_article where article_id = '.intval($article_id);
		return $this->db->query($sql);
	}
	public function article_valid($article_id = 0){
		if(intval($article_id) < 1) return false;
		$sql = 'UPDATE tbl_article SET valid = 1-valid where article_id = '.intval($article_id);
		return $this->db->query($sql);
	}
	//article -------------------end---------------------------
	
	
	
}