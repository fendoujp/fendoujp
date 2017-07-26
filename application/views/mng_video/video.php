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
  				  <li><?php echo $submenu['position'] ?></li>
                </ul>
              </div>
              <div class="main">  
              	<?php echo $submenu['menu_html']?>              	
              	<hr>
              	<div class="pos-title">视频列表</div>
              	<div class="row-1">
              		<label>
              			共有视频：<?php echo $total;?>个
              			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              			当前分类：
	              		<select id="category_select">
	              			<option value="0">全部视频</option>
	              			<option value="-1" <?php if($category_id == -1) echo 'selected'?>>无分类</option>
	              			<?php foreach($video_category_list as $k=>$v){ ?>
	              				<option value="<?php echo $v['video_category_id']?>" 
	              					<?php if($category_id == $v['video_category_id']) echo 'selected'?>
	              				>
	              					<?php echo $v['video_category_title']?>
	              				</option>
	              			<?php }?>
	              		</select>
              		</label>
				  	<button id="create_video_modal_show_button" class="add-new btn btn-primary">添加+</button>
				</div>
				
				<table class="table table-1 table-hover">
				  <thead>
					<tr>
					  <th width="5%">ID</th>
					  <th width="15%">封面</th>
					  <th width="15%">视频名称</th>
					  <th width="15%">所属分类</th>
					  <th width="5%">视频内容</th>
					  <th width="5%">有效</th>
					  <th width="5%">排序</th>							 
					  <th width="10%">创建时间</th>
					  <th width="5%">创建人</th>	
					  <th width="20%">操作</th>
					</tr>
				  </thead>
				  <tbody>
				  	<?php foreach($video_list as $k=>$v){ ?>
				  		<tr>
					  	  <td id="<?php echo $k?>video_id" 
					  	  data-data="<?php echo $v['video_id']?>">
					  	  	<?php echo $v['video_id']?>
					  	  </td>
					  	  <td id="<?php echo $k?>video_img"
					  	  data-data="<?php echo $v['video_img']?>">
					  	  	<img style="width:148px;height:102px" src="<?php echo $v['video_img']?>" />
					  	  </td>		  	  
					  	  <td id="<?php echo $k?>video_title"
					  	   data-data="<?php echo htmlspecialchars($v['video_title'])?>">
					  	  	<?php echo $v['video_title']?>
					  	  </td>
					  	  <?php if($v['video_category_id'] > 0){ ?>
					  	  <td id="<?php echo $k?>video_category_id"
					  	   data-data="<?php echo $v['video_category_id']?>">
					  	  	<?php echo $v['video_category_title']?>
					  	  </td>
					  	  <?php }else{ ?>
					  	  <td id="<?php echo $k?>video_category_id"
					  	   data-data="-1">
					  	  	<span class="red-font">无分类</span>
					  	  </td>					  	  
					  	  <?php }?>
					  	 
					  	  <td>
					  	  	  <?php if($v['video_module'] && $v['video_module'] != '[]'){ ?>
					  	  	  <span class="blue-font">有内容</span>
					  	  	  <?php }else{?>
					  	  	  <span class="red-font">无内容</span>
					  	  	  <?php }?>
					  	  </td>
					  	  								  	  
					  	  <td>
					  	  	  <?php if($v['valid']==1){ ?>
					  	  	  <span class="blue-font">使用中</span>
					  	  	  <?php }else{?>
					  	  	  <span class="red-font">未使用</span>
					  	  	  <?php }?>
					  	  </td>
					  	  
					  	  <td id="<?php echo $k?>sort"
					  	   data-data="<?php echo $v['sort']?>">
					  	  	<?php echo $v['sort']?>
					  	  </td>
					  	  
					  	  <td><?php echo $v['ct']?></td>
					  	  <td><?php echo $v['cer']?></td>
					  	  <td>
					  	  	
					  	  	<button class="update_video_valid_button btn btn-primary btn-icon" 
					  	  	data-toggle="tooltip" title="有效/无效"  data-id="<?php echo $v['video_id']?>">
								<i class="fa fa-refresh" style="color:white"></i>								  	
							</button>
							<button class="update_video_modal_show_button btn btn-primary btn-icon" 
									data-toggle="tooltip" title="修改" data-index="<?php echo $k?>">
								<i class="fa fa-gear" style="color:white"></i>								  	
							</button>
							<button class="edit_video btn btn-primary btn-icon" 
					  	  	data-toggle="tooltip" title="编辑视频内容"  data-id="<?php echo $v['video_id']?>">
								<i class="fa fa-file" style="color:white"></i>								  	
							</button>
							<button class="delete_video_button btn btn-danger btn-icon" 
					  	  	data-toggle="tooltip" title="删除"  data-id="<?php echo $v['video_id']?>">					  	  
								<i class="fa fa-remove" style="color:white"></i>								  	
							</button>
							
					  	  </td>
					  	</tr>
				  	<?php }?>				  	
				  </tbody>
				 </table>
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
      
