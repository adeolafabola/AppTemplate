<?php
	include("config.php"); 
	$link = mysql_connect($server, $db_user, $db_pass) 
		or die ("Could not connect to mysql because ".mysql_error()); 

	mysql_select_db($database) 
		or die ("Could not select database because ".mysql_error()); 

	$result=mysql_query("SELECT * FROM trailpoints ORDER BY sn;");
					
	$j=1;
	$coordinates = array();
					
	while( $row=mysql_fetch_array($result) )
	{
		$coordinates[] = array(htmlspecialchars($row['name']), htmlspecialchars($row['latcoord']), htmlspecialchars($row['longcoord']), "trailpoints.html#".htmlspecialchars($row['stringid'])."_homepage", htmlspecialchars($row['classification']));											
	}
					
	echo json_encode($coordinates);
	
?>