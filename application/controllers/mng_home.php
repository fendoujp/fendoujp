<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 管理端首页
 * MyDivine
 * 2016-09-06
 */
class Mng_home extends AC{
	//构造方法
	public function __construct(){
		parent::__construct();	
		
		$this->load->model('home_model');		
		//子菜单数组
		$this->menu_array = array();
		$this->menu_array['index'] = '首页总览';
		$this->menu_array['top_banner_list'] = '顶部广告';
		$this->menu_array['top_intro'] = '顶部介绍';
		$this->menu_array['school_category_list'] = '学校介绍';
		$this->menu_array['apply_intro'] = '申请流程';
		$this->menu_array['apply_condition'] = '申请条件';
		$this->menu_array['exp_share_list'] = '经验分享';
		$this->menu_array['article_category_list'] = '自由文章';
		$this->menu_array['btm_advert_list'] = '底部广告';
		$this->menu_array['btm_marquee_list'] = '滚动广告';
		
		//默认使用当前方法作为子菜单的选中方法
		//如果需要其他方法作为子菜单的选中方法，重新执行一下 更换最后的参数即可
		$this->info['submenu'] = 
		func::get_sub_menu($this->info['route'],$this->menu_array,$this->info['route']['fun']);
	}
	
	//首页
	public function index(){
		//首页布局
		$this->info['layout'] = $this->home_model->get_layout();
		//各个模块数量
		$count_array = array('top_banner',
							 'school_category',//学校分类数量是这张表
							 //'school',//学校数量
							 //'apply_intro_content', //申请流程   内容数量
				 			 //'apply_condition_content',//申请条件  内容数量
		                     'exp_share',
		                     'article_category',
							 //'article',//文章数量
		                     'btm_advert',
		                     'btm_marquee');
		foreach($count_array as $k=>$v){
			$this->info['count'][$v] = $this->home_model->get_count('tbl_'.$v);
		}
		//func::debug();
		$this->v();
	}
	//修改布局有效性
	public function layout_valid(){
		$layout = trim($this->input->post('layout'));
		//获取允许的模块
		$layout_module = consts::get_layout_module();
		//检查模块名是否正确
		if(!in_array($layout,$layout_module)) exit('0');
		$this->home_model->layout_valid($layout);
		exit('1');
	}
	//改变模块名称
	public function layout_title(){
		$title = trim($this->input->post('title'));
		$layout = trim($this->input->post('layout'));
		//检查模块名是否正确
		if(!in_array($layout,array('school_category','exp_share','article_category','btm_advert'))) exit('0');
		$this->home_model->layout_title($layout,$title);
		exit('1');
	}
	
