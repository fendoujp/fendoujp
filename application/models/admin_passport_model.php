<?php

/*
 * 管理员模型
 * MyDivine
 * 2016-09-06
 */

class Admin_passport_model extends CI_Model{
		
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	//验证登录
	public function check_login($admin_mobile = '',$admin_password = ''){
		if($admin_mobile == '' || $admin_password == '')return false;
		$sql = 'SELECT * FROM tbl_admin 
				WHERE admin_username = ? 
				AND admin_password = ? ';
		$query = $this->db->query($sql,array($admin_mobile,md5($admin_password)));
		$res = $query->result_array();
		if(!$res){
			return false;
		}else{
			return $res[0];
		}
	}

}