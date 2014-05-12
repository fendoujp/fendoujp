<!--内容开始-->
<div class="center container slide-box">
  <?php if($first_info['s_img']!=""){?>
  <div class="banner"><img src="<?php echo $first_info['s_img'];?>" width="958" height="auto" /></div>
  <div class="banner-bj"></div>
  <?php }?>
  <?php include(TPL_PATH."side.php");?>
  <div class="listcenter-right">
    <?php $crumb = crumb($class_id);?>
    <div class="location"><span>当前位置：<?php foreach($crumb as $v){if($v['id']==$class_id){echo $v['name']; }else{?><a href="<?php echo $v['url'];?>"><?php echo $v['name'];?></a> &gt; <?php }}?></span>
      <h2><?php echo $class_data['s_name'];?></h2>
    </div>
    <div class="list-cen">
      <div class="shcool">
<?php
$classid = $class_data['id'];
$s_type  = $class_data['s_type'];
$sql_str = "select * from a_main where 1=1";
if($search!=""){$sql_str  .= " and s_name like '%".$search."%' ";}
if($classid!=""){$sql_str .= " and classid = ".$classid." ";}
if($s_type!=""){$sql_str  .= " and s_type = '".$s_type."' ";}
//$url = getUrl();
$url = $s_type."-".$classid."-";
$db = new db;
$pp = new page(gets("pageId"),24,$db->getCount($sql_str),$url,1);
$sql_str .= " limit ".$pp->limitStart().",".$pp->limitEnd()." ";
$result = $db->setQuser($sql_str);
$ii=0;
while($v=$db->setFetch($result)){//}
?>
      <?php //foreach($school as $k=>$v){?>
        <dl class="shcool-list">
            <dd class="shcool-photo"><a href="<?php echo cover_link(4,$v['id']);?>" title="<?php echo $v['s_name'];?>"><img src="<?php echo $v['s_img'];?>" width="154" height="60" alt="<?php echo $v['s_name'];?>" /></a></dd>
            <dt class="shcool-deta"><a href="<?php echo cover_link(4,$v['id']);?>" title="<?php echo $v['s_name'];?>"><?php echo $v['s_name'];?></a></dt>
        </dl>
      <?php }?>
      </div>
      <div class="cl"></div>
      <div class="scott"><?php e($pp->qtPage());?></div>
    </div>
  </div>
  <div class="cl"></div>
</div>
<!--内容结束-->