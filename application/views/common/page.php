						
						<!-- Pagination -->
                        <div class="pagination plr-10">
                        <?php if($max_page > 1){ ?>
                            <span style="float:left;">
                            	<?php if($page != 1){?>
                                <a href="<?php echo func::loc_url().$route['con'].'/'.$route['fun'].'/'.$page_param.($page-1)?>"><i class="fa fa-angle-left"></i> PRE</a>
                            	<?php }else{?>
                            	<a ><i class="fa fa-angle-left"></i> PRE</a>
                            	<?php }?>
                            </span>
                                                        
                                                 
                            <span>
                                <a>
                                	<?php echo $page.'/'.$max_page?>
                                </a>
                            </span>
                                                   
                           
                            <span style="float:right;""> 
                            	<?php if($page != $max_page){?>
                                <a href="<?php echo func::loc_url().$route['con'].'/'.$route['fun'].'/'.$page_param.($page+1)?>">NEXT <i class="fa fa-angle-right"></i></a>
                            	<?php }else{?>
                            	<a >NEXT <i class="fa fa-angle-right"></i></a>
                            	<?php }?>
                            </span>
                        <?php }?>
                        </div>
                        <!-- /.End Of Pagination -->