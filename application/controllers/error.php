<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 404
 * MyDivine
 * 2016-09-27
 */

class Error extends UC{
	
	//构造方法	
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		set_status_header(404);
		$this->route['con'] = 'error';
		$this->route['fun'] = 'index';
		$this->v();
	}
		
}