<?php

/* FileName: test.php
 * Purpose: Mysql handler
 * Revision History
 * 		Steven Bulgin, 2017.01.05: Created
 */

	include_once('config.php');
	echo "Test stuff";

	$f_name = isset($_GET['f_name']) ?
	mysql_real_escape_string($_GET['f_name']) : "";
	$l_name = isset($_GET['l_name']) ?
	mysql_real_escape_string($_GET['l_name']) : "";
	$wins = isset($_GET['wins']) ?
	mysql_real_escape_string($_GET['wins']) : "";
	$losses = isset($_GET['losses']) ?
	mysql_real_escape_string($_GET['losses']) : "";
	$ties = isset($_GET['ties']) ?
	mysql_real_escape_string($_GET['ties']) : "";

	$insert = 'INSERT INTO `tbl_players`(`id`, `f_name`, `l_name`, `wins`, `losses`, `ties`) VALUES 
									   (NULL,"'.$f_name.'", "'.$l_name.'", "'.$wins.'", "'.$losses.'", "'.$ties.'")';

 	$querystr = mysql_query($insert) or trigger_error(mysql_error()."".$insert);
?>