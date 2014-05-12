<? header("Content-Type: text/html; charset=utf-8");?>
<? session_start();?>
<?php include("../inc/publicfunction.php")?>
<?php include("checksession.php")?>
<html>
<head>
<title><? $dttd=new db();e($dttd->get_one("web_config","s_name",1));?>网站后台管理系统</title>
<link href="style/systemcss.css" rel="stylesheet" type="text/css" />
<script src="js/public.js"></script>
<style type="text/css">
.navPoint {COLOR: white; CURSOR: hand; FONT-FAMILY: Webdings; FONT-SIZE: 9pt;}
.a2{BACKGROUND-COLOR: A4B6D7;}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<BODY leftMargin=0 topMargin=0 rightMargin=0>
<CENTER>
<TABLE style="BORDER-COLLAPSE: collapse" cellSpacing=0 cellPadding=0 width="100%" border=0>
<TR>
<TD class="title" align=left width="100%" height=35 style="height:40px;">

 <span class="l"><? $dttd=new db();e($dttd->get_one("web_config","s_name",1));?>网站后台管理系统</span> <span class="r"><a style=" color:#F00" href="../" target="_blank">访问首页</a>
			 <? e("你好！".$_SESSION["xingusername"]);?>
             你是
			 <?
             	$ddd = new db();
				e($ddd->get_s("select s_name from s_user_class where s_ok =  ".$_SESSION["xingqx"]." "));
			 ?>
             
             <a style="margin-left:30px; margin-right:10px;" href="exit.php">退出</a>
</span>

</TD>
</TR>
</TABLE>
</CENTER>
</body>
<body scroll="no" onResize="javascript:parent.iframeleft.location.reload();">
<script>
if(self!=top){top.location=self.location;}
function switchSysBar(){
if (switchPoint.innerText==3){
switchPoint.innerText=4
document.all("frmTitle").style.display="none"
}else{
switchPoint.innerText=3
document.all("frmTitle").style.display=""
}}
</script>
<table border="0" cellPadding="0" cellSpacing="0" height="93%" width="100%">
  <tr>
    <td align="middle" noWrap vAlign="center" id="frmTitle">
    <iframe frameBorder="0" id="iframeleft" name="iframeleft" src="menu.php" style="HEIGHT: 100%; VISIBILITY: inherit; WIDTH: 190px; Z-INDEX: 2" target="iframeright">
    </iframe>
    </td>
    <td bgcolor="#799AE1" style="WIDTH: 9pt">
    <table border="0" cellPadding="0" cellSpacing="0" height="100%">
      <tr>
        <td style="HEIGHT: 100%; background:#99ccff;" onClick="switchSysBar()">
        <font style="FONT-SIZE: 9pt; CURSOR: default; COLOR: #ffffff">
   
        <span class="navPoint" id="switchPoint" title="关闭/打开左栏">3</span><br>
       
        屏幕切换 </font></td>
      </tr>
    </table>
    </td>
		<td style="WIDTH: 100%">
		<iframe frameborder="0" id="iframeright" name="iframeright" scrolling="yes" src="systemindex.php" style="HEIGHT: 100%; VISIBILITY: inherit; WIDTH: 100%; Z-INDEX: 1"></iframe></td>
  </tr>
</table>
<script>
  if(window.screen.width<'1024'){switchSysBar()}
</script>
</body>
</html>