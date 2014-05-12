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
	$s_title = gg("title");
	$s_type = gg("s_type");
	$dan = new db();
	$s_lan= $dan->get_one("web_config ","s_language",1);
	if(strstr($s_lan,"1")){$gb=1;}else{$gb=0;}
	if(strstr($s_lan,"2")){$en=1;}else{$en=0;}
	if(strstr($s_lan,"3")){$ft=1;}else{$ft=0;}	
?>
<?
	if(gg("action")=="check"){
		$dd = new db();
		$dd->dateArr["s_name"] = gp("s_name");
		$dd->dateArr["s_name1"] = gp("s_name1");
		$dd->dateArr["s_name2"] = gp("s_name2");
		$dd->dateArr["s_order"] = gp("s_order");	
		$dd->phpUpdate("select * from orders_ps where id = ".gg("id")."  ");
		$dd->closeDb();
		$url = getSplit(getUrl(),"&action=",0);
		//ee($url);
		ee(js("location.href='".$url."'"));
	}
	
	if(gg("action")=="add"){
		$dd = new db();
		$order=$dd->get_s("select s_order from orders_ps  order by s_order desc  ");
		$dd->dateArr["s_type"] = $s_type;
		$addsname = gp("addsname");if($addsname==""){$addsname="说明";}
		$dd->dateArr["s_name"] = $addsname;
		$dd->dateArr["s_order"] = $order+1;
		$dd->addNews = true;
		$dd->phpUpdate("select * from orders_ps where 1=1   ");
		$dd->closeDb();
		$url = getSplit(getUrl(),"&action=",0);
		//ee($url);
		ee(js("location.href='".$url."'"));
	}
	if(gg("action")=="del"){
		$dd = new db();
		$dd->setQuser("delete from orders_ps where id = ".gg("id")."  ");
		$url = getSplit(getUrl(),"&action=",0);
		ee(js("location.href='".$url."'"));
	}
	
	if(gg("action")=="checkallorder"){
		$allorder = gp("allorder");
		$allid = gp("allid");
		$dd = new db();
		$allidarr = splitArray($allid,"|");
		$allorderarr = splitArray($allorder,"|");
		for($i=0;$i<count($allidarr);$i++){
			$dd->setQuser("update orders_ps  set s_order = ".$allorderarr[$i]." where id = ".$allidarr[$i]."  ");
		}
		ee(js("location.href='".getSplit(getUrl(),"&action",0)."'"));
	}

	$dan = new db();
?>
<body style="height:auto;">

<div>
<div class="title"><?=$s_title?>管理</div>


    
    
	<table id="tableLists" border="1">
    	
        
        <tr>
            <th width="5%">ID</th>
            <th width="3%">type</th>
            <? if($gb=="1"){?>
            <th width="13%">名称</th>
            <? }?>
            <? if($en=="1"){?>
            <th width="13%">名称en</th>
             <? }?>
            <? if($ft=="1"){?>
            <th width="13%">名称繁体</th>
             <? }?>

            <th width="8%">排序</th>
            <th width="20%">操作</th>
        </tr>
        
 <?
	$result = $dan->setQuser("select * from  orders_ps where 1=1 and s_type = '".$s_type."'   order by s_type asc ");
	while($rs=$dan->setFetch($result)){
 ?>      
  <form action="<?=getSplit(getUrl(),"&action=",0)?>&action=check&id=<?=$rs["id"]?>" method="post" id="myforms">     
  <tr>
    <td width="5%"><?=$rs["id"]?></td>
    <td width="3%"><?=$rs["s_type"]?></td>
    <? if($gb=="1"){?>
    <td width="13%"><input name="s_name" type="text" id="s_name" value="<?=$rs["s_name"]?>" size="20" /></td>
     <? }?>
    <? if($en=="1"){?>
    <td width="13%"><input name="s_name1" type="text" id="s_name1" value="<?=$rs["s_name1"]?>" size="20" /></td>
     <? }?>
    <? if($ft=="1"){?>
    <td width="13%"><input name="s_name2" type="text" id="s_name2" value="<?=$rs["s_name2"]?>" size="20" /></td>
    <? }?>
    <td width="8%"><input   ttt="<?=$rs["id"]?>" name="s_order" type="text" id="s_order" value="<?=$rs["s_order"]?>" size="8" /></td>
    <td width="20%"><input value="修改" id="but" name="but" type="submit" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input onclick="if(confirm('确认要删除吗？')){location.href='<?=getSplit(getUrl(),"&action=",0)?>&action=del&id=<?=$rs["id"]?>';}" value="删除" id="" name="" type="button" /></td>
</tr>
      
  </form>      
 
  <? }?>  
        
        
    </table>
    
    
    
    <div class=" bacf1 mar10 pad5 borddd">
    
    <form  action="<?=getSplit(getUrl(),"&action=",0)?>&action=add" method="post" id="xingforms">
     名称: <input name="addsname" id="addsname" />&nbsp;&nbsp;
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