<? header("Content-Type: text/html; charset=utf-8");?>
<? session_start();?>
<?php include("../../inc/publicfunction.php"); ?>
<?
	if(gg("action")=="add"){
		$s_name = gp("username");
		$p = gp("password");
		$p2 = gp("password2");
		$qx = gp("qx");
		$realname = gp("s_realname");
		$password=md5($p);
		$dan = new db();
		if($p!=""&&$p2==$p){
			if($dan->getAll("select * from s_user where   s_name = '".$s_name."'   ")!=""){
				ej("alert('此用户名已存在，请更换');history.go(-1)");	
			}else{
				$dan->dateArr["s_name"] = $s_name;
				$dan->dateArr["s_pwd"] = $password;
				$dan->dateArr["s_realname"] = $realname;
				$dan->dateArr["s_qx"] = $qx;
				$dan->addNews = true;
				$dan->phpUpdate("select * from s_user where 1=1  ");
				$url = "webpassword.php?cc=1";
				ej("alert('操作成功');location.href='".$url."'");
			}
		}else{
			ej("alert('密码输入有误');history.go(-1)");	
		}
	
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
	<div class="title">管理员管理</div>
   <div class="bacf1 borddd marbot10 pad5">
   	
    <input value="返回" onclick="history.go(-1);" type="button" />
    </div>
     
 <form  method="post" action="<?=getSplit(getUrl(),"?action=",0)?>?action=add" id="forms" name="forms">   
	<table  id="tableLists" border="1">
 
    	<tr>
    	  <td width="11%">用户名:</td><td width="89%"><input value="" id="username" name="username" /></td></tr>
          <td width="11%">管理员姓名:</td><td width="89%"><input value="" name="s_realname" id="s_realname" /></td></tr>
          
          <td width="11%">密码:</td><td width="89%"><input name="password" type="password" id="password" value="" /></td></tr>
          <td width="11%">重复密码:</td><td width="89%"><input name="password2" type="password" id="password2" value="" /></td></tr>
          <td width="11%">权限:</td><td width="89%">
          <select id="qx" name="qx">
        <?
    	$dd = new db;
		$result = $dd->setQuser("select * from s_user_class where 1=1  and s_ok >=  ".$_SESSION["xingqx"]."   ");
		while($rs=$dd->setFetch($result)){
	?>  
          	<option value="<?=$rs["s_ok"]?>"  ><?=$rs["s_name"]?></option>
       <? }?>     
            
          </select>

          
          </td></tr>
         
        <tr><td colspan="2"><input id="submits" onclick="cmdForm();" value=" 确 定 " type="submit" />&nbsp;&nbsp;&nbsp;<input value=" 重 置 " type="button" /></td></tr>
        
    </table>
    
</form>    
    
    
    
    
    
</div>

</body>
</html>
