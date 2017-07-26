<!-- 下一篇  上一篇  返回 -->
						
						<!-- Pagination -->
                        <div class="pagination plr-10" style="margin-top:45px;">
                            <span style="float:left;">                 
                            	<?php if($pre_id > 0){ ?>           	
                                <a href="<?php echo func::loc_url().$route['con'].'/'.$route['fun'].'/'.$pre_id?>"><i class="fa fa-angle-left"></i> PRE</a>
                                <?php }else{ ?>
                                <a><i class="fa fa-angle-left"></i> PRE</a>
                                <?php }?>
                            </span>
                            <span>
                            	<?php if(@!$return){?>
                                <a href="<?php echo func::loc_url().$route['con']?>">
                                	RETURN
                                </a>
                                <?php }else{ ?>
                                <a href="<?php echo $return?>">
                                	RETURN
                                </a>
                                <?php }?>
                            </span>
                            <span style="float:right;""> 
                            	<?php if($next_id > 0){ ?>
                            	<a href="<?php echo func::loc_url().$route['con'].'/'.$route['fun'].'/'.$next_id?>">NEXT <i class="fa fa-angle-right"></i></a>
                            	<?php }else{ ?>
                            	<a>NEXT <i class="fa fa-angle-right"></i></a>
                            	<?php }?> 
                                
                            </span>
                            
                        </div>
                        <!-- /.End Of Pagination -->