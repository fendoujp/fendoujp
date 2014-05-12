<?php
// +--------------------------------------------
// | 文章列表控制器
// | author:LMing
// +--------------------------------------------

$t = gets('t');
if(empty($t)) $t = 'index';
$class_id = gets('class_id');
$class_first = 0; //一级栏目

// 递归查找一级栏目
$cid = 0;
function class_first($id){
  global $cid;
  $r = class_info($id);
  if($r['class_depth']>1){
    class_first($r['parent_id']);
  }else{
    $cid = $id;
  }
  return $cid;
}

$class_data = class_info($class_id);
if($class_data['class_depth']==1){
  $class_first = $class_id;
}elseif($class_data['class_depth']>1){
  $class_first = class_first($class_id);
}

if(!empty($class_data['s_name'])) $webinfo['s_name'] = $class_data['s_name'];
if(!empty($class_data['s_keywords'])) $webinfo['s_keywords'] = $class_data['s_keywords'];
if(!empty($class_data['s_description'])) $webinfo['s_description'] = $class_data['s_description'];

switch($t){
  case 'single':
    $sql = "select * from info where classid=".$class_id." limit 1";
    $single_arr = getLiAll($sql);
    $single = $single_arr[0];
    if(!empty($single['s_keywords'])) $webinfo['s_keywords'] = $single['s_keywords'];
    if(!empty($single['s_description'])) $webinfo['s_description'] = $single['s_description'];
    include(TPL_PATH."head.php");
    include(TPL_PATH."single.php");
    include(TPL_PATH."foot.php");
  break;
  case 'photo':
    $sql = "select * from p_main where classid=".$class_id." order by s_order asc,s_time desc, id desc limit 8";
    $photo = getLiAll($sql);
    include(TPL_PATH."head.php");
    include(TPL_PATH."photo.php");
    include(TPL_PATH."foot.php");
  break;
  case 'news':
    $num = $class_id==40 ? 20 : 8;
    $sql = "select * from a_main where classid=".$class_id." order by s_order asc,s_time desc, id desc limit ".$num;
    $news = getLiAll($sql);
    include(TPL_PATH."head.php");
    if($class_id==40) include(TPL_PATH."quertion.php");
    else include(TPL_PATH."news.php");
    include(TPL_PATH."foot.php");
  break;
  case 'school':
    $sql = "select * from a_main where classid=".$class_id." order by s_order asc,s_time desc, id desc limit 24";
    $school = getLiAll($sql);
    include(TPL_PATH."head.php");
    include(TPL_PATH."school.php");
    include(TPL_PATH."foot.php");
  break;
  case 'signup':
    include(TPL_PATH."head.php");
    include(TPL_PATH."signup.php");
    include(TPL_PATH."foot.php");
  break;
  case 'signup_save':
    $data   = gets('data');
    $fields = "classid,s_type,";
    $values = $class_id.",'".$class_data['s_type']."',";
    foreach($data as $key=>$val){
      $fields .= $key.",";
      $values .= "'".$val."',";
    }
    $fields .= "date";
    $values .= time();
    $sqlStr = "insert into lm_signup (".$fields.") values (".$values.")";
    $dd = new db;
    $rsult = $dd->setQuser($sqlStr);
    $result = mysql_affected_rows();
    $dd->closeDb();
    $str = $result>0 ? "报名成功" : "报名失败";
    message_show("/signup-list-".$class_id.".html",$str,1500);
  break;
}
?>