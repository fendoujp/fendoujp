<? header("Content-Type: text/html; charset=utf-8");?>
<?php session_start();?>
<?php include("../../inc/publicfunction.php"); ?>

<?php include("../../inc/turepage.php"); ?>

<?
	$sqld="";
	$s_type = gg("s_type");
	$search = unescape(gg("search"));
	$s_img = gg("s_img");
	$s_add = gg("s_add");
	$s_del = gg("s_del");
	$s_check = gg("s_check");
	$s_oks = gg("s_ok");
	$s_title = gg("title");
	$allok = gg("allok");
	$ordertype = gg("ordertype");
	$orders = gg("orders");
	$idda = gg("idda");
	$idxi = gg("idxi");
	$parent_id = gg("parent_id");
	if($parent_id==""){$parent_id=0;}
	$s_next = gg("s_next");
	if($s_next==""){$s_next=0;}
	$dd = new db();
	$class_depth = $dd->get_s("select class_depth from p_class  where parent_id = ".$parent_id."   ");
	//e($class_depth);
?>
<?
	if(gg("action")=="checkName"){
		$da = new db;
		$da->setQuser("update p_class set s_name = '".unescape(gg("value"))."' where id = ".gg("id")." ");
		$da->closeDb();
		ee(js("location.href='".getSplit(getUrl(),"&action",0)."'"));
	}
	if(gg("action")=="checkNum"){
		$da = new db;
		$da->setQuser("update p_class set s_order = '".unescape(gg("value"))."' where id = ".gg("id")." ");
		$da->closeDb();
		ee(js("location.href='".getSplit(getUrl(),"&action",0)."'"));
	}
	if(gg("action")=="del"){
		$da = new db;
		$da->setQuser("delete from p_class  where id = ".gg("id")." ");
		$da->closeDb();
		ee(js("location.href='".getSplit(getUrl(),"&action",0)."'"));
	}
	if(gg("action")=="pdel"){
		$da = new db;
		$da->setQuser("delete from p_class  where id in( ".gp("allids")." ) ");
		$da->closeDb();
		ee(js("location.href='".getSplit(getUrl(),"&action",0)."'"));
	}
	if(gg("action")=="checkok"){
		$da = new db;
		$nowNum = $da->getCount("select * from p_class where s_type = '".$s_type."' and s_ok = ".unescape(gg("value"))."   ");
		$setNum = $da->get_s("select s_num from status where s_type = '".$s_type."' and id = ".unescape(gg("value"))."  ");
		if($setNum!=0&&$nowNum>=$setNum){
			ej("alert('己达此栏目设置最大数目');location.href='".getSplit(getUrl(),"&action",0)."'");
		}
		$da->setQuser("update p_class set s_ok = '".unescape(gg("value"))."' where id = ".gg("id")." ");
		$da->closeDb();
		ee(js("location.href='".getSplit(getUrl(),"&action",0)."'"));
	}
	
	
	if(gg("action")=="checkallorder"){
		$allorder = gp("allorder");
		$allid = gp("allid");
		$dd = new db();
		$allidarr = splitArray($allid,"|");
		$allorderarr = splitArray($allorder,"|");
		for($i=0;$i<count($allidarr);$i++){
			$dd->setQuser("update p_class  set s_order = ".$allorderarr[$i]." where id = ".$allidarr[$i]."  ");
		}
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
   	搜索：<input  name="searchtext" type="text" id="searchtext" value="<?=$search?>" size="13" />
    <input id="srarchbutton" onclick="location.href='<?=getSplit(getUrl(),"&search",0)?>&search='+escape(getId('searchtext').value)" value="确定" type="button" />
    
    
    <? if($s_oks=="1"){?>
    &nbsp;&nbsp;&nbsp;状态：
    <select onchange="location.href='<?=getSplit(getUrl(),"&allok",0)?>&allok='+this.value" id="allok" name="allok">
    <option value="">全部</option>
	<?
        $cc = new db;
        $result2 = $cc->setQuser("select * from status where 1=1 and s_type = '".$s_type."'     order by s_order asc,id desc   ");
        $eee=0;
        while($rs2=$cc->setFetch($result2)){
    ?>    
      <option style="color:<?=$rs2["s_color"]?>" <?=iif($allok==$rs2["id"],"selected","")?> value="<?=$rs2["id"]?>"><?=$rs2["s_name"]?></option>
      
  	 <? $eee++; }$cc->closeDb();?>    
      
      </select>
    <? }?>
    
    &nbsp;&nbsp;&nbsp;
    
    排序：
<select id="ordertype" name="ordertype">
    	<option value="">默认</option>
        <option <?=iif($ordertype=="s_order","selected","")?> value="s_order">order</option>
        <option <?=iif($ordertype=="idtype","selected","")?> value="idtype">时间</option>
    </select>
    &nbsp;&nbsp;
     <select id="orders" name="orders">
<option value="">默认</option>
        <option <?=iif($orders=="asc","selected","")?> value="asc">顺序</option>
       <option <?=iif($orders=="desc","selected","")?> value="desc">倒序</option>
    </select>
    &nbsp;&nbsp;
    <input id="srarchbutton" onclick="location.href='<?=getSplit(getUrl(),"&ordertype",0)?>&ordertype='+escape(getId('ordertype').value)+'&orders='+escape(getId('orders').value)" value="确定" type="button" />
    &nbsp;&nbsp;&nbsp;
    
    ID范围：
    大于 <input onkeyup="if(isNaN(this.value)){this.value='';}" name="idda" type="text" id="idda" value="<?=$idda?>" size="5" />
    小于 <input onkeyup="if(isNaN(this.value)){this.value='';}" name="idxi" type="text" id="idxi" value="<?=$idxi?>" size="5" />
    &nbsp;&nbsp;
    
      <input id="srarchbutton" onclick="location.href='<?=getSplit(getUrl(),"&idda",0)?>&idda='+escape(getId('idda').value)+'&idxi='+escape(getId('idxi').value)" value="确定" type="button" />


    &nbsp;&nbsp;&nbsp;
    <? if($s_add=="1"){?>
    <input onclick="location.href='p_class_detail.php<?=getSplit(getSplit(getUrl(),".php",1),"&id=",0)?>'" value="添加本级分类" type="button" />
    <? }?>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <input onclick="history.go(-1)" value="返回上一步" type="button" />
    </div>
    
    
   
	<table  id="tableLists" border="1">

    	<tr>
        <? if($s_del=="1"){?><th width="3%">选择</th><? }?>
    	  <th width="3%">Id</th>
          <th width="3%">type</th>
          <? if($s_img>0){?>
          <th width="6%">图片</th>
          <? }?>
          <? if($s_img>1){?>
          <th width="6%">图片1</th>
          <? }?>
          <? if($s_img>2){?>
          <th width="6%">图片2</th>
          <? }?>
          <? if($s_img>3){?>
          <th width="6%">图片3</th>
          <? }?>
          <? if($s_img>4){?>
          <th width="6%">图片4</th>
          <? }?>
          <? if($s_img>5){?>
          <th width="6%">图片5</th>
          <? }?>
          <? if($s_img>6){?>
          <th width="6%">图片6</th>
          <? }?>
          <? if($s_img>7){?>
          <th width="6%">图片7</th>
          <? }?>
          <? if($s_img>8){?>
          <th width="6%">图片8</th>
          <? }?>
          <? if($s_img>9){?>
          <th width="6%">图片9</th>
          <? }?>
          
          <th width="51%">分类</th>
         
          <? if($s_next!="0"){?>
          	<? if($class_depth<$s_next){?>
          <th width="23%">下级分类</th>
          	<? }?>
           <? }?>
          <th width="12%">创建时间</th>
          <th width="5%">排序</th>
          <? if($s_oks=="1"){?>
    	  <th width="5%">状态</th>
          <? }?>
  <?// if($s_check!="0"||$s_del!="0"){?>        
    	  <th width="21%">操作</th> 
   <?// }?>       
          </tr>
<?
    $dan = new db;
	if($search!=""){$sqld = " and s_name like  '%".$search."%'  ";}
	if($allok!=""){$sqld = $sqld." and s_ok =  ".$allok."  ";}

	if($idda!=""){$sqld = $sqld." and id >= ".$idda." ";}
	if($idxi!=""){$sqld = $sqld." and id <= ".$idxi." ";}
	
	if($ordertype==""){$ordertype="s_order";}
	if($orders==""){$orders="asc";}
	if($ordertype=="s_order"){ $sqld = $sqld."order by s_order ";}
	if($ordertype=="idtype"){ $sqld = $sqld."order by id ";}
	if($orders=="asc"){ $sqld = $sqld." asc ";}
	if($orders=="desc"){ $sqld = $sqld." desc ";}
	
	if($ordertype==""&&$orders==""){$sqld = $sqld." order by s_order asc,id desc  ";}
	$sqlStr = "";
	$pp = new page(gg("pageId"),20,$dan->getCount("select * from p_class  where 1=1 and parent_id=".$parent_id." and s_type = '".$s_type."'  ".$sqld."   "),getUrl());
	$result = $dan->setQuser("select * from p_class  where 1=1 and parent_id=".$parent_id." and s_type = '".$s_type."'  ".$sqld."   limit ".$pp->limitStart().",".$pp->limitEnd()."  ");
	$ii=0;
	
	while($rs=$dan->setFetch($result)){
?>       
 <form  method="post" action="<?=getUrl()?>&action=add&id=<?=$id?>" id="forms" name="forms">   
 <tr>    
   <? if($s_del=="1"){?> 
 <td width="3%">
 <? if($dan->getCount("select * from p_class where 1=1 and parent_id= ".$rs["id"]."  ")=="0"){
	 	if($dan->getCount("select * from p_main where 1=1 and classid = ".$rs["id"]."   ")==""){
?>
 <input value="<?=$rs["id"]?>" type="checkbox" id="getid<?=$rs["id"]?>" name="getid" />
 
 <? }}}?>  
 <td width="3%"><?=$rs["id"]?></td>
 
 
 
 <td width="3%"><?=$rs["s_type"]?></td>
<? if($s_img>0){?> 
 <td width="6%"><img onmousemove="this.width=100;this.height=100;"onmouseout="this.width=50;this.height=50;" src="../../<?=$rs["s_img"]?>" width="50" height="50" /></td>
<? }?>
<? if($s_img>1){?> 
 <td width="6%"><img onmousemove="this.width=100;this.height=100;"onmouseout="this.width=50;this.height=50;" src="../../<?=$rs["s_img1"]?>" width="50" height="50" /></td>
<? }?>
<? if($s_img>2){?> 
 <td width="6%"><img onmousemove="this.width=100;this.height=100;"onmouseout="this.width=50;this.height=50;" src="../../<?=$rs["s_img2"]?>" width="50" height="50" /></td>
<? }?>
<? if($s_img>3){?> 
 <td width="6%"><img onmousemove="this.width=100;this.height=100;"onmouseout="this.width=50;this.height=50;" src="../../<?=$rs["s_img3"]?>" width="50" height="50" /></td>
<? }?>
<? if($s_img>4){?> 
 <td width="6%"><img onmousemove="this.width=100;this.height=100;"onmouseout="this.width=50;this.height=50;" src="../../<?=$rs["s_img4"]?>" width="50" height="50" /></td>
<? }?>
<? if($s_img>5){?> 
 <td width="6%"><img onmousemove="this.width=100;this.height=100;"onmouseout="this.width=50;this.height=50;" src="../../<?=$rs["s_img5"]?>" width="50" height="50" /></td>
<? }?>
<? if($s_img>6){?> 
 <td width="6%"><img onmousemove="this.width=100;this.height=100;"onmouseout="this.width=50;this.height=50;" src="../../<?=$rs["s_img6"]?>" width="50" height="50" /></td>
<? }?>
<? if($s_img>7){?> 
 <td width="6%"><img onmousemove="this.width=100;this.height=100;"onmouseout="this.width=50;this.height=50;" src="../../<?=$rs["s_img7"]?>" width="50" height="50" /></td>
<? }?>
<? if($s_img>8){?> 
 <td width="6%"><img onmousemove="this.width=100;this.height=100;"onmouseout="this.width=50;this.height=50;" src="../../<?=$rs["s_img8"]?>" width="50" height="50" /></td>
<? }?>
<? if($s_img>9){?> 
 <td width="6%"><img onmousemove="this.width=100;this.height=100;"onmouseout="this.width=50;this.height=50;" src="../../<?=$rs["s_img9"]?>" width="50" height="50" /></td>
<? }?>
 <td width="22%">
<? if($s_check=="1"){?>
 <input onchange="location.href='<?=getUrl()?>&action=checkName&id=<?=$rs["id"]?>&value='+escape(this.value)" value="<?=$rs["s_name"]?>" size="40" />
 <? }else{?>
 <?=$rs["s_name"]?>
 <? }?>
 </td>
 <? if($s_next!="0"){?>
 	<? if($class_depth<$s_next){?>
 <td width="23%"><a href="<?=getSplit(getUrl(),"&parent_id=",0)?>&parent_id=<?=$rs["id"]?>">二级分类(<?=$dan->getCount("select * from p_class where 1=1 and parent_id= ".$rs["id"]."  ")?>)</a></td>
 	<? }?>
 <? }?>
 <td width="12%" nowrap="nowrap"><?=$rs["s_time"]?></td>
 <td width="5%"><input id="s_order" name="s_order" ttt="<?=$rs["id"]?>" value="<?=$rs["s_order"]?>" size="10" /></td>
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
 
 
 <?// if($s_check!="0"||$s_del!="0"){?>
 <td width="21%" nowrap="nowrap">
 <?// if($s_check=="1"){?>
 <input onclick="location.href='p_class_detail.php<?=getSplit(getSplit(getUrl(),".php",1),"&id=",0)?>&id=<?=$rs["id"]?>'" type="button" value="修改" />
 <?//   }?>
 <? if($s_del=="1"){?>
 &nbsp;&nbsp;&nbsp;&nbsp;
 <? if($dan->getCount("select * from p_class where 1=1 and parent_id= ".$rs["id"]."  ")=="0"){
	 	if($dan->getCount("select * from p_main where 1=1 and classid = ".$rs["id"]."   ")==""){
?>
 
 <input onclick="if(confirm('确定要删除吗？')){location.href='<?=getUrl()?>&action=del&id=<?=$rs["id"]?>'}" type="button" value="删除" />
 <? 
		}else{
?>
	不能删()
<?	
		}
 	}else{?>
 		不能删
 <?   }}?>
 </td> 
 
 <?// }?>
 
 </tr>
 </form>           
          
<? $ii++;  }?>            
  
      <tr>
        <td colspan="18" class="page" style="height:25px; padding:5px 0;  "> 
		
        <form action="<?=getSplit(getUrl(),"&actoin",0)?>&action=pdel" method="post" id="ffs" name="ffs">
		<? e($pp->mPage());?> 
        
      
      <? if($s_del=="1"){?>
 		
          &nbsp;&nbsp;&nbsp;&nbsp;
        <a href="javascript:void(0);" onclick="checkAll('getid');">全选</a>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="checkfAll('getid')">反选</a>
        &nbsp;&nbsp;<a href="javascript:void(0);" onclick="checkbAll('getid');">全不选</a>
        
        &nbsp;&nbsp;&nbsp;&nbsp;
        
        <input value="批量删除" onclick="if(confirm('删除操作不可恢复，确定要删除')){document.getElementById('allids').value=(getCheckboxValue('getid'));document.getElementById('ffs').submit();}else{}" type="button" />
        <input type="hidden" value="" name="allids" id="allids" />
        
   <? }?>
         &nbsp;&nbsp;&nbsp;&nbsp;  <input value="批量修改排序" type="button" onclick="psave();" />
     </form>   
     <form style="display:none" action="<?=getSplit(getUrl(),"&action=",0)?>&action=checkallorder" method="post" id="yforms">
    	<input id="allorder" name="allorder" /><input id="allid" name="allid" />
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