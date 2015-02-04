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
						$pdf->Write(5, 'LIST OF SMS RECORDS');
						$pdf->Ln();

						$pdf->SetFontSize(10);
						$pdf->Ln();

						$pdf->Ln(5);


						$pdf->SetFont('Helvetica', 'B', 10);
						$pdf->Cell(10 ,7, 'S/N', 1);
						$pdf->Cell(40 ,7, 'USER', 1);
						$pdf->Cell(50 ,7, 'TEXT RECEIVED', 1);
						$pdf->Cell(40 ,7, 'DATE AND TIME', 1);
						$pdf->Ln();

						$pdf->SetFont('Helvetica', '', 10);

						$result=mysql_query("SELECT * FROM records ORDER BY sn DESC;");

						$j=1;
						while ($row = mysql_fetch_array($result)) {
							$pdf->Cell(10, 7, $j++, 1);
							$pdf->Cell(40, 7, $row['user'], 1);
							$pdf->Cell(50, 7, $row['text_received'], 1);
							$pdf->Cell(40, 7, $row['date_and_time'], 1);
							$pdf->Ln();
						}

						$pdf->Output();
						exit;
					}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<!--<link href="xampp.css" rel="stylesheet" type="text/css">-->
<title>Modify Records</title>
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
			
        	<div align="center"> <h1>RECORDS </h1> </div>
			
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
					
				<table border=0 cellpadding=0 cellspacing=0>
				<tr bgcolor=#A9D1FA align ="center" style="text-align:center;">
					<td><img src=images/blank.gif width=10 height=25></td>
					<td class=tabhead><img src=images/blank.gif width=30 height=6><br><b>S/N</b></td>
					<td class=tabhead><img src=images/blank.gif width=150 height=6><br><b>USER</b></td>
					<td class=tabhead><img src=images/blank.gif width=150 height=6><br><b> TEXT RECEIVED</b></td>
					<td class=tabhead><img src=images/blank.gif width=150 height=6><br><b> DATE AND TIME</b></td>
					<td class=tabhead><img src=images/blank.gif width=50 height=6><br><b></b></td>
					<td><img src=images/blank.gif width=10 height=25></td>
				</tr>
				
				<?php
					
					if(@$_REQUEST['action']=="del")
					{
						mysql_query("DELETE FROM records WHERE sn=".round($_REQUEST['id']));
					}
				
					$result=mysql_query("SELECT * FROM records ORDER BY sn DESC;");
					
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
						echo "<td class=tabval><b>".htmlspecialchars($row['user'])."</b></td>";
						echo "<td class=tabval>".htmlspecialchars($row['text_received'])."&nbsp;</td>";
						echo "<td class=tabval>".htmlspecialchars($row['date_and_time'])."&nbsp;</td>";

						echo "<td class=tabval><a onclick=\"return confirm('Delete record?');\"href=modifyrecords.php?action=del&id=".$row['sn']."><span class=red>[DELETE]</span></a></td>";
						echo "<td class=tabval></td>";
						echo "</tr>";
						$i++;

					}

					echo "<tr valign=bottom>";
					echo "<td bgcolor=#A9D1FA colspan=7 style='text-align:center;'><img src=images/blank.gif width=1 height=8>Export list as <a href='modifyrecords.php?action=getpdf' target='_blank'>PDF document</a></td>";
					echo "</tr>";
				?>
									
				</table>
				
					
        	
					
        	
		</div>
        <div id="content_bottom"></div>
            
            <div align="center" style="align:center;" id="footer"><h3 style="align:center;color:#ffffff">OVW Group</h3></div>
      </div>
   </div>
</body>
</html>
