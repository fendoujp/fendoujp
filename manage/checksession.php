<?
	if(isset($_SESSION["xingusername"])){
		$usn = $_SESSION["xingusername"];
	}else{$usn="";}
	if(isset($_SESSION["xingid"])){
	$uid = $_SESSION["xingid"];
	}else{$uid="";}
	if(isset($_SESSION["xingpassword"])){
	$upd = $_SESSION["xingpassword"];
	}else{$upd="";}
	if($usn==""||$uid==""||$upd==""){
		ee("非法登陆<a href='index.html'>重新登陆</a>");
	}else{
		$sess = new db();
		if($sess->getAll("select * from s_user where s_name = '".$usn."'   ")==""){
			ee("非法登陆<a href='index.html'>重新登陆</a>");
		}else{
			if($sess->getAll("select * from s_user where s_name = '".$usn."' and s_pwd = '".$upd."'  ")==""){
				ee("请重新登陆<a href='index.html'>重新登陆</a>");
			}
		}
	}
?>