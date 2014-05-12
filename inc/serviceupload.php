
<?

class xing_upload{
	public $fileSize;
	public $filePath;
   function fileext($filename){//获取文件后缀名函数
        return substr(strrchr($filename, '.'), 1);
    }  
    function random($length){   //生成随机文件名函数 
		$hash = 'CR-';
		$chars = '0123456789abcdefghijklmnopqrstuvwxyz';
		$max = strlen($chars) - 1;
		mt_srand((double)microtime() * 10000000);
		for($i = 0; $i < $length; $i++){
			$hash .= $chars[mt_rand(0, $max)];
		}
        return date("Y-m-d").$hash;
    }
	function getFileSize($formName){
		return ($_FILES[$formName]['size']);	
	}//文件大小
	function createFiles($fileName){
   		if(!file_exists($fileName)){   //检测根目录是否存在;
    		@mkdir($fileName,0777);     //不存在则创建;
   		}
 	} 
	function setFileSave($type,$uploadSavePath,$formName,$fileSize){
		$uploaddir = $uploadSavePath."/".date("Y-m");//设置文件保存目录 注意包含/   
		$type = explode("|",$type);
   		$patch="./";//程序所在路径
  		$a=strtolower($this->fileext($_FILES[$formName]['name']));
		if(!in_array(strtolower($this->fileext($_FILES[$formName]['name'])),$type)){ //判断文件类型
       		$text=implode(",",$type);
        	echo "您只能上传以下类型文件: ",$text,"<br>";
			exit();
    	}else if($this->getFileSize($formName)>$fileSize){
			return ($this->getFileSize($formName));
		}
   		else{//生成目标文件的文件名
   			$filename=explode(".",$_FILES[$formName]['name']);
			$this->createFiles($uploaddir);
        do{
            $filename[0]=$this->random(10); //设置随机数长度
            $name=implode(".",$filename);
            $uploadfile=$uploaddir."/".$name;
        }
		
		while(file_exists($uploadfile));
			if(move_uploaded_file($_FILES[$formName]['tmp_name'],$uploadfile)){
				if(!is_uploaded_file($_FILES[$formName]['tmp_name'])){
					$this->fileSize = $_FILES[$formName]["size"]/1024;
					$this->filePath = $uploadfile;
					return ($uploadfile);
				}
				else{
					return (false);
				}
					
			}
   		}
	}
	
}
//$dd = (new xing_upload);
//echo $dd->setFileSave("jpg|png","../uploadfile","file",2*1024*1024);
//echo $dd->fileSize;



?>





