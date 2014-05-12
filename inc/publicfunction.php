<?php include("dataconfig.php"); ?>
<?
function e($text){echo $text;}
function en($text){	echo $text."<br/>";	}
function ee($text){
	echo $text;
	exit();
}
function ek($text,$nums){
	for($i=0;$i<$nums;$i++){
		$text = $text."&nbsp;";
	}
	echo $text;
}
function ej($text){
	echo ("<script language='javascript' type='text/javascript'>".$text."</script>");
	exit();
}
function gg($text){
	if(isset($_GET[$text])){
		return trim($_GET[$text]);
	}else{return ("");}
}
function q($text){
	if(isset($_REQUEST[$text])){
		return trim($_REQUEST[$text]);
	}else{return ("");}
}
function gp($text){
	if(isset($_POST[$text])){
		return trim($_POST[$text]);
	}else{
		return ("");
	}
}
function gpk($text){
	if(isset($_POST[$text])){
		return  getFormEqualName(array_map('trim',$_POST[$text]),",");
	}else{return ("");}
}
function js($text){return "<script language='javascript' type='text/javascript'>".$text."</script>";}
function webQx(){$xingdan = new db();if($xingdan->get_one("web_config","web_status",1)=="1"){ee("");}$xingdan->closeDb();}webQx();
function iif($text1,$text2,$text3){//三目运算
	if($text1){
		return($text2);
	}else{
		return($text3);
	}
}
function trims($data) {
	if(is_array($data)) {
		return array_map("trims", $data);
	}
	else {
		return trim($data);
	}
}//清除数组空格
function session($sessionName){
	if(isset($_SESSION[$sessionName])){
		return $_SESSION[$sessionName]	;
	}else{return("");}
}//存在则返回session
function getFormEqualName($formNameArr,$prot){//将一维数组转化成  1,2,6,8,9形式  
	$str = "";
	for($i=0;$i<count($formNameArr);$i++){
		if($str==""){
			$str = $str .$formNameArr[$i];
		}else{
			$str = $str .$prot.$formNameArr[$i];	
		}
	}
	return ($str);
}////////////////
function juid($arr,$ids){//检验id是否合法
	$cord=0;
	foreach($arr as $rs){
		if($rs["id"]==$ids){$cord=1;}	
	}
	if($cord==0){ee("非法操作");}
}

function times($times){
	return date("Y-m-d",strtotime($times));	
}
function getFormEqualName2($formNameArr,$prot){  //将一维数组转化成  '1','2','6','8','9'形式 
	$str = "";
	for($i=0;$i<count($formNameArr);$i++){
		if($str==""){
			$str = $str ."'".$formNameArr[$i]."'";
		}else{
			$str = $str .$prot."'".$formNameArr[$i]."'";	
		}
	}
	return ($str);
}
function replace($findStr,$prot,$replaceText){//重写str_replace()
	return (str_replace($prot,$replaceText,$findStr));	
}
function getUrl(){
	$pageURL = 'http';
	if(isset($_SERVER["HTTPS"])){
	if ($_SERVER["HTTPS"] == "on"){
		$pageURL .= "s";
	}
	}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80"){
		$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
	} 
	else {
		$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}
