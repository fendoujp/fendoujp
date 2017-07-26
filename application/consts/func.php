<?php

/*
 * 公共静态类 方法
 * MyDivine
 */

class func{
	
	/**重要**/
	static public function res_url(){
		return base_url();
	}
	//这条是返回 域名+index.php/ 如果URL改写，在index.php文件中直接将常量设置为''即可
	static public function loc_url(){
		return base_url().INDEXPHP;
	}
	
	//show 404
	static public function show_404(){
		redirect('error');
	}
	//根据consts的 TYPE和VALUE 获取TEXT
	static public function get_const_text($type ='',$value = 0,$name = 0){
		$value = intval($value);
		if(!$type || !$value) return False;
		$function = 'get_const_'.$type;
		$name = intval($name);/////获取级联的test level时才使用
		$consts = consts::$function($name);
		foreach($consts as $k=>$v){
			if($v['value'] == $value) return $v['text'];
		}
		return False;
	}
	
	//获取子nemu
	//con 控制器名  fun 方法名
	//primary = 当前选中
	static public function get_sub_menu($route=array(),$menu_array=array(),$primary='index'){
		$con = $route['con'];//控制器
		$fun = $route['fun'];//方法
		//菜单数组格式如下
		/*
		$menu_array = array();
		$menu_array['index'] = '首页总览';
		$menu_array['top_banner_list'] = '顶部广告';
		$menu_array['top_intro'] = '顶部介绍';
		*/
		//位置文言
		$position = '';
		//菜单部分
		$menu = '<div class="btn-group" role="group" aria-label="...">';
		foreach($menu_array as $k=>$v){
			$menu .= '<button type="button" ';
			if($primary == $k){
				//选中的状态
				$menu .= 'class="btn btn-primary" ';
				$position = $v;//位置文言
			}
			else $menu .= 'class="btn btn-default" ';
			$menu .= 'id="submenu_'.$k.'">'.$v.'</button>';
		}
		$menu .= '</div>';
		$menu .= '<br>';
		//跳转部分
		//url
		$url = func::loc_url().$con.'/';
		$menu .= '<script>';
		foreach($menu_array as $k=>$v){
			$menu .= '$("#submenu_'.$k.'").click(function(){
							window.location="'.$url.$k.'";
						});';
		}
		$menu .= '</script>';
		return array('menu_html'=>$menu,'position'=>$position);
	}
	
	//处理模版转移
	//参数1 需要转移的字符串
	//参数2 规则  array(array('from'=>'(hh)','to'=>'<br />'),array() ....);
	static public function trans($str='',$rule = array()){
		foreach($rule as $k=>$v){
			$str = str_replace($v['from'], $v['to'], $str);
		}
		return $str;
	}
	
	//获取现在时间
	static public function now($short = false){
		if(!$short)	return date(DATE_YMDHIS,time());
		return date(DATE_YMD,time());
	}
	
	//时间戳转时间
	static public function datetime($timestamp = 0,$time=false){
		if($time) return date(DATE_YMDHIS,$timestamp);
		return date(DATE_YMD,$timestamp);
	}
	
	//debug
	static public function debug(){
		$ci =& get_instance();
		header("Content-type:text/html;charset=utf-8");
		echo '<pre>';
		print_r($ci->info);
	}

	//输出csv
	static public function export_csv($filename,$data){
		header("Content-type:text/csv");   
	    header("Content-Disposition:attachment;filename=".$filename.".csv");   
	    header('Cache-Control:must-revalidate,post-check=0,pre-check=0');   
	    header('Expires:0');   
	    header('Pragma:public');   
    	echo $data;
	}
	
	/*
	 * 校验日期格式是否正确
	 *
	 * @param string $date 日期
	 * @param string $formats 需要检验的格式数组
	 * @return boolean
	*/
	static public function check_date($date,$his=false){
		$unixTime = strtotime($date);
		if (!$unixTime) { //strtotime转换不对，日期格式显然不对。
			return false;
		}
		if(!$his){
			if (date(DATE_YMD, $unixTime) == $date) {
				return true;
			}
		}else{
			if(date(DATE_YMDHIS,$unixTime) == $date){
				return true;
			}
		}
		return false;
	}
	//检查小时:分钟 是否正确
	static public function check_hs($hs = ''){
		//检查小时和分钟
		$time = explode(':',$hs);
		if(!is_array($time) || count($time) != 2) return false;
		//小时 0-23
		if(!is_numeric($time[0]) || $time[0] > 23) return false;
		//分钟00-59
		if(!preg_match('/^[0-5]{1}[0-9]{1}$/',$time[1])) return false;
		
		return true;
	}
	//将价钱的 .00去掉
	static public function price($str = ''){
		return str_replace('.00','',$str);
	}
	//过滤  ' " | _
	static public function item_name_filter($str =''){
		if(strpos($str,'\'') !== false) return false;
		if(strpos($str,'"') !== false) return false;
		if(strpos($str,'|') !== false) return false;
		if(strpos($str,'_') !== false) return false;
		return true;
	}
	//身份证算法
	/*
	 *  一. 将前面的身份证号码17位数分别乘以不同的系数。从第一位到第十七位的系数分别为：7 9 10 5 8 4 2 1 6 3 7 9 10 5 8 4 2 
		二. 将这17位数字和系数相乘的结果相加。 
		三. 用加出来和除以11，看余数是多少？ 
		四. 余数只可能有0 1 2 3 4 5 6 7 8 9 10这11个数字。其分别对应的最后一位身份证的号码为1 0 X 9 8 7 6 5 4 3 2。 
	 */
	static public function check_idcard($str = ''){
		if(strlen($str) != 18)return false;
		for($i=0;$i<18;$i++){
			if($i < 17){
				if(!preg_match('/^[0-9]{1}$/',$str[$i])) return false;
			}else{
				if(strtolower($str[17]) != 'x' && !preg_match('/^[0-9]{1}$/',$str[$i])) return false;
			}
		}
		//基本验证通过
		$xishu = array(7,9,10,5,8,4,2,1,6,3,7,9,10,5,8,4,2);
		$total = 0;
		for($i=0;$i<17;$i++){
			$total += $str[$i]*$xishu[$i];
		}		
		$mod = $total%11;
		$result = array(1,0,'x',9,8,7,6,5,4,3,2);
		if(strtolower($str[17]) == $result[$mod]) return true;
		return false;		
	}
	
	
}