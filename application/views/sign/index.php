<!DOCTYPE html>
<html lang="en">
<?php include VIEWPATH.'common/head.php'; ?>
<body>
<?php include VIEWPATH.'common/header.php'; ?>
<!-- content start -->

	<?php include VIEWPATH.'common/page_title.php'; ?>
	
    
    <div class="contact-area">
        <div class="container">
            <div class="row no-padding">
            	<div class="col-md-12">
	            	<div class="news-bio" style="text-align: center;padding:0 15px;">
	            		<h4 class="comment-title">奋斗在日本留学网 调查评估表</h4>
						<span class="news-meta">
							<label style="float:left">
							官方网址：www.fendoujp.com
							</label>
							<label style="float:right;">
							会社电话：03-5822-5520（东京）
							</label>
						</span>
	                </div>
                </div>
                <br>
                <div class="col-md-12 no-padding">
                    <div class="contact-form no-padding">
                    	<div class="col-md-4 col-sm-6 col-xs-6 no-padding">
                    		<div class="input-tip" style="width:30%">
                    			<input type="text" value="姓名" disabled>
                    		</div>
                    		<div class="sin-input2" style="width:70%">
                                <input type="text" id="name" placeholder="请输入姓名">
                            </div>
                    	</div>
                    	<div class="col-md-4 col-sm-6 col-xs-6 no-padding">
                        	<div class="input-tip" style="width:30%">
                    			<input type="text" value="护照号码" disabled>
                    		</div>
                    		<div class="sin-input2" style="width:70%">
                                <input type="text" id="passport" placeholder="请输入护照号码">
                            </div>
                        </div>
                        
                        <div class="col-md-4 col-sm-6 col-xs-6 no-padding">
                        	<div class="input-tip" style="width:30%">
                    			<input type="text" value="性别" disabled>
                    		</div>
                        	<div class="sin-input2 select-box2" style="width:70%">
								<select id="gender">
									<option value="0">请选择</option>
									<?php foreach(consts::get_const_gender() as $k=>$v){?>
										<option value="<?php echo $v['value']?>">
											<?php echo $v['text']?>
										</option>
									<?php }?>
								</select>
	                        </div>
                        </div>
                        
                        <div class="col-md-4 col-sm-6 col-xs-6 no-padding">
                        	<div class="input-tip" style="width:40%">
                    			<input type="text" value="申请者现状" disabled>
                    		</div>
                        	<div class="sin-input2 select-box2" style="width:60%">
								<select id="apply_status">
									<option value="0">请选择</option>
									<?php foreach(consts::get_const_apply_status() as $k=>$v){?>
										<option value="<?php echo $v['value']?>">
											<?php echo $v['text']?>
										</option>
									<?php }?>
								</select>
	                        </div>
                        </div>
                        <div class="col-md-8 col-sm-12 col-xs-12 no-padding">
                        	<div class="input-tip" style="width:20%">
                    			<input type="text" value="出生日期" disabled>
                    		</div>
                        	<div class="sin-input2 select-box2 no-padding" style="width:30%;">
	                        	<select id="birth_year" style="border-right:none">
									<option value="0">请选择年</option>
									<?php for($i=1980;$i<=2015;$i++){?>
									<option value="<?php echo $i?>"><?php echo $i?>年</option>
	                                <?php }?>
								</select>
							</div>
							<div class="sin-input2 select-box2 no-padding" style="width:25%;">
								<select id="birth_month" style="border-right:none">
									<option value="0">请选择月</option>
									<?php for($i=1;$i<=12;$i++){?>
									<?php if($i<10)$i='0'.$i?>
									<option value="<?php echo $i?>"><?php echo $i?>月</option>
	                                <?php }?>
								</select>
							</div>
							<div class="sin-input2 select-box2 " style="width:25%;">
								<select id="birth_day">
									<option value="0">请选择日</option>
									<?php for($i=1;$i<=31;$i++){?>
									<?php if($i<10)$i='0'.$i?>
									<option value="<?php echo $i?>"><?php echo $i?>日</option>
	                                <?php }?>
								</select>
							</div>
                        </div>   
                        
                        <div class="col-md-3 col-sm-6 col-xs-6 no-padding">
                    		<div class="input-tip" style="width:40%">
                    			<input type="text" value="出生省份" disabled>
                    		</div>
                    		<div class="sin-input2" style="width:60%">
                                <input type="text" id="birth_province" placeholder="请输入出生省份">
                            </div>
                    	</div>
                    	<div class="col-md-3 col-sm-6 col-xs-6 no-padding">
                    		<div class="input-tip" style="width:40%">
                    			<input type="text" value="出生城市" disabled>
                    		</div>
                    		<div class="sin-input2" style="width:60%">
                                <input type="text" id="birth_city" placeholder="请输入出生城市">
                            </div>
                    	</div>
                    	<div class="col-md-3 col-sm-6 col-xs-6 no-padding">
                    		<div class="input-tip" style="width:40%">
                    			<input type="text" value="户口省份" disabled>
                    		</div>
                    		<div class="sin-input2" style="width:60%">
                                <input type="text" id="hukou_province" placeholder="请输入户口省份">
                            </div>
                    	</div>
                    	<div class="col-md-3 col-sm-6 col-xs-6 no-padding">
                    		<div class="input-tip" style="width:40%">
                    			<input type="text" value="户口城市" disabled>
                    		</div>
                    		<div class="sin-input2" style="width:60%">
                                <input type="text" id="hukou_city" placeholder="请输入户口城市">
                            </div>
                    	</div>
                    	<div class="col-md-12 col-sm-12 col-xs-12 no-padding">
                    		<div class="input-tip" style="width:10%">
                    			<input type="text" value="现住地址" disabled>
                    		</div>
                    		<div class="sin-input2" style="width:90%">
                                <input type="text" id="address" placeholder="请输入现住地址">
                            </div>
                    	</div>
                    	
                    	<div class="col-md-3 col-sm-6 col-xs-6 no-padding">
                    		<div class="input-tip" style="width:40%">
                    			<input type="text" value="父亲姓名" disabled>
                    		</div>
                    		<div class="sin-input2" style="width:60%">
                                <input type="text" id="dad_name" placeholder="请输入父亲姓名">
                            </div>
                    	</div>
                    	<div class="col-md-3 col-sm-6 col-xs-6 no-padding">
                    		<div class="input-tip" style="width:40%">
                    			<input type="text" value="父亲年龄" disabled>
                    		</div>
                    		<div class="sin-input2" style="width:60%">
                                <input type="text" id="dad_age" placeholder="请输入父亲年龄">
                            </div>
                    	</div>
                    	<div class="col-md-3 col-sm-6 col-xs-6 no-padding">
                    		<div class="input-tip" style="width:40%">
                    			<input type="text" value="母亲姓名" disabled>
                    		</div>
                    		<div class="sin-input2" style="width:60%">
                                <input type="text" id="mom_name" placeholder="请输入母亲姓名">
                            </div>
                    	</div>
                    	<div class="col-md-3 col-sm-6 col-xs-6 no-padding">
                    		<div class="input-tip" style="width:40%">
                    			<input type="text" value="母亲年龄" disabled>
                    		</div>
                    		<div class="sin-input2" style="width:60%">
                                <input type="text" id="mom_age" placeholder="请输入母亲年龄">
                            </div>
                    	</div>
                    	
                    	<div class="col-md-6 col-sm-6 col-xs-6 no-padding">
                    		<div class="input-tip" style="width:40%">
                    			<input type="text" value="经费支付者姓名" disabled>
                    		</div>
                    		<div class="sin-input2" style="width:60%">
                                <input type="text" id="payer_name" placeholder="请输入经费支付者姓名">
                            </div>
                    	</div>
                    	<div class="col-md-6 col-sm-6 col-xs-6 no-padding">
                    		<div class="input-tip" style="width:40%">
                    			<input type="text" value="与申请者关系" disabled>
                    		</div>
                    		<div class="sin-input2" style="width:60%">
                                <input type="text" id="payer_relation" placeholder="请输入与申请者关系">
                            </div>
                    	</div>
                    	<div class="col-md-6 col-sm-6 col-xs-6 no-padding">
                    		<div class="input-tip" style="width:40%">
                    			<input type="text" value="经费支付者单位" disabled>
                    		</div>
                    		<div class="sin-input2" style="width:60%">
                                <input type="text" id="payer_work" placeholder="请输入经费支付者单位">
                            </div>
                    	</div>
                    	<div class="col-md-6 col-sm-6 col-xs-6 no-padding">
                    		<div class="input-tip" style="width:40%">
                    			<input type="text" value="经费支付者年收" disabled>
                    		</div>
                    		<div class="sin-input2" style="width:60%">
                                <input type="text" id="payer_income" placeholder="请输入经费支付者年收">
                            </div>
                    	</div>     
                        <div class="col-md-3 col-sm-6 col-xs-6 no-padding">
                    		<div class="input-tip" style="width:40%">
                    			<input type="text" value="手机" disabled>
                    		</div>
                    		<div class="sin-input2" style="width:60%">
                                <input type="text" id="mobile" placeholder="请输入手机">
                            </div>
                    	</div>
                        <div class="col-md-3 col-sm-6 col-xs-6 no-padding">
                    		<div class="input-tip" style="width:40%">
                    			<input type="text" value="固定电话" disabled>
                    		</div>
                    		<div class="sin-input2" style="width:60%">
                                <input type="text" id="telphone" placeholder="请输入固定电话">
                            </div>
                    	</div>
                    	<div class="col-md-3 col-sm-6 col-xs-6 no-padding">
                    		<div class="input-tip" style="width:40%">
                    			<input type="text" value="微信" disabled>
                    		</div>
                    		<div class="sin-input2" style="width:60%">
                                <input type="text" id="wechat" placeholder="请输入微信">
                            </div>
                    	</div>
                    	<div class="col-md-3 col-sm-6 col-xs-6 no-padding">
                    		<div class="input-tip" style="width:40%">
                    			<input type="text" value="QQ" disabled>
                    		</div>
                    		<div class="sin-input2" style="width:60%">
                                <input type="text" id="qq" placeholder="请输入QQ">
                            </div>
                    	</div>
                    	<div class="col-md-12 col-sm-12 col-xs-12 no-padding">
                    		<div class="input-tip" style="width:10%">
                    			<input type="text" value="邮箱" disabled>
                    		</div>
                    		<div class="sin-input2" style="width:90%">
                                <input type="text" id="email" placeholder="请输入邮箱">
                            </div>
                    	</div>
                    	
                    	<div class="col-md-4 col-sm-6 col-xs-6 no-padding">
                        	<div class="input-tip" style="width:40%">
                    			<input type="text" value="是否来过日本" disabled>
                    		</div>
                        	<div class="sin-input2 select-box2" style="width:60%">
								<select id="ever_come_japan">
									<option value="0">请选择</option>
									<?php foreach(consts::get_const_ever_come_japan() as $k=>$v){?>
										<option value="<?php echo $v['value']?>">
											<?php echo $v['text']?>
										</option>
									<?php }?>
								</select>
	                        </div>
                        </div>
                        <div class="col-md-8 col-sm-12 col-xs-12 no-padding" 
                        id="come_japan_intro_div" style="display:none">
                    		<div class="input-tip" style="width:20%">
                    			<input type="text" value="赴日经历" disabled>
                    		</div>
                    		<div class="sin-input2" style="width:80%">
                                <input type="text" id="come_japan_intro" 
                                placeholder="如果来过日本,请输入来日本的时间和相关理由">
                            </div>
                    	</div>                    	
                    	<div class="col-md-4 col-sm-6 col-xs-6 no-padding" style="clear:both">
                        	<div class="input-tip" style="width:40%">
                    			<input type="text" value="是否学过日语" disabled>
                    		</div>
                        	<div class="sin-input2 select-box2" style="width:60%">
								<select id="ever_learn_japanese">
									<option value="0">请选择</option>
									<?php foreach(consts::get_const_ever_learn_japanese() as $k=>$v){?>
										<option value="<?php echo $v['value']?>">
											<?php echo $v['text']?>
										</option>
									<?php }?>
								</select>
	                        </div>
                        </div>
                        <div class="col-md-8 col-sm-12 col-xs-12 no-padding" 
                        id="learn_japanese_div" style="display:none">
                    		<div class="input-tip" style="width:20%">
                    			<input type="text" value="学习经历" disabled>
                    		</div>
                    		<div class="sin-input2" style="width:80%">
                                <input type="text" id="learn_japanese_intro" 
                                placeholder="如果学过日语,请输入学习日语的时间和学校名称(或学习方式)">
                            </div>
                    	</div>
                    	<div class="col-md-4 col-sm-6 col-xs-6 no-padding" style="clear:both">
                        	<div class="input-tip" style="width:65%">
                    			<input type="text" value="是否参加过日语级别考试" disabled>
                    		</div>
                        	<div class="sin-input2 select-box2" style="width:35%">
								<select id="ever_test_japanese">
									<option value="0">请选择</option>
									<?php foreach(consts::get_const_ever_test_japanese() as $k=>$v){?>
										<option value="<?php echo $v['value']?>">
											<?php echo $v['text']?>
										</option>
									<?php }?>
								</select>
	                        </div>
                        </div>
                        
                        <div class="col-md-8 col-sm-6 col-xs-6 no-padding test-japanese-div">
                        	<div class="input-tip" style="width:40%">
                    			<input type="text" value="考试时间" disabled>
                    		</div>
                        	<div class="sin-input2 select-box2 no-padding" style="width:30%;">
	                        	<select id="test_japanese_year" style="border-right:none">
									<option value="0">请选择年</option>
									<?php for($i=2000;$i<=2030;$i++){?>
									<option value="<?php echo $i?>"><?php echo $i?>年</option>
	                                <?php }?>
								</select>
							</div>
							<div class="sin-input2 select-box2" style="width:30%;">
								<select id="test_japanese_month">
									<option value="0">请选择月</option>
									<?php for($i=1;$i<=12;$i++){?>
									<?php if($i<10)$i='0'.$i?>
									<option value="<?php echo $i?>"><?php echo $i?>月</option>
	                                <?php }?>
								</select>
							</div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-6 no-padding test-japanese-div">
                        	<div class="input-tip" style="width:45%">
                    			<input type="text" value="考试名称" disabled>
                    		</div>
                        	<div class="sin-input2 select-box2" style="width:55%">
								<select id="test_japanese_name">
									<option value="0">请选择考试名称</option>
									<?php foreach(consts::get_const_test_japanese_name() as $k=>$v){?>
										<option value="<?php echo $v['value']?>">
											<?php echo $v['text']?>
										</option>
									<?php }?>
								</select>
	                        </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-6 no-padding test-japanese-div">
                        	<div class="input-tip" style="width:45%">
                    			<input type="text" value="考试级别" disabled>
                    		</div>
                        	<div class="sin-input2 select-box2" style="width:55%">
								<select id="test_japanese_level">
									<option value="0">请选择考试级别</option>
								</select>
	                        </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-6 no-padding test-japanese-div" 
                        id="learn_japanese_div" style="display:">
                    		<div class="input-tip" style="width:40%">
                    			<input type="text" value="考试分数" disabled>
                    		</div>
                    		<div class="sin-input2" style="width:60%">
                                <input type="text" id="test_japanese_point" 
                                placeholder="请输入考试分数">
                            </div>
                    	</div>
                       <div class="col-md-6 col-sm-6 col-xs-6 no-padding" style="clear:both">
                    		<div class="input-tip" style="width:40%">
                    			<input type="text" value="高中学校名" disabled>
                    		</div>
                    		<div class="sin-input2" style="width:60%">
                                <input type="text" id="highschool_name" 
                                placeholder="请输入高中学校名">
                            </div>
                    	</div>
                    	<div class="col-md-6 col-sm-6 col-xs-6 no-padding">
                        	<div class="input-tip" style="width:40%">
                    			<input type="text" value="高中类型" disabled>
                    		</div>
                        	<div class="sin-input2 select-box2" style="width:60%">
								<select id="highschool_type">
									<option value="0">请选择</option>
									<?php foreach(consts::get_const_highschool_type() as $k=>$v){?>
										<option value="<?php echo $v['value']?>">
											<?php echo $v['text']?>
										</option>
									<?php }?>
								</select>
	                        </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 no-padding">
                    		<div class="input-tip" style="width:40%">
                    			<input type="text" value="高考成绩" disabled>
                    		</div>
                    		<div class="sin-input2" style="width:60%">
                                <input type="text" id="highschool_point" 
                                placeholder="请输入高考成绩">
                            </div>
                    	</div>
                    	<div class="col-md-6 col-sm-6 col-xs-6 no-padding">
                        	<div class="input-tip" style="width:40%">
                    			<input type="text" value="毕业时间" disabled>
                    		</div>
                        	<div class="sin-input2 select-box2 no-padding" style="width:30%;">
	                        	<select id="highschool_year" style="border-right:none">
									<option value="0">请选择年</option>
									<?php for($i=2000;$i<=2030;$i++){?>
									<option value="<?php echo $i?>"><?php echo $i?>年</option>
	                                <?php }?>
								</select>
							</div>
							<div class="sin-input2 select-box2" style="width:30%;">
								<select id="highschool_month">
									<option value="0">请选择月</option>
									<?php for($i=1;$i<=12;$i++){?>
									<?php if($i<10)$i='0'.$i?>
									<option value="<?php echo $i?>"><?php echo $i?>月</option>
	                                <?php }?>
								</select>
							</div>
                        </div>
                    	
                    	<div class="col-md-6 col-sm-6 col-xs-6 no-padding" style="clear:both">
                    		<div class="input-tip" style="width:40%">
                    			<input type="text" value="大学/大专名" disabled>
                    		</div>
                    		<div class="sin-input2" style="width:60%">
                                <input type="text" id="collage_name" 
                                placeholder="请输入学校名(*非必填)">
                            </div>
                    	</div>
                    	<div class="col-md-6 col-sm-6 col-xs-6 no-padding">
                    		<div class="input-tip" style="width:40%">
                    			<input type="text" value="所学专业" disabled>
                    		</div>
                    		<div class="sin-input2" style="width:60%">
                                <input type="text" id="collage_class" 
                                placeholder="请输入所学专业(*非必填)">
                            </div>
                    	</div>
                    	<div class="col-md-3 col-sm-6 col-xs-6 no-padding">
                        	<div class="input-tip" style="width:40%">
                    			<input type="text" value="学校类型" disabled>
                    		</div>
                        	<div class="sin-input2 select-box2" style="width:60%">
								<select id="collage_type">
									<option value="0">请选择</option>
									<?php foreach(consts::get_const_collage_type() as $k=>$v){?>
										<option value="<?php echo $v['value']?>">
											<?php echo $v['text']?>
										</option>
									<?php }?>
								</select>
	                        </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-6 no-padding">
                        	<div class="input-tip" style="width:50%">
                    			<input type="text" value="是否有学位证" disabled>
                    		</div>
                        	<div class="sin-input2 select-box2" style="width:50%">
								<select id="collage_license">
									<option value="0">请选择</option>
									<?php foreach(consts::get_const_collage_license() as $k=>$v){?>
										<option value="<?php echo $v['value']?>">
											<?php echo $v['text']?>
										</option>
									<?php }?>
								</select>
	                        </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 no-padding">
                        	<div class="input-tip" style="width:40%">
                    			<input type="text" value="毕业时间" disabled>
                    		</div>
                        	<div class="sin-input2 select-box2 no-padding" style="width:30%;">
	                        	<select id="collage_year" style="border-right:none">
									<option value="">请选择年</option>
									<?php for($i=2000;$i<=2030;$i++){?>
									<option value="<?php echo $i?>"><?php echo $i?>年</option>
	                                <?php }?>
								</select>
							</div>
							<div class="sin-input2 select-box2" style="width:30%;">
								<select id="collage_month">
									<option value="">请选择月</option>
									<?php for($i=1;$i<=12;$i++){?>
									<?php if($i<10)$i='0'.$i?>
									<option value="<?php echo $i?>"><?php echo $i?>月</option>
	                                <?php }?>
								</select>
							</div>
                        </div>
                        
                        <div class="col-md-6 col-sm-6 col-xs-6 no-padding"  style="clear:left">
                    		<div class="input-tip" style="width:40%">
                    			<input type="text" value="希望申请的学校" disabled>
                    		</div>
                    		<div class="sin-input2" style="width:60%">
                                <input type="text" id="apply_school" 
                                placeholder="请输入希望申请的学校">
                            </div>
                    	</div>
                    	<div class="col-md-6 col-sm-6 col-xs-6 no-padding">
                        	<div class="input-tip" style="width:40%">
                    			<input type="text" value="希望入学时间" disabled>
                    		</div>
                        	<div class="sin-input2 select-box2 no-padding" style="width:30%;">
	                        	<select id="apply_year" style="border-right:none">
									<option value="0">请选择年</option>
									<?php for($i=2017;$i<=2030;$i++){?>
									<option value="<?php echo $i?>"><?php echo $i?>年</option>
	                                <?php }?>
								</select>
							</div>
							<div class="sin-input2 select-box2" style="width:30%;">
								<select id="apply_month">
									<option value="0">请选择月</option>
									<?php for($i=1;$i<=12;$i++){?>
									<?php if($i<10)$i='0'.$i?>
									<option value="<?php echo $i?>"><?php echo $i?>月</option>
	                                <?php }?>
								</select>
							</div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
	                        <input type="submit" id="submit" value="提 交 申 请" 
	                        style="font-size:16px;font-weight:600;color:#fff;background-color:#213140">
                        </div>
                    	
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- content end -->	
<?php include VIEWPATH.'common/footer.php'?>

<?php include VIEWPATH.'common/foot.php'?>

<?php include JSPATH.$route['con'].DIR.$route['fun'].'.php'?>
</body>
</html>

