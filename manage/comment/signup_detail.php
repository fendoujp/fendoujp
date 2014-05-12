<? header("Content-Type: text/html; charset=utf-8");?>
<?php session_start();?>
<?php include("../../inc/publicfunction.php");?>
<?php include("../../inc/public_str.php");?>
<?php include("../../inc/turepage.php");?>
<?php include("../../inc/functions.php");?>
<?php
$id = gets('id');

if(gg("action")=="upremark"){
  $da = new db;
  $da->setQuser("update lm_signup set remark='".gg("remark")."' where id=".$id." ");
  $da->closeDb();
}

$db = new db();
$sql_str = "select * from lm_signup where id=".$id."";
$signup = getLiAll($sql_str);
$rs = $signup[0];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站后台管理系统</title>
<link href="../style/systemright.css" rel="stylesheet" type="text/css" />
<script src="../js/jquery-1.11.0.min.js"></script>
<!--[if lt IE 8]><script src="../style/IE8.js" ></script><![endif]-->
<script type="text/javascript" src="../js/public.js"></script>
<?php include("../checksession2.php");?>
<style type="text/css">
.sign h2{ font-size:18px; font-weight:bold;font-family: "Microsoft YaHei"; text-align:center;}
.sign .add{ height:30px; line-height:30px; border-bottom:1px dotted #ddd; margin:15px 0;}
.sign .sign-center tr{height:32px; line-height:32px;padding:0px 0 0px 10px;}
.sign-center input,.sign-center textarea{ border:0px; border-bottom:1px solid #ddd;height:24px; line-height:24px; color:#E22821; padding:0 3px; line-height:22px; font-size:14px; background:none;}
.sign .sign-center input.tj{ font-size:16px;font-weight:bold;font-family: "Microsoft YaHei"; text-align:center; width:90px; height:30px; background:#e22821; color:#fff; margin-top:20px;}
.sign .sign-center input.cz{ font-size:16px;font-weight:bold;font-family: "Microsoft YaHei"; text-align:center; width:90px; height:30px; background:#d4d4d4; color:#666; margin-top:20px;}
</style>
</head>

<body style="height:auto;">
<div class="sign" style="padding:10px">
  <div class="title"><?php echo $rs['name'];?>的申请<input type="button" name="print" value="预览并打印" onclick="preview()"></div>
  <form id="signup" action="/index.php" method="post">
  <!--startprint-->
  <table id="signup" width="100%" border="0" cellpadding="0" cellspacing="0" class="sign-center">
    <tr>
      <td colspan="2"><table width="100%" border="0">
          <tr align="left">
            <td scope="col">申请姓名：
              <input type="text" name="data[name]" id="textfield1" style="width:135px;" value="<?php echo $rs['name'];?>" />
            </td>
            <td scope="col">性 別：
              <input type="text" name="data[sex]" id="textfield2" style="width:140px;" value="<?php echo $rs['sex'];?>" />
            </td>
            <td scope="col">出生年月：
              <input type="text" name="data[birthday]" id="textfield3" style="width:140px;"  value="<?php echo $rs['birthday'];?>" /></td>
          </tr>
          <tr align="left">
            <td scope="col">护 照 号：
              <input type="text" name="data[passport]" id="textfield4" style="width:140px;" value="<?php echo $rs['passport'];?>" /></td>
            <td scope="col">申请者现状：
              <input type="text" name="data[actuality]" id="textfield5" style="width:140px;" value="<?php echo $rs['actuality'];?>" /></td>
            <td scope="col">（工作/在校）</td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td>出生地：
        <input type="text" name="data[addr_province]" id="textfield6" style="width:90px;" value="<?php echo $rs['addr_province'];?>" />
        省
        <input type="text" name="data[addr_city]" id="textfield7" style="width:90px;" value="<?php echo $rs['addr_city'];?>" />
        市</td>
      <td>户口所在地：
        <input type="text" name="data[addr_province1]" id="textfield8" style="width:90px;" value="<?php echo $rs['addr_province1'];?>" />
        省
        <input type="text" name="data[addr_city1]" id="textfield9" style="width:90px;" value="<?php echo $rs['addr_city1'];?>" />
        市</td>
    </tr>
    <tr>
      <td colspan="2">现住地址：
        <input type="text" name="data[address]" id="textfield10" style="width:87%;" value="<?php echo $rs['address'];?>" /></td>
    </tr>
    <tr>
      <td>父亲姓名：
        <input type="text" name="data[father]" id="textfield11" value="<?php echo $rs['father'];?>" /></td>
      <td>年龄：
        <input type="text" name="data[father_age]" id="textfield12" value="<?php echo $rs['father_age'];?>" /></td>
    </tr>
    <tr>
      <td>母亲姓名：
        <input type="text" name="data[mother]" id="textfield13" value="<?php echo $rs['mother'];?>" /></td>
      <td>年龄：
        <input type="text" name="data[mother_age]" id="textfield14" value="<?php echo $rs['mother_age'];?>" /></td>
    </tr>
    <tr>
      <td>经费支付者姓名：
        <input type="text" name="data[pay_name]" id="textfield15" value="<?php echo $rs['pay_name'];?>" /></td>
      <td>与申请者关系：
        <input type="text" name="data[relation]" id="textfield16" value="<?php echo $rs['relation'];?>" /></td>
    </tr>
    <tr>
      <td colspan="2">经费支付者工作单位：
        <input type="text" name="data[pay_work]" id="textfield17" style="width:78%;" value="<?php echo $rs['pay_work'];?>" /></td>
    </tr>
    <tr>
      <td>固定电话：
        <input type="text" name="data[phone]" id="textfield18" style="width:217px;" value="<?php echo $rs['phone'];?>" /></td>
      <td>手机：
        <input type="text" name="data[mobile]" id="textfield19" style="width:284px;" value="<?php echo $rs['mobile'];?>" /></td>
    </tr>
    <tr>
      <td>E-mail：
        <input type="text" name="data[mail]" id="textfield20" style="width:227px;" value="<?php echo $rs['mail'];?>"/></td>
      <td>Q Q：
        <input type="text" name="data[qq]" id="textfield21" style="width:288px;" value="<?php echo $rs['qq'];?>"/></td>
    </tr>
    <tr>
      <td height="50" colspan="2">是否来过日本：
        <input type="text" name="data[is_went]" id="textfield22" style="width:90px;" value="<?php echo $rs['is_went'];?>" />
如有请填写理由及时间 ：
        <input type="text" name="data[went_detail]" id="textfield23" style="width:308px;" value="<?php echo $rs['went_detail'];?>" /></td>
    </tr>
    <tr>
      <td>是否参加过日语级别考试：<input type="text" name="data[is_exam]" id="textfield24" style="width:90px;" value="<?php echo $rs['is_exam'];?>" /><br /></td>
      <td>能力等级：<input type="text" name="data[exam_level]" id="textfield25" style="width:267px;" value="<?php echo $rs['exam_level'];?>" /></td>
    </tr>
    <tr>
      <td>如有请填写级别考试名称：</td>
      <td>参考时间：
        <input type="text" name="data[exam_time]" id="textfield26" style="width:267px;" value="<?php echo $rs['exam_time'];?>" /></td>
    </tr>
    <tr>
      <td height="50"><input type="text" name="data[exam_name]" id="textfield27" style="width:267px;" value="<?php echo $rs['exam_name'];?>" /></td>
      <td height="50">分数：
      <input type="text" name="data[exam_grade]" id="textfield28" style="width:291px;" value="<?php echo $rs['exam_grade'];?>" /></td>
    </tr>
    <tr>
      <td rowspan="2">是否学习过日本语：<br />
      <input type="text" name="data[is_learn]" id="textfield29" style="width:267px;" value="<?php echo $rs['is_learn'];?>" /></td>
      <td>学习时间：
        <input type="text" name="data[learn_time]" id="textfield30" style="width:267px;" value="<?php echo $rs['learn_time'];?>" /></td>
    </tr>
    <tr>
      <td height="50">学校名称：
        <input type="text" name="data[learn_school]" id="textfield31" style="width:267px;" value="<?php echo $rs['learn_school'];?>" /></td>
    </tr>
    <tr>
      <td rowspan="3">高中学校名称：<br />
      <input type="text" name="data[high_school]" id="textfield32" style="width:267px;" value="<?php echo $rs['high_school'];?>" /></td>
      <td>类型：
        <input type="text" name="data[learn_type]" id="textfield33" style="width:167px;" value="<?php echo $rs['learn_type'];?>" />
        （文科/理科/艺术生）</td>
    </tr>
    <tr>
      <td>高考分数：
        <input type="text" name="data[high_exam_grade]" id="textfield34" style="width:267px;" value="<?php echo $rs['high_exam_grade'];?>" /></td>
    </tr>
    <tr>
      <td height="50">毕业时间：
        <input type="text" name="data[graduation]" id="textfield35" style="width:267px;" value="<?php echo $rs['graduation'];?>" /></td>
    </tr>
    <tr>
      <td rowspan="4">大学/大专名称：<br />
      <input type="text" name="data[college]" id="textfield36" style="width:267px;" value="<?php echo $rs['college'];?>" /></td>
      <td>毕业院校种类：
        <input type="text" name="data[college_type]" id="textfield37" style="width:244px;" value="<?php echo $rs['college_type'];?>" /></td>
    </tr>
    <tr>
      <td>是否有学位证：
        <input type="text" name="data[is_diploma]" id="textfield38" style="width:244px;" value="<?php echo $rs['is_diploma'];?>" /></td>
    </tr>
    <tr>
      <td>所学专业：
        <input type="text" name="data[major]" id="textfield39" style="width:267px;"  value="<?php echo $rs['major'];?>" /></td>
    </tr>
    <tr>
      <td height="50">毕业时间：
        <input type="text" name="data[college_graduation]" id="textfield40" style="width:267px;" value="<?php echo $rs['college_graduation'];?>" /></td>
    </tr>
    <tr>
      <td>意向院校(语言学校名称)：<br />
        <input type="text" name="data[intention]" id="textfield41" style="width:267px;" value="<?php echo $rs['intention'];?>" />              <br /></td>
      <td>入学时间：（例2015年4月）<br />
      <input type="text" name="data[admission]" id="textfield42" style="width:267px;" value="<?php echo $rs['admission'];?>" /></td>
    </tr>
  </table>
  <!--endprint-->
</form>
<div>
  <br><br>备注：<br>
  <textarea id="remark" style="height:auto;width:75%;margin:10px 0" name="remark" rows="3"><?php echo $rs['remark'];?></textarea><br>
  <input value="修改备注" type="button" onclick="location.href='<?php echo getSplit(getUrl(),"&remark",0);?>&action=upremark&remark='+$('#remark').val()" />
</div>
</div>
<script language="javascript">
function preview(){
  var bdhtml=window.document.body.innerHTML;
  var sprnstr="<!--startprint-->"; 
  var eprnstr="<!--endprint-->"; 
  var header="<h2 style=\"text-align:center\">奋斗在日本留学网<br>调查评估表</h2><div style=\"padding-top:10px;height:30px;line-height:30px;border-bottom:1px solid #eee;margin-bottom:20px\"><span style=\"float:left\">官方网址：www.fendoujp.com</span><span style=\"float:right\">会社电话：03-5822-5520(东京)</span></div>";
  var prnhtml=bdhtml.substr(bdhtml.indexOf(sprnstr)+17);
  prnhtml=prnhtml.substring(0,prnhtml.indexOf(eprnstr));
  window.document.body.innerHTML=header+prnhtml;
  window.print();
  window.document.body.innerHTML=bdhtml;
}
$(function(){
  $("input[type=text]").attr("readonly","readonly");
});
</script>
</body>
</html>