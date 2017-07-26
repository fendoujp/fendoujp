<?php

class Log {
	
	//log句柄
	private $handle;
	//日期
	private $date;
	//时分秒
	private $his;
	//log路径
	private $log_path;
	
	public function __construct($params = array()){
		//尝试获取logname
		$logname = @$params['logname'];
		if(!$logname) exit('must have a logname');
		$this->date = date(DATE_YMD,time());
		$this->log_file_name = date("Y-m-d-H",time());//每小时写一个文件
		$this->his = date(DATE_YMDHIS,time());
		$this->log_path = PATH.'/log/'.$logname;
		//不存在log文件夹，创建log文件夹
		if(!is_dir($this->log_path)){
			if(!mkdir($this->log_path)) exit('cannot make log dir');
		}
	}
	//log开始
	public function start(){
		$this->handle = fopen($this->log_path.'/'.$this->log_file_name.'.log','a+');
		if(!$this->handle) exit('cannot start a log file =>'.$this->log_path.'/'.$this->date.'.log');
		//空行
		$this->eol();
		//log开始时间
		$this->w('----------LogStart----------'.$this->his.'----------');
		return true;
	}
	
	//换行
	private function eol(){
		fwrite($this->handle,PHP_EOL);
		return true;
	}
	
	//log写
	public function w($contents = ''){
		//换行
		$this->eol();
		fwrite($this->handle,$contents);
		return true;
	}
	
	//log写一个数字
	public function w_array($data = array()){
		if($data){
			foreach($data as $k=>$v){
				$this->w($k.' => '.$v);
			}
		}
	}
	
	//log结束
	public function end(){
		//log结束时间
		$this->w('----------LogEnd----------'.$this->his.'----------');
		fclose($this->handle);
	}
}