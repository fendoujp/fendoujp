<!--内容开始-->
<div class="center container slide-box">
  <?php if($first_info['s_img']!=""){?>
  <div class="banner"><img src="<?php echo $first_info['s_img'];?>" width="958" height="auto" /></div>
  <div class="banner-bj"></div>
  <?php }?>
  <?php include(TPL_PATH."side.php");?>
  <div class="listcenter-right">
    <div class="location"><span>当前位置：<a href="/">首页</a> > 搜索结果</span>
      <h2>搜索结果</h2>
    </div>
    <div class="list-cen">
      <ul class="newssize">
<?php
$classid = $class_data['id'];
$s_type  = $class_data['s_type'];
$sql_str = "select * from a_main where 1=1";
if($search!=""){$sql_str  .= " and s_name like '%".$search."%' ";}
if($classid!=""){$sql_str .= " and classid = ".$classid." ";}
if($s_type!=""){$sql_str  .= " and s_type = '".$s_type."' ";}

$db = new db;
$pp = new page(gets("pageId"),10,$db->getCount($sql_str),getUrl());
//$sql_str .= " limit ".$pp->limitStart().",".$pp->limitEnd()." ";
$result = $db->setQuser($sql_str);
$ii=0;
while($v=$db->setFetch($result)){//}
?>

    <?php //foreach($news as $k=>$v){?>
      <li><a href="<?php echo cover_link(2,$v['id']);?>" title="<?php echo $v['s_name'];?>"><?php echo $v['s_name'];?></a></li>
    <?php $ii++;}?>
    <div class="scott"><?php //e($pp->qtPage());?></div>
    </ul>
    <?php if($ii==0){?><div style="text-align:center;">没有搜索到任何信息！</div><?php }?>
    </div>
  </div>
  <div class="cl"></div>
</div>
<!--内容结束-->