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
              	<div class="pos-title">经验分享列表</div>
              	<div class="row-1">
              		<label>共有经验分享内容：<?php echo $total;?>个</label>	
              		<label style="margin-left:20px;">有效内容：<?php echo $total_valid;?>个</label>
              		<label style="margin-left:20px;">无效内容：<?php echo $total-$total_valid;?>个</label>
				  	<button id="create_exp_share_modal_show_button" class="add-new btn btn-primary">添加+</button>
				</div>
				
				<table class="table table-1 table-hover">
				  <thead>
					<tr>
					  <th width="5%">ID</th>
					  <th width="10%">封面</th>
					  <th width="10%">作者</th>
					  <th width="20%">标题</th>
					  <th width="5%">排序</th>
					  <th width="7.5%">内容</th>
					  <th width="7.5%">有效</th>							 
					  <th width="10%">创建时间</th>
					  <th width="10%">创建人</th>	
					  <th width="15%">操作</th>
					</tr>
				  </thead>
				  <tbody>
				  	<?php foreach($exp_share_list as $k=>$v){ ?>
				  		<tr>
					  	  <td id="<?php echo $k?>exp_share_id" 
					  	  data-data="<?php echo $v['exp_share_id']?>">
					  	  	<?php echo $v['exp_share_id']?>
					  	  </td>
					  	  <td id="<?php echo $k?>exp_share_img"
					  	  data-data="<?php echo $v['exp_share_img']?>">
					  	  	<img style="width:148px;height:102px" src="<?php echo $v['exp_share_img']?>" />
					  	  </td>				  	  
					  	  <td id="<?php echo $k?>exp_share_name"
					  	   data-data="<?php echo htmlspecialchars($v['exp_share_name'])?>">
					  	  	<?php echo $v['exp_share_name']?>
					  	  </td>
					  	  <td id="<?php echo $k?>exp_share_note"
					  	   data-data="<?php echo htmlspecialchars($v['exp_share_note'])?>" 
					  	   data-content="<?php echo htmlspecialchars($v['exp_share_content'])?>">
					  	  	<?php echo $v['exp_share_note']?>
					  	  </td>
					  	  <td id="<?php echo $k?>sort"
					  	   data-data="<?php echo $v['sort']?>">
					  	  	<?php echo $v['sort']?>
					  	  </td>
					  	  <td>
					  	  	  <?php if($v['exp_share_module'] && $v['exp_share_module'] != '[]'){ ?>
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
					  	  <td><?php echo $v['ct']?></td>
					  	  <td><?php echo $v['cer']?></td>
					  	  <td>
					  	  	
					  	  	<button class="update_exp_share_valid_button btn btn-primary btn-icon" 
					  	  	data-toggle="tooltip" title="有效/无效"  data-id="<?php echo $v['exp_share_id']?>">
								<i class="fa fa-refresh" style="color:white"></i>								  	
							</button>
							<button class="update_exp_share_modal_show_button btn btn-primary btn-icon" 
									data-toggle="tooltip" title="修改" data-index="<?php echo $k?>">
								<i class="fa fa-gear" style="color:white"></i>								  	
							</button>
							<button class="edit_exp_share_content btn btn-primary btn-icon" 
					  	  	data-toggle="tooltip" title="编辑内容"  data-id="<?php echo $v['exp_share_id']?>">
								<i class="fa fa-file" style="color:white"></i>								  	
							</button>
							<button class="delete_exp_share_button btn btn-danger btn-icon" 
					  	  	data-toggle="tooltip" title="删除"  data-id="<?php echo $v['exp_share_id']?>">					  	  
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
<div class="modal fade" id="create_exp_share_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="margin-top: 40px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">添加经验分享</h4>
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
              <label class="col-sm-2 control-label">作者：</label>
                <div class="col-sm-7">
                   <input type="text" id="create_exp_share_name" 
                        class="form-control form-control-sm" 
                        placeholder="请填写内容"/>
                </div>
            </div>
            <div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">标题：</label>
                <div class="col-sm-7">
                   <input type="text" id="create_exp_share_note" 
                        class="form-control form-control-sm" 
                        placeholder="请填写内容"/>
                </div>
            </div>             
            <div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">简介内容：</label>
                <div class="col-sm-7">
                   <textarea class="form-control" style="height:125px;" 
                   id="create_exp_share_content" placeholder="请填写内容" ></textarea>
               	</div>
            </div>
            <div class="form-group form-group-sm">
            	<label class="col-sm-2 control-label">上传图片：</label>
            	<!-- 图片上传 -->
            	<div class="col-sm-7">
	            	<div data-type="upload" data-upload-type="exp_share_img" 
	            	data-img="#create_exp_share_img" class="a-i-input upload" 
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
            		<img id="create_exp_share_img" 
            		src="<?php echo $default_exp_share_img?>" 
            		style="width:185px;height:127.5px;border:1px solid #ccc;"  
            		/>
            	</div>
            </div>
          </div>            
        </div>
      </div>
      <!-- !modal-body -->
      <div class="modal-footer">
        <button type="submit" id="create_exp_share_submit" class="btn btn-primary btn-standard" >确 定</button>
        <button type="button" data-action="close" class="btn btn-default btn-standard" data-dismiss="modal">关 闭</button>          
      </div>
    </div>      
  </div>
</div>
<!-- !modal --> 
<!-- modal -->
<div class="modal fade" id="update_exp_share_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="margin-top: 40px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">更新经验分享</h4>
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
                </div>
                <!-- ID -->
                <input type="hidden" id="update_exp_share_id" />
                <!-- 原图 -->
                <input type="hidden" id="update_exp_share_img_old" />
            </div>          	
          	<div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">作者：</label>
                <div class="col-sm-7">
                   <input type="text" id="update_exp_share_name" 
                        class="form-control form-control-sm" 
                        placeholder="请填写内容"/>
                </div>
            </div>
            <div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">标题：</label>
                <div class="col-sm-7">
                   <input type="text" id="update_exp_share_note" 
                        class="form-control form-control-sm" 
                        placeholder="请填写内容"/>
                </div>
            </div>             
            <div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">简介内容：</label>
                <div class="col-sm-7">
                   <textarea class="form-control" style="height:125px;" 
                   id="update_exp_share_content" placeholder="请填写简介内容" ></textarea>
               	</div>
            </div>
            <div class="form-group form-group-sm">
            	<label class="col-sm-2 control-label">上传图片：</label>
            	<!-- 图片上传 -->
            	<div class="col-sm-7">
	            	<div data-type="upload" data-upload-type="exp_share_img" 
	            	data-img="#update_exp_share_img" class="a-i-input upload" 
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
            		<img id="update_exp_share_img" 
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
        <button type="submit" id="update_exp_share_submit" class="btn btn-primary btn-standard" >确 定</button>
        <button type="button" data-action="close" class="btn btn-default btn-standard" data-dismiss="modal">关 闭</button>          
      </div>
    </div>      
  </div>
</div>
<!-- !modal --> 
  
  
  </body>
<script>
ready(function(){
	
	$('#create_exp_share_modal_show_button').click(function(){
		//点击打开创建modal
		$("#create_exp_share_modal").modal('show');
		//创建新的经验分享模块
		//window.location = base_url + "mng_home/edit_exp_share";
	});
	
	//提交创建
	$('#create_exp_share_submit').click(function(){
		var create_data = {};
		create_data.exp_share_name = $("#create_exp_share_name").val();
		create_data.exp_share_content = $("#create_exp_share_content").val();
		create_data.exp_share_note = $("#create_exp_share_note").val();
		create_data.sort = $("#create_sort").val();
		create_data.exp_share_img = $("#create_exp_share_img").attr('src');
		create_data.op = '<?php echo CREATE?>';
		//ajax提交
		$.ajax({
	      type : 'post',
	        url : base_url + 'mng_home/save_exp_share',
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
	$('.update_exp_share_modal_show_button').each(function(){
		
		$(this).click(function(){
			
			//获取数据
			var this_index = $(this).attr('data-index');
			var exp_share_id = $('#'+this_index+'exp_share_id').attr('data-data');
			var exp_share_name = $('#'+this_index+'exp_share_name').attr('data-data');
			var exp_share_note = $('#'+this_index+'exp_share_note').attr('data-data');
			var exp_share_content = $('#'+this_index+'exp_share_note').attr('data-content');
			var exp_share_img = $('#'+this_index+'exp_share_img').attr('data-data');			
			var sort = $('#'+this_index+'sort').attr('data-data');
			//更新弹出框内容并且 打开弹出框
			$("#update_exp_share_id").val(exp_share_id);			
			$("#update_exp_share_name").val(exp_share_name);
			$("#update_exp_share_note").val(exp_share_note);
			$("#update_exp_share_content").val(exp_share_content);
			$("#update_sort").val(sort);
			$("#update_exp_share_modal").modal('show');
			$("#update_exp_share_img").src(exp_share_img);
			$("#update_exp_share_img_old").val(exp_share_img);
		});
	});
	//点击去编辑文件内容
	$('.edit_exp_share_content').each(function(){
		//直接打开新页面编辑
		$(this).click(function(){			
			var exp_share_id = $(this).attr('data-id');
			window.location = base_url + "mng_home/edit_exp_share/" + exp_share_id;
		});
	});
		
	//提交更新数据
	$('#update_exp_share_submit').click(function(){
		var update_data = {};
		update_data.exp_share_name = $("#update_exp_share_name").val();
		update_data.exp_share_note = $("#update_exp_share_note").val();
		update_data.exp_share_content = $("#update_exp_share_content").val();
		update_data.sort = $("#update_sort").val();
		update_data.exp_share_id = $("#update_exp_share_id").val();
		update_data.op = '<?php echo UPDATE?>';
		update_data.exp_share_img = $("#update_exp_share_img").attr('src');
		//如果新图片和旧图片一样   就是不修改图片
		if(update_data.exp_share_img == $("#update_exp_share_img_old").val()){
			update_data.exp_share_img_change = 0;
		}else{
			update_data.exp_share_img_change = 1;
		}
		//ajax提交
		$.ajax({
	      type : 'post',
	        url : base_url + 'mng_home/save_exp_share',
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
	$('.update_exp_share_valid_button').each(function(){
		$(this).click(function(){
			//获取ID
			var exp_share_id = $(this).attr('data-id');
			//ajax提交
			$.ajax({
		      type : 'post',
		        url : base_url + 'mng_home/exp_share_valid',
		        data : {'exp_share_id':exp_share_id},
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
	$('.delete_exp_share_button').each(function(){
		$(this).click(function(){
			if(confirm('确定要删除吗?删除后不能恢复') == false){
				return;
			}
			//获取ID
			var exp_share_id = $(this).attr('data-id');
			//ajax提交
			$.ajax({
		      type : 'post',
		        url : base_url + 'mng_home/delete_exp_share',
		        data : {'exp_share_id':exp_share_id},
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


