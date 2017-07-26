<?php
/*
 * 视频模型
 * MyDivine
 * 2016-09-30
 */

class Video_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	//获取设定
	public function get_setting(){
		$sql = 'SELECT * FROM tbl_video_setting WHERE video_setting_id = 1';
		$query = $this->db->query($sql);
		$res = $query->result_array();
		return $res[0];
	}
	public function update_video_setting($form){
		$this->db->where('video_setting_id',1);//ID
		if(!$this->db->update('tbl_video_setting',$form)) return false;
		return true;
	}
	//获取分类列表
	public function get_video_category_list($valid = false){
		$sql = ' SELECT a.*,b.admin_username as cer
				FROM tbl_video_category as a
				LEFT JOIN tbl_admin as b ON a.cer = b.admin_id ';
		if($valid === true)$sql .= ' WHERE a.valid = 1' ;
		$sql .=	' ORDER BY sort DESC, video_category_id DESC ';
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if($res) return $res;
		return array();
	}
	public function create_video_category($form = array()){
		$this->db->insert('tbl_video_category',$form);
		$res = $this->db->insert_id();
		if($res > 0)return $res;
		return false;
	}
	public function update_video_category($form = array(),$video_category_id = 0){
		$video_category_id = intval($video_category_id);
		$this->db->where('video_category_id',$video_category_id);//ID
		if(!$this->db->update('tbl_video_category',$form)) return false;
		if($this->db->affected_rows() == 1) return true;
		return false;
	}
	//修改有效性
	public function video_category_valid($video_category_id = 0){
		if(intval($video_category_id) < 1) return false;
		$sql = 'UPDATE tbl_video_category SET valid = 1-valid where video_category_id = '.intval($video_category_id);
		return $this->db->query($sql);
	}
	//删除
	public function delete_video_category($video_category_id = 0){
		if(intval($video_category_id) < 1) return false;
		$sql = 'DELETE FROM tbl_video_category where video_category_id = '.intval($video_category_id);
		if($this->db->query($sql)){
			//将该分类下所有的文章放入无分类
			$sql = 'UPDATE tbl_video SET video_category_id = 0
					WHERE video_category_id = '.intval($video_category_id);
			$this->db->query($sql);
			return true;
		}
		return false;
	}
	
	
	//video -------------------start---------------------------
	public function get_video_count($category_id = 0 ,$valid = false){
		$sql = 'SELECT count(*) as total FROM tbl_video WHERE 1=1 ';
		if($valid) $sql .= ' AND valid = 1';
		if($category_id > 0) $sql .= ' AND video_category_id = '.$category_id;
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if($res) return $res[0]['total'];
		return 0;
	}
	public function get_video_by_id($video_id){
		$video_id = intval($video_id);
		if($video_id < 1) return array();
		//执行查询
		$sql = 'SELECT a.*,b.video_category_title
				FROM tbl_video as a left join tbl_video_category as b
				ON a.video_category_id = b.video_category_id
				WHERE video_id = '.$video_id;
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if($res) return $res[0];
		return array();
	}
	public function get_video_list($category = 0,$valid_require = false,$page = 0,$per_page = 0){
		$sql = ' SELECT a.*,b.admin_username as cer
				 ,c.video_category_title
				FROM tbl_video as a ';
		$sql .= ' LEFT JOIN tbl_admin as b ON a.cer = b.admin_id
				  LEFT JOIN tbl_video_category as c on a.video_category_id = c.video_category_id';
		$sql .= ' WHERE 1=1 ';
		//分类处理--查询未分类
		if($category < 0){
			$sql .= ' AND a.video_category_id = 0';
		}else if($category > 0){
			$sql .= ' AND a.video_category_id = '.intval($category);
		}
		//如果需要查询有效的
		if($valid_require === true){
			$sql .= ' AND a.valid = 1 ';
		}
		$sql .= ' ORDER BY sort DESC, video_id DESC ';
		//如果需要分页查询
		if($page > 0 && $per_page > 0){
			$sql .= ' LIMIT '.($page-1)*$per_page.','.$per_page;
		}
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if($res) return $res;
		return array();
	}
	public function create_video($form = array()){
		$this->db->insert('tbl_video',$form);
		$res = $this->db->insert_id();
		if($res > 0)return $res;
		return false;
	}
	public function update_video($form = array(),$video_id = 0){
		$video_id = intval($video_id);
		$this->db->where('video_id',$video_id);//ID
		if(!$this->db->update('tbl_video',$form)) return false;
		if($this->db->affected_rows() == 1) return true;
		return false;
	}
	public function delete_video($video_id = 0){
		if(intval($video_id) < 1) return false;
		//////////删除该文章下所有内容模块
		//查询内容
		$video = $this->get_video_by_id($video_id);
		if(!$video) return false;
		//根据内容查询模块LIST
		$module_array = json_decode($video['video_module'],true);
		$this->load->model('module_model');
		$this->module_model->delete_module_by_id_array($module_array);
		//执行删除
		$sql = 'DELETE FROM tbl_video where video_id = '.intval($video_id);
		return $this->db->query($sql);
	}
	public function video_valid($video_id = 0){
		if(intval($video_id) < 1) return false;
		$sql = 'UPDATE tbl_video SET valid = 1-valid where video_id = '.intval($video_id);
		return $this->db->query($sql);
	}
	//video -------------------end---------------------------
	
	
	
}