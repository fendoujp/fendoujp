<!--底部开始-->
<div class="guide footer">
  <div class="link">
    <span class="link-title"><img src="/cn/images/link-title_66.jpg" width="31" height="34" /></span>
    <ul class="link-list">
    <?php 
    $links = getLiAll("select * from o_ad where s_type='link' order by s_order asc,s_time desc,id desc limit 10");
    foreach($links as $k=>$v){
    ?>
      <li><a href="<?php echo $v['s_name1'];?>" title="<?php echo $v['s_name'];?>"><img src="<?php echo $v['s_img'];?>" width="88" height="31" alt="<?php echo $v['s_name'];?>" /></a></li>
    <?php }?>
    </ul>
  <div class="cl"></div>
    </div>
<div class="footer-center">
    <p><a href="<?php echo cover_link(1,32);?>">关于我们</a>  -  <a href="<?php echo cover_link(1,59);?>">隐私声明</a>  -  <a href="<?php echo cover_link(1,60);?>">联系方式</a>  -  <a href="<?php echo cover_link(1,61);?>">广告投放</a>  -  <a href="<?php echo cover_link(1,62);?>">诚聘英才</a></p>
    <?php echo $webinfo['s_copyright'];?>
    </div>
</div>
<!--底部结束-->
<div class="topbottom">
    <p><a id="aBackTop" class="aBackTop" href="javascript:void(0);"></a></p>
</div>
<script src="/cn/js/index.js"></script> 
<script src="/cn/js/desSlideshow.js"></script>
</body>
</html>