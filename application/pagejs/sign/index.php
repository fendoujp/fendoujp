<script type="text/javascript">
$(document).ready(function(){ 
	//是否来过日本 选择框
	$("#ever_come_japan").change(function(){
		var v = $(this).val();
		if(v == 1){
			$("#come_japan_intro_div").fadeIn();
		}else{
			$("#come_japan_intro_div").fadeOut();
		}
	});
	//是否学过日语 选择框
	$("#ever_learn_japanese").change(function(){
		var v = $(this).val();
		if(v == 1){
			$("#learn_japanese_div").fadeIn();
		}else{
			$("#learn_japanese_div").fadeOut();
		}
	});
	//是否参加过日语考试
	$("#ever_test_japanese").change(function(){
		var v = $(this).val();
		if(v == 1){
			$(".test-japanese-div").fadeIn();
		}else{
			$(".test-japanese-div").fadeOut();
		}
	});
	//考试名称更换
	$("#test_japanese_name").change(function(){
		var options = '<option value="0">请选择考试级别</option>'
		var v = $(this).val();
		if(v == 1){
			<?php $options = consts::get_const_test_japanese_level(1)?>
			options += '<?php foreach($options as $k=>$v){
								echo '<option value="'.$v['value'].'">'.$v['text'].'</option>'; 
						}?>';
		}else if(v == 2){
			<?php $options = consts::get_const_test_japanese_level(2)?>
			options += '<?php foreach($options as $k=>$v){
								echo '<option value="'.$v['value'].'">'.$v['text'].'</option>'; 
						}?>';
		}else if(v == 3){
			<?php $options = consts::get_const_test_japanese_level(3)?>
			options += '<?php foreach($options as $k=>$v){
								echo '<option value="'.$v['value'].'">'.$v['text'].'</option>'; 
						}?>';
		}
		$("#test_japanese_level").html(options);		
	});
	
	//点击提交报名
	$("#submit").click(function(){
		//检查保存标志
		var ar = $('#ar').val();
		if(ar == 1) return; //如果有AJAX正在执行 退出

		$('#ar').val(1);//修改标志位
		$(this).val('提 交 中  ...');//修改标志位
		
		var data = {};
		data.name = $("#name").val();
		data.passport = $("#passport").val();
		data.gender = $("#gender").val();
		data.apply_status = $("#apply_status").val();
		data.birth_year = $("#birth_year").val();
		data.birth_month = $("#birth_month").val();
		data.birth_day = $("#birth_day").val();
		data.birth_province = $("#birth_province").val();
		data.birth_city = $("#birth_city").val();
		data.hukou_province = $("#hukou_province").val();
		data.hukou_city = $("#hukou_city").val();
		data.address = $("#address").val();
		data.dad_name = $("#dad_name").val();
		data.dad_age = $("#dad_age").val();
		data.mom_name = $("#mom_name").val();
		data.mom_age = $("#mom_age").val();
		data.payer_name = $("#payer_name").val();
		data.payer_relation = $("#payer_relation").val();
		data.payer_work = $("#payer_work").val();
		data.payer_income = $("#payer_income").val();
		data.mobile = $("#mobile").val();
		data.telphone = $("#telphone").val();
		data.wechat = $("#wechat").val();
		data.qq = $("#qq").val();
		data.email = $("#email").val();
		data.ever_come_japan = $("#ever_come_japan").val();
		data.come_japan_intro = $("#come_japan_intro").val();
		data.ever_learn_japanese = $("#ever_learn_japanese").val();
		data.learn_japanese_intro = $("#learn_japanese_intro").val();
		data.ever_test_japanese = $("#ever_test_japanese").val();
		data.test_japanese_year = $("#test_japanese_year").val();
		data.test_japanese_month = $("#test_japanese_month").val();
		data.test_japanese_name = $("#test_japanese_name").val();
		data.test_japanese_level = $("#test_japanese_level").val();
		data.test_japanese_point = $("#test_japanese_point").val();
		data.highschool_name = $("#highschool_name").val();
		data.highschool_type = $("#highschool_type").val();
		data.highschool_point = $("#highschool_point").val();
		data.highschool_year = $("#highschool_year").val();
		data.highschool_month = $("#highschool_month").val();
		data.collage_name = $("#collage_name").val();
		data.collage_class = $("#collage_class").val();
		data.collage_type = $("#collage_type").val();
		data.collage_license = $("#collage_license").val();
		data.collage_year = $("#collage_year").val();
		data.collage_month = $("#collage_month").val();
		data.apply_school = $("#apply_school").val();
		data.apply_year = $("#apply_year").val();
		data.apply_month = $("#apply_month").val();
		data.token = '<?php echo $token?>';
		//式样初始化		
		$.each(data,function(k,v){
			$("#"+k).attr('style','');
		});	
		console.log(data);
		//ajax保存
		$.ajax({
	      type : 'post',
	        url : '<?php echo func::loc_url()?>' + 'sign/save',
	        data : data,
	        success : function(response){
	        	$("#ar").val(0);//标志位复原
	      		if(response == 'success'){
					window.location="<?php echo func::loc_url()?>success";
	      		}else if(response == 'fail'){
	      			$("#submit").val('提交失败,服务器发生错误');
	      		}else{
	      			$("#submit").val('重 新 提 交');
		      		//解析返回的json错误
					var error = jQuery.parseJSON(response);
					$.each(error,function(k,v){
						//如果是一般错误直接显示
						if(k != 'token'){
							$("#"+k).attr('style','border:1px solid #FFCCCC');
						}else{
							//如果是Token错误 提示网页过期并且重新刷新网页
							$("#submit").val('网页已过期,请刷新重试');
							$("#ar").val(1);//标志位设定 拒绝后续的请求
						}
					})
	      		}
	        },
	        error : function(){
	        	$("#submit").val('提交失败,服务器发生错误');
	        }
	    });
	});	
});
</script>