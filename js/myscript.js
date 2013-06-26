//show light Box
function getLightBox(){
	showPopWin('project.php',965, 810, null);
}
//clear the description box on click
function clear_it(){
		if($('#project_description').val()=="sample description")
			$('#project_description').val("");
}
//delete project
function delete_project(project){
	if(confirm('Confirm delete?')){
		$.ajax({
			type: 'POST',
			url: 'index_reciever.php',
			data: {'delete_project': project},
			success: function(data){
				alert("Deleted Project: "+project);
				window.location = 'main2.php';
			},
		});
	}
}

//post project name selected in the list of existing projects
//called on clicking on submit project 
function post_project_name(element_id) {
	if(element_id == 'submit_project'){
		var str = "";
		var str = $('#select_project').find(":selected").text();
		var ht = '<table><tr><td>Members Available</td><td>Members Added</td></tr></table>';
		if(str!=""){
			$('#table_header').html(ht);
		 	$.ajax({
				type: "POST",
				url: "reciever_project.php",
				data:{ 'project_name' : str},
				success: function(data){
					$('#container_list').html(data);
				},
			});
		}
		else{
			alert("Empty Project! Create new!");
		}
	}
	else if(element_id == 'new_project_submit'){
		var str = document.getElementById('project_name').value;
		var ht = '<table><tr><td>Members Available</td><td>Members Added</td></tr></table>';
		$('#table_header').html(ht);
		if(str!=""){
			$.ajax({
				type: "POST",
				url: "new_project_reciever.php",
				data:{ 'new_project' : str},
				success: function(data){
					//alert(data);
					$.ajax({
					type: "POST",
					url: "reciever_project.php",
					data:{ 'project_name' : data},
					success: function(data1){
						$('#container_list').html(data1);
						},
					});
				},
			});
		}
		else
			alert("Enter Project Name");
	}
}

//post the names of members that are selected to be added
//called on clicking the + button
function add_members(){$("#select_members option:selected").each(function () {$(this).remove().appendTo("#project_members");});}

function remove_members(){$("#project_members option:selected").each(function () {$(this).remove().appendTo("#select_members"); });}

function final_submit(){
	str1="";
	str2="";
	desc="";
	alotted_by="";
	$("#project_members option").each(function () {
        str1 += $(this).text() + ";";
     });
	$("#select_members option").each(function () {
        str2 += $(this).text() + ";";
     });
	desc = document.getElementById('project_description').value;
	alotter = $("#alotted_by option:selected").text();
	if(alotter!=""){
		$('#container_list').append('<img style="width:200px; position:relative; top:-30px; left:350px;" src="images/sending.gif" />');
		$('#container_list').append('<span style="position:relative; top:-120px; left:200px;">Sending Mails');
		$.ajax({
			type: "POST",
			url: 'reciever_final.php',
			data:{members_selected : str1, description : desc, alotted_by: alotter, members_notselected : str2},
			success: function(data){
				alert(data);
				window.location = "project.php"
			},
		});
	}
	else
		alert("Enter your name!");
}
      

$(document).ready(function(){
       $("#project").mouseenter(function(){
            $("#proj_desc").slideDown('slow');
           setTimeout(function(){$("#proj_desc").slideUp(1000)},2500);
       });
        $("#project").click(function(){
            window.location.href='main.php';
        })
       }) ;