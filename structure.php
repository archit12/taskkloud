<?php
/*
 * class Structure containing structure of the document
 */
class Structure{
	//displaying the header
	function display_header(){
		$statement = '';
		$statement .= '<div id="header">';
		$statement .= '<title>Task Kloud</title><head><img src="images/header.jpg" />';
		$statement .= '</div>';
		$statement .= '<script type="text/javascript" src="js//jquery-1.9.0.min.js"></script>';
		$statement .= '<script type="text/javascript" src="js//myscript.js"></script>';
		$statement .= '<link rel="stylesheet" href="css//mystylesheet.css" type="text/css">';
		$statement .= '</head>';
		echo $statement;
	}

	//displaying the body
	function display_body(){
		$statement = '';
		$statement .= '<body>';
		echo $statement;
	}

	//displaying the footer
	function display_footer(){
		$statement = '';
		$statement .= '</body>';
		$statement .= '<div id="footer">Powered By: Software Incubator</div>';
		echo $statement;
	}
}
?>