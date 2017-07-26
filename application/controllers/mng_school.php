<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 管理端学校介绍首页
 * MyDivine
 * 2016-09-06
 */
class Mng_school extends AC{
	//构造方法
	public function __construct(){
		parent::__construct();	
		
		$this->load->model('school_model');
		$this->load->model('home_model');
		/*
		//子菜单数组
		$this->menu_array = array();
		$this->menu_array['index'] = consts::SCH_LIST;
		$this->menu_array['intro'] = consts::SCH_INTRO;
		$this->menu_array['enrol'] = consts::SCH_ENROL;
		$this->menu_array['envmt'] = consts::SCH_ENVMT;
		//默认使用当前方法作为子菜单的选中方法
		//如果需要其他方法作为子菜单的选中方法，重新执行一下 更换最后的参数即可
		$this->info['submenu'] = 
		func::get_sub_menu($this->info['route'],$this->menu_array,$this->info['route']['fun']);
		*/
		//获取学校分类
		$this->info['school_category_list'] = $this->home_model->get_school_category_list();
	}
	
	//首页
	public function index($category_id=0){
		//分类参数  -1 = 无分类  0=全部  其他=分类ID
		$category_id = intval($category_id);
		if($category_id < -1) $category_id = 0;
		$this->info['category_id'] = $category_id;
		
		//获取列表
		$school_list = $this->school_model->get_school_list($category_id);
		$total = count($school_list);
		$total_valid = 0;
		if($school_list){
			foreach($school_list as $k=>$v){
				//处理时间
				$school_list[$k]['ct'] = date("Y-m-d",$v['ct']).'<br>'.date("H:i:s",$v['ct']);
				//有效
				if($v['valid'] == 1) $total_valid++;
				//处理图片
				$school_list[$k]['school_img'] =
				$this->path->get_url($v['school_img'],'school_img',$v['school_id']);
			}
		}
		$this->info['school_list'] = $school_list;
		$this->info['total'] = $total;
		$this->info['total_valid'] = $total_valid;
		//获取s默认图片
		$this->info['default_school_img'] = $this->path->get_default('school_img');
		$this->v();
	}
	//school详情
	public function edit_school($type = '',$school_id = 0){
		//获取ID
		$this->info['school_id'] = intval($school_id);
		//获取school详情
		$school_info = $this->school_model->get_school_by_id($school_id);
		if(!$school_info) redirect('mng_school');//如果没有信息,跳转到列表
		//如果type不对 退出
		if($type != 'intro' && $type != 'enrol' && $type != 'envmt'){
			redirect('mng_school');//如果没有信息,跳转到列表
		}
		$this->info['type'] = $type;
		//获取图片
		$school_info['school_img'] =
		$this->path->get_url($school_info['school_img'],'school_img',$school_id);
		$this->info['school'] = $school_info;
		$this->info['default_module_img'] = $this->path->get_default('module_img');
		//获取内容模块
		$module = $school_info['school_'.$type.'_module'];
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
		$this->info['school_module'] = json_decode($school_info['school_'.$type.'_module'],true);		
		$this->v();
	}
	//创建school
	public function save_school(){
		//接收参数
		$op = $this->input->post('op');
		$school_id = intval($this->input->post('school_id'));
		$school_title = trim($this->input->post('school_title'));
		$school_sub_title = trim($this->input->post('school_sub_title'));
		//分类
		$school_category_id = intval($this->input->post('school_category_id'));
		if($school_category_id <= 0) $school_category_id = 0;
		
		//控制排序
		$sort = intval($this->input->post('sort'));
		if($sort <= consts::MIN_SORT) $sort = consts::MIN_SORT;
		else if($sort >= consts::MAX_SORT) $sort = consts::MAX_SORT;
	
		//图片控制
		$school_img = trim($this->input->post('school_img'));
		$school_img_change = intval($this->input->post('school_img_change'));
	
		//错误
		if($op != CREATE && $op != UPDATE) exit('0');
		if($op == UPDATE && $school_id < 1) exit('0');
		//表单验证
		//获取表单错误文言配置
		//$form_error_msg = $this->form_error_msg();
		$form_error = array();
		//标题
		if(!$school_title){
			$form_error['school_title'.FORM_ERROR_TAIL] = '请输入学校名';
		}
		//处理图片
		if($op == CREATE || ($op == UPDATE && $school_img_change == 1)){
			if(!$school_img){
				$form_error['school_img'.FORM_ERROR_TAIL] = '请上传图片';
			}else{
				$school_img = basename($school_img);//提取文件名
				//检查tmp文件夹中此文件是否存在
				$school_img_tmp_path = $this->path->admin_path($this->info['admin']['admin_id']).$school_img;
				if(!$this->files->is_f($school_img_tmp_path)){
					$form_error['school_img'.FORM_ERROR_TAIL] = '请重新上传图片';
				}
			}
		}
		//表单验证失败，返回错误项
		if($form_error) exit(FORM_ERROR_PRE.json_encode($form_error));
		//数据库操作
		$form = array();
		$form['school_title'] = $school_title;
		$form['school_sub_title'] = $school_sub_title;
		$form['school_category_id'] = $school_category_id;		
		$form['sort'] = $sort;
		if($op == CREATE){
			//图片文件名称
			$form['school_img'] = basename($school_img);
			$form['ct'] = time();
			$form['cer'] = $this->info['admin']['admin_id'];
			$res = $this->school_model->create_school($form);
		}else{
			if($school_img_change == 1){
				//图片文件名称
				$form['school_img'] = basename($school_img);
			}
			$form['ut'] = time();
			$form['uer'] = $this->info['admin']['admin_id'];
			$res = $this->school_model->update_school($form,$school_id);
		}
		if($res < 1)exit('0');
		//处理图片
		if($op == CREATE)$school_id = $res;
		//保存成功操作文件
		if($op == CREATE || ($op == UPDATE && $school_img_change == 1)){
			$path = $this->path->get_path('school_img',$school_id);
			if($op == UPDATE)$this->files->del_d($path);//更新时先清除旧文件夹
			$this->files->make_d($path);//创建文件夹
			$this->files->copy_f($school_img_tmp_path,$path.$form['school_img']);//移动文件
		}
		$this->files->del_d($this->path->admin_path($this->info['admin']['admin_id']));//清理临时文件夹
		exit('1');
	}
	//删除school
	public function delete_school(){
		$school_id = intval($this->input->post('school_id'));
		if($school_id < 1) exit('0');
		//执行数据库删除
		$this->school_model->delete_school($school_id);
		//执行文件删除
		$path = $this->path->get_path('school_img',$school_id);
		$this->files->del_d($path);
		exit('1');
	}
	//修改school 有效性
	public function school_valid(){
		$school_id = intval($this->input->post('school_id'));
		if($school_id < 1) exit('0');
		$res = $this->school_model->school_valid($school_id);
		if($res == 1) exit('1');
		exit('0');
	}
	
}