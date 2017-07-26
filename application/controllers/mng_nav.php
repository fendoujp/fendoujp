<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 导航管理
 * MyDivine
 * 2016-09-26
 */
class Mng_nav extends AC{
	//构造方法
	public function __construct(){
		parent::__construct();
		$this->load->model('nav_model');
	}
	
	public function index(){
		//父导航
		$menu_list = $this->nav_model->get_menu_list();
		//子导航
		$nav_list = $this->nav_model->get_nav_list();
		//将子导航的内容放置在父导航中
		foreach($menu_list as $k=>$v){
			$tmp = array();
			foreach($nav_list as $k2=>$v2){
				if($v2['nav_menu_id'] == $v['menu_id']){
					$tmp[] = $v2;
					unset($nav_list[$k2]);
				}
			}
			$menu_list[$k]['nav'] = $tmp;
		}
		$this->info['menu'] = $menu_list;
		//固定导航模块
		$const_nav = consts::get_const_nav();
		$this->info['const_nav'] = $const_nav;
		//获取已经用过的固定模块
		$used_const_nav = $this->nav_model->get_used_const_nav();
		foreach($used_const_nav as $k=>$v){
			unset($const_nav[$v]);
		}
		if(!$const_nav)$const_nav = array();
		$this->info['const_nav_valid'] = $const_nav;
		$this->v();
	}
	
	public function save_menu(){
		//接收参数
		$op = $this->input->post('op');
		$menu_id = intval($this->input->post('menu_id'));
		$menu_title = trim($this->input->post('menu_title'));
		//控制排序
		$sort = intval($this->input->post('sort'));
		if($sort <= consts::MIN_SORT) $sort = consts::MIN_SORT;
		else if($sort >= consts::MAX_SORT) $sort = consts::MAX_SORT;
		
		//错误
		if($op != CREATE && $op != UPDATE) exit('0');
		if($op == UPDATE && $menu_id < 1) exit('0');
		//表单验证
		//获取表单错误文言配置
		//$form_error_msg = $this->form_error_msg();
		$form_error = array();
		//标题
		if(!$menu_title){
			$form_error['menu_title'.FORM_ERROR_TAIL] = '请输入标题';
		}
		//表单验证失败，返回错误项
		if($form_error) exit(FORM_ERROR_PRE.json_encode($form_error));
		//数据库操作
		$form = array();
		$form['menu_title'] = $menu_title;
		$form['sort'] = $sort;
		if($op == CREATE){
			$form['ct'] = time();
			$form['cer'] = $this->info['admin']['admin_id'];
			$res = $this->nav_model->create_menu($form);
		}else{
			$form['ut'] = time();
			$form['uer'] = $this->info['admin']['admin_id'];
			$res = $this->nav_model->update_menu($form,$menu_id);
		}
		if($res < 1)exit('0');
		exit('1');
	}
	
	public function save_nav(){
		//接收参数
		$op = $this->input->post('op');
		$nav_id = intval($this->input->post('nav_id'));
		$nav_title = trim($this->input->post('nav_title'));
		$nav_menu_id = intval($this->input->post('nav_menu_id'));
		$nav_type = intval($this->input->post('nav_type'));
		//控制排序
		$sort = intval($this->input->post('sort'));
		if($sort <= consts::MIN_SORT) $sort = consts::MIN_SORT;
		else if($sort >= consts::MAX_SORT) $sort = consts::MAX_SORT;
	
		//错误
		if($op != CREATE && $op != UPDATE) exit('0');
		if($op == UPDATE && $nav_id < 1) exit('0');
		//表单验证
		//获取表单错误文言配置
		//$form_error_msg = $this->form_error_msg();
		$form_error = array();
		//标题
		if(!$nav_title){
			$form_error['nav_title'.FORM_ERROR_TAIL] = '请输入标题';
		}
		//分类id必须有效
		if(!$nav_menu_id){
			$form_error['nav_menu_id'.FORM_ERROR_TAIL] = '请选择正确的父导航';
		}
		//检查type重复情况
		if($op == CREATE){
			//获取已经用过的固定模块
			$used_const_nav = $this->nav_model->get_used_const_nav();
			if(in_array($nav_type,$used_const_nav)){
				$form_error['nav_menu_id'.FORM_ERROR_TAIL] = '该特殊模块已经被使用了';
			}
		}
		//表单验证失败，返回错误项
		if($form_error) exit(FORM_ERROR_PRE.json_encode($form_error));
		//数据库操作
		$form = array();
		$form['nav_title'] = $nav_title;		
		$form['nav_menu_id'] = $nav_menu_id;
		$form['sort'] = $sort;
		if($op == CREATE){
			$form['nav_type'] = $nav_type;//type在更新时 不允许更新
			$form['ct'] = time();
			$form['cer'] = $this->info['admin']['admin_id'];
			$res = $this->nav_model->create_nav($form);
		}else{
			$form['ut'] = time();
			$form['uer'] = $this->info['admin']['admin_id'];
			$res = $this->nav_model->update_nav($form,$nav_id);
		}
		if($res < 1)exit('0');
		exit('1');
	}
	
	//nav详情
	public function edit_nav($nav_id = 0){
		//获取ID
		$this->info['nav_id'] = intval($nav_id);
		//获取nav详情
		$nav_info = $this->nav_model->get_nav_by_id($nav_id);
		if(!$nav_info || $nav_info['nav_type'] > 0) redirect('mng_nav');//如果没有信息 或者type不等于0,跳转到列表
		$this->info['nav'] = $nav_info;
		//获取内容模块
		$module = $nav_info['nav_module'];
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
		$this->info['nav_module'] = json_decode($nav_info['nav_module'],true);
		//默认图片
		$this->info['default_module_img'] = $this->path->get_default('module_img');
		$this->v();
	}
	//删除子目录
	public function delete_nav(){
		$nav_id = intval($this->input->post('nav_id'));
		if($nav_id < 1) exit('0');
		//执行数据库删除
		$this->nav_model->delete_nav($nav_id);
		exit('1');
	}
	//删除父目录
	public function delete_menu(){
		$menu_id = intval($this->input->post('menu_id'));
		if($menu_id < 1)exit('0');
		//检查一个目录下是否有子目录
		$nav_list = $this->nav_model->get_nav_list_by_menu_id($menu_id);
		if(count($nav_list) > 0) exit('-1');
		//执行删除
		$this->nav_model->delete_menu($menu_id);
		exit('1');		
	}
	
}