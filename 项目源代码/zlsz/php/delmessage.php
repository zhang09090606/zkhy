<?php
include( "../includes/init.php" );
$id=$_POST['id'];
$Db->deletedata( "message", "id='$id'" );

?>