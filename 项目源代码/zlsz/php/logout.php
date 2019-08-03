<?php
	include( "../includes/init.php" );

	unset( $_SESSION );
	session_destroy(); //清空所有session
?>