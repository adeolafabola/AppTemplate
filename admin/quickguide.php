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
<title>Quick Quide</title>
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
			
        	<div align="center"> <h1>SO YOU'VE REGISTERED FOR AN APP, NOW WHAT? </h1> </div>
				<p style='text-align:justify;'><strong>This content management interface provides a number of useful 
				features which are discussed briefly below:</strong></p>
				<br>
				
				<ol>
                    <li>
						<p style='text-align:justify;'><strong>Adding sites</strong>: You can create new sites (or modify existing
						sites by clicking the <a href='modifyfunctions.php' target='_blank'>modify sites</a> tab to the left. This opens a page which
						shows any sites that have been created as well as features to edit these sites and add new sites. 
						A new site can be created by specifying some required values as well as some optional ones. Required fields 
						include the name, a unique site identifier (ID), a brief description, coordinates (latitude and longitude), 
						site type and an image (in jpg or png format only). Optional fields include audio files (mp3 format only), video files 
						(mp4 format only) and additional chunks of text. Once these values are specified, clicking on the 
						“Add site” button creates the site and the associated data are stored in the App. 
						The sites (and all associated information) created using this functionality will be visible to 
						users of the mobile application on their mobile devices.</p>
						
					</li>
					
                    <li>
						<p style='text-align:justify;'><strong>Deleting sites</strong>:  You can delete sites (and all associated data) by clicking the
						 <a href='modifyfunctions.php' target='_blank'>modify sites</a> tab, selecting the particular site from the list of existing sites and 
						 clicking “delete”. You will be asked to confirm this action and upon confirmation, the site and all associated data will be 
						 removed from the App. Once a site is deleted, users of the mobile application will no longer be able to access it.</p>
					</li>
					
                    <li>
						<p style='text-align:justify;'><strong>Viewing site details</strong>:  You can view the details i.e. information 
						associated with each site by clicking on the <a href='viewfunctions.php' target='_blank'>view sites</a> 
						tab, which displays a list of all existing sites. You can then view the details of each site by
						 clicking on the “details” button. A list of all sites can also be exported in PDF format.</p>
					</li>
					
					<li>
						<p style='text-align:justify;'><strong>Creating App Quests</strong>: You can create engaging and interactive App quests by clicking on the
						<a href='createappquests.php' target='_blank'>App Quest</a> tab, which shows any quests that have been created as well as features to modify 
						the contents of the quests.	A new quest can be created by specifying the quest name, quest identifier (ID) and quest description. Once these 
						values are specified, clicking on the “Add App Quest button creates the quest, which needs to be modified to become fully functional. This is 
						done by clicking on the modify button and adding a series of connected "tasks" to the quest using the form displayed. Each "task" consists of
						an action to be performed (e.g. a puzzle to be solved or question to be answered), the location and coordinates (latitude and longitude) 
						where the action will be performed, a series of "options" (one of which is the correct solution to the action) and an explanation which provides
						more insight into the correct solution. Once these are specified, clicking on the "Add Task" button adds a task to the selected App quest, 
						and the process can be repeated several times to add more tasks to the quest.</p>
					</li>
					
					<li>
						<p style='text-align:justify;'><strong>Creating SMS Quests</strong>: You can create engaging and interactive SMS
						quests by clicking on the <a href='createsmsquest.php' target='_blank'>SMS Quest</a> tab, which displays any existing trivia series and provides functionalities
						to create a set of questions and answers that will connect together to form a quest trail. This quest is targeted at SMS-only users of the system,
						who will take part by following instructions and answering questions sent to them via SMS messages. You can also make changes
						to an existing series by adding or deleting individual question and answer pairs, or by creating a new series to override the contents of an existing series.</p>
					</li>
					
                    <li>
						<p style='text-align:justify;'><strong>Managing SMS records</strong>:  You can view the SMS 
						transactions that have taken place by clicking on the <a href='viewrecords.php' target='_blank'>view 
						text records</a> tab which shows the mobile number, text received, and the date (and time) for each SMS transaction 
						in the system. This list can be exported to PDF format and you may choose to delete one or 
						more transactions by clicking on the <a href='modifyrecords.php' target='_blank'>modify records</a> tab and clicking on the delete button for the 
						respective transactions.</p>
					</li>
                </ol>
	
					
			
				<?php
					include("config.php"); 
					if(!mysql_connect($server, $db_user, $db_pass))
					{
						echo "<h2>Could not connect to database!<br></h2>";
						die();
					}
					mysql_select_db($database);
				?>
			
					
        	
		</div>
        <div id="content_bottom"></div>
            
            <div align="center" style="align:center;" id="footer"><h3 style="align:center;color:#ffffff">OVW Group</h3></div>
      </div>
   </div>
</body>
</html>
