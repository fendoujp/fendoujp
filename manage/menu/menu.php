<? header("Content-Type: text/html; charset=utf-8");?>
<?php session_start();?>
<?php include("../../inc/publicfunction.php"); ?>

<?
	function addMenu(){
		$dd = new db;
		$order=$dd->get_s("select s_order from s_menu_class  order by s_order desc  ");
		$s_name = gp("addsname");
		if($s_name==""){$s_name="新增栏目";}
		$s_type = gp("addstype");
		$dd->setQuser("insert into s_menu_class (s_name,s_type,s_order)values('".$s_name."','".$s_type."','".($order+1)."')");	
		$dd->closeDb();
	}
	function delMenu($menuId){
		$dd = new db;
		$dd->setQuser("delete from s_menu_class where id=".$menuId."");	
		$dd->closeDb();
	}
	function checkMenu($text,$meniId){
		$dd = new db;
		$dd->setQuser("update s_menu_class set  ".$text." where id = ".$meniId."   ");	
		$dd->closeDb();
	}
	if(gg("action")=="add"){
		addMenu();
		ee(js("location.href='menu.php'"));
	}
	if(gg("action")=="del"){
		delMenu(gg("id"));
		ee(js("location.href='menu.php'"));
	}
	if(gg("action")=="checkall"){
		
		$text = "s_name='".gp("s_name")."',s_type='".gp("s_type")."',s_order='".gp("s_order")."',s_ok='".gp("s_ok")."' ";
		//ee($text);
		checkMenu($text,gg("id"));
		ee(js("location.href='menu.php'"));
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
			$dd->setQuser("update s_menu_class  set s_order = ".$allorderarr[$i]." where id = ".$allidarr[$i]."  ");
		}
		ee(js("location.href='menu.php'"));
	}
	
	if(gg("action")=="checkallokm"){
		$allokm = gp("allokm");
		$allidm = gp("allidm");
		$dd = new db();
		//en($allid);
		//en($allorder);
		$allidmarr = splitArray($allidm,"|");
		$allokmarr = splitArray($allokm,"|");
		for($i=0;$i<count($allidmarr);$i++){
			$dd->setQuser("update s_menu_class  set s_ok = ".$allokmarr[$i]." where id = ".$allidmarr[$i]."  ");
		}
		ee(js("location.href='menu.php'"));
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
<body style="height:auto;">
<div>
	<div class="title">栏目管理</div>
	<table id="tableLists" border="1">
    	
        
        <tr><th width="4%">ID</th><th width="10%">类型</th><th width="56%">栏目名称</th>
          
        <th width="9%">排序</th><th width="8%">状态</th><th width="13%">操作</th></tr>
        
  <?
  	$dan = new db;
	$res = $dan->setQuser("select * from s_menu_class where 1=1 and parent_id=0 order by s_order asc,id asc");
	$ri=0;
	while($rs=$dan->setFetch($res)){
  ?>   
  <form action="?action=checkall&id=<?=$rs["id"]?>" method="post" id="myforms">   
      <tr>
      <td><?=$rs["id"]?></td>
      <td><input value="<?=$rs["s_type"]?>" name="s_type" id="s_type" size="15"  /></td>
      <td><input value="<?=$rs["s_name"]?>" name="s_name" id="s_name" size="50"  /></td>
        
        <td><input value="<?=$rs["s_order"]?>" name="s_order" id="s_order" size="10" ttt="<?=$rs["id"]?>" /></td>
        <td>
      
      <select ttt=<?=$rs["id"]?> id="s_ok" name="s_ok">
      
      <option <?=iif($rs["s_ok"]==1,"selected","")?> value="1">显示</option>
      <option <?=iif($rs["s_ok"]==0,"selected","")?> value="0" style="color:#ff0000;">隐藏</option>
      
      </select>
      </td>
      <td nowrap="nowrap"><input id="formsub<?=$ri?>" name="提交" type="submit" value="修改" /><? ek("",5);?><input value="删除" type="button" onclick="if(confirm('确定要删除此栏目吗？')){location.href='?action=del&id=<?=$rs["id"]?>';}" /></td>
      
      </tr>
      
    </form>    
   <? $ri++;}$dan->closeDb();?>     
        
        
    </table>
    
    
    
    <div class=" bacf1 mar10 pad5 borddd">
    <form  action="?action=add" method="post" id="xingforms">
     类型: <input size="15" name="addstype" id="addstype" />&nbsp;&nbsp;
     栏目名称: <input name="addsname" id="addsname" />&nbsp;&nbsp;
     
     
    <input value="添加栏目" type="button" onclick="if(confirm('确定要添加栏目吗？')){document.getElementById('xingforms').submit();}" />
    
   &nbsp;&nbsp;&nbsp;&nbsp;  <input value="批量修改排序" type="button" onclick="psave();" />
    
    &nbsp;&nbsp;&nbsp;&nbsp;  <input value="批量修改状态" type="button" onclick="psaveokm();" />
    </form>
    <form style="display:none" action="?action=checkallorder" method="post" id="yforms">
    	<input id="allorder" name="allorder" /><input id="allid" name="allid" />
    </form>
    
    <form style="display:none" action="?action=checkallokm" method="post" id="yformsm">
    	<input id="allokm" name="allokm" /><input id="allidm" name="allidm" />
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

function psaveokm(){
	arr = document.getElementsByName("s_ok");
	var allokm="";
	var allidm="";
	for(var i=0;i<arr.length;i++){
		if(allokm==""){
			allokm=arr.item(i).value;
			allidm=arr.item(i).getAttribute("ttt");
		}else{
			allokm+="|"+arr.item(i).value;
			allidm+="|"+arr.item(i).getAttribute("ttt");
		}
	}

	document.getElementById("allokm").value = allokm;
	document.getElementById("allidm").value = allidm;
	document.getElementById("yformsm").submit();
}

</script>
