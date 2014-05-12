<? header("Content-Type: text/html; charset=utf-8");?>
<?php session_start();?>
<?php include("../../inc/publicfunction.php"); ?>
<?php include("../../inc/turepage.php"); ?>
<?
	$s_type = gg("s_type");
	$s_title = gg("title");
	$s_ok = gg("s_ok");
	$s_classtype=gg("s_classtype");
	$tableName = gg("tableName");
?>
<?
	function gv($cowName){
		$dd = new db();
		return 	($dd->get_one("book",$cowName,gg("id")));
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
<?php include("../checksession2.php")?>
<style></style>
</head>
<body  style="height:auto;">
<div>
	<div class="title"><?=$s_title?>管理</div>
    
<div  class="bacf1 borddd marbot10 pad5">

<input value="打印" type="button" onclick="window.print();" />
&nbsp;&nbsp;&nbsp;&nbsp;
<input value="返回" type="button" onclick="history.go(-1);" />
</div>
   
<table  id="tableLists" border="1">
	<tr><td width="13%">ID</td><td width="87%"><?=gg("id")?></td></tr>
    <tr><td>产品ID</td><td><?=gv("classid")?></td></tr>
    <tr><td>产品名称</td><td><? $dd = new db(); ?><?=$dd->get_one($tableName,"s_name",gv("classid"))?></td></tr>
    
    <? if(gv("s_name")!==""){?>
	<tr><td>订购标题</td><td><?=gv("s_name")?></td></tr>
	<? }?>
    
    <? if(gv("s_username")!==""){?>
	<tr><td>用户名</td><td><?=gv("s_username")?></td></tr>
	<? }?>
	
    <? if(gv("s_realname")!==""){?>
	<tr><td>真实姓名</td><td><?=gv("s_realname")?></td></tr>
	<? }?>

	<? if(gv("s_company")!==""){?>
	<tr><td>公司</td><td><?=gv("s_company")?></td></tr>
	<? }?>
    
    <? if(gv("s_fax")!==""){?>
	<tr><td>传真</td><td><?=gv("s_fax")?></td></tr>
	<? }?>
    
    <? if(gv("s_tel")!==""){?>
	<tr><td>电话</td><td><?=gv("s_tel")?></td></tr>
	<? }?>
    
    <? if(gv("s_phone")!==""){?>
	<tr><td>手机</td><td><?=gv("s_phone")?></td></tr>
	<? }?>
    
     <? if(gv("s_email")!==""){?>
	<tr><td>邮箱</td><td><?=gv("s_email")?></td></tr>
	<? }?>
    
     <? if(gv("qq")!==""){?>
	<tr><td>QQ/MSN</td><td><?=gv("qq")?></td></tr>
	<? }?>
    
     <? if(gv("s_address")!==""){?>
	<tr><td>地址</td><td><?=gv("s_address")?></td></tr>
	<? }?>
    
    <? if(gv("s_sex")!==""){?>
	<tr><td>性别</td><td><?=gv("s_sex")?></td></tr>
	<? }?>
    
    <? if(gv("s_content")!==""){?>
	<tr><td>说明</td><td><?=gv("s_content")?></td></tr>
	<? }?>
    

</table>
    
  
 
</div>

</body>
</html>
