<?php
header("Content-Type: text/html; charset=utf-8");
session_start();
include("../../inc/publicfunction.php");
include("../../inc/functions.php");
$id   = gets('id');
$a    = gets('a');
$data = gets('data');

function gpimg($text){
  return (str_replace("../","",gp($text)));
}

if($a == "edit_save"){
  $parent_str = $data['parent'];
  $parent_arr = explode("_",$parent_str);
  $data['parent_id']   = $parent_arr[0];
  $data['class_depth'] = $parent_arr[1]+1;
  $s_img = gpimg('s_img');
  $sqlStr = "update lm_classify set s_name='".$data["s_name"]."',s_url='".$data["s_url"]."',s_target=".$data["s_target"].",s_name1='".$data["s_name1"]."',s_type='".$data["s_type"]."',parent_id='".$data["parent_id"]."',class_depth='".$data["class_depth"]."',s_img='".$s_img."' where id=".$id;
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
if($id!=''){
  $arr = getLiAll("select * from lm_classify where id=".$id);
  $class = $arr[0];
}else{
  $class = array();
}
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
  <div class="title">修改分类</div>
  <form method="post" action="<?php echo getUrl();?>" id="forms" name="forms">
  <input type="hidden" name="a" value="edit_save" />
  <input type="hidden" name="id" value="<?php echo $id;?>" />
	<dl>
    <dt>名称：</dt>
    <dd><input type="text" name="data[s_name]" value="<?php echo $class['s_name'];?>" /></dd>
    <dd class="clear"></dd>
  </dl>
  <dl style="display:none;">
    <dt>别名：</dt>
    <dd><input type="text" name="data[s_name1]" value="<?php echo $class['s_name1'];?>" /></dd>
    <dd class="clear"></dd>
  </dl>
  <dl>
    <dt>类型：</dt>
    <dd><input type="text" name="data[s_type]" value="<?php echo $class['s_type'];?>" /></dd>
    <dd class="clear"></dd>
  </dl>
  <dl>
    <dt>外部链接：</dt>
    <dd><input type="text" name="data[s_url]" value="<?php echo $class['s_url'];?>" size="60" /></dd>
    <dd class="clear"></dd>
  </dl>
  <dl>
    <dt>打开方式：</dt>
    <dd><input type="radio" style="vertical-align:middle"<?php if($class['s_target']==0)echo' checked="checked"';?> name="data[s_target]" value="0" />原窗口&nbsp;&nbsp;&nbsp;&nbsp;<input style="vertical-align:middle"<?php if($class['s_target']==1)echo' checked="checked"';?> type="radio" name="data[s_target]" value="1" />新窗口</dd>
    <dd class="clear"></dd>
  </dl>
  <dl>
    <dt>父级：</dt>
    <dd>
      <select name="data[parent]">
      <option value="0_0">一级分类</option>
      <?php foreach($list_arr as $k=>$v){?>
        <option value="<?php echo $v['id'];?>_<?php echo $v['class_depth'];?>"<?php if($v['id']==$class['parent_id'])echo' selected="selected"';?>>├<?php for($i=1;$i<$v['class_depth'];$i++){echo'─';}?><?php echo $v['s_name'];?></option>
      <?php }?>
      </select>
    </dd>
    <dd class="clear"></dd>
  </dl>
  <dl>
    <dt>图片：<?php if($class["s_img"]!='')echo'<img src="../../'.$class["s_img"].'" width="22" height="22" style="vertical-align:middle" />';?></dt>
    <dd><?php echo upload("s_img",$class["s_img"]);?></dd>
    <dd class="clear"></dd>
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