	//顶部BANNER控制
	public function top_banner_list(){
		//获取列表
		$top_banner_list = $this->home_model->get_top_banner_list();
		$total = count($top_banner_list);
		$total_valid = 0;
		if($top_banner_list){
			foreach($top_banner_list as $k=>$v){
				//处理图片路径
				$top_banner_list[$k]['top_banner_img'] = 
				$this->path->get_url($v['top_banner_img'],'top_banner_img',$v['top_banner_id']);
				//处理时间
				$top_banner_list[$k]['ct'] = date("Y-m-d",$v['ct']).'<br>'.date("H:i:s",$v['ct']);
				//有效
				if($v['valid'] == 1) $total_valid++;
			}
		}
		$this->info['top_banner_list'] = $top_banner_list;
		$this->info['total'] = $total;
		$this->info['total_valid'] = $total_valid;
		//获取top banner 的默认图片
		$this->info['default_top_banner_img'] = $this->path->get_default('top_banner_img');
		$this->v();
	}
	//创建顶部banner
	public function save_top_banner(){
		//接收参数
		$op = $this->input->post('op');
		$top_banner_id = intval($this->input->post('top_banner_id'));
		$top_banner_big_content = trim($this->input->post('top_banner_big_content'));
		$top_banner_small_content = trim($this->input->post('top_banner_small_content'));
		//控制排序
		$sort = intval($this->input->post('sort'));
		if($sort <= consts::MIN_SORT) $sort = consts::MIN_SORT;
		else if($sort >= consts::MAX_SORT) $sort = consts::MAX_SORT;
		
		//图片控制
		$top_banner_img = trim($this->input->post('top_banner_img'));
		$top_banner_img_change = intval($this->input->post('top_banner_img_change'));
		//错误
		if($op != CREATE && $op != UPDATE) exit('0');
		if($op == UPDATE && $top_banner_id < 1) exit('0');
		//表单验证
		//获取表单错误文言配置
		//$form_error_msg = $this->form_error_msg();
		$form_error = array();
		//标题
		if(!$top_banner_big_content){
			$form_error['top_banner_big_content'.FORM_ERROR_TAIL] = '请输入主标题';
		}
		//内容
		if(!$top_banner_small_content){
			$form_error['top_banner_small_content'.FORM_ERROR_TAIL] = '请输入内容';
		}
		//处理图片
		if($op == CREATE || ($op == UPDATE && $top_banner_img_change == 1)){
			if(!$top_banner_img){
				$form_error['top_banner_img'.FORM_ERROR_TAIL] = '请上传图片';
			}else{
				$top_banner_img = basename($top_banner_img);//提取文件名
				//检查tmp文件夹中此文件是否存在
				$top_banner_img_tmp_path = $this->path->admin_path($this->info['admin']['admin_id']).$top_banner_img;
				if(!$this->files->is_f($top_banner_img_tmp_path)){
					$form_error['top_banner_img'.FORM_ERROR_TAIL] = '请重新上传图片';
				}
			}
		}
		//表单验证失败，返回错误项
		if($form_error) exit(FORM_ERROR_PRE.json_encode($form_error));
		//数据库操作
		$form = array();
		$form['top_banner_big_content'] = $top_banner_big_content;
		$form['top_banner_small_content'] = $top_banner_small_content;
		$form['sort'] = $sort;
		if($op == CREATE){
			//图片文件名称
			$form['top_banner_img'] = basename($top_banner_img);
			$form['ct'] = time();
			$form['cer'] = $this->info['admin']['admin_id'];
			$res = $this->home_model->create_top_banner($form);
		}else{
			if($top_banner_img_change == 1){
				//图片文件名称
				$form['top_banner_img'] = basename($top_banner_img);
			}
			$form['ut'] = time();
			$form['uer'] = $this->info['admin']['admin_id'];
			$res = $this->home_model->update_top_banner($form,$top_banner_id);
		}
		if($res < 1)exit('0');
		//处理图片
		if($op == CREATE)$top_banner_id = $res;
		//保存成功操作文件
		if($op == CREATE || ($op == UPDATE && $top_banner_img_change == 1)){
			$path = $this->path->get_path('top_banner_img',$top_banner_id);
			if($op == UPDATE)$this->files->del_d($path);//更新时先清除旧文件夹
			$this->files->make_d($path);//创建文件夹
			$this->files->copy_f($top_banner_img_tmp_path,$path.$form['top_banner_img']);//移动文件
		}
		$this->files->del_d($this->path->admin_path($this->info['admin']['admin_id']));//清理临时文件夹
		exit('1');
	}
	//删除top banner
	public function delete_top_banner(){
		$top_banner_id = intval($this->input->post('top_banner_id'));
		if($top_banner_id < 1) exit('0');
		//执行数据库删除
		$this->home_model->delete_top_banner($top_banner_id);
		//执行文件删除
		$path = $this->path->get_path('top_banner_img',$top_banner_id);
		$this->files->del_d($path);
		exit('1');
	}
	//修改top banner 有效性
	public function top_banner_valid(){
		$top_banner_id = intval($this->input->post('top_banner_id'));
		if($top_banner_id < 1) exit('0');
		$res = $this->home_model->top_banner_valid($top_banner_id);
		if($res == 1) exit('1');
		exit('0');
	}
	//顶部宣传部分
	public function top_intro(){
		$top_intro = $this->home_model->get_top_intro();
		//将顶部的介绍部分的数字动画部分的JASON转为数组
		if($top_intro['top_intro_ani']){
			$top_intro['ani'] = json_decode($top_intro['top_intro_ani'],true);
		}else{
			$top_intro['ani'] = array();
		}		
		//获取图片
		$top_intro['top_intro_up_img'] = 
		$this->path->get_url($top_intro['top_intro_up_img'],'top_intro_up_img');
		$top_intro['top_intro_down_img'] =
		$this->path->get_url($top_intro['top_intro_down_img'],'top_intro_down_img');
		//最后更新时间
		$top_intro['ut'] = date("Y-m-d H:i:s",$top_intro['ut']);
		$this->info['top_intro'] = $top_intro;
		$this->v();
	}
	//顶部宣传部分保存
	public function save_top_intro(){
		//接受参数
		$update = array();
		$update['top_intro_up1'] = trim($this->input->post('top_intro_up1'));
		$update['top_intro_up2'] = trim($this->input->post('top_intro_up2'));
		$update['top_intro_up3'] = trim($this->input->post('top_intro_up3'));
		$update['top_intro_up3_link'] = trim($this->input->post('top_intro_up3_link'));
		$update['top_intro_down1'] = trim($this->input->post('top_intro_down1'));
		$update['top_intro_down2'] = trim($this->input->post('top_intro_down2'));
		$top_intro_up_img = trim($this->input->post('top_intro_up_img'));
		$top_intro_up_img_change = intval($this->input->post('top_intro_up_img_change'));
		$top_intro_down_img = trim($this->input->post('top_intro_down_img'));
		$top_intro_down_img_change = intval($this->input->post('top_intro_down_img_change'));
		$ani = array();//动画部分
		for($i=0;$i<5;$i++){
			$ani['ani_'.$i.'_0'] = intval($this->input->post('ani_'.$i.'_0'));
			$ani['ani_'.$i.'_1'] = trim($this->input->post('ani_'.$i.'_1'));
			$ani['ani_'.$i.'_2'] = trim($this->input->post('ani_'.$i.'_2'));
		}
		$update['top_intro_ani'] = json_encode($ani);
		
		//错误处理
		$form_error = array();
		//处理图片
		if($top_intro_up_img_change == 1){
			$top_intro_up_img = basename($top_intro_up_img);//提取文件名
			//检查tmp文件夹中此文件是否存在
			$top_intro_up_img_tmp_path = $this->path->admin_path($this->info['admin']['admin_id']).$top_intro_up_img;
			if(!$this->files->is_f($top_intro_up_img_tmp_path)){
				$form_error['top_banner_img'.FORM_ERROR_TAIL] = '请重新上传图片';
			}
			//如果文件存在.更新
			$update['top_intro_up_img'] = $top_intro_up_img;
		}
		if($top_intro_down_img_change == 1){
			$top_intro_down_img = basename($top_intro_down_img);//提取文件名
			//检查tmp文件夹中此文件是否存在
			$top_intro_down_img_tmp_path = $this->path->admin_path($this->info['admin']['admin_id']).$top_intro_down_img;
			if(!$this->files->is_f($top_intro_down_img_tmp_path)){
				$form_error['top_banner_img'.FORM_ERROR_TAIL] = '请重新上传图片';
			}
			//如果文件存在.更新
			$update['top_intro_down_img'] = $top_intro_down_img;
		}		
		$update['ut'] = time();
		$update['uer'] = $this->info['admin']['admin_id'];		
		//表单验证失败，返回错误项
		if($form_error) exit(FORM_ERROR_PRE.json_encode($form_error));
		
		//提交更新
		$res = $this->home_model->update_top_intro($update);
		if(!$res) exit('0');//更新失败		
		//处理图片
		if($top_intro_up_img_change == 1){
			$path = $this->path->get_path('top_intro_up_img');
			$this->files->del_d($path);//更新时先清除旧文件夹
			$this->files->make_d($path);//创建文件夹
			$this->files->copy_f($top_intro_up_img_tmp_path,$path.$update['top_intro_up_img']);//移动文件
		}
		//处理图片
		if($top_intro_down_img_change == 1){
			$path = $this->path->get_path('top_intro_down_img');
			$this->files->del_d($path);//更新时先清除旧文件夹
			$this->files->make_d($path);//创建文件夹
			$this->files->copy_f($top_intro_down_img_tmp_path,$path.$update['top_intro_down_img']);//移动文件
		}		
		$this->files->del_d($this->path->admin_path($this->info['admin']['admin_id']));//清理临时文件夹
		exit('1');//成功并且返回
	}
	
