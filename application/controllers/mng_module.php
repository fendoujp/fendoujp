<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 内容详情模块
 * MyDivine
 * 2016-09-13
 */
class Mng_module extends AC{
	//构造方法
	public function __construct(){
		parent::__construct();
		
		$this->load->model('module_model');
		//模块中的所有内容.都是依附于某个文章 所以必须先要获取文章类型和ID
		$allowed_parent = array('exp_share','school','intro','condi','article','nav','video');//所有类型的表名	
		$parent = $this->input->post('parent');//类型
		$parent_id = intval($this->input->post('parent_id'));//id
				
		if(!in_array($parent,$allowed_parent)) exit('-1');//如果不再允许列表中 报错
		if($parent_id < 1) exit('-2');//ID非法
		$position = intval($this->input->post('position'));//保存的位置
		if($position < -1) exit('-3');//位置错误 -1 = 最后追加   0=开始位置  其他=当前INDEX之前 
		
		
		//学校介绍只有三种
		if($parent == 'school'){
			$school_type = $this->input->post('school_type');//学校介绍时,要使用parent_type
			if($school_type != 'intro' && $school_type != 'enrol' && $school_type != 'envmt'){
				exit('-5');
			}
			$this->school_type = $school_type;
			$parent_module = $this->module_model->get_parent_module_school($school_type,$parent_id);
		}else{
			//检查ID和表明是否正确.是否能获取信息
			$parent_module = $this->module_model->get_parent_module($parent,$parent_id);
		}
		//如果取不到信息.报错
		if($parent_module === false) exit('-3');
		///////设置类属性
		$this->parent = $parent;
		$this->parent_id = $parent_id;
		$this->parent_module = $parent_module;
		$this->position = $position;
	}
	
	//保存文章模块
	public function save_module(){
		$op = $this->input->post('op');//操作符
		$module_id = intval($this->input->post('module_id'));
		$module_type = intval($this->input->post('module_type'));//1=文字 2=图片 3=视频
		$module_content = trim($this->input->post('module_content'));//文字内容
		$module_img = $this->input->post('module_img');
		$module_img_type = $this->input->post('module_img_type');//1=半幅 0=全幅
		if($module_img_type != 1) $module_img_type = 0;
		
		//图片控制
		$module_img = trim($this->input->post('module_img'));
		//错误
		if($op != CREATE && $op != UPDATE) exit('0');
		if($op == UPDATE && $module_id < 1) exit('0');
		if($module_type < 1 || $module_type > 3) exit('0');
		//表单验证
		$form_error = array();
		//如果是文字类型 或者是 视频
		if($module_type == 1 || $module_type == 3){
			//内容
			if(!$module_content){
				$form_error['module_content'.FORM_ERROR_TAIL] = '请输入内容';
			}
		//如果是图片类型
		}else{
			if(!$module_img){
				$form_error['module_img'.FORM_ERROR_TAIL] = '请上传图片';
			}else{
				$module_img = basename($module_img);//提取文件名
				//检查tmp文件夹中此文件是否存在
				$module_img_tmp_path = $this->path->admin_path($this->info['admin']['admin_id']).$module_img;
				if(!$this->files->is_f($module_img_tmp_path)){
					$form_error['module_img'.FORM_ERROR_TAIL] = '请重新上传图片';
				}
			}
		}
		//表单验证失败，返回错误项
		if($form_error) exit(FORM_ERROR_PRE.json_encode($form_error));
		//数据库操作
		$form = array();
		$form['module_type'] = $module_type;
		$form['module_img_type'] = $module_img_type;//图片显示模式 0=全幅 1=半幅
		if($op == CREATE){
			//根据TYPE部一样选择字段
			if($module_type == 1 || $module_type == 3){
				$form['module_content'] = $module_content;
			}else{
				$form['module_img'] = basename($module_img);
			}
			$form['ct'] = time();
			$form['cer'] = $this->info['admin']['admin_id'];
			$res = $this->module_model->create_module($form);
		}else{
			//根据TYPE部一样选择字段
			if($module_type == 1 || $module_type == 3){
				$form['module_content'] = $module_content;
			}else{
				$form['module_img'] = basename($module_img);
			}
			$form['ut'] = time();
			$form['uer'] = $this->info['admin']['admin_id'];
			$res = $this->module_model->update_module($form,$module_id);
		}
		if($res < 1)exit('0');
		//处理图片
		if($op == CREATE)$module_id = $res;
		//保存成功操作文件
		if($module_type == 2){
			$path = $this->path->get_path('module_img',$module_id);
			if($op == UPDATE)$this->files->del_d($path);//更新时先清除旧文件夹
			$this->files->make_d($path);//创建文件夹
			$this->files->copy_f($module_img_tmp_path,$path.$form['module_img']);//移动文件
		}
		$this->files->del_d($this->path->admin_path($this->info['admin']['admin_id']));//清理临时文件夹
		
		//增加新的内容模块
		if($op == CREATE){
			$this->add_module($module_id);
		}
		exit('1');		
	}
	
