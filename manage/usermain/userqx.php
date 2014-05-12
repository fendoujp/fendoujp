<? header("Content-Type: text/html; charset=utf-8");?>
<?php session_start();?>
<?php include("../../inc/publicfunction.php"); ?>
<?php include("../../inc/turepage.php"); ?>
<?
	$s_title = gg("title");
	$s_type = gg("s_type");
	
	if(gg("action")=="check"){
		$s_name = gp("s_name");
		$s_order =gp("s_order");
		$id = gg("id");
		
		$dd = new db();
		$dd->dateArr["s_name"] = $s_name;
		$dd->dateArr["s_order"] = $s_order;
		$dd->phpUpdate("select * from u_main_class   where id = $id ");
		$url = getUrl();
		$url = delUrlKey($url,"action");
		$url = delUrlKey($url,"id");
		ej("location.href='$url'");
	}
	
	if(gg("action")=="add"){
		$s_name = gp("addsname");
		if($s_name==""){$s_name="新增权限";}
		$dd = new db();
		$dd->dateArr["s_name"] = $s_name;
		$dd->dateArr["s_type"] = $s_type;
		$dd->addNews = true;
		$dd->phpUpdate("select * from u_main_class   where 1=1 ");
		$url = getUrl();
		$url = delUrlKey($url,"action");
		ej("location.href='$url'");
	}
	
	
	if(gg("action")=="del"){
		$id = gg("id");
		$dd = new db();
		$dd->setQuser("delete from  u_main_class  where id = $id  ");
		$url = getUrl();
		$url = delUrlKey($url,"action");
		ej("location.href='$url'");
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
    
   <table  id="tableLists" border="1">
   <tr><th width="5%">id</th><th width="5%">type</th><th width="51%">权限</th><th width="10%">排序</th><th width="29%">操作</th></tr>
   <?
   	$arr = getLiAll("select * from u_main_class where s_type = '$s_type' order by s_order asc, id desc   ");
	foreach($arr as $rs){
   ?>
   <form action="<?=getSplit(getUrl(),"&action",0)?>&action=check&id=<?=$rs["id"]?>" method="post" name="userqxforms" id="userqxforms">
   <tr>
   <td><?=$rs["id"]?></td>
   <td><?=$rs["s_type"]?></td>
   <td><input id="s_name" name="s_name" value="<?=$rs["s_name"]?>"  /></td>
   <td>
   <input name="s_order" type="text" id="s_order" value="<?=$rs["s_order"]?>" size="10" ttt=<?=$rs["id"]?> />
   </td>
   <td>
   <input value="修改" id="but" name="but" type="submit" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      
     
     
      <input onclick="if(confirm('确认要删除吗？')){location.href='<?=getSplit(getUrl(),"&action=",0)?>&action=del&id=<?=$rs["id"]?>';}" value="删除" id="" name="" type="button" />
   
   
   </td>
   
   </tr>
   </form>
   <? }?>
    <tr><td class="page" colspan="5">
    
     <form  action="<?=getSplit(getUrl(),"&action=",0)?>&action=add" method="post" id="xingforms">
     权限: <input name="addsname" id="addsname" />&nbsp;&nbsp;
    <input value="添加" type="button" onclick="if(confirm('确定要添加吗？')){document.getElementById('xingforms').submit();}" />
     
     
    </form>
    
    </td></tr>
   
   </table>       
   
	
    
  
 
</div>

</body>
</html>