	//合作学校
	public function school_category_list(){
		//获取列表
		$school_category_list = $this->home_model->get_school_category_list();
		$total = count($school_category_list);
		$total_valid = 0;
		if($school_category_list){
			foreach($school_category_list as $k=>$v){
				//处理图片路径
				$school_category_list[$k]['school_category_img'] =
				$this->path->get_url($v['school_category_img'],'school_category_img',$v['school_category_id']);
				$school_category_list[$k]['school_category_cover_img'] =
				$this->path->get_url($v['school_category_cover_img'],
									 'school_category_cover_img',$v['school_category_id']);
				//处理时间
				$school_category_list[$k]['ct'] = date("Y-m-d",$v['ct']).'<br>'.date("H:i:s",$v['ct']);
				//有效
				if($v['valid'] == 1) $total_valid++;
			}
		}
		$this->info['school_category_list'] = $school_category_list;
		$this->info['total'] = $total;
		$this->info['total_valid'] = $total_valid;
		//获取school_category 的默认图片
		$this->info['default_school_category_img'] = $this->path->get_default('school_category_img');
		$this->v();
	}
	//创建学校介绍分类
	public function save_school_category(){
		//接收参数
		$op = $this->input->post('op');
		$school_category_id = intval($this->input->post('school_category_id'));
		$school_category_name = trim($this->input->post('school_category_name'));
		$school_category_content = trim($this->input->post('school_category_content'));
		//控制排序
		$sort = intval($this->input->post('sort'));
		if($sort <= consts::MIN_SORT) $sort = consts::MIN_SORT;
		else if($sort >= consts::MAX_SORT) $sort = consts::MAX_SORT;
	
		//图片控制
		$school_category_img = trim($this->input->post('school_category_img'));
		$school_category_img_change = intval($this->input->post('school_category_img_change'));
		$school_category_cover_img = trim($this->input->post('school_category_cover_img'));
		$school_category_cover_img_change = intval($this->input->post('school_category_cover_img_change'));
		//错误
		if($op != CREATE && $op != UPDATE) exit('0');
		if($op == UPDATE && $school_category_id < 1) exit('0');
		//表单验证
		//获取表单错误文言配置
		//$form_error_msg = $this->form_error_msg();
		$form_error = array();
		//标题
		if(!$school_category_name){
			$form_error['school_category_name'.FORM_ERROR_TAIL] = '请输入主标题';
		}
		//内容
		if(!$school_category_content){
			$form_error['school_category_content'.FORM_ERROR_TAIL] = '请输入内容';
		}
		//处理图片
		if($op == CREATE || ($op == UPDATE && $school_category_img_change == 1)){
			if(!$school_category_img){
				$form_error['school_category_img'.FORM_ERROR_TAIL] = '请上传图片';
			}else{
				$school_category_img = basename($school_category_img);//提取文件名
				//检查tmp文件夹中此文件是否存在
				$school_category_img_tmp_path = $this->path->admin_path($this->info['admin']['admin_id']).$school_category_img;
				if(!$this->files->is_f($school_category_img_tmp_path)){
					$form_error['school_category_img'.FORM_ERROR_TAIL] = '请重新上传图片';
				}
			}
		}
		if($op == CREATE || ($op == UPDATE && $school_category_cover_img_change == 1)){
			if(!$school_category_cover_img){
				$form_error['school_category_cover_img'.FORM_ERROR_TAIL] = '请上传图片(鼠标效果)';
			}else{
				$school_category_cover_img = basename($school_category_cover_img);//提取文件名
				//检查tmp文件夹中此文件是否存在
				$school_category_cover_img_tmp_path = $this->path->admin_path($this->info['admin']['admin_id']).$school_category_cover_img;
				if(!$this->files->is_f($school_category_cover_img_tmp_path)){
					$form_error['school_category_cover_img'.FORM_ERROR_TAIL] = '请重新上传图片(鼠标效果)';
				}
			}
		}
		
		//表单验证失败，返回错误项
		if($form_error) exit(FORM_ERROR_PRE.json_encode($form_error));
		//数据库操作
		$form = array();
		$form['school_category_name'] = $school_category_name;
		$form['school_category_content'] = $school_category_content;
		$form['sort'] = $sort;
		if($op == CREATE){
			//图片文件名称
			$form['school_category_img'] = basename($school_category_img);
			$form['school_category_cover_img'] = basename($school_category_cover_img);
			$form['ct'] = time();
			$form['cer'] = $this->info['admin']['admin_id'];
			$res = $this->home_model->create_school_category($form);
		}else{
			if($school_category_img_change == 1){
				//图片文件名称
				$form['school_category_img'] = basename($school_category_img);
			}
			if($school_category_cover_img_change == 1){
				//图片文件名称
				$form['school_category_cover_img'] = basename($school_category_cover_img);
			}
			$form['ut'] = time();
			$form['uer'] = $this->info['admin']['admin_id'];
			$res = $this->home_model->update_school_category($form,$school_category_id);
		}
		if($res < 1)exit('0');
		//处理图片
		if($op == CREATE)$school_category_id = $res;
		//保存成功操作文件
		if($op == CREATE || ($op == UPDATE && $school_category_img_change == 1)){
			$path = $this->path->get_path('school_category_img',$school_category_id);
			if($op == UPDATE)$this->files->del_d($path);//更新时先清除旧文件夹
			$this->files->make_d($path);//创建文件夹
			$this->files->copy_f($school_category_img_tmp_path,$path.$form['school_category_img']);//移动文件
		}
		if($op == CREATE || ($op == UPDATE && $school_category_cover_img_change == 1)){
			$path = $this->path->get_path('school_category_cover_img',$school_category_id);
			if($op == UPDATE)$this->files->del_d($path);//更新时先清除旧文件夹
			$this->files->make_d($path);//创建文件夹
			$this->files->copy_f($school_category_cover_img_tmp_path,$path.$form['school_category_cover_img']);//移动文件
		}
		$this->files->del_d($this->path->admin_path($this->info['admin']['admin_id']));//清理临时文件夹
		exit('1');
	}
	//删除school category
	public function delete_school_category(){
		$school_category_id = intval($this->input->post('school_category_id'));
		if($school_category_id < 1) exit('0');
		//执行数据库删除
		$this->home_model->delete_school_category($school_category_id);
		//执行文件删除
		$path = $this->path->get_path('school_category_img',$school_category_id);
		$this->files->del_d($path);
		exit('1');
	}
	//修改school category 有效性
	public function school_category_valid(){
		$school_category_id = intval($this->input->post('school_category_id'));
		if($school_category_id < 1) exit('0');
		$res = $this->home_model->school_category_valid($school_category_id);
		if($res == 1) exit('1');
		exit('0');
	}
	
