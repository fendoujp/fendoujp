<?php
header("Content-Type: text/html; charset=utf-8");
session_start();
include("../../inc/publicfunction.php");
include("../../inc/functions.php");
$gid  = gets('id');
$a    = gets('a');
$data = gets('data');

if($a == "add_save"){
  $parent_str = $data['parent'];
  $parent_arr = explode("_",$parent_str);
  $data['parent_id']   = $parent_arr[0];
  $data['class_depth'] = $parent_arr[1]+1;
  $sqlStr = "insert into lm_classify (s_name,s_name1,s_type,parent_id,class_depth,s_time) values ('".$data["s_name"]."','".$data["s_name1"]."','".$data["s_type"]."','".$data["parent_id"]."','".$data["class_depth"]."','".date("Y-m-d H:i:s")."')";
  $dd = new db;
  $rsult = $dd->setQuser($sqlStr);
  $dd->closeDb();
}
$classify_list = getLiAll("select * from lm_classify where 1=1 order by s_order asc,id asc");
$class_arr = array();
function class_func($parent_id=0){
  global $classify_list,$class_arr;
  foreach($classify_list as $k=>$v){
    if($v['parent_id']==$parent_id){
       $class_arr[] = $v;
       class_func($v['id']);
    }
  }
  return $class_arr;
}
$list_arr = class_func();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站后台管理系统</title>
<link href="../style/systemright.css" rel="stylesheet" type="text/css" />
<!--[if lt IE 8]><script src="../style/IE8.js" ></script><![endif]-->
<script src="../js/public.js"></script>
<?php include("../checksession2.php");?>
</head>
<body style="height:auto;">
<div class="wrapper">
  <div class="title">添加分类</div>
  <form method="post" action="<?php echo getUrl();?>" id="forms" name="forms">
  <input type="hidden" name="a" value="add_save" />
	<dl>
    <dt>名称：</dt>
    <dd><input type="text" name="data[s_name]" /></dd>
    <dd class="clear"></dd>
  </dl>
  <dl style="display:none;">
    <dt>别名：</dt>
    <dd><input type="text" name="data[s_name1]" /></dd>
    <dd class="clear"></dd>
  </dl>
  <dl>
    <dt>类型：</dt>
    <dd><input type="text" name="data[s_type]" /></dd>
    <dd class="clear"></dd>
  </dl>
  <dl>
    <dt>父级：</dt>
    <dd>
      <select name="data[parent]">
      <option value="0_0">一级分类</option>
      <?php foreach($list_arr as $k=>$v){?>
        <option value="<?php echo $v['id'];?>_<?php echo $v['class_depth'];?>"<?php if($v['id']==$gid)echo' selected="selected"';?>>├<?php for($i=1;$i<$v['class_depth'];$i++){echo'─';}?><?php echo $v['s_name'];?></option>
      <?php }?>
      </select>
    </dd>
    <dd class="clear"></dd>
  </dl>
  <dl>
    <dt>&nbsp;</dt>
    <dd><input type="submit" value="保存" /></dd>
    <dd class="clear"></dd>
  </dl>
  </form>
</div>
</body>
</html>