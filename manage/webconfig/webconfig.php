<? header("Content-Type: text/html; charset=utf-8");?>
<?php session_start();?>
<?php include("../../inc/publicfunction.php"); ?>
<?php include("../fckeditor/fckeditor.php")?>
<?
	$dan = new db;
	$id = gg("id");
	if($id==""){$id=1;}
	$s_name = $dan->get_one("web_config ","s_name",$id);
	$s_name1 = $dan->get_one("web_config ","s_name1",$id);
	$s_name2 = $dan->get_one("web_config ","s_name2",$id);
	$s_keywords = $dan->get_one("web_config ","s_keywords",$id);
	$s_keywords1 = $dan->get_one("web_config ","s_keywords1",$id);
	$s_keywords2 = $dan->get_one("web_config ","s_keywords2",$id);
	$s_count = $dan->get_one("web_config ","s_count",$id);
	$s_uploadset = $dan->get_one("web_config ","s_uploadset",$id);
	$s_mail_user = $dan->get_one("web_config ","s_mail_user",$id);
	$s_mail_smtp = $dan->get_one("web_config ","s_mail_smtp",$id);
	$s_mail_pwd = $dan->get_one("web_config ","s_mail_pwd",$id);
	$s_copyright = $dan->get_one("web_config ","s_copyright",$id);
	$s_copyright1 = $dan->get_one("web_config ","s_copyright1",$id);
	$s_copyright2 = $dan->get_one("web_config ","s_copyright2",$id);
	$s_description = $dan->get_one("web_config ","s_description",$id);
	$s_description1 = $dan->get_one("web_config ","s_description1",$id);
	$s_description2 = $dan->get_one("web_config ","s_description2",$id);
	$gmenustyle = $dan->get_one("web_config ","s_menustyle",$id);
	$s_lan= $dan->get_one("web_config ","s_language",$id);
	//ee($s_lan);
	if(strstr($s_lan,"1")){$gb=1;}else{$gb=0;}
	if(strstr($s_lan,"2")){$en=1;}else{$en=0;}
	if(strstr($s_lan,"3")){$ft=1;}else{$ft=0;}	
	$s_language = gg("s_language");
	$s_email = gg("s_email");
	$s_countPage = gg("s_count");
	$s_des = gg("s_des");
	$uploadset = gg("uploadset");
	$menustyle = gg("menustyle");
?>

