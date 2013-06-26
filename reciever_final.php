<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	session_start();
	//set session variable members
	$_SESSION['members'] = $_POST['members_selected'];
	Reciever_final::main();
}
else
	echo "Not Permitted to view this page!";

class Reciever_final
{
	public static function main(){
		require_once('my_model.php');
		require_once('lib/shat/send.php');
		
		$project_name = $_SESSION['project'];
		$project_description = $_POST['description'];
		$members_notselected = $_POST['members_notselected'];
		$alotter = $_POST['alotted_by'];
		$reciever_final = new Reciever_final;
		$statement = '';
		
		//arrays containing added membrs and non-added members respectively
		//removing the last extra semi colon
		$names = substr($_SESSION['members'], 0,-1);
		$names = explode(';', $names);
		$names1 = explode(';', $members_notselected);
		
		$statement = $reciever_final->update_members($names, $project_name, $project_description, $names1, $alotter);
		$reciever_final->send_mail($names, $project_name, $project_description, $alotter);
		echo $statement;
	}
	function update_members($names, $project_name, $project_description, $names1, $alotter){
		
		foreach ($names as $name) {
			//select the member if he already has the given project
			$query = 'SELECT distinct alotted_to from projects
			where project_name like "'.$project_name.'" and alotted_to like "'.$name.'"';
			$result = return_details($query);
			//check if the member exists or not
			if(!mysql_num_rows($result)){
				//if member doesn't exist insert member
				$query = 'INSERT into projects 
						(project_name,project_description,alotted_by,alotted_to)
				values ("'.$project_name.'","'.$project_description.'","'.$alotter.'","'.$name.'")';
				insert_details($query);
			}
		}
		
		foreach ($names1 as $name1) {
			//delete all those members who are present on the nonaddded_members list and still have the project assigned to them
			$query = 'DELETE from projects where project_name like "'.$project_name.'" 
					AND alotted_to like "'.$name1.'"';
			insert_details($query);
		}
	}
	
	//send mail to all added members
	function send_mail($names, $project_name, $project_description,$alotter){
		$subj = "Task Kloud";
		include("lib/shat/class.phpmailer.php");
		foreach ($names as $name) {

			$message = "Dear <b>".$name.", </b> <br/> You have been assigned a project by <b> $alotter </b> .
					<br/> <b> Details of Project: </b> <br/> Project name: <b> "
					.$project_name." </b> <br/> <b> Project Description: </b> <br/> ".$project_description;

			$query = 'select email from members where name like "'.$name.'"';
			//echo $query;
			$result = return_details($query);
			$row=mysql_fetch_array($result);

			$address = $row['email'];
		//require_once("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
			$mail             = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
			$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
			$mail->Username   = "nettypider@gmail.com";  // GMAIL username, consider changing
			$mail->Password   = "lightaaegi";            // GMAIL password, consider changing
			$mail->AddReplyTo("nettypider@gmail.com","First Last");
			$mail->From       = "nettypider@gmail.com";//email id of PDF_set_text_rendering()
			$mail->CharSet    = "utf-8";
			
			
					$mail->FromName   = "TaskKloud";
					$mail->Subject    = $subj;
					$mail->Body = $message;
					
					$mail->AddAddress($address, "SI");
					$mail->WordWrap   = 50; 
					$mail->IsHTML(true); // send as HTML
					if(!$mail->Send()) 
					{
						echo "Mails not sent";
					}
					else{
						echo "sent";
					} 
			PHPMailer::ClearAllRecipients();
		}
	}
}
?>