<!-- modal -->
<div class="modal fade" id="create_video_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="margin-top: 40px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">添加自由视频</h4>
      </div>      
      <div class="form-horizontal">
        <div class="modal-body">
          <div class="info-edit">
            <div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">排序：</label>
                <div class="col-sm-7">
                   <input type="text" id="create_sort" 
                        class="form-control form-control-sm" 
                        placeholder="请输入0-256的排序值，值越大排位越靠前(默认0)"/>
                </div>
            </div>
            <div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">视频分类：</label>
                <div class="col-sm-7">
                   <select id="create_video_category_id">
              			<option value="-1" selected>无分类</option>
              			<?php foreach($video_category_list as $k=>$v){ ?>
              				<option value="<?php echo $v['video_category_id']?>">
              					<?php echo $v['video_category_title']?>
              				</option>
              			<?php }?>
              		</select>
              		注:无分类的视频将无法正常显示在列表页
                </div>
            </div>   	
          	<div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">视频名称：</label>
                <div class="col-sm-7">
                   <input type="text" id="create_video_title" 
                        class="form-control form-control-sm" 
                        placeholder="请填写内容"/>
                </div>
            </div>
        	
            <div class="form-group form-group-sm">
            	<label class="col-sm-2 control-label">上传图片：</label>
            	<!-- 图片上传 -->
            	<div class="col-sm-7">
	            	<div data-type="upload" data-upload-type="video_img" 
	            	data-img="#create_video_img" class="a-i-input upload" 
	            	style="width:300px;">
	                	<input type="text" class="form-control form-control-sm" 
	                	style="padding-left:30px;" placeholder="点击选择文件（jpg,jpeg,png,gif 2M以内）" />
						<input type="file" />
						<div class="upload-icon">
	                        <i class="fa fa-upload"></i>
	                    </div>           
	                </div>      
                </div>
            </div>
            <div class="form-group form-group-sm">
            	<label class="col-sm-2 control-label">图片预览：<br>370*255</label>
            	<div class="col-sm-7">
            		<img id="create_video_img" 
            		src="<?php echo $default_video_img?>" 
            		style="width:370px;height:255px;border:1px solid #ccc;"  
            		/>
            	</div>
            </div>
          </div>            
        </div>
      </div>
      <!-- !modal-body -->
      <div class="modal-footer">
        <button type="submit" id="create_video_submit" class="btn btn-primary btn-standard" >确 定</button>
        <button type="button" data-action="close" class="btn btn-default btn-standard" data-dismiss="modal">关 闭</button>          
      </div>
    </div>      
  </div>
</div>
<!-- !modal --> 
<!-- modal -->
<div class="modal fade" id="update_video_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="margin-top: 40px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">更新经验分享</h4>
      </div>      
      <div class="form-horizontal">
        <div class="modal-body">
          <div class="info-edit">
            <!-- ID -->
            <input type="hidden" id="update_video_id" />
            <!-- 原图 -->
            <input type="hidden" id="update_video_img_old" />
                	
          	<div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">排序：</label>
                <div class="col-sm-7">
                   <input type="text" id="update_sort" 
                        class="form-control form-control-sm" 
                        placeholder="请输入0-256的排序值，值越大排位越靠前(默认0)"/>
                </div>
            </div>
            <div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">视频分类：</label>
                <div class="col-sm-7">
                   <select id="update_video_category_id">
              			<option value="-1" selected>无分类</option>
              			<?php foreach($video_category_list as $k=>$v){ ?>
              				<option value="<?php echo $v['video_category_id']?>">
              					<?php echo $v['video_category_title']?>
              				</option>
              			<?php }?>
              		</select>
              		注:无分类的视频将无法正常显示在列表页
                </div>
            </div>   	
          	<div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">视频名称：</label>
                <div class="col-sm-7">
                   <input type="text" id="update_video_title" 
                        class="form-control form-control-sm" 
                        placeholder="请填写内容"/>
                </div>
            </div>            
            <div class="form-group form-group-sm">
            	<label class="col-sm-2 control-label">上传图片：</label>
            	<!-- 图片上传 -->
            	<div class="col-sm-7">
	            	<div data-type="upload" data-upload-type="video_img" 
	            	data-img="#update_video_img" class="a-i-input upload" 
	            	style="width:300px;">
	                	<input type="text" class="form-control form-control-sm" 
	                	style="padding-left:30px;" placeholder="点击选择文件（jpg,jpeg,png,gif 2M以内）" />
						<input type="file" />
						<div class="upload-icon">
	                        <i class="fa fa-upload"></i>
	                    </div>           
	                </div>      
                </div>
            </div>
            <div class="form-group form-group-sm">
            	<label class="col-sm-2 control-label">图片预览：<br>370*255</label>
            	<div class="col-sm-7">
            		<img id="update_video_img" 
            		src="" 
            		style="width:185px;height:122.5px;border:1px solid #ccc;"  
            		/>
            	</div>
            </div>
          </div>            
        </div>
      </div>
      <!-- !modal-body -->
      <div class="modal-footer">
        <button type="submit" id="update_video_submit" class="btn btn-primary btn-standard" >确 定</button>
        <button type="button" data-action="close" class="btn btn-default btn-standard" data-dismiss="modal">关 闭</button>          
      </div>
    </div>      
  </div>
