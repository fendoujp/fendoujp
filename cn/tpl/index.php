<!--banner开始-->
<?php
//焦点图
$focus  = getLiAll("select * from o_ad where s_type='turnpic' order by s_order asc,id asc");
//网站公告
$notice = getLiAll("select * from a_main where classid=54 order by s_order asc,s_time desc,id desc limit 1");
//网站新闻
$news   = getLiAll("select * from a_main where classid=38 order by s_order asc,s_time desc,id desc limit 11");
//学生感言
$testimonials = getLiAll("select * from a_main where classid=39 order by s_order asc,s_time desc,id desc limit 10");
//留日指南
$lrzn_class = subclass(36);
//留日指南
$lrsh_class = subclass(37);
//常见问题
$cjwt_class = getLiAll("select * from a_class where id=40");
$cjwt_info  = getLiAll("select * from a_main where classid=40 order by s_order asc,s_time desc,id desc limit 15");
//日本街拍
$rbjp_class = getLiAll("select * from lm_classify where id=41");
$rbjp_info  = getLiAll("select * from p_main where classid=41 order by s_order asc,s_time desc,id desc limit 6");
//日本旅游
$rbly_class = getLiAll("select * from lm_classify where id=42");
$rbly_info  = getLiAll("select * from p_main where classid=42 order by s_order asc,s_time desc,id desc limit 9");
//合作院校
$hzyx_class = getLiAll("select * from lm_classify where id=43");
$hzyx_info  = getLiAll("select * from a_main where classid=43 order by s_order asc,s_time desc,id desc limit 60");
?>
<div class="slide-box container clearfix">
  <div id="desSlideshow1" class="desSlideshow">
    <div class="switchBigPic">
    <?php foreach($focus as $v){?>
      <div> <a href="<?php echo $v['s_name1'];?>"><img class="pic" src="<?php echo $v['s_img'];?>" width="600" height="249" alt="<?php echo $v['s_name'];?>" /></a>
        <p><strong><?php echo $v['s_name'];?></strong></p>
      </div>
    <?php }?>
    </div>
    <ul class="nav">
    <?php foreach($focus as $v){?>
      <li><a href="<?php echo $v['s_name1'];?>"><?php echo $v['s_name'];?></a></li>
    <?php }?>
    </ul>
  </div>
  <div class="slide-right">
  <?php foreach($notice as $v){?>
    <h2><strong>网站</strong>公告<a href="<?php echo cover_link(1,54);?>">more>></a></h2>
    <div> <?php if(!empty($v['s_img']))?><img src="<?php echo $v['s_img'];?>" alt="<?php echo $v['s_name'];?>"> </div>
    <div class="slide-rightContent">
      <h3><a href="<?php echo cover_link(2,$v['id']);?>"><?php echo $v['s_name'];?></a></h3>
      <p><?php echo str_cut(strip_tags($v['s_conj']),48);?><a href="<?php echo cover_link(2,$v['id']);?>">[更多]</a></p>
    </div>
  <?php }?>
  </div>
</div>
<!--banner结束-->
<!--办理流程开始-->
<div class="handle">
<?php
$subclass = subclass(63);
foreach($subclass as $k=>$v){
?>
<a<?php if($k==0)echo' class="first"';?> href="<?php echo cover_link(1,$v['id']);?>" title="<?php echo $v['s_name'];?>"><?php echo $v['s_name'];?></a>
<?php }?>
</div>
<!--办理流程结束-->
<!--留日指南1开始-->
<div class="guide">
  <div class="guide-left"> <img class="triangle" src="/cn/images/guide-triangle.png" alt="三角"><img class="guide-log" src="/cn/images/guide-logo.png" alt="留日指南">
    <ul class="Menubox">
    <?php foreach($lrzn_class as $k=>$v){?>
      <li id="one<?php echo $k+1;?>" onclick="setTab('one',<?php echo $k+1;?>,4)" <?php if($k==0)echo 'class="hover"';?>><?php echo $v['s_name']?></li>
    <?php }?>
    </ul>
    <div class="guide-list Contentbox">
    <?php foreach($lrzn_class as $k=>$v){?>
      <div class="guide-item <?php if($k>0)echo'none';?>" id="con_one_<?php echo $k+1?>"> <img src="<?php echo $v['s_img'];?>">
        <dl>
        <?php $lrzn_info = news_info($v['id'],18);foreach($lrzn_info as $k2=>$v2){?>
          <dd <?php if($k2%2==0)echo'class="mr"';?>><a href="<?php echo cover_link(2,$v2['id']);?>" title="<?php echo $v2['s_name'];?>">· <?php echo $v2['s_name'];?></a></dd>
        <?php }?>
        </dl>
      </div>
    <?php }?>
    </div>
  </div>
