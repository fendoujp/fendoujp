<?php
// +--------------------------------------------
// | 公用函数文件
// | author:LMing
// +--------------------------------------------
/**
 * GPC过滤，自动转义$_GET，$_POST，$_COOKIE中的特殊字符，防止SQL注入攻击
 */
function saddslashes($string){
	if(is_array($string)){
		foreach($string as $key => $val){
			$string[$key] = saddslashes($val);
		}
	}else{
		$string = addslashes($string);
	}
	return $string;
}
/**
 * 自动识别post get
 */
function gets($text){
	$text1 = '';
	if($text != ''){
		$text1 = $_GET[$text];
		$text2 = $_POST[$text];
		if($text2 != ''){
			$text1 = $text2;
		}
	}
	//防止重复转义
	if(!get_magic_quotes_gpc()){
		$text1 = saddslashes($text1);
	}
	return $text1;
}
/**
 * 生成内部链接
 */
function cover_link($type,$id){
	$link = '';
	switch($type){
		case '1'://栏目链接
			$link = class_link($id);
		break;
		case '2'://新闻链接
			$link = news_link($id);
		break;
		case '3'://照片链接
			$link = photo_link($id);
		break;
		case '4'://院校链接
			$link = school_link($id);
		break;
	}
	return $link;
}
/**
 * 栏目链接
 */
function class_link($id){
	$sql = "select * from lm_classify where id=".$id;
	$arr = getLiAll($sql);
	if($arr[0]['s_url']==""){
		$link = $arr[0]['s_type']."-list-".$id.".html";
	}else{
		$link = $arr[0]['s_url'];
	}
	//$link = "/index.php?a=article&t=".$arr[0]['s_type']."&class_id=".$id;
	return $link;
}
/**
 * 新闻链接
 */
function news_link($id){
	$link = "news-view-".$id.".html";
	//$link = "/index.php?a=detail&t=news&id=".$id;
	return $link;
}
/**
 * 照片链接
 */
function photo_link($id){
	$link = "photo-view-".$id.".html";
	//$link = "/index.php?a=detail&t=photo&id=".$id;
	return $link;
}
/**
 * 院校链接
 */
function school_link($id){
	$link = "school-view-".$id.".html";
	//$link = "/index.php?a=detail&t=school&id=".$id;
	return $link;
}
/**
 * 指定ID 调子类
 */
function class_info($id){
	$arr = array();
	if(!empty($id)){
		$arr = getLiAll("select * from lm_classify where id=".$id."");
	}
	return $arr[0];
}
/**
 * 指定ID 调子类
 */
function subclass($id){
	$arr = array();
	if(!empty($id)){
		$arr = getLiAll("select * from lm_classify where parent_id=".$id." order by s_order asc,id asc");
	}
	return $arr;
}
/**
 * 指定ID 调文章列表
 */
function news_info($id,$num=1){
	$arr = array();
	if(!empty($id)){
		$arr = getLiAll("select * from a_main where classid=".$id." order by s_order asc,s_time desc,id desc limit ".$num);
	}
	return $arr;
}
/**
 * 判断是否有子类
 */
function is_subclass($id){
	$result = false;
	if(!empty($id)){
		$arr = subclass($id);
		if(!empty($arr)) $result = true;
	}
	return $result;
}
/**
 * 递归当前路径
 */
function crumb_recur($id){
  global $crumb_arr;
  $r = class_info($id);
  if($r['class_depth']>1){
    $crumb_arr['id'][] = $r['id'];
    $crumb_arr['name'][] = $r['s_name'];
		$crumb_arr['url'][]  = cover_link(1,$r['id']);
		crumb_recur($r['parent_id']);
  }else{
  	$crumb_arr['id'][] = $r['id'];
    $crumb_arr['name'][] = $r['s_name'];
    $crumb_arr['url'][]  = cover_link(1,$r['id']);
    $crumb_arr['id'][] = 0;
		$crumb_arr['name'][] = "首页";
		$crumb_arr['url'][]  = "/";
  }
  return $crumb_arr;
}
/**
 * 面包屑
 */
function crumb($id){
	$arr  = crumb_recur($id);
	$arr2 = array();
	foreach($arr as $key=>$val){
		foreach($val as $k=>$v){
			$arr2[$k][$key]=$v;
		}
	}
	return array_reverse($arr2);
}
/**
 * 日期转换
 */
