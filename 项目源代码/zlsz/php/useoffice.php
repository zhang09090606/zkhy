<?php
include( "../includes/init.php" );

	$id=$_POST['id'];
	$mname=$_POST['mname'];
	$mnum=$_POST['mnum'];
	$mtype=$_POST['mtype'];
	$stime=$_POST['stime'];
	$ftime=$_POST["ftime"];
	$mcon=$_POST['mcon'];
	$name=$_SESSION['name'];
	$data = array(
		'isfree' => "false",

	);
	
	$Db->updatedata( "conroom", $data, "id=$id" );
	$arr=$Db->get_one("conroom","id=$id");	
	$add=$arr['add'];
	$data = array(
		'stime' => $stime,
		'ftime' => $ftime,
		'inf' => $mcon,
		'num' =>$mnum,
		'username' => $name,
		'state'=>'free',
		'name'=>$mname,
		'officeid'=>$id,
		'type'=>$mtype,
		'add'=>$add
	);
	$Db->insertdata( "meeting", $data );

	$count=$Db->query("SELECT * FROM hy_meeting ORDER BY id DESC LIMIT 0,1");
	$row = $Db->fetch($count);
	$meetingid=$row['id'];
	

	$data = array(
		'meetingid'=>$meetingid,
		'username'=>$name,
		'isjoin'=>'false',
		'state'=>'true'
	);
	$Db->insertdata( "meeting_peo", $data );
	
?>;