function getSplit($text,$prot,$num){
		$str = $text;
		$str = explode($prot,$str);
		$str = $str[$num];
		return $str;
}/////////// 代替  split()()
function splitArray($text,$prot){//重新封装explode
	$str = $text;
	$str = explode($prot,$str);
	//$str = $str[$num];
	return $str;	
}
function getIntMax($num,$pro){///取整 ，
	if(is_float($num)){
		if($pro==1){
			return (intval($num));
		}
		if($pro==2){			
			return (intval($num)+1);  ///全入取整 4.2  =5
		}
	}else{
		return $num;	
	}
}
function writeArray($arrayName){//var_dump重新封装 输出数组
	var_dump($arrayName);	
}
function delUrlKey($url,$keyWords){//删除rul参数级值
	//$url = getUrl();
	$urlh ="";
	if(strstr($url,"?".$keyWords)){
		$urlq = getSplit($url,"?".$keyWords."=",0);
		$urla = splitArray(getSplit($url,"?".$keyWords."=",1),"&");
		for($i=1;$i<count($urla);$i++){
			if($urlh==""){
				$urlh = $urla[$i];
			}else{
				$urlh = $urlh."&".$urla[$i];
			}
		}
		$url = $urlq."?".$urlh;
	}else if(strstr($url,"&".$keyWords)){
		$urlq = getSplit($url,"&".$keyWords."=",0);
		$urla = splitArray(getSplit($url,"&".$keyWords."=",1),"&");
		for($i=1;$i<count($urla);$i++){
			if($urlh==""){
				$urlh = $urla[$i];
			}else{
				$urlh = $urlh."&".$urla[$i];
			}
		}
		if($urlh!=""){
			$url = $urlq."&".$urlh;
		}else{
			$url = $urlq;
		}
		
	}
	
	return ($url);
}
function escape($str) { 
	preg_match_all("/[\xc2-\xdf][\x80-\xbf]+|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}|[\x01-\x7f]+/e",$str,$r); 
	//匹配utf-8字符， 
	$str = $r[0]; 
	$l = count($str); 
	for($i=0; $i <$l; $i++) { 
		$value = ord($str[$i][0]); 
		if($value < 223) { 
			$str[$i] = rawurlencode(utf8_decode($str[$i])); 
			//先将utf8编码转换为ISO-8859-1编码的单字节字符，urlencode单字节字符. 
			//utf8_decode()的作用相当于iconv("UTF-8","CP1252",$v)。 
		} 
		else { 
			$str[$i] = "%u".strtoupper(bin2hex(iconv("UTF-8","UCS-2",$str[$i]))); 
		} 
	} 
	return join("",$str); 
}
function unescape($str) { 
	$ret = ''; 
	$len = strlen($str); 
	for ($i = 0; $i < $len; $i++) { 
		if ($str[$i] == '%' && $str[$i+1] == 'u'){ 
			$val = hexdec(substr($str, $i+2, 4)); 
			if ($val < 0x7f) $ret .= chr($val); 
			else if($val < 0x800) $ret .= chr(0xc0|($val>>6)).chr(0x80|($val&0x3f)); 
			else $ret .= chr(0xe0|($val>>12)).chr(0x80|(($val>>6)&0x3f)).chr(0x80|($val&0x3f)); 
			$i += 5; 
		} 
		else if ($str[$i] == '%') { 
			$ret .= urldecode(substr($str, $i, 3)); 
			$i += 2; 
		} 
		else $ret .= $str[$i]; 
		} 
		return $ret; 
}

function removehtml($str){//清除html
	$str = preg_replace( "@<script(.*?)</script>@is", "", $str ); 
	$str = preg_replace( "@<iframe(.*?)</iframe>@is", "", $str ); 
	$str = preg_replace( "@<style(.*?)</style>@is", "", $str ); 
	$str = preg_replace( "@<(.*?)>@is", "", $str ); 
	return $str;
}
function utf8_strlen($string = null) {
	preg_match_all("/./us", $string, $match);
	return count($match[0]);
}

