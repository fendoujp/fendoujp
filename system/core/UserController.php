<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 2015-08-13
 * MyDivine
 * 
 */

//用户端控制器基类
class UC extends CI_Controller {
	
	//用户session信息
	var $user = array();
	
	public function __construct(){
		parent::__construct();		
		
		//用户信息
		$this->user = @$_SESSION[SESSION_NAME.'user'];
		if($this->user){
			//刷新SESSION
			$_SESSION[SESSION_NAME.'user'] = $this->user;
		}
		
		$this->load_setting();
		$this->load_nav();
		$this->load_video_menu();
	}
	//尝试加载视频模块的导航
	private function load_video_menu(){
		$this->load->model('video_model');
		$this->info['video_setting'] = $this->video_model->get_setting();
		//如果开启了视频模式.这里查询分类列表
		if($this->info['video_setting']['valid'] == 1){
			$this->info['video_category_list'] = $this->video_model->get_video_category_list(true);
		}else{
			$this->info['video_category_list'] = array();
		}
	}
	
	//加载页首
	private function load_setting(){
		$this->load->model('setting_model');
		//页首
		$this->info['head'] = $this->setting_model->get_head();
		$this->info['head']['head_logo'] = $this->path->get_url($this->info['head']['head_logo'],'head_logo');
		//计算倒计时
		$now = strtotime(date("Y-m-d 00:00:00",time()));//今天0点时间
		$cd1 = $this->info['head']['head_cd_time1'];//倒计时日前的时间戳
		$day1 = ($cd1-$now)/(3600*24) < 1 ? 0 : ($cd1-$now)/(3600*24);
		$this->info['head']['head_cd_time1'] = $day1;
		$cd2 = $this->info['head']['head_cd_time2'];//倒计时日前的时间戳
		$day2 = ($cd2-$now)/(3600*24) < 1 ? 0 : ($cd2-$now)/(3600*24);
		$this->info['head']['head_cd_time2'] = $day2;
		
		//seo
		$this->info['seo'] = $this->setting_model->get_seo();
		//页脚
		$this->info['foot'] = $this->setting_model->get_foot();
		$this->info['foot']['foot_logo'] = $this->path->get_url($this->info['foot']['foot_logo'],'foot_logo');
		$this->info['foot']['foot_pt_img1'] = $this->path->get_url($this->info['foot']['foot_pt_img1'],'foot_pt_img1');
		$this->info['foot']['foot_pt_img2'] = $this->path->get_url($this->info['foot']['foot_pt_img2'],'foot_pt_img2');
		//转义页脚内容
		//处理内容转义
		$trans_rule = consts::get_trans_rule();//内容转义基础变量
		//执行转义
		$this->info['foot']['foot_intro'] = func::trans($this->info['foot']['foot_intro'],$trans_rule);
		$this->info['foot']['foot_contact'] = func::trans($this->info['foot']['foot_contact'],$trans_rule);
		//link
		$this->info['link'] = $this->setting_model->get_link();
	}
		
	//加载导航方法
	private function load_nav(){
		//加载 nav
		$this->load->model('nav_model');
		$menu = $this->nav_model->get_menu_list();
		$nav = $this->nav_model->get_nav_list();
		foreach($menu as $k=>$v){
			$menu[$k]['nav'] = array();
			foreach($nav as $k2=>$v2){
				if($v2['nav_menu_id'] == $v['menu_id']){
					$menu[$k]['nav'][] = $v2;
				}
			}
		}
		$this->info['menu'] = $menu;
		//如果固定模块的导航
		$const_nav = consts::get_const_nav();
		$this->info['const_nav'] = $const_nav;
		//确认导航高亮---------------start-----------------
		$high_light_menu = 0;
		//如果是普通的导航内容
		if($this->info['route']['con'] == 'nav'){
			//获取第三个参数
			$id = @intval($this->uri->segments[3]);
			if($id > 1){
				//循环尝试获取当前高亮的导航
				foreach($nav as $k=>$v){
					if($v['nav_id'] == $id){
						$high_light_menu = $v['nav_menu_id'];
						break;
					}
				}
			}
		}else{
			$const_nav_flag = 0;//确定是哪个固定模块的flag(type)
			//循环确认当前的导航的type
			foreach($const_nav as $k=>$v){
				if($this->info['route']['con'] == $v['url']){
					$const_nav_flag = $k;
					break;
				}
			}
			//如果是特殊模块,循环查询哪个nav使用了特殊模块,并且设置high light menu id
			if($const_nav_flag > 0){
				foreach($nav as $k=>$v){
					if($v['nav_type'] == $const_nav_flag){
						$high_light_menu = $v['nav_menu_id'];
						break;
					}
				}
			}
		}
		$this->info['hight_light_menu'] = $high_light_menu;
		//确认导航高亮---------------end-----------------
	}
	
}
