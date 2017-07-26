<?php
/*
 * 上传控制静态类
 */


class Path{
	//默认文件的地址
	private $default_path;
	
	public function __construct(){
		$this->default_path = 'assets'.DIR.'default'.DIR;
	}
	
	//配置文件
	public function path_conf(){
		$conf = array();
		//顶部banner
		$conf['top_banner_img']['path'] = 'top_banner_img';//文件路径
		$conf['top_banner_img']['path_type'] = 1;//需要ID的path
		$conf['top_banner_img']['verify'] = array();//验证参数
		$conf['top_banner_img']['verify']['type'] = array('jpg','jpeg','png','gif');//文件类型
		$conf['top_banner_img']['verify']['size'] = 2*1024*1024;//文件大小
		$conf['top_banner_img']['default'] = $this->default_path.'top_banner_img.jpg';//默认图
		
		//顶部介绍1
		$conf['top_intro_up_img']['path'] = 'top_intro_up_img';//文件路径
		$conf['top_intro_up_img']['path_type'] = 0;//不需要ID的path
		$conf['top_intro_up_img']['verify'] = array();//验证参数
		$conf['top_intro_up_img']['verify']['type'] = array('jpg','jpeg','png','gif');//文件类型
		$conf['top_intro_up_img']['verify']['size'] = 2*1024*1024;//文件大小
		$conf['top_intro_up_img']['default'] = $this->default_path.'top_banner_img.jpg';//默认图		
		$conf['top_intro_down_img']['path'] = 'top_intro_down_img';//文件路径
		$conf['top_intro_down_img']['path_type'] = 0;//不需要ID的path
		$conf['top_intro_down_img']['verify'] = array();//验证参数
		$conf['top_intro_down_img']['verify']['type'] = array('jpg','jpeg','png','gif');//文件类型
		$conf['top_intro_down_img']['verify']['size'] = 2*1024*1024;//文件大小
		$conf['top_intro_down_img']['default'] = $this->default_path.'top_banner_img.jpg';//默认图
		
		//学校分类
		$conf['school_category_img']['path'] = 'school_category_img';//文件路径
		$conf['school_category_img']['path_type'] = 1;//需要ID的path
		$conf['school_category_img']['verify'] = array();//验证参数
		$conf['school_category_img']['verify']['type'] = array('jpg','jpeg','png','gif');//文件类型
		$conf['school_category_img']['verify']['size'] = 2*1024*1024;//文件大小
		$conf['school_category_img']['default'] = $this->default_path.'top_banner_img.jpg';//默认图
		//学校分类图片的MouseOver
		$conf['school_category_cover_img']['path'] = 'school_category_cover_img';//文件路径
		$conf['school_category_cover_img']['path_type'] = 1;//需要ID的path
		$conf['school_category_cover_img']['verify'] = array();//验证参数
		$conf['school_category_cover_img']['verify']['type'] = array('jpg','jpeg','png','gif');//文件类型
		$conf['school_category_cover_img']['verify']['size'] = 2*1024*1024;//文件大小
		$conf['school_category_cover_img']['default'] = $this->default_path.'top_banner_img.jpg';//默认图
		
		//申请流程介绍
		$conf['apply_intro_img']['path'] = 'apply_intro_img';//文件路径
		$conf['apply_intro_img']['path_type'] = 0;//不需要ID的path
		$conf['apply_intro_img']['verify'] = array();//验证参数
		$conf['apply_intro_img']['verify']['type'] = array('jpg','jpeg','png','gif');//文件类型
		$conf['apply_intro_img']['verify']['size'] = 2*1024*1024;//文件大小
		$conf['apply_intro_img']['default'] = $this->default_path.'top_banner_img.jpg';//默认图
		
		//发帖分类
		$conf['article_category_img']['path'] = 'article_category_img';//文件路径
		$conf['article_category_img']['path_type'] = 1;//需要ID的path
		$conf['article_category_img']['verify'] = array();//验证参数
		$conf['article_category_img']['verify']['type'] = array('jpg','jpeg','png','gif');//文件类型
		$conf['article_category_img']['verify']['size'] = 2*1024*1024;//文件大小
		$conf['article_category_img']['default'] = $this->default_path.'top_banner_img.jpg';//默认图
		
		//底部广告
		$conf['btm_advert_img']['path'] = 'btm_advert_img';//文件路径
		$conf['btm_advert_img']['path_type'] = 1;//需要ID的path
		$conf['btm_advert_img']['verify'] = array();//验证参数
		$conf['btm_advert_img']['verify']['type'] = array('jpg','jpeg','png','gif');//文件类型
		$conf['btm_advert_img']['verify']['size'] = 2*1024*1024;//文件大小
		$conf['btm_advert_img']['default'] = $this->default_path.'top_banner_img.jpg';//默认图
		
		//底部滚动广告
		$conf['btm_marquee_img']['path'] = 'btm_marquee_img';//文件路径
		$conf['btm_marquee_img']['path_type'] = 1;//需要ID的path
		$conf['btm_marquee_img']['verify'] = array();//验证参数
		$conf['btm_marquee_img']['verify']['type'] = array('jpg','jpeg','png','gif');//文件类型
		$conf['btm_marquee_img']['verify']['size'] = 2*1024*1024;//文件大小
		$conf['btm_marquee_img']['default'] = $this->default_path.'top_banner_img.jpg';//默认图
		
		//经验分享
		$conf['exp_share_img']['path'] = 'exp_share_img';//文件路径
		$conf['exp_share_img']['path_type'] = 1;//需要ID的path
		$conf['exp_share_img']['verify'] = array();//验证参数
		$conf['exp_share_img']['verify']['type'] = array('jpg','jpeg','png','gif');//文件类型
		$conf['exp_share_img']['verify']['size'] = 2*1024*1024;//文件大小
		$conf['exp_share_img']['default'] = $this->default_path.'top_banner_img.jpg';//默认图
		
		//学校介绍
		$conf['school_img']['path'] = 'school_img';//文件路径
		$conf['school_img']['path_type'] = 1;//需要ID的path
		$conf['school_img']['verify'] = array();//验证参数
		$conf['school_img']['verify']['type'] = array('jpg','jpeg','png','gif');//文件类型
		$conf['school_img']['verify']['size'] = 2*1024*1024;//文件大小
		$conf['school_img']['default'] = $this->default_path.'top_banner_img.jpg';//默认图
		
		$conf['article_img']['path'] = 'article_img';//文件路径
		$conf['article_img']['path_type'] = 1;//需要ID的path
		$conf['article_img']['verify'] = array();//验证参数
		$conf['article_img']['verify']['type'] = array('jpg','jpeg','png','gif');//文件类型
		$conf['article_img']['verify']['size'] = 2*1024*1024;//文件大小
		$conf['article_img']['default'] = $this->default_path.'top_banner_img.jpg';//默认图

		//文章配图
		$conf['module_img']['path'] = 'module_img';//文件路径
		$conf['module_img']['path_type'] = 1;//需要ID的path
		$conf['module_img']['verify'] = array();//验证参数
		$conf['module_img']['verify']['type'] = array('jpg','jpeg','png','gif');//文件类型
		$conf['module_img']['verify']['size'] = 2*1024*1024;//文件大小
		$conf['module_img']['default'] = $this->default_path.'top_banner_img.jpg';//默认图
		
		//LOGO
		$conf['head_logo']['path'] = 'head_logo';//文件路径
		$conf['head_logo']['path_type'] = 0;//需要ID的path
		$conf['head_logo']['verify'] = array();//验证参数
		$conf['head_logo']['verify']['type'] = array('jpg','jpeg','png','gif');//文件类型
		$conf['head_logo']['verify']['size'] = 2*1024*1024;//文件大小
		$conf['head_logo']['default'] = $this->default_path.'top_banner_img.jpg';//默认图
		
		//底部LOGO
		$conf['foot_logo']['path'] = 'foot_logo';//文件路径
		$conf['foot_logo']['path_type'] = 0;//需要ID的path
		$conf['foot_logo']['verify'] = array();//验证参数
		$conf['foot_logo']['verify']['type'] = array('jpg','jpeg','png','gif');//文件类型
		$conf['foot_logo']['verify']['size'] = 2*1024*1024;//文件大小
		$conf['foot_logo']['default'] = $this->default_path.'top_banner_img.jpg';//默认图	
		
		$conf['foot_pt_img1']['path'] = 'foot_pt_img1';//文件路径
		$conf['foot_pt_img1']['path_type'] = 0;//需要ID的path
		$conf['foot_pt_img1']['verify'] = array();//验证参数
		$conf['foot_pt_img1']['verify']['type'] = array('jpg','jpeg','png','gif');//文件类型
		$conf['foot_pt_img1']['verify']['size'] = 2*1024*1024;//文件大小
		$conf['foot_pt_img1']['default'] = $this->default_path.'top_banner_img.jpg';//默认图
		
		$conf['foot_pt_img2']['path'] = 'foot_pt_img2';//文件路径
		$conf['foot_pt_img2']['path_type'] = 0;//需要ID的path
		$conf['foot_pt_img2']['verify'] = array();//验证参数
		$conf['foot_pt_img2']['verify']['type'] = array('jpg','jpeg','png','gif');//文件类型
		$conf['foot_pt_img2']['verify']['size'] = 2*1024*1024;//文件大小
		$conf['foot_pt_img2']['default'] = $this->default_path.'top_banner_img.jpg';//默认图
		//视频
		$conf['video_img']['path'] = 'video_img';//文件路径
		$conf['video_img']['path_type'] = 1;//需要ID的path
		$conf['video_img']['verify'] = array();//验证参数
		$conf['video_img']['verify']['type'] = array('jpg','jpeg','png','gif');//文件类型
		$conf['video_img']['verify']['size'] = 2*1024*1024;//文件大小
		$conf['video_img']['default'] = $this->default_path.'top_banner_img.jpg';//默认图
		return $conf;
	}
	
