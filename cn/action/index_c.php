<?php
// +--------------------------------------------
// | 首页控制器
// | author:LMing
// +--------------------------------------------

$t = gets('t');
if(empty($t)) $t = 'index';

$sqlStr = " select id,s_name,s_conj,s_price,s_name1,s_content,s_img  from p_main where `s_type`='p_class' and `s_ok`='5'";
if($keywords!=""){
  $sqlStr = $sqlStr." and s_name like '%".$keywords."%' ";
}
if($id!=""){
  $classid = getAllId("p_class",$id);
  $sqlStr  = $sqlStr." order by s_order asc,id desc ";
}
$pp = new page(gg("pageId"),12,getCount($sqlStr),getUrl());
$productArray = getLiAll($sqlStr."  limit  ".$pp->limitStart().",".$pp->limitEnd()." "); 
$newssqld = " select id,s_name,s_time,s_conj,classid from a_main  where 1=1 and s_type = 'a_class' ";
$newsclassarr = getLiAll(" select id,s_name from a_class  where parent_id=0 and s_type = 'a_class' order by s_order asc,id desc");
if($id!=""){
  $newssqld=$newssqld." and classid = $id ";
}
$pp = new page(gg("pageId"),12,getCount($newssqld),getUrl());
$newsarr = getLiAll(" $newssqld order by s_order asc,id desc limit ".$pp->limitStart().",".$pp->limitEnd()." ");
//juid($newsclassarr,$id);

switch($t){
  case 'index':
    include(TPL_PATH."head.php");
    include(TPL_PATH."index.php");
    include(TPL_PATH."foot.php");
  break;
}
?>