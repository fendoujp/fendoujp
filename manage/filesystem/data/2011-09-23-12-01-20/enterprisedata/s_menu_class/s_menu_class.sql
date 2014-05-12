INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(1,'网站信息配置',0,'','网站基本信息配置',1,1,0,0,'config');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(2,'产品管理系统',0,'','',3,1,0,0,'product');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(3,'栏目管理',0,'menu/menu.php','',0,1,58,0,'menu');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(4,'新闻管理系统',0,'','',5,1,0,0,'new');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(7,'会员管理',0,'','',6,1,0,0,'user');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(8,'留言管理',0,'','',7,1,0,0,'feedback');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(9,'菜单管理',0,'menu/menu_class.php','',1,1,58,0,'menuclass');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(10,'网站配置',0,'webconfig/webconfig.php?s_language=0&s_email=0&s_count=0&s_des=1','',4,1,1,0,'webconfig');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(11,'用户管理',0,'webconfig/webpassword.php?cc=1','',3,1,1,0,'password');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(12,'产品添加',0,'products/p_do.php?s_type=product&s_img=1&s_add=1&s_del=1&s_check=1&s_ok=1&s_down=1&s_conj=0&s_price=2&s_content=1&s_f=2&title=产品','',0,1,2,0,'product');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(14,'产品管理',0,'products/p_list.php?s_type=product&s_img=1&s_add=1&s_del=1&s_check=1&s_ok=1&s_down=1&s_conj=0&s_price=2&s_content=1&s_f=2&s_xx=1&title=产品','',0,1,2,0,'product');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(15,'产品分类',0,'products/p_class.php?s_type=p_class&s_img=0&s_add=1&s_del=1&s_check=1&s_ok=1&s_down=1&s_conj=0&s_content=1&s_next=3&title=产品分类','',0,1,2,0,'product');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(16,'信息管理',0,'','',2,1,0,0,'info');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(17,'单页多标题',0,'info/info.php?s_type=info&s_img=0&s_add=1&s_del=1&s_check=1&s_ok=1&s_down=1&s_conj=0&s_content=1&title=单页多标题','',0,1,16,0,'info');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(18,'公用信息',0,'','',8,1,0,0,'publicInfo');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(23,'单页',0,'info/info.php?s_type=info_d&s_img=0&s_add=0&s_del=0&s_check=0&s_ok=1&s_down=1&s_conj=0&s_content=1&title=单页','',2,1,16,0,'info_d');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(20,'文件管理',0,'','',9,1,0,0,'file');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(21,'评论管理',0,'','',10,1,0,0,'pl');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(25,'新闻添加',0,'news/a_do.php?s_type=news&s_img=0&s_add=1&s_del=1&s_check=1&s_ok=1&s_down=1&s_author=1&s_conj=0&s_content=1&s_f=2&title=新闻','',1,1,4,0,'news');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(26,'新闻管理',0,'news/a_list.php?s_type=news&s_img=0&s_add=1&s_del=1&s_check=1&s_ok=1&s_down=1&s_author=1&s_conj=0&s_content=1&s_f=2&title=新闻','',2,1,4,0,'news');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(27,'新闻分类',0,'news/a_class.php?s_type=a_class&s_img=0&s_add=1&s_del=1&s_check=1&s_ok=0&s_down=1&s_conj=0&s_content=1&s_next=2&title=新闻分类','',3,1,4,0,'news');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(28,'状态管理',0,'webconfig/status.php?cc=1','',2,1,58,0,'status');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(29,'订单管理',0,'products/orders_class.php?s_type=order_class&s_classtype=product&title=订单','',4,1,2,0,'orders');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(30,'QQ',0,'o_ad/o_ad.php?s_type=QQ&s_text=3&s_img=0&s_del=1&s_add=1&s_ok=0&title=QQ','',1,1,18,0,'publicinfo');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(31,'滚动图片',0,'o_ad/o_ad.php?s_type=turnpic&s_text=2&s_img=1&s_del=1&s_add=1&s_ok=1&title=滚动图片','',2,1,18,0,'publicinfo');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(32,'产品评论',0,'comment/comment.php?s_type=pro_con&s_classtype=product&tableName=p_main&s_reply=1&s_ok=1&title=产品','',1,1,21,0,'product');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(33,'新闻评论',0,'comment/comment.php?s_type=new_con&s_classtype=news&tableName=a_main&s_reply=0&s_ok=0&title=新闻','',2,1,21,0,'news');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(34,'产品订购',0,'products/pro_order.php?s_type=pro_order&s_classtype=product&tableName=p_main&s_ok=1&title=产品订购','',5,1,2,0,'pro_order');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(35,'留言管理',0,'comment/feedback.php?s_type=feedback&tableName=p_main&s_reply=1&s_ok=1&title=留言','',1,1,8,0,'feedback');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(36,'文件管理',0,'filesystem/file.php','',1,1,20,0,'file');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(37,'友情链接',2011,'o_ad/o_ad.php?s_type=link&s_text=2&s_img=1&s_del=1&s_add=1&s_ok=1&title=友情链接','',3,1,18,0,'publicinfo');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(38,'付款方式',2011,'products/orders_ps.php?s_type=pay&title=付款方式','',6,1,2,0,'pay');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(39,'送货方式',2011,'products/orders_ps.php?s_type=song&title=送货方式','',7,1,2,0,'song');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(40,'会员管理',2011,'usermain/userlist.php?s_type=user&title=会员管理','',1,1,7,0,'user');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(41,'会员添加',2011,'usermain/usercheck.php?s_type=user&title=会员添加','',2,1,7,0,'user');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(42,'状态管理',2011,'webconfig/status.php?cc=1&typevalue=product','',8,0,2,0,'z');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(43,'数据库管理',2011,'','',11,1,0,0,'data');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(58,'系统管理',2011,'','',0,1,0,0,'menu');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(44,'数据库管理',2011,'filesystem/database.php','',1,1,43,0,'data');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(45,'导入excel',2011,'','',4,1,0,0,'excel');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(46,'导入数据',2011,'excel/daoexcel.php?s_type=excel&title=导入excel','',1,1,45,0,'excel');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(47,'察看列表',2011,'excel/list.php?s_type=excel&s_ok=1&title=导入excel列表','',2,1,45,0,'excel');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(59,'登陆IP',2011,'','',3,1,58,0,'ipcount');
INSERT INTO s_menu_class(id,s_name,s_time,s_url,s_content,s_order,s_ok,parent_id,class_depth,s_type)VALUES 
(60,'备份文件',2011,'filesystem/databasefile.php','',2,1,43,0,'data');
