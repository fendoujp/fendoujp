<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta name="works" content="<?php echo $webinfo['s_keywords'];?>">
<meta name="description" content="<?php echo $webinfo['s_description'];?>">
<title><?php echo $webinfo['s_name'];?></title>
<link type="text/css" href="/cn/css/base.css" rel="stylesheet">
<link type="text/css" href="/cn/css/index.css" rel="stylesheet">
<link type="text/css" href="/cn/css/common.css" rel="stylesheet">
<script type="text/javascript" src="/cn/js/sethome.js"></script>
<script type="text/javascript" src="/cn/js/jquery-1.11.0.min.js"></script> 
<script type="text/javascript" src="/cn/js/jquery-1.4.2.min.js"></script> 
<script type="text/javascript" src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js"></script>
<script type="text/javascript">
$(function(){
  $('body').bind('contextmenu', function() {return false;});
  $('body').bind("selectstart",function(){return false;});
});
</script>
</head>
<body>
<?php 
$menu = getLiAll("select * from lm_classify where class_depth=1 and is_top=1 order by s_order asc,id asc");
$qq = getLiAll("select * from o_ad where s_type='QQ' order by s_order asc,id asc");
$first_info = class_info($class_first);
?>
<!--头部开始-->
<div class="header" id="header">
  <div class="top-mini container clearfix">
    <p>您好！欢迎您进入奋斗在日本留学网！</p>
    <ul>
      <li><a href="#"><i class="phone common-icon"></i>手机版</a></li>
      <li><a href="javascript:;" onclick="SetHome(this,window.location)"><i class="index common-icon"></i>设为首页</a></li>
      <li><a href="javascript:;" onclick="shoucang(document.title,window.location)"><i class="collect common-icon"></i>加入收藏</a></li>
    </ul>
  </div>
  <div id="top" class="container">
    <div id="logo">
      <h1> <a href="/">奋斗在日本</a></h1>
    </div>
    <div id="search">
      <form method="get" action="/index.php">
      <input type="hidden" name="a" value="search" />
        <i class="common-icon"></i>
        <input name="search" type="text" value="奋斗在日本" maxlength="30" onblur="if(this.value==''){this.value='奋斗在日本';}" onfocus="if(this.value=='奋斗在日本'){this.value='';}" />
        <button class="common-icon" type="submit">搜索</button>
      </form>
    </div>
    <div id="menu">
      <ul class="clearfix">
        <li class="item-1"><a href="<?php echo cover_link(1,55);?>"><i></i>机票查询</a></li>
        <li class="item-2"><a href="http://qq.ip138.com/hl.asp" target="_blank"><i></i>汇率查询</a></li>
        <li class="item-3"><a href="http://fanyi.baidu.com/translate#zh/jp/" target="_blank"><i></i>在线翻译</a></li>
        <li class="item-4"><a href="<?php echo cover_link(1,56);?>"><i></i>日语考试</a></li>
        <li class="item-5"><a href="<?php echo cover_link(1,57);?>"><i></i>租房知识</a></li>
        <li class="item-6"><a href="<?php echo cover_link(1,58);?>"><i></i>手机申请</a></li>
      </ul>
    </div>
  </div>
  <!--导航开始-->
  <div class="container">
    <ul class="mainmenu">
      <li class="li1 <?php if($class_first==''){echo 'curr';}?>"><a class="a1" href="/">首页</a>
        <ul class="submenu">
          <li class="bor-none">您好！欢迎您进入奋斗在日本留学网！</li>
        </ul>
      </li>
      <?php foreach($menu as $v){?>
      <li class="li1 <?php if($v['id']==$class_first)echo'curr';?>"><a class="a1" href="<?php echo cover_link(1,$v['id']);?>" <?php if($v['s_target']==1)echo'target="_blank"';?>><?php echo $v['s_name'];?></a>
        <ul class="submenu">
        <?php 
        $submenu = subclass($v['id']);
        if(!empty($submenu)){
          foreach($submenu as $k2=>$v2){
          ?>
          <li><a href="<?php echo cover_link(1,$v2['id']);?>" <?php if($v['s_target']==1)echo'target="_blank"';?>><?php echo $v2['s_name'];?></a></li>
          <?php
          }
        }else{
        ?>
          <li class="bor-none">您好！欢迎您进入奋斗在日本留学网！</li>
        <?php }?>
        </ul>
      </li>
      <?php }?>
    </ul>
  </div>
  <div class="contact">
    <div class="cont">
    <?php foreach($qq as $v){?>
      <a class="top_qq" target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $v['s_name1'];?>&site=qq&menu=yes"><?php echo $v['s_name'];?></a>
    <?php }?>
    <iframe width="63" height="24" frameborder="0" allowtransparency="true" marginwidth="0" marginheight="0" scrolling="no" frameborder="No" border="0" src="http://widget.weibo.com/relationship/followbutton.php?width=63&amp;height=24&amp;uid=1568011864&amp;style=1&amp;btn=light&amp;dpc=1"></iframe>
    <!--<wb:follow-button uid="2991975565" type="red_2" width="104" height="24" ></wb:follow-button>-->
    </div>
    &nbsp;&nbsp;&nbsp;您好！欢迎您进入奋斗在日本留学网！
  </div>
  <!--导航结束-->
</div>
<script type="text/javascript">
$(".mainmenu .li1").mouseenter(function(){
  var obj = $(this);
  obj.find("ul").show();
  obj.siblings().find("ul").hide();
  obj.addClass("curr").siblings().removeClass("curr");
});
</script>
<!--头部结束-->