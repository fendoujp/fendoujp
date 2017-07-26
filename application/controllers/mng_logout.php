<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 登出  控制器  
 * MyDivine
 * 2015-08-01
 */

class Mng_logout extends CI_Controller{
	
	//构造方法	
	public function __construct()
	{
		parent::__construct();
	}
	
	//登录页面
	public function index(){
		unset($_SESSION[SESSION_NAME.'login_token']);
		unset($_SESSION[SESSION_NAME.'admin']);
		redirect('mng_login');
	}

	


}