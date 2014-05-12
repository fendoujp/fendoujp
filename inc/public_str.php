<?
	function select($onchange,$selectId,$names,$strSql){
		$text="<select onchange=".$onchange." id=".$selectId." name=".$names.">";
		$dan = new db;
		$res = $dan->setQuser($strSql);
		$ri=0;
		while($rs=$dan->setFetch($res)){
			$text = $text."<option ".iif($rs["id"]==$selectId,"selected","")." value=".$rs["id"].">";
			$text = $text.$rs[$names];
			$text = $text."</option>";
		}
		$text=$text."</select>";
		return $text;
		$dan->closeDb();
	}
	
	
	function getSelect($selectId,$names,$strSql){
		$text="<select onchange=location.href='menu_class.php?parent_id='+this.value id=".$selectId." name=".$names.">";
		$dan = new db;
		$res = $dan->setQuser($strSql);
		$ri=0;
		while($rs=$dan->setFetch($res)){
			$text = $text."<option ".iif($rs["id"]==$selectId,"selected","")." value=".$rs["id"].">";
			$text = $text.$rs[$names];
			$text = $text."</option>";
		}
		$text=$text."</select>";
		return $text;
		$dan->closeDb();
	}
	
	function getSelect2($paid,$selectId,$names,$strSql){
		$text="<select onchange=location.href='menu_class.php?parent_id='+this.value+'&thisid=".$selectId."' id=".$selectId." name=".$names.">";
		$dan = new db;
		$res = $dan->setQuser($strSql);
		$ri=0;
		while($rs=$dan->setFetch($res)){
			$text = $text."<option ".iif($rs["id"]==$paid,"selected","")." value=".$rs["id"].">";
			$text = $text.$rs[$names];
			$text = $text."</option>";
		}
		$text=$text."</select>";
		return $text;
		$dan->closeDb();
	}
	
?>