	//获取文件配置
	public function get_conf($type =''){
		if(!$type) return false;
		$conf = $this->path_conf();
		if(!isset($conf[$type])) return false;
		return $conf[$type]['verify'];		
	}
	
	//获取一个随机文件名
	public function get_rand_name($ext = ''){
		if(strlen($ext) != 3) return false;
		return time().rand(100000,999999).'.'.$ext;
	}
	
	//获取管理员的临时路径
	public function admin_path($admin_id = 0){
		$admin_id = intval($admin_id);
		if($admin_id < 1) return false;
		return PATH.DIR.UPLOAD.DIR.'admin_temp'.DIR.$admin_id.DIR;
	}
	//获取公共临时路径
	public function user_path($user_id = 0){
		$user_id = intval($user_id);
		if($user_id < 1) return false;
		return PATH.DIR.UPLOAD.DIR.'user_temp'.DIR.$user_id.DIR;
	}
	//系统路径和URL转换
	public function path_to_url($save_path = ''){
		if(STORAGE_SYSTEM == 'disk') return str_replace(PATH,base_url(),$save_path);
		//oss系统
		else if(STORAGE_SYSTEM == 'oss'){
			//获取系统框架副本
			$ci =& get_instance();
			$ci->load->config('oss_access');
			$oss_config = $ci->config->item('oss_access');
			$url = 'http://'.$oss_config['bucket'].'.'.$oss_config['host_out'];//外网访问地址
			return str_replace(PATH,$url,$save_path);
		}else{
			return false;
		}
	}		
	//获取系统路径
	public function get_path($type = '',$id = 0){
		if(!$type) return false;
		$conf = $this->path_conf();
		if(!isset($conf[$type])) return false;
		$upload_path = PATH.DIR.UPLOAD.DIR.$conf[$type]['path'].DIR;//上传主路径
		if($conf[$type]['path_type'] == 1){
			//如果是需要ID的path
			$id = intval($id);
			if($id < 1) return false;
			return $upload_path.$id.DIR;
		}else{
			return $upload_path;
		}
	}
	
