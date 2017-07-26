<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

	private static $instance;
	
	var $info = array();//模板通用变量
	var $route = array();
		

	/**
	 * Constructor
	 */
	public function __construct()
	{
		self::$instance =& $this;

		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');

		$this->load->initialize();
		
		log_message('debug', "Controller Class Initialized");
		
		//路由信息绑定到模板
		$this->info['route'] =& $this->route;
		//捕获路由信息
		$this->route['con'] = $this->router->class;//控制器
		$this->route['fun'] = $this->router->method;//方法
		
		/*
		 * SESSION时间种子。如果超过30分钟自动清除SESSION
		 */
		$life_time = @$_SESSION[SESSION_NAME.'lifetime'];
		$life_time = intval($life_time);
		//如果SESSION没过期....
		if($life_time + 1800 >= time()){
			$_SESSION[SESSION_NAME.'lifetime'] = time();//更新lifetime
		}else{
			//如果已过期。清空SESSION
			$_SESSION = array();
			$_SESSION[SESSION_NAME.'lifetime'] = time();//更新lifetime
		}
		
		//加载const文件
		require_once PATH.DIR.'application'.DIR.'consts'.DIR.'consts.php';
		require_once PATH.DIR.'application'.DIR.'consts'.DIR.'func.php';
		require_once PATH.DIR.'application'.DIR.'consts'.DIR.'preg.php';		
	}

	public static function &get_instance()
	{
		return self::$instance;
	}
	
	//加载模板函数
	//模板地址 = view/控制器/方法
	public function v($ext = ''){
		$this->load->view($this->route['con'].DIR.$this->route['fun'].$ext,$this->info);
	}
	
	//加载错误提示信息
	//错误信息地址 = config/form_error_msg/控制器
	public function form_error_msg(){
		//获取表单错误文言配置
		$this->load->config('form_error_msg'.DIR.$this->route['con']);
		return $this->config->item('form_error_msg');
	}
	
}
// END Controller class

/* End of file Controller.php */
/* Location: ./system/core/Controller.php */