	//申请流程介绍
	public function apply_intro(){
		$apply_intro = $this->home_model->get_apply_intro();
		//获取图片
		$apply_intro['apply_intro_img'] =
		$this->path->get_url($apply_intro['apply_intro_img'],'apply_intro_img');
		//最后更新时间
		$apply_intro['ut'] = date("Y-m-d H:i:s",$apply_intro['ut']);
		$this->info['apply_intro'] = $apply_intro;
		$this->v();
	}
	//申请流程保存
	public function save_apply_intro(){
		//接受参数
		$update = array();
		$update['apply_intro_name'] = trim($this->input->post('apply_intro_name'));
		$update['apply_intro_content'] = trim($this->input->post('apply_intro_content'));
		$apply_intro_img = trim($this->input->post('apply_intro_img'));
		$apply_intro_img_change = intval($this->input->post('apply_intro_img_change'));
		//错误处理
		$form_error = array();
		//处理图片
		if($apply_intro_img_change == 1){
			$apply_intro_img = basename($apply_intro_img);//提取文件名
			//检查tmp文件夹中此文件是否存在
			$apply_intro_img_tmp_path = $this->path->admin_path($this->info['admin']['admin_id']).$apply_intro_img;
			if(!$this->files->is_f($apply_intro_img_tmp_path)){
				$form_error['top_banner_img'.FORM_ERROR_TAIL] = '请重新上传图片';
			}
			//如果文件存在.更新
			$update['apply_intro_img'] = $apply_intro_img;
		}
				
		$update['ut'] = time();
		$update['uer'] = $this->info['admin']['admin_id'];
		//表单验证失败，返回错误项
		if($form_error) exit(FORM_ERROR_PRE.json_encode($form_error));
	
		//提交更新
		$res = $this->home_model->update_apply_intro($update);
		if(!$res) exit('0');//更新失败
		//处理图片
		if($apply_intro_img_change == 1){
			$path = $this->path->get_path('apply_intro_img');
			$this->files->del_d($path);//更新时先清除旧文件夹
			$this->files->make_d($path);//创建文件夹
			$this->files->copy_f($apply_intro_img_tmp_path,$path.$update['apply_intro_img']);//移动文件
			$this->files->del_d($this->path->admin_path($this->info['admin']['admin_id']));//清理临时文件夹
		}		
		exit('1');//成功并且返回
	}
	
	//申请要求 介绍
	public function apply_condition(){
		$apply_condition = $this->home_model->get_apply_condition();
		//最后更新时间
		$apply_condition['ut'] = date("Y-m-d H:i:s",$apply_condition['ut']);
		$this->info['apply_condition'] = $apply_condition;
		$this->v();
	}
	//申请要求 保存
	public function save_apply_condition(){
		//接受参数
		$update = array();
		$update['apply_condition_name'] = trim($this->input->post('apply_condition_name'));
		$update['apply_condition_content'] = trim($this->input->post('apply_condition_content'));
		$update['apply_condition_button'] = trim($this->input->post('apply_condition_button'));		
		//错误处理
		$form_error = array();
		if(!$update['apply_condition_name']){
			$form_error['apply_condition_name'.FORM_ERROR_TAIL] = '请输入左侧标题';
		}
		if(!$update['apply_condition_button']){
			$form_error['apply_condition_button'.FORM_ERROR_TAIL] = '请输入右侧按钮中的文字';
		}
			
		$update['ut'] = time();
		$update['uer'] = $this->info['admin']['admin_id'];
		//表单验证失败，返回错误项
		if($form_error) exit(FORM_ERROR_PRE.json_encode($form_error));	
		//提交更新
		$res = $this->home_model->update_apply_condition($update);
		if(!$res) exit('0');//更新失败
		exit('1');//成功并且返回
	}
	
