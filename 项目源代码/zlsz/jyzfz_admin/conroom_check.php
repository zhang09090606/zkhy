<?php
include( "../includes/init.php" );
$action = $_REQUEST[ 'action' ];
$url = "conroom.add.php";
$tablename = "conroom";
$surl = "conroom.inc.php";
$upurl = "upload/conroom";

switch ( $action ) {
	case "add";
	$file = new Uploads_File( $_FILES[ 'file' ], "../".$upurl );
	$name = $_POST[ 'name' ];
	$add = $_POST[ 'add' ];
	$con = $_POST[ 'con' ];
	$inf = $_POST[ 'inf' ];
	$newname=$file->new_file_name;
	$pic = $upurl . "/" . $newname;
	$date = $Db->dates();


	$data = array(
		'name' => $name,
		'con' => $con,
		'inf' => $inf,
		'isfree' =>"false",
		'pic' => $pic,
		'add' => $add,

	);
	$Db->insertdata( $tablename, $data );
	msg_url( "添加会议室成功", $surl );
	break;

	case "del";
	$id = $_GET[ 'id' ];
	$Db->deletedata( $tablename, "id=$id" );
	msg_url( "删除会议室成功", $surl );
	break;

	case "edit";
	$id = $_POST[ 'gid' ];
	$file = new Uploads_File( $_FILES[ 'file' ], "../".$upurl );
	$name = $_POST[ 'name' ];
	$con = $_POST[ 'con' ];
	$inf = $_POST[ 'inf' ];
	$newname=$file->new_file_name;
	$pic = $upurl . "/" . $newname;
	$date = $Db->dates();


	$data = array(
		'name' => $name,
		'con' => $con,
		'inf' => $inf,
		'isfree' =>"false",
		'pic' => $pic,

	);
	$Db->updatedata( $tablename, $data, "id=$id" );
	msg_url( "修改会议室成功", $surl );
	break;


}


?>