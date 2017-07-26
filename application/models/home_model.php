<?php

/*
 * 首页模型
 * MyDivine
 * 2016-09-06
 */

class Home_model extends CI_Model{
		
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	//BANNER -------------------start---------------------------
	public function get_top_banner_list(){
		$sql = ' SELECT a.*,b.admin_username as cer  
				FROM tbl_top_banner as a 
				LEFT JOIN tbl_admin as b ON a.cer = b.admin_id 				
				ORDER BY sort DESC, top_banner_id DESC ';
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if($res) return $res;
		return array();		
	}	
	public function create_top_banner($form = array()){
		$this->db->insert('tbl_top_banner',$form);
		$res = $this->db->insert_id();
		if($res > 0)return $res;
		return false;
	}
	public function update_top_banner($form = array(),$top_banner_id = 0){
		$top_banner_id = intval($top_banner_id);
		$this->db->where('top_banner_id',$top_banner_id);//ID
		if(!$this->db->update('tbl_top_banner',$form)) return false;
		if($this->db->affected_rows() == 1) return true;
		return false;
	}
	public function delete_top_banner($top_banner_id = 0){
		if(intval($top_banner_id) < 1) return false;
		$sql = 'DELETE FROM tbl_top_banner where top_banner_id = '.intval($top_banner_id);
		return $this->db->query($sql);
	}
	public function top_banner_valid($top_banner_id = 0){
		if(intval($top_banner_id) < 1) return false;
		$sql = 'UPDATE tbl_top_banner SET valid = 1-valid where top_banner_id = '.intval($top_banner_id);
		return $this->db->query($sql);
	}
	//BANNER -------------------end---------------------------
	
	//SCHOOL_CATEGORY -------------------start---------------------------
	public function get_school_category_list($valid=false){
		$sql = ' SELECT a.*,b.admin_username as cer
				FROM tbl_school_category as a
				LEFT JOIN tbl_admin as b ON a.cer = b.admin_id ';
		if($valid === true)$sql .= ' WHERE a.valid = 1' ;
		$sql .=	' ORDER BY sort DESC, school_category_id DESC ';
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if($res) return $res;
		return array();
	}
	public function create_school_category($form = array()){
		$this->db->insert('tbl_school_category',$form);
		$res = $this->db->insert_id();
		if($res > 0)return $res;
		return false;
	}
	public function update_school_category($form = array(),$school_category_id = 0){
		$school_category_id = intval($school_category_id);
		$this->db->where('school_category_id',$school_category_id);//ID
		if(!$this->db->update('tbl_school_category',$form)) return false;
		if($this->db->affected_rows() == 1) return true;
		return false;
	}
	public function delete_school_category($school_category_id = 0){
		if(intval($school_category_id) < 1) return false;
		$sql = 'DELETE FROM tbl_school_category where school_category_id = '.intval($school_category_id);
		if($this->db->query($sql)){
			/*将该分类下所有的文章放入无分类
			 */
			$sql = 'UPDATE tbl_school SET school_category_id = 0 
					WHERE school_category_id = '.intval($school_category_id);
			$this->db->query($sql);
			return true;	
		}
		return false;
	}
	public function school_category_valid($school_category_id = 0){
		if(intval($school_category_id) < 1) return false;
		$sql = 'UPDATE tbl_school_category SET valid = 1-valid where school_category_id = '.intval($school_category_id);
		return $this->db->query($sql);
	}
	public function get_school_category_by_id($school_category_id = 0){
		$sql = 'SELECT * FROM tbl_school_category WHERE school_category_id = '.intval($school_category_id);
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if(!$res) return array();
		return $res[0];
	}
	//SCHOOL_CATEGORY -------------------end---------------------------
	
	//TOP_INTRO ------------------------start--------------------------
	public function get_top_intro(){
		$sql = 'SELECT a.*,b.admin_username as uer 
				FROM tbl_top_intro as a LEFT JOIN tbl_admin as b 
				ON a.uer = b.admin_id WHERE top_intro_id = 1';
		$query = $this->db->query($sql);
		$res = $query->result_array();		
		return $res[0];
	}
	//更新top_intro
	public function update_top_intro($form = array()){		
		$this->db->where('top_intro_id',1);//ID
		if(!$this->db->update('tbl_top_intro',$form)) return false;
		if($this->db->affected_rows() == 1) return true;
		return false;
	}
	//TOP_INTRO -------------------------end---------------------------
	
	//APPLY_INTRO ------------------------start--------------------------
	public function get_apply_intro(){
		$sql = 'SELECT a.*,b.admin_username as uer
				FROM tbl_apply_intro as a LEFT JOIN tbl_admin as b
				ON a.uer = b.admin_id WHERE apply_intro_id = 1';
		$query = $this->db->query($sql);
		$res = $query->result_array();
		return $res[0];
	}
	//更新apply_intro
	public function update_apply_intro($form = array()){
		$this->db->where('apply_intro_id',1);//ID
		if(!$this->db->update('tbl_apply_intro',$form)) return false;
		if($this->db->affected_rows() == 1) return true;
		return false;
	}
	//APPLY_INTRO -------------------------end---------------------------
	
