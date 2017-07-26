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
              	
				  <div class="pos-title">顶部广告</div>
				  <div class="location">
	                <ul>	                  
	                  <li>状态：</li>
	                  		<?php if($layout['layout_top_banner'] == 1){?>
	                  			<li class="blue-font">启用中</li>
	                  		<?php }else{ ?>
	                  			<li class="red-font">未启用</li>
	                  		<?php }?>
	                  <li class="li-split" style="margin:0 20px;">|</li>
	                  <li>内容总数：</li><li class="blue-font"><?php echo $count['top_banner']?></li>
	               </ul>
	               <ul style="float:right;margin-top:-10px;" >
	                  <li class="li-click red-font" data-action="valid" data-module="top_banner" >启用/禁用</li>
	                  <li class="li-split" style="margin:0 20px;">|</li>
	                  <li class="li-click blue-font" data-action="go" data-module="top_banner" >编辑</li>
	                </ul>
	              </div>
	              
	              <div class="pos-title">顶部介绍</div>
				  <div class="location">
	                <ul>	                  
	                  <li>状态：</li>
	                  		<?php if($layout['layout_top_intro'] == 1){?>
	                  			<li class="blue-font">启用中</li>
	                  		<?php }else{ ?>
	                  			<li class="red-font">未启用</li>
	                  		<?php }?>	                  
	               </ul>
	               <ul style="float:right;margin-top:-10px;" >
	                  <li class="li-click red-font" data-action="valid" data-module="top_intro" >启用/禁用</li>
	                  <li class="li-split" style="margin:0 20px;">|</li>
	                  <li class="li-click blue-font" data-action="go" data-module="top_intro" >编辑</li>
	                </ul>
	              </div>
	              
	              <div class="pos-title">
	              		学校介绍
	              		<span style="margin-left:50px;">
	              		模块标题:<span class="blue-font"><?php echo $layout['layout_school_category_title']?></span>
	              		</span>
	              </div>
				  <div class="location">
	                <ul>	                  
	                  <li>状态：</li>
	                  		<?php if($layout['layout_school_category'] == 1){?>
	                  			<li class="blue-font">启用中</li>
	                  		<?php }else{ ?>
	                  			<li class="red-font">未启用</li>
	                  		<?php }?>
	                  <li class="li-split" style="margin:0 20px;">|</li>
	                  <li>分类总数：</li><li class="blue-font"><?php echo $count['school_category']?></li>
	                  <!-- 
	                  <li class="li-split" style="margin:0 20px;">|</li>
	                  <li>学校总数：</li><li class="blue-font"><?php echo @$count['school']?></li>
	                   -->
	               </ul>
	               <ul style="float:right;margin-top:-10px;" >
	                  <li class="li-click blue-font" data-action="update" data-module="school_category" 
	                  data-data="<?php echo htmlspecialchars($layout['layout_school_category_title'])?>">更新标题</li>
	                  <li class="li-split" style="margin:0 20px;">|</li>
	                  <li class="li-click red-font" data-action="valid" data-module="school_category" >启用/禁用</li>
	                  <li class="li-split" style="margin:0 20px;">|</li>
	                  <li class="li-click blue-font" data-action="go" data-module="school_category" >编辑</li>
	                </ul>
	              </div>
	              
	              <div class="pos-title">申请流程</div>
				  <div class="location">
	                <ul>	                  
	                  <li>状态：</li>
	                  		<?php if($layout['layout_apply_intro'] == 1){?>
	                  			<li class="blue-font">启用中</li>
	                  		<?php }else{ ?>
	                  			<li class="red-font">未启用</li>
	                  		<?php }?>
	                  <li class="li-split" style="margin:0 20px;">|</li>
	                  <li>内容总数：</li><li class="blue-font"><?php echo @$count['apply_intro_content']?></li>
	               </ul>
	               <ul style="float:right;margin-top:-10px;" >
	                  <li class="li-click red-font" data-action="valid" data-module="apply_intro" >启用/禁用</li>
	                  <li class="li-split" style="margin:0 20px;">|</li>
	                  <li class="li-click blue-font" data-action="go" data-module="apply_intro" >编辑</li>
	                </ul>
	              </div>
	              
	              <div class="pos-title">申请条件</div>
				  <div class="location">
	                <ul>	                  
	                  <li>状态：</li>
	                  		<?php if($layout['layout_apply_condition'] == 1){?>
	                  			<li class="blue-font">启用中</li>
	                  		<?php }else{ ?>
	                  			<li class="red-font">未启用</li>
	                  		<?php }?>
	                  <li class="li-split" style="margin:0 20px;">|</li>
	                  <li>内容总数：</li><li class="blue-font"><?php echo @$count['apply_condition_content']?></li>
	               </ul>
	               <ul style="float:right;margin-top:-10px;" >
	                  <li class="li-click red-font" data-action="valid" data-module="apply_condition" >启用/禁用</li>
	                  <li class="li-split" style="margin:0 20px;">|</li>
	                  <li class="li-click blue-font" data-action="go" data-module="apply_condition" >编辑</li>
	                </ul>
	              </div>
	              
	              <div class="pos-title">
	              		经验分享
	              		<span style="margin-left:50px;">
	              		模块标题:<span class="blue-font"><?php echo $layout['layout_exp_share_title']?></span>
	              		</span>
	              </div>
				  <div class="location">
	                <ul>	                  
	                  <li>状态：</li>
	                  		<?php if($layout['layout_exp_share'] == 1){?>
	                  			<li class="blue-font">启用中</li>
	                  		<?php }else{ ?>
	                  			<li class="red-font">未启用</li>
	                  		<?php }?>
	                  <li class="li-split" style="margin:0 20px;">|</li>
	                  <li>内容总数：</li><li class="blue-font"><?php echo $count['exp_share']?></li>	                  
	               </ul>
	               <ul style="float:right;margin-top:-10px;" >
	                  <li class="li-click blue-font" data-action="update" data-module="exp_share" 
	                  data-data="<?php echo htmlspecialchars($layout['layout_exp_share_title'])?>">更新标题</li>
	                  <li class="li-split" style="margin:0 20px;">|</li>
	                  <li class="li-click red-font" data-action="valid" data-module="exp_share" >启用/禁用</li>
	                  <li class="li-split" style="margin:0 20px;">|</li>
	                  <li class="li-click blue-font" data-action="go" data-module="exp_share" >编辑</li>
	                </ul>
	              </div>
	              		              	
	              <div class="pos-title">
	              		自由文章
	              		<span style="margin-left:50px;">
	              		模块标题:<span class="blue-font"><?php echo $layout['layout_article_category_title']?></span>
	              		</span>
	              </div>
				  <div class="location">
	                <ul>	                  
	                  <li>状态：</li>
	                  		<?php if($layout['layout_article_category'] == 1){?>
	                  			<li class="blue-font">启用中</li>
	                  		<?php }else{ ?>
	                  			<li class="red-font">未启用</li>
	                  		<?php }?>
	                  <li class="li-split" style="margin:0 20px;">|</li>
	                  <li>分类总数：</li><li class="blue-font"><?php echo $count['article_category']?></li>
	                  <!-- 
	                  <li class="li-split" style="margin:0 20px;">|</li>
	                  <li>帖子总数：</li><li class="blue-font"><?php echo @$count['article']?></li>
	                   -->
	               </ul>
	               <ul style="float:right;margin-top:-10px;" >
	                  <li class="li-click blue-font" data-action="update" data-module="article_category" 
	                  data-data="<?php echo htmlspecialchars($layout['layout_article_category_title'])?>">更新标题</li>
	                  <li class="li-split" style="margin:0 20px;">|</li>
	                  <li class="li-click red-font" data-action="valid" data-module="article_category" >启用/禁用</li>
	                  <li class="li-split" style="margin:0 20px;">|</li>
	                  <li class="li-click blue-font" data-action="go" data-module="article_category" >编辑</li>
	                </ul>
	              </div>
	              	
	              <div class="pos-title">
	              		底部广告
	              		<span style="margin-left:50px;">
	              		模块标题:<span class="blue-font"><?php echo $layout['layout_btm_advert_title']?></span>
	              		</span>
	              </div>
				  <div class="location">
	                <ul>	                  
	                  <li>状态：</li>
	                  		<?php if($layout['layout_btm_advert'] == 1){?>
	                  			<li class="blue-font">启用中</li>
	                  		<?php }else{ ?>
	                  			<li class="red-font">未启用</li>
	                  		<?php }?>
	                  <li class="li-split" style="margin:0 20px;">|</li>
	                  <li>内容总数：</li><li class="blue-font"><?php echo $count['btm_advert']?></li>	                  
	               </ul>
	               <ul style="float:right;margin-top:-10px;" >
	                  <li class="li-click blue-font" data-action="update" data-module="btm_advert" 
	                  data-data="<?php echo htmlspecialchars($layout['layout_btm_advert_title'])?>">更新标题</li>
	                  <li class="li-split" style="margin:0 20px;">|</li>
	                  <li class="li-click red-font" data-action="valid" data-module="btm_advert" >启用/禁用</li>
	                  <li class="li-split" style="margin:0 20px;">|</li>
	                  <li class="li-click blue-font" data-action="go" data-module="btm_advert" >编辑</li>
	                </ul>
	              </div>
		            
		          <div class="pos-title">滚动广告</div>
				  <div class="location">
	                <ul>	                  
	                  <li>状态：</li>
	                  		<?php if($layout['layout_btm_marquee'] == 1){?>
	                  			<li class="blue-font">启用中</li>
	                  		<?php }else{ ?>
	                  			<li class="red-font">未启用</li>
	                  		<?php }?>
	                  <li class="li-split" style="margin:0 20px;">|</li>
	                  <li>内容总数：</li><li class="blue-font"><?php echo $count['btm_marquee']?></li>
	               </ul>
	               <ul style="float:right;margin-top:-10px;" >
	                  <li class="li-click red-font" data-action="valid" data-module="btm_marquee" >启用/禁用</li>
	                  <li class="li-split" style="margin:0 20px;">|</li>
	                  <li class="li-click blue-font" data-action="go" data-module="btm_marquee" >编辑</li>
	                </ul>
	              </div>
	              	
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
<div class="modal fade" id="update_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="margin-top: 50px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">更新标题</h4>
      </div>      
      <div class="form-horizontal">
        <div class="modal-body">
          <div class="info-edit">            
            <div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">标题：</label>
                <div class="col-sm-7">
                   <input type="text" id="update_title" 
                        class="form-control form-control-sm" 
                        placeholder="请输入新的标题(不要太长)"/>
                   <!-- module -->
                   <input type="hidden" id="update_module" />                   
                </div>
            </div> 
          </div>            
        </div>
      </div>
      <!-- !modal-body -->
      <div class="modal-footer">
        <button type="submit" id="update_submit" class="btn btn-primary btn-standard" >确 定</button>
        <button type="button" data-action="close" class="btn btn-default btn-standard" data-dismiss="modal">关 闭</button>          
      </div>
    </div>      
  </div>
