<?php
include 'new2.php';?>
<?php 
require_once 'my_model.php';
Index::main();

class Index{
	
	public static function main(){

		$index = new Index;	//Object of Index class

		//wrapper division
		echo '<div id="wrapper">';
		$statement = '';
		$statement .= '<title>Task Kloud</title>';
		$statement .= '<head><div id="headerw"><div id="header"><img src="images/header.jpg" /></div>';
		$statement .= '</div>';
		$statement .= '<script type="text/javascript" src="js//jquery-1.9.0.min.js"></script>';
		$statement .= '<script type="text/javascript" src="js//myscript.js"></script>';
		//subModal libraries
		$statement .= '<script type="text/javascript" src="lib/subModal-1.6/common.js"></script>';
		$statement .= '<script type="text/javascript" src="lib/subModal-1.6/subModal.js"></script>';
		$statement .= '<link rel="stylesheet" type="text/css" href="lib/subModal-1.6/subModal.css" />';
		//stylesheet for this page
		$statement .= '<link rel="stylesheet" href="css//indexstyle.css" type="text/css">';
		$statement .= '</head>';
		echo $statement;
		echo '<div  style="background:#CC334D;width:150px;margin-top:4px;height:35px;float:right;color:white">
       <span id="project" style="font-size:24px;cursor:pointer;margin:15px 10px 10px 15px;padding:20px">Tasks </span>
        <div id="proj_desc" style="display:none;padding:5px;background:#CC334D;font-size:14px;">Click To Know about Tasks assigned to you and other members</div>
    </div>';
		echo '<div id="inner_wrapper">';
		
		$statement = '';
		$statement .= '<body>';
		echo $statement;
		
		$statement = '';
		$statement .= '<div id="container_list">';
		echo $statement;
		
		$statement = '';
		$statement .= '<div id="big_button_division">';
		$statement .= '<input type="button" id="big_button" class="buttons" value="Add/Modify Projects" onclick="getLightBox()">';
		$statement .= '<hr>';
		
		echo $statement;
		//pipeline division to show existing projects
		$index->show_pipeline();
		//end of container_list
		echo '</div>';
		//end of inner wrapper
		echo '</div>';
		$statement = '';
		$statement .= '</body>';
		//$statement .= '<div id="footer">Powered By: Software Incubator</div>';
		echo $statement;
		//end of wrapper division
		echo '</div>';
        echo '<div id="footer">Powered By: Software Incubator</div>';
	}

	//display pipeline division for ongoing projects
	function show_pipeline(){
		$statement = '';
		$statement .= '<div id="pipeline_header">OnGoing Projects</div>';
		$statement .= '<div id="pipeline">';	//pipeline division
		$query = 'select distinct project_name from projects order by project_id desc';
		$result = return_details($query);
		$i=0;
		$names=0;
		$names_per_line=3;
		//loop through project names
		while($row=mysql_fetch_array($result)){
			$project = $row['project_name'];
			
			$query_new = 'select distinct alotted_to from projects
					 where project_name like "'.$project.'"';
			$result_new = return_details($query_new);
			$statement .= '<div class="project_div" id="'.$i.'">
					<div class="close" 
					id="'.$project.'" onclick=delete_project("'.$project.'")><img src="images/close.gif"></div>';
			$i++;
			$statement .= $row['project_name'];
			$statement .= '<hr class="hr_line">';
			//$statement .= '<div class="member_container_enlarge">';
			//loop through members assigned to each project
			while($row_new=mysql_fetch_array($result_new)){
				$names++;
				/*if($names>$names_per_line){
					$statement .= '</br>';
					$names = 0;
				}*/
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