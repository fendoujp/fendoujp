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
       			
              	<div class="pos-title">在线留言列表</div>
              	<div class="row-1">
              		<label>
              			共有留言：<?php echo $total;?>条
              			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              			当前状态：
	              		<select id="status_select">
	              		<?php  //-1=未读 1=已读 2=收藏 0=全部?>
	              			<option value="0" >全部留言</option>
	              			<option value="-1" <?php if($get['status']==-1)echo'selected'?>>未读留言</option>
	              			<option value="1" <?php if($get['status']==1)echo'selected'?>>已读留言</option>              			
	              		</select>
              		</label>				  	
				</div>
				
				<table class="table table-1 table-hover">
				  <thead>
					<tr>
					  <th width="13%">ip地址</th>
					  <th width="12%">留言时间</th>
					  <th width="10%">留言人姓名</th>
					  <th width="20%">邮箱</th>
					  <th width="20%">联系方式</th>					  
					  <th width="10%">留言话题</th>
					  <th width="5%">状态</th>
					  <th width="10%">操作</th>
					</tr>
				  </thead>
				  <tbody>
				  	<?php foreach($contact_list as $k=>$v){ ?>
				  		<tr>
				  		<td id="<?php echo $k?>ip" 
					  	  data-data="<?php echo $v['ip']?>">
					  	  	<?php echo $v['ip']?>
					  	  </td>
					  	  <td id="<?php echo $k?>ct" 
					  	  data-data="<?php echo $v['ct_modal']?>">
					  	  	<?php echo $v['ct']?>
					  	  </td>
					  	  
					  	  <td id="<?php echo $k?>contact_name" 
					  	  data-data="<?php echo $v['contact_name']?>">
					  	  	<?php echo $v['contact_name']?>
					  	  </td>
					  	  
					  	  <td id="<?php echo $k?>contact_email" 
					  	  data-data="<?php echo htmlspecialchars($v['contact_email'])?>">
					  	  	<?php echo $v['contact_email']?>
					  	  </td>
					  	  
					  	  <td id="<?php echo $k?>contact_info" 
					  	  data-data="<?php echo $v['contact_type'].':'.$v['contact_info']?>">
					  	  	<?php echo $v['contact_type'].'<br />'.$v['contact_info']?>
					  	  </td>					  	  
					  	  <td id="<?php echo $k?>contact_topic" 
					  	  data-data="<?php echo $v['contact_topic']?>">
					  	  	<?php echo $v['contact_topic']?>
					  	  </td>					  	 					  	 
					  	  <td id="<?php echo $k?>status" data-data="<?php echo $v['status']?>">
					  	  	  <?php if($v['status'] == 0)echo '未读';?>
					  	  	  <?php if($v['status'] == 1)echo '已读';?>					  	  	  
					  	  </td>					  	  								  	 
					  	  <td>					  	  	
					  	  	<button class="show_detail_button btn btn-primary btn-icon" 
					  	  	data-toggle="tooltip" title="查看详情"  data-index="<?php echo $k?>" 
					  	  	data-message="<?php echo htmlspecialchars($v['contact_message'])?>" 
					  	  	data-id="<?php echo $v['contact_id']?>" >
								<i class="fa fa-file" style="color:white"></i>								  	
							</button>											
							<button class="delete_contact_button btn btn-danger btn-icon" 
					  	  	data-toggle="tooltip" title="删除"  data-id="<?php echo $v['contact_id']?>">					  	  
								<i class="fa fa-remove" style="color:white"></i>
							</button>
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
      
<!-- modal -->
<div class="modal fade" id="show_detail_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="margin-top: 40px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">留言详情</h4>
      </div>      
      <div class="form-horizontal">
        <div class="modal-body">
          <div class="info-edit">
          	<div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">IP地址：</label>
                <div class="col-sm-7">
                   <input type="text" id="detail_ip" disabled
                        class="form-control form-control-sm" />
                </div>
            </div>
          	<div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">留言时间：</label>
                <div class="col-sm-7">
                   <input type="text" id="detail_ct" disabled
                        class="form-control form-control-sm" />
                </div>
            </div>          
            <div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">姓名：</label>
                <div class="col-sm-7">
                   <input type="text" id="detail_contact_name" disabled
                        class="form-control form-control-sm" />
                </div>
            </div>
            <div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">邮箱：</label>
                <div class="col-sm-7">
                   <input type="text" id="detail_contact_email" disabled
                        class="form-control form-control-sm" />
                </div>
            </div>
            <div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">联系方式：</label>
                <div class="col-sm-7">
                   <input type="text" id="detail_contact_info" disabled
                        class="form-control form-control-sm" />
                </div>
            </div>
            <div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">留言话题：</label>
                <div class="col-sm-7">
                   <input type="text" id="detail_contact_topic" disabled
                        class="form-control form-control-sm" />
                </div>
            </div>
            <div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">留言内容：</label>
                <div class="col-sm-7">
                   <textarea id="detail_contact_message" disabled style="height:255px;"
                        class="form-control form-control-sm"></textarea>
                </div>
            </div>
          </div>            
        </div>
      </div>
      <!-- !modal-body -->
      <div class="modal-footer">
        <button type="button" data-action="close" class="btn btn-default btn-standard" data-dismiss="modal">关 闭</button>          
      </div>
    </div>      
  </div>
</div>
<!-- !modal -->
  </body>
<script>
ready(function(){	
	//查看详情
	$('.show_detail_button').each(function(){
		
		$(this).click(function(){			
			//获取数据
			var this_index = $(this).attr('data-index');
			var contact_message = $(this).attr('data-message');
			var contact_name = $('#'+this_index+'contact_name').attr('data-data');
			var contact_email = $('#'+this_index+'contact_email').attr('data-data');
			var contact_info = $('#'+this_index+'contact_info').attr('data-data');
			var contact_topic = $('#'+this_index+'contact_topic').attr('data-data');
			var ct = $("#"+this_index+"ct").attr('data-data');
			var ip = $("#"+this_index+"ip").attr('data-data');		
			//如果是未读 改为已读
			var status = $("#"+this_index+"status").attr('data-data');
			if(status == 0){
				//ajax提交
				$.ajax({
			      type : 'post',
			        url : base_url + 'mng_contact/status_read',
			        data : {'contact_id':$(this).attr('data-id')},
			        success : function(response) {
				        //将status 设置为1
			        	$("#"+this_index+"status").attr('data-data',1);
			        }
			    });
			}
        	//更新弹出框内容并且 打开弹出框
			$("#detail_contact_message").val(contact_message);			
			$("#detail_contact_name").val(contact_name);			
			$("#detail_contact_email").val(contact_email);			
			$("#detail_contact_info").val(contact_info);			
			$("#detail_contact_topic").val(contact_topic);			
			$("#detail_ct").val(ct);			
			$("#detail_ip").val(ip);
			$("#show_detail_modal").modal('show');
		});
	});
	
	
	//删除
	$('.delete_contact_button').each(function(){
		$(this).click(function(){
			if(confirm('确定要删除吗?删除后不能恢复') == false){
				return;
			}
			//获取ID
			var contact_id = $(this).attr('data-id');
			//ajax提交
			$.ajax({
		      type : 'post',
		        url : base_url + 'mng_contact/delete_contact',
		        data : {'contact_id':contact_id},
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
		window.location = base_url + 'mng_contact/index/' + $(this).val();
	});	
})

function page(page){
	window.location = base_url + 'mng_contact/index/'+'<?php echo $get['status']?>'+'/'+ page;
}

</script>
</html>