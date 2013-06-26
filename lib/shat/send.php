<?php
function sendmail($from,$address,$message,$subj)
{
		
			
		include("class.phpmailer.php");
		//require_once("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
		$mail             = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
		$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
		$mail->Username   = "nettypider@gmail.com";  // GMAIL username
		$mail->Password   = "lightaaegi";            // GMAIL password
		$mail->AddReplyTo("nettypider@gmail.com","First Last");
		$mail->From       = $from;//email id of PDF_set_text_rendering()
		/**/
		
				$mail->FromName   = "TaskKloud";
				$mail->Subject    = $subj;
				$mail->Body = $message;
				
				$mail->AddAddress($address, "SI");
				$mail->WordWrap   = 50; 
				$mail->IsHTML(true); // send as HTML
				if(!$mail->Send()) 
				{
				  //echo "Mailer Error: " . $mail->ErrorInfo;
					echo "Mails not sent";
				} 
				else 
				{
				  
				}
}
?>
