<?php

/*
 * 公共静态类 常量
 * MyDivine
 */

class consts{
	const MIN_SORT = 0;
	const MAX_SORT = 250;
	const PER_PAGE = 9;//图片列表页面每页9数据
	const LIST_PER_PAGE = 16;//文字列表页
	//手动换行转义规则
	public static function get_trans_rule(){
		return array(array('from'=>'(hh)','to'=>'<br />'),
					array('from'=>'(sj)','to'=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'));
	}
	//首页的模块
	public static function get_layout_module(){
		$m = array();
		$m[] = 'top_banner';
		$m[] = 'top_intro';
		$m[] = 'school_category';
		$m[] = 'apply_intro';
		$m[] = 'apply_condition';
		$m[] = 'exp_share';
		$m[] = 'article_category';
		$m[] = 'btm_advert';
		$m[] = 'btm_marquee';
		return $m;
	}
	//一些汉字
	const SCH_INTRO = '学校介绍';
	const SCH_ENROL = '招生介绍';
	const SCH_ENVMT = '环境介绍';
	const SCH_LIST = '学校列表';
	//默认sidebar数组
	public static function get_side_bar(){
		//sidebar信息
		$sidebar = array();		
		$sidebar['sch'] = array('url'=>'sch','text'=>'学校介绍','select'=>false);
		$sidebar['exp'] = array('url'=>'exp','text'=>'经验分享','select'=>false);
		$sidebar['intro'] = array('url'=>'intro','text'=>'申请流程','select'=>false);
		$sidebar['condi'] = array('url'=>'condi','text'=>'申请条件','select'=>false);
		$sidebar['sign'] = array('url'=>'sign','text'=>'报名申请','select'=>false);
		return $sidebar;
	}
	//腾讯视频播放器的式样
	const VIDEO_PLAYER_STYLE = 'z-index:1;width:75%;height:380px;border:0;';
	//导航中的5个固定模块
	public static function get_const_nav(){
		$nav = array();
		//( key = type)
		$nav[1] = array('url'=>'sch','text'=>'学校介绍');
		$nav[2] = array('url'=>'exp','text'=>'经验分享');
		$nav[3] = array('url'=>'intro','text'=>'申请流程');
		$nav[4] = array('url'=>'condi','text'=>'申请条件');
		$nav[5] = array('url'=>'art','text'=>'自由文章');
		$nav[6] = array('url'=>'contact','text'=>'联系我们');
		return $nav;
	}
	
	//性别
	public static function get_const_gender(){
		return array(
			array('value'=>1,'text'=>'男'),
			array('value'=>2,'text'=>'女')
		);
	}
	//申请者现状
	public static function get_const_apply_status(){
		return array(
				array('value'=>1,'text'=>'在校'),
				array('value'=>2,'text'=>'在职'),
				array('value'=>3,'text'=>'其他'),
		);
	}
	
	//是否来过日本
	public static function get_const_ever_come_japan(){
		return array(
				array('value'=>1,'text'=>'是'),
				array('value'=>2,'text'=>'否'),
		);
	}
	//是否学过日语
	public static function get_const_ever_learn_japanese(){
		return array(
				array('value'=>1,'text'=>'是'),
				array('value'=>2,'text'=>'否'),
		);
	}
	//是否考过日语
	public static function get_const_ever_test_japanese(){
		return array(
				array('value'=>1,'text'=>'是'),
				array('value'=>2,'text'=>'否'),
		);
	}
	//日语考试名称
	public static function get_const_test_japanese_name(){
		return array(
				array('value'=>1,'text'=>'JLPT考试'),
				array('value'=>2,'text'=>'J.TEST考试'),
				array('value'=>3,'text'=>'NAT考试'),
		);
	}
	//日语考试对应等级
	public static function get_const_test_japanese_level($test_name = 0){
		if($test_name == 1){
			return array(
					array('value'=>1,'text'=>'N1'),
					array('value'=>2,'text'=>'N2'),
					array('value'=>3,'text'=>'N3'),
					array('value'=>4,'text'=>'N4'),
					array('value'=>5,'text'=>'N5'),
			);
		}else if($test_name == 2){
			return array(
					array('value'=>1,'text'=>'A-Dレベル'),
					array('value'=>2,'text'=>'E-Fレベル'),
					array('value'=>3,'text'=>'ビジネス試験'),
			);
		}else if($test_name == 3){
			return array(
					array('value'=>1,'text'=>'1級'),
					array('value'=>2,'text'=>'2級'),
					array('value'=>3,'text'=>'3級'),
					array('value'=>4,'text'=>'4級'),
					array('value'=>5,'text'=>'5級'),
			);
		}
		return array();
	}
	
	//高中类型
	public static function get_const_highschool_type(){
		return array(
				array('value'=>1,'text'=>'普高(文科)'),
				array('value'=>2,'text'=>'普高(理科)'),
				array('value'=>3,'text'=>'职高'),
				array('value'=>4,'text'=>'中专'),
		);
	}
	public static function get_const_collage_type(){
		return array(
				array('value'=>1,'text'=>'专科'),
				array('value'=>2,'text'=>'本科'),
				array('value'=>3,'text'=>'硕士'),
				array('value'=>4,'text'=>'博士'),
		);
	}
	//是否有学位证
	public static function get_const_collage_license(){
		return array(
				array('value'=>1,'text'=>'是'),
				array('value'=>2,'text'=>'否'),
		);
	}
	
}