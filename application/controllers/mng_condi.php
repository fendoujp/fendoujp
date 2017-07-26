<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 管理端 申请条件介绍
 * MyDivine
 * 2016-09-06
 */
class Mng_condi extends AC{
	//构造方法
	public function __construct(){
		parent::__construct();	
		$this->load->model('module_model');
		$this->load->model('condi_model');
	}	
	//condi控制
	public function index(){
		//获取列表
		$condi_list = $this->condi_model->get_condi_list();
		$total = count($condi_list);
		$total_valid = 0;
		if($condi_list){
			foreach($condi_list as $k=>$v){
				//处理时间
				$condi_list[$k]['ct'] = date("Y-m-d",$v['ct']).'<br>'.date("H:i:s",$v['ct']);
				//有效
				if($v['valid'] == 1) $total_valid++;
			}
		}
		$this->info['condi_list'] = $condi_list;
		$this->info['total'] = $total;
		$this->info['total_valid'] = $total_valid;
		$this->v();
	}
	//condi详情
	public function edit_condi($condi_id = 0){
		//获取ID
		$this->info['condi_id'] = intval($condi_id);
		//获取condi详情
		$condi_info = $this->condi_model->get_condi_by_id($condi_id);
		if(!$condi_info) redirect('mng_condi');//如果没有信息,跳转到列表
		$this->info['condi'] = $condi_info;
		//获取内容模块
		$module = $condi_info['condi_module'];
		if(!$module)$module = array();
		else{
			$this->load->model('module_model');
			$module = $this->module_model->get_module_by_id_array(json_decode($module,true));
		}
		//根据模块种类 获取图片
		if($module){
			$module_tmp = array();//做一个新的数组 K=ID V=内容
			foreach($module as $k=>$v){
				if($v['module_type'] == 2){
					$v['module_img'] =
					$this->path->get_url($v['module_img'],'module_img',$v['module_id']);
				}
				$module_tmp[$v['module_id']] = $v;
			}
			$module = $module_tmp;
		}
		//所有模块内容
		$this->info['module'] = $module;
		//布局
		$this->info['condi_module'] = json_decode($condi_info['condi_module'],true);
		//默认图片
		$this->info['default_module_img'] = $this->path->get_default('module_img');
		$this->v();
	}
	//创建condi
	public function save_condi(){
		//接收参数
		$op = $this->input->post('op');
		$condi_id = intval($this->input->post('condi_id'));
		$condi_title = trim($this->input->post('condi_title'));
		//控制排序
		$sort = intval($this->input->post('sort'));
		if($sort <= consts::MIN_SORT) $sort = consts::MIN_SORT;
		else if($sort >= consts::MAX_SORT) $sort = consts::MAX_SORT;
	
		//错误
		if($op != CREATE && $op != UPDATE) exit('0');
		if($op == UPDATE && $condi_id < 1) exit('0');
		//表单验证
		//获取表单错误文言配置
		//$form_error_msg = $this->form_error_msg();
		$form_error = array();
		//标题
		if(!$condi_title){
			$form_error['condi_title'.FORM_ERROR_TAIL] = '请输入标题';
		}
		//表单验证失败，返回错误项
		if($form_error) exit(FORM_ERROR_PRE.json_encode($form_error));
		//数据库操作
		$form = array();
		$form['condi_title'] = $condi_title;		
		$form['sort'] = $sort;
		if($op == CREATE){			
			$form['ct'] = time();
			$form['cer'] = $this->info['admin']['admin_id'];
			$res = $this->condi_model->create_condi($form);
		}else{			
			$form['ut'] = time();
			$form['uer'] = $this->info['admin']['admin_id'];
			$res = $this->condi_model->update_condi($form,$condi_id);
		}
		if($res < 1)exit('0');
		exit('1');
	}
	//删除condi
	public function delete_condi(){
		$condi_id = intval($this->input->post('condi_id'));
		if($condi_id < 1) exit('0');
		//执行数据库删除
		$this->condi_model->delete_condi($condi_id);
		//执行文件删除
		$path = $this->path->get_path('condi_img',$condi_id);
		$this->files->del_d($path);
		exit('1');
	}
	//修改condi 有效性
	public function condi_valid(){
		$condi_id = intval($this->input->post('condi_id'));
		if($condi_id < 1) exit('0');
		$res = $this->condi_model->condi_valid($condi_id);
		if($res == 1) exit('1');
		exit('0');
	}
	
}


	
	