<!--留日指南1结束-->
<!--网站新闻开始-->
  <div class="guide-right">
    <h2><strong>网站</strong>新闻<a href="<?php echo cover_link(1,38);?>">more>></a></h2>
    <div class="guide-rightContent">
      <?php $v=$news[0];?>
      <div class="guide-righttop"> <img src="<?php echo $v['s_img'];?>" width="89" height="70" alt="<?php echo $v['s_name'];?>" />
        <dl>
          <dt><a href="<?php echo cover_link(2,$v['id']);?>" title="<?php echo $v['s_name'];?>"><?php echo $v['s_name'];?></a></dt>
          <dd><?php echo str_cut(strip_tags($v['s_conj']),36);?></dd>
        </dl>
		<div class="cl"></div>
      </div>
      <div class="guide-rightlist">
        <ul>
        <?php foreach($news as $k=>$v){
          if($k>0){?>
          <li><a href="<?php echo cover_link(2,$v['id']);?>" title="<?php echo $v['s_name'];?>"><?php echo $v['s_name'];?></a></li>
        <?php }}?>
        </ul>
      </div>
    </div>
  </div>
  <div class="cl"></div>
</div>
<!--网站新闻结束-->
<!--留日指南2开始-->
<div class="guide">
  <div class="guide-left"> <img class="triangle" src="/cn/images/guide-triangle.png" alt="三角" /><img class="guide-log" src="/cn/images/life-logo.png" alt="留日生活" />
    <ul class="Menubox">
    <?php foreach($lrsh_class as $k=>$v){?>
      <li id="two<?php echo $k+1;?>" onclick="setTab('two',<?php echo $k+1;?>,5)" <?php if($k==0)echo 'class="hover"';?>><?php echo $v['s_name']?></li>
    <?php }?>
    </ul>
    <div class="cl"></div>
    <div class="guide-list Contentbox">
    <?php foreach($lrsh_class as $k=>$v){?>
      <div class="guide-item2 <?php if($k>0)echo 'none';?>" id="con_two_<?php echo $k+1;?>">
        <div class="tab_l">
          <p><a href="<?php echo cover_link(1,$v['id']);?>"><img src="<?php echo $v['s_img'];?>" width="279" height="253" /></a></p>
          <p class="ttext"><em><a href="<?php echo cover_link(1,$v['id']);?>" title="<?php echo $v['s_name'];?>"><?php echo $v['s_name'];?></a></em></p>
        </div>
        <div class="tab_r">
          <?php $lrsh_info = news_info($v['id'],8);?>
          <div class="indexnews-title">
            <h3><a href="<?php echo cover_link(2,$lrsh_info[0]['id']);?>" title="<?php $lrsh_info[0]['s_name']?>"><?php echo $lrsh_info[0]['s_name'];?></a></h3>
              <p><?php echo str_cut(strip_tags($lrsh_info[0]['s_conj']),50);?><span class="red"><a href="<?php echo cover_link(2,$lrsh_info[0]['id']);?>">[详细]</a></span></p>
          </div>
          <ul class="indexnews-list">
          <?php foreach($lrsh_info as $k2=>$v2){if($k2>0){?>
            <li><a href="<?php echo cover_link(2,$v2['id']);?>" title="<?php echo $v2['s_name'];?>">· <?php echo $v2['s_name'];?></a></li>
          <?php }}?>
          </ul>
        </div>      
        <div class="cl"></div>
      </div>
    <?php }?>
    </div>
  </div>
<!--留日指南2结束-->
<!--学生感言开始-->
  <div class="guide-ganyan">
    <h2><a href="<?php echo cover_link(1,39);?>">more&gt;&gt;</a></h2>
        <ul class="guide-ganyanlist">
        <?php foreach($testimonials as $v){?>
          <li><a href="<?php echo cover_link(2,$v['id']);?>" title="<?php echo $v['s_name'];?>">· <?php echo $v['s_name'];?></a></li>
        <?php }?>
        </ul>
  </div>
  <div class="cl"></div>
