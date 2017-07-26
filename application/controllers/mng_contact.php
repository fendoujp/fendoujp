<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 管理端 在线留言管理
 * MyDivine
 * 2016-09-29
 */
class Mng_contact extends AC{
	//构造方法
	public function __construct(){
		parent::__construct();	
		$this->load->model('contact_model');
	}
	//contact控制
	public function index($status = 0,$page = 1){
		$per = 10;//每页00条
		$page = intval($page);
		//-1=未读 1=已读 2=删除
		//0=全部
		$status = intval($status);//数据库中0=未读 1=已读 2=删除
		if($status < -1 || $status > 1) $status = 0;
		//获取总数
		$total = $this->contact_model->get_contact_count($status);
		
		//修正page
		if($page < 1)$page = 1;
		$max_page = ceil($total/$per);
		if($max_page < 1) $max_page = 1;
		if($page > $max_page) $page = $max_page;
		
		//获取列表
		$contact_list = $this->contact_model->get_contact_list($page,$per,$status);
		if($contact_list){
			foreach($contact_list as $k=>$v){
				//处理时间
				$contact_list[$k]['ct'] = date("Y-m-d",$v['ct']).'<br>'.date("H:i:s",$v['ct']);
				$contact_list[$k]['ct_modal'] = date(DATE_YMDHIS,$v['ct']);
			}
		}
		$this->info['contact_list'] = $contact_list;
		$this->info['total'] = $total;
		$this->info['get']['page'] = $page;
		$this->info['max_page'] = $max_page;
		$this->info['get']['status'] = $status;
		//func::debug();
		$this->v();
	}
	//保存已读
	public function status_read(){
		$contact_id = intval($this->input->post('contact_id'));
		if($contact_id < 1)exit('0');
		$update = array();
		$update['ut'] = time();
		$update['uer'] = $this->info['admin']['admin_id'];
		$update['status'] = 1;
		if($this->contact_model->update_contact($update,$contact_id))exit('1');
		exit('0');
	}
	//删除
	public function delete_contact(){
		$contact_id = intval($this->input->post('contact_id'));
		if($contact_id < 1)exit('0');
		$update = array();
		$update['ut'] = time();
		$update['uer'] = $this->info['admin']['admin_id'];
		$update['status'] = 2;
		if($this->contact_model->update_contact($update,$contact_id,'delete'))exit('1');
		exit('0');
	}
	
}


	
	