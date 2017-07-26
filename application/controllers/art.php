<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 文章列表
 * MyDivine
 * 2016-09-15
 */

class Art extends UC{
	
	//构造方法	
	public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
		$this->load->model('module_model');
		$this->load->model('article_model');
		//首页布局
		$this->info['layout'] = $this->home_model->get_layout();
		//如果首页布局中,这里不现实  直接跳转回到首页
		if($this->info['layout']['layout_article_category'] != 1) func::show_404();	
		//获取分类list
		$category_list = $this->home_model->get_article_category_list(true);
		//sidebar信息		
		$this->info['sidebar'] = array();
		//返回全部分类
		$this->info['sidebar']['return'] = array('url'=>'art','text'=>'全部文章','select'=>true);
		foreach($category_list as $k=>$v){
			$tmp = array('url'=>'art/cate/'.$v['article_category_id'],
						'text'=>$v['article_category_name'],'select'=>false);
			$this->info['sidebar'][] = $tmp;
		}
		$this->category_list = $category_list;
	}
	
	//分类列表
	public function index(){
		//获取分类list
		$category = $this->category_list;
		foreach($category as $k=>$v){
			$category[$k]['article_category_img'] = 
			$this->path->get_url($v['article_category_img'],'article_category_img',$v['article_category_id']);
		}
		$this->info['article_category_list'] = $category;
		//页面标题
		$this->info['page_title'] = $this->info['layout']['layout_article_category_title'];
		$this->info['page_sub_title'] = '文章分类列表';
		$this->v();
	}
	
	//分类下的学校列表
	public function cate($category_id = 0,$page = 0){
		$category_id = intval($category_id);
		$category_id = $category_id < 0 ? 0 : $category_id;
		//查询分类名称和是否启用
		$category = array();
		$category = $this->home_model->get_article_category_by_id($category_id);
		if(!$category || $category['valid'] != 1){
			func::show_404();
		}else{
			$this->info['page_title'] = $category['article_category_name'];
			$this->info['page_sub_title'] = $category['article_category_content'];
		}
		//处理sidebar
		//获取分类list
		$category_list = $this->category_list;
		$this->info['sidebar'] = array();
		//返回全部分类
		$this->info['sidebar']['return'] = array('url'=>'art','text'=>'全部文章','select'=>true);
		foreach($category_list as $k=>$v){
			$tmp = array('url'=>'art/cate/'.$v['article_category_id'],
						'text'=>$v['article_category_name'],'select'=>false);
			if($v['article_category_id'] == $category_id){
				$tmp['select'] = true;
				$this->info['sidebar']['return']['select'] = false;
			}
			$this->info['sidebar'][] = $tmp;
		}
		//获取总数
		$total = $this->article_model->get_article_count($category_id,true);
		//页码修正
		$page = intval($page);
		$page = $page < 1 ? 1 : $page;
		$max_page = ceil($total/consts::LIST_PER_PAGE);
		if($page > $max_page) $page = $max_page;
		if($max_page < 1) $max_page = 1;
		$this->info['page'] = $page;
		$this->info['max_page'] = $max_page;
		$this->info['page_param'] = $category_id.'/';//额外的翻页参数		
		//获取列表
		$article_list = $this->article_model->get_article_list($category_id,true,$page,consts::LIST_PER_PAGE);
		if($article_list){
			foreach($article_list as $k=>$v){
				//处理时间
				$article_list[$k]['ct'] = date("Y-m-d",$v['ct']).'<br>'.date("H:i:s",$v['ct']);
				//处理图片
				$article_list[$k]['article_img'] =
				$this->path->get_url($v['article_img'],'article_img',$v['article_id']);				
			}
		}
		$this->info['article_list'] = $article_list;
		$this->info['total'] = $total;
		$this->v();
	}
	
	public function show($id = 0){
		$article_id = intval($id);
		//获取ID
		$this->info['article_id'] = $article_id;
		//获取art_SHARE详情
		$article_info = $this->article_model->get_article_by_id($article_id);
		if(@$article_info['valid'] != 1) $article_info = array();//修正有效
		if(!$article_info) func::show_404();//如果没有信息,跳转到列表
		$this->info['article'] = $article_info;
		//处理sidebar
		//确认所属分类
		$category_id = $article_info['article_category_id'];
		//获取分类list
		$category_list = $this->category_list;
		$this->info['sidebar'] = array();
		//返回全部分类
		$this->info['sidebar']['return'] = array('url'=>'art','text'=>'全部文章','select'=>true);
		foreach($category_list as $k=>$v){
			$tmp = array('url'=>'art/cate/'.$v['article_category_id'],
					'text'=>$v['article_category_name'],'select'=>false);
			if($v['article_category_id'] == $category_id){
				$tmp['select'] = true;
				$this->info['sidebar']['return']['select'] = false;
			}
			$this->info['sidebar'][] = $tmp;
		}
		//返回列表
		$this->info['sidebar']['return'] = array('url'=>'art/cate/'.$article_info['article_category_id'],
										'text'=>'返回列表','select'=>false);
		//获取内容模块
		$module = $article_info['article_module'];
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
		$this->info['article_module'] = json_decode($article_info['article_module']);
		if(!$this->info['article_module']) $this->info['article_module'] = array();
		//获取上一篇和下一篇的内容ID
		$article_list = $this->article_model->get_article_list($article_info['article_category_id'],true);
		$pre_id = 0;
		$next_id = 0;
		foreach($article_list as $k=>$v){
			if($v['article_id'] == $article_id){
				$pre_id = @intval($article_list[$k-1]['article_id']);
				$next_id = @intval($article_list[$k+1]['article_id']);
			}
		}
		$this->info['pre_id'] = $pre_id;
		$this->info['next_id'] = $next_id;
		//return 按钮返回的位置  没有这个变量自动返回到同一个控制器下的INDEX方法
		$this->info['return'] = func::loc_url().'art/cate/'.$article_info['article_category_id'];
		//顶部标题
		$this->info['page_title'] = $article_info['article_title'];
		$this->info['page_sub_title'] = $article_info['article_sub_title'];
		$this->v();
	}
	
	
}