function cover_time($format,$str){
	$time = '';
	if($str != ''){
		$time = date($format,strtotime($str));
	}
	return $time;
}
/**
 * 更新点击数
 */
function update_hits($type,$id){
	switch ($type) {
		case 'news':
			$arr  = getLiAll("select * from a_main where id=".$id."");
			$hits = $arr[0]['s_read']+1;
			$sql  = "update a_main set s_read=".$hits." where id=".$id;
			$db = new db;
			$db->setQuser($sql);
			$db->closeDb();
		break;
		case 'photo':
			$arr  = getLiAll("select * from p_main where id=".$id."");
			$hits = $arr[0]['s_read']+1;
			$sql  = "update p_main set s_read=".$hits." where id=".$id;
			$db = new db;
			$db->setQuser($sql);
			$db->closeDb();
		break;
	}
}
/**
 * 上一篇
 */
function a_prev($type,$id,$where){
	$result = '';
	switch ($type) {
		case 'news':
			$sql = "select * from a_main where s_type='news'";
			if($where != '') $sql .= " and ".$where;
			$sql .= " order by s_order asc,s_time desc,id desc";
			$arr    = getLiAll($sql);
			$previd = '';
			foreach($arr as $k=>$v){
				if($v['id']!=$id) $previd = $v['id'];
				else break;
			}
			if(!empty($previd)){
				$arr2   = getLiAll("select * from a_main where id=".$previd."");
				$result = '上一篇：<a href="'.cover_link(2,$arr2[0]['id']).'">'.$arr2[0]['s_name'].'</a>';
			}
		break;
		case 'photo':
			$sql = "select * from p_main where s_type='photo'";
			if($where != '') $sql .= " and ".$where;
			$sql .= " order by s_order asc,s_time desc,id desc";
			$arr    = getLiAll($sql);
			$previd = '';
			foreach($arr as $k=>$v){
				if($v['id']!=$id) $previd = $v['id'];
				else break;
			}
			if(!empty($previd)){
				$arr2   = getLiAll("select * from p_main where id=".$previd."");
				$result = '上一篇：<a href="'.cover_link(3,$arr2[0]['id']).'">'.$arr2[0]['s_name'].'</a>';
			}
		break;
	}
	return $result;
}
/**
 * 下一篇
 */
function a_next($type,$id,$where){
	$retrun = '';
	switch ($type) {
		case 'news':
			$sql = "select * from a_main where s_type='news'";
			if($where != '') $sql .= " and ".$where;
			$sql .= " order by s_order asc,s_time desc,id desc";
			$arr  = getLiAll($sql);
			$temp = false;
			foreach($arr as $k=>$v){
				if($temp){
					$nextid = $v['id'];
					break;
				}
				if($v['id']==$id) $temp = true;
			}
			if(!empty($nextid)){
				$arr2   = getLiAll("select * from a_main where id=".$nextid."");
				$return = '下一篇：<a href="'.cover_link(2,$arr2[0]['id']).'">'.$arr2[0]['s_name'].'</a>';
			}
		break;
		case 'photo':
			$sql = "select * from p_main where s_type='photo'";
			if($where != '') $sql .= " and ".$where;
			$sql .= " order by s_order asc,s_time desc,id desc";
			$arr  = getLiAll($sql);
			$temp = false;
			foreach($arr as $k=>$v){
				if($temp){
					$nextid = $v['id'];
					break;
				}
				if($v['id']==$id) $temp = true;
			}
			if(!empty($nextid)){
				$arr2   = getLiAll("select * from p_main where id=".$nextid."");
				$return = '下一篇：<a href="'.cover_link(3,$arr2[0]['id']).'">'.$arr2[0]['s_name'].'</a>';
			}
		break;
	}
	return $return;
}
function message_show($url,$msg,$time){
	$str = '
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv=Content-Type content="text/html; charset=utf-8" />
		<title>操作提示</title>
		<style type="text/css">.msg_page{width:400px;height:200px; margin:150px auto 0;text-align:center; border:3px solid #ccc;background:#eee}</style>
		</head>
		<body>
		<div class="msg_page"><br /><p>'.$msg.'</p><p>'.($time/1000).'秒后自动跳转</p><p><a href="'.$url.'">立即跳转</a></p></div>
		<script type="text/javascript">setTimeout(function(){window.location.href="'.$url.'";},'.$time.');</script>
		</body>
		</html>
	';
	echo $str;
}
?>