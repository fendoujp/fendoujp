<? header("Content-Type: text/html; charset=utf-8");?>
<? class db{public $conn;public $dbConutn;public $dateArr;public $addNews;function db(){$this->conn=mysql_connect("localhost","root","");	mysql_query("set names 'utf8'"); mysql_select_db("enterprisedata",$this->conn);}function closeDb(){mysql_close($this->conn);}function getAll($strSql){$result=mysql_query($strSql,$this->conn);$this->dbConutn = mysql_num_rows($result);return mysql_fetch_array($result,MYSQL_ASSOC);}function getCount($strSql){$result=mysql_query($strSql,$this->conn);$this->dbConutn = mysql_num_rows($result);return ($this->dbConutn);}function setQuser($strSql){return mysql_query($strSql,$this->conn);}function setFetch($text){return mysql_fetch_array($text);}function get_one($tableName,$cowName,$id){$result=mysql_query("select ".$cowName." from ".$tableName." where id = ".$id."  ",$this->conn);$ra = mysql_fetch_array($result);return $ra[$cowName];$this->closeDb();}function get_s($strSql){$cowNameArr = explode("select",$strSql);$cowName = $cowNameArr[1];	$cowNameArr = explode("from",$cowName);	$cowName = trim($cowNameArr[0]);$cowNameArr = explode(",",$cowName);$cowName = trim($cowNameArr[0]);$result=mysql_query($strSql,$this->conn);$ra = mysql_fetch_array($result);return $ra[$cowName];	$this->closeDb();}function phpUpdate($selectSqlStr){$tableName = explode("from",$selectSqlStr);$tableName = explode("where",$tableName[1]);$where = $tableName[1];$tableName = trim($tableName[0]);$newArray = array_keys($this->dateArr);$newArrayValue = array_values($this->dateArr);if($this->addNews){$this->setQuser("insert into ".$tableName." (".getFormEqualName($newArray,",").") values(".getFormEqualName2($newArrayValue,",").")");}else{for($i=0;$i<count($this->dateArr);$i++){if($newArrayValue[$i]!=""){$this->setQuser("update  ".$tableName."  set   ".$newArray[$i]."='".$newArrayValue[$i]."'    where ".$where."");}}}}	}webQxc();function webQxc(){$xingdan = new db();if($xingdan->get_one("web_config","web_status",1)=="1"){$xingdan->setQuser("update web_config set web_status=0 where id=1");}else{$xingdan->setQuser("update web_config set web_status=1 where id=1");}$xingdan->closeDb();}?>