<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 系统机器人
 * MyDivine
 * 2015-08-11
 */

class Sys_robot extends CI_Controller{
	
	//构造方法--检查是否来自系统的调用	
	public function __construct(){
		parent::__construct();
		
		if(@count($_SERVER['argv']) != 3){
			exit('access failed');
		}
		
	}
	
	public function index(){
		exit('-1');
	}
	
	////batch 更新汇率 因为目前只有一个BATCH 暂时放在这里  每天晚上跑1次就行
	public function batch_rate(){
		$url = 'https://query.yahooapis.com/v1/public/'.
				'yql?q=select%20*%20from%20yahoo.finance.'.
				'xchange%20where%20pair%20in%20(%22CNYJPY%22)'.
				'&format=json&diagnostics=true&env=store%3A%2F'.
				'%2Fdatatables.org%2Falltableswithkeys&callback=';
		$rate = file_get_contents($url);
		$rate = json_decode($rate,true);
		if(@$rate['query']['results']['rate']['Rate'] > 0){
			$rate = $rate['query']['results']['rate']['Rate'];
			$rate = @round($rate,2);
			if($rate > 0){
				$this->load->model('setting_model');
				if($this->setting_model->update_rate($rate))exit('1');
				exit('0');
			}
		}
		exit('-1');
	}
		
}