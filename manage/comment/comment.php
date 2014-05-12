<? header("Content-Type: text/html; charset=utf-8");?>
<?php session_start();?>
<?php include("../../inc/publicfunction.php")?>
<?php include("../../inc/public_str.php")?>
<?php include("../../inc/turepage.php"); ?>

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
	$tableName = gg("tableName");
	$s_classtype=gg("s_classtype");
	$title = gg("title");
	$s_reply = gg("s_reply");
?>
<?
	function gpimg($text){
		return (str_replace("../","",gp($text)));
	}
?>
<?
	if(gg("action")=="s_reply"){
		$dd = new db();


		$dd->dateArr["s_reply"] = gp("s_reply");
		$dd->phpUpdate("select * from comment where id = ".gg("id")."  ");
		$dd->closeDb();
		$url = getSplit(getUrl(),"&action=",0);
		ee(js("location.href='".$url."'"));
	}
	

	if(gg("action")=="del"){
		$dd = new db();
		$dd->setQuser("delete from comment where id = ".gg("id")."  ");
		$url = getSplit(getUrl(),"&action=",0);
		//ee($url);
		ee(js("location.href='".$url."'"));
	}
	
	if(gg("action")=="checkok"){
		$da = new db;
		$nowNum = $da->getCount("select * from comment where s_type = '".$s_type."' and s_ok = ".unescape(gg("value"))."   ");
		$setNum = $da->get_s("select s_num from status where s_type = '".$s_type."' and id = ".unescape(gg("value"))."  ");
		if($setNum!=0&&$nowNum>=$setNum){
			ej("alert('己达此栏目设置最大数目');location.href='".getSplit(getUrl(),"&action",0)."'");
		}
		$da->setQuser("update comment set s_ok = '".unescape(gg("value"))."' where id = ".gg("id")." ");
		$da->closeDb();
		ee(js("location.href='".getSplit(getUrl(),"&action",0)."'"));
	}
	
?>

<body style="height:auto;">

<div>
<div class="title"><?=$title?>评论管理</div>

  
    
    
	
    	
  <?
 	$dan = new db();
	$pp = new page(gg("pageId"),20,$dan->getCount("select * from comment  where 1=1 and s_type = '".$s_type."' and s_classtype = '".$s_classtype."'    "),getUrl());
	$result = $dan->setQuser("select * from  comment where 1=1 and s_type = '".$s_type."' and s_classtype = '".$s_classtype."' order by classid asc ,id desc limit ".$pp->limitStart().",".$pp->limitEnd()."  ");
	while($rs=$dan->setFetch($result)){
 ?>         
      <table style="margin-bottom:20px;" id="tableLists" border="1">  
        <tr style="cursor:pointer;" onclick="menuF('tab<?=$rs["id"]?>');">
        	<th width="15%">评论ID:(<?=$rs["id"]?>),<?=$title?>ID：(<?=$rs["classid"]?>)</th>
            <th width="6%">type:(<?=$rs["s_type"]?>)</th>
            <th width="8%">评论用户:(<?=$rs["s_username"]?>)</th>
       		<th width="25%">评论标题:(<?=$rs["s_name"]?>)</th>
            <th width="33%"><?=$title?>标题:(<?=$dan->get_one($tableName,"s_name",$rs["classid"])?>)</th>
      
          <? if($s_ok=="1"){?>
            <th width="13%">
            状态：
            
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
            
            
            </th>
            
        <?  }?>    
            <th width="13%">
            <input onclick="if(confirm('确认要删除吗？')){location.href='<?=getSplit(getUrl(),"&action=",0)?>&action=del&id=<?=$rs["id"]?>';}" value="删除" id="" name="" type="button" /></th>
        </tr>
      <tbody style="display:none;" id="tab<?=$rs["id"]?>">  
      	   <tr>
             <td colspan="7" bgcolor="#f5f5f5"><?=$rs["s_content"]?></td>
           </tr>
         <? if($s_reply=="1"){?>
          <tr>
                <td bgcolor="#f5f5f5">回复：</td>
                <td colspan="6" bgcolor="#f5f5f5">
                <form action="<?=getSplit(getUrl(),"&action=",0)?>&action=s_reply&id=<?=$rs["id"]?>" method="post" id="myforms">
                <textarea id="s_reply" name="s_reply" style="height:auto;" cols="100" rows="2"><?=$rs["s_reply"]?></textarea>
                <input name="提交" type="submit" value="确定" />
                </form>
            </td>
          </tr>
          <? }?>
     </tbody>
     </table>
  <? }?>      
    
    <div>
    <? e($pp->mPage());?>
    </div>


    
</div>

</body>
</html>
