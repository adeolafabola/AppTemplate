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

				include("config.php"); 
				if (urlencode(@$_REQUEST['action']) == "getpdf") {
						mysql_connect($server, $db_user, $db_pass);
						mysql_select_db($database);

						include ('fpdf.php');
						$pdf = new FPDF();
						$pdf->AddPage();

						$pdf->SetFont('Helvetica', '', 14);
						$pdf->Write(5, 'LIST OF APP QUESTS');
						$pdf->Ln();

						$pdf->SetFontSize(10);
						$pdf->Ln();

						$pdf->Ln(5);

						$pdf->SetFont('Helvetica', 'B', 10);
						$pdf->Cell(10 ,7, 'S/N', 1);
						$pdf->Cell(70 ,7, 'NAME', 1);
						$pdf->Cell(70 ,7, 'QUEST ID', 1);
						$pdf->Ln();
						
						$pdf->SetFont('Helvetica', '', 10);

						$result=mysql_query("SELECT * FROM appquests ORDER BY sn;");

						$j=1;
						while ($row = mysql_fetch_array($result)) 
						{
							
							$pdf->Cell(10, 7, $j++, 1);
							$pdf->Cell(70, 7, $row['quest_name'], 1);
							$pdf->Cell(70, 7, $row['quest_id'], 1);
							$pdf->Ln();
						}

						$pdf->Output();
						exit;
					}
?>

