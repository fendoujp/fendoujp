<? header("Content-Type: text/html; charset=utf-8");?>
<?php session_start();?>
<?php include("../../inc/publicfunction.php"); ?>


<?
	function gv($text){
		$id = gg("id");
		$dan = new db;
		if($id!=""){
			return ($dan->get_one("p_class",$text,$id));
		}else{
			return ("");	
		}
	}
	function gpimg($text){
		return (str_replace("../","",gp($text)));
	}
?>
<?
	$s_type = gg("s_type");
	$s_img = gg("s_img");
	$s_add = gg("s_add");
	$s_del = gg("s_del");
	$s_check = gg("s_check");
	$s_ok = gg("s_ok");
	$s_down = gg("s_down");
	$s_conj = gg("s_conj");
	$title = gg("title");
	$s_content = gg("s_content");
	$parent_id = gg("parent_id");
	if($parent_id==""){$parent_id=0;}
	//ee($parent_id);
	$dd = new db();
	$class_depth=$dd->get_s("select class_depth from p_class where id = ".$parent_id." ");
	$class_depth = $class_depth+1;
	//ee($class_depth);
	$id = gg("id");
	$dan = new db;
	$s_lan= $dan->get_s("select s_language from web_config");
	//ee($s_lan);
	//get_s("web_config ","s_language",1);
	if(strstr($s_lan,"1")){$gb=1;}else{$gb=0;}
	if(strstr($s_lan,"2")){$en=1;}else{$en=0;}
	if(strstr($s_lan,"3")){$ft=1;}else{$ft=0;}	
