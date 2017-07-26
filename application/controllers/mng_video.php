<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 管理端视频管理
 * MyDivine
 * 2016-09-30
 */
class Mng_video extends AC{
	//构造方法
	public function __construct(){
		parent::__construct();		
		$this->load->model('video_model');
		
		//子菜单数组
		$this->menu_array = array();
		$this->menu_array['index'] = '综合设置';
		$this->menu_array['category'] = '视频分类';
		$this->menu_array['video'] = '视频列表';
		$this->menu_array['edit_video'] = '编辑视频';
		//默认使用当前方法作为子菜单的选中方法
		//如果需要其他方法作为子菜单的选中方法，重新执行一下 更换最后的参数即可
		$this->info['submenu'] = 
		func::get_sub_menu($this->info['route'],$this->menu_array,$this->info['route']['fun']);
	}
	//总览
	public function index(){
		$this->info['video_setting'] = $this->video_model->get_setting();
		$this->v();
	}
	public function save_video_setting(){
		//导航栏题目
		$video_setting_menu_title = trim($this->input->post('video_setting_menu_title'));
		//内页标题
		$video_setting_page_title = trim($this->input->post('video_setting_page_title'));
		//内页副标题
		$video_setting_page_sub_title = trim($this->input->post('video_setting_page_sub_title'));
		$valid = intval($this->input->post('valid'));
		if($valid != 1) $valid = 0;
		//表单验证
		$form_error = array();
		//标题
		if(!$video_setting_menu_title){
			$form_error['video_setting_menu_title'.FORM_ERROR_TAIL] = '请输入导航标题';
		}
		if(!$video_setting_page_title){
			$form_error['video_setting_page_title'.FORM_ERROR_TAIL] = '请输入内页标题';
		}
		if(!$video_setting_page_sub_title){
			$form_error['video_setting_page_sub_title'.FORM_ERROR_TAIL] = '请输入内页副标题';
		}
		//表单验证失败，返回错误项
		if($form_error) exit(FORM_ERROR_PRE.json_encode($form_error));
		//数据库操作
		$form = array();
		$form['video_setting_menu_title'] = $video_setting_menu_title;
		$form['video_setting_page_title'] = $video_setting_page_title;
		$form['video_setting_page_sub_title'] = $video_setting_page_sub_title;
		$form['valid'] = $valid;		
		if($this->video_model->update_video_setting($form))exit('1');
		exit('0');
	}	
	//category
	public function category(){
		//获取列表
		$video_category_list = $this->video_model->get_video_category_list();
		$total = count($video_category_list);
		$total_valid = 0;
		if($video_category_list){
			foreach($video_category_list as $k=>$v){
				//处理时间
				$video_category_list[$k]['ct'] = date("Y-m-d H:i:s",$v['ct']);
				//有效
				if($v['valid'] == 1) $total_valid++;
			}
		}
		$this->info['video_category_list'] = $video_category_list;
		$this->info['total'] = $total;
		$this->info['total_valid'] = $total_valid;
		$this->v();
	}
	public function save_video_category(){
		//接收参数
		$op = $this->input->post('op');
		$video_category_id = intval($this->input->post('video_category_id'));
		$video_category_title = trim($this->input->post('video_category_title'));
		//控制排序
		$sort = intval($this->input->post('sort'));
		if($sort <= consts::MIN_SORT) $sort = consts::MIN_SORT;
		else if($sort >= consts::MAX_SORT) $sort = consts::MAX_SORT;
		
		//错误
		if($op != CREATE && $op != UPDATE) exit('0');
		if($op == UPDATE && $video_category_id < 1) exit('0');
		//表单验证
		//获取表单错误文言配置
		//$form_error_msg = $this->form_error_msg();
		$form_error = array();
		//标题
		if(!$video_category_title){
			$form_error['video_category_title'.FORM_ERROR_TAIL] = '请输入标题';
		}
		//表单验证失败，返回错误项
		if($form_error) exit(FORM_ERROR_PRE.json_encode($form_error));
		//数据库操作
		$form = array();
		$form['video_category_title'] = $video_category_title;		
		$form['sort'] = $sort;
		if($op == CREATE){			
			$form['ct'] = time();
			$form['cer'] = $this->info['admin']['admin_id'];
			$res = $this->video_model->create_video_category($form);
		}else{			
			$form['ut'] = time();
			$form['uer'] = $this->info['admin']['admin_id'];
			$res = $this->video_model->update_video_category($form,$video_category_id);
		}
		if($res < 1)exit('0');
		exit('1');
	}
	//修改video category 有效性
	public function video_category_valid(){
		$video_category_id = intval($this->input->post('video_category_id'));
		if($video_category_id < 1) exit('0');
		$res = $this->video_model->video_category_valid($video_category_id);
		if($res == 1) exit('1');
		exit('0');
	}
	//删除video category
	public function delete_video_category(){
		$video_category_id = intval($this->input->post('video_category_id'));
		if($video_category_id < 1) exit('0');
		//执行数据库删除
		$this->video_model->delete_video_category($video_category_id);
		exit('1');
	}
	
