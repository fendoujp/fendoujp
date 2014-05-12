<? header("Content-Type: text/html; charset=utf-8");?>
<? session_start();?>
<?php include("../../inc/publicfunction.php"); ?>
<?
	function gv($tableName,$fid){
		$dan = new db();
		return $dan->get_one("s_user",$tableName,$fid);	
		$dan->closeDb();
	}
	
	$fid = gg("id");
	if($fid==""){
		$dan = new db();
		$fid = $dan->get_s("select id from s_user where s_qx = ".$_SESSION["xingqx"]."  ");
		$dan->closeDb();
	}

	if(gg("action")=="check"){
		$dp = gp("dpassword");
		$p = gp("password");
		$p2 = gp("password2");
		$id = gg("id");
		$qx = gp("qx");
		$realname = gp("s_realname");
		//$_SESSION["xingqx"] = $qx;
		$password="";
		//ee($dp);
		$dan = new db();
		if($dp!=""){
			if($dan->getAll("select * from s_user where   s_pwd = '".md5($dp)."' and id = ".$id." ")==""){
				$url = getSplit(getUrl(),"&action=",0);
				ej("alert('原密码输入有误');history.go(-1)");
				return false;
				exit();	
			}else if($p!=""&&$p2!=""&&$p==$p2){
				$password = md5($p);
				
			}else{
				ej("alert('新密码输入有误');history.go(-1)");
				return false;
				exit();	
			}
		}
		
		$dan->dateArr["s_pwd"] = $password;
		$dan->dateArr["s_realname"] = $realname;
		$dan->dateArr["s_qx"] = $qx;
		$dan->phpUpdate("select * from s_user where id = ".$id."");
		$url = getSplit(getUrl(),"&action=",0);
		ej("alert('操作成功');location.href='".$url."'");
		
	}
	
	if(gg("action")=="del"){
		$dd = new db();
		$url = getSplit(getUrl(),"&action=",0);
		if($_SESSION["xingid"]==gg("id")){
			ej("alert('不能删除自己');location.href='".$url."'");
		}
		$dd->setQuser("delete from s_user where id = ".gg("id")."  ");
		ee(js("location.href='webpassword.php?cc=1'"));
	}
	
	if(gg("action")=="check123456"){
		$dan = new db();
		$id = gg("id");
		//ee($id);
		$dan->dateArr["s_pwd"] = md5("123456");
		$dan->phpUpdate("select * from s_user where id = ".$id."");
		$url = getSplit(getUrl(),"&action=",0);
		ej("alert('操作成功');location.href='".$url."'");
	}
	if(gg("action")=="checkmenuqx"){
		$text = gpk("menuqx");
		$dan = new db();
		$id = gg("id");
		//en($id);
		$dan->dateArr["menu_qx"] = $text;
		$dan->phpUpdate("select * from s_user where id = ".$id."");
		$url = getSplit(getUrl(),"&action=",0);
		ej("alert('操作成功');location.href='".$url."'");
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
   <? if($_SESSION["xingqx"]<=1){?>
   	选择：<select onchange="location.href='<?=getUrl()?>&id='+this.value">
    <?
    	$dan = new db;
		$result = $dan->setQuser("select * from s_user where 1=1 and  s_qx >=  ".$_SESSION["xingqx"]."   order by id asc   ");
		$ii=0;
		while($rs=$dan->setFetch($result)){
	?>
    	<option <?=iif($rs["id"]==$fid,"selected","")?> value="<?=$rs["id"]?>"><?=$rs["s_name"]?></option>
    <?
		$ii++;
	 }
	 $dan->closeDb();
	// ee($fid);
	 ?>
    </select>
    
    <? }?>
    <? if($_SESSION["xingqx"]<=1){?>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input value="删除<?=gv("s_name",$fid)?>管理员" type="button" onclick="if(confirm('确认要删除此管理员吗？')){location.href='<?=getSplit(getUrl(),"&action=",0)?>&action=del&id=<?=$fid?>';}"/>
   <? }?> 
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input value="设置<?=gv("s_name",$fid)?>的密码为123456" type="button" onclick="if(confirm('确认要要执行此操作么？')){location.href='<?=getSplit(getUrl(),"&action=",0)?>&action=check123456&id=<?=$fid?>';}"/>
    
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <? if($_SESSION["xingqx"]<=1){?>
    <input value="添加管理员" type="button" onclick="location.href='user_add.php';"/>
    <? }?>
    </div>
     
 <form  method="post" action="<?=getSplit(getUrl(),"&action=",0)?>&action=check&id=<?=$fid?>" id="forms" name="forms">   
	<table  id="tableLists" border="1">
 
    	<tr>
    	  <td width="11%">用户名:</td><td width="89%"><?=gv("s_name",$fid)?></td></tr>
          <td width="11%">管理员姓名:</td><td width="89%">
          <? if($_SESSION["xingqx"]<=1){?>
          <input value="<?=gv("s_realname",$fid)?>" name="s_realname" id="s_realname" />
          <? }else{?>
          <?=gv("s_realname",$fid)?>
          <? }?>
          
          </td></tr>
          <td width="11%">当前密码:</td><td width="89%"><input name="dpassword" type="password" id="dpassword" value="" /> </td></tr>
          <td width="11%">密码:</td><td width="89%"><input name="password" type="password" id="password" value="" /></td></tr>
          <td width="11%">重复密码:</td><td width="89%"><input name="password2" type="password" id="password2" value="" /></td></tr>
          <td width="11%">权限:</td><td width="89%">
       <? if($_SESSION["xingqx"]=="0"){?>
       
          <select id="qx" name="qx">
        <?
    	$dd = new db;
		$result = $dd->setQuser("select * from s_user_class where 1=1    ");
		while($rs=$dd->setFetch($result)){
	?>  
          	<option value="<?=$rs["s_ok"]?>" <?=iif(gv("s_qx",$fid)==$rs["s_ok"],"selected","")?> ><?=$rs["s_name"]?></option>
       <? }?>     
            
          </select>

       <?
	   }else{
		   $dd = new db;
		  // ee(gv("s_qx",$fid));
		   e($dd->get_s("select s_name from s_user_class where s_ok = ".gv("s_qx",$fid)."     "));
	   }
	   ?>   
          </td></tr>
         
        <tr><td colspan="2"><input id="submits" onclick="cmdForm();" value=" 确 定 " type="submit" />&nbsp;&nbsp;&nbsp;<input value=" 重 置 " type="button" /></td></tr>
        
    </table>
    
</form>    
    
 <? if($_SESSION["xingqx"]<=1){?>   
  <div class="bacf1 borddd marbot10 pad5 mar10">
   <?=gv("s_name",$fid)?>栏目管理权限
   </div>
   
   
   
    <table  id="tableLists" border="1">
    <form action="<?=getSplit(getUrl(),"&action=",0)?>&action=checkmenuqx&id=<?=$fid?>" method="post" id="menuqxforms">
    <?
    	$arr = getLiAll("select id,s_name  from s_menu_class where 1=1 and parent_id=0 and s_ok=1 order by s_order asc,id desc ");
		for($i=0;$i<count($arr);$i++){	
	?>
    	<tr>
        	<td width="4%"><input <?=iif(strstr(",".gv("menu_qx",$fid).",",",".$arr[$i]["id"].","),"checked","")?> type="checkbox" name="menuqx[]" id="menuqx<?=$arr[$i]["id"]?>" value="<?=$arr[$i]["id"]?>" /></td><td width="96%"><? e($arr[$i]["s_name"]);?></td>
        </tr>
        
     <?
    	$arr2 = getLiAll("select id,s_name  from s_menu_class where 1=1 and parent_id=".$arr[$i]["id"]." and s_ok=1 order by s_order asc,id desc ");
		for($j=0;$j<count($arr2);$j++){	
	?>   
        <tr>
        	<td  width="4%"><div style="margin-left:15px;"><input <?=iif(strstr(",".gv("menu_qx",$fid).",",",".$arr2[$j]["id"].","),"checked","")?> type="checkbox" name="menuqx[]" id="menuqx<?=$arr[$i]["id"]?>" value="<?=$arr2[$j]["id"]?>" /></div></td>
            <td width="96%"><div style="margin-left:30px;"><? e($arr2[$j]["s_name"]);?></div></td>
        </tr>
        
     <? }}?>
     
     <tr><th align="left" colspan="2">
      &nbsp;&nbsp;&nbsp;&nbsp;
        <a href="javascript:void(0);" onclick="checkAll('menuqx[]');">全选</a>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="checkfAll('menuqx[]')">反选</a>
        &nbsp;&nbsp;<a href="javascript:void(0);" onclick="checkbAll('menuqx[]');">全不选</a>
     &nbsp;&nbsp;&nbsp;&nbsp;<input value="确定" type="submit"  />
     </th></tr>
     
     </form>
     
     </table>
    
    
   <? }?> 
</div>

</body>
</html>
<script>
function getCheckboxValue(names){////////获取选取的checkbox的值
	var str="";
	var ids = document.getElementsByName(names);
	for(var i=0;i<ids.length;i++){
		if(ids.item(i).checked){
			if(str==""){
				str=ids.item(i).value;
			}else{
				str+=","+ids.item(i).value;	
			}	
		}
	}
	return(str);
}
function checkAll(names){
	var ids = document.getElementsByName(names);
	for(var i=0;i<ids.length;i++){
		ids.item(i).checked = true;
		
	}
}
function checkbAll(names){
	var ids = document.getElementsByName(names);
	for(var i=0;i<ids.length;i++){
		ids.item(i).checked = false;
		
	}
}
function checkfAll(names){
	var ids = document.getElementsByName(names);
	for(var i=0;i<ids.length;i++){
		if(ids.item(i).checked){
			ids.item(i).checked = false;
		}else{
			ids.item(i).checked = true;
		}
	}
}
</script>