?>
<?
	if (gg("action")=="insertadd"){
		$dd = new db;
		$dd->dateArr["s_name"]=gp("s_name");
		$dd->dateArr["s_name1"]=gp("s_name1");
		$dd->dateArr["s_name2"]=gp("s_name2");
		$dd->dateArr["s_content"]=gp("s_content");
		$dd->dateArr["s_content1"]=gp("s_content1");
		$dd->dateArr["s_content2"]=gp("s_content2");
		$dd->dateArr["s_type"]=$s_type;
		$dd->dateArr["parent_id"] = $parent_id;
		$dd->dateArr["class_depth"] = $class_depth;
		//ee(gpimg("s_down"));
		$dd->dateArr["s_img"]=gpimg("s_img");
		$dd->dateArr["s_img1"]=gpimg("s_img1");
		$dd->dateArr["s_img2"]=gpimg("s_img2");
		$dd->dateArr["s_img3"]=gpimg("s_img3");
		$dd->dateArr["s_img4"]=gpimg("s_img4");
		$dd->dateArr["s_img5"]=gpimg("s_img5");
		$dd->dateArr["s_img6"]=gpimg("s_img6");
		$dd->dateArr["s_img7"]=gpimg("s_img7");
		$dd->dateArr["s_img8"]=gpimg("s_img8");
		$dd->dateArr["s_img9"]=gpimg("s_img9");
		
		$dd->dateArr["s_down"]=gpimg("s_down");
		$dd->dateArr["s_conj"]=gp("s_conj");
		$dd->dateArr["s_conj1"]=gp("s_conj1");
		$dd->dateArr["s_conj2"]=gp("s_conj2");		
		if($id==""){
			$dd->addNews = true;			
			$s_ok = $dd->get_s("select id from status where s_type = '".$s_type."' and s_ok = 1  ");
			if($s_ok!=""){	
				$dd->dateArr["s_ok"]=$s_ok;
			}
		}
		$dd->phpUpdate("select * from p_class where id = ".$id."");
		$dd->closeDb();
		$url = "p_class.php".getSplit(getSplit(getSplit(getUrl(),"&action",0),".php",1),"&id=",0);
		
		ee(js("location.href='".$url."'"));
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
	<div class="title"><?=$title?>添加</div>
    
 <form  method="post" action="<?=getSplit(getUrl(),"&action",0)?>&action=insertadd" id="forms" name="forms">   
	<table  id="tableLists" border="1">
    <? if($s_check=="1"){?>
    	 <? if($gb=="1"){?> 
        <tr><td width="11%">标题:</td><td width="89%"><input name="s_name" id="s_name" size="30" value="<?=gv("s_name")?>"  /></td></tr>
        <? }?>
        <? if($en=="1"){?>  
        <tr><td width="11%">标题en:</td><td width="89%"><input name="s_name1" id="s_name1" size="30" value="<?=gv("s_name1")?>"  /></td></tr>
 		<? }?>
        <? if($ft=="1"){?>
 		<tr><td width="11%">标题繁体:</td><td width="89%"><input name="s_name2" id="s_name2" size="30" value="<?=gv("s_name2")?>"  /></td></tr>
      	<? }?>
  <? }else{?>  
  		 <? if($gb=="1"){?> 
        <tr><td width="11%">标题:</td><td width="89%"><?=gv("s_name")?></td></tr>
        <? }?>
        <? if($en=="1"){?>  
        <tr><td width="11%">标题en:</td><td width="89%"><?=gv("s_name1")?></td></tr>
 		<? }?>
        <? if($ft=="1"){?>
 		<tr><td width="11%">标题繁体:</td><td width="89%"><?=gv("s_name2")?></td></tr>
  		<? }?>
  <? }?>    
        <? if($s_img>0){?>
      	<tr><td width="11%">上传图片1:<img onmouseover="this.width=100;this.height=100" onmouseout="this.width=30;this.height=30" src="../../<?=gv("s_img")?>" width="30" height="30" /></td><td width="89%"><?=upload("s_img",gv("s_img"))?></td></tr>
        <? }?>
        <? if($s_img>1){?>
        <tr><td width="11%">上传图片2:<img onmouseover="this.width=100;this.height=100" onmouseout="this.width=30;this.height=30" src="../../<?=gv("s_img1")?>" width="30" height="30" /></td><td width="89%"><?=upload("s_img1",gv("s_img1"))?></td></tr>
        <? }?>
        <? if($s_img>2){?>
        <tr><td width="11%">上传图片3:<img onmouseover="this.width=100;this.height=100" onmouseout="this.width=30;this.height=30" src="../../<?=gv("s_img2")?>" width="30" height="30" /></td><td width="89%"><?=upload("s_img2",gv("s_img2"))?></td></tr>
        <? }?>
        <? if($s_img>3){?>
        <tr><td width="11%">上传图片4:<img onmouseover="this.width=100;this.height=100" onmouseout="this.width=30;this.height=30" src="../../<?=gv("s_img3")?>" width="30" height="30" /></td><td width="89%"><?=upload("s_img3",gv("s_img3"))?></td></tr>
        <? }?>
        <? if($s_img>4){?>
        <tr><td width="11%">上传图片5:<img onmouseover="this.width=100;this.height=100" onmouseout="this.width=30;this.height=30" src="../../<?=gv("s_img4")?>" width="30" height="30" /></td><td width="89%"><?=upload("s_img4",gv("s_img4"))?></td></tr>
        <? }?>
        <? if($s_img>5){?>
        <tr><td width="11%">上传图片6:<img onmouseover="this.width=100;this.height=100" onmouseout="this.width=30;this.height=30" src="../../<?=gv("s_img5")?>" width="30" height="30" /></td><td width="89%"><?=upload("s_img5",gv("s_img5"))?></td></tr>
        <? }?>
        <? if($s_img>6){?>
        <tr><td width="11%">上传图片7:<img onmouseover="this.width=100;this.height=100" onmouseout="this.width=30;this.height=30" src="../../<?=gv("s_img6")?>" width="30" height="30" /></td><td width="89%"><?=upload("s_img6",gv("s_img6"))?></td></tr>
        <? }?>
        <? if($s_img>7){?>
        <tr><td width="11%">上传图片8:<img onmouseover="this.width=100;this.height=100" onmouseout="this.width=30;this.height=30" src="../../<?=gv("s_img7")?>" width="30" height="30" /></td><td width="89%"><?=upload("s_img7",gv("s_img7"))?></td></tr>
        <? }?>
        <? if($s_img>8){?>
        <tr><td width="11%">上传图片9:<img onmouseover="this.width=100;this.height=100" onmouseout="this.width=30;this.height=30" src="../../<?=gv("s_img8")?>" width="30" height="30" /></td><td width="89%"><?=upload("s_img8",gv("s_img8"))?></td></tr>
        <? }?>
        <? if($s_img>9){?>
        <tr><td width="11%">上传图片10:<img onmouseover="this.width=100;this.height=100" onmouseout="this.width=30;this.height=30" src="../../<?=gv("s_img9")?>" width="30" height="30" /></td><td width="89%"><?=upload("s_img9",gv("s_img9"))?></td></tr>
        <? }?>
        <? if($s_down>1){?>
		<tr><td width="11%">上传资料:</td><td width="89%"><?=upload("s_down",gv("s_down"))?></td></tr>
        <? }?>
        
   <? if($s_conj=="1"){?>     
        <? if($gb=="1"){?>
        
        <tr><td width="11%">简要说明:</td><td width="89%">
          
          <textarea style="display:none" name="s_conj" id="s_conj"><?=gv("s_conj")?></textarea>
          <IFRAME ID="txtcontent" src="../eWebEditor/ewebeditor.htm?id=s_conj&style=mini" frameborder="0" scrolling="no" width="600" height="150"></IFRAME>
          
          </td>
       </tr>
       <? }?>
       <? if($en=="1"){?>
         <tr><td width="11%">简要说明en:</td><td width="89%">
          
          <textarea style="display:none" name="s_conj1" id="s_conj1"><?=gv("s_conj1")?></textarea>
          <IFRAME ID="txtcontent" src="../eWebEditor/ewebeditor.htm?id=s_conj1&style=mini" frameborder="0" scrolling="no" width="600" height="150"></IFRAME>
          
          </td>
       </tr>
       <? }?>
       <? if($ft=="1"){?>
         <tr><td width="11%">简要说明繁体:</td><td width="89%">
          
          <textarea style="display:none" name="s_conj2" id="s_conj2"><?=gv("s_conj2")?></textarea>
          <IFRAME ID="txtcontent" src="../eWebEditor/ewebeditor.htm?id=s_conj2&style=mini" frameborder="0" scrolling="no" width="600" height="150"></IFRAME>
          
          </td>
       </tr>
        <? }?>
        
  <? }?>  
 <? if($s_content=="1"){?> 
  
        <? if($gb=="1"){?>
      <tr><td width="11%">详细内容:</td><td width="89%">
          
          <textarea style="display:none" name="s_content" id="s_content"><?=gv("s_content")?></textarea>
          <IFRAME ID="txtcontent" src="../eWebEditor/ewebeditor.htm?id=s_content&style=coolblue" frameborder="0" scrolling="no" width="100%" height="300"></IFRAME>
          
          </td>
       </tr>
       <? }?>
       <? if($en=="1"){?>
        <tr><td width="11%">详细内容en:</td><td width="89%">
          
          <textarea style="display:none" name="s_content1" id="s_content1"><?=gv("s_content1")?></textarea>
          <IFRAME ID="txtcontent" src="../eWebEditor/ewebeditor.htm?id=s_content1&style=coolblue" frameborder="0" scrolling="no" width="100%" height="300"></IFRAME>
          
          </td>
       </tr>
       <? }?>
       <? if($ft=="1"){?>
        <tr><td width="11%">详细内容繁体:</td><td width="89%">
          
          <textarea style="display:none" name="s_content2" id="s_content2"><?=gv("s_content2")?></textarea>
          <IFRAME ID="txtcontent" src="../eWebEditor/ewebeditor.htm?id=s_content2&style=coolblue" frameborder="0" scrolling="no" width="100%" height="300"></IFRAME>
          
          </td>
       </tr>
       <? }?> 
  <? }?>      
          <tr>
        	  <td colspan="2">
        	  <input id="submits" onclick="cmdForm();" value=" 确 定 " type="submit" />
              &nbsp;&nbsp;&nbsp;
              <input name="重置" type="reset" value=" 重 置 " />
        	  </td>
          </tr>
        
    </table>
    
</form>    
    
    
    
    
    
</div>

</body>
</html>
