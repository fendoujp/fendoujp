<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 登录   控制器  
 * MyDivine
 * 2015-08-01
 */

class Mng_login extends CI_Controller{
	
	//构造方法	
	public function __construct()
	{
		parent::__construct();	
		//判断是否已经登录过 如果登录过了，跳转到首页
		if(!empty($_SESSION[SESSION_NAME.'admin'])){
			redirect('mng_home');
		}
	}
	
	//登录页面
	public function index(){
		//登记一个 token
		$_SESSION[SESSION_NAME.'login_token'] = md5(time().rand(1111,9999));
		$this->info['login_token'] = $_SESSION[SESSION_NAME.'login_token'];
		$this->v();
	}

	//验证登录
	public function do_login(){
		//获取表单错误文言配置
		$form_error_msg = $this->form_error_msg();		
		//检查token
		$login_token = $this->input->post('login_token');
		//如果获取不到token或者session中没有保存token或者两者不一致，则报错退出
		if(!@$_SESSION[SESSION_NAME.'login_token'] || !$login_token || $login_token != @$_SESSION[SESSION_NAME.'login_token'])
		{
			exit($form_error_msg['login_token_error']);
		}
		//获取post提交的账号、密码并验证
		$admin_username = trim($this->input->post('admin_username'));
		$admin_password = $this->input->post('admin_password'); 
		
		if(!$admin_username || !$admin_password){
			exit($form_error_msg['empty']);
		}		
			
		//验证账号和密码正确性,成功记录账号的信息到session中
		$this->load->model('admin_passport_model');
		
		//提交验证
		$admin_info = $this->admin_passport_model->check_login($admin_username,$admin_password);
		
		// 账号或密码输入有误
		if(!$admin_info) exit($form_error_msg['check_error']);
		//被禁用
		if($admin_info['admin_valid'] != 1) exit($form_error_msg['admin_valid']);
		//登录成功注册session_user
		$_SESSION[SESSION_NAME.'admin'] = $admin_info;
		//删除login token
		unset($_SESSION[SESSION_NAME.'login_token']);
		exit('1');
	}



}