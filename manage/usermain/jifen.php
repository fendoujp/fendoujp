<? header("Content-Type: text/html; charset=utf-8");?>
<?php session_start();?>
<?php include("../../inc/publicfunction.php"); ?>
<?php include("../../inc/turepage.php"); ?>
<?
	function gv($tableName,$fid){
		$dan = new db();
		return $dan->get_one("u_main",$tableName,$fid);	
		$dan->closeDb();
	}
?>
<?
	$id=gg("id");
	$s_type = gg("s_type");
	if(gg("action")=="song"){
		$value = gg("value");
		$dd = new db();
		$dd->dateArr["s_jifen"]=$value;
		$dd->dateArr["s_name"]="获得";
		$dd->dateArr["s_conj"]="管理员".$_SESSION["xingusername"]."赠送";
		$dd->dateArr["userid"]=$id;
		$dd->dateArr["s_type"]=$s_type;
		$dd->addNews=true;
		$dd->phpUpdate("select * from u_main_jifen   where 1=1    ");
		$dd->setQuser("update  u_main set  s_jifen = s_jifen+ $value   where  id = $id    ");
		$url = getSplit(getUrl(),"&action=",0);
		ej("alert('操作成功');location.href='$url'");
	}
	if(gg("action")=="del"){
		$dd = new db();
		$dd->setQuser("delete  from u_main_jifen  where id = ".gg("jid")."   ");
		$url = getSplit(getUrl(),"&action=",0);
		ej("alert('操作成功');location.href='$url'");
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
	<div class="title">会员积分管理</div>
    
    <div  class="bacf1 borddd marbot10 pad5">
   		用户<?=gv("s_name",$id)?>积分：<span style="font-size:14px; color:#ff0000;"><?=gv("s_jifen",$id)?></span>
   	
    	&nbsp;&nbsp;赠送&nbsp;&nbsp;<input  name="songjifen" id="songjifen" type="text" />&nbsp;<input onclick="location.href='?<?=getSplit(getUrl(),"?",1)?>&action=song&value='+document.getElementById('songjifen').value" type="button" value="确定"  />
    
    </div>
    
    
<table  id="tableLists" border="1">
	<tr>
    	<th width="2%">id</th><th width="3%">type</th><th width="9%">积分</th><th width="9%">说明</th><th width="9%">时间</th><th width="43%">明细</th><th width="25%">操作</th>
    </tr>


<?
	$sqld = " select id,s_name,s_jifen,s_conj,userid,s_type,s_time from u_main_jifen  where userid = $id  ";
	$pp = new page(gg("pageId"),30,getCount($sqld),getUrl());
	$arr = getLiAll("  $sqld  limit  ".$pp->limitStart()." ,".$pp->limitEnd()."    ");
	foreach($arr as $rs){
?>     
<tr>
    	<td><?=$rs["id"]?></td><td><?=$rs["s_type"]?></td><td><?=$rs["s_jifen"]?></td><td><?=$rs["s_name"]?></td><td nowrap="nowrap"><?=$rs["s_time"]?></td><td><?=$rs["s_conj"]?></td><td>
        
        <input value="删除记录" type="button" onclick="if(confirm('操除操作不可恢复，确认要删除吗？')){location.href='?<?=getSplit(getUrl(),"?",1)?>&action=del&jid=<?=$rs["id"]?>'}"  />
        </td>
</tr>

<? }?>

<tr><td class="page" colspan="7"><?=$pp->mPage()?></td></tr>
</table>        
   
	
    
  
 
</div>

</body>
</html>
