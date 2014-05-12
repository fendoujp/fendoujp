<? header("Content-Type: text/html; charset=utf-8");?>
<?php session_start();?>
<?php include("../../inc/publicfunction.php")?>
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
	$s_type = gg("s_type");
	$s_img = gg("s_img");
	$s_text = gg("s_text");
	$s_add = gg("s_add");
	$s_del = gg("s_del");
	$s_ok = gg("s_ok");
	$title = gg("title");
	$id = gg("id");
?>
<?
	function gpimg($text){
		return (str_replace("../","",gp($text)));
	}
?>
<?
	if(gg("action")=="check"){
		$dd = new db();
		
		$dd->dateArr["s_type"] = $s_type;
		$dd->dateArr["s_name"] = gp("s_text");
		$dd->dateArr["s_name1"] = gp("s_text1");
		$dd->dateArr["s_name2"] = gp("s_text2");
		$dd->dateArr["s_name3"] = gp("s_text3");
		$dd->dateArr["s_name4"] = gp("s_text4");
		$dd->dateArr["s_name5"] = gp("s_text5");
		$dd->dateArr["s_name6"] = gp("s_text6");
		$dd->dateArr["s_name7"] = gp("s_text7");
		$dd->dateArr["s_name8"] = gp("s_text8");
		$dd->dateArr["s_name9"] = gp("s_text9");

		$dd->dateArr["s_img"] = gpimg("s_img".gg("id"));
		$dd->dateArr["s_img1"] = gpimg("s_img1".gg("id"));
		$dd->dateArr["s_img2"] = gpimg("s_img2".gg("id"));
		$dd->dateArr["s_img3"] = gpimg("s_img3".gg("id"));
		$dd->dateArr["s_img4"] = gpimg("s_img4".gg("id"));
		$dd->dateArr["s_img5"] = gpimg("s_img5".gg("id"));
		$dd->dateArr["s_img6"] = gpimg("s_img6".gg("id"));
		$dd->dateArr["s_img7"] = gpimg("s_img7".gg("id"));
		$dd->dateArr["s_img8"] = gpimg("s_img8".gg("id"));
		$dd->dateArr["s_img9"] = gpimg("s_img9".gg("id"));
		$dd->dateArr["s_order"] = gp("s_order");

		$dd->phpUpdate("select * from o_ad where id = ".gg("id")."  ");
		$dd->closeDb();
		$url = getSplit(getUrl(),"&action=",0);
		ee(js("location.href='".$url."'"));
	}
	
	if(gg("action")=="add"){
		$dd = new db();
		$order=$dd->get_s("select s_order from o_ad  order by s_order desc  ");
		$dd->dateArr["s_order"] = $order+1;
		$addsname = gp("addsname");if($addsname==""){$addsname="说明";}
		$dd->dateArr["s_name"] = $addsname;
		$dd->dateArr["s_type"] = $s_type;
		$s_ok = $dd->get_s("select id from status where s_type = '".$s_type."' and s_ok = 1  ");
		$dd->dateArr["s_ok"]=$s_ok;
		$dd->addNews = true;

		$dd->phpUpdate("select * from o_ad where 1=1  ");
		$dd->closeDb();
		$url = getSplit(getUrl(),"&action=",0);
		ee(js("location.href='".$url."'"));
	}
	if(gg("action")=="del"){
		$dd = new db();
		$dd->setQuser("delete from o_ad where id = ".gg("id")."  ");
		$url = getSplit(getUrl(),"&action=",0);
		ee(js("location.href='".$url."'"));
	}
	
	if(gg("action")=="checkok"){
		$da = new db;
		$nowNum = $da->getCount("select * from o_ad where s_type = '".$s_type."' and s_ok = ".unescape(gg("value"))."   ");
		$setNum = $da->get_s("select s_num from status where s_type = '".$s_type."' and id = ".unescape(gg("value"))."  ");
		if($setNum!=0&&$nowNum>=$setNum){
			ej("alert('己达此栏目设置最大数目');location.href='".getSplit(getUrl(),"&action",0)."'");
		}
		$da->setQuser("update o_ad set s_ok = '".unescape(gg("value"))."' where id = ".gg("id")." ");
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
			$dd->setQuser("update o_ad  set s_order = ".$allorderarr[$i]." where id = ".$allidarr[$i]."  ");
		}
		ee(js("location.href='".getSplit(getUrl(),"&action",0)."'"));
	}
	
?>
<body style="height:auto;">

