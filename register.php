<?php


header("access-control-allow-origin: *");
header("access-control-allow-methods: GET, POST, OPTIONS");
header("access-control-allow-credentials: true");
header("access-control-allow-headers: Content-Type, *");
header("Content-type: application/json");

$response_array = array();

if (isset($_POST["username"]) && isset($_POST["password"]) && $_POST["username"]!="" && $_POST["password"]!="") 
{
	include("config.php"); 
	$link = mysql_connect($server, $db_user, $db_pass) 
		or die ("Could not connect to mysql because ".mysql_error()); 
	
	mysql_select_db($database) 
		or die ("Could not select database because ".mysql_error()); 
						
	$username = $_POST['username'];
	$check = "select id from $endusertable where username = '".$_POST['username']."';"; 
	$qry = mysql_query($check)
		or die ("Could not match data because ".mysql_error());
	$num_rows = mysql_num_rows($qry);
						
	if ($num_rows != 0) 
	{ 
		$response_array['status'] = 'error';
	} 
						
	else 
	{
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		$insert = mysql_query("insert into $endusertable values ('NULL', '".$firstname."', '".$lastname."', '".$email."', '".$username."', '".$password."')")
			or die("Could not insert data because ".mysql_error());
							
		$response_array['status'] = 'success'; 
	}
}

else
{
	$response_array['status'] = 'invalid'; 
}

echo json_encode($response_array);
?>			
			
			