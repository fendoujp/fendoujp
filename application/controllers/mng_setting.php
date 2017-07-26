<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 网站设定
 * MyDivine
 * 2016-09-27
 */
class Mng_setting extends AC{
	//构造方法
	public function __construct(){
		parent::__construct();	
		//子菜单数组
		$this->menu_array = array();
		$this->menu_array['index'] = 'SEO设定';
		$this->menu_array['head'] = '页头设定';
		$this->menu_array['foot'] = '页脚设定';
		$this->menu_array['link'] = '合作链接';
		//默认使用当前方法作为子菜单的选中方法
		//如果需要其他方法作为子菜单的选中方法，重新执行一下 更换最后的参数即可
		$this->info['submenu'] =
		func::get_sub_menu($this->info['route'],$this->menu_array,$this->info['route']['fun']);
		
		$this->load->model('setting_model');
	}
	
	//首页
	public function index(){
		$this->info['seo'] = $this->setting_model->get_seo();
		$this->v();
	}
	public function save_seo(){
		//接受参数
		$seo_title = trim($this->input->post('seo_title'));
		$seo_intro = trim($this->input->post('seo_intro'));
		$seo_keyword = trim($this->input->post('seo_keyword'));				
		//错误处理
		$form_error = array();
		//处理图片
		if($seo_title == ""){			
			$form_error['seo_title'.FORM_ERROR_TAIL] = '请填写网站标题';		
		}
		if($seo_intro == ""){
			$form_error['seo_intro'.FORM_ERROR_TAIL] = '请填写网站简介';
		}
		if($seo_keyword == ""){
			$form_error['seo_keyword'.FORM_ERROR_TAIL] = '请填写网站关键字';
		}
		//表单验证失败，返回错误项
		if($form_error) exit(FORM_ERROR_PRE.json_encode($form_error));		
		$update = array();
		$update['seo_title'] = $seo_title;
		$update['seo_intro'] = $seo_intro;
		$update['seo_keyword'] = $seo_keyword;
		//提交更新
		$res = $this->setting_model->update_seo($update);
		exit('1');//成功并且返回
	}
	//页头
	public function head(){
		$this->info['head'] = $this->setting_model->get_head();
		$this->info['head']['head_logo'] = 
			$this->path->get_url($this->info['head']['head_logo'],'head_logo');
		$this->v();
	}
	public function save_head(){
		
		//接受参数
		$head_cd_time1 = trim($this->input->post('head_cd_time1'));
		$head_cd_time2 = trim($this->input->post('head_cd_time2'));
		$head_cd_title1 = trim($this->input->post('head_cd_title1'));
		$head_cd_title2 = trim($this->input->post('head_cd_title2'));
		$head_cd_link1 = trim($this->input->post('head_cd_link1'));
		$head_cd_link2 = trim($this->input->post('head_cd_link2'));
		$head_qq1 = trim($this->input->post('head_qq1'));
		$head_qq2 = trim($this->input->post('head_qq2'));
		$head_qq_title1 = trim($this->input->post('head_qq_title1'));
		$head_qq_title2 = trim($this->input->post('head_qq_title2'));
		$head_logo = $this->input->post('head_logo');
		$head_logo_change = $this->input->post('head_logo_change');
	 			
		//错误处理
		$form_error = array();
		//处理图片
		if($head_logo_change == 1){
			$head_logo = basename($head_logo);//提取文件名
			//检查tmp文件夹中此文件是否存在
			$head_logo_tmp_path = $this->path->admin_path($this->info['admin']['admin_id']).$head_logo;
			if(!$this->files->is_f($head_logo_tmp_path)){
				$form_error['head_logo'.FORM_ERROR_TAIL] = '请重新上传图片';
			}
		}
		//验证其他
		if(!func::check_date($head_cd_time1)){
			$form_error['head_cd_time1'.FORM_ERROR_TAIL] = '倒计时1号日期格式错误';
		}
		if(!func::check_date($head_cd_time2)){
			$form_error['head_cd_time2'.FORM_ERROR_TAIL] = '倒计时2号日期格式错误';
		}
		if(!$head_cd_title1){
			$form_error['head_cd_title1'.FORM_ERROR_TAIL] = '请填写1号倒计时标题';
		}
		if(!$head_cd_title2){
			$form_error['head_cd_title2'.FORM_ERROR_TAIL] = '请填写2号倒计时标题';
		}
		if(!$head_cd_link1){
			$form_error['head_cd_link1'.FORM_ERROR_TAIL] = '请填写1号倒计时链接';
		}
		if(!$head_cd_link2){
			$form_error['head_cd_link2'.FORM_ERROR_TAIL] = '请填写2号倒计时链接';
		}
		if(!$head_qq1){
			$form_error['head_qq1'.FORM_ERROR_TAIL] = '请填写1号QQ';
		}
		if(!$head_qq2){
			$form_error['head_qq2'.FORM_ERROR_TAIL] = '请填写2号QQ';
		}
		if(!$head_qq_title1){
			$form_error['head_qq_title1'.FORM_ERROR_TAIL] = '请填写1号客服名称';
		}
		if(!$head_qq_title2){
			$form_error['head_qq_title2'.FORM_ERROR_TAIL] = '请填写2号客服名称';
		}
		//表单验证失败，返回错误项
		if($form_error) exit(FORM_ERROR_PRE.json_encode($form_error));
		
		$update = array();
		if($head_logo_change == 1) $update['head_logo'] = basename($head_logo);
		$update['head_cd_time1'] = strtotime($head_cd_time1);
		$update['head_cd_time2'] = strtotime($head_cd_time2);
		$update['head_cd_title1'] = $head_cd_title1;
		$update['head_cd_title2'] = $head_cd_title2;
		$update['head_cd_link1'] = $head_cd_link1;
		$update['head_cd_link2'] = $head_cd_link2;
		$update['head_qq1'] = $head_qq1;
		$update['head_qq2'] = $head_qq2;
		$update['head_qq_title1'] = $head_qq_title1;
		$update['head_qq_title2'] = $head_qq_title2;
		//提交更新
		$res = $this->setting_model->update_head($update);
		if(!$res) exit('0');//更新失败		
		//处理图片
		if($head_logo_change == 1){
			$path = $this->path->get_path('head_logo');
			$this->files->del_d($path);//更新时先清除旧文件夹
			$this->files->make_d($path);//创建文件夹
			$this->files->copy_f($head_logo_tmp_path,$path.$update['head_logo']);//移动文件
		}
		$this->files->del_d($this->path->admin_path($this->info['admin']['admin_id']));//清理临时文件夹
		exit('1');//成功并且返回
	}
	
