<? header("Content-Type: text/html; charset=utf-8");?>
<?php include("publicfunction.php"); ?>
<?php include("serviceupload.php"); ?>
<?
	if(isset($_GET["action"])){
		if($_GET["action"]=="addimg"){
			$dd = new xing_upload;
			$upLoadFileConfig = get_o("web_config ","s_uploadset","");
			echo "<script>alert('上传文件成功:". $dd->setFileSave($upLoadFileConfig,"../uploadfile",$_GET["s_name"],2*1024*1024)."')</script>";
			//echo $dd->fileSize;
			echo ("<script>parent.document.getElementById('".$_GET["s_name"]."').value='".$dd->filePath."';parent.closeOpenUploadFile('".$_GET["s_name"]."');</script>");
			exit();
			
		}
	}

?>
  <form id="xinguploadfile" method="post" action="?action=addimg&s_name=<?=$_GET["s_name"]?>" enctype="multipart/form-data">
     <table border=0 cellspacing=0 cellpadding=0 align=center width="100%">
      <tr>
        <td width=55 height=20 align="center"><input type="hidden" name="MAX_FILE_SIZE" value="2000000">文件： </TD>
        <td height="16">
        <input name="<?=$_GET["s_name"]?>" id="<?=$_GET["s_name"]?>" type="file"  value="浏览" >
         
        <input type="button" onclick="if(document.getElementById('<?=$_GET["s_name"]?>').value==''){alert('上传文件不能为空');}else{document.getElementById('xinguploadfile').submit();}" value="上传" name="B1">
        
        
        
        </td>
      </tr>
     </table>
     </form>
