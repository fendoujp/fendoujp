<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 联系我们
 * MyDivine
 * 2016-09-29
 */

class Contact extends UC{
	
	//构造方法	
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->info['page_title'] = '联系我们';
		$this->info['page_sub_title'] = 'contact us';
		$token = time().rand(10000,99999);
		$_SESSION[SESSION_NAME.'contact_token'] = $token;
		$this->info['token'] = $token;
		$this->v();
	}
	
	public function save(){
		//获取参数
		$name = trim($this->input->post('name'));
		$email = trim($this->input->post('email'));
		$contact_type = trim($this->input->post('contact_type'));
		$contact_info = trim($this->input->post('contact_info'));
		$topic = trim($this->input->post('topic'));
		$message = trim($this->input->post('message'));
		$token = $this->input->post('token');//token--防止机器人提交--
		//验证参数
		$error = array();
		if(!$name || strlen($name) > 45){
			$error['name'] = 1;
		}
		if(!$email || strlen($email) > 125 || !strpos($email, '@')){
			$error['email'] = 1;
		}
		if($contact_type != '微信' && $contact_type != 'QQ' && $contact_type != '手机'){
			$error['contact_type'] = 1;
		}
		if(!$contact_info || strlen($contact_info) > 45){
			$error['contact_info'] = 1;
		}
		if($topic != '留学咨询' && $topic != '商务合作' && $topic != '其他' ){
			$error['topic'] = 1;
		}
		if(!$message){
			$error['message'] = 1;
		}
		if($token != $_SESSION[SESSION_NAME.'contact_token'] || !$token){
			$error['token'] = 1;
		}
		if($error) exit(json_encode($error));
		
		$create = array();
		$create['contact_name'] = $name;
		$create['contact_email'] = $email;
		$create['contact_type'] = $contact_type;
		$create['contact_info'] = $contact_info;
		$create['contact_topic'] = $topic;
		$create['contact_message'] = $message;
		$create['ip'] = $_SERVER["REMOTE_ADDR"];//ip地址
		$create['ct'] = time();//时间戳
		$create['status'] = 0;//状态 0=未读  1=已读  2=星标  3=删除
		//model执行插入
		$this->load->model('contact_model');
		if($this->contact_model->create_contact($create)){
			$_SESSION[SESSION_NAME.'contact_token'] = '';//销毁session
			exit('success');
		}
		exit('fail');	
	}
	
}