<!--<!DOCTYPE html>-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="form.js" type="text/javascript"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<!--<link href="xampp.css" rel="stylesheet" type="text/css">-->
<title>App Quest</title>
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
			
        	<div align="center"> <h1>APP QUESTS</h1> </div>
					
			
				<?php

					if(!mysql_connect($server, $db_user, $db_pass))
					{
						echo "<h2>Could not connect to database!<br></h2>";
						die();
					}
					mysql_select_db($database);
				?>
			
				<p>&nbsp;</p>
				<p>&nbsp;</p>
					
				<form action=createappquests.php method=get">
				<table border=0 cellpadding=0 cellspacing=0>
				<tr bgcolor=#A9D1FA align ="center" style="text-align:center;">
					<td><img src=images/blank.gif width=10 height=25></td>
					<td class=tabhead><img src=images/blank.gif width=30 height=6><br><b>S/N</b></td>
					<td class=tabhead><img src=images/blank.gif width=140 height=6><br><b>NAME</b></td>
					<td class=tabhead><img src=images/blank.gif width=140 height=6><br><b>QUEST ID</b></td>
					<td class=tabhead><img src=images/blank.gif width=60 height=6><br><b></b></td>
					<td class=tabhead><img src=images/blank.gif width=60 height=6><br><b></b></td>
					<td><img src=images/blank.gif width=10 height=25></td>
				</tr>
				
				
				<?php
					if(@$_POST['name']!="" && @$_POST['questid']!="")
					{
						$questid=mysql_real_escape_string($_POST['questid']);
						$name=mysql_real_escape_string($_POST['name']);
						$questDescription=mysql_real_escape_string($_POST['questDescription']);
						
						
						mysql_query("INSERT INTO appquests (quest_name, quest_id, quest_description) VALUES('$name', '$questid', '$questDescription');");
					}
					
					if(@$_POST['quest']!="" && @$_POST['taskname']!="")
					{
					
						if(isset($_POST["option_1"]))
						{
							$quest=mysql_real_escape_string($_POST['quest']);
							$taskname=mysql_real_escape_string($_POST['taskname']);
							$tasklat=mysql_real_escape_string($_POST['tasklat']);
							$tasklon=mysql_real_escape_string($_POST['tasklon']);
							$tasklocation=mysql_real_escape_string(str_replace("'","\'", $_POST['tasklocation']));
												
							
							$taskid=0;
							
							$getTaskIdResults=mysql_query("SELECT * FROM questtasks WHERE quest='".$quest."' ORDER BY sn;");
							
							while( $getTaskRow=mysql_fetch_array($getTaskIdResults) )
							{
								$taskid=$getTaskRow['taskid'];
							}
							
							$taskid++;
							
							//options will be defined here
							//iterative operation to concatenate all options and store them in one string
							
							$options = "";
							
							
							if(isset($_POST["option_1"]))
							{
								$anotherOption = true;
								$optionCounter = 1;
								
								while($anotherOption)
								{
									$currentOption = "option_".$optionCounter;
									
									if(isset($_POST[$currentOption]))
									{
										$currentOptionValue = mysql_real_escape_string(str_replace("'","singlequote", $_POST["option_".$optionCounter]));
										$currentOptionValue = str_replace("\"","doublequote", $currentOptionValue);
																				
										$options.=$currentOptionValue;
										$options.="+++";	//"+++" is the designated options delimiter
																		
										$optionCounter++;
									}
								
									else
									{
										$anotherOption = false;
										$options = substr($options, 0, -3);	//remove trailing "+++" from concatenated options
									}

								}
								
								$expected=mysql_real_escape_string($_POST['options']);	//in the form of "1+++2+++3+++n..."
								
								$explanation=mysql_real_escape_string(str_replace("'","\'", $_POST['explanation']));
								
							}
														
							mysql_query("INSERT INTO questtasks (quest, taskid, task, options, expected, tasklat, tasklon, explanation, tasklocation) VALUES('$quest', '$taskid', '$taskname', '$options', '$expected', '$tasklat', '$tasklon', '$explanation', '$tasklocation');");
						
						
						}
						
						else
						{
							echo("<p align='center' style='align:center;color:red;'><strong>Error: Task cannot be added without options!</strong></p>");
						}
					
					}

					if(@$_REQUEST['action']=="del")
					{
						$idToDeleteQuery=mysql_query("SELECT * FROM appquests WHERE sn=".round($_REQUEST['id']));
					
						$idToDelete = "";
						while( $rowToDelete=mysql_fetch_array($idToDeleteQuery) )
						{
							$idToDelete = $rowToDelete['quest_id'];
						}
						
						mysql_query("DELETE FROM questtasks WHERE quest='".$idToDelete."';");
						mysql_query("DELETE FROM appquests WHERE sn=".round($_REQUEST['id']));
					}

					$result=mysql_query("SELECT * FROM appquests ORDER BY sn;");
					
					$i=0;
					$j=1;
					while( $row=mysql_fetch_array($result) )
					{
						if($i>0)
						{
							echo "<tr valign=bottom>";
							echo "<td bgcolor=#ffffff background='images/strichel.gif' colspan=7><img src=images/blank.gif width=1 height=1></td>";
							echo "</tr>";
						}
						echo "<tr valign=center>";
						echo "<td class=tabval><img src=images/blank.gif width=10 height=20></td>";
						echo "<td class=tabval>".htmlspecialchars($j++)."&nbsp;</td>";
						echo "<td class=tabval><b>".htmlspecialchars($row['quest_name'])."</b></td>";
						echo "<td class=tabval>".htmlspecialchars($row['quest_id'])."&nbsp;</td>";

						echo "<td class=tabval><a onclick=\"return confirm('Delete quest and all associated data?');\" href=createappquests.php?action=del&id=".$row['sn']."><span class=red>[DELETE]</span></a></td>";
						echo "<td class=tabval><a onclick=\"return confirm('Modify quest?');\" href=createappquests.php?action=modify&id=".$row['sn']."><span class=red>[MODIFY]</span></a></td>";
						echo "<td class=tabval></td>";
						echo "</tr>";
						$i++;

					}

					echo "<tr valign=bottom>";
					echo "<td bgcolor=#A9D1FA colspan=7 style='text-align:center;'><img src=images/blank.gif width=1 height=8>Export list as <a href='createappquests.php?action=getpdf' target='_blank'>PDF document</a></td>";
					echo "</tr>";
				?>
									
				</table>
				</form>
				
				<p>&nbsp;</p>
				<hr>
				<p>&nbsp;</p>	
				
				<?php
					if(@$_REQUEST['action']=="modify")
					{
						
						$idToModifyQuery=mysql_query("SELECT * FROM appquests WHERE sn=".round($_REQUEST['id']));
					
						$idToModify = "";
						$nameToModify = "";
						while( $rowToModify=mysql_fetch_array($idToModifyQuery) )
						{
							$idToModify = $rowToModify['quest_id'];
							$nameToModify = $rowToModify['quest_name'];
						}						
						
						
						echo "<h1>".strtoupper($nameToModify)."</h1>
								<table style='border-color: #A9D1FA;' border=1 cellpadding=0 cellspacing=0>
								<tr bgcolor=#A9D1FA align =center style='text-align:center;'>
									<td class=tabhead><img src=images/blank.gif width=30 height=6><br><b>S/N</b></td>
									<td class=tabhead><img src=images/blank.gif width=150 height=6><br><b>TASK</b></td>
									<td class=tabhead><img src=images/blank.gif width=70 height=6><br><b>LOCATION</b></td>
									<td class=tabhead><img src=images/blank.gif width=110 height=6><br><b>OPTIONS</b></td>
									<td class=tabhead><img src=images/blank.gif width=70 height=6><br><b>ANSWER</b></td>
								</tr>";
							
						$taskresults=mysql_query("SELECT * FROM questtasks WHERE quest='".$idToModify."' ORDER BY sn;");
					
						$k=0;
						$l=1;
						while( $taskrow=mysql_fetch_array($taskresults) )
						{
							if($k>0)
							{
								echo "<tr valign=bottom>";
								echo "<td bgcolor=#ffffff background='images/strichel.gif' colspan=6><img src=images/blank.gif width=1 height=1></td>";
								echo "</tr>";
							}
							
							$optionsToDisplay = explode("+++", str_replace('doublequote', '"', str_replace("singlequote", "'", $taskrow['options'])));
							$expectedToDisplay = $optionsToDisplay[$taskrow['expected']-1];
										
							
							
							echo "<tr valign=center>";
							echo "<td class=tabval>".htmlspecialchars($l++)."&nbsp;</td>";
							echo "<td class=tabval>".htmlspecialchars($taskrow['task'])."</td>";
							echo "<td class=tabval>".htmlspecialchars(str_replace("\'","'", $taskrow['tasklocation']))."</td>";
							echo "<td class=tabval>".htmlspecialchars(implode(', ', $optionsToDisplay))."</td>";
							echo "<td class=tabval>".htmlspecialchars($expectedToDisplay)."&nbsp;</td>";
							echo "</tr>";
							$k++;
						}
							
						echo "</table>";
						
						echo"<p>&nbsp;</p>";
												
						echo "<h1>ADD TASK</h1>
							
						<form action=createappquests.php?action=modify&id=".$_REQUEST['id']." method=post enctype ='multipart/form-data'>
							<table style='border-color: #A9D1FA; background: #A9D1FA;' border=1 cellpadding=1 cellspacing=1>
								<tr>
									<td><p style='text-align:center;color:red'>Required fields</p></td>
								</tr>
								
								<tr>
									<td><textarea rows=4 cols=50 required name=taskname placeholder='Task'></textarea></td>
								</tr>
							
								<tr>
									<td>
										<input type=text required size=16 name=tasklat placeholder='Lat. coord.'>
										<input type=text required size=16 name=tasklon placeholder='Lon. coord.'>
										<input type=text required size=16 name=tasklocation placeholder='Location'>
									</td>
								</tr>
								
								<tr>
									<td style='text-align:center;'>
										<br/>
									</td>
								</tr>
								
								<tr>
									<td style='text-align:center;'>
										<button id='optionButton' onclick='optionFunction(); return false;'>Add Options</button><br/>
									</td>
								</tr>
								
								
								<tr>
									<td style='text-align:center;'>
										<div style='text-align:center;' id='optionDiv'></div>
									</td>
								</tr>
								
								
								
								
								<tr>
									<td colspan=1 style='text-align:center;'>
										<input type=submit border=0 value='Add Task'>
										<button id='resetOptions' onclick=\"resetElements('optionDiv'); return false;\">Reset Options</button>
									</td>
								</tr>
								
							</table>
							
							<input type=hidden name=quest value=".$idToModify.">
						</form>";
						
						
					}
					
					else
					{
					
						echo "<h1>CREATE APP QUEST</h1>
						<form action=createappquests.php method=post enctype ='multipart/form-data'>
							<table style='border-color: #A9D1FA; background: #A9D1FA;' border=1 cellpadding=1 cellspacing=1>
								<tr>
									<td><p style='text-align:center;color:red'>Required fields</p></td>
								</tr>
								
								<tr>
									<td><input type=text required size=58 name=name placeholder='Quest Name'></td>
								</tr>
								
								<tr>
									<td><input type=text required pattern='[a-zA-Z]+' size=58 name=questid placeholder='Quest ID (no spaces allowed)'></td>
								</tr>
								
								<tr>
									<td><textarea rows=4 cols=51 required name=questDescription placeholder='Quest Description'></textarea></td>
								</tr>
							
								<tr>
									<td colspan=1 style='text-align:center;'><input type=submit border=0 value='Add App Quest'></td>
								</tr>
							</table>
						</form>";
						
					}
				?>	

        	
		</div>
        <div id="content_bottom"></div>
            
            <div align="center" style="align:center;" id="footer"><h3 style="align:center;color:#ffffff">OVW Group</h3></div>
      </div>
   </div>
</body>
</html>
