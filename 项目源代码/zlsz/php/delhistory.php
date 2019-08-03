<?php
include( "../includes/init.php" );
$id=$_POST['id'];
$Db->deletedata( "meeting_peo", "id='$id'" );

?>