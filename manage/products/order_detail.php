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
	$id = gg("id");
?>
<?
	function gv($cowName){
		$dd = new db();
		return 	($dd->get_one("orders_class",$cowName,gg("id")));
	}
	
	
	
	if(gg("action")=="checkok"){
	$da = new db;
	$nowNum = $da->getCount("select * from orders_class where s_type = '".$s_type."' and s_ok = ".unescape(gg("value"))."   ");
	$setNum = $da->get_s("select s_num from status where s_type = '".$s_type."' and id = ".unescape(gg("value"))."  ");
	if($setNum!=0&&$nowNum>=$setNum){
		ej("alert('己达此栏目设置最大数目');location.href='".getSplit(getUrl(),"&action",0)."'");
	}
	$da->setQuser("update orders_class set s_ok = '".unescape(gg("value"))."' where id = ".gg("id")." ");
	$da->closeDb();
	ee(js("location.href='".getSplit(getUrl(),"&action",0)."'"));
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
状态：
<select onchange="location.href='<?=getUrl()?>&action=checkok&id=<?=$id?>&value='+this.value" id="s_ok" name="s_ok">
<?
$cc = new db();
$result2 = $cc->setQuser("select * from status where 1=1 and s_type = '".$s_type."'     order by s_order asc,id desc   ");
$eee=0;
while($rs2=$cc->setFetch($result2)){
?>    
<option style="color:<?=$rs2["s_color"]?>" <?=iif(gv("s_ok")==$rs2["id"],"selected","")?> value="<?=$rs2["id"]?>"><?=$rs2["s_name"]?></option>

<? $eee++; }?>    

</select>

&nbsp;&nbsp;&nbsp;&nbsp;

<input value="打印" type="button" onclick="window.print();" />
&nbsp;&nbsp;&nbsp;&nbsp;
<input value="返回" type="button" onclick="history.go(-1);" />
</div>

<div>
<strong>产品列表:</strong>
</div>
<table id="tableLists">
	<tr>
    	<th width="5%">产品ID</th>
        <th width="11%">产品图片</th>
        <th width="42%">产品名称</th>
        <th width="14%">产品价格</th>
        <th width="17%">订购数量</th>
        <th width="11%">小计</th>
    </tr>
    
<?
	$dan = new db;
	$sqlStr = "";
	$pp = new page(gg("pageId"),20,$dan->getCount("select * from orders_detail  where 1=1 and s_type = '".$s_type."'  and s_classtype='".$s_classtype."'  and classid = ".$id."  "),getUrl());
	$result = $dan->setQuser("select * from orders_detail  where 1=1 and s_type = '".$s_type."'  and s_classtype='".$s_classtype."' and classid = ".$id."    limit ".$pp->limitStart().",".$pp->limitEnd()."  ");
	$countPrice=0;
	while($rs=$dan->setFetch($result)){
?>
    
    <tr>
    	<td><?=$rs["pid"]?></td>
        <td><img src="../../<?=$rs["s_img"]?>" width="30" height="30" /></td>
        <td><?=$rs["s_name"]?></td>
        <td><?=$rs["s_price"]?></td>
        <td><?=$rs["s_num"]?></td>
        <td><?=$rs["s_price"]*$rs["s_num"]?></td>
    </tr>
    
 <? 
	 $countPrice +=  $rs["s_price"]*$rs["s_num"];
 
 }
 ?> 
    
    
    <tr>
    	<th colspan="6">
        	 合计：<?=$countPrice?>
        </th>
    </tr>
    
</table>
 
 
 
 
 
 
 
 
 
<div class="mar10">
<strong>详细信息:</strong>
</div> 
<table  id="tableLists" border="1">
	<tr><td width="13%">订单ID</td><td width="87%"><?=gg("id")?></td></tr>
    
    <? if(gv("s_name")!==""){?>
	<tr><td>订单号</td><td><?=gv("s_name")?></td></tr>
	<? }?>
    <tr><td>下单时间</td><td><?=gv("s_time")?></td></tr>
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
	<tr><td>送货地址</td><td><?=gv("s_address")?></td></tr>
	<? }?>
    
    <? if(gv("s_sex")!==""){?>
	<tr><td>性别</td><td><?=gv("s_sex")?></td></tr>
	<? }?>
    
    <? if(gv("s_song")!==""){?>
	<tr><td>送货方式</td><td><?=gv("s_song")?></td></tr>
	<? }?>
    
     <? if(gv("s_pay")!==""){?>
	<tr><td>付款方式</td><td><?=gv("s_pay")?></td></tr>
	<? }?>

</table>
    
  
 
</div>

</body>
</html>