</div>
<!--学生感言结束-->
<!--申请办理开始-->
<div class="indexapply">
<?php
$subclass = subclass(64);
foreach($subclass as $k=>$v){
?>
 <a<?php if($k==0)echo' class="first"';?> href="<?php echo cover_link(1,$v['id']);?>" title="<?php echo $v['s_name'];?>"><?php echo $v['s_name'];?></a>
<?php }?>
</div>
<!--申请办理结束-->
<!--常见问题开始-->
<div class="guide question">
  <h2><img class="triangle" src="/cn/images/guide-triangle.png" alt="三角"></h2>
    <h3><img class="guide-log" src="/cn/images/question-logo_38.png" alt="常见问题"></h3>
    <span class="photolis-more"><a href="<?php echo cover_link(1,40);?>">more&gt;&gt;</a></span>
      <ul class="question-list">
      <?php foreach($cjwt_info as $k=>$v){?>
        <li><a href="<?php echo cover_link(2,$v['id']);?>" title="<?php echo $v['s_name'];?>">· <?php echo $v['s_name'];?></a></li>
      <?php }?>
      </ul>
  <div class="cl"></div>
</div>
<!--常见问题结束-->
<!--日本街拍开始-->
<div class="guide photolist">
  <h2><?php echo $rbjp_class[0]['s_name'];?></h2><span class="photolis-more"><a href="<?php echo cover_link(1,$rbjp_class[0]['id']);?>" title="<?php echo $rbjp_class[0]['s_name'];?>">more&gt;&gt;</a></span>
    <?php foreach($rbjp_info as $k=>$v){?>
    <dl class="list-street">
      <dd class="street-photo"><a href="<?php echo cover_link(3,$v['id']);?>" title="<?php echo $v['s_name'];?>"><img src="<?php echo $v['s_img'];?>" width="135" height="90" alt="<?php echo $v['s_name'];?>" /></a></dd>
      <dt class="street-title"><a href="<?php echo cover_link(3,$v['id']);?>" title="<?php echo $v['s_name'];?>"><?php echo $v['s_name'];?></a></dt>
    </dl>
    <?php }?>
  <div class="cl"></div>
</div>
<!--日本街拍结束-->
<!--日本旅游开始-->
<div class="guide photolist">
  <h2><?php echo $rbly_class[0]['s_name'];?></h2><span class="photolis-more"><a href="<?php echo cover_link(1,$rbly_class[0]['id']);?>" title="<?php echo $rbly_class[0]['s_name'];?>">more&gt;&gt;</a></span>
    <?php foreach($rbly_info as $k=>$v){ $size = $k==0 ? ' width="291" height="230"':' width="135" height="90"';?>
    <dl class="list-street">
      <dd class="street-photo"><a href="<?php echo cover_link(3,$v['id']);?>" title="<?php echo $v['s_name'];?>"><img src="<?php echo $v['s_img'];?>" alt="<?php echo $v['s_name'];?>" /></a></dd>
      <dt class="street-title"><a href="<?php echo cover_link(3,$v['id']);?>" title="<?php echo $v['s_name'];?>"><?php echo $v['s_name'];?></a></dt>
    </dl>
    <?php }?>
  <div class="cl"></div>
</div>
<!--日本旅游结束-->
<!--合作院校开始-->
<div class="guide school">
  <span class="photolis-more"><a href="<?php echo cover_link(1,$hzyx_class[0]['id'])?>">more&gt;&gt;</a></span>
  <h2><img class="triangle" src="/cn/images/guide-triangle.png" alt="三角"></h2>
    <h3><img class="guide-log" src="/cn/images/school-title.png" alt="<?php echo $hzyx_class[0]['s_name'];?>"></h3>
    <div id="slider">
  <a class="pre"></a>
  <div id="wai_box">
    <div class="slider_box">
    <?php 
    foreach($hzyx_info as $k=>$v){
      if($k==0 || ($k+1)%11==0) echo '<ul>';
    ?>
        <li><a href="<?php echo cover_link(4,$v['id']);?>" class="images"><img src="<?php echo $v['s_img'];?>" alt="<?php echo $v['s_name'];?>" /></a><span class="title"><a href="<?php echo cover_link(4,$v['id']);?>" title="<?php echo $v['s_name'];?>"><?php echo str_cut($v['s_name'],9,'');?></a></span></li>
    <?php
      if(($k+1)%10==0 || ($k+1)==count($hzyx_info)) echo '</ul>';
    }?>
    </div>
  </div>
  <a class="next"></a>
</div>
  <div class="cl"></div>
</div>
<!--合作院校结束-->