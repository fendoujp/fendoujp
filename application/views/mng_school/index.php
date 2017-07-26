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
                  <li>学校介绍列表</li>
                </ul>
              </div>
              <div class="main">
       			<!-- 
              	<?php echo $submenu['menu_html']?>              	
              	<hr>
              	 -->
              	<div class="pos-title">学校介绍列表</div>
              	<div class="row-1">
              		<label>
              			共有学校：<?php echo $total;?>个
              			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              			当前分类：
	              		<select id="category_select">
	              			<option value="0">全部大学</option>
	              			<option value="-1" <?php if($category_id == -1) echo 'selected'?>>无分类</option>
	              			<?php foreach($school_category_list as $k=>$v){ ?>
	              				<option value="<?php echo $v['school_category_id']?>" 
	              					<?php if($category_id == $v['school_category_id']) echo 'selected'?>
	              				>
	              					<?php echo $v['school_category_name']?>
	              				</option>
	              			<?php }?>
	              		</select>
              		</label>
				  	<button id="create_school_modal_show_button" class="add-new btn btn-primary">添加+</button>
				</div>
				
				<table class="table table-1 table-hover">
				  <thead>
					<tr>
					  <th width="5%">ID</th>
					  <th width="10%">封面</th>
					  <th width="10%">学校名称</th>
					  <th width="10%">副名称</th>
					  <th width="10%">所属分类</th>
					  <th width="5%"><?php echo consts::SCH_INTRO?></th>
					  <th width="5%"><?php echo consts::SCH_ENROL?></th>
					  <th width="5%"><?php echo consts::SCH_ENVMT?></th>
					  <th width="5%">有效</th>
					  <th width="5%">排序</th>							 
					  <th width="10%">创建时间</th>
					  <th width="5%">创建人</th>	
					  <th width="15%">操作</th>
					</tr>
				  </thead>
				  <tbody>
				  	<?php foreach($school_list as $k=>$v){ ?>
				  		<tr>
					  	  <td id="<?php echo $k?>school_id" 
					  	  data-data="<?php echo $v['school_id']?>">
					  	  	<?php echo $v['school_id']?>
					  	  </td>
					  	  <td id="<?php echo $k?>school_img"
					  	  data-data="<?php echo $v['school_img']?>">
					  	  	<img style="width:148px;height:102px" src="<?php echo $v['school_img']?>" />
					  	  </td>		  	  
					  	  <td id="<?php echo $k?>school_title"
					  	   data-data="<?php echo htmlspecialchars($v['school_title'])?>">
					  	  	<?php echo $v['school_title']?>
					  	  </td>
					  	  <td id="<?php echo $k?>school_sub_title"
					  	   data-data="<?php echo htmlspecialchars($v['school_sub_title'])?>">
					  	  	<?php echo $v['school_sub_title']?>
					  	  </td>
					  	  
					  	  <?php if($v['school_category_id'] > 0){ ?>
					  	  <td id="<?php echo $k?>school_category_id"
					  	   data-data="<?php echo $v['school_category_id']?>">
					  	  	<?php echo $v['school_category_name']?>
					  	  </td>
					  	  <?php }else{ ?>
					  	  <td id="<?php echo $k?>school_category_id"
					  	   data-data="-1">
					  	  	<span class="red-font">无分类</span>
					  	  </td>					  	  
					  	  <?php }?>
					  	  
					  	  <td>
					  	  	  <?php if($v['school_intro_module'] && $v['school_intro_module'] != '[]'){ ?>
					  	  	  <span class="blue-font">有内容</span>
					  	  	  <?php }else{?>
					  	  	  <span class="red-font">无内容</span>
					  	  	  <?php }?>
					  	  </td>
					  	  <td>
					  	  	  <?php if($v['school_enrol_module'] && $v['school_enrol_module'] != '[]'){ ?>
					  	  	  <span class="blue-font">有内容</span>
					  	  	  <?php }else{?>
					  	  	  <span class="red-font">无内容</span>
					  	  	  <?php }?>
					  	  </td>
					  	  <td>
					  	  	  <?php if($v['school_envmt_module'] && $v['school_envmt_module'] != '[]'){ ?>
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
					  	  	
					  	  	<button class="update_school_valid_button btn btn-primary btn-icon" 
					  	  	data-toggle="tooltip" title="有效/无效"  data-id="<?php echo $v['school_id']?>">
								<i class="fa fa-refresh" style="color:white"></i>								  	
							</button>
							<button class="update_school_modal_show_button btn btn-primary btn-icon" 
									data-toggle="tooltip" title="修改" data-index="<?php echo $k?>">
								<i class="fa fa-gear" style="color:white"></i>								  	
							</button>
							<button class="delete_school_button btn btn-danger btn-icon" 
					  	  	data-toggle="tooltip" title="删除"  data-id="<?php echo $v['school_id']?>">					  	  
								<i class="fa fa-remove" style="color:white"></i>								  	
							</button>
							<br /> <br />
							<button class="edit_school_intro btn btn-primary btn-icon" 
					  	  	data-toggle="tooltip" title="编辑学校介绍内容"  data-id="<?php echo $v['school_id']?>">
								<i class="fa fa-file" style="color:white"></i>								  	
							</button>
							<button class="edit_school_enrol btn btn-primary btn-icon" 
					  	  	data-toggle="tooltip" title="编辑招生介绍内容"  data-id="<?php echo $v['school_id']?>">
								<i class="fa fa-file" style="color:white"></i>								  	
							</button>
							<button class="edit_school_envmt btn btn-primary btn-icon" 
					  	  	data-toggle="tooltip" title="编辑学校环境内容"  data-id="<?php echo $v['school_id']?>">
								<i class="fa fa-file" style="color:white"></i>								  	
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
<div class="modal fade" id="create_school_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="margin-top: 40px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">添加学校介绍</h4>
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
              <label class="col-sm-2 control-label">学校分类：</label>
                <div class="col-sm-7">
                   <select id="create_school_category_id">
              			<option value="-1" selected>无分类</option>
              			<?php foreach($school_category_list as $k=>$v){ ?>
              				<option value="<?php echo $v['school_category_id']?>">
              					<?php echo $v['school_category_name']?>
              				</option>
              			<?php }?>
              		</select>
              		注:无分类的学校将无法正常显示在列表页
                </div>
            </div>   	
          	<div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">学校名称：</label>
                <div class="col-sm-7">
                   <input type="text" id="create_school_title" 
                        class="form-control form-control-sm" 
                        placeholder="请填写内容"/>
                </div>
            </div>
            <div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">副名称：</label>
                <div class="col-sm-7">
                   <input type="text" id="create_school_sub_title" 
                        class="form-control form-control-sm" 
                        placeholder="请填写内容"/>
                </div>
            </div>
            <div class="form-group form-group-sm">
            	<label class="col-sm-2 control-label">上传图片：</label>
            	<!-- 图片上传 -->
            	<div class="col-sm-7">
	            	<div data-type="upload" data-upload-type="school_img" 
	            	data-img="#create_school_img" class="a-i-input upload" 
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
            		<img id="create_school_img" 
            		src="<?php echo $default_school_img?>" 
            		style="width:370px;height:255px;border:1px solid #ccc;"  
            		/>
            	</div>
            </div>
          </div>            
        </div>
      </div>
      <!-- !modal-body -->
      <div class="modal-footer">
        <button type="submit" id="create_school_submit" class="btn btn-primary btn-standard" >确 定</button>
        <button type="button" data-action="close" class="btn btn-default btn-standard" data-dismiss="modal">关 闭</button>          
      </div>
    </div>      
  </div>
</div>
<!-- !modal --> 
<!-- modal -->
<div class="modal fade" id="update_school_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
            <input type="hidden" id="update_school_id" />
            <!-- 原图 -->
            <input type="hidden" id="update_school_img_old" />
                	
          	<div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">排序：</label>
                <div class="col-sm-7">
                   <input type="text" id="update_sort" 
                        class="form-control form-control-sm" 
                        placeholder="请输入0-256的排序值，值越大排位越靠前(默认0)"/>
                </div>
            </div>
            <div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">学校分类：</label>
                <div class="col-sm-7">
                   <select id="update_school_category_id">
              			<option value="-1" selected>无分类</option>
              			<?php foreach($school_category_list as $k=>$v){ ?>
              				<option value="<?php echo $v['school_category_id']?>">
              					<?php echo $v['school_category_name']?>
              				</option>
              			<?php }?>
              		</select>
              		注:无分类的学校将无法正常显示在列表页
                </div>
            </div>   	
          	<div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">学校名称：</label>
                <div class="col-sm-7">
                   <input type="text" id="update_school_title" 
                        class="form-control form-control-sm" 
                        placeholder="请填写内容"/>
                </div>
            </div>
            <div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">副名称：</label>
                <div class="col-sm-7">
                   <input type="text" id="update_school_sub_title" 
                        class="form-control form-control-sm" 
                        placeholder="请填写内容"/>
                </div>
            </div>
            
            <div class="form-group form-group-sm">
            	<label class="col-sm-2 control-label">上传图片：</label>
            	<!-- 图片上传 -->
            	<div class="col-sm-7">
	            	<div data-type="upload" data-upload-type="school_img" 
	            	data-img="#update_school_img" class="a-i-input upload" 
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
            		<img id="update_school_img" 
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
        <button type="submit" id="update_school_submit" class="btn btn-primary btn-standard" >确 定</button>
        <button type="button" data-action="close" class="btn btn-default btn-standard" data-dismiss="modal">关 闭</button>          
      </div>
    </div>      
  </div>
</div>
<!-- !modal --> 
  
  
  </body>
<script>
ready(function(){
	
	$('#create_school_modal_show_button').click(function(){
		//点击打开创建modal
		$("#create_school_modal").modal('show');
		//创建新的经验分享模块
		//window.location = base_url + "mng_school/edit_school";
	});
	
	//提交创建
	$('#create_school_submit').click(function(){
		var create_data = {};
		create_data.school_title = $("#create_school_title").val();
		create_data.school_sub_title = $("#create_school_sub_title").val();
		create_data.school_category_id = $("#create_school_category_id").val();
		create_data.sort = $("#create_sort").val();
		create_data.school_img = $("#create_school_img").attr('src');
		create_data.op = '<?php echo CREATE?>';
		//ajax提交
		$.ajax({
	      type : 'post',
	        url : base_url + 'mng_school/save_school',
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
	$('.update_school_modal_show_button').each(function(){
		
		$(this).click(function(){
			
			//获取数据
			var this_index = $(this).attr('data-index');
			var school_id = $('#'+this_index+'school_id').attr('data-data');
			var school_title = $('#'+this_index+'school_title').attr('data-data');
			var school_sub_title = $('#'+this_index+'school_sub_title').attr('data-data');
			var school_img = $('#'+this_index+'school_img').attr('data-data');			
			var sort = $('#'+this_index+'sort').attr('data-data');
			//分类
			var school_category_id = $("#"+this_index+'school_category_id').attr('data-data');
			//控制分类框
			$("#update_school_category_id").val(school_category_id);
						
			//更新弹出框内容并且 打开弹出框
			$("#update_school_id").val(school_id);			
			$("#update_school_title").val(school_title);
			$("#update_school_sub_title").val(school_sub_title);
			$("#update_sort").val(sort);
			$("#update_school_img").src(school_img);
			$("#update_school_img_old").val(school_img);
			$("#update_school_modal").modal('show');
		});
	});
	//点击去编辑文件内容
	$('.edit_school_intro').each(function(){
		//直接打开新页面编辑
		$(this).click(function(){			
			var school_id = $(this).attr('data-id');
			window.location = base_url + "mng_school/edit_school/intro/" + school_id;
		});
	});
	$('.edit_school_enrol').each(function(){
		//直接打开新页面编辑
		$(this).click(function(){			
			var school_id = $(this).attr('data-id');
			window.location = base_url + "mng_school/edit_school/enrol/" + school_id;
		});
	});
	$('.edit_school_envmt').each(function(){
		//直接打开新页面编辑
		$(this).click(function(){			
			var school_id = $(this).attr('data-id');
			window.location = base_url + "mng_school/edit_school/envmt/" + school_id;
		});
	});
	
		
	//提交更新数据
	$('#update_school_submit').click(function(){
		var update_data = {};
		update_data.school_title = $("#update_school_title").val();
		update_data.school_sub_title = $("#update_school_sub_title").val();
		update_data.school_category_id = $("#update_school_category_id").val();
		update_data.sort = $("#update_sort").val();
		update_data.school_id = $("#update_school_id").val();
		update_data.op = '<?php echo UPDATE?>';
		update_data.school_img = $("#update_school_img").attr('src');
		//如果新图片和旧图片一样   就是不修改图片
		if(update_data.school_img == $("#update_school_img_old").val()){
			update_data.school_img_change = 0;
		}else{
			update_data.school_img_change = 1;
		}
		//ajax提交
		$.ajax({
	      type : 'post',
	        url : base_url + 'mng_school/save_school',
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
	$('.update_school_valid_button').each(function(){
		$(this).click(function(){
			//获取ID
			var school_id = $(this).attr('data-id');
			//ajax提交
			$.ajax({
		      type : 'post',
		        url : base_url + 'mng_school/school_valid',
		        data : {'school_id':school_id},
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
	$('.delete_school_button').each(function(){
		$(this).click(function(){
			if(confirm('确定要删除吗?删除后不能恢复') == false){
				return;
			}
			//获取ID
			var school_id = $(this).attr('data-id');
			//ajax提交
			$.ajax({
		      type : 'post',
		        url : base_url + 'mng_school/delete_school',
		        data : {'school_id':school_id},
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
		window.location = base_url + 'mng_school/index/' + $(this).val();
	});
	
})

</script>
</html>