<?php
include( "../includes/init.php" );
$action = $_REQUEST[ 'action' ];
$add_url = "user.add.php";
$upurl = "upload/user";
switch ( $action ) {
	case "yes";
		$id = $_GET[ 'id' ];
		$row=$Db->get_one("register","id=$id");
		$data = array(
			'username' => $row['username'],
			'pwd' => $row['pwd'],
			'job' => $row['job'],
			'name' => $row['name'],
			'pic' => $row['pic'],
			'state' =>"false",
			"isfree"=>"true"
		 );
		$Db->insertdata( "user", $data );
		$Db->deletedata( "register", "id=$id" );
		msg_url( "操作成功", "temp_user.inc.php" );
	break;

	case "no";
	$id = $_GET[ 'id' ];
	$Db->deletedata( "register", "id=$id" );
	msg_url( "操作成功", "temp_user.inc.php" );
	break;
	case "edit";
		$id=$_POST['gid'];
		$username = $_POST[ 'username' ];
		$uid=$_POST['uid'];
		$pwd = $_POST[ 'pwd' ];
		$job = $_POST[ 'job' ];
		$name = $_POST[ 'name' ];
		
		$data = array(
			'uid' => $uid,
			'username' => $username,
			'pwd' => $pwd,
			'job' => $job,
			'name' => $name,
			'state' =>"false",
			"isfree"=>"true"
		 );
		$Db->updatedata( "user", $data, "id=$id" );
		msg_url( "修改成功", "user.inc.php" );
		break;
}