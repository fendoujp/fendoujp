<? header("Content-Type: text/html; charset=utf-8");?>
<?php session_start();?>
<?php include("../../inc/publicfunction.php"); ?>
<?php include("../../inc/turepage.php"); ?>
<?
	$s_title = gg("title");
	$s_type = gg("s_type");
	$id = gg("id");
	$keywords = unescape(gg("keyword"));
	$search = gg("search");
	$allok = gg("allok");
	$ordertype = gg("ordertype");
	$orders = gg("orders");
	$idda = gg("idda");
	$idxi = gg("idxi");
?>
<?
	if(gg("action")=="del"){
		$da = new db;
		$da->setQuser("delete from u_main  where id = ".gg("id")." ");
		$da->closeDb();
		ee(js("location.href='".getSplit(getUrl(),"&action",0)."'"));
	}

	if(gg("action")=="checkok"){
		$da = new db;
		$da->setQuser("update u_main set s_ok = '".unescape(gg("value"))."' where id = ".gg("id")." ");
		$da->closeDb();
		ee(js("location.href='".getSplit(getUrl(),"&action",0)."'"));
	}

	if(gg("action")=="check123456"){
		$dan = new db();
		$dan->dateArr["s_pwd"] = md5("123456");
		$dan->phpUpdate("select * from u_main where id = ".$id."");
		$url = getSplit(getUrl(),"&action=",0);
		ej("alert('操作成功');location.href='".$url."'");
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
    搜索：
    	<select id="selectclass" name="selectclass">
        	<option <?=iif($search=="username","selected","")?> value="username">用户名</option>
            <option <?=iif($search=="realname","selected","")?> value="realname">姓名</option>
        </select>
    
    <input size="10" value="<?=$keywords?>"  name="keywords" id="keywords" />
    <input value="确定"  type="button" onclick="location.href='<?=getSplit(getUrl(),"&search=",0)?>&search='+getId('selectclass').value+'&keyword='+unescape(getId('keywords').value)" />
    
   &nbsp;&nbsp; 
    状态搜索:
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
    &nbsp;&nbsp;
    
    
    积分范围：
    大于 <input onkeyup="if(isNaN(this.value)){this.value='';}" name="idda" type="text" id="idda" value="<?=$idda?>" size="5" />
    小于 <input onkeyup="if(isNaN(this.value)){this.value='';}" name="idxi" type="text" id="idxi" value="<?=$idxi?>" size="5" />
    &nbsp;&nbsp;
    
      <input id="srarchbutton" onclick="location.href='<?=getSplit(getUrl(),"&idda",0)?>&idda='+escape(getId('idda').value)+'&idxi='+escape(getId('idxi').value)" value="确定" type="button" />
    
    
    
    &nbsp;&nbsp;
    
    
    
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
    &nbsp;&nbsp; 
    
   <p>&nbsp;</p>
    ID范围：
    大于 <input onkeyup="if(isNaN(this.value)){this.value='';}" name="idda" type="text" id="idda" value="<?=$idda?>" size="5" />
    小于 <input onkeyup="if(isNaN(this.value)){this.value='';}" name="idxi" type="text" id="idxi" value="<?=$idxi?>" size="5" />
    &nbsp;&nbsp;
    
      <input id="srarchbutton" onclick="location.href='<?=getSplit(getUrl(),"&idda",0)?>&idda='+escape(getId('idda').value)+'&idxi='+escape(getId('idxi').value)" value="确定" type="button" />

&nbsp;&nbsp; 
    
    <input value="添加会员" type="button" onclick="location.href='usercheck.php?s_type=user&title=会员添加'"  />
    
    </div>
    
    
<table  id="tableLists" border="1">
	<tr>
    <th width="3%">ID</th>
    <th width="4%">type</th>
    <th width="6%">用户名</th>
    <th width="7%">真实姓名</th>
    <th width="12%">E-Main</th>
    <th width="12%">固定电话</th>
    <th width="11%">联系手机</th>
    <th width="9%">状态</th>
    <th width="9%">权限</th>
    <th width="9%">积分(点击详细)</th>
    <th width="36%">操作(重置密码为：123456)</th>
          
 	</tr>
  
<?
	$dan = new db();
	$sqld = "";
	if($search=="username"){$sqld = $sqld."  and s_name like  '%".$keywords."%'   ";}
	if($search=="realname"){$sqld = $sqld."  and s_realname like  '%".$keywords."%'   ";}
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
	
	//$sqld = $sqld."";
	$pp = new page(gg("pageId"),20,$dan->getCount("select * from u_main where 1=1   ".$sqld."  "),getUrl());
	$result = $dan->setQuser("select * from u_main  where 1=1   ".$sqld."   limit ".$pp->limitStart().",".$pp->limitEnd()." ");
	while ($rs = $dan->setFetch($result)){
		
?>  
    
    <tr>
    	<td><?=$rs["id"]?></td>
        <td><?=$rs["s_type"]?></td>
        <td><?=$rs["s_name"]?></td>
        <td><?=$rs["s_realname"]?></td>
        <td><?=$rs["s_email"]?></td>
        <td><?=$rs["s_tel"]?></td>
        <td><?=$rs["s_phone"]?></td>
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
        <td>
        
        <?=get_s("select s_name from u_main_class  where id = ".$rs["s_qx"]."  ")?>
        
        </td>
        <td><a title="积分详细" href="jifen.php?id=<?=$rs["id"]?>&s_type=<?=$s_type?>"><?=$rs["s_jifen"]?></a></td>
        <td nowrap="nowrap">
        	<input value="详细信息" type="button" onclick="location.href='usercheck.php?s_type=user&id=<?=$rs["id"]?>&title=会员添加'" />
            &nbsp;&nbsp;&nbsp;&nbsp;
            <input onclick="if(confirm('确定要重置密码为123456吗？')){location.href='<?=getUrl()?>&action=check123456&id=<?=$rs["id"]?>'}" type="button" value="重置密码" />
            &nbsp;&nbsp;&nbsp;&nbsp;
            <input onclick="if(confirm('确定要删除此会员吗？')){location.href='<?=getUrl()?>&action=del&id=<?=$rs["id"]?>'}" type="button" value="删除" />
        </td>
    
    </tr>
    
   
   
   <?
	}
   ?> 
   
   
   
   <tr>
        <td colspan="11" class="page" style="height:25px; padding:5px 0;  "> <? e($pp->mPage());?> </td>
     </tr>
     
 </table>        
   
	
    
  
 
</div>

</body>
</html>