<div>
<div class="title"><?=$title?>管理</div>

  
    
    
	<table id="tableLists" border="1">
    	
        
        <tr>
          <th width="2%">ID</th>
          <th width="3%">type</th>
          <? if($s_text>0){?>
          <th width="10%">说明</th>
          <? }?>
     	  <? if($s_text>1){?>
          <th width="10%">说明1</th>
          <? }?>
     	  <? if($s_text>2){?>
          <th width="10%">说明2</th>
          <? }?>
     	  <? if($s_text>3){?>
          <th width="10%">说明3</th>
          <? }?>
     	  <? if($s_text>4){?>
          <th width="10%">说明4</th>
          <? }?>
     	  <? if($s_text>5){?>
          <th width="10%">说明5</th>
          <? }?>
     	  <? if($s_text>6){?>
       	  <th width="10%">说明6</th>
          <? }?>
     	  <? if($s_text>7){?>
          <th width="10%">说明7</th>
          <? }?>
     	  <? if($s_text>8){?>
          <th width="10%">说明8</th>
          <? }?>
     	  <? if($s_text>9){?>
          <th width="10%">说明9</th>
          <? }?>
     	  <? if($s_img>0){?>
          <th width="10%">图片</th>
          <? }?>
     	  <? if($s_img>1){?>
          <th width="10%">图片1</th>
          <? }?>
     	  <? if($s_img>2){?>
          <th width="10%">图片2</th>
          <? }?>
     	  <? if($s_img>3){?>
          <th width="10%">图片3</th>
          <? }?>
     	  <? if($s_img>4){?>
          <th width="10%">图片4</th>
          <? }?>
     	  <? if($s_img>5){?>
          <th width="10%">图片5</th>
          <? }?>
     	  <? if($s_img>6){?>
          <th width="10%">图片6</th>
          <? }?>
     	  <? if($s_img>7){?>
          <th width="10%">图片7</th>
          <? }?>
     	  <? if($s_img>8){?>
          <th width="10%">图片8</th>
          <? }?>
     	  <? if($s_img>9){?>
          <th width="10%">图片9</th>
          <? }?>
           <? if($s_ok=="1"){?>
           <th width="10%">状态</th>
           <? }?>
          <th width="3%">排序</th>
            <th width="18%">操作</th>
        </tr>
        
  <?
 	$dan = new db();
	$result = $dan->setQuser("select * from  o_ad where 1=1 and s_type = '".$s_type."' order by s_order asc ,id desc ");
	while($rs=$dan->setFetch($result)){
 ?>      
  <form action="<?=getSplit(getUrl(),"&action=",0)?>&action=check&id=<?=$rs["id"]?>" method="post" id="myforms">
	 <tr>
      <td width="2%"><?=$rs["id"]?></td>
      <td width="3%"><?=gg("s_type")?></td>
      <? if($s_text>0){?>
      <td width="10%"><?=$rs["s_name"]?></td>
      <? }?>
      <? if($s_text>1){?>
      <td width="10%"><input value="<?=$rs["s_name1"]?>" name="s_text1" type="text" id="s_text1"  size="10" /></td>
      <? }?>
      <? if($s_text>2){?>
      <td width="10%"><input value="<?=$rs["s_name2"]?>" name="s_text2" type="text" id="s_text2"  size="10" /></td>
      <? }?>
      <? if($s_text>3){?>
      <td width="10%"><input value="<?=$rs["s_text3"]?>" name="s_text3" type="text" id="s_text3"  size="10" /></td>
      <? }?>
      <? if($s_text>4){?>
      <td width="10%"><input value="<?=$rs["s_name4"]?>" name="s_text4" type="text" id="s_text4"  size="10" /></td>
      <? }?>
      <? if($s_text>5){?>
      <td width="10%"><input value="<?=$rs["s_name5"]?>" name="s_text5" type="text" id="s_text5"  size="10" /></td>
      <? }?>
      <? if($s_text>6){?>
      <td width="10%"><input value="<?=$rs["s_name6"]?>" name="s_text6" type="text" id="s_text6"  size="10" /></td>
      <? }?>
      <? if($s_text>7){?>
      <td width="10%"><input value="<?=$rs["s_name7"]?>" name="s_text7" type="text" id="s_text7"  size="10" /></td>
      <? }?>
      <? if($s_text>8){?>
      <td width="10%"><input value="<?=$rs["s_name8"]?>" name="s_text8" type="text" id="s_text8"  size="10" /></td>
      <? }?>
      <? if($s_text>9){?>
      <td width="10%"><input value="<?=$rs["s_name9"]?>" name="s_text9" type="text" id="s_text9"  size="10" /></td> 
      <? }?>
     <? if($s_img>0){?>
      <td width="10%" nowrap="nowrap"><img src="../../<?=$rs["s_img"]?>" onmouseover="this.width=80;this.height=80;"onmouseout="this.width=10;this.height=10;" width="10" height="10"  /><?=upload("s_img".$rs["id"],$rs["s_img"])?></td>
      <? }?>
     <? if($s_img>1){?>
      <td width="10%" nowrap="nowrap"><img src="../../<?=$rs["s_img1"]?>" onmouseover="this.width=80;this.height=80;"onmouseout="this.width=10;this.height=10;" width="10" height="10"  /><?=upload("s_img1".$rs["id"],$rs["s_img1"])?></td>
      <? }?>
     <? if($s_img>2){?>
      <td width="10%" nowrap="nowrap"><img src="../../<?=$rs["s_img2"]?>" onmouseover="this.width=80;this.height=80;"onmouseout="this.width=10;this.height=10;" width="10" height="10"  /><?=upload("s_img2".$rs["id"],$rs["s_img2"])?></td>
      <? }?>
     <? if($s_img>3){?>
      <td width="10%" nowrap="nowrap"><img src="../../<?=$rs["s_img3"]?>" onmouseover="this.width=80;this.height=80;"onmouseout="this.width=10;this.height=10;" width="10" height="10"  /><?=upload("s_img3".$rs["id"],$rs["s_img3"])?></td>
      <? }?>
     <? if($s_img>4){?>
      <td width="10%" nowrap="nowrap"><img src="../../<?=$rs["s_img4"]?>" onmouseover="this.width=80;this.height=80;"onmouseout="this.width=10;this.height=10;" width="10" height="10"  /><?=upload("s_img4".$rs["id"],$rs["s_img4"])?></td>
      <? }?>
     <? if($s_img>5){?>
      <td width="10%" nowrap="nowrap"><img src="../../<?=$rs["s_img5"]?>" onmouseover="this.width=80;this.height=80;"onmouseout="this.width=10;this.height=10;" width="10" height="10"  /><?=upload("s_img5".$rs["id"],$rs["s_img5"])?></td>
      <? }?>
     <? if($s_img>6){?>
      <td width="10%" nowrap="nowrap"><img src="../../<?=$rs["s_img6"]?>" onmouseover="this.width=80;this.height=80;"onmouseout="this.width=10;this.height=10;" width="10" height="10"  /><?=upload("s_img6".$rs["id"],$rs["s_img6"])?></td>
      <? }?>
     <? if($s_img>7){?>
      <td width="10%" nowrap="nowrap"><img src="../../<?=$rs["s_img7"]?>" onmouseover="this.width=80;this.height=80;"onmouseout="this.width=10;this.height=10;" width="10" height="10"  /><?=upload("s_img7".$rs["id"],$rs["s_img7"])?></td>
      <? }?>
     <? if($s_img>8){?>
      <td width="10%" nowrap="nowrap"><img src="../../<?=$rs["s_img8"]?>" onmouseover="this.width=80;this.height=80;"onmouseout="this.width=10;this.height=10;" width="10" height="10"  /><?=upload("s_img8".$rs["id"],$rs["s_img8"])?></td>
      <? }?>
     <? if($s_img>9){?>
       <td width="10%" nowrap="nowrap"><img src="../../<?=$rs["s_img9"]?>" onmouseover="this.width=80;this.height=80;"onmouseout="this.width=10;this.height=10;" width="10" height="10"  /><?=upload("s_img9".$rs["id"],$rs["s_img9"])?></td> 
      <? }?>
		<? if($s_ok=="1"){?>
        <td width="10%">
        
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
        <? }?>
      <td width="3%"><input name="s_order" type="text" id="s_order" value="<?=$rs["s_order"]?>" size="10" ttt=<?=$rs["id"]?> /></td>
      <td width="18%"><input value="修改" id="but" name="but" type="submit" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      
       <? if($s_del=="1"){?>
      <input onclick="if(confirm('确认要删除吗？')){location.href='<?=getSplit(getUrl(),"&action=",0)?>&action=del&id=<?=$rs["id"]?>';}" value="删除" id="" name="" type="button" />
      <? }?>
      </td>
    </tr>
 
 
 </form>      
 
  <? }?>  
 
 
 
 
 
 
 
        
        
    </table>
    
 <? if($s_add=="1"){?>   
    
    <div class=" bacf1 mar10 pad5 borddd">
     <form  action="<?=getSplit(getUrl(),"&action=",0)?>&action=add" method="post" id="xingforms">
     说明: <input name="addsname" id="addsname" />&nbsp;&nbsp;
    <input value="添加" type="button" onclick="if(confirm('确定要添加吗？')){document.getElementById('xingforms').submit();}" />
     &nbsp;&nbsp;&nbsp;&nbsp;  <input value="批量修改排序" type="button" onclick="psave();" />
    </form>
    
    
     <form style="display:none" action="<?=getSplit(getUrl(),"&action=",0)?>&action=checkallorder" method="post" id="yforms">
    	<input id="allorder" name="allorder" /><input id="allid" name="allid" />
    </form>
  </div>
    
  <? }?>  
    
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
