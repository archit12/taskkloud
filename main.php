<?php
include 'new2.php';?>
<html>
<head>
<title>Task Cloud</title>

<link type="text/css" rel="stylesheet" href="css/style.css"/>
<link href="img/favicon.ico" rel="shortcut icon" type="image/favi.icon">
<script type="text/javascript" src="jquery.min.js"></script>
   
<script type="text/javascript">        // <![CDATA[
        $(document).ready(function() {
            function filterPath(string) {
                return string
      .replace(/^\//, '')
      .replace(/(index|default).[a-zA-Z]{3,4}$/, '')
      .replace(/\/$/, '');
            }
            $('a[href*=#]').each(function() {
                if (filterPath(location.pathname) == filterPath(this.pathname)
    && location.hostname == this.hostname
    && this.hash.replace(/#/, '')) {
                    var $targetId = $(this.hash), $targetAnchor = $('[name=' + this.hash.slice(1) + ']');
                    var $target = $targetId.length ? $targetId : $targetAnchor.length ? $targetAnchor : false;
                    if ($target) {
                        var targetOffset = $target.offset().top;
                        $(this).click(function() {
                            $('html, body').animate({ scrollTop: targetOffset }, 1000);
                            return false;
                        });
                    }
                }
            });
        });
        // ]]></script>
		<script type="text/javascript">
		function validateForm()
{
var x=document.forms["feeds"]["livefeeder"].value;
if (x==null || x=="")
  {
  alert("Please Give the feed");
  return false;
  }
}
function validatetask()
{
	var y=document.forms["tasks"]["task"].value;
	var z=document.forms["tasks"]["givetaskto"].value;
	var q=document.forms["tasks"]["from"].value;
	if (y==null || y=="" || z==null || z=="" || q=="" || q==null)
  {
  alert("Please Fill All The Entries");
  return false;
  }
}

</script>

</head>
<body>
<div id="headerw">
<div id="header"><img src="images/header.jpg"/></div></div>
    <div  style="background:#CC334D;width:150px;margin-top:4px;height:35px;float:right;color:white">
       <span id="project" style="font-size:24px;cursor:pointer;margin:15px 10px 10px 04px;padding:20px"> Projects</span>
        <div id="proj_desc" style="display:none;padding:05px;background:#CC334D;font-size:14px;">Click To Know about ongoing projects and members involved</div>
    </div>
<div id="wrapper">
<div id="taskform"><form name="tasks" action="new2.php" method="post" id="form2" onsubmit="return validatetask()">
		<table><tr><td>Enter Task<br/><textarea name="task" value="" method="post" cols="84" rows="6" style="margin-right:40px;"></textarea></td><td><table>
		<tr><td><br/><select name="givetaskto">
			<option value="">To</option>
			<?php  
			$query2="select * from `usernames` where `user_exists`='1'";
					$res2=mysql_query($query2,$con);
					while($rows2=mysql_fetch_array($res2))
						echo "<option value='$rows2[1]'>".$rows2[1]."</option>";
			?>
		</select></td></tr><tr><td><select name="from">
			<option value="">From</option>
			<?php  
			$query22="select * from `usernames` where `user_exists`='1'";
					$res22=mysql_query($query22,$con);
					while($rows22=mysql_fetch_array($res22))
					echo "<option value='$rows22[1]'>".$rows22[1]."</option>";
			?></td></tr><tr><td><input type="submit" name="entertask"  value="Assign Task" style="width:162px;height:45px;" class="Done"></td></tr></table></td></tr></table>
			
		
		
		
	</form></div>
    
	<div id="maincontent">
<div id="names">Members List :
<br><br>
<?php $query23="select * from `usernames` where `user_exists`='1'";
		$res23=mysql_query($query23,$con);
		while($row23=mysql_fetch_array($res23))
		{
			$query_task = 'select * from tasks where taskto = "'.$row23[1].'" and done=0';
			$result_task = mysql_query($query_task, $con);
			echo "<a href='#$row23[0]' style='text-decoration:none;color:#A5000D;font-size:12px;'>".$row23[1]."</a>";
			if (mysql_num_rows($result_task)>0) {
				echo '&nbsp<img src="images/new_task.gif" height="10px" width="20px" />';
			}
			echo "</BR></BR>";
		}
?>
</div>
<div id="livefeed">
<form name="feeds" method="post" action="new2.php" onsubmit="return validateForm()">
<table>
<tr><td>Live Feed<br/><textarea id="livefeeder" name="livefeeder" cols="82" rows="3"></textarea></td></tr><tr><td><input type="submit" name="feeds" value="Post" class="Done"></td></tr>
<tr><td><br/>
<div style="border-left:solid 4px #CC334D;border-bottom:solid 2px #CC334D;border-top:solid 1px #CC334D;border-right:solid 1px #CC334D;width:675px;height:400px;overflow-x:hidden;overflow:auto;">
<?php $query25="SELECT * FROM  `feeds` ORDER BY  `id` DESC LIMIT 0 , 10";
		$res25=mysql_query($query25,$con);
		while($row25=mysql_fetch_array($res25))
		{
			echo "<div class='display_feed' style='padding:10px 0px 10px 10px;font-size:14px;color:#61000A;background:rgba(51, 51, 51, 0.3);border-bottom:1px solid gray;margin-bottom:2px;'>".$row25[1]."</div>";
		}
?></div>
</td>
</tr></table>
</form></div>
<div style="width:700px;">
	<?php	$query3="select * from `usernames`";
			$res3=mysql_query($query3,$con);
			while($rows3=mysql_fetch_array($res3))
				{	if($rows3[2]==1)
					{echo"<div class='task' style='float:left;' id=\"$rows3[0]\">";
					echo"<form name='done' action='new2.php' method='post' onsubmit='return validatedone()'>";
					//echo"<input type='submit' class='delete' name='$rows3[0]' value='' title='Delete'>";
					echo"<a name='$rows3[0]' href=''></a>";
					echo$rows3[1]."<br/><br/>";
					$query4="select * from `tasks` where '$rows3[1]' LIKE `taskto`";
					$res4=mysql_query($query4,$con);
					
					
					while($rows4=mysql_fetch_array($res4))
					{
						if($rows4[4]==0)
						{
						echo "<p style='text-align:left;'>"."<input type='checkbox' name='$rows4[0]' >";
						echo$rows4[1]." "."from<span style='color:red;'>"."&nbsp;".$rows4[3]."</span></p>";
						}
					}
					echo"<input type='submit' name='Done' class='done' value='Submit'>";
					echo"</form>";
					echo"</div>";
				}	
				}?>


</div>
</div>

</div>
<div id="footer">Powered By - Software Incubator</div>
     <script type="text/javascript">
      $(document).ready(function(){
       $("#project").mouseover(function(){
            $("#proj_desc").slideDown('slow');
           setTimeout(function(){$("#proj_desc").slideUp(1000)},2500);
       });
        $("#project").click(function(){
            window.location.href='main2.php';
        })
       }) ;
    </script>
</body>
</html>