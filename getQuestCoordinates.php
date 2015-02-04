<?php
	include("config.php"); 

	$link = mysql_connect($server, $db_user, $db_pass) 
		or die ("Could not connect to mysql because ".mysql_error()); 

	mysql_select_db($database) 
		or die ("Could not select database because ".mysql_error()); 
	
	$questId = $_POST['questToRetrieve'];	//get questid that was submitted.
	$result=mysql_query("SELECT * FROM questtasks WHERE quest='".$questId."' ORDER BY sn;");
					
	$j=1;
	$coordinates = array();
					
	while( $row=mysql_fetch_array($result) )
	{
		$coordinates[] = array(htmlspecialchars($row['tasklocation']), htmlspecialchars($row['tasklat']), htmlspecialchars($row['tasklon']), htmlspecialchars($row['taskid']));											
	}

	echo json_encode($coordinates);

?>