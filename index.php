<?php
session_start();
if(isset($_POST["log"])){
	if($_POST["pwd"]=="sirocks"){
		$_SESSION["logged"]="yes";
		header("Location:main.php");
		}else{
		echo "<script>"."alert('access denied')"."</script>";
		}
}
?>
<html>
<head>
<style>
td
{
padding:5px;

}
</style>
</head>
<body style="background-color: #333;color: #CC334d;">
<form action="index.php" method="POST">
<table style="margin: auto;margin-top: 15%;border:solid 2px #CC334D;background-color:#EEE;">
<tr><td colspan="3" style="font-size:20px;text-align:center;border-bottom:solid 1px #cc334d;padding-bottom:20px">Task Kloud</td></tr>
<tr>
<td>Password</td>
<td><input type="password" name="pwd"></td>

<td><input type="submit" name="log" style="width:70px;height:30px;color:white;background-color: #CC334d;border:solid 1px #222;" value="Login"></td>
</tr>
</table>
</form>
</body>
</html>