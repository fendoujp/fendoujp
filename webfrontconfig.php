<?
	//整站变量  语言版本
	$s_name = "s_name";
	$s_copyright="s_copyright";
	$s_content = "s_content";
	$s_conj = "s_conj";
	$s_keywords = "s_keywords";
	$s_description ="s_description";
	$turnPage = "gb"; //gb  或 en
	$id = gg("id");
	$webName = get_o("web_config",$s_name,1);
	$webCopyRight = get_o("web_config",$s_copyright,1);
	$webKeyWords = get_o("web_config",$s_keywords,1);
	$webdescription = get_o("web_config",$s_description,1);
	$firendarr = getLiAll("  select id,s_name,s_name1  from o_ad   where s_type  ='link'  order by s_order asc,id asc     ");
?>
<?php include("inc/array.php");?>