	//EXP_SHARE控制
	public function exp_share_list(){
		//获取列表
		$exp_share_list = $this->home_model->get_exp_share_list();
		$total = count($exp_share_list);
		$total_valid = 0;
		if($exp_share_list){
			foreach($exp_share_list as $k=>$v){
				//处理时间
				$exp_share_list[$k]['ct'] = date("Y-m-d",$v['ct']).'<br>'.date("H:i:s",$v['ct']);
				//有效
				if($v['valid'] == 1) $total_valid++;
				//处理图片
				$exp_share_list[$k]['exp_share_img'] = 
				$this->path->get_url($v['exp_share_img'],'exp_share_img',$v['exp_share_id']);
			}
		}
		$this->info['exp_share_list'] = $exp_share_list;
		$this->info['total'] = $total;
		$this->info['total_valid'] = $total_valid;
		//获取s默认图片
		$this->info['default_exp_share_img'] = $this->path->get_default('exp_share_img');
		$this->v();
	}
	//EXP_SHARE详情
	public function edit_exp_share($exp_share_id = 0){
		//获取ID
		$this->info['exp_share_id'] = intval($exp_share_id);
		//获取EXP_SHARE详情
		$exp_share_info = $this->home_model->get_exp_share_by_id($exp_share_id);
		if(!$exp_share_info) redirect('mng_home/exp_share_list');//如果没有信息,跳转到列表
		//获取图片
		$exp_share_info['exp_share_img'] = 
		$this->path->get_url($exp_share_info['exp_share_img'],'exp_share_img',$exp_share_id);
		$this->info['exp_share'] = $exp_share_info;
		$this->info['default_module_img'] = $this->path->get_default('module_img');
		//获取内容模块
		$module = $exp_share_info['exp_share_module'];
		if(!$module)$module = array();
		else{
			$this->load->model('module_model');
			$module = $this->module_model->get_module_by_id_array(json_decode($module,true));
		}
		//根据模块种类 获取图片
		if($module){
			$module_tmp = array();//做一个新的数组 K=ID V=内容
			foreach($module as $k=>$v){
				if($v['module_type'] == 2){
					$v['module_img'] = 
					$this->path->get_url($v['module_img'],'module_img',$v['module_id']);
				}
				$module_tmp[$v['module_id']] = $v;
			}
			$module = $module_tmp;
		}
		//所有模块内容
		$this->info['module'] = $module;
		//布局
		$this->info['exp_share_module'] = json_decode($exp_share_info['exp_share_module'],true);
		//默认使用当前方法作为子菜单的选中方法
		//如果需要其他方法作为子菜单的选中方法，重新执行一下 更换最后的参数即可
		$this->info['submenu'] =
		func::get_sub_menu($this->info['route'],$this->menu_array,'exp_share_list');
		$this->v();
	}
	//创建EXP_SHARE
	public function save_exp_share(){
		//接收参数
		$op = $this->input->post('op');
		$exp_share_id = intval($this->input->post('exp_share_id'));
		$exp_share_name = trim($this->input->post('exp_share_name'));
		$exp_share_content = trim($this->input->post('exp_share_content'));
		$exp_share_note = trim($this->input->post('exp_share_note'));
		//控制排序
		$sort = intval($this->input->post('sort'));
		if($sort <= consts::MIN_SORT) $sort = consts::MIN_SORT;
		else if($sort >= consts::MAX_SORT) $sort = consts::MAX_SORT;
	
		//图片控制
		$exp_share_img = trim($this->input->post('exp_share_img'));
		$exp_share_img_change = intval($this->input->post('exp_share_img_change'));
		
		//错误
		if($op != CREATE && $op != UPDATE) exit('0');
		if($op == UPDATE && $exp_share_id < 1) exit('0');
		//表单验证
		//获取表单错误文言配置
		//$form_error_msg = $this->form_error_msg();
		$form_error = array();
		//标题
		if(!$exp_share_name){
			$form_error['exp_share_name'.FORM_ERROR_TAIL] = '请输入姓名';
		}
		//内容
		if(!$exp_share_content){
			$form_error['exp_share_content'.FORM_ERROR_TAIL] = '请输入内容';
		}
		//处理图片
		if($op == CREATE || ($op == UPDATE && $exp_share_img_change == 1)){
			if(!$exp_share_img){
				$form_error['exp_share_img'.FORM_ERROR_TAIL] = '请上传图片';
			}else{
				$exp_share_img = basename($exp_share_img);//提取文件名
				//检查tmp文件夹中此文件是否存在
				$exp_share_img_tmp_path = $this->path->admin_path($this->info['admin']['admin_id']).$exp_share_img;
				if(!$this->files->is_f($exp_share_img_tmp_path)){
					$form_error['exp_share_img'.FORM_ERROR_TAIL] = '请重新上传图片';
				}
			}
		}
		//这个模块暂时部需要图片 *****2016-10-15更新*****
		unset($form_error['exp_share_img'.FORM_ERROR_TAIL]);
		
		//表单验证失败，返回错误项
		if($form_error) exit(FORM_ERROR_PRE.json_encode($form_error));
		//数据库操作
		$form = array();
		$form['exp_share_name'] = $exp_share_name;
		$form['exp_share_content'] = $exp_share_content;
		$form['exp_share_note'] = $exp_share_note;
		$form['sort'] = $sort;
		if($op == CREATE){
			//图片文件名称
			$form['exp_share_img'] = basename($exp_share_img);
			$form['ct'] = time();
			$form['cer'] = $this->info['admin']['admin_id'];
			$res = $this->home_model->create_exp_share($form);
		}else{
			if($exp_share_img_change == 1){
				//图片文件名称
				$form['exp_share_img'] = basename($exp_share_img);
			}
			$form['ut'] = time();
			$form['uer'] = $this->info['admin']['admin_id'];
			$res = $this->home_model->update_exp_share($form,$exp_share_id);
		}
		if($res < 1)exit('0');
		//处理图片
		if($op == CREATE)$exp_share_id = $res;
		//保存成功操作文件
		if($op == CREATE || ($op == UPDATE && $exp_share_img_change == 1)){
			$path = $this->path->get_path('exp_share_img',$exp_share_id);
			if($op == UPDATE)$this->files->del_d($path);//更新时先清除旧文件夹
			$this->files->make_d($path);//创建文件夹
			$this->files->copy_f($exp_share_img_tmp_path,$path.$form['exp_share_img']);//移动文件
		}
		$this->files->del_d($this->path->admin_path($this->info['admin']['admin_id']));//清理临时文件夹
		exit('1');
	}
	//删除EXP_SHARE
	public function delete_exp_share(){
		$exp_share_id = intval($this->input->post('exp_share_id'));
		if($exp_share_id < 1) exit('0');
		//执行数据库删除
		$this->home_model->delete_exp_share($exp_share_id);
		//执行文件删除
		$path = $this->path->get_path('exp_share_img',$exp_share_id);
		$this->files->del_d($path);
		exit('1');
	}
	//修改EXP_SHARE 有效性
	public function exp_share_valid(){
		$exp_share_id = intval($this->input->post('exp_share_id'));
		if($exp_share_id < 1) exit('0');
		$res = $this->home_model->exp_share_valid($exp_share_id);
		if($res == 1) exit('1');
		exit('0');
	}
	
