<?php
// +--------------------------------------------
// | 文章详细页控制器
// | author:LMing
// +--------------------------------------------

$t = gets('t');
if(empty($t)) $t = 'index';
$id = gets('id');

switch($t){
  case 'photo':
    update_hits('photo',$id); //更新点击数

    $sql = "select * from p_main where id=".$id."";
    $photo = getLiAll($sql);
    $photo_view = $photo[0];

    $class_id = $photo_view['classid'];
    $class_first = 0; //一级栏目

    // 递归查找一级栏目
    $cid = 0;
    function class_first($id){
      global $cid;
      $r = class_info($id);
      if($r['class_depth']>1){
        class_first($r['parent_id']);
      }else{
        $cid = $id;
      }
      return $cid;
    }

    $class_data = class_info($class_id);
    if($class_data['class_depth']==1){
      $class_first = $class_id;
    }elseif($class_data['class_depth']>1){
      $class_first = class_first($class_id);
    }

    if(!empty($photo_view['s_name'])) $webinfo['s_name'] = $photo_view['s_name'];
    if(!empty($photo_view['s_keywords'])) $webinfo['s_keywords'] = $photo_view['s_keywords'];
    if(!empty($photo_view['s_description'])) $webinfo['s_description'] = $photo_view['s_description'];

    include(TPL_PATH."head.php");
    include(TPL_PATH."photo_view.php");
    include(TPL_PATH."foot.php");
  break;
  case 'news':
    update_hits('news',$id); //更新点击数

    $sql = "select * from a_main where id=".$id."";
    $news = getLiAll($sql);
    $news_view = $news[0];

    $class_id = $news_view['classid'];
    $class_first = 0; //一级栏目

    // 递归查找一级栏目
    $cid = 0;
    function class_first($id){
      global $cid;
      $r = class_info($id);
      if($r['class_depth']>1){
        class_first($r['parent_id']);
      }else{
        $cid = $id;
      }
      return $cid;
    }

    $class_data = class_info($class_id);
    if($class_data['class_depth']==1){
      $class_first = $class_id;
    }elseif($class_data['class_depth']>1){
      $class_first = class_first($class_id);
    }

    if(!empty($news_view['s_name'])) $webinfo['s_name'] = $news_view['s_name'];
    if(!empty($news_view['s_keywords'])) $webinfo['s_keywords'] = $news_view['s_keywords'];
    if(!empty($news_view['s_description'])) $webinfo['s_description'] = $news_view['s_description'];

    include(TPL_PATH."head.php");
    include(TPL_PATH."news_view.php");
    include(TPL_PATH."foot.php");
  break;
  case 'school':
    $sql = "select * from a_main where id=".$id."";
    $school = getLiAll($sql);
    $school_view = $school[0];

    $class_id = $school_view['classid'];
    $class_first = 0; //一级栏目

    // 递归查找一级栏目
    $cid = 0;
    function class_first($id){
      global $cid;
      $r = class_info($id);
      if($r['class_depth']>1){
        class_first($r['parent_id']);
      }else{
        $cid = $id;
      }
      return $cid;
    }

    $class_data = class_info($class_id);
    if($class_data['class_depth']==1){
      $class_first = $class_id;
    }elseif($class_data['class_depth']>1){
      $class_first = class_first($class_id);
    }

    if(!empty($school_view['s_name'])) $webinfo['s_name'] = $school_view['s_name'];
    if(!empty($school_view['s_keywords'])) $webinfo['s_keywords'] = $school_view['s_keywords'];
    if(!empty($school_view['s_description'])) $webinfo['s_description'] = $school_view['s_description'];

    include(TPL_PATH."head.php");
    include(TPL_PATH."school_view.php");
    include(TPL_PATH."foot.php");
  break;
}
?>