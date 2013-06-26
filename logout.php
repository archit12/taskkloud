<?php session_start(); ?>
<?php 

if(isset($_SESSION["logged"])){
	unset($_SESSION["logged"]);
	
}
?>