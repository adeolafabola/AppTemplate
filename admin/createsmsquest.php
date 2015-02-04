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
						$pdf->Write(5, 'LIST OF HERITAGE TRIVIA');
						$pdf->Ln();

						$pdf->SetFontSize(10);
						$pdf->Ln();

						$pdf->Ln(5);

						$pdf->SetFont('Helvetica', 'B', 10);
						$pdf->Cell(10 ,7, 'S/N', 1);
						$pdf->Cell(70 ,7, 'QUESTION', 1);
						$pdf->Cell(40 ,7, 'ANSWER', 1);
						$pdf->Cell(40 ,7, 'CORRECT RESPONSE', 1);
						$pdf->Cell(40 ,7, 'WRONG RESPONSE', 1);
						$pdf->Ln();
						
						$pdf->SetFont('Helvetica', '', 10);

						$result=mysql_query("SELECT * FROM trivia ORDER BY sn;");

						$j=1;
						while ($row = mysql_fetch_array($result)) 
						{
							
							$pdf->Cell(10, 7, $j++, 1);
							$pdf->Cell(70, 7, $row['question'], 1);
							$pdf->Cell(40, 7, $row['answer'], 1);
							$pdf->Cell(40, 7, $row['correct_response'], 1);
							$pdf->Cell(40, 7, $row['wrong_response'], 1);
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
<title>SMS Quest</title>
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
			
        	<div align="center"> <h1>EXISTING TRIVIA SERIES</h1> </div>
					
			
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
					
				<form action=modifyfunctions.php method=get">
				<table border=0 cellpadding=0 cellspacing=0>
				<tr bgcolor=#A9D1FA align ="center" style="text-align:center;">
					<td><img src=images/blank.gif width=10 height=25></td>
					<td class=tabhead><img src=images/blank.gif width=30 height=6><br><b>S/N</b></td>
					<td class=tabhead><img src=images/blank.gif width=140 height=6><br><b>QUESTION</b></td>
					<td class=tabhead><img src=images/blank.gif width=70 height=6><br><b>ANSWER</b></td>
					<td class=tabhead><img src=images/blank.gif width=70 height=6><br><b>CORRECT RESPONSE</b></td>
					<td class=tabhead><img src=images/blank.gif width=70 height=6><br><b>WRONG RESPONSE</b></td>
					<td><img src=images/blank.gif width=10 height=25></td>
				</tr>
				
				
				<?php
					if(isset($_POST["trivium_question_1"]))
					{
						$anotherTrivium = true;
						$triviumCounter = 1;
						
						while($anotherTrivium)
						{
							$currentTrivium = "trivium_question_".$triviumCounter;
							
							if(isset($_POST[$currentTrivium]))
							{
								$currentTriviumQuestion = mysql_real_escape_string($_POST["trivium_question_".$triviumCounter]);
								$currentTriviumAnswer = mysql_real_escape_string($_POST["trivium_answer_".$triviumCounter]);
								$currentTriviumCorrectResponse = mysql_real_escape_string($_POST["trivium_correct_response_".$triviumCounter]);
								$currentTriviumWrongResponse = mysql_real_escape_string($_POST["trivium_wrong_response_".$triviumCounter]);
								
								$currentTriviumId = "Q".$triviumCounter;
								$nextTrivium = $triviumCounter+1;
								
								$currentTriviumCorrectAction = "Q".$nextTrivium;
								$currentTriviumWrongAction = $currentTriviumId;
									
								mysql_query("INSERT INTO trivia (id, question, answer, correct_response, wrong_response, correct_action, wrong_action) VALUES('$currentTriviumId', '$currentTriviumQuestion','$currentTriviumAnswer', '$currentTriviumCorrectResponse', '$currentTriviumWrongResponse', '$currentTriviumCorrectAction', '$currentTriviumWrongAction');");
								
								$triviumCounter++;
							}
						
							else
							{
								$anotherTrivium = false;
								
								$lastTriviumId = "Q".$triviumCounter-1;
								$updateQuery = "UPDATE trivia SET correct_action='end' WHERE id='$currentTriviumId';";
								mysql_query($updateQuery);
							}

						}
						
					}
					
					
					if(@$_REQUEST['action']=="del")
					{
						mysql_query("DELETE FROM trivia");
					}

					$result=mysql_query("SELECT * FROM trivia ORDER BY sn;");
					
					$i=0;
					$j=1;
					while( $row=mysql_fetch_array($result) )
					{
						if($i>0)
						{
							echo "<tr valign=bottom>";
							echo "<td bgcolor=#ffffff background='images/strichel.gif' colspan=8><img src=images/blank.gif width=1 height=1></td>";
							echo "</tr>";
						}
						echo "<tr valign=center>";
						echo "<td class=tabval><img src=images/blank.gif width=10 height=20></td>";
						echo "<td class=tabval>".htmlspecialchars($j++)."&nbsp;</td>";
						echo "<td class=tabval>".htmlspecialchars($row['question'])."</td>";
						echo "<td class=tabval>".htmlspecialchars($row['answer'])."&nbsp;</td>";
						echo "<td class=tabval>".htmlspecialchars($row['correct_response'])."&nbsp;</td>";
						echo "<td class=tabval>".htmlspecialchars($row['wrong_response'])."&nbsp;</td>";

						echo "</tr>";
						$i++;

					}

					echo "<tr valign=bottom>";
					echo "<td bgcolor=#A9D1FA colspan=8 style='text-align:center;'><img src=images/blank.gif width=1 height=8>Export list as <a href='createsmsquest.php?action=getpdf' target='_blank'>PDF document</a></td>";					
					echo "</tr>";
					
					echo "<tr valign=bottom>";					
					echo "<td bgcolor=#A9D1FA colspan=8 style='text-align:center;'><a onclick=\"return confirm('Delete trivia?');\" href=createsmsquest.php?action=del><span class=red>[DELETE ALL TRIVIA DATA]</span></a></td>";
					echo "</tr>";
				?>
									
				</table>
				</form>
				
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<hr>
				<h1>CREATE NEW TRIVIA SERIES</h1>
				<p style="color:#A9D1FA;">(Please note that creating a trivia series will override the content of the existing trivia series)</p>

				<form action=createsmsquest.php method=post enctype ="multipart/form-data">
					<table border=0 cellpadding=1 cellspacing=1>
												
						<tr>
							<td style="text-align:center;">
								<button id="triviumButton" onclick="triviumFunction();">New Trivium</button><br/>
							</td>
						</tr>
						
						<tr>
							<td style="text-align:center;">
								<div style="text-align:center;" id='triviumDiv'></div>
							</td>
						</tr>
						
						
					
						<tr>
							<td colspan=1 style="text-align:center;"><input type=submit border=0 value="Save"></td>
						</tr>
					</table>
				</form>
				
        	<p>&nbsp;</p>
           	<p>&nbsp;</p>
        	
        	
		</div>
        <div id="content_bottom"></div>
            
            <div align="center" style="align:center;" id="footer"><h3 style="align:center;color:#ffffff">OVW Group</h3></div>
      </div>
   </div>
</body>
</html>