function str_cut($str,$num,$rep="..."){//字符窜从左截取…
	$str = trim($str);
	$strnum = utf8_strlen($str);
	if($strnum<=$num){
		return ($str);
	}else{
		return (mb_substr($str,0,$num,"utf-8").$rep);
	}
}
function str_cut1($str,$num){//字符窜从左截取
	$str = trim($str);
	$strnum = utf8_strlen($str);
	if($strnum<=$num){
		return ($str);
	}else{
		return (mb_substr($str,0,$num,"utf-8")."");
	}
}
function sjs_time(){// 根据日期生成随机数
	$str=mt_rand(0,1000000000);
	$str = date("Ymdhis").$str;
	return ($str);	
}
function sjs($num){// 生成随机数  参数是位数  小于11位可用
	$str=mt_rand(0,pow(10,$num));
	return ($str);	
}
function sjs_s($num){  //生成位数不限的随机数   参数是位数
	$str_s = "";
	$str = "0,1,2,3,4,5,6,7,8,9";
	$str_one = mt_rand(1,9);
	for($i=1;$i<=$num-1;$i++){
		$str_s = $str_s.getSplit($str,",",mt_rand(0,9));
	}
	return ($str_one.$str_s);	
}
function getOrder(){//生成订单号
	$str = date("Ymdhis");
	$str = $str.sjs_s(20);
	return ($str);
}
function getFileName(){//取当前文件名
	return (str_replace("/","",$_SERVER["PHP_SELF"]));	
}
function daoExcelData($fileName){//导入excel返回数组  引入类
	$data = new Spreadsheet_Excel_Reader();
	$data->setOutputEncoding('utf-8');
	$data->read($fileName);
	error_reporting(E_ALL ^ E_NOTICE);
	return $data;
}
function upload($s_names,$values){
	$text = "<div id='div_".$s_names."' style='position:relative'>";
	$text = $text. "<input value='$values' name='$s_names' id='$s_names' size='20'   />";
	$text = $text. "&nbsp;&nbsp;<input onclick=openUploadFile('$s_names') style='height:22px;' type='button' value='上传资料' name='buts'    />";
	$text = $text."&nbsp;&nbsp;<input style='height:22px;' type='button' value='站内浏缆' onclick=window.showModalDialog('../filesystem/checkfile.php',$s_names,'dialogWidth=700px;dialogHeight=600px') />";
	$text = $text."</div>";
	return ($text);
}
function uploadHome($s_names,$values){
	$text = "<div id='div_".$s_names."' style='position:relative'>";
	$text = $text. "<input value='$values' name='$s_names' id='$s_names' size='20'   />";
	$text = $text. "&nbsp;&nbsp;<input onclick=openUploadFile('$s_names') style='height:22px;' type='button' value='上传' name='buts'   class='sc'   />";
	//$text = $text."&nbsp;&nbsp;<input style='height:22px;' type='button' value='站内浏缆' onclick=window.showModalDialog('../phpqunhe/filesystem/checkfile.php',$s_names,'dialogWidth=700px;dialogHeight=600px') />";
	$text = $text."</div>";
	return ($text);
}
function get_s($sqlStr){///获取单个字段
	$str="";
	$newDB = new db();
	$str = $newDB->get_s($sqlStr);
	return ($str);
	$newDB->closeDb();
}
function get_all($sqlStr){///获取1行，返回数组
	$str="";
	$newDB = new db();
	$str = $newDB->getAll($sqlStr);
	return ($str);
	$newDB->closeDb();
}
function getAll($sqlStr){///获取全部
	$str=array();
	$newDB = new db();
	$str = $newDB->getAll($sqlStr);
	return ($str);
	$newDB->closeDb();
}
function getLiAll($sqlStr){///获取全部
	$str=array();
	$newDB = new db();
	$str = $newDB->getLiAll($sqlStr);
	return ($str);
	$newDB->closeDb();
}

function getAllId($tableName,$id){//分类id及所有子分类id
	if($id==""){return "";}
	$arrid =$id;
	$arr = getLiAll("select id from  $tableName where parent_id = $id ");
	if(!isset($arr[0])){
		return $arrid;
	}else{
		foreach($arr as $v){
			$arrid = $arrid.",".getAllId($tableName,$v["id"]);
		}
	}
	return $arrid;

}

