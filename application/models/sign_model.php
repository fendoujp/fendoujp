<?php

/*
 * 报名模型
 * MyDivine
 * 2016-10-22
 */

class Sign_model extends CI_Model{
		
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	//创建
	public function create_sign($form = array()){
		$this->db->insert('tbl_sign',$form);
		$res = $this->db->insert_id();
		if($res > 0)return true;
		return false;
	}
	//获取数量
	//状态 1=未对应 2 =对应中 3=成功 4=失败 5=被删除
	public function get_sign_count($status=0){
		$status = intval($status);
		$sql = 'SELECT count(*) as total FROM tbl_sign';
		if($status == 0) $sql .= ' WHERE status < 5 ';
		else $sql .= ' WHERE status = '.intval($status);
		$query = $this->db->query($sql);
		$res = $query->result_array();
		return $res[0]['total'];
	}
	//获取列表
	public function get_sign_list($page = 1,$per = 1,$status = -1){
		$sql = 'SELECT sign_id,ip,ct,name,mobile,telphone,wechat,qq,status,ut,uer,
				b.admin_username as uer_username
				FROM tbl_sign left join tbl_admin as b ON tbl_sign.uer = b.admin_id ';
		if($status == 0) $sql .= ' WHERE status < 5 ';
		else $sql .= ' WHERE status = '.intval($status);
		$sql .= ' ORDER BY sign_id DESC ';
		$sql .= ' LIMIT '.($page-1)*$per.','.$per;
		$query = $this->db->query($sql);
		$res = $query->result_array();
		return $res;
	}
	//更新
	public function update_sign($form = array(),$sign_id = 0){
		$this->db->where('sign_id',$sign_id);
		$this->db->update('tbl_sign',$form);
		if($this->db->affected_rows() == 1) return true;
		return false;
	}
	//更新status
	public function update_status($form = array(),$sign_id = 0,$target='delete'){
		$this->db->where('sign_id',$sign_id);
		if($target == 'delete')$this->db->where('status',1);//删除
		elseif($target == 'operate')$this->db->where('status',1);//开始对应
		elseif($target == 'success')$this->db->where('status',2);//成功
		elseif($target == 'fail')$this->db->where('status',2);//失败
		elseif($target == 'reverse') $a = 1;//恢复到对应中
		else return false;
		$this->db->update('tbl_sign',$form);
		if($this->db->affected_rows() == 1) return true;
		return false;
	}
	//获取详情
	public function get_sign_by_id($sign_id = 0){
		$sign_id = intval($sign_id);
		$sql = 'SELECT a.*,b.admin_username as der_username,
						c.admin_username as dy_er_username,
						d.admin_username as s_er_username,
						e.admin_username as f_er_username,
						f.admin_username as uer_username 
				FROM tbl_sign as a LEFT JOIN tbl_admin as b on a.der = b.admin_id 
					LEFT JOIN tbl_admin as c on a.dy_er = c.admin_id 
					LEFT JOIN tbl_admin as d on a.s_er = d.admin_id 
					LEFT JOIN tbl_admin as e on a.f_er = e.admin_id 
					LEFT JOIN tbl_admin as f on a.uer = f.admin_id 				
				WHERE sign_id = '.$sign_id;
		$query = $this->db->query($sql);
		$res = $query->result_array();
		if($res) return $res[0];
		return array();
	}
	
}