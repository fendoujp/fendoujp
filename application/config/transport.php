<?php 

//物流信息查询配置文件
$transport = array();

//$transport['url'] = 'https://api.yi-ex.com/track?cc=';
$transport['url'] = 'http://lab.yi-ex.com:81/track?cc=';
$transport['company'] = 'haimaike';
$transport['error'] = 'EWE服务器无响应';//错误提示





$config['transport'] = $transport;