	//发帖区域
	public function article_category_list(){
		//获取列表
		$article_category_list = $this->home_model->get_article_category_list();
		$total = count($article_category_list);
		$total_valid = 0;
		if($article_category_list){
			foreach($article_category_list as $k=>$v){
				//处理图片路径
				$article_category_list[$k]['article_category_img'] =
				$this->path->get_url($v['article_category_img'],'article_category_img',$v['article_category_id']);
				//处理时间
				$article_category_list[$k]['ct'] = date("Y-m-d",$v['ct']).'<br>'.date("H:i:s",$v['ct']);
				//有效
				if($v['valid'] == 1) $total_valid++;
			}
		}
		$this->info['article_category_list'] = $article_category_list;
		$this->info['total'] = $total;
		$this->info['total_valid'] = $total_valid;
		//获取article_category 的默认图片
		$this->info['default_article_category_img'] = $this->path->get_default('article_category_img');
		$this->v();
	}
	//创建发帖区域分类
	public function save_article_category(){
		//接收参数
		$op = $this->input->post('op');
		$article_category_id = intval($this->input->post('article_category_id'));
		$article_category_name = trim($this->input->post('article_category_name'));
		$article_category_content = trim($this->input->post('article_category_content'));
		//控制排序
		$sort = intval($this->input->post('sort'));
		if($sort <= consts::MIN_SORT) $sort = consts::MIN_SORT;
		else if($sort >= consts::MAX_SORT) $sort = consts::MAX_SORT;
	
		//图片控制
		$article_category_img = trim($this->input->post('article_category_img'));
		$article_category_img_change = intval($this->input->post('article_category_img_change'));
		//错误
		if($op != CREATE && $op != UPDATE) exit('0');
		if($op == UPDATE && $article_category_id < 1) exit('0');
		//表单验证
		//获取表单错误文言配置
		//$form_error_msg = $this->form_error_msg();
		$form_error = array();
		//标题
		if(!$article_category_name){
			$form_error['article_category_name'.FORM_ERROR_TAIL] = '请输入主标题';
		}
		//内容
		if(!$article_category_content){
			$form_error['article_category_content'.FORM_ERROR_TAIL] = '请输入内容';
		}
		//处理图片
		if($op == CREATE || ($op == UPDATE && $article_category_img_change == 1)){
			if(!$article_category_img){
				$form_error['article_category_img'.FORM_ERROR_TAIL] = '请上传图片';
			}else{
				$article_category_img = basename($article_category_img);//提取文件名
				//检查tmp文件夹中此文件是否存在
				$article_category_img_tmp_path = $this->path->admin_path($this->info['admin']['admin_id']).$article_category_img;
				if(!$this->files->is_f($article_category_img_tmp_path)){
					$form_error['article_category_img'.FORM_ERROR_TAIL] = '请重新上传图片';
				}
			}
		}
		//表单验证失败，返回错误项
		if($form_error) exit(FORM_ERROR_PRE.json_encode($form_error));
		//数据库操作
		$form = array();
		$form['article_category_name'] = $article_category_name;
		$form['article_category_content'] = $article_category_content;
		$form['sort'] = $sort;
		if($op == CREATE){
			//图片文件名称
			$form['article_category_img'] = basename($article_category_img);
			$form['ct'] = time();
			$form['cer'] = $this->info['admin']['admin_id'];
			$res = $this->home_model->create_article_category($form);
		}else{
			if($article_category_img_change == 1){
				//图片文件名称
				$form['article_category_img'] = basename($article_category_img);
			}
			$form['ut'] = time();
			$form['uer'] = $this->info['admin']['admin_id'];
			$res = $this->home_model->update_article_category($form,$article_category_id);
		}
		if($res < 1)exit('0');
		//处理图片
		if($op == CREATE)$article_category_id = $res;
		//保存成功操作文件
		if($op == CREATE || ($op == UPDATE && $article_category_img_change == 1)){
			$path = $this->path->get_path('article_category_img',$article_category_id);
			if($op == UPDATE)$this->files->del_d($path);//更新时先清除旧文件夹
			$this->files->make_d($path);//创建文件夹
			$this->files->copy_f($article_category_img_tmp_path,$path.$form['article_category_img']);//移动文件
		}
		$this->files->del_d($this->path->admin_path($this->info['admin']['admin_id']));//清理临时文件夹
		exit('1');
	}
	//删除article category
	public function delete_article_category(){
		$article_category_id = intval($this->input->post('article_category_id'));
		if($article_category_id < 1) exit('0');
		//执行数据库删除
		$this->home_model->delete_article_category($article_category_id);
		//执行文件删除
		$path = $this->path->get_path('article_category_img',$article_category_id);
		$this->files->del_d($path);
		exit('1');
	}
	//修改article category 有效性
	public function article_category_valid(){
		$article_category_id = intval($this->input->post('article_category_id'));
		if($article_category_id < 1) exit('0');
		$res = $this->home_model->article_category_valid($article_category_id);
		if($res == 1) exit('1');
		exit('0');
	}
	
