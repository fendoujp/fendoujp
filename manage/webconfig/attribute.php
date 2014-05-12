<? header("Content-Type: text/html; charset=utf-8");?>
<?php session_start();?>
<?php include("../../inc/publicfunction.php"); ?>
<?php include("../../inc/public_str.php")?>

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
<?
	$public = gg("public");
	$typevalue = gg("typevalue");
	$sqld="";
?>
<?
	if(gg("action")=="check"){
		$dd = new db();
		
		$dd->dateArr["s_type"] = gp("s_type");
		$dd->dateArr["s_name"] = gp("s_name");
		$dd->dateArr["s_name1"] = gp("s_name1");
		$dd->dateArr["s_name2"] = gp("s_name2");
		$dd->dateArr["s_color"] = gp("s_color");
		$dd->dateArr["s_ok"] = gp("s_ok");
		$dd->dateArr["s_shuo"] = gp("s_shuo");
		$dd->dateArr["s_order"] = gp("s_order");
		$dd->dateArr["s_num"] = gp("s_num");
		
		$dd->phpUpdate("select * from attribute where id = ".gg("id")."  ");
		$dd->closeDb();
		$url = getSplit(getUrl(),"&action=",0);
		//ee($url);
		ee(js("location.href='".$url."'"));
	}
	
	if(gg("action")=="add"){
		$dd = new db();
		$addstype =gp("addstype");if($addstype==""){$addstype=$typevalue;}
		$adds_shuo = gp("adds_shuo");if($adds_shuo==""){$adds_shuo="说明";}
		$addsname = gp("addsname");
		
		$dd->dateArr["s_shuo"] = $adds_shuo;
		$dd->dateArr["s_type"] = $addstype;
		$dd->dateArr["s_name"] = $addsname;
		$dd->addNews = true;
		$dd->phpUpdate("select * from attribute   ");
		$dd->closeDb();
		$url = getSplit(getUrl(),"&action=",0);
		//ee($url);
		ee(js("location.href='".$url."'"));
	}
	if(gg("action")=="del"){
		$dd = new db();
		$dd->setQuser("delete from attribute where id = ".gg("id")."  ");
		$url = getSplit(getUrl(),"&action=",0);
		ee(js("location.href='".$url."'"));
	}
	
	if(gg("action")=="checkallorder"){
		$allorder = gp("allorder");
		$allid = gp("allid");
		$dd = new db();
		//en($allid);
		//en($allorder);
		$allidarr = splitArray($allid,"|");
		$allorderarr = splitArray($allorder,"|");
		for($i=0;$i<count($allidarr);$i++){
			$dd->setQuser("update attribute  set s_order = ".$allorderarr[$i]." where id = ".$allidarr[$i]."  ");
		}
		$url = getSplit(getUrl(),"&action=",0);
		ee(js("location.href='".$url."'"));
	}
	
	$dan = new db();
?>
<body style="height:auto;">

<div>
<div class="title">属性管理</div>
<? if($public!="0"):?>
 <div  class="bacf1 borddd marbot10 pad5">
 选择：
 
 <select onchange="location.href='<?=getSplit(getUrl(),"&typevalue=",0)?>&typevalue='+this.value" id="statusa" name="statusa">
