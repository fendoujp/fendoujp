<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 成功提示页面
 * MyDivine
 * 2016-09-29
 */

class Success extends UC{
	
	//构造方法	
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		$this->v();
	}
		
}