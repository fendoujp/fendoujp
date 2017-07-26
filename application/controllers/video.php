<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 视频模块
 * MyDivine
 * 2016-09-30
 */

class Video extends UC{
	
	//构造方法	
	public function __construct(){
		parent::__construct();

		$this->load->model('module_model');
		$this->load->model('video_model');
		//布局和分类信息已经在 父类里面处理过了
		if($this->info['video_setting']['valid'] != 1) func::show_404();	
		
		//sidebar信息		
		$this->info['sidebar'] = array();
		//返回全部分类
		$category_list = $this->info['video_category_list'];//这里也是父类处理过的
		foreach($category_list as $k=>$v){
			$tmp = array('url'=>'video/index/'.$v['video_category_id'],
						'text'=>$v['video_category_title'],'select'=>false);
			$this->info['sidebar'][] = $tmp;
		}
	}
	
	//分类列表
	public function index($category_id = 0,$page = 0){
		//页面标题
		$this->info['page_title'] = $this->info['video_setting']['video_setting_page_title'];
		$this->info['page_sub_title'] = $this->info['video_setting']['video_setting_page_sub_title'];
		
		$category_id = intval($category_id);
		$category_id = $category_id < 0 ? 0 : $category_id;
		$category = array();
		//注:这里的分类是已经处理过的..无效的分类将不会出现在这里
		foreach($this->info['video_category_list'] as $k=>$v){
			//如果分类存在 且可用 直接调用
			if($v['video_category_id'] == $category_id){
				$category = $v;
				break;
			}
		}
		//如果ID不存在,就使用第一个分类
		if(!$category)$category = @$this->info['video_category_list'][0];
		if(!$category)func::show_404();//如果一个分类都没有 直接退出
		$category_id = $category['video_category_id'];//实际的分类ID
		//处理sidebar选中状态
		foreach($this->info['sidebar'] as $k=>$v){
			if($v['text'] == $category['video_category_title']){
				$this->info['sidebar'][$k]['select'] = true;
				break;
			}
		}
		
		$total = $this->video_model->get_video_count($category_id,true);
		//页码修正
		$page = intval($page);
		$page = $page < 1 ? 1 : $page;
		$max_page = ceil($total/consts::PER_PAGE);
		if($page > $max_page) $page = $max_page;
		if($max_page < 1) $max_page = 1;
		$this->info['page'] = $page;
		$this->info['max_page'] = $max_page;
		$this->info['page_param'] = $category_id.'/';//额外的翻页参数
		//获取列表
		$video_list = $this->video_model->get_video_list($category_id,true,$page,consts::PER_PAGE);
		if($video_list){
			foreach($video_list as $k=>$v){				
				//处理图片
				$video_list[$k]['video_img'] =
				$this->path->get_url($v['video_img'],'video_img',$v['video_id']);
				$video_list[$k]['ct'] = date(DATE_YMD,$v['ct']);
			}
		}
		$this->info['video_list'] = $video_list;
		$this->info['total'] = $total;
		$this->v();
	}
	
	public function show($id = 0){
		$video_id = intval($id);
		//获取ID
		$this->info['video_id'] = $video_id;
		//获取详情
		$video_info = $this->video_model->get_video_by_id($video_id);
		if(@$video_info['valid'] != 1) $video_info = array();//修正有效
		if(!$video_info) func::show_404();//如果没有信息,跳转到列表
		$this->info['video'] = $video_info;
		//处理sidebar
		//确认所属分类
		$category_id = $video_info['video_category_id'];
		//获取分类list
		$category_list = $this->info['video_category_list'];
		$this->info['sidebar'] = array();
		//返回全部分类
		foreach($category_list as $k=>$v){
			$tmp = array('url'=>'video/index/'.$v['video_category_id'],
					'text'=>$v['video_category_title'],'select'=>false);
			if($v['video_category_id'] == $category_id){
				$tmp['select'] = true;
				$this->info['sidebar']['return']['select'] = false;
			}
			$this->info['sidebar'][] = $tmp;
		}
		//返回列表
		$this->info['sidebar']['return'] = array('url'=>'video/index/'.$video_info['video_category_id'],
										'text'=>'返回列表','select'=>false);
		//获取内容模块
		$module = $video_info['video_module'];
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
		$this->info['video_module'] = json_decode($video_info['video_module']);
		if(!$this->info['video_module']) $this->info['video_module'] = array();
		//获取上一篇和下一篇的内容ID
		$video_list = $this->video_model->get_video_list($video_info['video_category_id'],true);
		$pre_id = 0;
		$next_id = 0;
		foreach($video_list as $k=>$v){
			if($v['video_id'] == $video_id){
				$pre_id = @intval($video_list[$k-1]['video_id']);
				$next_id = @intval($video_list[$k+1]['video_id']);
			}
		}
		$this->info['pre_id'] = $pre_id;
		$this->info['next_id'] = $next_id;
		//return 按钮返回的位置  没有这个变量自动返回到同一个控制器下的INDEX方法
		$this->info['return'] = func::loc_url().'video/index/'.$video_info['video_category_id'];
		//顶部标题
		$this->info['page_title'] = $this->info['video_setting']['video_setting_page_title'];
		$this->info['page_sub_title'] = $this->info['video_setting']['video_setting_page_sub_title'];
		$this->v();
	}
	
	
}