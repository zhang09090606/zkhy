<?php
include( "includes/init.php" );
$name = $_POST[ 'name' ];
$pwd = $_POST[ 'pwd' ];

$arr=$Db->get_all("user","username='$name'");

if(is_null($arr)){
	echo $arr;
}else{

	if($arr[0]['pwd']==$pwd){
		$_SESSION['name'] = $name;
		$_SESSION['job']=$arr[0]['job'];
		$_SESSION['zname']=$arr[0]['name'];
		echo 1;
	}else{
		echo 0;
	}
}
	
?>