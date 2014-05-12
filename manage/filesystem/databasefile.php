<? header("Content-Type: text/html; charset=utf-8");?>
<?php session_start();?>
<?php include("../../inc/publicfunction.php")?>
<?php include("../../inc/public_str.php")?>
<?php
function del_dir($dir){	//删除目录
	if(!($mydir=@dir($dir))){
		return;
	}
	while($file=$mydir->read()){
		if(is_dir("$dir$file") && $file!='.' && $file!='..'){ 
			@chmod("$dir$file", 0777);
			del_dir("$dir$file"); 
		}elseif(is_file("$dir/$file")){
			$file_time=@stat($file);	//读取文件的最后更新时间
			if(time()-$file_time>3600*24*14){
				@chmod("$dir/$file", 0777);
				@unlink("$dir/$file");
			}
		}
	}
	$mydir->close();
	@chmod($dir, 0777);
	@rmdir($dir);
}


function del_file($path){
    if (file_exists($path)){
        if(is_file($path)){
            if(    !@unlink($path)    ){
                $show.="$path,";
            }
        } else{
            $handle = opendir($path);
            while (($file = readdir($handle))!='') {
                if (($file!=".") && ($file!="..") && ($file!="")){
                    if (is_dir("$path/$file")){
                        $show.=del_file("$path/$file");
                    } else{
                        if( !@unlink("$path/$file") ){
                            $show.="$path/$file,";
                        }
                    }
                }
            }
            closedir($handle);

            if(!@rmdir($path)){
                $show.="$path,";
            }
        }
    }
   return $show;
}






?>
<?
	$filePhat = "data";
	$nowFilePath = gg("file");
   if(gg("file")!=""){$filePhat=$filePhat."/".gg("file");}
 //  en($nowFilePath);
	if(gg("action")=="del"){
		del_file($filePhat);
		$url='databasefile.php';
		ej("alert('操作成功');location.href='".$url."'");
	}
	
	if(gg("action")=="delfile"){
		del_file($filePhat);
		$url='file.php';
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
</head>

<body style="height:auto;">

<div>
<div class="title">文件管理</div>

<div  class="bacf1 borddd marbot10 pad5">
搜索：<input  name="searchtext" type="text" id="searchtext" value="" size="30" />
    <input id="srarchbutton"   value="确定" type="button" onclick="ssearch();" />
    &nbsp;&nbsp;&nbsp;&nbsp;
<input value="返回" onclick="history.go(-1);" type="button" />
</div>


<div class="file">
   <?

   $d = dir($filePhat); 
	while($f=$d-> read())   {
		if(!is_file("$d->path/$f")) {
			if(!strstr($f,".")){$out[$f]= $f; }
		}else{
			$out[$f]= $f; 	
		}
	} 
	$d-> close();
	foreach($out as $k=>$v){
		if(strstr($k,".")){
    		echo   "<li><span style='float:left'> <a title='打开' target='_blank'  href= '".$filePhat."/".$k."' > $k </a> </span><span style='float:right'> <a href=javascript:if(confirm('删除操作不可恢复，确定要执行此操作吗？')){location.href='databasefile.php?file=".$nowFilePath."/".$k."&action=delfile'} >删除</a></span></li>";
		}else{
			echo   " <p><a title='打开' href= 'databasefile.php?file=".$nowFilePath."/".$k."' ><img src='../images/fieldir.gif' /></a><br> $k  <br><a href=javascript:if(confirm('删除操作不可恢复，确定要执行此操作吗？')){location.href='databasefile.php?file=".$nowFilePath."/".$k."&action=del'} >删除</a> <p>";
		}
	}
   ?> 
	
 </div>   
</div>

</body>
</html>
<script>
function ssearch(){
	values = document.getElementById("searchtext").value;
	findInPage(values);
}
</script>
<script language="JavaScript">
var NS4 = (document.layers);    // Which browser?
        var IE4 = (document.all);
var win = window;    // window to search.
        var n   = 0;
function findInPage(str) {
var txt, i, found;
if (str == "")
return false;
if (NS4) {
if (!win.find(str))
while(win.find(str, false, true))
n++;
else
n++;
if (n == 0)
alert("Not found.");
}
if (IE4) {
txt = win.document.body.createTextRange();
for (i = 0; i <= n && (found = txt.findText(str)) != false; i++) {
txt.moveStart("character", 1);
txt.moveEnd("textedit");
}
if (found) {
txt.moveStart("character", -1);
txt.findText(str);
txt.select();
txt.scrollIntoView();
n++;
}
else {
if (n > 0) {
n = 0;
findInPage(str);
}
}
}
return false;
}
</script>
