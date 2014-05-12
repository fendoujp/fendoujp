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
	$da->setQuser("delete from orders_class  where id = ".gg("id")." ");
	$da->setQuser("delete from orders_detail  where classid = ".gg("id")." ");
	$da->closeDb();
	ee(js("location.href='".getSplit(getUrl(),"&action",0)."'"));
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
    

   
<table  id="tableLists" border="1">

	<tr>
    	<th width="4%"  >ID</th>
        <th width="6%"  >type</th>
        <th width="17%"  >订单号</th>
        <th width="8%"  >订购数量</th>
        <th width="11%" >订单金额</th>
        <th width="11%"  >配送方式</th>
        <th width="11%" >付款方式</th>
        <th width="11%"  >下单时间</th>
        <th width="11%" >订单状态</th>
        
      	
        
        <th width="10%"  nowrap="nowrap">操作</th>
    </tr>

<?
    $dan = new db;
	
	$sqlStr = "";
	$pp = new page(gg("pageId"),20,$dan->getCount("select * from orders_class  where 1=1 and s_type = '".$s_type."'  and s_classtype='".$s_classtype."'    "),getUrl());
	$result = $dan->setQuser("select * from orders_class  where 1=1 and s_type = '".$s_type."'  and s_classtype='".$s_classtype."'   limit ".$pp->limitStart().",".$pp->limitEnd()."  ");
	$ii=0;
	
	while($rs=$dan->setFetch($result)){
?>  

	<tr>
    	
        
        
        <td><?=$rs["id"]?></td>
        <td><?=$rs["s_type"]?></td>
        <td><?=$rs["s_name"]?></td>
        <td><?=$rs["s_num"]?></td>
        <td><?=$rs["s_price"]?></td>
        <td><?=$rs["s_pay"]?></td>
        <td><?=$rs["s_song"]?></td>
        <td><?=$rs["s_time"]?></td>
        <td>
        
        <select onchange="location.href='<?=getUrl()?>&action=checkok&id=<?=$rs["id"]?>&value='+this.value" id="s_ok" name="s_ok">
	<?
        $cc = new db();
        $result2 = $cc->setQuser("select * from status where 1=1 and s_type = '".$s_type."'     order by s_order asc,id desc   ");
        $eee=0;
        while($rs2=$cc->setFetch($result2)){
    ?>    
      <option style="color:<?=$rs2["s_color"]?>" <?=iif($rs["s_ok"]==$rs2["id"],"selected","")?> value="<?=$rs2["id"]?>"><?=$rs2["s_name"]?></option>
      
  	 <? $eee++; }?>    
      
      </select>
        
        
        </td>
       
        
        
        
        <td nowrap="nowrap">
        
 
 <input onclick="location.href='order_detail.php<?=getSplit(getSplit(getUrl(),".php",1),"&id=",0)?>&id=<?=$rs["id"]?>'" type="button" value="详细" />
 
 &nbsp;&nbsp;&nbsp;&nbsp;
 <input onclick="if(confirm('删除订单会将此单下订购的产品删除，确定要删除吗？')){location.href='<?=getUrl()?>&action=del&id=<?=$rs["id"]?>'}" type="button" value="删除" />


        
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
