<?php
include( "../includes/init.php" );

	$id=$_POST['id'];
	$name=$_SESSION['zname'];
	
	$arr=$Db->get_one("meeting","id='$id'");
	$username=$arr['username'];
	$state='true';
	if($arr['type']=='private'){
		$state='false';	
		$Db->send("审核","待审核消息","员工姓名为".$name."申请加入您发起的会议","$username","$id");
	}else if($arr['type']=='protect'){
		$Db->send("普通","会议报名消息","员工姓名为".$name."报名您发起的会议","$username");
	}
		
	$name=$_SESSION['name'];
	$data = array(
		'meetingid' => $id,
		'username'=>$name,
		'isjoin'=>'false',
		'state'=>$state
	);

	$Db->insertdata( "meeting_peo", $data );
	
?>;