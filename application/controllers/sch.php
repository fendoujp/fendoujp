<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 学校列表
 * MyDivine
 * 2016-09-15
 */

class Sch extends UC{
	
	//构造方法	
	public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
		$this->load->model('module_model');
		$this->load->model('school_model');
		//首页布局
		$this->info['layout'] = $this->home_model->get_layout();
		//如果首页布局中,这里不现实  直接跳转回到首页
		if($this->info['layout']['layout_school_category'] != 1) func::show_404();		
		//sidebar信息
		$this->info['sidebar'] = consts::get_side_bar();
		$this->info['sidebar']['sch']['select'] = true;
	}
	
	//分类列表
	public function index(){
		//获取分类list
		$category = $this->home_model->get_school_category_list(true);
		foreach($category as $k=>$v){
			$category[$k]['school_category_img'] = 
			$this->path->get_url($v['school_category_img'],'school_category_img',$v['school_category_id']);
		}
		$this->info['school_category_list'] = $category;
		//页面标题
		$this->info['page_title'] = $this->info['layout']['layout_school_category_title'];
		$this->info['page_sub_title'] = '学校分类列表';
		$this->v();
	}
	
	//分类下的学校列表
	public function cate($category_id = 0,$page = 0){
		$category_id = intval($category_id);
		$category_id = $category_id < 0 ? 0 : $category_id;
		//查询分类名称和是否启用
		$category = array();
		$category = $this->home_model->get_school_category_by_id($category_id);
		if(!$category || $category['valid'] != 1){
			redirect('sch');
		}else{
			$this->info['page_title'] = $category['school_category_name'];
			$this->info['page_sub_title'] = $category['school_category_content'];
		}
		//处理sidebar
		//获取分类list
		$category_list = $this->home_model->get_school_category_list(true);
		$this->info['sidebar'] = array();
		//返回全部分类
		$this->info['sidebar']['return'] = array('url'=>'sch','text'=>'全部学校','select'=>true);
		foreach($category_list as $k=>$v){
			$tmp = array('url'=>'sch/cate/'.$v['school_category_id'],
						'text'=>$v['school_category_name'],'select'=>false);
			if($v['school_category_id'] == $category_id){
				$tmp['select'] = true;
				$this->info['sidebar']['return']['select'] = false;
			}
			$this->info['sidebar'][] = $tmp;
		}		
		//获取总数
		$total = $this->school_model->get_school_count($category_id,true);
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
		$school_list = $this->school_model->get_school_list($category_id,true,$page,consts::PER_PAGE);
		if($school_list){
			foreach($school_list as $k=>$v){
				//处理时间
				$school_list[$k]['ct'] = date("Y-m-d",$v['ct']).'<br>'.date("H:i:s",$v['ct']);
				//处理图片
				$school_list[$k]['school_img'] =
				$this->path->get_url($v['school_img'],'school_img',$v['school_id']);				
			}
		}
		$this->info['school_list'] = $school_list;
		$this->info['total'] = $total;
		$this->v();
	}
	
	public function show($id = 0,$type=''){
		$school_id = intval($id);
		//获取ID
		$this->info['school_id'] = $school_id;
		//获取sch_SHARE详情
		$school_info = $this->school_model->get_school_by_id($school_id);
		if(@$school_info['valid'] != 1) $school_info = array();//修正有效
		if(!$school_info) func::show_404();//如果没有信息,跳转到列表
		$this->info['school'] = $school_info;
		//修正内容模块
		if($type != 'enrol' && $type != 'envmt') $type = 'intro';
		$this->info['type'] = $type;
		//sidebar
		$this->info['sidebar'] = array();		
		$this->info['sidebar']['intro'] = array('url'=>'sch/show/'.$id.'/intro','text'=>consts::SCH_INTRO,'select'=>false);
		$this->info['sidebar']['enrol'] = array('url'=>'sch/show/'.$id.'/enrol','text'=>consts::SCH_ENROL,'select'=>false);
		$this->info['sidebar']['envmt'] = array('url'=>'sch/show/'.$id.'/envmt','text'=>consts::SCH_ENVMT,'select'=>false);
		$this->info['sidebar'][$type]['select'] = true;
		//获取固定的sidebar信息
		$sidebar_consts = consts::get_side_bar();
		$this->info['sidebar']['sign'] = $sidebar_consts['sign'];
		//返回列表
		$this->info['sidebar']['return'] = array('url'=>'sch/cate/'.$school_info['school_category_id'],
										'text'=>'返回列表','select'=>false);
		//获取内容模块
		$module = $school_info['school_'.$type.'_module'];
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
		$this->info['school_module'] = json_decode($school_info['school_'.$type.'_module']);
		if(!$this->info['school_module']) $this->info['school_module'] = array();
		//获取上一篇和下一篇的内容ID
		$school_list = $this->school_model->get_school_list($school_info['school_category_id'],true);
		$pre_id = 0;
		$next_id = 0;
		foreach($school_list as $k=>$v){
			if($v['school_id'] == $school_id){
				$pre_id = @intval($school_list[$k-1]['school_id']);
				$next_id = @intval($school_list[$k+1]['school_id']);
			}
		}
		$this->info['pre_id'] = $pre_id;
		$this->info['next_id'] = $next_id;
		//return 按钮返回的位置  没有这个变量自动返回到同一个控制器下的INDEX方法
		$this->info['return'] = func::loc_url().'sch/cate/'.$school_info['school_category_id'];
		//顶部标题
		$this->info['page_title'] = $school_info['school_title'];
		$this->info['page_sub_title'] = $school_info['school_sub_title'];
		$this->v();
	}
	
	
}