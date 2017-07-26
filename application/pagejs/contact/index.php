<script type="text/javascript">
$(document).ready(function(){ 
	//点击提交留言
	$("#submit").click(function(){
		//检查保存标志
		var ar = $('#ar').val();
		if(ar == 1) return; //如果有AJAX正在执行 退出

		$('#ar').val(1);//修改标志位
		$(this).val('提 交 中  ...');//修改标志位
		
		var data = {};
		data.name = $("#name").val();
		data.email = $("#email").val();
		data.contact_type = $("#contact_type").val();
		data.contact_info = $("#contact_info").val();
		data.topic = $("#topic").val();
		data.message = $("#message").val();
		data.token = '<?php echo $token?>';
		//式样初始化		
		$.each(data,function(k,v){
			$("#"+k).attr('style','');
		});		
		//ajax保存
		$.ajax({
	      type : 'post',
	        url : '<?php echo func::loc_url()?>' + 'contact/save',
	        data : data,
	        success : function(response){
	        	$("#ar").val(0);//标志位复原
	        	console.log('a');
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