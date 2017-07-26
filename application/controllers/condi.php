<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 申请条件
 * MyDivine
 * 2016-09-21
 */

class condi extends UC{
	
	//构造方法	
	public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
		$this->load->model('module_model');
		$this->load->model('condi_model');
	}
	public function index(){
		redirect('condi/show');
	}
	
	//这里不存在翻页 直接show
	public function show($id = 0){
		//首页布局
		$this->info['layout'] = $this->home_model->get_layout();
		//如果首页布局中,这里不现实  直接跳转回到首页
		if($this->info['layout']['layout_apply_condition'] != 1) func::show_404();

		//获取申请流程标题
		$layout_apply_condi = $this->home_model->get_apply_condition();
		//顶部标题
		$this->info['page_title'] = $layout_apply_condi['apply_condition_name'];
		$this->info['page_sub_title'] = $layout_apply_condi['apply_condition_name'];
		
		$condi_id = intval($id);
		//获取condi详情
		$condi_info = $this->condi_model->get_condi_by_id($condi_id);
		if(@$condi_info['valid'] != 1) $condi_info = array();//修正有效
		//获取condi_列表
		$condi_list = $this->condi_model->get_condi_list(true);
		if(!$condi_info){
			//如果没有申请介绍 就取列表中的第一个
			$condi_info = @$condi_list[0];
			$condi_id = @$condi_info['condi_id'];	
		}	
		//获取ID
		$this->info['condi_id'] = $condi_id;
		$this->info['condi'] = $condi_info;
		if(intval($condi_id) < 1) func::show_404();//如果一个文章都没有 跳转到首页
		
		//获取sidebar
		$sidebar = array();
		foreach($condi_list as $k=>$v){
			$tmp = array();
			$tmp['url'] = 'condi/show/'.$v['condi_id'];
			$tmp['text'] = $v['condi_title'];
			$tmp['select'] = false;
			if($v['condi_id'] == $condi_id)$tmp['select'] = true;
			$sidebar[] = $tmp;
		}
		//获取固定的sidebar信息
		$sidebar_consts = consts::get_side_bar();
		//$sidebar[] = $sidebar_consts['intro'];
		//sidebar信息
		$this->info['sidebar'] = $sidebar;		
		
		//获取内容模块
		$module = $condi_info['condi_module'];
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
		$this->info['condi_module'] = json_decode($condi_info['condi_module']);
		if(!$this->info['condi_module']) $this->info['condi_module'] = array();
		//获取上一篇和下一篇的内容ID
		$pre_id = 0;
		$next_id = 0;
		foreach($condi_list as $k=>$v){
			if($v['condi_id'] == $condi_id){
				$pre_id = @intval($condi_list[$k-1]['condi_id']);
				$next_id = @intval($condi_list[$k+1]['condi_id']);
			}
		}
		$this->info['pre_id'] = $pre_id;
		$this->info['next_id'] = $next_id;
		$this->v();
	}
	
	
}