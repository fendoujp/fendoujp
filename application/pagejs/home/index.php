<script type="text/javascript">
$(document).ready(function(){
	$('.pre_load_img').each(function(){
		var url = $(this).val();
		var img = new Image();
		img.src = url;
	});
	$('.school_category_img').mouseover(function(){
		$(this).stop(true, true).animate({opacity:0},1,function(){
			$(this).attr('src',$(this).attr('data-cover-img')).stop(true, true).animate({opacity:1},1);
		});
	}).mouseout(function(){
		$(this).stop(true, true).animate({opacity:0},1,function(){
			$(this).attr('src',$(this).attr('data-img')).stop(true, true).animate({opacity:1},1);
		});
	});
});
</script>