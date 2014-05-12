<?php header("Content-Type: text/html; charset=utf-8");?>
<?php session_start();?>
<?php include("../../inc/publicfunction.php");?>
<?php include("../../inc/public_str.php");?>
<?php include("../../inc/turepage.php");?>
<?php include("../../inc/functions.php");?>
<?php
if(gg("action")=="upstatus"){
  $da = new db;
  $da->setQuser("update lm_signup set status='".gg("status")."' where id=".gg("id")." ");
  $da->closeDb();
}elseif(gg("action")=="upremark"){
  $da = new db;
  $da->setQuser("update lm_signup set remark='".gg("remark")."' where id=".gg("id")." ");
  $da->closeDb();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站后台管理系统</title>
<link href="../style/systemright.css" rel="stylesheet" type="text/css" />
<!--[if lt IE 8]><script src="../style/IE8.js" ></script><![endif]-->
<script src="../js/jquery-1.11.0.min.js"></script>
<script src="../js/public.js"></script>
<?php include("../checksession2.php");?>
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

	function status($status){
    $str = "-";
		switch($status){
      case '0':
        $str = "<span style='color:#f00'>最新申请</span>";
      break;
      case '1':
        $str = "已受理";
      break;
      case '2':
        $str = "已取消";
      break;
      case '3':
        $str = "成功";
      break;
      case '4':
        $str = "失败";
      break;
    }
    return $str;
	}
	if(gg("action")=="del"){
		$dd = new db();
		$dd->setQuser("delete from ".$tableName." where id = ".gg("id")." ");
    echo '<script type="text/javascript">alert("删除成功");</script>';
    //message_show("comment/signup.php?tableName=lm_signup&title=35","删除成功",1500);
	}
?>
<body style="height:auto;">
<div style="padding:10px">
  <div class="title">报名管理</div>
  <?php
  $dan = new db();
  $pp = new page(gg("pageId"),10,$dan->getCount("select * from ".$tableName." where 1=1"),getUrl());
  $sql_str = "select * from ".$tableName." where 1=1 order by id desc limit ".$pp->limitStart().",".$pp->limitEnd()." ";
  $result = $dan->setQuser($sql_str);
  while($r=$dan->setFetch($result)){
  ?>
  <table style="margin-bottom:20px;" id="tableLists" border="1">
  <colgroup>
    <col style="width:10%" />
    <col style="width:15%" />
    <col style="width:15%" />
    <col style="width:16%" />
    <col style="width:20%" />
    <col style="width:14%" />
    <col />
  </colgroup>
  <tbody>
    <tr style="background:#e4ecf6">
      <td style="border:none;padding:8px 5px;">ID：<?php echo $r['id'];?></td>
      <td style="border:none;padding:8px 5px;">姓名：<?php echo $r['name'];?></td>
      <td style="border:none;padding:8px 5px;">护照号：<?php echo $r['passport'];?></td>
      <td style="border:none;padding:8px 5px;">手机：<?php echo $r['mobile'];?></td>
      <td style="border:none;padding:8px 5px;">申请日期：<?php echo date("Y-m-d H:i",$r['date']);?></td>
      <td style="border:none;padding:8px 5px;">状态：
        <select onchange="location.href='<?php echo getSplit(getUrl(),"&status",0);?>&action=upstatus&id=<?php echo $r['id'];?>&status='+this.value">
          <option value="0" <?php if($r['status']==0)echo 'selected="selected"';?>>最新申请</option>
          <option value="1" <?php if($r['status']==1)echo 'selected="selected"';?>>已受理</option>
          <option value="2" <?php if($r['status']==2)echo 'selected="selected"';?>>已取消</option>
          <option value="3" <?php if($r['status']==3)echo 'selected="selected"';?>>成功</option>
          <option value="4" <?php if($r['status']==4)echo 'selected="selected"';?>>失败</option>
        </select>
      </td>
      <td style="border:none;padding:8px 5px;"><a href="signup_detail.php?id=<?php echo $r['id'];?>" target="iframeright">查看</a> | <a href="signup.php?tableName=lm_signup&title=35&action=del&id=<?php echo $r['id'];?>">删除</a></td>
    </tr>
    <tr style="display:none;">
      <td style="background:#fff;border:none;padding:8px 5px;" colspan="6"><span style="vertical-align:top">备注：</span><textarea id="remark<?php echo $r['id'];?>" style="height:auto;width:90%;" name="remark" rows="3"><?php echo $r['remark'];?></textarea></td>
      <td style="background:#fff;border:none;padding:8px 5px;"><input value="修改备注" type="button" onclick="location.href='<?php echo getSplit(getUrl(),"&remark",0);?>&action=upremark&id=<?php echo $r['id'];?>&remark='+$('#remark<?php echo $r['id'];?>').val()" /></td>
    </tr>
  </tbody>
  </table>
  <? }?>
  <div><?php e($pp->mPage());?></div>
</div>
</body>
</html>