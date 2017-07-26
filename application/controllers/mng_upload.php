<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * 管理员上传控制器
 * MyDivine
 * 2015-08-03
 * */

class Mng_upload extends  AC{
 	
	//构造函数
	public function __construct(){
		parent::__construct();
		$this->load->library('files');
		$this->load->library('path');
	}
	
	public function index(){
		$type = $this->input->post('type');
		$file = @$_FILES['img'];//获取的文件
		if(!$file) exit('cannot find FILES[img]');
		
		//获取表单错误文言配置
		$form_error_msg = $this->form_error_msg();
		
		if(@$file['error'] != 0) exit($form_error_msg['upload_fail']);//上传失败
		$filename = $file['name'];
		$filesize = $file['size'];
		
		$admin_id = intval($this->info['admin']['admin_id']);//管理员ID
		//获取配置
		$conf = $this->path->get_conf($type);
		//获取配置失败
		if(!$conf) exit('get config fail ! type error');
		//获取配置成功
		//开始验证文件
		$pathinfo = pathinfo($filename);
		$ext = strtolower($pathinfo['extension']);
		if($ext == 'jpeg') $ext = 'jpg';
		$conf = $this->path->get_conf($type);
		//验证文件类型
		if(!in_array($ext,$conf['type'])) exit($form_error_msg['upload_fail_type']);//上传失败
		//验证文件大小
		if($filesize > $conf['size']) exit($form_error_msg['upload_fail_size']);//上传失败
		//获取临时路径
		$tmp_path = $this->path->admin_path($admin_id);
		if(!$tmp_path) exit('tmp path error');
		//获取临时文件名
		$tmp_name = $this->path->get_rand_name($ext);
		if(!$tmp_name) exit('tmp name error');
		//最终文件路径
		$save_path = $tmp_path.$tmp_name;
		
		//创建文件夹
		$this->files->make_d($tmp_path);
		//保存文件
		if(!$this->files->save_f($file,$save_path)){
			exit($form_error_msg['upload_fail']);//上传失败
		}
		echo 'success_'.$this->path->path_to_url($save_path);
		exit();	
	}
}
	