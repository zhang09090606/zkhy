<?php
include( "../includes/init.php" );
	$id=$_POST['id'];
	$sendpeo=$_POST['sendpeo'];

	$arr=$Db->get_one("meeting","id='$id'");
	
	$name=$arr['name'];
	$zname=$_SESSION['zname'];
	$nameu=$_SESSION['name'];
	$Db->deletedata( "meeting_peo", "meetingid=$id" );
	$Db->send("普通","会议报名失败","您报名的会议名称为".$name."报名未被通过","$sendpeo");
	$Db->deletedata( "message", "send_peo='$sendpeo' and meetingid='$id'" );
?>;