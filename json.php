<?php
	include_once('config.php');
	$request_type = $_SERVER['REQUEST_METHOD'];
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

	if ($request_type == 'GET') {
		$json_array = array();
		getAll();
		
	}
	elseif ($request_type == 'POST') {
		if ($f_name != "" && $l_name != "" && $wins=="" && $losses == "" && $ties == "") {
			$json_array = array();
			addPlayer($f_name, $l_name);
			$post_array = array("status"=>"200", "message"=>"insert successful");
			array_push($json_array,$post_array);
			echo "{ \"respnse\": ", json_encode($json_array), " }";
		}
	}
	elseif ($request_type == 'PUT') {
		$json_array = array("status"=>"200", "message"=>"PUT");
		echo "{ \"respnse\": ", json_encode($json_array), " }";
	}
	elseif ($request_type == 'DELETE') {
		$json_array = array();
		deletePlayer($f_name,$l_name);
		$delete_array = array("status"=>"200", "message"=>"DELETE successful");
		array_push($json_array,$delete_array);
		echo "{ \"respnse\": ", json_encode($json_array), " }";
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
 		echo "{ \"players\": ", json_encode($json_array)," }";
 	}

 	function deletePlayer($f_name, $l_name) {
 		$delete = 'DELETE FROM `tbl_players` WHERE f_name="'.$f_name.'" AND l_name="'.$l_name.'"';
 		$querystr = mysql_query($delete) or trigger_error(mysql_error()."".$selectall);
 	}
?>