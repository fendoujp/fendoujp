<div class="listcenter-left">
  <div class="nav-left">
  <?php 
  $result = is_subclass($class_first);
  $cid = $result ? $class_first : 16;
  $class_info = class_info($cid);
  $subclass   = subclass($cid);
  ?>
    <h2><?php echo $class_info['s_name'];?></h2>
    <ul class="nav-list">
    <?php foreach($subclass as $v){?>
      <li <?php if($v['id']==$class_id)echo 'class="hover"';?>><a href="<?php echo cover_link(1,$v['id']);?>" title="<?php echo $v['s_name'];?>"><?php echo $v['s_name'];?></a></li>
    <?php }?>
    </ul>
  </div>
  <div class="nav-leftbj"></div>
  <div class="list-school mt10">
    <!--<h2><strong>合作</strong>院校</h2>-->
    <ul>
    <?php
    $advert = getLiAll("select * from o_ad where s_type='advert' order by s_order asc,id asc");
    foreach($advert as $v){
    ?>
      <li><a href="<?php echo $v['s_name1'];?>" title="<?php echo $v['s_name'];?>"><img src="<?php echo $v['s_img'];?>" width="228" height="91" alt="<?php echo $v['s_name'];?>" /></a></li>
    <?php }?>
    </ul>
    <div class="cl"></div>
  </div>
</div>