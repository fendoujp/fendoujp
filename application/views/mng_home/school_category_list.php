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
                  <li>首页</li>
                  <li>></li>
                  <li><?php echo $submenu['position']?></li>
                </ul>
              </div>
              <div class="main">
              	<?php echo $submenu['menu_html']?>
              	<hr>
              	<div class="pos-title">学校介绍分类列表</div>
              	<div class="row-1">					              					
              		<label>共有学校分类：<?php echo @$total;?>个</label>	
              		<label style="margin-left:20px;">开启状态：<?php echo @$total_valid;?>个</label>
              		<label style="margin-left:20px;">关闭状态：<?php echo $total-$total_valid;?>个</label>			  						  
				  	<button id="create_school_category_modal_show_button" class="add-new btn btn-primary">添加+</button>
				</div>
				
				<table class="table table-1 table-hover">
				  <thead>
					<tr> 					
					  <th width="5%">ID</th>		  
					  <th width="15%">图片预览</th>
					  <th width="15%">分类名称</th>
					  <th width="20%">分类介绍</th>
					  <th width="5%" >排序</th>	
					  <th width="5%" >有效</th>							 
					  <th width="10%">创建时间</th>
					  <th width="10%">创建人</th>	
					  <th width="15%">操作</th>
					</tr>
				  </thead>
				  <tbody>
				  	<?php foreach($school_category_list as $k=>$v){ ?>
				  		<tr>
					  	  <td id="<?php echo $k?>school_category_id" 
					  	  data-data="<?php echo $v['school_category_id']?>">
					  	  	<?php echo $v['school_category_id']?>
					  	  </td>
					  	  <td id="<?php echo $k?>school_category_img"
					  	  data-data="<?php echo $v['school_category_img']?>" 
					  	  data-cover-img="<?php echo $v['school_category_cover_img']?>">
					  	  	<img class="img_list" style="width:150px;height:100px" src="<?php echo $v['school_category_img']?>" />
					  	  </td>
					  	  <td id="<?php echo $k?>school_category_name"
					  	   data-data="<?php echo htmlspecialchars($v['school_category_name'])?>">
					  	  	<?php echo $v['school_category_name']?>
					  	  </td>
					  	  <td id="<?php echo $k?>school_category_content"
					  	   data-data="<?php echo htmlspecialchars($v['school_category_content'])?>">
					  	  	<?php echo $v['school_category_content']?>
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
					  	  	<button class="update_school_category_valid_button btn btn-primary btn-icon" 
					  	  	data-toggle="tooltip" title="有效/无效"  data-id="<?php echo $v['school_category_id']?>">
								<i class="fa fa-refresh" style="color:white"></i>								  	
							</button>
							<button class="update_school_category_modal_show_button btn btn-primary btn-icon" 
									data-toggle="tooltip" title="修改" data-index="<?php echo $k?>">
								<i class="fa fa-gear" style="color:white"></i>								  	
							</button>
							<button class="delete_school_category_button btn btn-danger btn-icon" 
					  	  	data-toggle="tooltip" title="删除"  data-id="<?php echo $v['school_category_id']?>">					  	  
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
<div class="modal fade" id="create_school_category_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="margin-top: 40px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">添加学校分类</h4>
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
                   <input type="text" id="create_sort" 
                        class="form-control form-control-sm" 
                        placeholder="请输入0-256的排序值，值越大排位越靠前(默认0)"/>
                </div>
            </div>          	
          	<div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">主要标题：</label>
                <div class="col-sm-7">
                   <textarea class="form-control" style="height:75px;" 
                   id="create_school_category_name" placeholder="请填写标题内容" ></textarea>
                </div>
            </div>            
            <div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">文章内容：</label>
                <div class="col-sm-7">
                   <textarea class="form-control" style="height:100px;" 
                   id="create_school_category_content" placeholder="请填写文章内容" ></textarea>
               	</div>
            </div>
            <div class="form-group form-group-sm">
            	<label class="col-sm-2 control-label">上传图片：</label>
            	<!-- 图片上传 -->
            	<div class="col-sm-7">
	            	<div data-type="upload" data-upload-type="school_category_img" 
	            	data-img="#create_school_category_img" class="a-i-input upload" 
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
            	<label class="col-sm-2 control-label">图片预览：<br>360*240</label>
            	<div class="col-sm-7">
            		<img id="create_school_category_img" 
            		src="<?php echo $default_school_category_img?>" 
            		style="width:130px;height:120px;border:1px solid #ccc;"  
            		/>
            	</div>
            </div>
            <div class="form-group form-group-sm">
            	<label class="col-sm-2 control-label">上传图片<br>（鼠标效果）：</label>
            	<!-- 图片上传 -->
            	<div class="col-sm-7">
	            	<div data-type="upload" data-upload-type="school_category_cover_img" 
	            	data-img="#create_school_category_cover_img" class="a-i-input upload" 
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
            	<label class="col-sm-2 control-label">图片预览：<br>360*240</label>
            	<div class="col-sm-7">
            		<img id="create_school_category_cover_img" 
            		src="<?php echo $default_school_category_img?>" 
            		style="width:130px;height:120px;border:1px solid #ccc;"  
            		/>
            	</div>
            </div>
          </div>            
        </div>
      </div>
      <!-- !modal-body -->
      <div class="modal-footer">
        <button type="submit" id="create_school_category_submit" class="btn btn-primary btn-standard" >确 定</button>
        <button type="button" data-action="close" class="btn btn-default btn-standard" data-dismiss="modal">关 闭</button>          
      </div>
    </div>      
  </div>
</div>
<!-- !modal --> 
<!-- modal -->
<div class="modal fade" id="update_school_category_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                   <input type="hidden" id="update_school_category_id" />
                   <!-- 原图 -->
                   <input type="hidden" id="update_school_category_img_old" />
                   <input type="hidden" id="update_school_category_cover_img_old" />
                </div>
            </div>          	
          	<div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">主要标题：</label>
                <div class="col-sm-7">
                   <textarea class="form-control" style="height:75px;" 
                   id="update_school_category_name" placeholder="请填写标题内容" ></textarea>
                </div>
            </div>            
            <div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">文章内容：</label>
                <div class="col-sm-7">
                   <textarea class="form-control" style="height:100px;" 
                   id="update_school_category_content" placeholder="请填写文章内容" ></textarea>
               	</div>
            </div>
            <div class="form-group form-group-sm">
            	<label class="col-sm-2 control-label">上传图片：</label>
            	<!-- 图片上传 -->
            	<div class="col-sm-7">
	            	<div data-type="upload" data-upload-type="school_category_img" 
	            	data-img="#update_school_category_img" class="a-i-input upload" 
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
            	<label class="col-sm-2 control-label">图片预览：<br>360*240</label>
            	<div class="col-sm-7">
            		<img id="update_school_category_img" 
            		src="" 
            		style="width:130px;height:120px;border:1px solid #ccc;"  
            		/>
            	</div>
            </div>
            <div class="form-group form-group-sm">
            	<label class="col-sm-2 control-label">上传图片<br>(鼠标效果)：</label>
            	<!-- 图片上传 -->
            	<div class="col-sm-7">
	            	<div data-type="upload" data-upload-type="school_category_cover_img" 
	            	data-img="#update_school_category_cover_img" class="a-i-input upload" 
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
            	<label class="col-sm-2 control-label">图片预览：<br>360*240</label>
            	<div class="col-sm-7">
            		<img id="update_school_category_cover_img" 
            		src="" 
            		style="width:130px;height:120px;border:1px solid #ccc;"  
            		/>
            	</div>
            </div>
          </div>            
        </div>
      </div>
      <!-- !modal-body -->
      <div class="modal-footer">
        <button type="submit" id="update_school_category_submit" class="btn btn-primary btn-standard" >确 定</button>
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
	$('#create_school_category_modal_show_button').click(function(){
		$("#create_school_category_modal").modal('show');
	});
	//提交创建top banner
	$('#create_school_category_submit').click(function(){
		var create_data = {};
		create_data.school_category_name = $("#create_school_category_name").val();
		create_data.school_category_content = $("#create_school_category_content").val();
		create_data.sort = $("#create_sort").val();
		create_data.school_category_img = $("#create_school_category_img").attr('src');
		create_data.school_category_cover_img = $("#create_school_category_cover_img").attr('src');
		create_data.op = '<?php echo CREATE?>';
		//ajax提交
		$.ajax({
	      type : 'post',
	        url : base_url + 'mng_home/save_school_category',
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
	//打开更新TOP BANNER的框框
	$('.update_school_category_modal_show_button').each(function(){
		$(this).click(function(){
			//获取数据
			var this_index = $(this).attr('data-index');
			var school_category_id = $('#'+this_index+'school_category_id').attr('data-data');
			var school_category_img = $('#'+this_index+'school_category_img').attr('data-data');
			var school_category_cover_img = $('#'+this_index+'school_category_img').attr('data-cover-img');
			var school_category_name = $('#'+this_index+'school_category_name').attr('data-data');
			var school_category_content = $('#'+this_index+'school_category_content').attr('data-data');
			var sort = $('#'+this_index+'sort').attr('data-data');
			//更新弹出框内容并且 打开弹出框
			$("#update_school_category_id").val(school_category_id);
			$("#update_school_category_img_old").val(school_category_img);
			$("#update_school_category_cover_img_old").val(school_category_cover_img);
			$("#update_school_category_name").val(school_category_name);
			$("#update_school_category_content").val(school_category_content);
			$("#update_sort").val(sort);
			$("#update_school_category_img").src(school_category_img);
			$("#update_school_category_cover_img").src(school_category_cover_img);			
			$("#update_school_category_modal").modal('show');
		});
	});
	//提交更新TOP BANNER的数据
	$('#update_school_category_submit').click(function(){
		var update_data = {};
		update_data.school_category_name = $("#update_school_category_name").val();
		update_data.school_category_content = $("#update_school_category_content").val();
		update_data.sort = $("#update_sort").val();
		update_data.school_category_img = $("#update_school_category_img").attr('src');
		update_data.school_category_cover_img = $("#update_school_category_cover_img").attr('src');
		update_data.school_category_id = $("#update_school_category_id").val();
		update_data.op = '<?php echo UPDATE?>';
		//如果新图片和旧图片一样   就是不修改图片
		if(update_data.school_category_img == $("#update_school_category_img_old").val()){
			update_data.school_category_img_change = 0;
		}else{
			update_data.school_category_img_change = 1;
		}
		if(update_data.school_category_cover_img == $("#update_school_category_cover_img_old").val()){
			update_data.school_category_cover_img_change = 0;
		}else{
			update_data.school_category_cover_img_change = 1;
		}
		//ajax提交
		$.ajax({
	      type : 'post',
	        url : base_url + 'mng_home/save_school_category',
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
	$('.update_school_category_valid_button').each(function(){
		$(this).click(function(){
			//获取ID
			var school_category_id = $(this).attr('data-id');
			//ajax提交
			$.ajax({
		      type : 'post',
		        url : base_url + 'mng_home/school_category_valid',
		        data : {'school_category_id':school_category_id},
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
	$('.delete_school_category_button').each(function(){
		$(this).click(function(){
			if(confirm('确定要删除吗?删除后不能恢复,并且该分类下的所有文章会被自动移动到"无分类"') == false){
				return;
			}
			//获取ID
			var school_category_id = $(this).attr('data-id');
			//ajax提交
			$.ajax({
		      type : 'post',
		        url : base_url + 'mng_home/delete_school_category',
		        data : {'school_category_id':school_category_id},
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
	$(".img_list").mouseover(function(){
		$(this).attr('src',$(this).parent().attr('data-cover-img'));
	}).mouseout(function(){
		$(this).attr('src',$(this).parent().attr('data-data'));
	});
})

</script>
</html>