	//页头
	public function foot(){
		$this->info['foot'] = $this->setting_model->get_foot();
		$this->info['foot']['foot_logo'] =
		$this->path->get_url($this->info['foot']['foot_logo'],'foot_logo');
		$this->info['foot']['foot_pt_img1'] =
		$this->path->get_url($this->info['foot']['foot_pt_img1'],'foot_pt_img1');
		$this->info['foot']['foot_pt_img2'] =
		$this->path->get_url($this->info['foot']['foot_pt_img2'],'foot_pt_img2');
		$this->v();
	}
	public function save_foot(){
		//接受参数
		$foot_intro = trim($this->input->post('foot_intro'));
		$foot_contact = trim($this->input->post('foot_contact'));
		$foot_logo = $this->input->post('foot_logo');
		$foot_logo_change = $this->input->post('foot_logo_change');

		$foot_pt_title1 = trim($this->input->post('foot_pt_title1'));
		$foot_pt_content1 = trim($this->input->post('foot_pt_content1'));
		$foot_pt_img1 = $this->input->post('foot_pt_img1');
		$foot_pt_img1_change = $this->input->post('foot_pt_img1_change');
		
		$foot_pt_title2 = trim($this->input->post('foot_pt_title2'));
		$foot_pt_content2 = trim($this->input->post('foot_pt_content2'));
		$foot_pt_img2 = $this->input->post('foot_pt_img2');
		$foot_pt_img2_change = $this->input->post('foot_pt_img2_change');
		
		//错误处理
		$form_error = array();
		//处理图片
		if($foot_logo_change == 1){
			$foot_logo = basename($foot_logo);//提取文件名
			//检查tmp文件夹中此文件是否存在
			$foot_logo_tmp_path = $this->path->admin_path($this->info['admin']['admin_id']).$foot_logo;
			if(!$this->files->is_f($foot_logo_tmp_path)){
				$form_error['foot_logo'.FORM_ERROR_TAIL] = '请重新上传LOGO图片';
			}
		}
		if(!$foot_intro){
			$form_error['foot_intro'.FORM_ERROR_TAIL] = '请填写公司介绍';
		}
		if(!$foot_contact){
			$form_error['foot_contact'.FORM_ERROR_TAIL] = '请填写联系方式';
		}		
		if(!$foot_pt_title1 || !$foot_pt_content1){
			$form_error['foot_pt_title1'.FORM_ERROR_TAIL] = '请填写社交平台1的信息';
		}
		if(!$foot_pt_title2 || !$foot_pt_content2){
			$form_error['foot_pt_title2'.FORM_ERROR_TAIL] = '请填写社交平台2的信息';
		}		
		if($foot_pt_img1_change == 1){
			$foot_pt_img1 = basename($foot_pt_img1);//提取文件名
			//检查tmp文件夹中此文件是否存在
			$foot_pt_img1_tmp_path = $this->path->admin_path($this->info['admin']['admin_id']).$foot_pt_img1;
			if(!$this->files->is_f($foot_pt_img1_tmp_path)){
				$form_error['foot_pt_img1'.FORM_ERROR_TAIL] = '请重新上传社交平台1图片';
			}
		}
		if($foot_pt_img2_change == 1){
			$foot_pt_img2 = basename($foot_pt_img2);//提取文件名
			//检查tmp文件夹中此文件是否存在
			$foot_pt_img2_tmp_path = $this->path->admin_path($this->info['admin']['admin_id']).$foot_pt_img2;
			if(!$this->files->is_f($foot_pt_img2_tmp_path)){
				$form_error['foot_pt_img2'.FORM_ERROR_TAIL] = '请重新上传社交平台2图片';
			}
		}
		//表单验证失败，返回错误项
		if($form_error) exit(FORM_ERROR_PRE.json_encode($form_error));
	
		$update = array();
		if($foot_logo_change == 1) $update['foot_logo'] = basename($foot_logo);
		if($foot_pt_img1_change == 1) $update['foot_pt_img1'] = basename($foot_pt_img1);
		if($foot_pt_img2_change == 1) $update['foot_pt_img2'] = basename($foot_pt_img2);
				
		$update['foot_intro'] = $foot_intro;
		$update['foot_contact'] = $foot_contact;
		$update['foot_pt_title1'] = $foot_pt_title1;
		$update['foot_pt_content1'] = $foot_pt_content1;
		$update['foot_pt_title2'] = $foot_pt_title2;
		$update['foot_pt_content2'] = $foot_pt_content2;
		//提交更新
		$res = $this->setting_model->update_foot($update);
		if(!$res) exit('0');//更新失败
		//处理图片
		if($foot_logo_change == 1){
			$path = $this->path->get_path('foot_logo');
			$this->files->del_d($path);//更新时先清除旧文件夹
			$this->files->make_d($path);//创建文件夹
			$this->files->copy_f($foot_logo_tmp_path,$path.$update['foot_logo']);//移动文件
		}
		if($foot_pt_img2_change == 1){
			$path = $this->path->get_path('foot_pt_img2');
			$this->files->del_d($path);//更新时先清除旧文件夹
			$this->files->make_d($path);//创建文件夹
			$this->files->copy_f($foot_pt_img2_tmp_path,$path.$update['foot_pt_img2']);//移动文件
		}
		if($foot_pt_img1_change == 1){
			$path = $this->path->get_path('foot_pt_img1');
			$this->files->del_d($path);//更新时先清除旧文件夹
			$this->files->make_d($path);//创建文件夹
			$this->files->copy_f($foot_pt_img1_tmp_path,$path.$update['foot_pt_img1']);//移动文件
		}
		$this->files->del_d($this->path->admin_path($this->info['admin']['admin_id']));//清理临时文件夹
		exit('1');//成功并且返回
	}	
	//合作链接
	public function link(){
		$this->info['link'] = $this->setting_model->get_link();
		$this->v();
	}
	public function save_link(){
		$link_id = intval($this->input->post('link_id'));
		$link_title = trim($this->input->post('link_title'));
		$link_url = trim($this->input->post('link_url'));
		if($link_id < 1 || $link_id > 8)exit('-1');
		
		//错误处理
		$form_error = array();
		if(!$link_title){
			$form_error['link_title'.FORM_ERROR_TAIL] = '请填写链接名称';
		}
		if(strpos($link_url, 'http://') !== 0 && strpos($link_url, 'https://') !== 0){
			$form_error['link_url'.FORM_ERROR_TAIL] = '请填写http://或者https://开头的网址';
		}
		//表单验证失败，返回错误项
		if($form_error) exit(FORM_ERROR_PRE.json_encode($form_error));
		$update = array();
		$update['link_title'] = $link_title;
		$update['link_url'] = $link_url;
		//提交更新
		if($this->setting_model->update_link($update,$link_id))exit('1');
		exit('0');
	}

	
}