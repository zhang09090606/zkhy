<?php
include("../includes/init.php");

$action = $_REQUEST['action'];

$url = "news.add.php";
$surl = "news.inc.php";
switch($action)
{
    case"add";
        msg_url("发送成功","news.add.php");
        break;

    case"del";
         $id = $_GET['id'];
         $Db->deletedata("news","id=$id");
        msg_url("删除成功","news.inc.php");
        break;

    case"edit";
        $id = $_POST['gid'];
        $cid = $Db->check_str($_POST['cid'],"请选择一个栏目名称",$url);
        $row = $Db->get_one("class","id=$cid","classname");
        $cname = $row[0];
        $title = $Db->check_str($_POST['title'],"标题不能为空",$url);
        $author = $Db->check_str($_POST['author'],"作者不能为空",$url);
        $picurl = $_POST['picurl'];
        $content = $_POST['content'];
        $datas = array(
            'cid'=>$cid,
            'cname'=>$cname,
            'title'=>$title,
            'author'=>$author,
            'picurl'=>$picurl,
            'content'=>$content
        );
       $Db->updatedata("news",$datas,"id=$id");
        msg_url("修改成功","news.inc.php");
        break;
	case"del_all";		
		$ids = implode(",",$_POST['id']);		
		$sql = $Db->deletedata("news","id in($ids)");
		msg_url("删除成功","news.inc.php");
		
	break;

}