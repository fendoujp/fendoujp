<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * 2015-08-01
 * MyDivine
 * 
 */

//管理员控制器基类
class AC extends CI_Controller {
	//管理员session信息
	var $admin = array();	
	public function __construct(){
		parent::__construct();
		//用户信息
		$this->admin = @$_SESSION[SESSION_NAME.'admin'];
		//判断是否已经登录过 如果未登录 跳转到登录
		if(@!$this->admin){
			redirect('mng_login');
		}		
		//用户信息绑定到模板
		$this->info['admin'] =& $this->admin;
	}	
}

