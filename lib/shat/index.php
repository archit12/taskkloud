<?php include('send.php');
	$from='saxenarchit@gmail.com';
	$address='saxenarchit@gmail.com';
	$message='Hi..';
	$subj='test...';
	sendmail($from,$address,$message,$subj);
	//mail($to,$from,$subj,$body);
?>