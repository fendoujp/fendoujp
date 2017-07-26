<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 申请流程
 * MyDivine
 * 2016-09-21
 */

class Intro extends UC{
	
	//构造方法	
	public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
		$this->load->model('module_model');
		$this->load->model('intro_model');
	}
	public function index(){
		redirect('intro/show');
	}
	
	//这里不存在翻页 直接show
	public function show($id = 0){
		//首页布局
		$this->info['layout'] = $this->home_model->get_layout();
		//如果首页布局中,这里不现实  直接跳转回到首页
		if($this->info['layout']['layout_apply_intro'] != 1) func::show_404();

		//获取申请流程标题
		$layout_apply_intro = $this->home_model->get_apply_intro();
		//顶部标题
		$this->info['page_title'] = $layout_apply_intro['apply_intro_name'];
		$this->info['page_sub_title'] = $layout_apply_intro['apply_intro_name'];
		
		$intro_id = intval($id);
		//获取intro详情
		$intro_info = $this->intro_model->get_intro_by_id($intro_id);
		if(@$intro_info['valid'] != 1) $intro_info = array();//修正有效
		//获取intro_列表
		$intro_list = $this->intro_model->get_intro_list(true);
		if(!$intro_info){
			//如果没有申请介绍 就取列表中的第一个
			$intro_info = @$intro_list[0];
			$intro_id = @$intro_info['intro_id'];	
		}
		//获取ID
		$this->info['intro_id'] = $intro_id;
		$this->info['intro'] = $intro_info;
		if(intval($intro_id) < 1) func::show_404();//如果一个文章都没有 跳转到首页
		
		//获取sidebar
		$sidebar = array();
		foreach($intro_list as $k=>$v){
			$tmp = array();
			$tmp['url'] = 'intro/show/'.$v['intro_id'];
			$tmp['text'] = $v['intro_title'];
			$tmp['select'] = false;
			if($v['intro_id'] == $intro_id)$tmp['select'] = true;
			$sidebar[] = $tmp;
		}
		//获取固定的sidebar信息
		$sidebar_consts = consts::get_side_bar();
		//$sidebar[] = $sidebar_consts['condi'];
		//sidebar信息
		$this->info['sidebar'] = $sidebar;		
		
		//获取内容模块
		$module = $intro_info['intro_module'];
		if(!$module)$module = array();
		else{
			$module = $this->module_model->get_module_by_id_array(json_decode($module,true));
		}
		//根据模块种类 获取图片
		if($module){
			$module_tmp = array();//做一个新的数组 K=ID V=内容
			foreach($module as $k=>$v){
				if($v['module_type'] == 2){
					$v['module_img'] = 
					$this->path->get_url($v['module_img'],'module_img',$v['module_id']);
				}else{
					//处理内容转义
					$trans_rule = consts::get_trans_rule();//内容转义基础变量					
					$trans_rule[] = array('from'=>'(ts+)','to'=>'<strong>');
					$trans_rule[] = array('from'=>'(ts-)','to'=>'</strong>');
					//执行转义
					$v['module_content'] = func::trans($v['module_content'],$trans_rule);
				}
				$module_tmp[$v['module_id']] = $v;
			}
			$module = $module_tmp;	
		}
		//所有模块内容
		$this->info['module'] = $module;
		//布局
		$this->info['intro_module'] = json_decode($intro_info['intro_module']);
		if(!$this->info['intro_module']) $this->info['intro_module'] = array();
		//获取上一篇和下一篇的内容ID
		$pre_id = 0;
		$next_id = 0;
		foreach($intro_list as $k=>$v){
			if($v['intro_id'] == $intro_id){
				$pre_id = @intval($intro_list[$k-1]['intro_id']);
				$next_id = @intval($intro_list[$k+1]['intro_id']);
			}
		}
		$this->info['pre_id'] = $pre_id;
		$this->info['next_id'] = $next_id;
		$this->v();
	}
	
	
}