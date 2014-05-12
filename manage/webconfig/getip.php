<? header("Content-Type: text/html; charset=utf-8");?>
<? session_start();?>
<?php include("../../inc/publicfunction.php"); ?>
<?php include("../../inc/turepage.php"); ?>
<?
	if(gg("action")=="del"){
		$dd = new db();
		$dd->setQuser("delete from s_ip  where id = ".gg("id")."   ");
		$url = getSplit(getUrl(),"&action=",0);
		ej("alert('删除成功');location.href='$url'");
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
	<div class="title">访问ip管理</div>


	<table  id="tableLists" border="1">
    	<tr><th width="4%">Id</th><th width="24%">IP</th><th width="25%">时间</th><th width="47%">操作</th></tr>
        
 <?
 	$pp = new page(gg("pageId"),50,getCount("select * from s_ip "),getSplit(getUrl(),"&pageId=",0));
 	$ipArr = getLiAll("select * from s_ip  order by id asc  ");
	foreach($ipArr as $rs){
 ?>        
        <tr><td width="4%"><?=$rs["id"]?></td><td width="24%"><?=$rs["s_name"]?></td><td width="25%"><?=$rs["s_time"]?></td><td width="47%"><input type="button" value="删除" onclick="location.href='<?=getSplit(getUrl(),"&action=",0)?>&action=del&id=<?=$rs["id"]?>'" /></td></tr>
        
 <? }?>       
        
        <tr><td class="page" colspan="4"><?=$pp->gPage("gb")?></td></tr>
        
    </table>






</div>  
</body>
</html>
