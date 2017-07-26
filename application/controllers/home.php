<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 首页
 * MyDivine
 * 2015-08-13
 */

class Home extends UC{
	
	//构造方法	
	public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
	}
	
	public function index(){
		//首页布局
		$this->info['layout'] = $this->home_model->get_layout();
		//处理内容转义
		$trans_rule = consts::get_trans_rule();//内容转义基础变量
		//如果TOP BANNER显示,查询TOP BANNER列表
		$this->info['top_banner'] = array();
		if($this->info['layout']['layout_top_banner'] == 1){
			$this->info['top_banner'] = $this->home_model->get_top_banner_list();
			foreach($this->info['top_banner'] as $k=>$v){
				//如果是无效 直接跳过
				if($v['valid'] != 1){
					unset($this->info['top_banner'][$k]);
					continue;
				}
				//获取图片地址
				$this->info['top_banner'][$k]['top_banner_img'] =
				$this->path->get_url($v['top_banner_img'],'top_banner_img',$v['top_banner_id']);
				$tmp_trans_rule = $trans_rule;
				$tmp_trans_rule[] = array('from'=>'(ts+)','to'=>'<span>');
				$tmp_trans_rule[] = array('from'=>'(ts-)','to'=>'</span>');
				//执行转义
				$this->info['top_banner'][$k]['top_banner_big_content'] =
				func::trans($v['top_banner_big_content'],$tmp_trans_rule);
				//下面小字部分只能换行
				$this->info['top_banner'][$k]['top_banner_small_content'] =
				func::trans($v['top_banner_small_content'],$trans_rule);
			}
		}
		//如果TOP INTRO显示,查询TOP INTRO
		$this->info['top_intro'] = array();
		if($this->info['layout']['layout_top_intro'] == 1){
			$this->info['top_intro'] = $this->home_model->get_top_intro();
			//处理图片
			$this->info['top_intro']['top_intro_up_img'] = 
			$this->path->get_url($this->info['top_intro']['top_intro_up_img'],'top_intro_up_img');
			$this->info['top_intro']['top_intro_down_img'] =
			$this->path->get_url($this->info['top_intro']['top_intro_down_img'],'top_intro_down_img');
			//这里,在Windows下面特殊处理一下.在linux系统可以去掉下面
			$this->info['top_intro']['top_intro_down_img'] = str_replace('\\','/',$this->info['top_intro']['top_intro_down_img']);
			//处理转义
			//左上标题
			$tmp_trans_rule = $trans_rule;
			$tmp_trans_rule[] = array('from'=>'(ts+)','to'=>'<strong>');
			$tmp_trans_rule[] = array('from'=>'(ts-)','to'=>'</strong>');
			$this->info['top_intro']['top_intro_up1'] =
			func::trans($this->info['top_intro']['top_intro_up1'],$tmp_trans_rule);
			//左下  无特殊字体
			$this->info['top_intro']['top_intro_up2'] =
			func::trans($this->info['top_intro']['top_intro_up2'],$trans_rule);
			//右   //有特殊字体
			$this->info['top_intro']['top_intro_up3'] =
			func::trans($this->info['top_intro']['top_intro_up3'],$tmp_trans_rule);
			//下半部左侧
			$this->info['top_intro']['top_intro_down1'] =
			func::trans($this->info['top_intro']['top_intro_down1'],$tmp_trans_rule);
			//下半部右侧
			$this->info['top_intro']['top_intro_down2'] =
			func::trans($this->info['top_intro']['top_intro_down2'],$trans_rule);
			//将下面数字动画转为数组
			$this->info['top_intro']['top_intro_ani'] = json_decode($this->info['top_intro']['top_intro_ani'],true);
		}
		
		//TOP SCHOOL CATEGORY
		$this->info['school_category'] = array();
		if($this->info['layout']['layout_school_category'] == 1){
			$this->info['school_category'] = $this->home_model->get_school_category_list();
			foreach($this->info['school_category'] as $k=>$v){
				//如果是无效 直接跳过
				if($v['valid'] != 1){
					unset($this->info['school_category'][$k]);
					continue;
				}
				//获取图片地址
				$this->info['school_category'][$k]['school_category_img'] =
				$this->path->get_url($v['school_category_img'],'school_category_img',$v['school_category_id']);
				$this->info['school_category'][$k]['school_category_cover_img'] =
				$this->path->get_url($v['school_category_cover_img'],'school_category_cover_img',$v['school_category_id']);
				//转义文字
				$this->info['school_category'][$k]['school_category_name'] =
				func::trans($v['school_category_name'],$trans_rule);
				$this->info['school_category'][$k]['school_category_content'] =
				func::trans($v['school_category_content'],$trans_rule);
			}
		}
		
		
		//APPLY INTRO
		$this->info['apply_intro'] = array();
		if($this->info['layout']['layout_apply_intro'] == 1){
			$this->info['apply_intro'] = $this->home_model->get_apply_intro();		
			//处理转义  这里都只有普通转义
			$this->info['apply_intro']['apply_intro_name'] =
			func::trans($this->info['apply_intro']['apply_intro_name'],$trans_rule);
			$this->info['apply_intro']['apply_intro_content'] =
			func::trans($this->info['apply_intro']['apply_intro_content'],$trans_rule);
			//获取图片地址
			$this->info['apply_intro']['apply_intro_img'] =
			$this->path->get_url($this->info['apply_intro']['apply_intro_img'],'apply_intro_img');
		}
		
		//APPLY CONDITION
		$this->info['apply_condition'] = array();
		if($this->info['layout']['layout_apply_condition'] == 1){
			$this->info['apply_condition'] = $this->home_model->get_apply_condition();
			//处理转义  这里都只有普通转义
			$this->info['apply_condition']['apply_condition_name'] =
			func::trans($this->info['apply_condition']['apply_condition_name'],$trans_rule);
			$this->info['apply_condition']['apply_condition_content'] =
			func::trans($this->info['apply_condition']['apply_condition_content'],$trans_rule);
			$this->info['apply_condition']['apply_condition_button'] =
			func::trans($this->info['apply_condition']['apply_condition_button'],$trans_rule);
		}
		
		//EXP SHARE
		$this->info['exp_share'] = array();
		if($this->info['layout']['layout_exp_share'] == 1){
			$this->info['exp_share'] = $this->home_model->get_exp_share_list();
			foreach($this->info['exp_share'] as $k=>$v){
				//如果是无效 直接跳过
				if($v['valid'] != 1){
					unset($this->info['exp_share'][$k]);
					continue;
				}
				//转义文字
				$this->info['exp_share'][$k]['exp_share_name'] =
				func::trans($v['exp_share_name'],$trans_rule);
				$this->info['exp_share'][$k]['exp_share_content'] =
				func::trans($v['exp_share_content'],$trans_rule);
				$this->info['exp_share'][$k]['exp_share_note'] =
				func::trans($v['exp_share_note'],$trans_rule);
			}
		}
		
		//ARTICLE CATEGORY
		$this->info['article_category'] = array();
		if($this->info['layout']['layout_article_category'] == 1){
			$this->info['article_category'] = $this->home_model->get_article_category_list();
			foreach($this->info['article_category'] as $k=>$v){
				//如果是无效 直接跳过
				if($v['valid'] != 1){
					unset($this->info['article_category'][$k]);
					continue;
				}
				//获取图片地址
				$this->info['article_category'][$k]['article_category_img'] =
				$this->path->get_url($v['article_category_img'],'article_category_img',$v['article_category_id']);
				//转义文字
				$this->info['article_category'][$k]['article_category_name'] =
				func::trans($v['article_category_name'],$trans_rule);
				$this->info['article_category'][$k]['article_category_content'] =
				func::trans($v['article_category_content'],$trans_rule);
			}
		}
		
		//BTM ADVERT
		$this->info['btm_advert'] = array();
		if($this->info['layout']['layout_btm_advert'] == 1){
			$this->info['btm_advert'] = $this->home_model->get_btm_advert_list();
			foreach($this->info['btm_advert'] as $k=>$v){
				//如果是无效 直接跳过
				if($v['valid'] != 1){
					unset($this->info['btm_advert'][$k]);
					continue;
				}
				//获取图片地址
				$this->info['btm_advert'][$k]['btm_advert_img'] =
				$this->path->get_url($v['btm_advert_img'],'btm_advert_img',$v['btm_advert_id']);
				//转义文字
				$this->info['btm_advert'][$k]['btm_advert_name'] =
				func::trans($v['btm_advert_name'],$trans_rule);
				$this->info['btm_advert'][$k]['btm_advert_content'] =
				func::trans($v['btm_advert_content'],$trans_rule);
			}
		}
		/* 这里先停用
		//BTM MARQUEE
		$this->info['btm_marquee'] = array();
		if($this->info['layout']['layout_btm_marquee'] == 1){
			$this->info['btm_marquee'] = $this->home_model->get_btm_marquee_list();
			foreach($this->info['btm_marquee'] as $k=>$v){
				//如果是无效 直接跳过
				if($v['valid'] != 1){
					unset($this->info['btm_marquee'][$k]);
					continue;
				}
				//获取图片地址
				$this->info['btm_marquee'][$k]['btm_marquee_img'] =
				$this->path->get_url($v['btm_marquee_img'],'btm_marquee_img',$v['btm_marquee_id']);
			}
		}
		*/
		//2017-01-13底部滚动条暂时显示未分类学校的列表
		$this->info['btm_school'] = array();
		$this->load->model('school_model');
		if($this->info['layout']['layout_btm_marquee'] == 1){
			$this->info['btm_school'] = $this->school_model->get_school_list(-1,true,1,100);
			foreach($this->info['btm_school'] as $k=>$v){
				//获取图片地址
				$this->info['btm_school'][$k]['school_img'] =
				$this->path->get_url($v['school_img'],'school_img',$v['school_id']);
			}
		}
		$this->v();
	}
}
	