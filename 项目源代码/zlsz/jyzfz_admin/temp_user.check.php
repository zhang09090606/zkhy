<?php
include( "../includes/init.php" );
$name = $_POST[ "param" ];
$arr = $Db->get_one( "user", "username='$name'" );

if ( $arr ) {
	echo "该用户名已被注册过";
} else {
	$json = '{"status":"y"}';
	echo $json;
}


?>