<?php include("../../inc/publicfunction.php"); ?>
<?php include("../../inc/turepage.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<? 
//function index(数组,生成文件名,来自路径,)
$newssqld = " select id,s_name,s_time,s_conj,classid from a_main  where 1=1 and s_type = 'a_class'     ";
$newsarr = getLiAll("  $newssqld  order by s_order asc,id desc ");
//function indexhtml($surl,$rurl){
foreach($newsarr as $rs) {
$url='http://'.$_SERVER['HTTP_HOST'];
$url=$url."/chuanxiangcx/news_detail.php"."?"."id=".$rs[id];
if (!file_get_contents($url)){
	echo "路径或者文件有误！<br>";
	}else{
		$str=file_get_contents($url);
		}
$url=dirname(dirname(dirname(__FILE__)))."/".$rs[id].".html"; 
echo $url;
$handle=fopen($url,"w+"); //写入方式打开路径
if (fwrite($handle,$str)){
	echo "生成成功<br>";
	}else{
		echo "生成失败<br>";
		} //把刚才的内容写进生成的HTML文件
fclose($handle);
}
//}
?>
<? 
   
   //indexhtml("index.php","index.html");
   //indexhtml("about.php","about.html");
echo "__FILE__  : <p style='color:red'>".__FILE__."</p>"; 
echo "dirname(__FILE__)  : <p style='color:red'>".dirname(__FILE__)."</p>"; 


echo "\$_SERVER['DOCUMENT_ROOT']:<p style='color:red'>".$_SERVER['DOCUMENT_ROOT']."</p>";
 echo "\$_SERVER['PHP_SELF'] : <p style='color:red'>".$_SERVER['PHP_SELF']."</p>";
 echo "dirname(\$_SERVER['PHP_SELF']) :  <p style='color:red'>" .dirname($_SERVER['PHP_SELF'])."</p>";
 echo "<p style='color:red'>".$_SERVER['DOCUMENT_ROOT'].dirname($_SERVER['PHP_SELF'])."</p>";
 
echo "realpath('./') : <p style='color:red'>".realpath('./')."</p>"; 


$pathInfo = pathinfo(__FILE__); 
echo "pathinfo(__FILE__,PATHINFO_DIRNAME):<p style='color:red'>".$pathInfo[dirname]."</p>";
 echo "pathinfo(__FILE__,PATHINFO_BASENAME):<p style='color:red'>".$pathInfo[basename]."</p>";
 echo "pathinfo(__FILE__,PATHINFO_EXTENSION]):<p style='color:red'>".$pathInfo[extension]."</p>";
 
?>
</body>
</html>