	//APPLY_CONDITION ------------------------start--------------------------
	public function get_apply_condition(){
		$sql = 'SELECT a.*,b.admin_username as uer
				FROM tbl_apply_condition as a LEFT JOIN tbl_admin as b
				ON a.uer = b.admin_id WHERE apply_condition_id = 1';
		$query = $this->db->query($sql);
		$res = $query->result_array();
		return $res[0];
	}
	//更新apply_condition
	public function update_apply_condition($form = array()){
		$this->db->where('apply_condition_id',1);//ID
		if(!$this->db->update('tbl_apply_condition',$form)) return false;
		if($this->db->affected_rows() == 1) return true;
		return false;
	}
	//APPLY_CONDITION -------------------------end---------------------------
	
	//EXP_SHARE -------------------start---------------------------
	public function get_exp_share_count($valid = false){
		$sql = 'SELECT count(*) as total FROM tbl_exp_share ';
		if($valid) $sql .= ' WHERE valid = 1';
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if($res) return $res[0]['total'];
		return 0;
	}
	public function get_exp_share_by_id($exp_share_id){
		$exp_share_id = intval($exp_share_id);
		if($exp_share_id < 1) return array();
		//执行查询
		$sql = 'SELECT * FROM tbl_exp_share WHERE exp_share_id = '.$exp_share_id;
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if($res) return $res[0];
		return array();
	}
	public function get_exp_share_list($valid_require = false,$page = 0,$per_page = 0){
		$sql = ' SELECT a.*,b.admin_username as cer
				FROM tbl_exp_share as a ';
		$sql .= ' LEFT JOIN tbl_admin as b ON a.cer = b.admin_id ';
		//如果需要查询有效的
		if($valid_require === true){
			$sql .= ' WHERE a.valid = 1 ';
		}		
		$sql .= ' ORDER BY sort DESC, exp_share_id DESC ';
		//如果需要分页查询
		if($page > 0 && $per_page > 0){
			$sql .= ' LIMIT '.($page-1)*$per_page.','.$per_page;
		}
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if($res) return $res;
		return array();
	}
	public function create_exp_share($form = array()){
		$this->db->insert('tbl_exp_share',$form);
		$res = $this->db->insert_id();
		if($res > 0)return $res;
		return false;
	}
	public function update_exp_share($form = array(),$exp_share_id = 0){
		$exp_share_id = intval($exp_share_id);
		$this->db->where('exp_share_id',$exp_share_id);//ID
		if(!$this->db->update('tbl_exp_share',$form)) return false;
		if($this->db->affected_rows() == 1) return true;
		return false;
	}
	public function delete_exp_share($exp_share_id = 0){
		if(intval($exp_share_id) < 1) return false;
		//////////删除该文章下所有内容模块
		//查询内容
		$exp_share = $this->get_exp_share_by_id($exp_share_id);
		if(!$exp_share) return false;
		//根据内容查询模块LIST
		$module_array = json_decode($exp_share['exp_share_module'],true);
		if(!$module_array)$module_array = array();
		$this->load->model('module_model');
		$this->module_model->delete_module_by_id_array($module_array);	
		//执行删除
		$sql = 'DELETE FROM tbl_exp_share where exp_share_id = '.intval($exp_share_id);
		return $this->db->query($sql);
	}
	public function exp_share_valid($exp_share_id = 0){
		if(intval($exp_share_id) < 1) return false;
		$sql = 'UPDATE tbl_exp_share SET valid = 1-valid where exp_share_id = '.intval($exp_share_id);
		return $this->db->query($sql);
	}
	//EXP_SHARE -------------------end---------------------------
	
	//ARTICLE_CATEGORY -------------------start---------------------------
	public function get_article_category_list(){
		$sql = ' SELECT a.*,b.admin_username as cer
				FROM tbl_article_category as a
				LEFT JOIN tbl_admin as b ON a.cer = b.admin_id
				ORDER BY sort DESC, article_category_id DESC ';
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if($res) return $res;
		return array();
	}
	public function create_article_category($form = array()){
		$this->db->insert('tbl_article_category',$form);
		$res = $this->db->insert_id();
		if($res > 0)return $res;
		return false;
	}
	public function update_article_category($form = array(),$article_category_id = 0){
		$article_category_id = intval($article_category_id);
		$this->db->where('article_category_id',$article_category_id);//ID
		if(!$this->db->update('tbl_article_category',$form)) return false;
		if($this->db->affected_rows() == 1) return true;
		return false;
	}
	public function delete_article_category($article_category_id = 0){
		if(intval($article_category_id) < 1) return false;
		$sql = 'DELETE FROM tbl_article_category where article_category_id = '.intval($article_category_id);
		if($this->db->query($sql)){
			/*这里将要执行的代码是:将该分类下所有的文章放入无分类
			 * 目前分类的表还没有 所以先空下来
			*/
			return true;
		}
		return false;
	}
	public function article_category_valid($article_category_id = 0){
		if(intval($article_category_id) < 1) return false;
		$sql = 'UPDATE tbl_article_category SET valid = 1-valid where article_category_id = '.intval($article_category_id);
		return $this->db->query($sql);
	}
	public function get_article_category_by_id($article_category_id = 0){
		$sql = 'SELECT * FROM tbl_article_category WHERE article_category_id = '.intval($article_category_id);
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if(!$res) return array();
		return $res[0];
	}
	//ARTICLE_CATEGORY -------------------end---------------------------
	