</div>
<!-- !modal --> 
  
  
  </body>
<script>
ready(function(){
	
	$('#create_video_modal_show_button').click(function(){
		//点击打开创建modal
		$("#create_video_modal").modal('show');
		//创建新的经验分享模块
		//window.location = base_url + "mng_video/edit_video";
	});
	
	//提交创建
	$('#create_video_submit').click(function(){
		var create_data = {};
		create_data.video_title = $("#create_video_title").val();
		create_data.video_category_id = $("#create_video_category_id").val();
		create_data.sort = $("#create_sort").val();
		create_data.video_img = $("#create_video_img").attr('src');
		create_data.op = '<?php echo CREATE?>';
		//ajax提交
		$.ajax({
	      type : 'post',
	        url : base_url + 'mng_video/save_video',
	        data : create_data,
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
	
	//打开更新的框框
	$('.update_video_modal_show_button').each(function(){
		
		$(this).click(function(){
			
			//获取数据
			var this_index = $(this).attr('data-index');
			var video_id = $('#'+this_index+'video_id').attr('data-data');
			var video_title = $('#'+this_index+'video_title').attr('data-data');
			var video_img = $('#'+this_index+'video_img').attr('data-data');			
			var sort = $('#'+this_index+'sort').attr('data-data');
			//分类
			var video_category_id = $("#"+this_index+'video_category_id').attr('data-data');
			//控制分类框
			$("#update_video_category_id").val(video_category_id);
						
			//更新弹出框内容并且 打开弹出框
			$("#update_video_id").val(video_id);			
			$("#update_video_title").val(video_title);
			$("#update_sort").val(sort);
			$("#update_video_img").src(video_img);
			$("#update_video_img_old").val(video_img);
			$("#update_video_modal").modal('show');
		});
	});
	//点击去编辑文件内容
	$('.edit_video').each(function(){
		//直接打开新页面编辑
		$(this).click(function(){			
			var video_id = $(this).attr('data-id');
			window.location = base_url + "mng_video/edit_video/" + video_id;
		});
	});
	
	//提交更新数据
	$('#update_video_submit').click(function(){
		var update_data = {};
		update_data.video_title = $("#update_video_title").val();
		update_data.video_category_id = $("#update_video_category_id").val();
		update_data.sort = $("#update_sort").val();
		update_data.video_id = $("#update_video_id").val();
		update_data.op = '<?php echo UPDATE?>';
		update_data.video_img = $("#update_video_img").attr('src');
		//如果新图片和旧图片一样   就是不修改图片
		if(update_data.video_img == $("#update_video_img_old").val()){
			update_data.video_img_change = 0;
		}else{
			update_data.video_img_change = 1;
		}
		//ajax提交
		$.ajax({
	      type : 'post',
	        url : base_url + 'mng_video/save_video',
	        data : update_data,
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
	
	//更改有效性的按钮	
	$('.update_video_valid_button').each(function(){
		$(this).click(function(){
			//获取ID
			var video_id = $(this).attr('data-id');
			//ajax提交
			$.ajax({
		      type : 'post',
		        url : base_url + 'mng_video/video_valid',
		        data : {'video_id':video_id},
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
	//删除
	$('.delete_video_button').each(function(){
		$(this).click(function(){
			if(confirm('确定要删除吗?删除后不能恢复') == false){
				return;
			}
			//获取ID
			var video_id = $(this).attr('data-id');
			//ajax提交
			$.ajax({
		      type : 'post',
		        url : base_url + 'mng_video/delete_video',
		        data : {'video_id':video_id},
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

	$("#category_select").change(function(){
		window.location = base_url + 'mng_video/video/' + $(this).val();
	});
	
})

</script>
</html>