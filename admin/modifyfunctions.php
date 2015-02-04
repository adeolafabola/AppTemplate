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
<script src="form.js" type="text/javascript"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<!--<link href="xampp.css" rel="stylesheet" type="text/css">-->
<title>Modify sites</title>
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
			
        	<div align="center"> <h1>CURRENT SITES </h1> </div>
					
			
				<?php

					if(!mysql_connect($server, $db_user, $db_pass))
					{
						echo "<h2>Could not connect to database!<br></h2>";
						die();
					}
					mysql_select_db($database);
					
					$androidManifest="../Android/cache.manifest";
					$iosManifest="../ios/cache.manifest";					
					//$webManifest="../Web/cache.manifest";					
				?>
			
				<p>&nbsp;</p>
				<p>&nbsp;</p>
					
				<form action=modifyfunctions.php method=get">
				<table style='border-color: #A9D1FA;' border=1 cellpadding=0 cellspacing=0>
				<tr bgcolor=#A9D1FA align ="center" style="text-align:center;">
					<td class=tabhead><img src=images/blank.gif width=30 height=6><br><b>S/N</b></td>
					<td class=tabhead><img src=images/blank.gif width=140 height=6><br><b>NAME</b></td>
					<td class=tabhead><img src=images/blank.gif width=70 height=6><br><b>TEXT ID</b></td>
					<td class=tabhead><img src=images/blank.gif width=40 height=6><br><b>TYPE</b></td>
					<td class=tabhead><img src=images/blank.gif width=70 height=6><br><b>LAT.</b></td>
					<td class=tabhead><img src=images/blank.gif width=70 height=6><br><b>LON.</b></td>
					<td class=tabhead><img src=images/blank.gif width=30 height=6></td>
					<td class=tabhead><img src=images/blank.gif width=50 height=6></td>
				</tr>
				
				
				<?php
					if(@$_POST['name']!="")
					{
						$stringid=mysql_real_escape_string($_POST['stringid']);
						$name=mysql_real_escape_string($_POST['name']);
						$description=mysql_real_escape_string($_POST['description']);
						$latcoord=mysql_real_escape_string($_POST['latcoord']);
						$longcoord=mysql_real_escape_string($_POST['longcoord']);
						
						$siteClassification=mysql_real_escape_string($_POST['siteClassification']);
						
						$rankOrder=1;
						
						$allowedExts = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
						$temp = explode(".", $_FILES["image"]["name"]);
						$extension = end($temp);

						
						if ((($_FILES["image"]["type"] == "image/jpeg")
						|| ($_FILES["image"]["type"] == "image/jpg")
						|| ($_FILES["image"]["type"] == "image/pjpeg")
						|| ($_FILES["image"]["type"] == "image/x-png")
						|| ($_FILES["image"]["type"] == "image/png"))
						&& in_array($extension, $allowedExts)) 
						{
							$image='uploads/'.$_FILES['image']['name'];
							move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/'.$_FILES['image']['name']);			
							mysql_query("INSERT INTO trailpoints (stringid, name, description, latcoord, longcoord, image, classification, rank_order) VALUES('$stringid','$name', '$description', '$latcoord', '$longcoord', '$image', '$siteClassification', '$rankOrder');");
							mysql_query("INSERT INTO resources (point_stringid, type, description, value, classification) VALUES('$stringid','image', 'Cover Image', '$image', 'modern');");						
						
							$image=str_replace(" ", "%20", $image);
							$newResource="../admin/".$image."\n";
							file_put_contents($androidManifest, $newResource, FILE_APPEND | LOCK_EX);  
							file_put_contents($iosManifest, $newResource, FILE_APPEND | LOCK_EX);
							//file_put_contents($webManifest, $newResource, FILE_APPEND | LOCK_EX);
						}
						
						else
							
						{
							echo "<div align='center'><h3 style='text-align:center;color:red;'>Invalid file upload. Only JPG and PNG images are accepted!</h3></div>";
						}
						
						
						$anotherImage = true;
						$imageCounter = 1;
						while($anotherImage)
						{
							$currentImage = "image_".$imageCounter;
							
							if(!empty ($_FILES[$currentImage]['tmp_name']))
							{
								
								$allowedExts = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
								$temp = explode(".", $_FILES[$currentImage]["name"]);
								$extension = end($temp);
								
								
								if ((($_FILES[$currentImage]["type"] == "image/jpeg")
								|| ($_FILES[$currentImage]["type"] == "image/jpg")
								|| ($_FILES[$currentImage]["type"] == "image/pjpeg")
								|| ($_FILES[$currentImage]["type"] == "image/x-png")
								|| ($_FILES[$currentImage]["type"] == "image/png"))
								&& in_array($extension, $allowedExts)) 
								{
									$currImage='uploads/'.$_FILES[$currentImage]['name'];
									move_uploaded_file($_FILES[$currentImage]['tmp_name'], 'uploads/'.$_FILES[$currentImage]['name']);			

									$currentImageDescription ="imagedescription_".$imageCounter;
									$currImageDescription = mysql_real_escape_string($_POST[$currentImageDescription]);
									
									$currentImageClassification ="imageclassification_".$imageCounter;
									$currImageClassification = mysql_real_escape_string($_POST[$currentImageClassification]);
									
									mysql_query("INSERT INTO resources (point_stringid, type, description, value, classification) VALUES('$stringid','image', '$currImageDescription', '$currImage', '$currImageClassification');");
									
									$currImage=str_replace(" ", "%20", $currImage);
									$newResource="../admin/".$currImage."\n";
									file_put_contents($androidManifest, $newResource, FILE_APPEND | LOCK_EX);  
									file_put_contents($iosManifest, $newResource, FILE_APPEND | LOCK_EX);
									//file_put_contents($webManifest, $newResource, FILE_APPEND | LOCK_EX);
								}
								
								else
									
								{
									echo "<div align='center'><h3 style='text-align:center;color:red;'>Invalid file upload. Only JPG and PNG images are accepted!</h3></div>";
								}
								
								$imageCounter++;
							}
						
							else
							{
								$anotherImage = false;
							}

						}
					
						
					
						$anotherAudio = true;
						$audioCounter = 1;
						while($anotherAudio)
						{
							$currentAudio = "audio_".$audioCounter;
							
							if(!empty ($_FILES[$currentAudio]['tmp_name']))
							{
								$allowedExtsAudio = array("MPEG", "MP3", "mpeg", "mp3");
								$tempAudio = explode(".", $_FILES[$currentAudio]["name"]);
								$extensionAudio = end($tempAudio);
								
								if ((($_FILES[$currentAudio]["type"] == "audio/mpeg")
								|| ($_FILES[$currentAudio]["type"] == "audio/mp3")
								|| ($_FILES[$currentAudio]["type"] == "audio/MPEG")
								|| ($_FILES[$currentAudio]["type"] == "audio/MP3"))
								&& in_array($extensionAudio, $allowedExtsAudio)) 
								{
									$currAudio='uploads/'.$_FILES[$currentAudio]['name'];
									move_uploaded_file($_FILES[$currentAudio]['tmp_name'], 'uploads/'.$_FILES[$currentAudio]['name']);			

									$currentAudioDescription ="audiodescription_".$audioCounter;
									
									$currAudioDescription = mysql_real_escape_string($_POST[$currentAudioDescription]);
									
									mysql_query("INSERT INTO resources (point_stringid, type, description, value, classification) VALUES('$stringid','audio', '$currAudioDescription', '$currAudio', 'nil');");
									
									$currAudio=str_replace(" ", "%20", $currAudio);
									$newResource="../admin/".$currAudio."\n";
									file_put_contents($androidManifest, $newResource, FILE_APPEND | LOCK_EX);  
									file_put_contents($iosManifest, $newResource, FILE_APPEND | LOCK_EX);
									//file_put_contents($webManifest, $newResource, FILE_APPEND | LOCK_EX);
								}
								
								else
								{
									echo "<div align='center'><h3 style='text-align:center;color:red;'>Invalid file upload. Only MP3 files are accepted!</h3></div>";
								}
								
								$audioCounter++;
							}
						
							else
							{
								$anotherAudio = false;
							}

						}
					
					
						$anotherVideo = true;
						$videoCounter = 1;
						while($anotherVideo)
						{							
							$currentVideo = "video_".$videoCounter;
							
							if(!empty ($_FILES[$currentVideo]['tmp_name']))
							{
								$allowedExtsVideo = array("MPEG", "MP4", "mpeg", "mp4");
								$tempVideo = explode(".", $_FILES[$currentVideo]["name"]);
								$extensionVideo = end($tempVideo);
								
								if ((($_FILES[$currentVideo]["type"] == "video/mpeg")
								|| ($_FILES[$currentVideo]["type"] == "video/mp4")
								|| ($_FILES[$currentVideo]["type"] == "video/MPEG")
								|| ($_FILES[$currentVideo]["type"] == "video/MP4"))
								&& in_array($extensionVideo, $allowedExtsVideo)) 
								{
									$currVideo='uploads/'.$_FILES[$currentVideo]['name'];
									move_uploaded_file($_FILES[$currentVideo]['tmp_name'], 'uploads/'.$_FILES[$currentVideo]['name']);			

									$currentVideoDescription ="videodescription_".$videoCounter;
									
									$currVideoDescription = mysql_real_escape_string($_POST[$currentVideoDescription]);
									
									mysql_query("INSERT INTO resources (point_stringid, type, description, value, classification) VALUES('$stringid','video', '$currVideoDescription', '$currVideo', 'nil');");
									
									$currVideo=str_replace(" ", "%20", $currVideo);
									$newResource="../admin/".$currVideo."\n";
									file_put_contents($androidManifest, $newResource, FILE_APPEND | LOCK_EX);  
									file_put_contents($iosManifest, $newResource, FILE_APPEND | LOCK_EX);
									//file_put_contents($webManifest, $newResource, FILE_APPEND | LOCK_EX);
								}
								
								else
									
								{
									echo "<div align='center'><h3 style='text-align:center;color:red;'>Invalid file upload. Only MP4 files are accepted!</h3></div>";
								}
								
								$videoCounter++;
							}
						
							else
							{
								$anotherVideo = false;
							}

						}
						
						$anotherText = true;
						$textCounter = 1;
						while($anotherText)
						{							
							$currentText = "text_".$textCounter;
							
							if(@$_POST[$currentText]!="")
							{
								$currText=mysql_real_escape_string($_POST[$currentText]);

								$currentTextDescription ="textdescription_".$textCounter;
									
								$currTextDescription = mysql_real_escape_string($_POST[$currentTextDescription]);
					
								mysql_query("INSERT INTO resources (point_stringid, type, description, value, classification) VALUES('$stringid','text', '$currTextDescription', '$currText', 'nil');");
							
								$textCounter++;
							}
							
							else
							{
								$anotherText = false;
							}
						}
						
					}
					
					
						if(@$_REQUEST['action']=="delEdit")
						{
							mysql_query("DELETE FROM resources WHERE id=".round($_REQUEST['id']));
							header('Location: modifyfunctions.php?action=edit&id='.round($_REQUEST['siteId'])); 
						}
					
						
						if(@$_POST['action']=="saveEdit")
						{
							$tempSiteId = $_POST['siteId'];
							$newText = "";
							$new_name = "";
							$new_siteClassification = "";
							$new_description = "";
							$new_latcoord = "";
							$new_longcoord = "";
						
								if(isset($_POST['new_name']))
								{
									$new_name = mysql_real_escape_string($_POST['new_name']);
								}
						
								if(isset($_POST['new_siteClassification']))
								{
									$new_siteClassification = mysql_real_escape_string($_POST['new_siteClassification']);
								}
						
								if(isset($_POST['new_description']))
								{
									$new_description = mysql_real_escape_string($_POST['new_description']);
								}
								
								if(isset($_POST['new_latcoord']))
								{
									$new_latcoord = mysql_real_escape_string($_POST['new_latcoord']);
								}
								
							
								if(isset($_POST['new_longcoord']))
								{
									$new_longcoord = mysql_real_escape_string($_POST['new_longcoord']);
								}
								
								mysql_query("update trailpoints SET name='$new_name', description='$new_description', latcoord='$new_latcoord', longcoord='$new_longcoord', classification='$new_siteClassification' where sn=$tempSiteId;");
								header('Location: modifyfunctions.php?action=edit&id='.$tempSiteId); 
						}
					
						if(@$_POST['action']=="newUploads")
						{
							$tempSiteId = $_POST['siteId'];
							
							$new_stringid = "";
						
							$new_idToEditQuery=mysql_query("SELECT * FROM trailpoints WHERE sn=".$tempSiteId);
								
							while( $new_rowToEdit=mysql_fetch_array($new_idToEditQuery) )
							{
								$new_stringid = $new_rowToEdit['stringid'];						
							}
							
							$new_anotherImage = true;
							$new_imageCounter = 1;
							while($new_anotherImage)
							{
								$new_currentImage = "new_image_".$new_imageCounter;
								
								if(!empty ($_FILES[$new_currentImage]['tmp_name']))
								{
									
									$new_allowedExts = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
									$new_temp = explode(".", $_FILES[$new_currentImage]["name"]);
									$new_extension = end($new_temp);
									
									
									if ((($_FILES[$new_currentImage]["type"] == "image/jpeg")
									|| ($_FILES[$new_currentImage]["type"] == "image/jpg")
									|| ($_FILES[$new_currentImage]["type"] == "image/pjpeg")
									|| ($_FILES[$new_currentImage]["type"] == "image/x-png")
									|| ($_FILES[$new_currentImage]["type"] == "image/png"))
									&& in_array($new_extension, $new_allowedExts)) 
									{
										$new_currImage='uploads/'.$_FILES[$new_currentImage]['name'];
										move_uploaded_file($_FILES[$new_currentImage]['tmp_name'], 'uploads/'.$_FILES[$new_currentImage]['name']);			

										$new_currentImageDescription ="new_imagedescription_".$new_imageCounter;
										$new_currImageDescription = mysql_real_escape_string($_POST[$new_currentImageDescription]);
										
										$new_currentImageClassification ="new_imageclassification_".$new_imageCounter;
										$new_currImageClassification = mysql_real_escape_string($_POST[$new_currentImageClassification]);
										
										mysql_query("INSERT INTO resources (point_stringid, type, description, value, classification) VALUES('$new_stringid','image', '$new_currImageDescription', '$new_currImage', '$new_currImageClassification');");
										
										$new_currImage=str_replace(" ", "%20", $new_currImage);
										$new_newResource="../admin/".$new_currImage."\n";
										file_put_contents($androidManifest, $new_newResource, FILE_APPEND | LOCK_EX);   
										file_put_contents($iosManifest, $new_newResource, FILE_APPEND | LOCK_EX);
										//file_put_contents($webManifest, $new_newResource, FILE_APPEND | LOCK_EX);
									}
									
									else
										
									{
										echo "<div align='center'><h3 style='text-align:center;color:red;'>Invalid file upload. Only JPG and PNG images are accepted!</h3></div>";
									}
									
									$new_imageCounter++;
								}
							
								else
								{
									$new_anotherImage = false;
								}

							}
						
							$new_anotherAudio = true;
							$new_audioCounter = 1;
							while($new_anotherAudio)
							{
								$new_currentAudio = "new_audio_".$new_audioCounter;
								
								if(!empty ($_FILES[$new_currentAudio]['tmp_name']))
								{
									$new_allowedExtsAudio = array("MPEG", "MP3", "mpeg", "mp3");
									$new_tempAudio = explode(".", $_FILES[$new_currentAudio]["name"]);
									$new_extensionAudio = end($new_tempAudio);
									
									if ((($_FILES[$new_currentAudio]["type"] == "audio/mpeg")
									|| ($_FILES[$new_currentAudio]["type"] == "audio/mp3")
									|| ($_FILES[$new_currentAudio]["type"] == "audio/MPEG")
									|| ($_FILES[$new_currentAudio]["type"] == "audio/MP3"))
									&& in_array($new_extensionAudio, $new_allowedExtsAudio)) 
									{
										$new_currAudio='uploads/'.$_FILES[$new_currentAudio]['name'];
										move_uploaded_file($_FILES[$new_currentAudio]['tmp_name'], 'uploads/'.$_FILES[$new_currentAudio]['name']);			

										$new_currentAudioDescription ="new_audiodescription_".$new_audioCounter;
										
										$new_currAudioDescription = mysql_real_escape_string($_POST[$new_currentAudioDescription]);
										
										mysql_query("INSERT INTO resources (point_stringid, type, description, value, classification) VALUES('$new_stringid','audio', '$new_currAudioDescription', '$new_currAudio', 'nil');");
										
										$new_currAudio=str_replace(" ", "%20", $new_currAudio);
										$new_newResource="../admin/".$new_currAudio."\n";
										file_put_contents($androidManifest, $new_newResource, FILE_APPEND | LOCK_EX);   
										file_put_contents($iosManifest, $new_newResource, FILE_APPEND | LOCK_EX);
										//file_put_contents($webManifest, $new_newResource, FILE_APPEND | LOCK_EX);
									}
									
									else
									{
										echo "<div align='center'><h3 style='text-align:center;color:red;'>Invalid file upload. Only MP3 files are accepted!</h3></div>";
									}
									
									$new_audioCounter++;
								}
							
								else
								{
									$new_anotherAudio = false;
								}

							}
						
							$new_anotherVideo = true;
							$new_videoCounter = 1;
							while($new_anotherVideo)
							{							
								$new_currentVideo = "new_video_".$new_videoCounter;
								
								if(!empty ($_FILES[$new_currentVideo]['tmp_name']))
								{
									$new_allowedExtsVideo = array("MPEG", "MP4", "mpeg", "mp4");
									$new_tempVideo = explode(".", $_FILES[$new_currentVideo]["name"]);
									$new_extensionVideo = end($new_tempVideo);
									
									if ((($_FILES[$new_currentVideo]["type"] == "video/mpeg")
									|| ($_FILES[$new_currentVideo]["type"] == "video/mp4")
									|| ($_FILES[$new_currentVideo]["type"] == "video/MPEG")
									|| ($_FILES[$new_currentVideo]["type"] == "video/MP4"))
									&& in_array($new_extensionVideo, $new_allowedExtsVideo)) 
									{
										$new_currVideo='uploads/'.$_FILES[$new_currentVideo]['name'];
										move_uploaded_file($_FILES[$new_currentVideo]['tmp_name'], 'uploads/'.$_FILES[$new_currentVideo]['name']);			

										$new_currentVideoDescription ="new_videodescription_".$new_videoCounter;
										
										$new_currVideoDescription = mysql_real_escape_string($_POST[$new_currentVideoDescription]);
										
										mysql_query("INSERT INTO resources (point_stringid, type, description, value, classification) VALUES('$new_stringid','video', '$new_currVideoDescription', '$new_currVideo', 'nil');");
										
										$new_currVideo=str_replace(" ", "%20", $new_currVideo);
										$new_newResource="../admin/".$new_currVideo."\n";
										file_put_contents($androidManifest, $new_newResource, FILE_APPEND | LOCK_EX);   
										file_put_contents($iosManifest, $new_newResource, FILE_APPEND | LOCK_EX);
										//file_put_contents($webManifest, $new_newResource, FILE_APPEND | LOCK_EX);
									}
									
									else
										
									{
										echo "<div align='center'><h3 style='text-align:center;color:red;'>Invalid file upload. Only MP4 files are accepted!</h3></div>";
									}
									
									$new_videoCounter++;
								}
							
								else
								{
									$new_anotherVideo = false;
								}

							}
							
							$new_anotherText = true;
							$new_textCounter = 1;
							while($new_anotherText)
							{							
								$new_currentText = "new_text_".$new_textCounter;
								
								if(@$_POST[$new_currentText]!="")
								{
									$new_currText=mysql_real_escape_string($_POST[$new_currentText]);

									$new_currentTextDescription ="new_textdescription_".$new_textCounter;
										
									$new_currTextDescription = mysql_real_escape_string($_POST[$new_currentTextDescription]);
						
									mysql_query("INSERT INTO resources (point_stringid, type, description, value, classification) VALUES('$new_stringid','text', '$new_currTextDescription', '$new_currText', 'nil');");
								
									$new_textCounter++;
								}
								
								else
								{
									$new_anotherText = false;
								}
							}
						
							//header('Location: modifyfunctions.php?action=edit&id='.$tempSiteId); 
						}
					
					
					

					if(@$_REQUEST['action']=="del")
					{
						$idToDeleteQuery=mysql_query("SELECT * FROM trailpoints WHERE sn=".round($_REQUEST['id']));
					
						$idToDelete = "";
						while( $rowToDelete=mysql_fetch_array($idToDeleteQuery) )
						{
							$idToDelete = $rowToDelete['stringid'];
						}
						
						//mysql_query("DELETE FROM resources WHERE point_stringid=".$idToDelete);
						mysql_query("DELETE FROM resources WHERE point_stringid='".$idToDelete."';");
						mysql_query("DELETE FROM trailpoints WHERE sn=".round($_REQUEST['id']));
					}

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
						echo "<td class=tabval>
							<a onclick=\"return confirm('Edit site details?');\" href=modifyfunctions.php?action=edit&id=".$row['sn']."><span class=red>[EDIT]</span></a>
						</td>";
						echo "<td class=tabval>
							<a onclick=\"return confirm('Delete site?');\" href=modifyfunctions.php?action=del&id=".$row['sn']."><span class=red>[DELETE]</span></a>
						</td>";
						echo "</tr>";
						$i++;

					}

					echo "<tr valign=bottom>";
					echo "<td bgcolor=#A9D1FA colspan=9 style='text-align:center;'><img src=images/blank.gif width=1 height=8>Export list as <a href='modifyfunctions.php?action=getpdf' target='_blank'>PDF document</a></td>";
					echo "</tr>";
				?>
									
				</table>
				</form>
				
				<?php
					if(@$_REQUEST['action']=="edit")
					{
						$idToEditQuery=mysql_query("SELECT * FROM trailpoints WHERE sn=".round($_REQUEST['id']));
					
						$idToEdit = "";
						$nameToEdit = "";
						$descriptionToEdit = "";
						$latToEdit = "";
						$lonToEdit = "";
						$classificationToEdit = "";
							
						while( $rowToEdit=mysql_fetch_array($idToEditQuery) )
						{
							$idToEdit = $rowToEdit['stringid'];
							$nameToEdit = $rowToEdit['name'];
							$descriptionToEdit = $rowToEdit['description'];
							$latToEdit = $rowToEdit['latcoord'];
							$lonToEdit = $rowToEdit['longcoord'];
							$classificationToEdit = $rowToEdit['classification'];							
						}
						
						//------------------
						
						echo "<p>&nbsp;</p>";	
						echo "<form id='editForm' action=modifyfunctions.php method=post>";
						echo "<a name='".$idToEdit."' id='".$idToEdit."'></a>";
						echo "<h1>EDIT SITE DETAILS</h1>";
						echo "<table style='border-color: #A9D1FA;' border=1 cellpadding=0 cellspacing=0>";
						
						echo "<tr valign=bottom>";
						echo "<td bgcolor=#A9D1FA colspan=2 style='text-align:center;'><img src=images/blank.gif width=1 height=8></td>";
						echo "</tr>";
							
						echo "<tr bgcolor=#A9D1FA align =left style=text-align:left>";
							echo "<td class=tabhead align ='left' style='text-align:left'><img src=images/blank.gif width=70 height=6><br><b>NAME</b></td>";
							echo "<td class=tabval>
								<input type=text value='".$nameToEdit."' required size=57 name=new_name>
							
								<input type=hidden name=action value='saveEdit' >
								<input type=hidden name=siteId value='".round($_REQUEST['id'])."' >
								<input type=submit onclick=\"return confirm('Save changes?')\" class=red value='SAVE'>
								
							</td>";
						echo "</tr>";
						
						echo "<tr bgcolor=#A9D1FA align =left style=text-align:left>";
							echo "<td class=tabhead align ='left' style='text-align:left'><img src=images/blank.gif width=70 height=6><br><b>SITE ID</b></td>";
							echo "<td class=tabval>								
								<input type=text value='".$idToEdit."' required disabled pattern='[a-zA-Z]+' size=57 name=new_stringid>
								</td>";
						echo "</tr>";
						
						echo "<tr bgcolor=#A9D1FA align =left style=text-align:left>";
							echo "<td class=tabhead align ='left' style='text-align:left'><img src=images/blank.gif width=70 height=6><br><b>TYPE</b></td>";
							echo "<td class=tabval>
				
									Site<input type='radio' id='new_site' name='new_siteClassification' value='site' required>
									Museum<input type='radio' id='new_museum' name='new_siteClassification' value='museum' required>
									
									<input type=submit onclick=\"return confirm('Save changes?')\" class=red value='SAVE'>
									
									<script type='text/javascript'>
										if('".$classificationToEdit."'=='site')
											document.getElementById('new_site').setAttribute('checked', 'checked');
										else
											document.getElementById('new_museum').setAttribute('checked', 'checked');
									</script>
							</td>";
						echo "</tr>";
						
						echo "<tr bgcolor=#A9D1FA align =left style=text-align:left>";
							echo "<td class=tabhead align ='left' style='text-align:left'><img src=images/blank.gif width=70 height=6><br><b>DESCRIPTION</b></td>";
							echo "<td class=tabval>
								<textarea rows='8' cols='50' required name=new_description >".$descriptionToEdit."</textarea>
								
								<input type=submit onclick=\"return confirm('Save changes?')\" class=red value='SAVE'>
									
							</td>";
						echo "</tr>";
						
						echo "<tr bgcolor=#A9D1FA align =left style=text-align:left>";
							echo "<td class=tabhead align ='left' style='text-align:left'><img src=images/blank.gif width=70 height=6><br><b>LATITUDE</b></td>";
							echo "<td class=tabval>
								<input value='".$latToEdit."' type=text size=57 required name=new_latcoord>		
								
								<input type=submit onclick=\"return confirm('Save changes?')\" class=red value='SAVE'>
							
							</td>";
						echo "</tr>";
						
						echo "<tr bgcolor=#A9D1FA align =left style=text-align:left>";
							echo "<td class=tabhead align ='left' style='text-align:left'><img src=images/blank.gif width=70 height=6><br><b>LONGITUDE</b></td>";
							echo "<td class=tabval>
								<input value='".$lonToEdit."' type=text size=57 required name=new_longcoord>
								
								<input type=submit onclick=\"return confirm('Save changes?')\" class=red value='SAVE'>
								
							</td>";
						echo "</tr>";
						
						$idToEditResourcesQuery=mysql_query("SELECT * FROM resources WHERE point_stringid='".$idToEdit."';");

						while( $resourcesRowToEdit=mysql_fetch_array($idToEditResourcesQuery) )
						{							
							if($resourcesRowToEdit['type']=='audio')
							{
								
								echo "<tr bgcolor=#A9D1FA align ='left' style='text-align:left'>";
									echo "<td class=tabhead align ='left' style='text-align:left'><img src=images/blank.gif width=70 height=6><br><b>AUDIO</b></td>";
									echo "<td class=tabval>".htmlspecialchars($resourcesRowToEdit['description'])." <a class=red href='".htmlspecialchars($resourcesRowToEdit['value'])."' target='_blank'>[PLAY]</a> <a class=red onclick=\"return confirm('Delete file?');\" href=modifyfunctions.php?action=delEdit&id=".$resourcesRowToEdit['id']."&siteId=".round($_REQUEST['id']).">[DELETE]</a></td>";
								echo "</tr>";								
							}
							
							else if($resourcesRowToEdit['type']=='video')
							{
								echo "<tr bgcolor=#A9D1FA align ='left' style='text-align:left'>";
									echo "<td class=tabhead align ='left' style='text-align:left'><img src=images/blank.gif width=70 height=6><br><b>VIDEO</b></td>";
									echo "<td class=tabval>".htmlspecialchars($resourcesRowToEdit['description'])." <a class=red href='".htmlspecialchars($resourcesRowToEdit['value'])."' target='_blank'>[PLAY]</a> <a class=red onclick=\"return confirm('Delete file?');\" href=modifyfunctions.php?action=delEdit&id=".$resourcesRowToEdit['id']."&siteId=".round($_REQUEST['id']).">[DELETE]</a></td>";
								echo "</tr>";
							}
							
							else if($resourcesRowToEdit['type']=='image')
							{
								echo "<tr bgcolor=#A9D1FA align ='left' style='text-align:left'>";
									echo "<td class=tabhead align ='left' style='text-align:left'><img src=images/blank.gif width=70 height=6><br><b>IMAGE</b></td>";
									echo "<td class=tabval>".htmlspecialchars($resourcesRowToEdit['description'])." <a class=red href='".$resourcesRowToEdit['value']."' target='_blank'>[VIEW]</a> <a class=red onclick=\"return confirm('Delete file?');\" href=modifyfunctions.php?action=delEdit&id=".$resourcesRowToEdit['id']."&siteId=".round($_REQUEST['id']).">[DELETE]</a></td>";
								echo "</tr>";
							}
							
							else if($resourcesRowToEdit['type']=='text')
							{
								echo "<tr bgcolor=#A9D1FA align ='left' style='text-align:left'>";
									echo "<td class=tabhead align ='left' style='text-align:left'><img src=images/blank.gif width=70 height=6><br><b>TEXT</b></td>";									
									echo "<td class=tabval><textarea style=' background-color: #D4E8FC' disabled rows='4' cols='50' required name='text_".htmlspecialchars($resourcesRowToEdit['id'])."' >".htmlspecialchars($resourcesRowToEdit['value'])."</textarea> <a class=red onclick=\"return confirm('Delete text?');\" href=modifyfunctions.php?action=delEdit&id=".$resourcesRowToEdit['id']."&siteId=".round($_REQUEST['id']).">[DELETE]</a> </td>";
								echo "</tr>";
							}
						}
						
						echo "</table>";
						echo "</form>";
					
						
						//-----------------
						
						echo "<form action=modifyfunctions.php method=post enctype ='multipart/form-data'>";
						echo "<table style='border-color: #A9D1FA;' border=1 cellpadding=0 cellspacing=0>";
						
						
						echo "<tr valign=bottom>";
						echo "<td bgcolor=#A9D1FA colspan=2 style='text-align:center;'>
							
							<button id='new_imageButton' onclick='new_imageFunction(); return false;'>Add image (JPG/PNG formats only)</button>
							<button id='new_resetImages' onclick=\"resetElements('new_imageDiv'); return false;\">Reset</button>
							<br/>
							<div style='text-align:center;' id='new_imageDiv'></div>
						
						</td>";
						echo "</tr>";
						
						echo "<tr valign=bottom>";
						echo "<td bgcolor=#A9D1FA colspan=2 style='text-align:center;'>
						
							<button id='new_audioButton' onclick='new_audioFunction(); return false;'>Add audio (MP3 format only)</button>
							<button id='new_resetAudio' onclick=\"resetElements('new_audioDiv'); return false;\">Reset</button>
							<br/>
							<div style='text-align:center;' id='new_audioDiv'></div>
						
						</td>";
						echo "</tr>";
						
						echo "<tr valign=bottom>";
						echo "<td bgcolor=#A9D1FA colspan=2 style='text-align:center;'>
						
							<button id='new_videoButton' onclick='new_videoFunction(); return false;'>Add video (MP4 format only)</button>
							<button id='new_resetVideo' onclick=\"resetElements('new_videoDiv'); return false;\">Reset</button>
							<br/>
							<div style='text-align:center;' id='new_videoDiv'></div>
							
						</td>";
						echo "</tr>";
						
						echo "<tr valign=bottom>";
						echo "<td bgcolor=#A9D1FA colspan=2 style='text-align:center;'>
						
							<button id='new_textButton' onclick='new_textFunction(); return false;'>Add text</button>
							<button id='new_resetText' onclick=\"resetElements('new_textDiv'); return false;\">Reset</button>
							<br/>
							<div style='text-align:center;' id='new_textDiv'></div>
							
						</td>";
						echo "</tr>";
						
						echo "<tr valign=bottom>";
						echo "<td bgcolor=#A9D1FA colspan=2 style='text-align:center;'>
						
								<input type=hidden name=action value='newUploads' >
								<input type=hidden name=siteId value='".round($_REQUEST['id'])."' >
								<input onclick=\"return confirm('Upload new resources?')\" type=submit value='Upload resources'>
								<button onclick=\"if(confirm('Discard changes?')){ window.location.href='modifyfunctions.php'; return false;} else {return false;}\">Cancel</button>						
						</td>";
						echo "</tr>";
						
						echo "</table>";
					
						echo "</form>";
						
						echo "<script type='text/javascript'>
						location.hash ='".$idToEdit."';
							/*
							window.addEventListener('load', function(){
								location.hash ='".$idToEdit."';
								alert('".$idToEdit."');
							});
							*/
						</script>";
		
					}
					
						

				
				?>
				
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<hr>
				<h1>ADD NEW SITE</h1>

				<form action=modifyfunctions.php method=post enctype ="multipart/form-data">
					<table style='border-color: #A9D1FA;' border=1 cellpadding=0 cellspacing=0>
						
						<tr bgcolor=#A9D1FA align =left style='text-align:center'>
							<td bgcolor=#A9D1FA colspan=2 style="text-align:center;color:navy; font-weight: bold;">REQUIRED FIELDS</td>
						</tr>
						
						<tr bgcolor=#A9D1FA align =left style=text-align:left>
							<td class=tabhead align='left' style='text-align:left'><img src=images/blank.gif width=70 height=6><br><b>SITE NAME</b></td>
							<td class=tabval> <input type=text required size=57 name=name placeholder="Enter Name">	</td>
						</tr>
						
						<tr bgcolor=#A9D1FA align =left style=text-align:left>
							<td class=tabhead align='left' style='text-align:left'><img src=images/blank.gif width=70 height=6><br><b>SITE ID</b></td>
							<td class=tabval> <input type=text required pattern='[a-zA-Z]+' size=57 name=stringid placeholder="Enter a unique identifier(No spaces allowed)"></td>
						</tr>
						
						<tr bgcolor=#A9D1FA align =left style=text-align:left>
							<td class=tabhead align='left' style='text-align:left'><img src=images/blank.gif width=70 height=6><br><b>SITE DESCRIPTION</b></td>
							<td class=tabval> <textarea rows="4" cols="51" required name=description placeholder="Enter Description"></textarea> </td>
						</tr>
						
						<tr bgcolor=#A9D1FA align =left style=text-align:left>
							<td class=tabhead align='left' style='text-align:left'><img src=images/blank.gif width=70 height=6><br><b>LATITUDE</b></td>
							<td class=tabval> <input type=text size=57 required name=latcoord placeholder="enter Latitude Coordinates"> </td>
						</tr>
						
						<tr bgcolor=#A9D1FA align =left style=text-align:left>
							<td class=tabhead align='left' style='text-align:left'><img src=images/blank.gif width=70 height=6><br><b>LONGITUDE</b></td>
							<td class=tabval> <input type=text size=57 required name=longcoord placeholder="Longitude Coordinates">	</td>
						</tr>
						
						<tr bgcolor=#A9D1FA align =left style=text-align:left>
							<td class=tabhead align='left' style='text-align:left'><img src=images/blank.gif width=70 height=6><br><b>TYPE</b></td>
							<td class=tabval> 
								Site<input type='radio' name='siteClassification' value='site' required  checked>
								&nbsp;
								Museum<input type='radio' name='siteClassification' value='museum' required>
							</td>
						</tr>
						
						<tr bgcolor=#A9D1FA align =left style=text-align:left>
							<td class=tabhead align='left' style='text-align:left'><img src=images/blank.gif width=70 height=6><br><b>COVER IMAGE</b></td>
							<td class=tabval> <input type=file size=19 required accept="image/jpeg, image/png" name="image" id="image" value="Upload file">	</td>
						</tr>
						
						<tr bgcolor=#A9D1FA align =left style='text-align:center'>
							<td bgcolor=#A9D1FA colspan=2 style="text-align:center;color:navy; font-weight: bold;">OPTIONAL FIELDS</td>
						</tr>
						
						<tr valign=bottom>
						<td bgcolor=#A9D1FA colspan=2 style='text-align:center;'>
							
							<button id='imageButton' onclick='imageFunction(); return false;'>Add image (JPG/PNG formats only)</button>
							<button id='resetImages' onclick="resetElements('imageDiv'); return false;">Reset</button>
							<br/>
							<div style='text-align:center;' id='imageDiv'></div>
						
						</td>
						</tr>
						
						<tr valign=bottom>
						<td bgcolor=#A9D1FA colspan=2 style='text-align:center;'>
						
							<button id='audioButton' onclick='audioFunction(); return false;'>Add audio (MP3 format only)</button>
							<button id='resetAudio' onclick="resetElements('audioDiv'); return false;">Reset</button>
							<br/>
							<div style='text-align:center;' id='audioDiv'></div>
						
						</td>
						</tr>
						
						<tr valign=bottom>
						<td bgcolor=#A9D1FA colspan=2 style='text-align:center;'>
						
							<button id='videoButton' onclick='videoFunction(); return false;'>Add video (MP4 format only)</button>
							<button id='resetVideo' onclick="resetElements('videoDiv'); return false;">Reset</button>
							<br/>
							<div style='text-align:center;' id='videoDiv'></div>
							
						</td>
						</tr>
						
						<tr valign=bottom>
						<td bgcolor=#A9D1FA colspan=2 style='text-align:center;'>
						
							<button id='textButton' onclick='textFunction(); return false;'>Add text</button>
							<button id='resetText' onclick="resetElements('textDiv'); return false;">Reset</button>
							<br/>
							<div style='text-align:center;' id='textDiv'></div>
							
						</td>
						</tr>
						
						<tr valign=bottom>
						<td bgcolor=#A9D1FA colspan=2 style='text-align:center;'>

								<input onclick="return confirm('Add new site?')" type=submit value='Add site'>
								<button onclick="if(confirm('Discard changes?')){ window.location.href='modifyfunctions.php'; return false;} else {return false;}">Cancel</button>						
						</td>
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
