<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 管理端首页
 * MyDivine
 * 2016-09-06
 */
class Mng_article extends AC{
	//构造方法
	public function __construct(){
		parent::__construct();		
		$this->load->model('article_model');
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
		//获取文章分类
		$this->info['article_category_list'] = $this->home_model->get_article_category_list();
	}
	
	//首页
	public function index($category_id=0){
		//分类参数  -1 = 无分类  0=全部  其他=分类ID
		$category_id = intval($category_id);
		if($category_id < -1) $category_id = 0;
		$this->info['category_id'] = $category_id;
		
		//获取列表
		$article_list = $this->article_model->get_article_list($category_id);
		$total = count($article_list);
		$total_valid = 0;
		if($article_list){
			foreach($article_list as $k=>$v){
				//处理时间
				$article_list[$k]['ct'] = date("Y-m-d",$v['ct']).'<br>'.date("H:i:s",$v['ct']);
				//有效
				if($v['valid'] == 1) $total_valid++;
				//处理图片
				$article_list[$k]['article_img'] =
				$this->path->get_url($v['article_img'],'article_img',$v['article_id']);
			}
		}
		$this->info['article_list'] = $article_list;
		$this->info['total'] = $total;
		$this->info['total_valid'] = $total_valid;
		//获取s默认图片
		$this->info['default_article_img'] = $this->path->get_default('article_img');
		$this->v();
	}
	
	//article详情
	public function edit_article($article_id = 0){
		//获取ID
		$this->info['article_id'] = intval($article_id);
		//获取article详情
		$article_info = $this->article_model->get_article_by_id($article_id);
		if(!$article_info) redirect('mng_article');//如果没有信息,跳转到列表
		
		//获取图片
		$article_info['article_img'] =
		$this->path->get_url($article_info['article_img'],'article_img',$article_id);
		$this->info['article'] = $article_info;
		$this->info['default_module_img'] = $this->path->get_default('module_img');
		//获取内容模块
		$module = $article_info['article_module'];
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
		$this->info['article_module'] = json_decode($article_info['article_module'],true);		
		$this->v();
	}
	//创建article
	public function save_article(){
		//接收参数
		$op = $this->input->post('op');
		$article_id = intval($this->input->post('article_id'));
		$article_title = trim($this->input->post('article_title'));
		$article_sub_title = trim($this->input->post('article_sub_title'));
		//分类
		$article_category_id = intval($this->input->post('article_category_id'));
		if($article_category_id <= 0) $article_category_id = 0;
		
		//控制排序
		$sort = intval($this->input->post('sort'));
		if($sort <= consts::MIN_SORT) $sort = consts::MIN_SORT;
		else if($sort >= consts::MAX_SORT) $sort = consts::MAX_SORT;
	
		//图片控制
		$article_img = trim($this->input->post('article_img'));
		$article_img_change = intval($this->input->post('article_img_change'));
	
		//错误
		if($op != CREATE && $op != UPDATE) exit('0');
		if($op == UPDATE && $article_id < 1) exit('0');
		//表单验证
		//获取表单错误文言配置
		//$form_error_msg = $this->form_error_msg();
		$form_error = array();
		//标题
		if(!$article_title){
			$form_error['article_title'.FORM_ERROR_TAIL] = '请输入文章名';
		}
		//处理图片
		if($op == CREATE || ($op == UPDATE && $article_img_change == 1)){
			if(!$article_img){
				$form_error['article_img'.FORM_ERROR_TAIL] = '请上传图片';
			}else{
				$article_img = basename($article_img);//提取文件名
				//检查tmp文件夹中此文件是否存在
				$article_img_tmp_path = $this->path->admin_path($this->info['admin']['admin_id']).$article_img;
				if(!$this->files->is_f($article_img_tmp_path)){
					$form_error['article_img'.FORM_ERROR_TAIL] = '请重新上传图片';
				}
			}
		}
		//这个模块暂时部需要图片 *****2016-10-15更新*****
		unset($form_error['article_img'.FORM_ERROR_TAIL]);
		//表单验证失败，返回错误项
		if($form_error) exit(FORM_ERROR_PRE.json_encode($form_error));
		//数据库操作
		$form = array();
		$form['article_title'] = $article_title;
		$form['article_sub_title'] = $article_sub_title;
		$form['article_category_id'] = $article_category_id;		
		$form['sort'] = $sort;
		if($op == CREATE){
			//图片文件名称
			$form['article_img'] = basename($article_img);
			$form['ct'] = time();
			$form['cer'] = $this->info['admin']['admin_id'];
			$res = $this->article_model->create_article($form);
		}else{
			if($article_img_change == 1){
				//图片文件名称
				$form['article_img'] = basename($article_img);
			}
			$form['ut'] = time();
			$form['uer'] = $this->info['admin']['admin_id'];
			$res = $this->article_model->update_article($form,$article_id);
		}
		if($res < 1)exit('0');
		//处理图片
		if($op == CREATE)$article_id = $res;
		//保存成功操作文件
		if($op == CREATE || ($op == UPDATE && $article_img_change == 1)){
			$path = $this->path->get_path('article_img',$article_id);
			if($op == UPDATE)$this->files->del_d($path);//更新时先清除旧文件夹
			$this->files->make_d($path);//创建文件夹
			$this->files->copy_f($article_img_tmp_path,$path.$form['article_img']);//移动文件
		}
		$this->files->del_d($this->path->admin_path($this->info['admin']['admin_id']));//清理临时文件夹
		exit('1');
	}
	//删除article
	public function delete_article(){
		$article_id = intval($this->input->post('article_id'));
		if($article_id < 1) exit('0');
		//执行数据库删除
		$this->article_model->delete_article($article_id);
		//执行文件删除
		$path = $this->path->get_path('article_img',$article_id);
		$this->files->del_d($path);
		exit('1');
	}
	//修改article 有效性
	public function article_valid(){
		$article_id = intval($this->input->post('article_id'));
		if($article_id < 1) exit('0');
		$res = $this->article_model->article_valid($article_id);
		if($res == 1) exit('1');
		exit('0');
	}
	
}