	/////////////////////////video////////////////////////////	
	//每个分类下的视频管理
	public function video($category_id=0){
		//分类参数  -1 = 无分类  0=全部  其他=分类ID
		$category_id = intval($category_id);
		if($category_id < -1) $category_id = 0;
		$this->info['category_id'] = $category_id;
		
		//获取列表
		$video_list = $this->video_model->get_video_list($category_id);
		$total = count($video_list);
		$total_valid = 0;
		if($video_list){
			foreach($video_list as $k=>$v){
				//处理时间
				$video_list[$k]['ct'] = date("Y-m-d",$v['ct']).'<br>'.date("H:i:s",$v['ct']);
				//有效
				if($v['valid'] == 1) $total_valid++;
				//处理图片
				$video_list[$k]['video_img'] =
				$this->path->get_url($v['video_img'],'video_img',$v['video_id']);
			}
		}
		$this->info['video_list'] = $video_list;
		$this->info['total'] = $total;
		$this->info['total_valid'] = $total_valid;
		//获取s默认图片
		$this->info['default_video_img'] = $this->path->get_default('video_img');
		//获取分类
		$this->info['video_category_list'] = $this->video_model->get_video_category_list();
		$this->v();
	}


	//video详情
	public function edit_video($video_id = 0){
		//获取ID
		$this->info['video_id'] = intval($video_id);
		//获取video详情
		$video_info = $this->video_model->get_video_by_id($video_id);
		if(!$video_info) redirect('mng_video');//如果没有信息,跳转到列表
	
		//获取图片
		$video_info['video_img'] =
		$this->path->get_url($video_info['video_img'],'video_img',$video_id);
		$this->info['video'] = $video_info;
		$this->info['default_module_img'] = $this->path->get_default('module_img');
		//获取内容模块
		$module = $video_info['video_module'];
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
		$this->info['video_module'] = json_decode($video_info['video_module'],true);
		$this->v();
	}
	//创建video
	public function save_video(){
		//接收参数
		$op = $this->input->post('op');
		$video_id = intval($this->input->post('video_id'));
		$video_title = trim($this->input->post('video_title'));
		//分类
		$video_category_id = intval($this->input->post('video_category_id'));
		if($video_category_id <= 0) $video_category_id = 0;
	
		//控制排序
		$sort = intval($this->input->post('sort'));
		if($sort <= consts::MIN_SORT) $sort = consts::MIN_SORT;
		else if($sort >= consts::MAX_SORT) $sort = consts::MAX_SORT;
	
		//图片控制
		$video_img = trim($this->input->post('video_img'));
		$video_img_change = intval($this->input->post('video_img_change'));
	
		//错误
		if($op != CREATE && $op != UPDATE) exit('0');
		if($op == UPDATE && $video_id < 1) exit('0');
		//表单验证
		//获取表单错误文言配置
		//$form_error_msg = $this->form_error_msg();
		$form_error = array();
		//标题
		if(!$video_title){
			$form_error['video_title'.FORM_ERROR_TAIL] = '请输入标题';
		}
		//处理图片
		if($op == CREATE || ($op == UPDATE && $video_img_change == 1)){
			if(!$video_img){
				$form_error['video_img'.FORM_ERROR_TAIL] = '请上传图片';
			}else{
				$video_img = basename($video_img);//提取文件名
				//检查tmp文件夹中此文件是否存在
				$video_img_tmp_path = $this->path->admin_path($this->info['admin']['admin_id']).$video_img;
				if(!$this->files->is_f($video_img_tmp_path)){
					$form_error['video_img'.FORM_ERROR_TAIL] = '请重新上传图片';
				}
			}
		}
		//表单验证失败，返回错误项
		if($form_error) exit(FORM_ERROR_PRE.json_encode($form_error));
		//数据库操作
		$form = array();
		$form['video_title'] = $video_title;
		$form['video_category_id'] = $video_category_id;
		$form['sort'] = $sort;
		if($op == CREATE){
			//图片文件名称
			$form['video_img'] = basename($video_img);
			$form['ct'] = time();
			$form['cer'] = $this->info['admin']['admin_id'];
			$res = $this->video_model->create_video($form);
		}else{
			if($video_img_change == 1){
				//图片文件名称
				$form['video_img'] = basename($video_img);
			}
			$form['ut'] = time();
			$form['uer'] = $this->info['admin']['admin_id'];
			$res = $this->video_model->update_video($form,$video_id);
		}
		if($res < 1)exit('0');
		//处理图片
		if($op == CREATE)$video_id = $res;
		//保存成功操作文件
		if($op == CREATE || ($op == UPDATE && $video_img_change == 1)){
			$path = $this->path->get_path('video_img',$video_id);
			if($op == UPDATE)$this->files->del_d($path);//更新时先清除旧文件夹
			$this->files->make_d($path);//创建文件夹
			$this->files->copy_f($video_img_tmp_path,$path.$form['video_img']);//移动文件
		}
		$this->files->del_d($this->path->admin_path($this->info['admin']['admin_id']));//清理临时文件夹
		exit('1');
	}
	//删除video
	public function delete_video(){
		$video_id = intval($this->input->post('video_id'));
		if($video_id < 1) exit('0');
		//执行数据库删除
		$this->video_model->delete_video($video_id);
		//执行文件删除
		$path = $this->path->get_path('video_img',$video_id);
		$this->files->del_d($path);
		exit('1');
	}
	//修改video 有效性
	public function video_valid(){
		$video_id = intval($this->input->post('video_id'));
		if($video_id < 1) exit('0');
		$res = $this->video_model->video_valid($video_id);
		if($res == 1) exit('1');
		exit('0');
	}
	
}