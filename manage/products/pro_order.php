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
if(gg("action")=="del"){
	$da = new db;
	$da->setQuser("delete from book  where id = ".gg("id")." ");
	$da->closeDb();
	ee(js("location.href='".getSplit(getUrl(),"&action",0)."'"));
}
if(gg("action")=="checkok"){
	$da = new db;
	$nowNum = $da->getCount("select * from book where s_type = '".$s_type."' and s_ok = ".unescape(gg("value"))."   ");
	$setNum = $da->get_s("select s_num from status where s_type = '".$s_type."' and id = ".unescape(gg("value"))."  ");
	if($setNum!=0&&$nowNum>=$setNum){
		ej("alert('己达此栏目设置最大数目');location.href='".getSplit(getUrl(),"&action",0)."'");
	}
	$da->setQuser("update book set s_ok = '".unescape(gg("value"))."' where id = ".gg("id")." ");
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
    

   
<table  id="tableLists" border="1">

	<tr>
    	<th width="3%">ID</th><th width="5%">产品ID</th><th width="7%">产品图片</th><th width="30%">产品名称</th><th width="30%">订购标题</th><th width="11%">订购时间</th>
        <? if($s_ok=="1"){?>
      <th width="9%">状态</th>
        <? }?>
        <th width="13%" nowrap="nowrap">操作</th>
    </tr>

<?
    $dan = new db;
	
	$sqlStr = "";
	$pp = new page(gg("pageId"),20,$dan->getCount("select * from book  where 1=1 and s_type = '".$s_type."'  and s_classtype='".$s_classtype."'    "),getUrl());
	$result = $dan->setQuser("select * from book  where 1=1 and s_type = '".$s_type."'  and s_classtype='".$s_classtype."'   limit ".$pp->limitStart().",".$pp->limitEnd()."  ");
	$ii=0;
	
	while($rs=$dan->setFetch($result)){
?>  

	<tr>
    	<td><?=$rs["id"]?></td>
        <td><?=$rs["classid"]?></td>
        <td><img src="../../<?=$dan->get_one($tableName,"s_img",$rs["classid"])?>" width="20" height="20"  onmouseover="this.width=80;this.height=80" onmouseout="this.width=20;this.height=20"  /></td>
        <td><?=$dan->get_one($tableName,"s_name",$rs["classid"])?></td>
        
        <td><?=$rs["s_name"]?></td>
        
        <td><?=$rs["s_time"]?></td>
        <? $cc = new db;?>
       <? if($s_ok=="1"){?>
        <td>
        <select onchange="location.href='<?=getUrl()?>&action=checkok&id=<?=$rs["id"]?>&value='+this.value" id="s_ok" name="s_ok">
	<?
        
        $result2 = $cc->setQuser("select * from status where 1=1 and s_type = '".$s_type."'     order by s_order asc,id desc   ");
        $eee=0;
        while($rs2=$cc->setFetch($result2)){
    ?>    
      <option style="color:<?=$rs2["s_color"]?>" <?=iif($rs["s_ok"]==$rs2["id"],"selected","")?> value="<?=$rs2["id"]?>"><?=$rs2["s_name"]?></option>
      
  	 <? $eee++; }?>    
      
      </select>
        
        </td>
        <? }?>
        
        <td nowrap="nowrap">
        
 
 <input onclick="location.href='pro_order_detail.php<?=getSplit(getSplit(getUrl(),".php",1),"&id=",0)?>&id=<?=$rs["id"]?>'" type="button" value="详细" />
 
 &nbsp;&nbsp;&nbsp;&nbsp;
 <input onclick="if(confirm('确定要删除吗？')){location.href='<?=getUrl()?>&action=del&id=<?=$rs["id"]?>'}" type="button" value="删除" />


        
        </td>
    </tr>

<? }?>


    <tr>
        <td colspan="18" class="page" style="height:25px; padding:5px 0;  "> 
        <? e($pp->mPage());?>
        </td>
    </tr>


</table>
    
  
 
</div>

</body>
</html>