</div>
<!-- !modal --> 

  </body>
  <script>
	//点击事件绑定
	$('.li-click').each(function(){
		$(this).click(function(){
		//确认动作和模块
		var act = $(this).attr('data-action');
		var module = $(this).attr('data-module');
		var title = $(this).attr('data-data');
		console.log(act);console.log(module);console.log(title);
			//点击 编辑 按钮 直接跳转
			if(act=='go'){
				if(module != 'apply_condition' && module != 'apply_intro' && module != 'top_intro'){
					window.location="<?php echo func::loc_url()?>mng_home/"+module+"_list";
				}else{
					window.location="<?php echo func::loc_url()?>mng_home/"+module;
				}
			//点击 有效无效 更新有效
			}else if(act=='valid'){
				//ajax提交
				$.ajax({
			      type : 'post',
			        url : base_url + 'mng_home/layout_valid',
			        data : {'layout':module},
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
			}else if(act=='update'){
				$("#update_title").val(title);
				$("#update_module").val(module);
				$("#update_modal").modal('show');
			}
		});
	});
	$("#update_submit").click(function(){
		var update={};
		update.title = $("#update_title").val();
		update.layout = $("#update_module").val();
		//ajax提交
		$.ajax({
	      type : 'post',
	        url : base_url + 'mng_home/layout_title',
	        data : update,
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
	
  </script>
</html>


