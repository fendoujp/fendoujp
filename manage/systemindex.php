<?php session_start();?>
<?php include("../inc/publicfunction.php")?>
<?php include("checksession.php")?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站后台管理系统</title>
<link href="style/systemcss.css" rel="stylesheet" type="text/css" />
<!--[if lt IE 8]><script src="style/IE8.js" ></script><![endif]-->
<script src="js/public.js"></script>
<style>
.serverinfo p{ margin:10px 0; font-size:12px; color:#555;}
</style>
</head>
<body style="height:auto; background:#EEF8FA;">
<div class="serverinfo" style="padding:15px;">
<p><strong>WELCOME</strong></p>
<p>页面时通信协议的名称和版本:   <? en($_SERVER['SERVER_PROTOCOL'])?>  </p>
<p>主机：		<? en($_SERVER['SERVER_NAME'])?>  </p>
<p>环境配置：<? en($_SERVER['SERVER_SOFTWARE'])?>  </p>
<p>浏览器：<? en($_SERVER['HTTP_USER_AGENT'] )?>  </p>


</div>
</body>
</html>
