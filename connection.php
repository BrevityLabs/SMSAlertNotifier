<?php

$connection = mysql_connect("localhost","root","")  ;
if (!$connection) {
	die("connection failed" . mysql_error());
} 
$database = mysql_select_db("rcs2012",$connection) or die("database connection failed");

?>
