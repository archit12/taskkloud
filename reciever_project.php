<?php
if($_SERVER['REQUEST_METHOD']== 'POST'){
	session_start();
	if(isset($_POST['project_name'])){
		//set session variable project
		$_SESSION['project'] = $_POST['project_name'];
		Reciever_project::main();
	}
}

class Reciever_project
{
	public static function main(){
		require_once('my_model.php');
		
		$project_name = $_SESSION['project'];
		$reciever_project = new Reciever_project;
		$statement = '';
		
		//select project description of the required project
		$query = 'select distinct project_description from projects
				 where project_name like "'.$project_name.'"';
		$result = return_details($query);
		$row = mysql_fetch_array($result);
		
		//display project description as a text area
		//$statement .= "<hr>";
		/*function call tp display list of alotters*/
		$statement .= $reciever_project->display_alotters();
		$statement .= '<label class="description_class"></br>Project Description</br>
				<textarea id="project_description" cols="17" onclick="clear_it()">'.$row[0].'</textarea></label><br/><br/>';
		$statement .= "<hr>";
		$statement .= '<table id="headings"><tr><td class="column">Members Available</td><td class="column" style="text-align:right;" >Members Added</td></tr></table>';
		$statement = $reciever_project->display_nonexisting_members($statement,$project_name);
		$statement = $reciever_project->display_added_members($statement, $project_name);
		echo $statement;
	}

	//display drop down menu, showing names of members who can alott projects i.e. all members
	function display_alotters(){
		$statement = '';
		$statement .= '<label class="alotted_by_class">Your name</label></br>';
		$statement .= '<select id="alotted_by">';
		$query = 'SELECT name from members';
		$result = return_details($query);
		while($row=mysql_fetch_array($result)){
			$statement .= '<option>'.$row['name'].'</option>';
		}
		$statement .= '</select>';
		return $statement;
	}

	//display all members not added in the project
	function display_nonexisting_members($statement,$project_name){
		
		$statement .= '<select id="select_members" size="10" multiple="multiple">';
		//subquery: select all those members which have been added in the project
		$query = 'select distinct alotted_to from projects
				 where project_name like "'.$project_name.'"';
		$result = return_details($query);
		
		//generate query to select names which are not like names resulted from the above subquery
		$query = 'select name from members where name not like ';
		while($row=mysql_fetch_array($result)){
			$query .= '"'.$row['alotted_to'].'"';
			$query .= ' and name not like ';
		}
		$last = strrpos($query," and name not like ");
		$query = substr($query, 0,$last);
		$result = return_details($query);
		
		while($row=mysql_fetch_array($result)){
			$statement .='<option>';
			$statement .= $row['name'];
			$statement .= '</option>';
		}
		$statement .= '</select>';
		$statement .= '<input type="button" class="buttons" id="add_button" value="+" onclick="add_members()" />';
		$statement .= '<input type="button" class="buttons" id="remove_button" value=" - " onclick="remove_members()" />';
		$statement .= '<input type="button" class="buttons" id="submit_final" value="Proceed" onclick="final_submit()" />';
		return $statement;
	}

	//display members added in the project
	//recieves data from function post_project_name()
	function display_added_members($statement, $project_name){
		$statement .= '<select id="project_members" size="10" multiple="multiple">';

		//show names which have been added to the project
		$query = 'SELECT distinct alotted_to from projects where project_name like "'.$project_name.'"';
		$result = return_details($query);

		while($row = mysql_fetch_array($result)){
			if($row['alotted_to']!=NULL){
				$statement .='<option>';
				$statement .= $row['alotted_to'];
				$statement .= '</option>';
			}
		}
		$statement .= '</select>';
		$statement .= '<hr>';
		return $statement;
	}
}
?>