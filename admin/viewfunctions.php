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
						$pdf->Write(5, 'LIST OF SITES');
						$pdf->Ln();

						$pdf->SetFontSize(10);
						$pdf->Ln();

						$pdf->Ln(5);

						$pdf->SetFont('Helvetica', 'B', 10);
						$pdf->Cell(10 ,7, 'S/N', 1);
						$pdf->Cell(70 ,7, 'NAME', 1);
						$pdf->Cell(45 ,7, 'TEXT ID', 1);
						$pdf->Cell(20 ,7, 'TYPE', 1);
						$pdf->Cell(25 ,7, 'LAT', 1);
						$pdf->Cell(25 ,7, 'LON', 1);
						//$pdf->Cell(25 ,7, 'IMAGE', 1);
						$pdf->Ln();
						
						$pdf->SetFont('Helvetica', '', 10);

						$result=mysql_query("SELECT * FROM trailpoints ORDER BY sn;");

						$j=1;
						while ($row = mysql_fetch_array($result)) 
						{
							
							$pdf->Cell(10, 7, $j++, 1);
							$pdf->Cell(70, 7, $row['name'], 1);
							$pdf->Cell(45, 7, $row['stringid'], 1);
							$pdf->Cell(20, 7, $row['classification'], 1);
							$pdf->Cell(25, 7, $row['latcoord'], 1);
							$pdf->Cell(25, 7, $row['longcoord'], 1);
							//$pdf->Cell(25, 7, $row['image'], 1);
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<!--<link href="xampp.css" rel="stylesheet" type="text/css">-->
<title>View sites</title>
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
			
        	<div align="center"> <h1>SITES </h1> </div>
			
			
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
					
				<table style='border-color: #A9D1FA;' border=1 cellpadding=0 cellspacing=0>
				<tr bgcolor=#A9D1FA align ="center" style="text-align:center;">
					<td class=tabhead><img src=images/blank.gif width=30 height=6><br><b>S/N</b></td>
					<td class=tabhead><img src=images/blank.gif width=140 height=6><br><b>NAME</b></td>
					<td class=tabhead><img src=images/blank.gif width=70 height=6><br><b>TEXT ID</b></td>
					<td class=tabhead><img src=images/blank.gif width=40 height=6><br><b>TYPE</b></td>
					<td class=tabhead><img src=images/blank.gif width=70 height=6><br><b>LAT.</b></td>
					<td class=tabhead><img src=images/blank.gif width=70 height=6><br><b>LON.</b></td>
					<!--<td class=tabhead><img src=images/blank.gif width=100 height=6><br><b>IMAGE (FILE)</b></td>-->
					<td class=tabhead><img src=images/blank.gif width=50 height=6><br><b></b></td>
				</tr>
				
				
				<?php
					$result=mysql_query("SELECT * FROM trailpoints ORDER BY sn;");
					
					$i=0;
					$j=1;
					while( $row=mysql_fetch_array($result) )
					{
						if($i>0)
						{
							echo "<tr valign=bottom>";
							echo "<td bgcolor=#ffffff background='images/strichel.gif' colspan=10><img src=images/blank.gif width=1 height=1></td>";
							echo "</tr>";
						}
						echo "<tr valign=center>";
						echo "<td class=tabval>".htmlspecialchars($j++)."&nbsp;</td>";
						echo "<td class=tabval><b>".htmlspecialchars($row['name'])."</b></td>";
						echo "<td class=tabval>".htmlspecialchars($row['stringid'])."&nbsp;</td>";
						echo "<td class=tabval>".htmlspecialchars($row['classification'])."&nbsp;</td>";
						echo "<td class=tabval>".htmlspecialchars($row['latcoord'])."&nbsp;</td>";
						echo "<td class=tabval>".htmlspecialchars($row['longcoord'])."&nbsp;</td>";
						//echo "<td class=tabval>".htmlspecialchars($row['image'])."&nbsp;</td>";

						echo "<td class=tabval><a onclick=\"return confirm('View details?');\" href=viewfunctions.php?action=details&id=".$row['sn']."><span class=red>[DETAILS]</span></a></td>";
						echo "</tr>";
						$i++;

					}

					echo "<tr valign=bottom>";
					echo "<td bgcolor=#A9D1FA colspan=9 style='text-align:center;'><img src=images/blank.gif width=1 height=8>Export list as <a href='viewfunctions.php?action=getpdf' target='_blank'>PDF document</a></td>";
					echo "</tr>";
				?>
									
				</table>
				

				<?php

				if(@$_REQUEST['action']=="details")
				{
					$result = mysql_query("SELECT * FROM trailpoints WHERE sn=".round($_REQUEST['id']));
									
					$i=0;
					while( $row=mysql_fetch_array($result) )
					{
						echo "<p>&nbsp;</p>";
						echo "<p>&nbsp;</p>";	
						echo "<h1>SITE DETAILS</h1>";
						echo "<table style='border-color: #A9D1FA;' border=1 cellpadding=0 cellspacing=0>";
						
						echo "<tr valign=bottom>";
						echo "<td bgcolor=#A9D1FA colspan=2 style='text-align:center;'><img src=images/blank.gif width=1 height=8></td>";
						echo "</tr>";
							
						echo "<tr bgcolor=#A9D1FA align =left style=text-align:left>";
							echo "<td class=tabhead align ='left' style='text-align:left'><img src=images/blank.gif width=70 height=6><br><b>NAME</b></td>";
							echo "<td class=tabval><b>".htmlspecialchars($row['name'])."</b></td>";
						echo "</tr>";
						
						echo "<tr bgcolor=#A9D1FA align =left style=text-align:left>";
							echo "<td class=tabhead align ='left' style='text-align:left'><img src=images/blank.gif width=70 height=6><br><b>TEXT ID</b></td>";
							echo "<td class=tabval>".htmlspecialchars($row['stringid'])."&nbsp;</td>";
						echo "</tr>";
						
						echo "<tr bgcolor=#A9D1FA align =left style=text-align:left>";
							echo "<td class=tabhead align ='left' style='text-align:left'><img src=images/blank.gif width=70 height=6><br><b>TYPE</b></td>";
							echo "<td class=tabval>".htmlspecialchars($row['classification'])."&nbsp;</td>";
						echo "</tr>";
						
						echo "<tr bgcolor=#A9D1FA align =left style=text-align:left>";
							echo "<td class=tabhead align ='left' style='text-align:left'><img src=images/blank.gif width=70 height=6><br><b>DESCRIPTION</b></td>";
							echo "<td class=tabval>".htmlspecialchars($row['description'])."</td>";
						echo "</tr>";
						
						echo "<tr bgcolor=#A9D1FA align =left style=text-align:left>";
							echo "<td class=tabhead align ='left' style='text-align:left'><img src=images/blank.gif width=70 height=6><br><b>LATITUDE</b></td>";
							echo "<td class=tabval>".htmlspecialchars($row['latcoord'])."</td>";
						echo "</tr>";
						
						echo "<tr bgcolor=#A9D1FA align =left style=text-align:left>";
							echo "<td class=tabhead align ='left' style='text-align:left'><img src=images/blank.gif width=70 height=6><br><b>LONGITUDE</b></td>";
							echo "<td class=tabval>".htmlspecialchars($row['longcoord'])."</td>";
						echo "</tr>";
						
						echo "<tr bgcolor=#A9D1FA align ='left' style='text-align:left'>";
							echo "<td class=tabhead align ='left' style='text-align:left'><img src=images/blank.gif width=70 height=6><br><b>IMAGE</b></td>";
							echo "<td class=tabval><a href='".htmlspecialchars($row['image'])."' target='_blank'>Click to view image</a>"."</td>";
						echo "</tr>";
						
						
						
						
						
						$resourcesResult=mysql_query("SELECT * FROM resources WHERE point_stringid='".$row['stringid']."';");
						
						$resourcesOutput="";
						
						while( $resourcesRow=mysql_fetch_array($resourcesResult) )
						{
							if($resourcesRow['type']=='audio')
							{
								
								echo "<tr bgcolor=#A9D1FA align ='left' style='text-align:left'>";
									echo "<td class=tabhead align ='left' style='text-align:left'><img src=images/blank.gif width=70 height=6><br><b>AUDIO</b></td>";
									echo "<td class=tabval><a href='".htmlspecialchars($resourcesRow['value'])."' target='_blank'>Click to play audio file</a> (".htmlspecialchars($resourcesRow['description']).")</td>";
								echo "</tr>";								
							}
							
							else if($resourcesRow['type']=='video')
							{
								echo "<tr bgcolor=#A9D1FA align ='left' style='text-align:left'>";
									echo "<td class=tabhead align ='left' style='text-align:left'><img src=images/blank.gif width=70 height=6><br><b>VIDEO</b></td>";
									echo "<td class=tabval><a href='".htmlspecialchars($resourcesRow['value'])."' target='_blank'>Click to play video file</a> (".htmlspecialchars($resourcesRow['description']).")</td>";
								echo "</tr>";
							}
							
							else if($resourcesRow['type']=='text')
							{
								
								echo "<tr bgcolor=#A9D1FA align ='left' style='text-align:left'>";
									echo "<td class=tabhead align ='left' style='text-align:left'><img src=images/blank.gif width=70 height=6><br><b>TEXT</b></td>";
									echo "<td class=tabval>".htmlspecialchars($resourcesRow['value'])."</td>";
								echo "</tr>";
							}
						}
				
						if($i>0)
						{
							echo "<tr valign=bottom>";
							echo "<td bgcolor=#ffffff background='images/strichel.gif' colspan=2><img src=images/blank.gif width=1 height=1></td>";
							echo "</tr>";
						}
						
						$i++;

					}

					echo "<tr valign=bottom>";
					echo "<td bgcolor=#A9D1FA colspan=2 style='text-align:center;'><img src=images/blank.gif width=1 height=8></td>";
					echo "</tr>";
					echo "</table>";
				}
				?>
					
        	
					
        	
		</div>
        <div id="content_bottom"></div>
            
            <div align="center" style="align:center;" id="footer"><h3 style="align:center;color:#ffffff">OVW Group</h3></div>
      </div>
   </div>
</body>
</html>
