<?php
if (!isset($_COOKIE['loggedin']))
{
	header("Location:login.php");
	die();
}
else
{
	$mysite_username = $_COOKIE["mysite_username"]; 
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<!--<link href="xampp.css" rel="stylesheet" type="text/css">-->
<title>Home</title>
</head>

<body>
<div id="container">
		<div id="header">
        	<h1>Quest<span class="off">It</span></h1>
            <h2>An intelligent App creation service...</h2>
        </div>   
        
        <div id="menu">
        	<ul>
				<li class="menuitem"><a href="home.php">Home</a></li>
				<li class="menuitem"><a href="quickguide.php">Quick Guide</a></li>
            	<li class="menuitem"><a href="viewfunctions.php">Sites</a></li>
            	<li class="menuitem"><a href="viewrecords.php">Records</a></li>
				<li class="menuitem"><a href="createsmsquest.php">SMS Quest</a></li>
				<li class="menuitem"><a href="createappquests.php">App Quest</a></li>
				<li class="menuitem"><a href="faq.php">FAQs</a></li>
				<li class="menuitem"><a href="">&nbsp;</a></li>
				<li class="menuitem"><a href="">&nbsp;</a></li>
				<li class="menuitem"><a href="">&nbsp;</a></li>
				<li class="menuitem"><a href="">&nbsp;</a></li>
				<li class="menuitem"><a href="">&nbsp;</a></li>
				<li class="menuitem"><a href="">&nbsp;</a></li>
				<li class="menuitem"><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        
        <div id="leftmenu">

        <div id="leftmenu_top"></div>

			<div id="leftmenu_main">    
                
                <h3><?php echo "Hi $mysite_username";?></h3>
                        
                <ul>
                    <li><a href="viewfunctions.php">View sites</a></li>
                    <li><a href="modifyfunctions.php">Modify sites</a></li>
                    <li><a href="viewrecords.php">View Text Records</a></li>
                    <li><a href="modifyrecords.php">Modify Records</a></li>
                    <li><a href="createsmsquest.php">SMS Quest</a></li>
                    <li><a href="createappquests.php">App Quest</a></li>
                </ul>
			</div>
                
                
              <div id="leftmenu_bottom"></div>
        </div>
        
        
        
        
		<div id="content">
        
        
        <div id="content_top"></div>
        <div id="content_main">
			
        	<div align="center"> <h1>WELCOME TO QUESTIT! </h1> </div>

			
				<p style='text-align:justify;'><strong>QuestIt</strong> is an intelligent, multi-platform information dissemination system for the 
				cultural heritage sector. The system was born out of a project aimed at designing and implementing an intelligent SMS-based 
				service that will enable cultural heritage organisations create informative trails in their surrounding locality. 
				The underlying vision for the project was to connect heritage organisations (such as museums, galleries and historic sites) 
				with their localities thus creating a web of information will engage tourists and encourage them to call in at the local heritage centre. </p>
				<br>
				<p style='text-align:justify;'>Overtime, <strong>QuestIt</strong>  morphed into a robust system that utilises not just SMS but also
				leverages web and mobile technologies to provide an engaging experience to users. The system features a mobile application that 
				lets users gain cultural heritage information about a given locality through a live trail map that shows several points in a trail
				and a list of sites with interactive contents ranging from text descriptions to multimedia files. These interactive contents
				are sourced in real-time from a backend knowledgebase and are provided by one or more administrators through the use of this
				content management interface. Please see the <a href='quickguide.php'>quick guide</a> for a brief demonstration on how to use this interface
				to populate the knowledgebase with contents for users consumption.</p>

					
									
			
				<?php
					include("config.php"); 
					if(!mysql_connect($server, $db_user, $db_pass))
					{
						echo "<h2>Could not connect to database!<br></h2>";
						die();
					}
					mysql_select_db($database);
				?>
			
				<p>&nbsp;</p>
				<p>&nbsp;</p>
					
				
				
					
        	
					
        	
		</div>
        <div id="content_bottom"></div>
            
            <div align="center" style="align:center;" id="footer"><h3 style="align:center;color:#ffffff">OVW Group</h3></div>
      </div>
   </div>
</body>
</html>
