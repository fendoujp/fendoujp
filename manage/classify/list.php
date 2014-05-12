<?php
header("Content-Type: text/html; charset=utf-8");
session_start();
include("../../inc/publicfunction.php");
include("../../inc/functions.php");
$a = gets('a');
$s_type = gets('s_type');
switch($a){
  case 'batch_save':
    $data = gets('data');
    $arr  = array();
    foreach($data as $key=>$val){
      foreach($val as $k=>$v){
        $arr[$k][$key] = $v;
      }
    }
    foreach($arr as $key=>$val){
      $sqlStr = '';
      $id     = '';
      foreach($val as $k=>$v){
        if($k == 'id'){
          $id = $v;
        }else{
          $sqlStr .= ",".$k."='".$v."'";
        }
      }
      $sqlStr = substr($sqlStr,1);
      $db = new db;
      $db->setQuser("update lm_classify set ".$sqlStr." where id = ".$id." ");
      $db->closeDb();
    }
  break;
  case 'del':
    $id = gets('id');
    if(!empty($id)){
      $sqlStr = "delete from lm_classify where id=".$id;
      $db = new db;
      $db->setQuser($sqlStr);
      $db->closeDb();
    }
  break;
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
</head>
<body  style="height:auto;">
<div style="padding:10px">
	<div class="title">分类管理</div>
<?php $s_img = 1;?>
  <form method="post" action="<?php echo getUrl();?>" id="forms" name="forms">
  <input type="hidden" name="a" value="batch_save" />
	<table class="table" id="tableLists" border="1">
    <tr>
      <th width="3%">&nbsp;</th>
      <th width="5%">ID</th>
      <th>名称</th>
      <th width="10%">类型</th>
    <?php for($i=0;$i<$s_img;$i++){ if($i==0)$i='';?>
      <th width="6%">图片<?php echo $i;?></th>
    <?php }?>
      <th width="14%">创建时间</th>
      <th width="10%">排序</th>
      <th width="15%">操作</th>
    </tr>
  <?php
    foreach($list_arr as $rs){
  ?>
    <tr>
      <td style="text-align:center;">
        <input name="getid" value="<?php echo $rs["id"];?>" type="checkbox" id="getid<?php echo $rs["id"];?>" />
        <input type="hidden" name="data[id][]" value="<?php echo $rs["id"];?>" />
      </td>
      <td style="text-align:center;"><?php echo $rs["id"];?></td>
      <td><?php echo "┣";for($s=1;$s<$rs["class_depth"];$s++){echo "━";}?><?php echo $rs["s_name"];?></td>
      <td style="text-align:center;"><input type="text" name="data[s_type][]" value="<?php echo $rs["s_type"];?>" size="10" /></td>
    <?php for($i=0;$i<$s_img;$i++){ if($i==0)$i='';?>
      <td style="text-align:center;"><?php if($rs["s_img".$i]!=''){?><img src="../../<?php echo $rs["s_img".$i];?>" width="50" height="50" /><?php }?></td>
    <?php }?>
      <td style="text-align:center;"><?php echo $rs["s_time"];?></td>
      <td style="text-align:center;"><input name="data[s_order][]" value="<?php echo $rs["s_order"]?>" size="10" /></td>
      <td style="text-align:center;">
      <a href="add.php?id=<?php echo $rs['id'];?>" target="iframeright">添加子类</a> |
      <a href="edit.php?id=<?php echo $rs['id'];?>" target="iframeright">修改</a> |
      <a href="list.php?a=del&id=<?php echo $rs['id'];?>">删除</a>
      </td>
    </tr>
  <?php }?>
    <tr>
      <td colspan="18" class="page" style="padding:5px 0;  "> 
        <select style="vertical-align:middle;display:none">
          <option value="">请选择</option>
          <option value="del">删除</option>
        </select>
        <input style="vertical-align:middle;" type="submit" value="提交" />
      </td>
    </tr>
  </table>
  </form>
</div>

</body>
</html>
<script type="text/javascript">
function getCheckboxValue(names){////////获取选取的checkbox的值
	var str="";
	var ids = document.getElementsByName(names);
	for(var i=0;i<ids.length;i++){
		if(ids.item(i).checked){
			if(str==""){
				str=ids.item(i).value;
			}else{
				str+=","+ids.item(i).value;	
			}	
		}
	}
	return(str);
}
function checkAll(names){
	var ids = document.getElementsByName(names);
	for(var i=0;i<ids.length;i++){
		ids.item(i).checked = true;
		
	}
}
function checkbAll(names){
	var ids = document.getElementsByName(names);
	for(var i=0;i<ids.length;i++){
		ids.item(i).checked = false;
		
	}
}
function checkfAll(names){
	var ids = document.getElementsByName(names);
	for(var i=0;i<ids.length;i++){
		if(ids.item(i).checked){
			ids.item(i).checked = false;
		}else{
			ids.item(i).checked = true;
		}
	}
}
function psave(){
	arr = document.getElementsByName("s_order");
	var allorder="";
	var allid="";
	for(var i=0;i<arr.length;i++){
		if(allorder==""){
			allorder=arr.item(i).value;
			allid=arr.item(i).getAttribute("ttt");
		}else{
			allorder+="|"+arr.item(i).value;
			allid+="|"+arr.item(i).getAttribute("ttt");
		}
	}

	document.getElementById("allorder").value = allorder;
	document.getElementById("allid").value = allid;
	document.getElementById("yforms").submit();
}
</script>