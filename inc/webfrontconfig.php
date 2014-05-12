<?
	//整站变量  语言版本
	$s_name = "s_name";
	$s_copyright="s_copyright";
	$s_content = "s_content";
	$s_conj = "s_conj";
	$s_keywords = "s_keywords";
	$turnPage = "gb"; //gb  或 en
	$id = gg("id");
	
	$webName = get_o("web_config",$s_name,1);
	$webCopyRight = get_o("web_config",$s_copyright,1);
	$webKeyWords = get_o("web_config",$s_keywords,1);

	define("s_name", "s_name");
	define("s_copyright", "s_copyright");
	define("s_content", "s_content");
	define("s_conj", "s_conj");
	define("s_keywords", "s_keywords");
	define("turnPage", $turnPage);
	define("id", gg("id"));
	define("webName", $webName);
	define("webCopyRight", $webCopyRight);
	define("webKeyWords", $webKeyWords);
?>
