<?php 
//connect database
require_once('my_model.php');
//define page structure
require_once('structure.php');

Project::main();

class Project{
	
	var $self;
	var $existing;
	var $new;

	function __construct(){
		//initialise members
		$self = $_SERVER['PHP_SELF'];
		$existing = NULL;
		$new = NULL;
	}
	public static function main(){

		$project = new Project();	//Object of Project class
		$structure = new Structure;	//Object of Structure class

		//checking the form requested
		if(isset($_POST['existing']))
			$existing = $_POST['existing'];
		if(isset($_POST['new']))
			$new = $_POST['new'];
		//wrapper division
		echo '<div id="wrapper">';
		//displaying the header
		$structure->display_header();
		echo '<div id="inner_wrapper">';
		//displaying the body
		$structure->display_body();
		//displaying choice buttons
		echo '<div id="upper_container">';
		$project->choose();
		
		//pipeline division to show existing projects
		//$project->show_pipeline();
		
		//calling the required form according to the choice
		if(isset($new)){
			$project->new_project_form();
		}
		else if(isset($existing)){
			$project->existing_project_form();
		}
		echo '</div>';
		//call structure function
		$project->display_structure();
		//end of inner wrapper
		echo '</div>';
		//displaying the footer
		$structure->display_footer();
		//end of wrapper division
		echo '</div>';
	}

	//empty divisions for containing member lists and messages
	function display_structure(){
		$statement = '';
		$statement .= '<div id="container_list"><div id="message_division"></div></div>';
		echo $statement;
	}

	//choose from updating a project or creating a new one
	function choose(){
		$statement = '';
		$statement .= '<form action="project.php" method="post">
			<input type="hidden" name="new" value="new" />
			<input type="submit" class="buttons" id="new_project" value="Create New Project" />
			</form>';
		$statement .='<form action="project.php" method="post">
			<input type="hidden" name="existing" value="existing" />
			<input type="submit" class="buttons" id="existing_project" value="update existing project" />
			</form>';
		echo $statement;
	}

	//display the project name form
	function new_project_form(){
		$statement = '';
		$statement .= '<form id="project_creator">
			<label>Project Name</br>
			<input id="project_name" type="text" /></label>
			<input id="new_project_submit" class="buttons" type="button" value="Create Project"
			 onclick=post_project_name("new_project_submit") />
			</form>';
		echo $statement;
	}

	//display the drop down menu of existing projects
	function existing_project_form(){
		$statement = '';
		$statement .= '<form id="project_selector">';
		$statement .= '<select id="select_project">';

		//select all project names existing in the database
		$query = 'select distinct project_name from projects';
		$result = return_details($query);

		//display pre-existing projects in list
		while($row = mysql_fetch_array($result)){
			$statement .='<option>';
			$statement .= $row['project_name'];
			$statement .= '</option>';
		}
		$statement .= '</select>';
		$statement .= '<input type="button" class="buttons" id="submit_project"
		 onclick=post_project_name("submit_project") value="Submit Project" />
			</form>';
		echo $statement;
	}

	//display pipeline division for ongoing projects
	function show_pipeline(){
		$statement = '';
		$statement .= '<div id="pipeline_header">OnGoing Projects</div>';
		$statement .= '<div id="pipeline">';	//pipeline division
		$query = 'select distinct project_name from projects';
		$result = return_details($query);
		$i=0;
		while($row=mysql_fetch_array($result)){
			$project = $row['project_name'];
			$query_new = 'select distinct alotted_to from projects
					 where project_name like "'.$project.'"';
			$result_new = return_details($query_new);
			$statement .= '<div class="project_div" id="'.$i.'" onmouseover=enlarge("'.$i.'") 
					onmouseout=revert("'.$i.'")>';
			$i++;
			$statement .= $row['project_name'];
			$statement .= '<hr class="hr_line">';
			//$statement .= '<div class="member_container_enlarge">';
			while($row_new=mysql_fetch_array($result_new)){
				$statement .='<span class="member_names">'.$row_new['alotted_to'].'</span>';
			}
			//$statement .= '</div>';		//end of member_container_enlarge division
			$statement .= '</div>';		//end of project_div division
		}
		$statement .= '</div>';		//end of pipeline division
		echo $statement;
	}

}

?>