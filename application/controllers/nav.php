<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 学校列表
 * MyDivine
 * 2016-09-15
 */

class Nav extends UC{
	
	//构造方法	
	public function __construct(){
		parent::__construct();
		$this->load->model('nav_model');
		$this->load->model('module_model');
	}
	
	//分类列表
	public function index($id = 0){
				
		$nav_id = intval($id);
		//获取nav详情
		$nav_info = $this->nav_model->get_nav_by_id($nav_id);
		if(!$nav_info) func::show_404();
		$this->info['nav'] = $nav_info;
		
		//获取sidebar
		$menu = $this->nav_model->get_nav_list_by_menu_id($nav_info['nav_menu_id']);
		$const_nav = consts::get_const_nav();//获取固定模块
		$sidebar = array();
		foreach($menu as $k=>$v){
			$tmp = array();
			if($v['nav_type'] == 0){
				$tmp['url'] = 'nav/index/'.$v['nav_id'];
			}else{
				$tmp['url'] = @$const_nav[$v['nav_type']]['url'];
			}
			$tmp['text'] = $v['nav_title'];
			$tmp['select'] = false;
			if($v['nav_id'] == $nav_id)$tmp['select'] = true;
			$sidebar[] = $tmp;
		}
		$this->info['sidebar'] = $sidebar;
		
		//获取内容模块
		$module = $nav_info['nav_module'];
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
		$this->info['nav_module'] = json_decode($nav_info['nav_module']);
		if(!$this->info['nav_module']) $this->info['nav_module'] = array();
		$this->v();
	}
	
}