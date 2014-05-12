$(function() {
  var nav_li = $("#nav li");
  nav_li.mouseover(function() {
    $(this).addClass("current").next("div").show()
    .end().siblings().removeClass("current").next("div").hide();
  });
});

$(function() {
  var guide_li = $(".guide-left li");
  var guide_list = $(".guide-left div");
  guide_li.mouseover(function() {
    var index = $(this).index;
    $(this).addClass("on").siblings().removeClass("on");
  });
});

$(function() {
  $("#desSlideshow1").desSlideshow({
    autoplay: 'enable',//选项:enable,disable
    slideshow_width: '700',//幻灯片窗口宽度
    slideshow_height: '249',//幻灯片窗口的高度
    thumbnail_width: '100',//导航条宽度
    time_Interval: '4000',//以毫秒为单位
    directory: 'images/'// images目录下的flash-on.gif 和 flashtext-bg.jpg 图片
  });
});

	

/*第一种形式 第二种形式 更换显示样式*/
function setTab(name,cursel,n){
for(i=1;i<=n;i++){
var menu=document.getElementById(name+i);
var con=document.getElementById("con_"+name+"_"+i);
menu.className=i==cursel?"hover":"";
con.style.display=i==cursel?"block":"none";
}
}


/*底部shcool图片切换开始*/
$(document).ready(function(){
						   
	$("#slider").find(".pre").hide();//初始化为第一版
	var page=1;//初始化当前的版面为1
	var $show=$("#slider").find(".slider_box");//找到图片展示区域
	var page_count=$show.find("ul").length;
	var $width_box=$show.parents("#wai_box").width();//找到图片展示区域外围的div
  if(page_count<=1){$("#slider").find(".next").hide();}
	//显示title文字
	$show.find("li").hover(function(){
		$(this).find(".title").show();								
	},function(){
		$(this).find(".title").hide();
	})
	function nav(){
    if(page_count>1){
  		if(page==1){
  			$("#slider").find(".pre").hide().siblings(".next").show();
  		}else if(page==page_count){
  			$("#slider").find(".next").hide().siblings(".pre").show();
  		}else{
  			$("#slider").find(".pre").show().siblings(".next").show();
  		}
    }else{
      $("#slider").find(".pre").hide().siblings(".next").hide();
    }
	}
	$("#slider").find(".next").click(function(){
		//首先判断展示区域是否处于动画
		if(!$show.is(":animated")){
			$show.animate({left:'-='+$width_box},"normal");
			page++;
			nav();
			$number=page-1;
			$("#slider").find(".nav a:eq("+$number+")").addClass("now").siblings("a").removeClass("now");
			return false;
		}
	})
	$("#slider").find(".pre").click(function(){
		if(!$show.is(":animated")){
			$show.animate({left:'+='+$width_box},"normal");
			page--;
			nav();
			$number=page-1;
			$("#slider").find(".nav a:eq("+$number+")").addClass("now").siblings("a").removeClass("now");
		}
		return false;
	})
	$("#slider").find(".nav a").click(function(){
		$index=$(this).index();
		page=$index+1;
		nav();
		$show.animate({left:-($width_box*$index)},"normal");	
		$(this).addClass("now").siblings("a").removeClass("now");
		return false;
	})
	
	// 隐藏所有工具提示
	$(".slider_box li").each(function(){
		$(".slider_box li .title", this).css("opacity", "0");
	});
	
	$(".slider_box li").hover(function(){ // 悬浮 
		$(this).stop().fadeTo(500,1).siblings().stop().fadeTo(500,0.2);
		$(".slider_box li .title", this).stop().animate({opacity:1,bottom:"0px"},300);
	},function(){ // 寻出
		$(this).stop().fadeTo(500, 1).siblings().stop().fadeTo(500,1);	
		$(".slider_box li .title", this).stop().animate({opacity:0,bottom:"-30px"},300);
	});
						   
});
/*底部shcool图片切换结束*/

/*返回顶端开始*/
$(function () {
              var aBackTop = $("#aBackTop");
			  //
			  var aBackBottom=$("#aBackBottom");
            function showCaifu() {
                if (parseFloat($(window).scrollTop()) > 100) {
                    aBackTop.css("display", "block");
                }
                else {
                    aBackTop.css("display", "block");
                }
            };
            showCaifu();
            $(window).bind("scroll", showCaifu);
            aBackTop.bind("click", function () {
                $('html,body').animate({ scrollTop: 0 }, 600);
                return false;
            });
			});
/*返回顶端结束*/