<?php 
//短信配置
$msg_config = array();

$msg_config['username'] = 'yeeux';
$msg_config['password'] = md5('Yeeux001');
$msg_config['send_url']  = 'http://api.smsbao.com/sms';
$msg_config['query_url']  = 'http://api.smsbao.com/query?u='.$msg_config['username'].'&p='.$msg_config['password'];
$msg_config['sign'] = '【海买客】';
//短信最长500字符..
//群发最多800个号..

$config['msg_config'] = $msg_config;
