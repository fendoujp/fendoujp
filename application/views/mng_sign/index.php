<!DOCTYPE html>
<html lang="zh-cn">
  <?php include VIEWPATH.'mng_common/mng-head.php'; ?>
  <body>
      <div class="wrapper">
        <?php include VIEWPATH.'mng_common/mng-header.php'; ?>
        <!-- !header -->
        <div class="container">
          <div class="content box">
            <?php include VIEWPATH.'mng_common/mng-nav.php'; ?>            
            <div class="layer flex-1">
              <div class="location">
                <ul>
                  <li>位置</li>
                  <li>></li>
                  <li>在线留言</li>
                </ul>
              </div>
              <div class="main">
       			
              	<div class="pos-title">报名列表</div>
              	<div class="row-1">
              		<label>
              			共有留言：<?php echo $total;?>条
              			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              			当前状态：
	              		<select id="status_select">
	              		<?php  //状态 1=未对应  2=对应中 3=成功 4=失败 5=被删除 ?>
	              			<option value="0" >全部报名</option>
	              			<option value="1" <?php if($get['status'] == 1) echo 'selected'?>>未对应</option>
	              			<option value="2" <?php if($get['status'] == 2) echo 'selected'?>>对应中</option>              			
	              			<option value="3" <?php if($get['status'] == 3) echo 'selected'?>>成功</option>              			
	              			<option value="4" <?php if($get['status'] == 4) echo 'selected'?>>失败</option>              			
	              			<option value="5" <?php if($get['status'] == 5) echo 'selected'?>>被删除</option>              			
	              		</select>
              		</label>				  	
				</div>
				
				<table class="table table-1 table-hover">
				  <thead>
					<tr>
					  <th width="10%">ip地址</th>
					  <th width="7.5%">报名时间</th>
					  <th width="10%">姓名</th>
					  <th width="10%">手机</th>
					  <th width="10%">固话</th>
					  <th width="10%">微信</th>
					  <th width="10%">QQ</th>
					  <th width="5%">状态</th>
					  <th width="7.5%">最后更新</th>
					  <th width="10%">最后更新人</th>
					  <th width="10%">操作</th>
					</tr>
				  </thead>
				  <tbody>
				  	<?php foreach($sign_list as $k=>$v){ ?>
				  		<tr>
				  		  <td>
					  	  	<?php echo $v['ip']?>
					  	  </td>
					  	  <td>
					  	  	<?php echo $v['ct']?>
					  	  </td>
					  	  <td>
					  	  	<?php echo $v['name']?>
					  	  </td>
					  	  <td>
					  	  	<?php echo $v['mobile']?>
					  	  </td>
					  	  <td>
					  	  	<?php echo $v['telphone']?>
					  	  </td>
					  	  <td>
					  	  	<?php echo $v['wechat']?>
					  	  </td>
					  	  <td>
					  	  	<?php echo $v['qq']?>
					  	  </td>
					  	  <td style="font-size:20px;font-weight:600;">
					  	  	<?php if($v['status'] == 1) echo '<span style="color:orange">未对应<span>';
								  elseif($v['status'] == 2) echo '<span style="color:blue">对应中<span>';
								  elseif($v['status'] == 3) echo '<span style="color:green">成功</span>';
								  elseif($v['status'] == 4) echo '<span style="color:purple">失败</span>';
								  elseif($v['status'] == 5) echo '<span style="color:red">删除</span>';
							?>
					  	  </td>
					  	  <td>
					  	  	<?php echo $v['ut']?>
					  	  </td>
					  	  <td>
					  	  	<?php echo $v['uer_username']?>
					  	  </td>
					  	  <td>
					  	  	<button class="detail_button btn btn-primary btn-icon" 
					  	  	data-toggle="tooltip" title="查看详情" 
					  	  	data-id="<?php echo $v['sign_id']?>" >
								<i class="fa fa-file" style="color:white"></i>								  	
							</button>
							<?php if($v['status'] == 1){ ?>
								<button class="operate_button btn btn-primary btn-icon" 
						  	  	data-toggle="tooltip" title="开始对应"  data-id="<?php echo $v['sign_id']?>">					  	  
									<i class="fa fa-flag" style="color:white"></i>
								</button>
								<button class="delete_button btn btn-danger btn-icon" 
						  	  	data-toggle="tooltip" title="删除"  data-id="<?php echo $v['sign_id']?>">					  	  
									<i class="fa fa-remove" style="color:white"></i>
								</button>
							<?php }else if($v['status'] == 2){?>
								<button class="success_button btn btn-primary btn-icon" 
						  	  	data-toggle="tooltip" title="对应成功"  data-id="<?php echo $v['sign_id']?>">					  	  
									<i class="fa fa-check" style="color:white"></i>
								</button>
								<button class="fail_button btn btn-danger btn-icon" 
						  	  	data-toggle="tooltip" title="对应失败"  data-id="<?php echo $v['sign_id']?>">					  	  
									<i class="fa fa-remove" style="color:white"></i>
								</button>
							<?php }else if($v['status'] == 3 || $v['status'] == 4){?>
								<button class="reverse_button btn btn-danger btn-icon" 
						  	  	data-toggle="tooltip" title="恢复到对应中"  data-id="<?php echo $v['sign_id']?>">					  	  
									<i class="fa fa-refresh" style="color:white"></i>
								</button>
							<?php }?>
					  	  </td>
					  	</tr>
				  	<?php }?>				  	
				  </tbody>
				 </table>
				 <?php include VIEWPATH.'mng_common/mng-page.php'; ?>
              </div>
              <!-- !main -->
            </div>
            <!-- !layer -->
          </div>
          <!-- !content -->
        </div>
        <!-- !container -->
        <?php include VIEWPATH.'mng_common/mng-footer.php'; ?>
      </div>
      

  </body>
