<? session_start();?>
<?php include("../inc/publicfunction.php"); ?>
<?

	$dan = new db;
	$username=trim(unescape($_GET['username']));
	$password=trim(unescape($_GET['password']));
	$code = trim(unescape($_GET["code"]));
	$cod = trim(unescape($_GET["cod"]));
	if($username==""){
		e("closeAlert();");
		e("talert('请填写用户名');");
		return false;
		exit();
	}
	if($password==""){
		e("closeAlert();");
		e("talert('请填写密码');");
		return false;
		exit();
	}
	if(strtoupper($cod)!=strtoupper($code)){
		e("closeAlert();");
		e("talert('验证码输入有误');setCode();");
		return false;
		exit();
	}
	if($dan->getAll("select * from s_user where s_name = '".$username."'   ")==""){
		e("closeAlert();");
		e("talert('用户名输入有误');");
		return false;
		exit();
	}
	
	if($dan->getAll("select * from s_user where s_name = '".$username."' and s_pwd = '".md5($password)."'  ")==""){
		e("closeAlert();");
		e("talert('密码输入有误');");
		return false;
		exit();
	}
	
	$xidArr = $dan->getAll("select * from s_user where s_name = '".$username."'   ");
	$userid = $xidArr["id"];
	$_SESSION["xingid"] = $userid;
	
	$_SESSION["xingusername"] = $username;
	$_SESSION["xingpassword"] = md5($password);
	$_SESSION["xingrealname"] = $dan->get_one("s_user","s_realname",$userid);
	$_SESSION["xingqx"] = $dan->get_one("s_user","s_qx",$userid);
	ee("location.href='system.php';");
?>



