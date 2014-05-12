<?php
// +--------------------------------------------
// | 前台入口文件
// | author:LMing
// +--------------------------------------------

ob_start();
session_start();
include("inc/publicfunction.php");
include("inc/functions.php");
include("inc/turepage.php");
include("webfrontconfig.php");

define("S_ROOT",dirname(__FILE__)."/"); //根目录
define("ACT_PATH",S_ROOT."cn/action/"); //控制器目录
define("TPL_PATH",S_ROOT."cn/tpl/"); //模板目录

// 网站基本信息
$web_arr = getLiAll("select * from web_config where s_language=1");
$webinfo = $web_arr[0];

$a = gets('a');
if(empty($a)) $a = 'index'; //默认控制器
include(ACT_PATH.$a."_c.php"); //加载控制器
?>