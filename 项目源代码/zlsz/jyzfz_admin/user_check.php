<?php
include( "../includes/init.php" );
$action = $_REQUEST[ 'action' ];
$add_url = "user.add.php";
$upurl = "upload/user";
switch ( $action ) {
	case "add";
		$username = $_POST[ 'username' ];
		$uid=$_POST['uid'];
		$pwd = $_POST[ 'pwd' ];
		$job = $_POST[ 'job' ];
		$name = $_POST[ 'name' ];
		$file = new Uploads_File( $_FILES[ 'file' ], "../".$upurl );
		$newname=$file->new_file_name;
		$pic = $upurl . "/" . $newname;
		$data = array(
			'uid' => $uid,
			'username' => $username,
			'pwd' => $pwd,
			'job' => $job,
			'name' => $name,
			'pic' => $pic,
			'state' =>"false",
			"isfree"=>"true"
		);
	$Db->insertdata( "user", $data );
	msg_url( "添加成功", "user.inc.php" );
	break;

	case "del";
	$id = $_GET[ 'id' ];
	$Db->deletedata( "user", "id=$id" );
	msg_url( "删除成功", "user.inc.php" );
	break;
	case "edit";
		$id=$_POST['gid'];
		$username = $_POST[ 'username' ];
		$uid=$_POST['uid'];
		$pwd = $_POST[ 'pwd' ];
		$job = $_POST[ 'job' ];
		$name = $_POST[ 'name' ];
		$file = new Uploads_File( $_FILES[ 'file' ], "../".$upurl );
		$newname=$file->new_file_name;
		$pic = $upurl . "/" . $newname;
		$data = array(
			'uid' => $uid,
			'username' => $username,
			'pwd' => $pwd,
			'job' => $job,
			'name' => $name,
			'pic' => $pic,
			'state' =>"false",
			"isfree"=>"true"
		 );
		$Db->updatedata( "user", $data, "id=$id" );
		msg_url( "修改成功", "user.inc.php" );
		break;
}