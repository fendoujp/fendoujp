<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 经验分享
 * MyDivine
 * 2016-09-15
 */

class Exp extends UC{
	
	//构造方法	
	public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
		$this->load->model('module_model');
		//首页布局
		$this->info['layout'] = $this->home_model->get_layout();
		//如果首页布局中,这里不现实  直接跳转回到首页
		if($this->info['layout']['layout_exp_share'] != 1) func::show_404();
		
		//sidebar信息
		$this->info['sidebar'] = consts::get_side_bar();
		unset($this->info['sidebar']['sign']);
		$this->info['sidebar']['exp']['select'] = true;
	}
	
	public function index($page = 0){
		
		$total = $this->home_model->get_exp_share_count(true);
		//页码修正
		$page = intval($page);
		$page = $page < 1 ? 1 : $page;
		$max_page = ceil($total/consts::LIST_PER_PAGE);
		if($max_page < 1) $max_page = 1;
		if($page > $max_page) $page = $max_page;		
		$this->info['page'] = $page;
		$this->info['max_page'] = $max_page;
		$this->info['page_param'] = '';//额外的翻页参数
		
		//获取列表
		$exp_share_list = $this->home_model->get_exp_share_list(true,$page,consts::LIST_PER_PAGE);
		if($exp_share_list){
			foreach($exp_share_list as $k=>$v){
				//处理时间
				$exp_share_list[$k]['ct'] = date("Y-m-d",$v['ct']).'<br>'.date("H:i:s",$v['ct']);
				/* 暂时不需要图片
				//处理图片
				$exp_share_list[$k]['exp_share_img'] =
				$this->path->get_url($v['exp_share_img'],'exp_share_img',$v['exp_share_id']);
				*/			
			}
		}
		$this->info['exp_share_list'] = $exp_share_list;
		$this->info['total'] = $total;		
		//$exp_share_list = $this->home_model->get_exp_share_list();
		
		//页面标题
		$this->info['page_title'] = $this->info['layout']['layout_exp_share_title'];
		$this->info['page_sub_title'] = '';
		
		$this->v();
	}
	
	public function show($id = 0){
		$exp_share_id = intval($id);
		//获取ID
		$this->info['exp_share_id'] = $exp_share_id;
		//获取EXP_SHARE详情
		$exp_share_info = $this->home_model->get_exp_share_by_id($exp_share_id);
		if(@$exp_share_info['valid'] != 1) $exp_share_info = array();//修正有效
		if(!$exp_share_info) func::show_404();//如果没有信息,跳转到列表
		$this->info['exp_share'] = $exp_share_info;
		//获取内容模块
		$module = $exp_share_info['exp_share_module'];
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
		$this->info['exp_share_module'] = json_decode($exp_share_info['exp_share_module']);
		if(!$this->info['exp_share_module']) $this->info['exp_share_module'] = array();
		//获取上一篇和下一篇的内容ID
		$exp_share_list = $this->home_model->get_exp_share_list(true);
		$pre_id = 0;
		$next_id = 0;
		foreach($exp_share_list as $k=>$v){
			if($v['exp_share_id'] == $exp_share_id){
				$pre_id = @intval($exp_share_list[$k-1]['exp_share_id']);
				$next_id = @intval($exp_share_list[$k+1]['exp_share_id']);
			}
		}
		$this->info['pre_id'] = $pre_id;
		$this->info['next_id'] = $next_id;
		//顶部标题
		$this->info['page_title'] = $exp_share_info['exp_share_note'];
		$this->info['page_sub_title'] = date("Y-m-d",$exp_share_info['ct']).'&nbsp;&nbsp;&nbsp;&nbsp;
										  FROM : '.$exp_share_info['exp_share_name'];
		$this->v();
	}
	
	
}