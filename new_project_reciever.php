<?php 
if ($_SERVER['REQUEST_METHOD']== 'POST') {
	session_start();
	New_project::main();
}

class New_project
{
	public static function main(){
		$project_name = $_POST['new_project'];
		$new_project = new New_project;
		$project_new = $new_project->create_project($project_name);
		echo $project_new;
	}
	function create_project($project_name){
		require_once('my_model.php');
		$project_name_new = str_replace(' ', '_', $project_name);
		//$_SESSION['project'] = $project_name_new;
		$query = 'insert into projects (project_name,project_description,alotted_by,alotted_to)
		 values ("'.$project_name_new.'","sample description","si","")';
		insert_details($query);
		return $project_name_new;
	}
}
?>