<?php

 	function send($type,$title,$con,$name){

		$data = array(
			'type'=>$type,
			'con'=>$con,
			'title'=>$title,
			'user'=>$name,
			'time'=>date('Y-m-d h:i:s', time()),
			'state'=>'false'
			
		);
		$Db->insertdata( "message", $data );

	}

?>