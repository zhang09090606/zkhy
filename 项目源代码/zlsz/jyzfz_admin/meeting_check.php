<?php
include( "../includes/init.php" );
$action = $_REQUEST[ 'action' ];
$url = "meeting.add.php";
$tablename = "meeting";
$surl = "meeting.inc.php";
$upurl = "upload/meeting";

switch ( $action ) {
	case "add";

	$officename = $_POST[ 'officename' ];
	$stime = $_POST[ 'stime' ];
	$ftime = $_POST[ 'ftime' ];
	$name = $_POST[ 'name' ];
	$num = $_POST[ 'num' ];
	$peo_name = $_POST[ 'peo_name' ];
	$state = $_POST[ 'state' ];



	$data = array(
		'officename' => $officename,
		'stime' => $stime,
		'ftime' => $ftime,
		'name' =>$name,
		'num' => $num,
		'username' => $peo_name,
		'state' => $state

	);
	$Db->insertdata( $tablename, $data );
	msg_url( "添加会议成功", $surl );
	break;

	case "del";
	$id = $_GET[ 'id' ];
	$Db->deletedata( $tablename, "id=$id" );
	msg_url( "删除会议成功", $surl );
	break;

	case "edit";
	$id = $_POST[ 'gid' ];
	$officename = $_POST[ 'officename' ];
	$stime = $_POST[ 'stime' ];
	$ftime = $_POST[ 'ftime' ];
	$name = $_POST[ 'name' ];
	$num = $_POST[ 'num' ];
	$peo_name = $_POST[ 'username' ];
	$state = $_POST[ 'state' ];
	$data = array(
		'officename' => $officename,
		'stime' => $stime,
		'ftime' => $ftime,
		'name' =>$name,
		'num' => $num,
		'username' => $peo_name,
		'state' => $state

	);
	$Db->updatedata( $tablename, $data, "id=$id" );
	msg_url( "修改会议信息成功", $surl );
	break;


}


?>