	//BTM_ADVERT -------------------start---------------------------
	public function get_btm_advert_list(){
		$sql = ' SELECT a.*,b.admin_username as cer
				FROM tbl_btm_advert as a
				LEFT JOIN tbl_admin as b ON a.cer = b.admin_id
				ORDER BY sort DESC, btm_advert_id DESC ';
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if($res) return $res;
		return array();
	}
	public function create_btm_advert($form = array()){
		$this->db->insert('tbl_btm_advert',$form);
		$res = $this->db->insert_id();
		if($res > 0)return $res;
		return false;
	}
	public function update_btm_advert($form = array(),$btm_advert_id = 0){
		$btm_advert_id = intval($btm_advert_id);
		$this->db->where('btm_advert_id',$btm_advert_id);//ID
		if(!$this->db->update('tbl_btm_advert',$form)) return false;
		if($this->db->affected_rows() == 1) return true;
		return false;
	}
	public function delete_btm_advert($btm_advert_id = 0){
		if(intval($btm_advert_id) < 1) return false;
		$sql = 'DELETE FROM tbl_btm_advert where btm_advert_id = '.intval($btm_advert_id);
		return $this->db->query($sql);
	}
	public function btm_advert_valid($btm_advert_id = 0){
		if(intval($btm_advert_id) < 1) return false;
		$sql = 'UPDATE tbl_btm_advert SET valid = 1-valid where btm_advert_id = '.intval($btm_advert_id);
		return $this->db->query($sql);
	}
	//BTM_ADVERT -------------------end---------------------------
	
	//BTM_MARQUEE -------------------start---------------------------
	public function get_btm_marquee_list(){
		$sql = ' SELECT a.*,b.admin_username as cer
				FROM tbl_btm_marquee as a
				LEFT JOIN tbl_admin as b ON a.cer = b.admin_id
				ORDER BY sort DESC, btm_marquee_id DESC ';
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if($res) return $res;
		return array();
	}
	public function create_btm_marquee($form = array()){
		$this->db->insert('tbl_btm_marquee',$form);
		$res = $this->db->insert_id();
		if($res > 0)return $res;
		return false;
	}
	public function update_btm_marquee($form = array(),$btm_marquee_id = 0){
		$btm_marquee_id = intval($btm_marquee_id);
		$this->db->where('btm_marquee_id',$btm_marquee_id);//ID
		if(!$this->db->update('tbl_btm_marquee',$form)) return false;
		if($this->db->affected_rows() == 1) return true;
		return false;
	}
	public function delete_btm_marquee($btm_marquee_id = 0){
		if(intval($btm_marquee_id) < 1) return false;
		$sql = 'DELETE FROM tbl_btm_marquee where btm_marquee_id = '.intval($btm_marquee_id);
		return $this->db->query($sql);
	}
	public function btm_marquee_valid($btm_marquee_id = 0){
		if(intval($btm_marquee_id) < 1) return false;
		$sql = 'UPDATE tbl_btm_marquee SET valid = 1-valid where btm_marquee_id = '.intval($btm_marquee_id);
		return $this->db->query($sql);
	}
	//BTM_MARQUEE -------------------end---------------------------
	
	//LAYOUT------------------------start--------------------------
	public function get_layout(){
		$query = $this->db->query('SELECT * FROM tbl_home_layout WHERE layout_id = 1');
		$res = $query->result_array();
		return $res[0];
	}
	public function get_count($table_name = ''){
		$query = $this->db->query('SELECT count(*) as total FROM '.$table_name);
		$res = $query->result_array();
		return $res[0]['total'];
	}
	public function layout_valid($layout=''){
		return $this->db->query('UPDATE tbl_home_layout 
								SET layout_'.$layout.' = 1 - layout_'.$layout.'
								WHERE layout_id = 1');
	}
	public function layout_title($layout='',$title=''){
		return $this->db->query('UPDATE tbl_home_layout 
								SET layout_'.$layout.'_title = "'.$title.'" 
								WHERE layout_id = 1');
	}
	//LAYOUT-------------------------end---------------------------
}