<?php
//create a connection to database
$con=mysql_connect("localhost", "root", "");
if(!$con){
	die("Could not connect:".mysql_error());
}
else
{
	mysql_select_db("taskkloud", $con);
}
?>