	//底部广告控制
	public function btm_advert_list(){
		//获取列表
		$btm_advert_list = $this->home_model->get_btm_advert_list();
		$total = count($btm_advert_list);
		$total_valid = 0;
		if($btm_advert_list){
			foreach($btm_advert_list as $k=>$v){
				//处理图片路径
				$btm_advert_list[$k]['btm_advert_img'] =
				$this->path->get_url($v['btm_advert_img'],'btm_advert_img',$v['btm_advert_id']);
				//处理时间
				$btm_advert_list[$k]['ct'] = date("Y-m-d",$v['ct']).'<br>'.date("H:i:s",$v['ct']);
				//有效
				if($v['valid'] == 1) $total_valid++;
			}
		}
		$this->info['btm_advert_list'] = $btm_advert_list;
		$this->info['total'] = $total;
		$this->info['total_valid'] = $total_valid;
		//获取底部广告的默认图片
		$this->info['default_btm_advert_img'] = $this->path->get_default('btm_advert_img');
		$this->v();
	}
	//创建底部广告
	public function save_btm_advert(){
		//接收参数
		$op = $this->input->post('op');
		$btm_advert_id = intval($this->input->post('btm_advert_id'));
		$btm_advert_content = trim($this->input->post('btm_advert_content'));
		$btm_advert_name = trim($this->input->post('btm_advert_name'));
		$btm_advert_link = trim($this->input->post('btm_advert_link'));
		//控制排序
		$sort = intval($this->input->post('sort'));
		if($sort <= consts::MIN_SORT) $sort = consts::MIN_SORT;
		else if($sort >= consts::MAX_SORT) $sort = consts::MAX_SORT;
	
		//图片控制
		$btm_advert_img = trim($this->input->post('btm_advert_img'));
		$btm_advert_img_change = intval($this->input->post('btm_advert_img_change'));
		//错误
		if($op != CREATE && $op != UPDATE) exit('0');
		if($op == UPDATE && $btm_advert_id < 1) exit('0');
		//表单验证
		//获取表单错误文言配置
		//$form_error_msg = $this->form_error_msg();
		$form_error = array();
		//标题
		if(!$btm_advert_name){
			$form_error['btm_advert_name'.FORM_ERROR_TAIL] = '请输入标题';
		}
		//内容
		if(!$btm_advert_content){
			$form_error['btm_advert_content'.FORM_ERROR_TAIL] = '请输入简介';
		}
		//处理图片
		if($op == CREATE || ($op == UPDATE && $btm_advert_img_change == 1)){
			if(!$btm_advert_img){
				$form_error['btm_advert_img'.FORM_ERROR_TAIL] = '请上传图片';
			}else{
				$btm_advert_img = basename($btm_advert_img);//提取文件名
				//检查tmp文件夹中此文件是否存在
				$btm_advert_img_tmp_path = $this->path->admin_path($this->info['admin']['admin_id']).$btm_advert_img;
				if(!$this->files->is_f($btm_advert_img_tmp_path)){
					$form_error['btm_advert_img'.FORM_ERROR_TAIL] = '请重新上传图片';
				}
			}
		}
		//表单验证失败，返回错误项
		if($form_error) exit(FORM_ERROR_PRE.json_encode($form_error));
		//数据库操作
		$form = array();
		$form['btm_advert_name'] = $btm_advert_name;
		$form['btm_advert_content'] = $btm_advert_content;
		$form['btm_advert_link'] = $btm_advert_link;		
		$form['sort'] = $sort;
		if($op == CREATE){
			//图片文件名称
			$form['btm_advert_img'] = basename($btm_advert_img);
			$form['ct'] = time();
			$form['cer'] = $this->info['admin']['admin_id'];
			$res = $this->home_model->create_btm_advert($form);
		}else{
			if($btm_advert_img_change == 1){
				//图片文件名称
				$form['btm_advert_img'] = basename($btm_advert_img);
			}
			$form['ut'] = time();
			$form['uer'] = $this->info['admin']['admin_id'];
			$res = $this->home_model->update_btm_advert($form,$btm_advert_id);
		}
		if($res < 1)exit('0');
		//处理图片
		if($op == CREATE)$btm_advert_id = $res;
		//保存成功操作文件
		if($op == CREATE || ($op == UPDATE && $btm_advert_img_change == 1)){
			$path = $this->path->get_path('btm_advert_img',$btm_advert_id);
			if($op == UPDATE)$this->files->del_d($path);//更新时先清除旧文件夹
			$this->files->make_d($path);//创建文件夹
			$this->files->copy_f($btm_advert_img_tmp_path,$path.$form['btm_advert_img']);//移动文件
		}
		$this->files->del_d($this->path->admin_path($this->info['admin']['admin_id']));//清理临时文件夹
		exit('1');
	}
	//删除底部广告
	public function delete_btm_advert(){
		$btm_advert_id = intval($this->input->post('btm_advert_id'));
		if($btm_advert_id < 1) exit('0');
		//执行数据库删除
		$this->home_model->delete_btm_advert($btm_advert_id);
		//执行文件删除
		$path = $this->path->get_path('btm_advert_img',$btm_advert_id);
		$this->files->del_d($path);
		exit('1');
	}
	//修改底部广告 有效性
	public function btm_advert_valid(){
		$btm_advert_id = intval($this->input->post('btm_advert_id'));
		if($btm_advert_id < 1) exit('0');
		$res = $this->home_model->btm_advert_valid($btm_advert_id);
		if($res == 1) exit('1');
		exit('0');
	}
	