<script>
ready(function(){	
	//详情
	$('.detail_button').click(function(){
		//获取ID
		var sign_id = $(this).attr('data-id');
		window.location = base_url + 'mng_sign/detail/' + sign_id;
	});
	//恢复到对应中
	$('.reverse_button').click(function(){
		if(confirm('确定要恢复到 对应中的状态吗?') == false){
			return;
		}
		//获取ID
		var sign_id = $(this).attr('data-id');
		//ajax提交
		$.ajax({
	      type : 'post',
	        url : base_url + 'mng_sign/reverse',
	        data : {'sign_id':sign_id},
	        success : function(response) {
		    //错误处理
	          if(!errorMsg(response)) {
	            if(response == '1'){
					alert('保存成功');
					refresh();//刷新网页
	            }else{
					alert('保存失败');
	            }
	          }
	        }
	    });
	});
	
	//开始对应
	$('.operate_button').click(function(){
		if(confirm('确定要开始对应吗?更新后不能恢复') == false){
			return;
		}
		//获取ID
		var sign_id = $(this).attr('data-id');
		//ajax提交
		$.ajax({
	      type : 'post',
	        url : base_url + 'mng_sign/operate_sign',
	        data : {'sign_id':sign_id},
	        success : function(response) {
		    //错误处理
	          if(!errorMsg(response)) {
	            if(response == '1'){
					alert('保存成功');
					refresh();//刷新网页
	            }else{
					alert('保存失败');
	            }
	          }
	        }
	    });
	});
	//成功
	$('.success_button').click(function(){
		if(confirm('确定要改为“成功”?更新后不能恢复') == false){
			return;
		}
		//获取ID
		var sign_id = $(this).attr('data-id');
		//ajax提交
		$.ajax({
	      type : 'post',
	        url : base_url + 'mng_sign/success_sign',
	        data : {'sign_id':sign_id},
	        success : function(response) {
		    //错误处理
	          if(!errorMsg(response)) {
	            if(response == '1'){
					alert('保存成功');
					refresh();//刷新网页
	            }else{
					alert('保存失败');
	            }
	          }
	        }
	    });
	});
	//失败
	$('.fail_button').click(function(){
		if(confirm('确定要改为“失败”?更新后不能恢复') == false){
			return;
		}
		//获取ID
		var sign_id = $(this).attr('data-id');
		//ajax提交
		$.ajax({
	      type : 'post',
	        url : base_url + 'mng_sign/fail_sign',
	        data : {'sign_id':sign_id},
	        success : function(response) {
		    //错误处理
	          if(!errorMsg(response)) {
	            if(response == '1'){
					alert('保存成功');
					refresh();//刷新网页
	            }else{
					alert('保存失败');
	            }
	          }
	        }
	    });
	});
	//删除
	$('.delete_button').each(function(){
		$(this).click(function(){
			if(confirm('确定要删除吗?删除后不能恢复') == false){
				return;
			}
			//获取ID
			var sign_id = $(this).attr('data-id');
			//ajax提交
			$.ajax({
		      type : 'post',
		        url : base_url + 'mng_sign/delete_sign',
		        data : {'sign_id':sign_id},
		        success : function(response) {
			    //错误处理
		          if(!errorMsg(response)) {
		            if(response == '1'){
						alert('保存成功');
						refresh();//刷新网页
		            }else{
						alert('保存失败');
		            }
		          }
		        }
		    });
		});
	});
	
	$("#status_select").change(function(){
		window.location = base_url + 'mng_sign/index/' + $(this).val();
	});	
})

function page(page){
	window.location = base_url + 'mng_sign/index/'+'<?php echo $get['status']?>'+'/'+ page;
}

</script>
</html>