function getCount($sqlStr){///获取总记录
	$str="";
	$newDB = new db();
	$str = $newDB->getCount($sqlStr);
	return ($str);
	$newDB->closeDb();
}
function get_o($tableName,$cowName,$id){///根据id获取单个字段
	if($id!=""){
		return(get_s("select $cowName from $tableName where id = $id"));
	}else{
		return(get_s("select $cowName from $tableName "));
	}
}
function get_t($tableName,$cowName,$type,$id){///根据id获取单个字段 type
	if($id!=""){
		return (get_s("select $cowName from $tableName where s_type = '$type' and id = $id order by s_order asc , id desc" ));
	}else{
		return (get_s("select $cowName from $tableName where s_type = '$type' order by s_order asc , id desc "));
	}
}
function get_w($tableName,$cowName,$where){///根据id获取单个字段 where
	return(get_s("select $cowName from $tableName where $where "));
}
function getInfo($cowName,$type,$id){
	return (get_t("info",$cowName,$type,$id));	
}
function getpMain($cowName,$type,$id){
	return (get_t("p_main",$cowName,$type,$id));	
}
function getaMain($cowName,$type,$id){
	return (get_t("a_main",$cowName,$type,$id));	
}
function getOd($cowName,$type,$id){
	return (get_t("o_ad",$cowName,$type,$id));	
}
function getNewsClass($cowName,$type,$id){
	return (get_t("a_class",$cowName,$type,$id));	
}
function getProClass($cowName,$type,$id){
	return (get_t("p_class",$cowName,$type,$id));	
}

?>
<?
	class db{
		public $conn;
		public $dbConutn;
		public $dateArr;
		public $addNews;
		function db(){
		global $xing_db_localhost ;
		global $xing_db_root ;
		global $xing_db_password ;
		global $xing_db_dbName ;
			$this->conn=mysql_connect($xing_db_localhost,$xing_db_root,$xing_db_password);
			mysql_query("set names 'utf8'"); 
			mysql_select_db($xing_db_dbName,$this->conn);			
		}
		function closeDb(){
			mysql_close($this->conn);
		}
		function getAll($strSql){
			$result=mysql_query($strSql,$this->conn);
			$this->dbConutn = mysql_num_rows($result);
			return mysql_fetch_array($result,MYSQL_ASSOC);
		}
		function getLiAll($strSql){
			$newArray = array();
			$result=mysql_query($strSql,$this->conn);
			for ($i = 0; $i <= mysql_num_rows($result) - 1; $i++) {
				if (mysql_data_seek($result, $i)) { 
					$newArray [$i] =mysql_fetch_array($result,MYSQL_ASSOC);	
				}
			}
			return ($newArray);
		}
		function getCount($strSql){//计算总数
			$result=mysql_query($strSql,$this->conn);
			$this->dbConutn = mysql_num_rows($result);
			return ($this->dbConutn);
		}
		function setQuser($strSql){
			return mysql_query($strSql,$this->conn);	
		}
		function setFetch($text){
			return mysql_fetch_array($text);	
		}
		function get_one($tableName,$cowName,$id){//取数据库单个值，根据表名，字段名，id
			$result=mysql_query("select ".$cowName." from ".$tableName." where id = ".$id."  ",$this->conn);
			$ra = mysql_fetch_array($result);
			return $ra[$cowName];
			$this->closeDb();
		}
		function get_s($strSql){//取数据库单个值，完整sql,取select 后第一个值
			$cowNameArr = explode("select",$strSql);
			$cowName = $cowNameArr[1];
			$cowNameArr = explode("from",$cowName);
			$cowName = trim($cowNameArr[0]);
			$cowNameArr = explode(",",$cowName);
			$cowName = trim($cowNameArr[0]);
			$result=mysql_query($strSql,$this->conn);
			$ra = mysql_fetch_array($result);
			return $ra[$cowName];
			$this->closeDb();
		}///////////单字段，完整sql

		function phpUpdate($selectSqlStr){
			$tableName = explode("from",$selectSqlStr);
			$tableName = explode("where",$tableName[1]);
			$where = $tableName[1];
			$tableName = trim($tableName[0]);
			$newArray = array_keys($this->dateArr);
			$newArrayValue = array_values($this->dateArr);
			if($this->addNews){
				$this->setQuser("insert into ".$tableName." (".getFormEqualName($newArray,",").") values(".getFormEqualName2($newArrayValue,",").")   ");
			}
			else{
				for($i=0;$i<count($this->dateArr);$i++){
					//if($newArrayValue[$i]!=""){
						$this->setQuser("update  ".$tableName."  set   ".$newArray[$i]."='".$newArrayValue[$i]."' where ".$where." ");
					//}
				}
			}
			
		}/////////批量修改 或添加
	}
	
?>