<?

	if(gg("action")=="add"){
		$action = gg("action");
		$s_language = gpk("s_language");
		
		$s_name =  gp("s_name");
		$s_name1 =gp("s_name1");
		$s_name2 = gp("s_name2");
		$s_keywords = gp("s_keywords");
		$s_keywords1 = gp("s_keywords1");
		$s_keywords2 = gp("s_keywords2");
		
		$s_description = gp("s_description");
		$s_description1 = gp("s_description1");
		$s_description2 = gp("s_description2");
		$menustyle = gp("menustyle");
		$s_count = gp("s_count");
		if($s_count==""){$s_count=$dan->get_one("web_config ","s_count",$id);}
		$s_mail_user = gp("s_mail_user");
		$s_mail_smtp = gp("s_mail_smtp");
		$s_mail_pwd = gp("s_mail_pwd");
		$s_copyright = gp("s_copyright");
		$s_copyright1 = gp("s_copyright1");
		$s_copyright2 = gp("s_copyright2");
		$s_uploadset = gp("uploadset");
		$id = gg("id");
	
		$dd = new db;
		$dd->dateArr["s_name"]=$s_name;
		$dd->dateArr["s_name1"]=$s_name1;
		$dd->dateArr["s_name2"]=$s_name2;
		$dd->dateArr["s_keywords"]=$s_keywords;
		$dd->dateArr["s_keywords1"]=$s_keywords1;
		$dd->dateArr["s_keywords2"]=$s_keywords2;
		$dd->dateArr["s_mail_user"]=$s_mail_user;
		$dd->dateArr["s_mail_smtp"]=$s_mail_smtp;
		$dd->dateArr["s_mail_pwd"]=$s_mail_pwd;
		$dd->dateArr["s_copyright"]=$s_copyright;
		$dd->dateArr["s_copyright1"]=$s_copyright1;
		$dd->dateArr["s_copyright2"]=$s_copyright2;
		
		$dd->dateArr["s_description"]=$s_description;
		$dd->dateArr["s_description1"]=$s_description1;
		$dd->dateArr["s_description2"]=$s_description2;
		$dd->dateArr["s_menustyle"]=$menustyle;
		$dd->dateArr["s_uploadset"]=$s_uploadset;
		$dd->dateArr["s_language"]=$s_language;
		$dd->dateArr["s_count"]=$s_count;
		$dd->phpUpdate("select * from web_config where id = ".$id."");
		$dd->closeDb();
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
<script charset="utf-8" src="../ke4/kindeditor.js"></script>
<script charset="utf-8" src="../ke4/lang/zh_CN.js"></script>
<script>
        KindEditor.ready(function(K) {
				K.create('#editor_1,#editor_2', {
                uploadJson : '../ke4/asp/upload_json.php',
                fileManagerJson : '../ke4/asp/file_manager_json.php',
                allowFileManager : true
                });
        });
</script>
<?php include("../checksession2.php")?>
<style></style>
</head>
<body  style="height:auto;">
<form  method="post" action="<?=getUrl()?>&action=add&id=<?=$id?>" id="forms" name="forms">
<div>
	<div class="title">网站配置</div>
    
    
	<table  id="tableLists" border="1">
  <? if($s_language=="1"){?>  
    	<tr><td width="11%">语言选择:</td><td width="89%">
        中文<input <?=iif($gb==1,"checked","")?> name="s_language[]"  type="checkbox" id="s_language" value="1" />
    	英文<input <?=iif($en==1,"checked","")?> name="s_language[]" type="checkbox" id="s_language" value="2" />
     中文繁体<input <?=iif($ft==1,"checked","")?> name="s_language[]" type="checkbox" id="s_language" value="3" />
            </td>
            
         </tr>
   <? }?>         
 <? if($gb=="1"){?>           
        <tr><td width="11%">网站名称:</td><td width="89%"><input name="s_name" id="s_name" size="30" value="<?=$s_name?>"  /></td></tr>
 <? }?>       
 <? if($en=="1"){?>        
        <tr><td width="11%">网站名称en:</td><td width="89%"><input name="s_name1" id="s_name1" size="30" value="<?=$s_name1?>"  /></td></tr>
 <? }?> 
<? if($ft=="1"){?>  
     	<tr><td width="11%">网站名称繁体:</td><td width="89%"><input name="s_name2" id="s_name2" size="30" value="<?=$s_name2?>"  /></td></tr>
<? }?>

<? if($menustyle=="1"){?>  
     	<tr><td width="11%">菜单默认样式:</td><td width="89%">
        展开:
        <input <?=iif($gmenustyle==0,"checked","")?> type="radio" name="menustyle" id="menustyle" size="30" value="0"  />
        收起:
        <input <?=iif($gmenustyle==1,"checked","")?> type="radio" name="menustyle" id="menustyle2" size="30" value="1"  />
        </td></tr>
<? }?>



<? if($gb=="1"){?>
     	<tr><td width="11%">关键词:</td><td width="89%">
        
        <textarea name="s_keywords" cols="95" rows="4" id="s_keywords" style=" height:auto;"><?=$s_keywords?></textarea>
        
        </td></tr>
<? }?>
<? if($en=="1"){?> 
        <tr><td width="11%">关键词en:</td><td width="89%">
        
       <textarea name="s_keywords1" cols="95" rows="4" id="s_keywords1" style=" height:auto;"><?=$s_keywords1?></textarea> 
        </td></tr>
<? }?>        
<? if($ft=="1"){?>        
        <tr><td width="11%">关键词繁体:</td><td width="89%">
        
        <textarea name="s_keywords2" cols="95" rows="4" id="s_keywords2" style=" height:auto;"><?=$s_keywords2?></textarea>
        </td></tr>
<? }?>
 <? if($s_countPage=="1"){?>         
        <tr><td width="11%">统计:</td><td width="89%"><input name="s_count" id="s_count" size="20" value="<?=$s_count?>"  /></td></tr>
 <? }?>         
 <? if($s_email=="1"){?>       
        <tr><td width="11%">邮箱设置:</td>
        <td width="89%">邮箱名：
          <input name="s_mail_user" id="s_mail_user" value="<?=$s_mail_user?>" size="20"  />
          &nbsp;&nbsp;邮箱发送服务器：
          <input name="s_mail_smtp" id="s_mail_smtp" size="20" value="<?=$s_mail_smtp?>" />
          &nbsp;邮相密码：
		  <input name="s_mail_pwd" type="password" id="s_mail_pwd" size="20" value="<?=$s_mail_pwd?>"  /></td>
          
          </tr>
 <? }?>         
  
   <? if($uploadset=="1"){?>       
        <tr><td width="11%">允许上传文件格式:</td>
        <td width="89%"> 
          <input name="uploadset" id="uploadset" value="<?=$s_uploadset?>" size="90"  /> 用竖线隔开(a|b|c)
        
        </td>
          
          </tr>
 <? }?> 
  
  
  
<? if($s_des==1){?>  
<? if($gb=="1"){?>    
  <tr><td width="11%">网站描述:</td><td width="89%">
	 <textarea name="s_description" cols="95" rows="4" id="s_description" style=" height:auto;"><?=$s_description?></textarea>  
  </td></tr>
  <? }?>               
<? if($en=="1"){?>   
  <tr><td width="11%">网站描述:</td><td width="89%">
	 <textarea name="s_description1" cols="95" rows="4" id="s_description1" style=" height:auto;"><?=$s_description1?></textarea>  
  </td></tr>
 <? }?>          
          
 <? if($ft=="1"){?>  
  <tr><td width="11%">网站描述:</td><td width="89%">
	 <textarea name="s_description2" cols="95" rows="4" id="s_description2" style=" height:auto;"><?=$s_description2?></textarea>  
  </td></tr>
<? }?>  
  
  
  <? }?>
  
  
<? if($gb=="1"){?>           
          <tr><td width="11%">版权信息:</td><td width="89%">

            <textarea id="editor_1" name="s_copyright" style="width:780px;height:300px;">
<?=$s_copyright?>
</textarea>
          </td></tr>
          
  <? }?>        
          
<? if($en=="1"){?>           
          <tr><td width="11%">版权信息en:</td><td width="89%">
          
          <textarea style="display:none" name="s_copyright1" id="s_copyright1"><?=$s_copyright1?></textarea>
          <IFRAME ID="txtcontent" src="../eWebEditor/ewebeditor.htm?id=s_copyright1&style=mini" frameborder="0" scrolling="no" width="600" height="150"></IFRAME>
          
          
          </td></tr>
 <? }?>          
          
 <? if($ft=="1"){?>          
          <tr><td width="11%">版权信息繁体:</td><td width="89%">
          
           <textarea style="display:none" name="s_copyright2" id="s_copyright2"><?=$s_copyright2?></textarea>
          <IFRAME ID="txtcontent" src="../eWebEditor/ewebeditor.htm?id=s_copyright2&style=mini" frameborder="0" scrolling="no" width="600" height="150"></IFRAME>
          
          
          
          </td></tr>
   <? }?>         
          <tr><td colspan="2"><input id="submits" onclick="cmdForm();" value=" 确 定 " type="submit" />&nbsp;&nbsp;&nbsp;<input name="重置" type="reset" value=" 重 置 " /></td></tr>
        
    </table>
    
   
    
    
    
    
    
</div>
</form> 
</body>
</html>
