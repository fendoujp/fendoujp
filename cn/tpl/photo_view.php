﻿<!--内容开始-->
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
      <div class="newscenter-deta">
        <h2><?php echo $photo_view['s_name'];?></h2>
        <h3>发布日期：<?php echo cover_time("Y.m.d",$photo_view['s_time']);?>　　浏览次数：<?php echo $photo_view['s_read'];?>次</h3>
          <div class="zhaiyao"><span class="red">摘要：</span><?php echo strip_tags($photo_view['s_conj']);?></div>
          <div class="deta-center"><?php if($photo_view['s_img1']!=''){?><img style="float:left; margin:0 15px 5px 0;" src="<?php echo $photo_view['s_img1'];?>" alt="<?php echo $photo_view['s_name'];?>" /><?php }?><?php echo $photo_view['s_content'];?><div class="cl"></div></div>
        <div class="deta-page">
          <p class="fl"><?php echo a_prev($photo_view['s_type'],$photo_view['id'],"classid=".$class_data['id']);?></p> <p class="fr"><?php echo a_next($photo_view['s_type'],$photo_view['id'],"classid=".$class_data['id']);?></p>
        </div>
      </div>
    </div>
  </div>
  <div class="cl"></div>
</div>
<!--内容结束-->