	//获取url
	public function get_url($filename = '',$type = '',$id = 0){
		if(!$type) return false;
		$conf = $this->path_conf();
		if(!isset($conf[$type])) return false;
		
		//获取系统框架副本
		$ci =& get_instance();
		//检查文件系统类型
		if(STORAGE_SYSTEM == 'oss'){
			$ci->load->config('oss_access');
			$oss_config = $ci->config->item('oss_access');
			$url = 'http://'.$oss_config['bucket'].'.'.$oss_config['host_out'].DIR;//外网访问地址
		}else if(STORAGE_SYSTEM == 'disk'){
			$url = base_url();			
		}else{
			return false;
		}
		
		if($conf[$type]['path_type'] == 1){
			//如果是需要ID的path
			$id = intval($id);
			if($id < 1) return false;
			//文件路径
			$file_path = PATH.DIR.UPLOAD.DIR.$conf[$type]['path'].DIR.$id.DIR.$filename;//上传主路径
			$file_url = $url.UPLOAD.DIR.$conf[$type]['path'].DIR.$id.DIR.$filename;//文件url
		}else{
			$file_path = PATH.DIR.UPLOAD.DIR.$conf[$type]['path'].DIR.$filename;//上传主路径
			$file_url =  $url.UPLOAD.DIR.$conf[$type]['path'].DIR.$filename;
		}
		//检查文件是否存在。如果不存在。使用默认图片
		if($ci->files->is_f($file_path)) return $file_url;
		return $url.$conf[$type]['default'];
	}
	//获取默认图片url
	public function get_default($type=''){
		if(!$type) return false;
		$conf = $this->path_conf();
		if(!isset($conf[$type])) return false;
		
		//获取系统框架副本
		$ci =& get_instance();
		//检查文件系统类型
		if(STORAGE_SYSTEM == 'oss'){
			$ci->load->config('oss_access');
			$oss_config = $ci->config->item('oss_access');
			$url = 'http://'.$oss_config['bucket'].'.'.$oss_config['host_out'].DIR;//外网访问地址
		}else if(STORAGE_SYSTEM == 'disk'){
			$url = base_url();
		}else{
			return false;
		}
		return $url.$conf[$type]['default'];		
	}
	
	
}