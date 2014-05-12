<?php session_start();?>
<?php include("../inc/publicfunction.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站后台管理系统</title>
<link href="style/systemcss.css" rel="stylesheet" type="text/css" />
<!--[if lt IE 8]><script src="style/IE8.js" ></script><![endif]-->
<script src="js/public.js"></script>
</head>
<body style="height:auto; background:#99CCFF;">
<div>
<div class="menustt"><h3 style="font-size:12px;"><a href="javascript:void(0);" onclick="menuAllOpen();">展开</a>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="menuAllClose();">收起</a>&nbsp;&nbsp;<a target="iframeright" href="systemindex.php">起始页</a></h3></div>
<?
$dan = new db;
$result=$dan->setQuser("select  s_name,id from s_menu_class where 1=1 and  s_ok=1 and parent_id=0 order by s_order asc, id asc");
$menui=0;
while($row=$dan->setFetch($result)){
	if(strstr(",".get_s("select menu_qx from s_user where id = ".$_SESSION["xingid"]."   ").",",",".$row["id"].",")){
?>

	<div class="menustt">
    	<h3 onclick="menuF('menu<?=$menui?>')"><?=$row["s_name"]?></h3>
        <p class="c"></p>
<?
	$menustypes = get_o("web_config ","s_menustyle","");
	if($menustypes==0){$display="block";}else{$display="none";}
?>
    	<ul style="display:<?=$display?>;" id="menu<?=$menui?>">
        
	<?
    	$re2 = $dan->setQuser("select id,s_name,s_url from s_menu_class where 1=1 and s_ok=1 and parent_id =".trim($row["id"])."  order by s_order asc,id asc    ");
		$menuj=0;
		while($row2=$dan->setFetch($re2)){
			if(strstr(",".get_s("select menu_qx from s_user where id = ".$_SESSION["xingid"]." ").",",",".$row2["id"].",")){
	?>        
        	<li><a target="iframeright" href="<?=$row2["s_url"]?>"><?=$row2["s_name"]?></a></li>
            
            
     <?
     	}
		}
     	$menuj++
	 ?>       
            
        </ul>
        <div class="c"></div>
    </div>
    
<?   
	$menui++;
	}
} 
$dan->closeDb();
?>    
    
    
   
    
    
    
    
   
    
   </div>
    


</body>
</html>
<script>
function hideinfo(){
 	if(event.srcElement.tagName=="A") {
   	 window.status=event.srcElement.innerText
	}
}
document.onmouseover=hideinfo;
document.onmousemove=hideinfo;
document.onmousedown=hideinfo;
document.onclick=hideinfo;


function menuAllOpen(){
	arr = document.getElementsByTagName("ul");
	for(var i=0;i<arr.length;i++){
			arr.item(i).style.display = "block";
	}	
}
function menuAllClose(){
	arr = document.getElementsByTagName("ul");
	for(var i=0;i<arr.length;i++){
			arr.item(i).style.display = "none";
	}	
}

</script>