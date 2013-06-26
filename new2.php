<?php
	session_start();
	if(!isset($_SESSION["logged"])){
		echo "you cant access this directory";
		die();
	}
?>
 <?php $con=mysql_connect("localhost","root");
        if(!$con)
			echo "failed";
        $db_select=mysql_select_db("taskkloud",$con);
        if(!$db_select)
			echo ("not working".mysql_error());
?>
<?php if(isset($_POST['user']))
		{
			$name=$_POST['user'];
			if($name!="")
			{	$query1="insert into `usernames`(`user_name`) values('$name')";
				$res1=mysql_query($query1,$con);
				if($res1)
				{
					header('Location: main.php');
				}
				else
				{
					echo mysql_error();
				}
			}
			else
				echo "enter values";
		}
		else
			{
			//echo "not posted";
			}
?>
<?php
			include("class.phpmailer.php");
		//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

		$mail             = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
		$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
		$mail->Username   = "taskkloud@gmail.com";  // GMAIL username
		$mail->Password   = "discodancer";            // GMAIL password
		//$mail->AddReplyTo("yourusername@gmail.com","First Last");
		$mail->From       = "taskkloud@gmail.com";
		/**/
		if(empty($_POST['task']))
			{
				echo"";
			}
		else if(empty($_POST['givetaskto']))	
			{
				echo"please select to whom task is to b given";
			}
		else if(empty($_POST['from']))
		{
			echo"please select who is giving task";
		}
			else
			{	if(isset($_POST['entertask']))
				{$task=$_POST['task'];
				$giventaskto=$_POST['givetaskto'];
				$from=$_POST['from'];
				
				$mail->FromName   = "$from";
				$mail->Subject    = "Task From THE TASK-KLOUD";
				$mail->MsgHTML($task);
				$mail->AddAddress("afaqalam.4@gmail.com", "Afaq");
				$mail->WordWrap   = 50; 
				$mail->IsHTML(true); // send as HTML
				if(!$mail->Send()) {
				  echo "Mailer Error: " . $mail->ErrorInfo;
				} else {
				  echo "Message sent!";
				}
				
				if($task=="")
					echo "";
				else
					{
						$query3="insert into `tasks`(`taskname`, `taskto`,`task_from`) values('$task', '$giventaskto', '$from')";
						$res3=mysql_query($query3,$con);
						if(!($res3))
							echo "Not inserted";
						else
						header('location: main.php');
					}
			}}
?>
<?php
	if(isset($_POST['Done']))
	{$query6="select * from `tasks`";
	$res6=mysql_query($query6,$con);
	while($row6=mysql_fetch_array($res6))
	{
		$check=$row6[0];
		if(isset($_POST[$check]))
		{
			$query7="UPDATE  `taskkloud`.`tasks` SET  `done` =  '1' WHERE  `tasks`.`id` ='$check'";
			$res=mysql_query($query7,$con);
			if($res)
			header('location:main.php');
			else
			echo mysql_error();
		}
		else header('location:main.php');
	}
	}
	
?>
<?php 
/*
$query8="select `user_id` from `usernames`";
$res8=mysql_query($query8,$con);
while($rows8=mysql_fetch_array($res8))
{
$check2=$rows8[0];
if(isset($_POST[$check2]))
{
$query9="UPDATE `taskkloud`.`usernames` SET `user_exists` = '0' WHERE `usernames`.`user_id` ='$check2'";
$res9=mysql_query($query9,$con);
if($res9)
header('location:index.php');
}
}
*/
?>
<?php if(isset($_POST['feeds']))
{
	if(isset($_POST['livefeeder']) && ($_POST['livefeeder']!=""))
	{
		$feeds=$_POST['livefeeder'];
		$query24="insert into `feeds`(`feeds`) values ('$feeds')";
		$res24=mysql_query($query24,$con);
		if($res24)
		{
			header('location:main.php');
		}
	}
	else
	echo "Plz enter feeds";
}
	
	if(isset($_POST['movies']))
{
	if(isset($_POST['livefeeder']) && ($_POST['livefeeder']!=""))
	{
		$movies=$_POST['livefeeder'];
		$query45="insert into `movies`(`movies`) values ('$movies')";
		$res45=mysql_query($query45,$con);
		if($res45)
		{
			header('location:main.php');
		}
	}
	
	
}
?>