<?
 	
	$result = $dan->setQuser("select DISTINCT s_type,s_shuo from  attribute order by s_type asc ");
	while($rs=$dan->setFetch($result)){
?>  
 	<option <?=iif($rs["s_type"]==$typevalue,"selected","")?> value="<?=$rs["s_type"]?>"><?=$rs["s_type"]."(".$rs["s_shuo"].")"?></option>
 <? }?>
 </select>
 
 
 </div> 
    
  <? endif;?>  
	<table id="tableLists" border="1">
    	
        
        <tr>
            <th width="5%">ID</th>
            <th width="3%">type</th>
            <th width="4%">说明</th>
            <th width="13%">名称</th>
            <!--<th width="13%">名称en</th>
            <th width="13%">名称繁体</th>-->
           <!-- <th width="8%">颜色</th>-->
            <th width="10%">条数(0不限)</th>
       		<th width="8%">默认(值1)</th>
            <th width="8%">排序</th>
            <th width="20%">操作</th>
        </tr>
        
 <?
 	if($typevalue!=""){$sqld = " and s_type = '".$typevalue."'  ";}
	$result = $dan->setQuser("select * from  attribute where 1=1  ".$sqld." order by s_type asc,id desc ");
	while($rs=$dan->setFetch($result)){
 ?>      
  <form action="<?=getSplit(getUrl(),"&action=",0)?>&action=check&id=<?=$rs["id"]?>" method="post" id="myforms">     
  <tr>
    <td width="5%"><?=$rs["id"]?></td>
    <td width="3%"><input value="<?=$rs["s_type"]?>" name="s_type" type="text" id="s_type"  size="10" /></td>
    <td width="4%"><input name="s_shuo" type="text" id="s_shuo" value="<?=$rs["s_shuo"]?>" size="20" /></td>
    <td width="13%"><input name="s_name" type="text" id="s_name" value="<?=$rs["s_name"]?>" size="10" /></td>
   <!-- <td width="13%"><input name="s_name1" type="text" id="s_name1" value="<?=$rs["s_name1"]?>" size="10" /></td>
    <td width="13%"><input name="s_name2" type="text" id="s_name2" value="<?=$rs["s_name2"]?>" size="10" /></td>-->
    <!--<td width="8%"><input name="s_color" type="text" id="s_color" value="<?=$rs["s_color"]?>" size="8" /></td>-->
    <td width="10%"><input name="s_num" type="text" id="s_num" value="<?=$rs["s_num"]?>" size="5" /></td>
    <td width="8%"><input name="s_ok" type="text" id="s_ok" value="<?=$rs["s_ok"]?>" size="5" /></td>
    <td width="8%"><input name="s_order" type="text" id="s_order" value="<?=$rs["s_order"]?>" size="8" ttt="<?=$rs["id"]?>" /></td>
    <td width="20%"><input value="修改" id="but" name="but" type="submit" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input onclick="if(confirm('确认要删除吗？')){location.href='<?=getSplit(getUrl(),"&action=",0)?>&action=del&id=<?=$rs["id"]?>';}" value="删除" id="" name="" type="button" /></td>
</tr>
      
  </form>      
 
  <? }?>  
        
        
    </table>
    
    
    
    <div class=" bacf1 mar10 pad5 borddd">
    <form  action="<?=getSplit(getUrl(),"&action=",0)?>&action=add" method="post" id="xingforms">
    type:<input value="<?=$typevalue?>" size="15" name="addstype" id="addstype" />&nbsp;&nbsp;
    说明:<input name="adds_shuo" id="adds_shuo" />&nbsp;&nbsp;
    名称:<input name="addsname" id="addsname" />&nbsp;&nbsp;
     <input value="添加" type="button" onclick="if(confirm('确定要添加吗？')){document.getElementById('xingforms').submit();}" />
    
   &nbsp;&nbsp;&nbsp;&nbsp;  <input value="批量修改排序" type="button" onclick="psave();" />
    
    
    </form>
 
    <form style="display:none" action="<?=getSplit(getUrl(),"&action=",0)?>&action=checkallorder" method="post" id="yforms">
    	<input id="allorder" name="allorder" /><input id="allid" name="allid" />
    </form>
   
  </div>
    
    
    
</div>

</body>
</html>
<script>
function psave(){
	arr = document.getElementsByName("s_order");
	var allorder="";
	var allid="";
	for(var i=0;i<arr.length;i++){
		if(allorder==""){
			allorder=arr.item(i).value;
			allid=arr.item(i).getAttribute("ttt");
		}else{
			allorder+="|"+arr.item(i).value;
			allid+="|"+arr.item(i).getAttribute("ttt");
		}
	}

	document.getElementById("allorder").value = allorder;
	document.getElementById("allid").value = allid;
	document.getElementById("yforms").submit();
}
</script>