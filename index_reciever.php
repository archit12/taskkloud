<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	Index_reciever::main();
}
class Index_reciever{
	
	public static function main(){
		require_once 'my_model.php';
		$project = $_POST['delete_project'];
		$query = 'delete from projects where project_name like "'.$project.'"';
		insert_details($query);
	}
}
