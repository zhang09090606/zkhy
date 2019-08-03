<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
</head>
 	
<body>
<?php
$pic="\\xampp\\htdocs\\zlsz\\upload\\user\\15438095208003720181203.jpeg";
$sum=shell_exec('\xampp\htdocs\zlsz\python\hello.py '.$pic);
echo($sum);

?>

</body>
</html>