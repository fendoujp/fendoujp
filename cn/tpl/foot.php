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
<script>
$( window ).resize(function() {
  wwdresize();
});
$(function(){
  wwdresize();
});
function wwdresize(){
  if($("body").width()>1100){
    $( ".wwd" ).css({"left": $("body").width()-$( ".wwd" ).width()+"px","top": "220px","width":"82px","height":"302px","position": "fixed"});
  }else{// if($("body").width()<1100){
    var wwdleft = 240+ ($("body").width()-980)/2;
    if(wwdleft<240){wwdleft=240;}
    $( ".wwd" ).css({"left": wwdleft+ "px","top": "40px","width":"270px","height":"102px","position": "absolute"});
  }
}
</script>
<div class="wwd" style="background:#FFF;width:82px;height:302px;border:1px solid #DDD;display: block;_position: absolute;">
    <div style="float:left;display:inline;width:80px;margin:5px 0 0 5px">
    <h3 style="text-align:center;">官方微信</h3>
    <p><img src="http://new.fendoujp.com/cn/images/weixin.jpg" style="width:80px;height:80px" /></p>
    </div>
    <div style="float:left;display:inline;width:80px;margin:5px">
    <h3 style="text-align:center;">新浪微博</h3>
    <p><a href="http://widget.weibo.com/dialog/follow.php?fuid=1568011864&refer=new.fendoujp.com&language=zh_cn&type=widget_page&vsrc=app_followbutton&backurl=http%3A%2F%2Fnew.fendoujp.com%2F&rnd=1410582019786" target="_blank">
    <img src="http://new.fendoujp.com/cn/images/sina.png" style="width:80px;height:80px" /></a>
    </p>
    </div>
    
    <div style="float:left;display:inline;width:80px;margin:5px">
    <h3 style="text-align:center;">官方豆瓣</h3>
    <p><a href="http://www.douban.com/group/406871/" target="_blank">
    <img src="http://img3.douban.com/pics/group/app_qr1.png" style="width:80px;height:80px" /></a>
    </p>
    </div>
</div>
<script src="/cn/js/index.js"></script> 
<script src="/cn/js/desSlideshow.js"></script>

<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F396c562776f414444aec2720f9a2f21d' type='text/javascript'%3E%3C/script%3E"));
</script>


<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fa1ec215a9bbdba8041ff74b82d27231d' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F2905d3a05e29317306cd014d7baedbda' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>