	//底部滚动控制
	public function btm_marquee_list(){
		//获取列表
		$btm_marquee_list = $this->home_model->get_btm_marquee_list();
		$total = count($btm_marquee_list);
		$total_valid = 0;
		if($btm_marquee_list){
			foreach($btm_marquee_list as $k=>$v){
				//处理图片路径
				$btm_marquee_list[$k]['btm_marquee_img'] =
				$this->path->get_url($v['btm_marquee_img'],'btm_marquee_img',$v['btm_marquee_id']);
				//处理时间
				$btm_marquee_list[$k]['ct'] = date("Y-m-d",$v['ct']).'<br>'.date("H:i:s",$v['ct']);
				//有效
				if($v['valid'] == 1) $total_valid++;
			}
		}
		$this->info['btm_marquee_list'] = $btm_marquee_list;
		$this->info['total'] = $total;
		$this->info['total_valid'] = $total_valid;
		//获取底部广告的默认图片
		$this->info['default_btm_marquee_img'] = $this->path->get_default('btm_marquee_img');
		$this->v();
	}
	//创建底部滚动
	public function save_btm_marquee(){
		//接收参数
		$op = $this->input->post('op');
		$btm_marquee_id = intval($this->input->post('btm_marquee_id'));
		$btm_marquee_link = trim($this->input->post('btm_marquee_link'));
		//控制排序
		$sort = intval($this->input->post('sort'));
		if($sort <= consts::MIN_SORT) $sort = consts::MIN_SORT;
		else if($sort >= consts::MAX_SORT) $sort = consts::MAX_SORT;
	
		//图片控制
		$btm_marquee_img = trim($this->input->post('btm_marquee_img'));
		$btm_marquee_img_change = intval($this->input->post('btm_marquee_img_change'));
		//错误
		if($op != CREATE && $op != UPDATE) exit('0');
		if($op == UPDATE && $btm_marquee_id < 1) exit('0');
		//表单验证
		//获取表单错误文言配置
		//$form_error_msg = $this->form_error_msg();
		$form_error = array();
		//处理图片
		if($op == CREATE || ($op == UPDATE && $btm_marquee_img_change == 1)){
			if(!$btm_marquee_img){
				$form_error['btm_marquee_img'.FORM_ERROR_TAIL] = '请上传图片';
			}else{
				$btm_marquee_img = basename($btm_marquee_img);//提取文件名
				//检查tmp文件夹中此文件是否存在
				$btm_marquee_img_tmp_path = $this->path->admin_path($this->info['admin']['admin_id']).$btm_marquee_img;
				if(!$this->files->is_f($btm_marquee_img_tmp_path)){
					$form_error['btm_marquee_img'.FORM_ERROR_TAIL] = '请重新上传图片';
				}
			}
		}
		//表单验证失败，返回错误项
		if($form_error) exit(FORM_ERROR_PRE.json_encode($form_error));
		//数据库操作
		$form = array();
		$form['btm_marquee_link'] = $btm_marquee_link;
		$form['sort'] = $sort;
		if($op == CREATE){
			//图片文件名称
			$form['btm_marquee_img'] = basename($btm_marquee_img);
			$form['ct'] = time();
			$form['cer'] = $this->info['admin']['admin_id'];
			$res = $this->home_model->create_btm_marquee($form);
		}else{
			if($btm_marquee_img_change == 1){
				//图片文件名称
				$form['btm_marquee_img'] = basename($btm_marquee_img);
			}
			$form['ut'] = time();
			$form['uer'] = $this->info['admin']['admin_id'];
			$res = $this->home_model->update_btm_marquee($form,$btm_marquee_id);
		}
		if($res < 1)exit('0');
		//处理图片
		if($op == CREATE)$btm_marquee_id = $res;
		//保存成功操作文件
		if($op == CREATE || ($op == UPDATE && $btm_marquee_img_change == 1)){
			$path = $this->path->get_path('btm_marquee_img',$btm_marquee_id);
			if($op == UPDATE)$this->files->del_d($path);//更新时先清除旧文件夹
			$this->files->make_d($path);//创建文件夹
			$this->files->copy_f($btm_marquee_img_tmp_path,$path.$form['btm_marquee_img']);//移动文件
		}
		$this->files->del_d($this->path->admin_path($this->info['admin']['admin_id']));//清理临时文件夹
		exit('1');
	}
	//删除底部滚动
	public function delete_btm_marquee(){
		$btm_marquee_id = intval($this->input->post('btm_marquee_id'));
		if($btm_marquee_id < 1) exit('0');
		//执行数据库删除
		$this->home_model->delete_btm_marquee($btm_marquee_id);
		//执行文件删除
		$path = $this->path->get_path('btm_marquee_img',$btm_marquee_id);
		$this->files->del_d($path);
		exit('1');
	}
	//修改底部滚动 有效性
	public function btm_marquee_valid(){
		$btm_marquee_id = intval($this->input->post('btm_marquee_id'));
		if($btm_marquee_id < 1) exit('0');
		$res = $this->home_model->btm_marquee_valid($btm_marquee_id);
		if($res == 1) exit('1');
		exit('0');
	}
	
	
}
	