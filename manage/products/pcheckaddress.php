<? header("Content-Type: text/html; charset=utf-8");?>
<?php session_start();?>
<?php include("../../inc/publicfunction.php"); ?>
<?php include("../../inc/turepage.php"); ?>
<?
	$ids = gp("allids");
	$idsArr = splitArray($ids,",");
	$action = gg("action");
    $s_type = "photo";
	
	if($action=="checkall"){
		$dd = new db;
		for($i=0;$i<count($idsArr);$i++){		
			$dd->dateArr["s_name"]=gp("s_name".$idsArr[$i]);
			$dd->dateArr["classid"]=gp("classid".$idsArr[$i]);
			$dd->dateArr["cityid"]=gp("cityid".$idsArr[$i]);
			$dd->phpUpdate("select * from p_main where id = ".$idsArr[$i]."");	
		}
		
		$dd->closeDb();
		//ej("alert('操作成功');location.href='".delUrlKey("action")."'");
		ee("操作成功");
		exit();
	}

$sqlStr = "select * from lm_classify where 1=1 ";
if(!empty($s_type)) $sqlStr .= "and s_type='".$s_type."' ";
$sqlStr .= "order by s_order asc,id asc";
$classify_list = getLiAll($sqlStr);
$class_arr = array();
function class_func($parent_id=0){
  global $classify_list,$class_arr;
  foreach($classify_list as $k=>$v){
    if($v['parent_id']==$parent_id){
       $class_arr[] = $v;
       class_func($v['id']);
    }
  }
  return $class_arr;
}
$list_arr = class_func();
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
<div>
	<div class="title">批量修改</div>
    
    
  
 <table  id="tableLists" border="1">
    <form method="post" id="myforms" name="myforms" action="?action=checkall">
     <input type="hidden" value="<?=$ids?>" name="allids" id="allids" />
     <? for($i=0;$i<count($idsArr);$i++){?> 
		<tr>
        	<td width="5%">名称</td>
        	<td width="27%">
				<input name="s_name<?=$idsArr[$i]?>" type="text" id="s_name<?=$idsArr[$i]?>" value="<?=get_o("p_main","s_name",$idsArr[$i])?>" size="50" />
            
            </td>
            
            
            
            
            <td width="5%">
            	 行业
            </td>
            <td width="35%">
            	<select  name="classid<?=$idsArr[$i]?>" id="classid<?=$idsArr[$i]?>">
                <option value="0">无</option>
                <?php foreach($list_arr as $k=>$v){?> 
                  <option value="<?php echo $v['id'];?>"<?php if($v['id']==get_o("p_main","classid",$idsArr[$i]))echo' selected="selected"';?>>├<?php for($s=1;$s<$v['class_depth'];$s++){echo'─';}?><?php echo $v['s_name'];?></option>
                <?php }?>
                </select>
            
            </td>
        
        
        
        
        </tr>
     <? }?>   
     
     <tr>
     	<td colspan="4">
        	
            
          
              
              
              
              全部选择行业
              
              <select onchange="checkAllAddress(this.id,'classid');"  name="classidmm" id="classidmm">
                <option value="0">无</option>
                <?php foreach($list_arr as $k=>$v){?> 
                  <option value="<?php echo $v['id'];?>">├<?php for($s=1;$s<$v['class_depth'];$s++){echo'─';}?><?php echo $v['s_name'];?></option>
                <?php }?>
                </select>
              
              
              
              
                   &nbsp;&nbsp;&nbsp;&nbsp;
                <input value="提交" type="submit" />
            
            
         
            
        </td>
     </tr>
     
     </form>
    </table>
    
    
  
	<script>
    function checkAllAddress(id,ciid){
		var items = document.getElementById(id).selectedIndex;
		var ids = "<?=$ids?>";
		idsArr = ids.split(",");
		for(var i=0;i<idsArr.length;i++){
			document.getElementById(ciid+idsArr[i]).options[items].selected=true;
		}
		
	}
    
    </script>
    
    
  
 
</div>

</body>
</html>
