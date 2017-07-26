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
                  <li>申请条件列表</li>
                </ul>
              </div>
              <div class="main">              	
              	<div class="pos-title">申请条件列表</div>
              	<div class="row-1">
              		<label>共有申请条件内容：<?php echo $total;?>个</label>	
              		<label style="margin-left:20px;">有效内容：<?php echo $total_valid;?>个</label>
              		<label style="margin-left:20px;">无效内容：<?php echo $total-$total_valid;?>个</label>
				  	<button id="create_condi_modal_show_button" class="add-new btn btn-primary">添加+</button>
				</div>
				
				<table class="table table-1 table-hover">
				  <thead>
					<tr>
					  <th width="5%">ID</th>
					  <th width="20%">标题</th>
					  <th width="10%">排序</th>
					  <th width="10%">内容</th>
					  <th width="10%">有效</th>							 
					  <th width="20%">创建时间</th>
					  <th width="10%">创建人</th>	
					  <th width="15%">操作</th>
					</tr>
				  </thead>
				  <tbody>
				  	<?php foreach($condi_list as $k=>$v){ ?>
				  		<tr>
					  	  <td id="<?php echo $k?>condi_id" 
					  	  data-data="<?php echo $v['condi_id']?>">
					  	  	<?php echo $v['condi_id']?>
					  	  </td>					  	 			  	  
					  	  <td id="<?php echo $k?>condi_title"
					  	   data-data="<?php echo htmlspecialchars($v['condi_title'])?>">
					  	  	<?php echo $v['condi_title']?>
					  	  </td>					  	 
					  	  <td id="<?php echo $k?>sort"
					  	   data-data="<?php echo $v['sort']?>">
					  	  	<?php echo $v['sort']?>
					  	  </td>
					  	  <td>
					  	  	  <?php if($v['condi_module'] && $v['condi_module'] != '[]'){ ?>
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
					  	  	
					  	  	<button class="update_condi_valid_button btn btn-primary btn-icon" 
					  	  	data-toggle="tooltip" title="有效/无效"  data-id="<?php echo $v['condi_id']?>">
								<i class="fa fa-refresh" style="color:white"></i>								  	
							</button>
							<button class="update_condi_modal_show_button btn btn-primary btn-icon" 
									data-toggle="tooltip" title="修改" data-index="<?php echo $k?>">
								<i class="fa fa-gear" style="color:white"></i>								  	
							</button>
							<button class="edit_condi_content btn btn-primary btn-icon" 
					  	  	data-toggle="tooltip" title="编辑内容"  data-id="<?php echo $v['condi_id']?>">
								<i class="fa fa-file" style="color:white"></i>								  	
							</button>
							<button class="delete_condi_button btn btn-danger btn-icon" 
					  	  	data-toggle="tooltip" title="删除"  data-id="<?php echo $v['condi_id']?>">					  	  
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
<div class="modal fade" id="create_condi_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="margin-top: 40px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">添加申请条件</h4>
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
              <label class="col-sm-2 control-label">标题：</label>
                <div class="col-sm-7">
                   <input type="text" id="create_condi_title" 
                        class="form-control form-control-sm" 
                        placeholder="请填写内容"/>
                </div>
            </div>
          </div>            
        </div>
      </div>
      <!-- !modal-body -->
      <div class="modal-footer">
        <button type="submit" id="create_condi_submit" class="btn btn-primary btn-standard" >确 定</button>
        <button type="button" data-action="close" class="btn btn-default btn-standard" data-dismiss="modal">关 闭</button>          
      </div>
    </div>      
  </div>
</div>
<!-- !modal --> 
<!-- modal -->
<div class="modal fade" id="update_condi_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="margin-top: 40px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">更新申请条件</h4>
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
                <input type="hidden" id="update_condi_id" />
            </div>          	
          	<div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">标题：</label>
                <div class="col-sm-7">
                   <input type="text" id="update_condi_title" 
                        class="form-control form-control-sm" 
                        placeholder="请填写内容"/>
                </div>
            </div>
          </div>            
        </div>
      </div>
      <!-- !modal-body -->
      <div class="modal-footer">
        <button type="submit" id="update_condi_submit" class="btn btn-primary btn-standard" >确 定</button>
        <button type="button" data-action="close" class="btn btn-default btn-standard" data-dismiss="modal">关 闭</button>          
      </div>
    </div>      
  </div>
</div>
<!-- !modal --> 
  
  
  </body>
<script>
ready(function(){
	
	$('#create_condi_modal_show_button').click(function(){
		//点击打开创建modal
		$("#create_condi_modal").modal('show');
		//创建新的申请条件模块
		//window.location = base_url + "mng_home/edit_condi";
	});
	
	//提交创建
	$('#create_condi_submit').click(function(){
		var create_data = {};
		create_data.condi_title = $("#create_condi_title").val();
		create_data.sort = $("#create_sort").val();
		create_data.op = '<?php echo CREATE?>';
		//ajax提交
		$.ajax({
	      type : 'post',
	        url : base_url + 'mng_condi/save_condi',
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
	$('.update_condi_modal_show_button').each(function(){
		
		$(this).click(function(){
			
			//获取数据
			var this_index = $(this).attr('data-index');
			var condi_id = $('#'+this_index+'condi_id').attr('data-data');
			var condi_title = $('#'+this_index+'condi_title').attr('data-data');			
			var sort = $('#'+this_index+'sort').attr('data-data');
			//更新弹出框内容并且 打开弹出框
			$("#update_condi_id").val(condi_id);			
			$("#update_condi_title").val(condi_title);			
			$("#update_sort").val(sort);
			$("#update_condi_modal").modal('show');			
		});
	});
	//点击去编辑文件内容
	$('.edit_condi_content').each(function(){
		//直接打开新页面编辑
		$(this).click(function(){			
			var condi_id = $(this).attr('data-id');
			window.location = base_url + "mng_condi/edit_condi/" + condi_id;
		});
	});
		
	//提交更新数据
	$('#update_condi_submit').click(function(){
		var update_data = {};
		update_data.condi_title = $("#update_condi_title").val();
		update_data.sort = $("#update_sort").val();
		update_data.condi_id = $("#update_condi_id").val();
		update_data.op = '<?php echo UPDATE?>';	
		//ajax提交
		$.ajax({
	      type : 'post',
	        url : base_url + 'mng_condi/save_condi',
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
	$('.update_condi_valid_button').each(function(){
		$(this).click(function(){
			//获取ID
			var condi_id = $(this).attr('data-id');
			//ajax提交
			$.ajax({
		      type : 'post',
		        url : base_url + 'mng_condi/condi_valid',
		        data : {'condi_id':condi_id},
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
	$('.delete_condi_button').each(function(){
		$(this).click(function(){
			if(confirm('确定要删除吗?删除后不能恢复') == false){
				return;
			}
			//获取ID
			var condi_id = $(this).attr('data-id');
			//ajax提交
			$.ajax({
		      type : 'post',
		        url : base_url + 'mng_condi/delete_condi',
		        data : {'condi_id':condi_id},
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


