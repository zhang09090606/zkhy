<?php
include( "../includes/init.php" );
		
	$state=$_POST['state'];
	$id=$_POST['id'];
	
	if($state=='signup'){
		$name=$_SESSION['name'];
		$arr=$Db->get_one("meeting_peo","id='$id'");
		$meetingid=$arr['meetingid'];
		$arr0=$Db->get_one("meeting","id='$meetingid'");
		
		if($arr['state']=="false"){
			$Db->deletedata( "message", "send_peo='$name' and meetingid='$meetingid'" );
		}else{
			$Db->send("普通","报名取消消息",$name."取消了".$arr0['name']."会议报名",$arr0['username']);
		}
		$Db->deletedata( "meeting_peo", "id=$id" );
	}else if($state='meeting'){
		echo $id;
		$arr=$Db->get_all("meeting_peo","meetingid='$id'");
		for($i=0;$i<sizeof($arr);$i++){
			$arr0=$Db->get_one("meeting","id='$id'");
			$Db->send("普通","会议取消消息","会议名称为".$arr0['name']."会议已取消,请相互告知","".$arr[$i]['username']);
			$peoid=$arr[$i]['id'];
			$Db->deletedata( "meeting_peo", "meetingid='$id'" );
		}
		$Db->deletedata( "meeting", "id=$id" );
	}
	
?>;