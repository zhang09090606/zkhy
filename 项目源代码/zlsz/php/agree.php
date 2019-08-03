<?php
include( "../includes/init.php" );
	$id=$_POST['id'];
	$sendpeo=$_POST['sendpeo'];
	$data = array(
		'state' => "true",
	);
	$arr=$Db->get_one("meeting","id='$id'");	
	$name=$arr['name'];
	$zname=$_SESSION['zname'];
	$nameu=$_SESSION['name'];
	$Db->updatedata( "meeting_peo", $data, "meetingid=$id" );
	$Db->send("普通","会议报名成功","您报名的会议名称为".$name."已成功报名","$sendpeo");
	$Db->send("普通","会议报名信息",$zname."成功报名会议名称为".$name."的会议","$nameu");
	$Db->deletedata( "message", "send_peo='$sendpeo' and meetingid='$id'" );
?>;