	//增加空格
	public function add_space(){
		//默认为 空行
		if($this->add_module()) exit('1');
		exit('0');
	}
	
	//删除模块
	public function delete_module(){
		$type = intval($this->input->post('type'));
		$module_id = intval($this->input->post('module_id'));
		//type = 1 文字  2 图片  3视频  4空
		if($type < 1 || $type > 4) exit('-1');
		$module_array = json_decode($this->parent_module,true);
		//验证数据是否正确
		if($type != 4){
			if($module_array[$this->position] != $module_id) exit('-3');
		}else{
			if($module_array[$this->position] != 0) exit('-4');
		}
		//根据type执行删除
		if($type == 4){
			//如果是空行直接调用修改方法
			if($this->delete_parent_module()) exit('1');
			exit('0');
		}else{
			//如果是文章或者图片   删除数据
			if(!$this->module_model->delete_module($module_id))exit('0');
			//如果是图片    删除图片文件
			if($type == 2){
				$path = $this->path->get_path('module_img',$module_id);
				$this->files->del_d($path);//更新时先清除旧文件夹
			}
			//更新内容排序
			if($this->delete_parent_module()) exit('1');
			exit('0');
		}
	}
	
	//删除了一个module
	private function delete_parent_module(){
		$module_old_array = json_decode($this->parent_module,true);//原来的位置分组
		//删除一个单元
		unset($module_old_array[$this->position]);
		//清除所有key
		$tmp = array();
		foreach($module_old_array as $k=>$v){
			$tmp[] = $v;
		}
		//保存
		return $this->save_parent_module(json_encode($tmp));
	}
	
	//构建新的module
	private function add_module($module_id = 0){		
		$module_id = intval($module_id);
		$module_old = $this->parent_module;//原位置;
		if(!$module_old)$module_old = array();//转为数组
		else $module_old = json_decode($module_old,true);	
		$position = $this->position;//位置
		//组合新数组
		//如果是在开头插入
		if($position == 0){
			 array_unshift($module_old,$module_id);
			 $module = $module_old;
		//在末尾加入
		}else if($position == -1){
			 array_push($module_old,$module_id);
			 $module = $module_old;
		//在数组中间加入
		}else{
			$module = array();
			for($i=0;$i<count($module_old);$i++){
				//当前位置小于制定插入位置时
				if($i < $position){	
					$module[$i] = $module_old[$i];
				}else if($i == $position){
					$module[$i] = $module_id;
					$module[$i+1] = $module_old[$i];
				//当前位置大于指定插入位置时
				}else{
					$module[$i+1] = $module_old[$i];
				}
			}
		}
		//转为json字符串并且保存
		$module = json_encode($module);
		return $this->save_parent_module($module);
	}
	//保存新的模块内容
	private function save_parent_module($module = ''){
		if($this->parent != 'school'){
			return $this->module_model->save_parent_module($module,$this->parent,$this->parent_id);
		}else{
			return $this->module_model->save_parent_module_school($module,$this->school_type,$this->parent_id);
		}
	}
	
}