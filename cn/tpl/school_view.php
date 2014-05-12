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
          <dl class="shcool-list">
              <dd class="shcool-photo"><img src="<?php echo $school_view['s_img'];?>" width="154" height="60" /></dd>
                <dt class="shcool-deta"><?php echo $school_view['s_name'];?></dt>
            </dl>
            <div class="shcool-info"><h2>学校联络处</h2><?php echo $school_view['s_conj'];?></div>
        <div class="cl"></div>
    <div class="school-menu">
          <ul class="sc-title">
              <li id="one1" onclick="setTab('one',1,3)" class="hover">学校介绍</li>
              <li id="one2" onclick="setTab('one',2,3)">招生介绍</li>
              <li id="one3" onclick="setTab('one',3,3)">学校环境</li>
              <li><a href="/signup-list-10.html" target="_blank">在线报名</a></li>
             <div class="cl"></div>
            </ul>
            <div class="school-cen" id="con_one_1"><?php echo $school_view['s_content'];?></div>
            <div class="school-cen none" id="con_one_2"><?php echo $school_view['s_content1'];?></div>
            <div class="school-cen none" id="con_one_3">
              <ul class="sc-list">
              <?php
              $sql = "select * from main_info where classid=".$school_view['id']." order by s_order asc,s_time desc,id desc";
              $school_pic = getLiAll($sql);
              foreach($school_pic as $k=>$v){
              ?>
                <li><a href="<?php echo $v['s_img'];?>" rel="clearbox[test1]" title="<?php echo $v['s_name'];?>"><img src="<?php echo $v['s_img'];?>" width="196" height="143" alt="<?php echo $v['s_name'];?>" /></a></li>
              <?php }?>
              </ul>
            </div>
        </div>
        </div>
      <div class="cl"></div>
    </div>
  </div>
  <div class="cl"></div>
</div>
<!--内容结束-->
<SCRIPT src="/cn/js/clearbox.js" type="text/javascript"></SCRIPT>