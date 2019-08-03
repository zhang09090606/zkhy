<?php
	include( "../includes/init.php" );
	$pic=$_FILES['pic'];
	$File = new Uploads_File($pic,"../upload/user");
	$username=$_POST['username'];
	$name=$_POST['name'];
	$job=$_POST['job'];
	$password=$_POST['password'];
	$pic="upload/user/".$File->new_file_name;
	$pic=str_replace("/","\\",$pic);
	$time=date('Y-m-d h:i:s', time());
	$data = array(
		'username' => $username,
		'pwd'=>$password,
		'name'=>$name,
		'pic'=>$pic,
		'job'=>$job,
		'datetime'=>$time
	);

	$Db->insertdata( "register", $data );
	//header("location:../login.html")?> 	
?>