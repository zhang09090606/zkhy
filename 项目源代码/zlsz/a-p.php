<?php
include( "includes/init.php" );
header('Content-Type:text/html;charset=utf-8');
$arr = $Db->get_all( "user", "is_resiger='false'");
$array = [];
$time=0;
foreach($arr as $row){
	$time=$time+1;
	$array["$time"]=str_replace("\\","/",$row['pic']);
	$array["name"."$time"]=$row['name'];
	
}
//$data = array(
//			'is_resiger' => "true",
//		 );
//	$Db->updatedata( "user", $data, "is_resiger='false'" );
	echo json_encode($array); 
?>