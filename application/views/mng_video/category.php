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
                  <li><?php echo $submenu['position']?></li>
                </ul>
              </div>
              <div class="main">
              	<?php echo $submenu['menu_html']?>
              	<hr>
              	<div class="pos-title">视频分类列表</div>
              	<div class="row-1">					              					
              		<label>共有视频分类：<?php echo @$total;?>个</label>	
              		<label style="margin-left:20px;">开启状态：<?php echo @$total_valid;?>个</label>
              		<label style="margin-left:20px;">关闭状态：<?php echo $total-$total_valid;?>个</label>			  						  
				  	<button id="create_video_category_modal_show_button" class="add-new btn btn-primary">添加+</button>
				</div>
				
				<table class="table table-1 table-hover">
				  <thead>
					<tr> 					
					  <th width="10%">ID</th>
					  <th width="25%">分类名称</th>
					  <th width="5%" >排序</th>	
					  <th width="5%" >有效</th>							 
					  <th width="20%">创建时间</th>
					  <th width="10%">创建人</th>	
					  <th width="25%">操作</th>
					</tr>
				  </thead>
				  <tbody>
				  	<?php foreach($video_category_list as $k=>$v){ ?>
				  		<tr>
					  	  <td id="<?php echo $k?>video_category_id" 
					  	  data-data="<?php echo $v['video_category_id']?>">
					  	  	<?php echo $v['video_category_id']?>
					  	  </td>					  	  
					  	  <td id="<?php echo $k?>video_category_title"
					  	   data-data="<?php echo htmlspecialchars($v['video_category_title'])?>">
					  	  	<?php echo $v['video_category_title']?>
					  	  </td>
					  	  <td id="<?php echo $k?>sort"
					  	   data-data="<?php echo $v['sort']?>">
					  	  	<?php echo $v['sort']?>
					  	  </td>
					  	  <td>
					  	  	  <?php if($v['valid']==1){ ?>
					  	  	  <span class="blue-font">使用中</span>
					  	  	  <?php }else{?>
					  	  	  <span class="red-font">未使用</span>
					  	  	  <?php }?>
					  	  </td>
					  	  <td><?php echo $v['ct']?></td>
					  	  <td><?php echo $v['cer']?></td>
					  	  <td>
					  	  	<button class="update_video_category_valid_button btn btn-primary btn-icon" 
					  	  	data-toggle="tooltip" title="有效/无效"  data-id="<?php echo $v['video_category_id']?>">
								<i class="fa fa-refresh" style="color:white"></i>								  	
							</button>
							<button class="update_video_category_modal_show_button btn btn-primary btn-icon" 
									data-toggle="tooltip" title="修改" data-index="<?php echo $k?>">
								<i class="fa fa-gear" style="color:white"></i>								  	
							</button>
							<button class="go_video_list_button btn btn-primary btn-icon" 
								data-toggle="tooltip" title="查看视频列表" data-id="<?php echo $v['video_category_id'] ?>">
								<i class="fa fa-file" style="color:white"></i>								  	
							</button>
							<button class="delete_video_category_button btn btn-danger btn-icon" 
					  	  	data-toggle="tooltip" title="删除"  data-id="<?php echo $v['video_category_id']?>">					  	  
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
<div class="modal fade" id="create_video_category_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="margin-top: 40px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">添加学校分类</h4>
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
              <label class="col-sm-2 control-label">标题：</label>
                <div class="col-sm-7">
                   <input type="text" id="create_video_category_title" 
                        class="form-control form-control-sm" 
                        placeholder="请输入标题"/>
                </div>
            </div>    	
          	
          </div>            
        </div>
      </div>
      <!-- !modal-body -->
      <div class="modal-footer">
        <button type="submit" id="create_video_category_submit" class="btn btn-primary btn-standard" >确 定</button>
        <button type="button" data-action="close" class="btn btn-default btn-standard" data-dismiss="modal">关 闭</button>          
      </div>
    </div>      
  </div>
</div>
<!-- !modal --> 
<!-- modal -->
<div class="modal fade" id="update_video_category_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="margin-top: 40px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">更新学校分类</h4>
      </div>      
      <div class="form-horizontal">
        <div class="modal-body">
          <div class="info-edit">
            <div class="form-group form-group-sm" style="color:red">
             	请注意文字内容编辑方法： 手动换行请使用  (hh)，特殊字体请用 (ts+)内容(ts-)的格式来写
            </div>
            <div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">排序：</label>
                <div class="col-sm-7">
                   <input type="text" id="update_sort" 
                        class="form-control form-control-sm" 
                        placeholder="请输入0-256的排序值，值越大排位越靠前(默认0)"/>
                   <!-- Id -->
                   <input type="hidden" id="update_video_category_id" />                  
                </div>
            </div>          	
          	<div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">主要标题：</label>
                <div class="col-sm-7">
                   <input class="form-control" 
                   id="update_video_category_title" placeholder="请填写标题内容" />
                </div>
            </div>
          </div>            
        </div>
      </div>
      <!-- !modal-body -->
      <div class="modal-footer">
        <button type="submit" id="update_video_category_submit" class="btn btn-primary btn-standard" >确 定</button>
        <button type="button" data-action="close" class="btn btn-default btn-standard" data-dismiss="modal">关 闭</button>          
      </div>
    </div>      
  </div>
</div>
<!-- !modal --> 
  
  
  </body>
<script>
ready(function(){
	//点击打开创建广告modal
	$('#create_video_category_modal_show_button').click(function(){
		$("#create_video_category_modal").modal('show');
	});
	//提交创建top banner
	$('#create_video_category_submit').click(function(){
		var create_data = {};
		create_data.video_category_title = $("#create_video_category_title").val();
		create_data.sort = $("#create_sort").val();
		create_data.op = '<?php echo CREATE?>';
		//ajax提交
		$.ajax({
	      type : 'post',
	        url : base_url + 'mng_video/save_video_category',
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

	//点击去视频列表
	$('.go_video_list_button').each(function(){
		var id = $(this).attr('data-id');
		$(this).click(function(){
			window.location = base_url + 'mng_video/video/'+id;
		});
	});
	
	//打开更新TOP BANNER的框框
	$('.update_video_category_modal_show_button').each(function(){
		$(this).click(function(){
			//获取数据
			var this_index = $(this).attr('data-index');
			var video_category_id = $('#'+this_index+'video_category_id').attr('data-data');
			var video_category_title = $('#'+this_index+'video_category_title').attr('data-data');
			var sort = $('#'+this_index+'sort').attr('data-data');
			//更新弹出框内容并且 打开弹出框
			$("#update_video_category_id").val(video_category_id);
			$("#update_video_category_title").val(video_category_title);
			$("#update_sort").val(sort);
			$("#update_video_category_modal").modal('show');
		});
	});
	//提交更新数据
	$('#update_video_category_submit').click(function(){
		var update_data = {};
		update_data.video_category_title = $("#update_video_category_title").val();	
		update_data.sort = $("#update_sort").val();		
		update_data.video_category_id = $("#update_video_category_id").val();
		update_data.op = '<?php echo UPDATE?>';
		//ajax提交
		$.ajax({
	      type : 'post',
	        url : base_url + 'mng_video/save_video_category',
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
	//更改TOP banner有效性的按钮	
	$('.update_video_category_valid_button').each(function(){
		$(this).click(function(){
			//获取ID
			var video_category_id = $(this).attr('data-id');
			//ajax提交
			$.ajax({
		      type : 'post',
		        url : base_url + 'mng_video/video_category_valid',
		        data : {'video_category_id':video_category_id},
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
	//删除TOPbanner
	$('.delete_video_category_button').each(function(){
		$(this).click(function(){
			if(confirm('确定要删除吗?删除后不能恢复,并且该分类下的所有内容会被自动移动到"无分类"') == false){
				return;
			}
			//获取ID
			var video_category_id = $(this).attr('data-id');
			//ajax提交
			$.ajax({
		      type : 'post',
		        url : base_url + 'mng_video/delete_video_category',
		        data : {'video_category_id':video_category_id},
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
	
})

</script>
</html>