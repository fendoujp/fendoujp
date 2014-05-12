<? header("Content-Type: text/html; charset=utf-8");?>
<?php session_start();?>
<?php include("../../inc/publicfunction.php"); ?>
<?php include("../../inc/turepage.php"); ?>
<?
	$s_title = gg("title");
	$s_type = gg("s_type");
	$s_oks= gg("s_ok");
?>
<?
	if(gg("action")=="del"){
		$da = new db;
		$da->setQuser("delete from excel   where id = ".gg("id")." ");
		$da->closeDb();
		ee(js("location.href='".getSplit(getUrl(),"&action",0)."'"));
	}
	if(gg("action")=="pdel"){
		$da = new db;
		$da->setQuser("delete from excel   where id in( ".gp("allids")." ) ");
		$da->closeDb();
		ee(js("location.href='".getSplit(getUrl(),"&action",0)."'"));
	}
	if(gg("action")=="checkok"){
		$da = new db;
		$nowNum = $da->getCount("select * from excel where s_type = '".$s_type."' and s_ok = ".unescape(gg("value"))."   ");
		$setNum = $da->get_s("select s_num from status where s_type = '".$s_type."' and id = ".unescape(gg("value"))."  ");
		if($setNum!=0&&$nowNum>=$setNum){
			ej("alert('己达此栏目设置最大数目');location.href='".getSplit(getUrl(),"&action",0)."'");
		}
		$da->setQuser("update excel set s_ok = '".unescape(gg("value"))."' where id = ".gg("id")." ");
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
    	<th width="3%">选择</th>
    	<th width="3%">Id</th>
     	<th width="1%">type</th>
        <th>名称1</th>
        <th>名称2</th>
        <? if($s_oks=="1"){?>
    	  <th width="5%">状态</th>
         <? }?>
        <th width="21%">操作</th>
     </tr>
     
 <?
    $dan = new db;
	$sqld="";
	$sqlStr = "";
	$pp = new page(gg("pageId"),30,$dan->getCount("select * from excel   where 1=1 and s_type = '".$s_type."'    "),getUrl());
	$result = $dan->setQuser("select * from excel  where 1=1 and s_type = '".$s_type."'      limit ".$pp->limitStart().",".$pp->limitEnd()."  ");
	$ii=0;
	
	while($rs=$dan->setFetch($result)){
?>  
 
     <tr>
     	 <td width="3%"> <input value="<?=$rs["id"]?>" type="checkbox" id="getid<?=$rs["id"]?>" name="getid" />  </td>
             <td width="3%"><?=$rs["id"]?></td>
             <td width="1%"><?=$rs["s_type"]?></td>
              
              <td><?=$rs["s1"]?></td>  
   
 			  <td><?=$rs["s2"]?></td> 
   
   
   
   
   
   
   
   
   <? $cc = new db;?>
<? if($s_oks=="1"){?>
 <td width="5%">
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
   	<td width="21%" nowrap="nowrap">

 <input onclick="location.href='a_do.php<?=getSplit(getSplit(getUrl(),".php",1),"&id=",0)?>&id=<?=$rs["id"]?>'" type="button" value="修改" />


 &nbsp;&nbsp;&nbsp;&nbsp;
 <input onclick="if(confirm('删除操作不可恢复,确定要删除吗？')){location.href='<?=getUrl()?>&action=del&id=<?=$rs["id"]?>'}" type="button" value="删除" />

 </td>
   
   
   
   
   
   
   
   
   
   </tr>
   <? $ii++;  }?>    
   
   <tr>
        <td colspan="18" class="page" style="height:25px; padding:5px 0;  "> 
		<form action="<?=getSplit(getUrl(),"&actoin",0)?>&action=pdel" method="post" id="ffs" name="ffs">
		<? e($pp->mPage());?> 
        
         &nbsp;&nbsp;&nbsp;&nbsp;
        <a href="javascript:void(0);" onclick="checkAll('getid');">全选</a>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="checkfAll('getid')">反选</a>
        &nbsp;&nbsp;<a href="javascript:void(0);" onclick="checkbAll('getid');">全不选</a>
        
        
        &nbsp;&nbsp;&nbsp;&nbsp;
        
        <input value="批量删除" onclick="if(confirm('删除操作不可恢复，确定要删除')){document.getElementById('allids').value=(getCheckboxValue('getid'));document.getElementById('ffs').submit();}else{}" type="button" />
        <input type="hidden" value="" name="allids" id="allids" />
   
        
         <!-- &nbsp;&nbsp;&nbsp;&nbsp;
        <input value="批量修改" type="button" onclick="document.getElementById('allids').value=(getCheckboxValue('getid'));document.getElementById('ffs').action='pcheckaddress.php?<?//=getSplit(getUrl(),"?",1)?>';document.getElementById('ffs').submit();" />
        -->
        </form>
        
        </td>
     </tr>
     
 </table>
    
  
 
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