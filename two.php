<html>
 <head>
 
 <?php $con=mysql_connect("localhost","root","akgec");
        if(!$con)
        echo "failed";
        $db_select=mysql_select_db("taskkloud",$con);
        if(!$db_select)
        echo ("not working".mysql_error());?>
		
		<link type="text/css" rel="stylesheet" href="style.css"/>
</head>
 <body>
 
 <form action="two.php" method="post">
 Enter Username <input type="text" id="username" name="username" value="" /></br>
 <input type="submit" name="submit" value="submit" /></br>
 <?php
 if(isset($_POST['username']))
{
     $name=$_POST['username'];
	 if($name!=null)
    { $query1="INSERT INTO `Username`(`Name`) VALUES ('$name')";
     $result1=mysql_query($query1,$con);
                        if($result1)
                            {
							$query3="CREATE TABLE  `Users`.`$name` (`Tasks` VARCHAR (100 ) NOT NULL,`Done` INT (5) NOT NULL)";
							$result3=mysql_query($query3,$con);
							}
 }
 }
 $c=1;
 $query2="Select * from `username`";
 $result2=mysql_query($query2,$con);
 while($rows=mysql_fetch_array($result2))
{

 echo "<div style=\"float:left;text-align:center; height: 250px; width: 300px;border:solid blue 5px;\">$rows[0]";echo "<br>";
 $query6="select * from `$rows[0]`";
 $result6=mysql_query($query6,$con);
 echo"<form action=\"two.php\" method='post'>";
 while($rows1=mysql_fetch_array($result6))
 {
 if($rows1[1]==0)
 {echo $rows1[0];
 echo"<input type='checkbox' name='checkboxes[]' value='$rows1[0]'>";
 echo"<br>";
 }
 }
 echo"<input type='Submit' name='done' value='Done'>";
 echo"</form>"; 
 echo"</div>";
   echo "<div style=\"float:left; height: 19px; width: 90px;\"></div>";
      if($c%3==0)
   echo "<br>";
   $c++;
  
   }
   ?>
   <?php 
 echo"<form action='two.php' method='post'>";
echo" Enter Task <input type=\"text\" id=\"givetask\" name=\"givetask\" value=\"\" />";
echo"</br>";
 echo "Enter To Whom Task Giving ";
 echo"<select name='giventaskto'>";
 $query9="Select * from `Username`";
 echo"<option value='Default'>"."Select User"."</option>";
 $result9=mysql_query($query9);
 while($rows9=mysql_fetch_array($result9))
 {
 echo "<option value='$rows9[0]'>".$rows9[0]."</option>";
 }
 echo"<input type=\"submit\" name=\"submittask\" value=\"submit\" />";
 echo "</br>";
echo "</form>";

 if((isset($_POST['givetask']))&&(isset($_POST['giventaskto'])))
 { 
 $giventaskto=$_POST['giventaskto'];
 $givetask=$_POST['givetask'];
$query5="insert into `$giventaskto`(`Tasks`) values('$givetask')";
 $result5=mysql_query($query5,$con);
 if($result5)
 echo "GIVEN TASK ASSIGNED";
 else
 echo mysql_error();
 }
?>
<?php 
if(isset($_POST['checkboxes']))
{
$check=$_POST['checkboxes'];
$n=count($check);
for($r=0;$r<$n;$r++)
{
//echo $check[$r];
$query7="select * from `Username`";
$result7=mysql_query($query7,$con);
while($rows7=mysql_fetch_array($result7))
{
//echo $rows7[0];
$query8="select * from `$rows7[0]`";
$result8=mysql_query($query8);
while($rows8=mysql_fetch_array($result8))
{
if($check[$r]==$rows8[0])
{
echo $check[$r];
//query9="update `$rows8[0]` set `Done` = '1' where `$rows8[0]`.`Tasks`='$check[$r]'";
//$result9=mysql_query($query9);
//if($result9)
//{
//echo"done";
//}
//else mysql_error();
//}
}
}
}
}
}
//else
//echo"not even checked";
?>

</body>
</html>