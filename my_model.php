<?php
//connect to database
require_once('db_connect.php');

//function suited to affecting database
function insert_details($query){
	if($query!='')
		$result = mysql_query($query);
}

//function suited to retrieving from databse
function return_details($query){
	if($query!=''){
		$result = mysql_query($query);
		return $result;
	}
	else{
		$result='';
		return $result;
	}
}
?>