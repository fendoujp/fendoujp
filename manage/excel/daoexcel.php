<? header("Content-Type: text/html; charset=utf-8");?>
<?php session_start();?>
<?php include("../../inc/publicfunction.php"); ?>
<?php include("reader.php"); ?>
<?
	function gv($text){
		$id = 1;
		$dan = new db;
		if($id!=""){
			return ($dan->get_one("excel_data",$text,$id));
		}else{
			return ("");	
		}
	}
	function gpimg($text){
		return (str_replace("../","",gp($text)));
	}
?>
<?
	$s_type = gg("s_type");
	$title = gg("title");
	$action = gg("action");
	if($action=="add"){
		$dd = new db();	
		$s_name = gpimg("s_name");
		$dd->setQuser("update excel_data set s_name = '".$s_name."' where id=1 ");
		
		$data = daoExcelData("../../".gv("s_name"));
		for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++){
			$dd->dateArr["s_type"]=$s_type;
			$dd->addNews = true;			
			$s_ok = $dd->get_s("select id from status where s_type = '".$s_type."' and s_ok = 1  ");
			if($s_ok!=""){	
				$dd->dateArr["s_ok"]=$s_ok;
			}
			
			$dd->dateArr["s1"]=$data->sheets[0]['cells'][$i][1];
			$dd->dateArr["s2"]=$data->sheets[0]['cells'][$i][2];
			
			$dd->phpUpdate("select * from excel where id = ".$id."");
			
			
		}
		
		
		
		$url = getSplit(getUrl(),"&action=",0);
		ej("alert('操作成功');location.href='$url';");
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
<style></style>
</head>
<body  style="height:auto;">
<div class="title"><?=$title?>添加</div>
<div  class="bacf1 borddd marbot10 pad5">
上传完成请不要修改路径
</div>

<form action="<?=getSplit(getUrl(),"&action",0)?>&action=add" method="post" id="myforms" name="myforms">
	<table  id="tableLists" border="1">
    	<tr>
        	<td width="10%">上传</td><td width="90%"><?=upload("s_name",gv("s_name"))?></td>
        </tr>
    	<tr><td colspan="2"><input value=" 确定导入 " type="submit" /></td></tr>
    </table>
</form>




</body>
</html>

<?php
//require_once 'reader.php';
//$data = new Spreadsheet_Excel_Reader();
//$data->setOutputEncoding('gbk');
//$data->read('aa.xls');
//error_reporting(E_ALL ^ E_NOTICE);
//
//echo($data->sheets[0]['cells'][1][2]);// $data->sheets[第几个工作表]['cells'][行][列]






//var_dump($data);


//
//for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
//    for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
//        echo "\"".$data->sheets[0]['cells'][$i][$j]."\",";
//    }
//    echo "\n";
//}

?>


