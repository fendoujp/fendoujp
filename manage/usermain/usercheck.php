<? header("Content-Type: text/html; charset=utf-8");?>
<?php session_start();?>
<?php include("../../inc/publicfunction.php"); ?>
<?
	$s_title = gg("title");
	$s_type = gg("s_type");
	$id = gg("id");
	$action = gg("action");
?>
<?
	function gv($cowName){
		$dd = new db();
		$id=gg("id");
		if($id==""){return ("");}else{
			return 	($dd->get_one("u_main",$cowName,$id));
		}
	}
?>
<?
	if($action=="check"){
		$s_name = gp("s_name");
		$s_realname = gp("s_realname");
		$password = gp("password");
		$password2= gp("password2");
		$s_company= gp("s_company");
		$s_Website= gp("s_Website");
		$s_Range= gp("s_Range");
		$s_fax= gp("s_fax");
		$s_tel= gp("s_tel");
		$s_phone= gp("s_phone");
		$s_email= gp("s_email");
		$qq= gp("qq");
		$s_address= gp("s_address");
		$s_sex= gp("s_sex");
		$s_content= gp("s_content");
		$s_qx = gp("s_qx");
		//ee($s_name);
		$dan = new db();
		$dan->dateArr["s_name"] = $s_name;

		if($id==""){
			if($s_name==""||$password==""){
				ej("alert('请输入用户名或密码');history.go(-1);");
			}
			if($dan->getAll("select * from u_main where s_name = '".$s_name."'   ")!=""){
				ej("alert('此用户名已经存在');history.go(-1);");
			}
			if($password!=$password2){
				ej("alert('密码输入不一至');history.go(-1);");
			}
			
			$dan->dateArr["s_ok"] = $dan->get_s("select id from status where s_type='".$s_type."' and s_ok=1  ");
			$dan->addNews = true;
		}else{
			if($password!=$password2){
				ej("alert('密码输入不一至');history.go(-1);");
			}	
		}
		
		
		$dan->dateArr["s_type"]=$s_type;
		$dan->dateArr["s_realname"] = $s_realname;
		$dan->dateArr["s_pwd"] = md5($password);
		$dan->dateArr["s_company"] = $s_company;
		$dan->dateArr["s_Website"] = $s_Website;
		$dan->dateArr["s_Range"] = $s_Range;
		$dan->dateArr["s_fax"] = $s_fax;
		$dan->dateArr["s_tel"]=$s_tel;
		$dan->dateArr["s_phone"] =$s_phone ;
		$dan->dateArr["s_email"] =$s_email ;
		$dan->dateArr["qq"] = $qq;
		$dan->dateArr["s_address"] =$s_address ;
		$dan->dateArr["s_sex"] = $s_sex;
		$dan->dateArr["s_content"] =$s_content ;
		$dan->dateArr["s_qx"] =$s_qx ;
	
		
		$dan->phpUpdate("select * from u_main where id = ".$id."  ");
		$dan->closeDb();
		ej("alert('操作成功');location.href='userlist.php?s_type=user&title=会员管理'");
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
  <div class="title">
    <?=$s_title?>
    管理</div>
  <div  class="bacf1 borddd marbot10 pad5">
    <input value="返回" type="button" onclick="history.go(-1)" />
  </div>
  <form method="post" id="myforms" name="myforms" action="<?=getSplit(getUrl(),"&action=",0)?>&action=check">
    <table  id="tableLists" border="1">
      <tr>
        <td width="13%">用户名</td>
        <td><? if($id==""){?>
          <input id="s_name" name="s_name" value="<?=gv("s_name")?>" />
          <? }else{?>
          <?=gv("s_name")?>
          <? }?></td>
      </tr>
      <tr>
        <td>真实姓名</td>
        <td><input id="s_realname" name="s_realname" value="<?=gv("s_realname")?>" /></td>
      </tr>
      <tr>
        <td>密码</td>
        <td><input name="password" type="password" id="password" value="" /></td>
      </tr>
      <tr>
        <td>确认密码</td>
        <td><input name="password2" type="password" id="password" value="" /></td>
      </tr>
      <tr>
        <td>公司</td>
        <td><input id="s_company" name="s_company" value="<?=gv("s_company")?>" /></td>
      </tr>
      <tr>
        <td>经营范围</td>
        <td><input id="s_Range" name="s_Range" value="<?=gv("s_Range")?>" /></td>
      </tr>
      <tr>
        <td>网址</td>
        <td><input id="s_Website" name="s_Website" value="<?=gv("s_Website")?>" /></td>
      </tr>
      <tr>
        <td>传真</td>
        <td><input id="s_fax" name="s_fax" value="<?=gv("s_fax")?>" /></td>
      </tr>
      <tr>
        <td>电话</td>
        <td><input id="s_tel" name="s_tel" value="<?=gv("s_tel")?>" /></td>
      </tr>
      <tr>
        <td>手机</td>
        <td><input id="s_phone" name="s_phone" value="<?=gv("s_phone")?>" /></td>
      </tr>
      <tr>
        <td>邮箱</td>
        <td><input id="s_email" name="s_email" value="<?=gv("s_email")?>" /></td>
      </tr>
      <tr>
        <td>QQ/MSN</td>
        <td><input id="qq" name="qq" value="<?=gv("qq")?>" /></td>
      </tr>
      <tr>
        <td>地址</td>
        <td><input id="s_address" name="s_address" value="<?=gv("s_address")?>" /></td>
      </tr>
      <tr>
        <td>性别</td>
        <td> 男
          <input <?=iif(gv("s_sex")=="男","checked","")?> type="radio" name="s_sex" value="男" id="" />
          女
          <input <?=iif(gv("s_sex")=="女","checked","")?> type="radio" name="s_sex" value="女" id="" /></td>
      </tr>
      <tr>
        <td>权限</td>
        <td><select id="s_qx" name="s_qx">
            <?
   	$arr = getLiAll("select * from u_main_class where s_type = '$s_type' order by s_order asc, id desc   ");
	foreach($arr as $rs){
?>
            <option <?=iif(gv("s_qx")==$rs["id"],"selected","")?> value="<?=$rs["id"]?>">
            <?=$rs["s_name"]?>
            </option>
            <? }?>
          </select></td>
      </tr>
      <tr>
        <td>说明</td>
        <td><textarea id="s_content" name="s_content" style="height:auto" cols="50" rows="4"><?=gv("s_content")?>
</textarea></td>
      </tr>
      <tr>
        <td colspan="2"><input id="" name="" value="确定" type="submit" />
          <input id="" name="" value="重置" type="reset" /></td>
      </tr>
    </table>
  </form>
</div>
</body>
</html>
