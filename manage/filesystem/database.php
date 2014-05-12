<? header("Content-Type: text/html; charset=utf-8");?>
<?php session_start();?>
<?php include("../../inc/publicfunction.php")?>
<?php include("database_back.php")?>
<?
	if(gg("action")=="bei"){
		$localhost = gp("local");
		$root = gp("username");
		$password = gp("password");
		$dbname = gp("dataname");
		$connectid = mysql_connect($localhost,$root,$password);
		mysql_query("set names 'utf8'");  
		$backupDir = 'data/'.date("Y-m-d-h-i-s");    //设置要备份到的目录
		$DbBak = new DbBak($connectid,$backupDir);
		$DbBak->backupDb($dbname);
		ej("alert('操作成功');location.href='database.php'");
	}
	
	if(gg("action")=="huan"){
		$localhost = gp("localh");
		$root = gp("usernameh");
		$password = gp("passwordh");
		$dbname = gp("datanameh");
		$huan = gp("huadian");
		
		
		$connectid = mysql_connect($localhost,$root,$password);
		mysql_query("set names 'utf8'");  
		$backupDir = 'data/2011-09-23-12-01-20/';    
		$DbBak = new DbBak($connectid,$backupDir);
		$DbBak->restoreDb($dbname);
		ej("alert('操作成功');location.href='database.php'");
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
</head>
<div class="title">数据库管理</div>
<body style="height:auto;">
  <div class="bacf1 borddd marbot10 pad5 mar10">
   备份(请不要随意修改参数)
   </div>
<form action="?action=bei" method="post" id="dataforms">
	<table  id="tableLists" border="1">
    	<tr>
        	<td width="7%">主机</td><td width="93%"><input id="local" name="local" value="<?=$xing_db_localhost?>" /></td>
        </tr>
        <tr>
            <td width="7%">用户名</td><td width="93%"><input id="username" name="username" value="<?=$xing_db_root?>" /></td>
        </tr>
        <tr>
            <td width="7%">密码</td><td width="93%"><input name="password" type="password" id="password" value="<?=$xing_db_password?>" /></td>
         </tr>
         <tr>
            <td width="7%">数据库名</td><td width="93%"><input id="dataname" name="dataname" value="<?=$xing_db_dbName?>" /></td>
        </tr>
        
        <tr><td colspan="2">
        	<input value="  确  定  " type="submit" />
        </td></tr>
    </table>

</form>



<div class="bacf1 borddd marbot10 pad5 mar10"> 还原</div>
<form action="?action=huan" method="post" id="dataformsh">
	<table  id="tableLists" border="1">
    	<tr>
        	<td width="7%">主机</td><td width="93%"><input id="localh" name="localh" value="<?=$xing_db_localhost?>" /></td>
        </tr>
        <tr>
            <td width="7%">用户名</td><td width="93%"><input id="usernameh" name="usernameh" value="<?=$xing_db_root?>" /></td>
        </tr>
        <tr>
            <td width="7%">密码</td><td width="93%"><input name="passwordh" type="password" id="passwordh" value="<?=$xing_db_password?>" /></td>
         </tr>
         <tr>
            <td width="7%">数据库名</td><td width="93%"><input id="datanameh" name="datanameh" value="<?=$xing_db_dbName?>" /></td>
        </tr>
        
        <tr>
            <td width="7%">还原点</td><td width="93%"><input id="huadian" name="huadian" />(备份文件夹名)</td>
        </tr>
        
        <tr><td colspan="2">
        	<input value="  确  定  " type="submit" />
        </td></tr>
    </table>

</form>




</body>
</html>
<?

//$connectid = mysql_connect('localhost','root','');
//mysql_query("set names 'utf8'");  
//$backupDir = 'data';    //设置要备份到的目录
//$DbBak = new DbBak($connectid,$backupDir);  

//2数据备份
//2.1如果你想备份test库中的所有表，只要这样： 
//$DbBak->backupDb('enterprisedata');  

//2.2如果你只想备份test库中的admin 、test表，可以用一个一维数组指定：
//$DbBak->backupDb('test',array('admin','test')); 

//2.3如果只想备份一个表，比如admin表：
//$DbBak->backupDb('test','admin'); 
                            
//数据恢复：
//对于2.1、2.2、2.3三种情况，只要相应的修改下语句，把backupDb换成restoreDb就能实现数据恢复了：
//$DbBak->restoreDb('test');  

//SQL代码
//$DbBak->restoreDb('test',array('admin','test')); 

//PHP代码
//$DbBak->restoreDb('test','admin');  

?>




