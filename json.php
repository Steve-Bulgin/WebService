<?php

/* FileName: getall.php
 * Purpose: Mysql handler
 * Revision History
 * 		Steven Bulgin, 2017.01.05: Created
 *      Steven Bulgin, 2017.01.06: Servers up a complete list of json in the mysql
 *      Steven Bulgin, 2017.01.06: Spits out all if querystring empty, inserts if names are populated 
 */

	include_once('config.php');

	$urlstr = $_SERVER['QUERY_STRING'];
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

	if ($urlstr == "") {
		getAll();
	}
	elseif ($urlstr != "") {
		if ($f_name != "" && $l_name != "" && $wins=="" && $losses == "" && $ties == "") {
			addPlayer($f_name, $l_name, $wins, $losses, $ties);
		}
	}

	//Handles insert
	function addPlayer($f_name, $l_name) {		

		$insert = 'INSERT INTO `tbl_players`(`id`, `f_name`, `l_name`) VALUES 
										   (NULL,"'.$f_name.'", "'.$l_name.'")';

	 	$querystr = mysql_query($insert) or trigger_error(mysql_error()."".$insert);
	}

 	//Gets all items from db and returns json
 	function getAll() {


 		$json_array = array();

 		$selectall = 'SELECT * FROM `tbl_players`';
 		$querystr = mysql_query($selectall) or trigger_error(mysql_error()."".$selectall);

 		while ($result = mysql_fetch_array($querystr, MYSQL_ASSOC)) {
 			$result_array['f_name'] = $result['f_name'];
 			$result_array['l_name'] = $result['l_name'];
 			$result_array['wins'] = $result['wins'];
 			$result_array['losses'] = $result['losses'];
 			$result_array['ties'] = $result['ties'];

 			array_push($json_array,$result_array);
 		}

 		echo json_encode($json_array);

 	}
?>