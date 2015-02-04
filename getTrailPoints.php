<?php


header("access-control-allow-origin: *");
header("access-control-allow-methods: GET, POST, OPTIONS");
header("access-control-allow-credentials: true");
header("access-control-allow-headers: Content-Type, *");
header("Content-type: application/json");


						include("config.php"); 

						// connect to the mysql server 
						$link = mysql_connect($server, $db_user, $db_pass) 
						or die ("Could not connect to mysql because ".mysql_error()); 

						// select the database 
						mysql_select_db($database) 
						or die ("Could not select database because ".mysql_error()); 

						$result=mysql_query("SELECT * FROM trailpoints ORDER BY rank_order;");
					
					$j=1;
					$output="";
					$resourcePages="";
										
					while( $row=mysql_fetch_array($result) )
					{
						
						$resourcesResult=mysql_query("SELECT * FROM resources WHERE point_stringid='".$row['stringid']."' AND description!='Cover Image' ORDER BY id;");
						
						$resourcesOutput="";
						
						$resourcesOutputButtons="";

						$imagePresent="false";
						$modernimagePresent="false";
						$historicimagePresent="false";
						$virtualimagePresent="false";
						$audioPresent="false";
						$extraAudioPresent="false";
						$videoPresent="false";
						$textPresent="false";
						$panoramaPresent="false"; 
						$threeDViewPresent="false";
						$extraAudioButtons="";
						
						while( $resourcesRow=mysql_fetch_array($resourcesResult) )
						{
							if($resourcesRow['type']=='image')
							{
								$resourcesOutput.="<div id='".htmlspecialchars($row['stringid'])."_image' data-role='popup'  class='ui-content' data-transition='fade' align='center'> <a href='#' data-rel='back' data-role='button'  data-icon='delete' data-iconpos='notext' class='ui-btn-right'>Close</a> <a href='#".htmlspecialchars($row['stringid'])."_imagepage'><img class='imageholder' src='../admin/".htmlspecialchars($resourcesRow['value'])."' alt='No image available'></a><br><p style='color:#3B0B0B;text-align:center;font-style:italic;font-size:small;'>".htmlspecialchars($resourcesRow['description'])." (Tap for more images)</p></div>";
								$imagePresent="true";
								
								if($resourcesRow['classification']=='modern')
								{
									$modernimagePresent="true";
								}
								
								if($resourcesRow['classification']=='historic')
								{
									$historicimagePresent="true";
								}
								
								if($resourcesRow['classification']=='virtual')
								{
									$virtualimagePresent="true";
								}
							}
							
							
							if($resourcesRow['type']=='audio')
							{
								$resourcesOutput.="<div id='".htmlspecialchars($row['stringid'])."_audio' data-role='popup'  class='ui-content' style='background-image:url(css/images/scroll.jpg);background-size: 100% 100%;' data-transition='fade' align='center' data-overlay-theme='a' data-theme='d'> <a href='#' data-rel='back' data-role='button' data-theme='a' data-icon='delete' data-mini='true' data-iconpos='top' class='ui-btn-right'></a> <audio id='".htmlspecialchars($row['stringid'])."_audioHolder' name='".htmlspecialchars($row['stringid'])."_audioHolder' controls preload='none'> <source src='../admin/".htmlspecialchars($resourcesRow['value'])."' type='audio/mpeg'> No audio available!</audio><br><p style='color:#3B0B0B;text-align:center;font-style:italic;font-size:small;'>".htmlspecialchars($resourcesRow['description'])."</p></div>";
								$audioPresent="true";
								
								if($resourcesRow['classification']=='extra')
								{
									$resourcesOutput.="<div id='".htmlspecialchars($row['stringid'])."_extraAudio_".htmlspecialchars($resourcesRow['id'])."' data-role='popup'  class='ui-content extraAudioPopups' style='background-image:url(css/images/scroll.jpg);background-size: 100% 100%;' data-transition='fade' align='center' data-overlay-theme='a' data-theme='d'> <a href='#' data-rel='back' data-role='button' data-theme='a' data-icon='delete' data-mini='true' data-iconpos='top' class='ui-btn-right'></a> <audio class='extraAudioSources' id='".htmlspecialchars($row['stringid'])."_extraAudioHolder_".htmlspecialchars($resourcesRow['id'])."' name='".htmlspecialchars($row['stringid'])."_extraAudioHolder_".htmlspecialchars($resourcesRow['id'])."' controls preload='none'> <source src='../admin/".htmlspecialchars($resourcesRow['value'])."' type='audio/mpeg'> No audio available!</audio><br><p style='color:#3B0B0B;text-align:center;font-style:italic;font-size:small;'>".htmlspecialchars($resourcesRow['description'])."</p></div>";
									$extraAudioButtons.="<a href='#".htmlspecialchars($row['stringid'])."_extraAudio_".htmlspecialchars($resourcesRow['id'])."' onclick=\"playAudio('".htmlspecialchars($row['stringid'])."_extraAudioHolder_".htmlspecialchars($resourcesRow['id'])."');\" id='extraAudioButton".htmlspecialchars($row['stringid'])."_".htmlspecialchars($resourcesRow['id'])."' data-role='button' data-icon='audio3' data-iconpos='notext' data-rel='popup' data-position-to='window' style='height: 40px !important; width: 40px !important;'>Audio</a>";									
									$extraAudioPresent="true";
								}
							}
							
							else if($resourcesRow['type']=='video')
							{
								$resourcesOutput.="<div id='".htmlspecialchars($row['stringid'])."_video' data-role='popup'  class='ui-content' style='background-image:url(css/images/scroll.jpg);background-size: 100% 100%;' data-transition='fade' align='center' data-overlay-theme='a' data-theme='d'> <a href='#' data-rel='back' data-theme='a' data-role='button'  data-icon='delete' data-iconpos='top' class='ui-btn-right'> </a> <video id='".htmlspecialchars($row['stringid'])."_videoHolder' name='".htmlspecialchars($row['stringid'])."_videoHolder' class='imageholder' controls     preload='none'> <source src='../admin/".htmlspecialchars($resourcesRow['value'])."' type='video/mp4'> No video available!</video><br><p style='color:#3B0B0B;text-align:center;font-style:italic;font-size:small;'>".htmlspecialchars($resourcesRow['description'])."</p></div>";
								$videoPresent="true";
							}
							
							else if($resourcesRow['type']=='text')
							{
								$resourcesOutput.="<div id='".htmlspecialchars($row['stringid'])."_text' data-role='popup'  class='ui-content' style='background-image:url(css/images/scroll.jpg);background-size: 100% 100%;' data-transition='fade' align='justify' data-overlay-theme='a' data-theme='d'> <a href='#' data-rel='back' data-theme='a' data-role='button'  data-icon='delete' data-iconpos='notext' class='ui-btn-right'>Close</a> <h5 style='color:#3B0B0B;'>".htmlspecialchars($resourcesRow['value'])."</h5></div>";
								$textPresent="true";
							}
							
							else if($resourcesRow['type']=='panorama')
							{
								$resourcesOutput.="<div id='".htmlspecialchars($row['stringid'])."_panorama' data-role='popup'  class='ui-content' style='background-image:url(css/images/scroll.jpg);background-size: 100% 100%;' data-transition='fade' align='justify' data-overlay-theme='a' data-theme='d' data-dismissible='true'> <a href='#' onclick=\"$('#".htmlspecialchars($row['stringid'])."_panorama_iframe').get(0).contentWindow.location.replace('about:blank');\" data-rel='back' data-theme='a' data-role='button'  data-icon='delete' data-iconpos='top' class='ui-btn-right'></a><iframe id='".htmlspecialchars($row['stringid'])."_panorama_iframe' name='panorama.html".htmlspecialchars($resourcesRow['value'])."' src=''></iframe> </div>";
								$panoramaPresent="true";
							}
						}
						
						if(!empty($resourcesOutput))
						{							
							$resourcesOutputButtons.="<div data-role='popup' id='".htmlspecialchars($row['stringid'])."_menu'>";
							$resourcesOutputButtons.="<ul data-role='listview' data-mini='true' data-inline='true' data-inset='true'>";
							
							if($imagePresent=="true")
								{
									$resourcesOutputButtons.="<li data-icon='camera' class='icon-camera'><a href='#".htmlspecialchars($row['stringid'])."_imagepage' data-transition='fade'>Images</a></li>";
								}
								
							if($audioPresent=="true")
								{
									$resourcesOutputButtons.="<li data-icon='audio' class='icon-audio'><a href='#".htmlspecialchars($row['stringid'])."_audiopage' data-transition='fade'>Audio</a></li>";
								}
								
							if($videoPresent=="true")
								{
									$resourcesOutputButtons.="<li data-icon='video' class='icon-video'><a href='#".htmlspecialchars($row['stringid'])."_videopage' data-transition='fade'>Videos</a></li>";
								}
								
							if($textPresent=="true")
								{
									$resourcesOutputButtons.="<li data-icon='info'><a href='#".htmlspecialchars($row['stringid'])."_textpagepopup' data-position-to='window' data-rel='popup'>Additional information</a></li>";								
								}
								
							$resourcesOutputButtons.="<li data-icon='location' class='icon-location'><a class='toLoad' href='trailmap.html#(".htmlspecialchars($row['latcoord']).", ".htmlspecialchars($row['longcoord']).")' rel='external'>Show on Map</a></li>";								
							
							$resourcesOutputButtons.="</ul>";
							$resourcesOutputButtons.="</div>";
						}
						
						else
						{
							$resourcesOutputButtons.="<div data-role='popup' id='".htmlspecialchars($row['stringid'])."_menu'>";
							$resourcesOutputButtons.="<ul data-role='listview' data-mini='true' data-inline='true' data-inset='true'>";
							$resourcesOutputButtons.="<li data-icon='location' class='icon-location'><a class='toLoad' href='trailmap.html#(".htmlspecialchars($row['latcoord']).", ".htmlspecialchars($row['longcoord']).")' rel='external'>Show on Map</a></li>";															
							$resourcesOutputButtons.="</ul>";
							$resourcesOutputButtons.="</div>";
						}
						
							$resourcePages.="<div data-role='page' style='background-image:url(css/images/scroll.jpg);background-size: 100% 100%;' id='".htmlspecialchars($row['stringid'])."_imagepage' data-dom-cache='false'>";
							
							$resourcePages.="<div data-role='header'>";
								$resourcePages.="<a href='' data-icon='arrow-l' onclick='window.history.back();' data-role='button' data-mini='true' data-inline='true'>Back</a>";
								$resourcePages.="<h1>".htmlspecialchars($row['name'])." images</h1>";
							$resourcePages.="</div>";
							
							$resourcePages.="<div data-role='content'>";
								$resourcePages.="<ul data-role='listview' data-mini='true' data-inline='true' data-inset='true'>";
								
								if($modernimagePresent=="true")
								{
									$resourcePages.="<li><a href='#".htmlspecialchars($row['stringid'])."_modernimagepage' data-transition='fade'>Modern Images</a></li>";
								}	
								
								if($historicimagePresent=="true")
								{
									$resourcePages.="<li><a href='#".htmlspecialchars($row['stringid'])."_historicimagepage' data-transition='fade'>Historic Images</a></li>";
								}
								
								if($virtualimagePresent=="true")
								{
									$resourcePages.="<li><a href='#".htmlspecialchars($row['stringid'])."_virtualimagepage' data-transition='fade'>Virtual Images</a></li>";
								}
									
								$resourcePages.="</ul>";
							$resourcePages.="</div>";
							
							$resourcePages.="<div data-role='footer' data-position='fixed'>";
								$resourcePages.="<h6>Open Virtual Worlds Group</h6>";
							$resourcePages.="</div>";
						$resourcePages.="</div>";
						$resourcePages.="<br>";
						
						
						
						$resourcePages.="<div data-role='page' style='background-image:url(css/images/scroll.jpg);background-size: 100% 100%;' id='".htmlspecialchars($row['stringid'])."_modernimagepage' class='gallery-page' data-dom-cache='false'>";
						$resourcePages.="<div data-role='header'>";
							$resourcePages.="<a href='' data-icon='arrow-l' onclick='window.history.back();' data-role='button' data-mini='true' data-inline='true'>Back</a>";
							$resourcePages.="<h1>".htmlspecialchars($row['name'])." modern images</h1>";
						$resourcePages.="</div>";
						$resourcePages.="<div data-role='content'>";
							$resourcePages.="<div class='gallery'>";
								$resourcePages.="<div class='gallery-row'>";
						
						$modernimageResult=mysql_query("SELECT * FROM resources WHERE point_stringid='".$row['stringid']."' AND type='image' AND classification='modern' AND description!='Cover Image' ORDER BY id;");
												
						while( $modernimagesRow=mysql_fetch_array($modernimageResult) )
						{							
							$resourcePages.="<div class='gallery-item' style='height:150px; padding:0px 0px 10px 0px; overflow: hidden;' ><a href='../admin/".htmlspecialchars($modernimagesRow['value'])."' ><img class='imagethumb'  src='../admin/".htmlspecialchars($modernimagesRow['value'])."' alt='".htmlspecialchars($modernimagesRow['description'])."'/></a></div>";								
						}
						
									$resourcePages.="</div>";
								$resourcePages.="</div>";
							$resourcePages.="</div>";
							$resourcePages.="<div data-role='footer' data-position='fixed'>";
								$resourcePages.="<h6>Open Virtual Worlds Group</h6>";
							$resourcePages.="</div>";
						$resourcePages.="</div>";
						$resourcePages.="<br>";
						
						
						
						$resourcePages.="<div data-role='page' style='background-image:url(css/images/scroll.jpg);background-size: 100% 100%;' id='".htmlspecialchars($row['stringid'])."_historicimagepage' class='gallery-page' data-dom-cache='false'>";
						$resourcePages.="<div data-role='header'>";
							$resourcePages.="<a href='' data-icon='arrow-l' onclick='window.history.back();' data-role='button' data-mini='true' data-inline='true'>Back</a>";
							$resourcePages.="<h1>".htmlspecialchars($row['name'])." historic images</h1>";
						$resourcePages.="</div>";
						$resourcePages.="<div data-role='content'>";
							$resourcePages.="<div class='gallery'>";
								$resourcePages.="<div class='gallery-row'>";
						
						$historicimageResult=mysql_query("SELECT * FROM resources WHERE point_stringid='".$row['stringid']."' AND type='image' AND classification='historic' AND description!='Cover Image' ORDER BY id;");
												
						while( $historicimagesRow=mysql_fetch_array($historicimageResult) )
						{							
							$resourcePages.="<div class='gallery-item' style='height:150px; padding:0px 0px 10px 0px; overflow: hidden;' ><a href='../admin/".htmlspecialchars($historicimagesRow['value'])."' ><img class='imagethumb'  src='../admin/".htmlspecialchars($historicimagesRow['value'])."' alt='".htmlspecialchars($historicimagesRow['description'])."'/></a></div>";								
						}
						
									$resourcePages.="</div>";
								$resourcePages.="</div>";
							$resourcePages.="</div>";
							$resourcePages.="<div data-role='footer' data-position='fixed'>";
								$resourcePages.="<h6>Open Virtual Worlds Group</h6>";
							$resourcePages.="</div>";
						$resourcePages.="</div>";
						$resourcePages.="<br>";
						
						
						$resourcePages.="<div data-role='page' style='background-image:url(css/images/scroll.jpg);background-size: 100% 100%;' id='".htmlspecialchars($row['stringid'])."_virtualimagepage' class='gallery-page' data-dom-cache='false'>";
						$resourcePages.="<div data-role='header'>";
							$resourcePages.="<a href='' data-icon='arrow-l' onclick='window.history.back();' data-role='button' data-mini='true' data-inline='true'>Back</a>";
							$resourcePages.="<h1>".htmlspecialchars($row['name'])." virtual images</h1>";
						$resourcePages.="</div>";
						$resourcePages.="<div data-role='content'>";
							$resourcePages.="<div class='gallery'>";
								$resourcePages.="<div class='gallery-row'>";
						
						$virtualimageResult=mysql_query("SELECT * FROM resources WHERE point_stringid='".$row['stringid']."' AND type='image' AND classification='virtual' AND description!='Cover Image' ORDER BY id;");
												
						while( $virtualimagesRow=mysql_fetch_array($virtualimageResult) )
						{							
							$resourcePages.="<div class='gallery-item' style='height:150px; padding:0px 0px 10px 0px; overflow: hidden;' ><a href='../admin/".htmlspecialchars($virtualimagesRow['value'])."' ><img class='imagethumb'  src='../admin/".htmlspecialchars($virtualimagesRow['value'])."' alt='".htmlspecialchars($virtualimagesRow['description'])."'/></a></div>";								
						}
						
									$resourcePages.="</div>";
								$resourcePages.="</div>";
							$resourcePages.="</div>";
							$resourcePages.="<div data-role='footer' data-position='fixed'>";
								$resourcePages.="<h6>Open Virtual Worlds Group</h6>";
							$resourcePages.="</div>";
						$resourcePages.="</div>";
						$resourcePages.="<br>";
						
						
						$resourcePages.="<div data-role='page' style='background-image:url(css/images/scroll.jpg);background-size: 100% 100%;' id='".htmlspecialchars($row['stringid'])."_audiopage' data-dom-cache='false'>";
							
							$resourcePages.="
							<script type='text/javascript'>
								$(document).delegate('#".htmlspecialchars($row['stringid'])."_audiopage', 'pageshow', function () 
								{									
									$(this).bind('pagebeforehide', function() 
									{
										$(this).find('audio').each(function() 
										{
											$(this)[0].pause();
										});
									});
								
								});
							</script>";
							
							$resourcePages.="<div data-role='header'>";
								$resourcePages.="<a href='' data-icon='arrow-l' onclick='window.history.back();' data-role='button' data-mini='true' data-inline='true'>Back</a>";
								$resourcePages.="<h1>".htmlspecialchars($row['name'])." audio files</h1>";
							$resourcePages.="</div>";
						
							$resourcePages.="<div data-role='content'>";
						
						$audioResult=mysql_query("SELECT * FROM resources WHERE point_stringid='".$row['stringid']."' AND type='audio' ORDER BY id;");
												
								while( $audiosRow=mysql_fetch_array($audioResult) )
								{															
									$resourcePages.="<div id='".htmlspecialchars($row['stringid'])."_audio".htmlspecialchars($audiosRow['id'])."' class='ui-content' align='center'>  <audio id='".htmlspecialchars($row['stringid'])."_audio".htmlspecialchars($audiosRow['id'])."' name='".htmlspecialchars($row['stringid'])."_audio".htmlspecialchars($audiosRow['id'])."' controls preload='none'> <source src='../admin/".htmlspecialchars($audiosRow['value'])."' type='audio/mpeg'> No audio available!</audio><br><p style='background-image:url(css/images/scroll.jpg);background-size: 100% 100%;color:#3B0B0B;text-align:center;font-style:italic;font-size:small;font-weight:bold;'>".htmlspecialchars($audiosRow['description'])."</p></div>";
								}
						
							$resourcePages.="</div>";
							
							$resourcePages.="<div data-role='footer' data-position='fixed'>";
								$resourcePages.="<h6>Open Virtual Worlds Group</h6>";
							$resourcePages.="</div>";
						$resourcePages.="</div>";
						$resourcePages.="<br>";
						

						$resourcePages.="<div data-role='page' style='background-image:url(css/images/scroll.jpg);background-size: 100% 100%;' id='".htmlspecialchars($row['stringid'])."_videopage' data-dom-cache='false'>";
							$resourcePages.="<div data-role='header'>";
								$resourcePages.="<a href='' data-icon='arrow-l' onclick='window.history.back();' data-role='button' data-mini='true' data-inline='true'>Back</a>";
								$resourcePages.="<h1>".htmlspecialchars($row['name'])." videos</h1>";
							$resourcePages.="</div>";
						
							$resourcePages.="<div data-role='content'>";
							
							$resourcePages.="<ul data-role='listview' data-mini='true' data-inline='true' data-inset='true'>";
							
						
						$videoResult=mysql_query("SELECT * FROM resources WHERE point_stringid='".$row['stringid']."' AND type='video' ORDER BY id;");
												
								while( $videosRow=mysql_fetch_array($videoResult) )
								{															
									//This displays all the videos on the screen; it is an alternative to the following two lines 
									//$resourcePages.="<div id='".htmlspecialchars($row['stringid'])."_video".htmlspecialchars($videosRow['id'])."' class='ui-content' align='center'>  <video id='".htmlspecialchars($row['stringid'])."_video".htmlspecialchars($videosRow['id'])."' name='".htmlspecialchars($row['stringid'])."_video".htmlspecialchars($videosRow['id'])."' controls     preload='none'> <source src='../admin/".htmlspecialchars($videosRow['value'])."' type='video/mp4'> No video available!</video><br><p style='color:#3B0B0B;text-align:center;font-style:italic;font-size:small;'>".htmlspecialchars($videosRow['description'])."</p></div>";
																		
									$resourcePages.="<div id='".htmlspecialchars($row['stringid'])."_videoPopup".htmlspecialchars($videosRow['id'])."' class='ui-content videoPopups' data-role='popup' data-overlay-theme='a' data-theme='d' data-transition='pop' style='background-image:url(css/images/scroll.jpg);background-size: 100% 100%; align:center;' align=center> <a href='#' data-rel='back' data-theme='a' data-role='button'  data-icon='delete' data-iconpos='top' class='ui-btn-right'> </a> <video id='".htmlspecialchars($row['stringid'])."_video".htmlspecialchars($videosRow['id'])."' name='".htmlspecialchars($row['stringid'])."_video".htmlspecialchars($videosRow['id'])."' class='videoPopupVideos' width='300' controls preload='none'> <source src='../admin/".htmlspecialchars($videosRow['value'])."' type='video/mp4'> No video available!</video><br><p style='color:#3B0B0B;text-align:center;font-style:italic;font-size:small;'>".htmlspecialchars($videosRow['description'])."</p></div>";																		
									$resourcePages.="<li><a  href='#".htmlspecialchars($row['stringid'])."_videoPopup".htmlspecialchars($videosRow['id'])."' onclick=\"videoFullScreen('".htmlspecialchars($row['stringid'])."_video".htmlspecialchars($videosRow['id'])."'); $('#".htmlspecialchars($row['stringid'])."_videoPopup".htmlspecialchars($videosRow['id'])."').bind('popupafterclose', function() {document.getElementById('".htmlspecialchars($row['stringid'])."_video".htmlspecialchars($videosRow['id'])."').pause();}); \" data-rel='popup' data-position-to='window'>".htmlspecialchars($videosRow['description'])."</a></li>";
								}
						
							$resourcePages.="</ul>";
								
							$resourcePages.="</div>";
							
							$resourcePages.="<div data-role='footer' data-position='fixed'>";
								$resourcePages.="<h6>Open Virtual Worlds Group</h6>";
							$resourcePages.="</div>";
						$resourcePages.="</div>";
						$resourcePages.="<br>";
						
						
						
						$resourcePages.="<div data-role='page'  style='overflow:hidden; background-image:url(css/images/scroll.jpg);background-size: 100% 100%; background-repeat: repeat-y;' class='sitePage' id='".htmlspecialchars($row['stringid'])."_homepage' data-dom-cache='false'>";
									
							$resourcePages.="<div data-role='header' data-position=fixed>";
								//The commented line below makes the back button go to the last page visited, as opposed to going to the trailpoints.html page as the uncommented line (below) does
								//$resourcePages.="<a href='' data-icon='arrow-l' onclick='window.history.back();' data-role='button' data-mini='true' data-inline='true'>Back</a>";
								$resourcePages.="<a href='trailpoints.html' data-icon='arrow-l' data-role='button' data-mini='true' data-inline='true'>Sites</a>";
								
								$resourcePages.="<h1>".htmlspecialchars($row['name'])."</h1>";
								
								$resourcePages.="<div id='fontResizeGroup' class='ui-btn-right' data-role='controlgroup' data-type='horizontal'> <a href='javascript:changeFontSize(-2)' id='fontDecrease".htmlspecialchars($row['stringid'])."' data-role='button' data-icon='fontDecrease' data-iconpos='notext'>Decrease</a> <a href='javascript:changeFontSize(2)' id='fontIncrease".htmlspecialchars($row['stringid'])."' data-role='button' data-icon='fontIncrease' data-iconpos='notext'>Increase</a> </div>";								

							$resourcePages.="</div>";
						
						//Popup div with all the texts						
						$resourcePages.="<div data-role='popup' id='".htmlspecialchars($row['stringid'])."_textpagepopup' data-dismissible='true' data-corners='true' style='max-height:300px;' data-overlay-theme='a' data-theme='d'>";	//max-height used with fixed dimensions in px, cos % doesn't work
						$resourcePages.="<a href='#' data-rel='back' data-role='button' data-theme='a' data-icon='delete' data-mini='true' data-iconpos='top' class='ui-btn-right'></a>";
						
						$resourcePages.="<div data-role='content' style='max-height:300px;background-image:url(css/images/scroll.jpg);background-size: 100% 100%;overflow-x:hidden;overflow-y:auto;'>";
						
							$textResult=mysql_query("SELECT * FROM resources WHERE point_stringid='".$row['stringid']."' AND type='text' ORDER BY id;");
												
								while( $textRow=mysql_fetch_array($textResult) )
								{															
									$resourcePages.="  <p style='color:#3B0B0B;text-align:justify;font-size:small;font-weight:bold;'>".htmlspecialchars($textRow['value'])."</p> <hr>";
								}
						
							$resourcePages.="</div>";
							
							$resourcePages.="</div>";
						
						
						
						$resourcePages.="<div align=center data-role='content' style='overflow:hidden; position:fixed; top: 0; left: 3%; width: 100%; height: 89%;  margin-left: auto; margin-right: auto;'>";
							
						
						$resourcePages.="
						
							<script type='text/javascript'>
							
								//$(document).ready(function ($) {									
								$(document).delegate('#".htmlspecialchars($row['stringid'])."_homepage', 'pageinit', function () {
								
									$(this).bind('pagebeforehide', function() 
									{
										var extraAudiofiles = document.getElementsByClassName('extraAudioSources');
										var extraAudioCount;
										for (extraAudioCount = 0; extraAudioCount < extraAudiofiles.length; extraAudioCount++) 
										{	
											extraAudiofiles[extraAudioCount].pause();
										}
									});
									
									var allPreviousPages = $('#".htmlspecialchars($row['stringid'])."_homepage').prevAll('.sitePage');
									var allNextPages = $('#".htmlspecialchars($row['stringid'])."_homepage').nextAll('.sitePage');
									
									if(allPreviousPages.length!=0)
									{
										var prevPageToLoad = allPreviousPages[0];
										var prevPageToLoadUrl = '#' + prevPageToLoad.getAttribute('id');
										//$.mobile.loadPage(prevPageToLoadUrl);
										//alert(prevPageToLoadUrl+' 1');
									}
										
									if(allNextPages.length!=0)
									{
										var nextPageToLoad = allNextPages[0];
										var nextPageToLoadUrl = '#' + nextPageToLoad.getAttribute('id');
										//$.mobile.loadPage(nextPageToLoadUrl);
										//alert(nextPageToLoadUrl+' 2');
									}
							
									$.extend($.event.special.swipe,{
									  scrollSupressionThreshold: 10, // More than this horizontal displacement, and we will suppress scrolling.
									  durationThreshold: 3000, // Default is 1000. More time than this, and it isn't a swipe. 
									  horizontalDistanceThreshold: 5,  // Default is 30. Swipe horizontal displacement must be more than this.
									  verticalDistanceThreshold: 75,  // Swipe vertical displacement must be less than this.
									});
								
									$('#".htmlspecialchars($row['stringid'])."_scrollDiv').swiperight(openPreviousPage);
									$('#".htmlspecialchars($row['stringid'])."_scrollDiv').swipeleft(openNextPage);
									
									function openPreviousPage()
									{		
										if(allPreviousPages.length!=0)
										{
											loading();
											var prevPageToVisit = allPreviousPages[0];
											var prevPageToVisitUrl = '#' + prevPageToVisit.getAttribute('id');
											$.mobile.changePage(prevPageToVisitUrl);
											//$.mobile.changePage(prevPageToVisitUrl, {transition:'slide', reverse: true});
										}
										
										else
										{
											$.modaldialog.prompt('You are at the first site. Swipe right to left to view information for the next site.', {
												timeout: 5
												, showClose: false
												});
										}
									}
									
									function openNextPage()
									{
										if(allNextPages.length!=0)
										{
											loading();
											var nextPageToVisit = allNextPages[0];
											var nextPageToVisitUrl = '#' + nextPageToVisit.getAttribute('id');
											$.mobile.changePage(nextPageToVisitUrl);
											//$.mobile.changePage(nextPageToVisitUrl, {transition:'slide'});
										}
										
										else
										{
											$.modaldialog.prompt('You are at the last site. Swipe left to right to view information for the previous site.', {
												timeout: 5
												, showClose: false
												});
										}
									}
									
									var _CaptionTransitions = [];
									_CaptionTransitions['L'] = { \$Duration: 800, x: 0.6, \$Easing: { \$Left: \$JssorEasing$.\$EaseInOutSine }, \$Opacity: 2 };
									_CaptionTransitions['R'] = { \$Duration: 800, x: -0.6, \$Easing: { \$Left: \$JssorEasing$.\$EaseInOutSine }, \$Opacity: 2 };
									_CaptionTransitions['T'] = { \$Duration: 800, y: 0.6, \$Easing: { \$Top: \$JssorEasing$.\$EaseInOutSine }, \$Opacity: 2 };
									_CaptionTransitions['B'] = { \$Duration: 800, y: -0.6, \$Easing: { \$Top: \$JssorEasing$.\$EaseInOutSine }, \$Opacity: 2 };
									_CaptionTransitions['TL'] = { \$Duration: 800, x: 0.6, y: 0.6, \$Easing: { \$Left: \$JssorEasing$.\$EaseInOutSine, \$Top: \$JssorEasing$.\$EaseInOutSine }, \$Opacity: 2 };
									_CaptionTransitions['TR'] = { \$Duration: 800, x: -0.6, y: 0.6, \$Easing: { \$Left: \$JssorEasing$.\$EaseInOutSine, \$Top: \$JssorEasing$.\$EaseInOutSine }, \$Opacity: 2 };
									_CaptionTransitions['BL'] = { \$Duration: 800, x: 0.6, y: -0.6, \$Easing: { \$Left: \$JssorEasing$.\$EaseInOutSine, \$Top: \$JssorEasing$.\$EaseInOutSine }, \$Opacity: 2 };
									_CaptionTransitions['BR'] = { \$Duration: 800, x: -0.6, y: -0.6, \$Easing: { \$Left: \$JssorEasing$.\$EaseInOutSine, \$Top: \$JssorEasing$.\$EaseInOutSine }, \$Opacity: 2 };

									_CaptionTransitions['WAVE|L'] = { \$Duration: 1500, x: 0.6, y: 0.3, \$Easing: { \$Left: \$JssorEasing$.\$EaseLinear, \$Top: \$JssorEasing$.\$EaseInWave }, \$Opacity: 2, \$Round: { \$Top: 2.5} };
									_CaptionTransitions['MCLIP|B'] = { \$Duration: 600, \$Clip: 8, \$Move: true, \$Easing: \$JssorEasing$.\$EaseOutExpo };
									
								
									var jssorOptions".htmlspecialchars($row['stringid'])." = {
										\$FillMode: 1,
										\$LazyLoading: 1,
										//\$AutoPlay: true,
										\$AutoPlayInterval: 10000,
										\$BulletNavigatorOptions: {
											\$AutoCenter: 0,
											\$Class: \$JssorBulletNavigator$,
											\$ChanceToShow: 2
										},
										
										\$CaptionSliderOptions: {
											\$Class: \$JssorCaptionSlider$,
											\$CaptionTransitions: _CaptionTransitions,
											\$PlayInMode: 0,
											\$PlayOutMode: 0
										}
				
									};
									
									var jssor_slider1".htmlspecialchars($row['stringid'])." = new \$JssorSlider$('slider1_container".htmlspecialchars($row['stringid'])."', jssorOptions".htmlspecialchars($row['stringid']).");
									var jssor_slider2".htmlspecialchars($row['stringid'])." = new \$JssorSlider$('slider2_container".htmlspecialchars($row['stringid'])."', jssorOptions".htmlspecialchars($row['stringid']).");
										
									tempImage.height = jssor_slider1".htmlspecialchars($row['stringid']).".\$ScaleHeight();
									jssor_slider1".htmlspecialchars($row['stringid']).".\$On(\$JssorSlider$.\$EVT_PARK,
									function(slideIndex,fromIndex)
									{								
										$('.oldImage').remove();
										var currSlide = document.getElementById('sliderInnerDiv".htmlspecialchars($row['stringid'])."'+slideIndex);						
										tempImage.src=currSlide.getAttribute('name');
										currSlide.insertBefore(tempImage, currSlide.firstChild);
										
										tempImage.style.position='absolute';
										tempImage.style.zIndex='-100';						
										var diff = (currSlide.clientWidth - tempImage.clientWidth)/2;
										tempImage.style.left=diff+'px';										
									});
									
									
									popuptempImage.height = jssor_slider2".htmlspecialchars($row['stringid']).".\$ScaleHeight();
									jssor_slider2".htmlspecialchars($row['stringid']).".\$On(\$JssorSlider$.\$EVT_PARK,
									function(slideIndex,fromIndex)
									{									
										$('.popupoldImage').remove();
										var currpopupSlide = document.getElementById('popupsliderInnerDiv".htmlspecialchars($row['stringid'])."'+slideIndex);						
										popuptempImage.src=currpopupSlide.getAttribute('name');
										currpopupSlide.insertBefore(popuptempImage, currpopupSlide.firstChild);
										
										popuptempImage.style.position='absolute';
										popuptempImage.style.zIndex='-100';						
										var diff = (currpopupSlide.clientWidth - popuptempImage.clientWidth)/2;
										popuptempImage.style.left=diff+'px';
									});
									
									function toggleScaleSlider".htmlspecialchars($row['stringid'])."() 
									{
										
											var windowWidth".htmlspecialchars($row['stringid'])." = $(window).width()*0.9;	//this used to be 0.85. Not sure if it makes a difference
											if (windowWidth".htmlspecialchars($row['stringid']).") 
											{
												var windowHeight".htmlspecialchars($row['stringid'])." = $(window).height()*0.5;
												var originalWidth".htmlspecialchars($row['stringid'])." = jssor_slider2".htmlspecialchars($row['stringid']).".\$GetOriginalWidth();
												var originalHeight".htmlspecialchars($row['stringid'])." = jssor_slider2".htmlspecialchars($row['stringid']).".\$GetOriginalHeight();

												var scaleWidth".htmlspecialchars($row['stringid'])." = windowWidth".htmlspecialchars($row['stringid']).";
												if (originalWidth".htmlspecialchars($row['stringid'])." / windowWidth".htmlspecialchars($row['stringid'])." > originalHeight".htmlspecialchars($row['stringid'])." / windowHeight".htmlspecialchars($row['stringid']).") 
												{
													scaleWidth".htmlspecialchars($row['stringid'])." = Math.ceil(windowHeight".htmlspecialchars($row['stringid'])." / originalHeight".htmlspecialchars($row['stringid'])." * originalWidth".htmlspecialchars($row['stringid']).");
												}

												
												jssor_slider2".htmlspecialchars($row['stringid']).".\$SetScaleWidth(scaleWidth".htmlspecialchars($row['stringid']).");
											}
											else
												window.setTimeout(toggleScaleSlider".htmlspecialchars($row['stringid']).", 30);
												
											window.localStorage.setItem('isGalleryFullscreen".htmlspecialchars($row['stringid'])."', 'true');
										
									}
									
									function scaleSliderOnBar".htmlspecialchars($row['stringid'])."()
									{
										var divHeight".htmlspecialchars($row['stringid'])." = $('#".$row['stringid']."_bar').height();
										//var divHeight".htmlspecialchars($row['stringid'])." = $('#".$row['stringid']."_bar').height()*0.95;
										if (divHeight".htmlspecialchars($row['stringid']).")
											jssor_slider1".htmlspecialchars($row['stringid']).".\$ScaleHeight(divHeight".htmlspecialchars($row['stringid']).");
										else
											\$JssorUtils$.\$Delay(scaleSliderOnBar".htmlspecialchars($row['stringid']).", 30);
									}

									scaleSliderOnBar".htmlspecialchars($row['stringid'])."();
									
									window.addEventListener('load', scaleSliderOnBar".htmlspecialchars($row['stringid']).");
									window.addEventListener('orientationchange', scaleSliderOnBar".htmlspecialchars($row['stringid']).");
									window.addEventListener('resize', scaleSliderOnBar".htmlspecialchars($row['stringid']).");
									$('#".htmlspecialchars($row['stringid'])."_homepage').bind('pageshow', scaleSliderOnBar".htmlspecialchars($row['stringid']).");
									
									
									
									function onBackKeyDown".htmlspecialchars($row['stringid'])."(e) 
									{
									  e.preventDefault();
									}
									
									//this function provides a delay for a given period. 
									//it is not quite like the setTimeout function though.
									//it might come in handy for fixing the orientation problem
									function delayFor(time) 
									{
									  var d1 = new Date();
									  var d2 = new Date();
									  while (d2.valueOf() < d1.valueOf() + time) {
										d2 = new Date();
									  }
									}
									
									
									//This function is used to trigger the gallery popup in landscape mode and prevent the user from 
									//seeing anything else.
									
									function expandGallery".htmlspecialchars($row['stringid'])."() 
									{
										var windowOrientation='';
										
											if($(window).width()>$(window).height())
												windowOrientation = 'landscape';
											else
												windowOrientation = 'portrait';
												
											if (windowOrientation=='landscape')
											{
												toggleScaleSlider".htmlspecialchars($row['stringid'])."();
												//$('#".htmlspecialchars($row['stringid'])."_menu').popup('close');
												
												//delayFor(2000);
												
												if($('#".htmlspecialchars($row['stringid'])."_menu').parent().hasClass('ui-popup-active')
													|| $('#".htmlspecialchars($row['stringid'])."_fontResize').parent().hasClass('ui-popup-active')
													|| $('#".htmlspecialchars($row['stringid'])."_textpagepopup').parent().hasClass('ui-popup-active')
													|| $('#".htmlspecialchars($row['stringid'])."_audio').parent().hasClass('ui-popup-active')
													|| $('#".htmlspecialchars($row['stringid'])."_video').parent().hasClass('ui-popup-active'))
												{
													$('.ui-popup').popup('close');
													
													setTimeout(function(){
														jssor_slider2".htmlspecialchars($row['stringid']).".\$GoTo(jssor_slider1".htmlspecialchars($row['stringid']).".\$CurrentIndex());
														$('#popupSlider".htmlspecialchars($row['stringid'])."').popup({transition: 'pop'});
														$('#popupSlider".htmlspecialchars($row['stringid'])."').popup('open');																								
														
																												
														$.modaldialog.prompt('Flip your device to close the gallery', {
														  timeout: 5
														  , showClose: false
														  });
														
														
														document.addEventListener('backbutton', onBackKeyDown".htmlspecialchars($row['stringid']).", false);
														
														$('#popupSlider".htmlspecialchars($row['stringid'])."').popup({dismissible: false});
														$('#popupSlider".htmlspecialchars($row['stringid'])."').popup({history: false});
																										
														$('#popupSlider".htmlspecialchars($row['stringid'])."').popup({afterclose: function() {jssor_slider1".htmlspecialchars($row['stringid']).".\$GoTo(jssor_slider2".htmlspecialchars($row['stringid']).".\$CurrentIndex());}});
													}, 1200);
												
												}
												
												else
												{
													jssor_slider2".htmlspecialchars($row['stringid']).".\$GoTo(jssor_slider1".htmlspecialchars($row['stringid']).".\$CurrentIndex());
													$('#popupSlider".htmlspecialchars($row['stringid'])."').popup({transition: 'pop'});
													$('#popupSlider".htmlspecialchars($row['stringid'])."').popup('open');																								
													
																										
													$.modaldialog.prompt('Flip your device to close the gallery', {
														  timeout: 5
														  , showClose: false
														  });
													
													document.addEventListener('backbutton', onBackKeyDown".htmlspecialchars($row['stringid']).", false);
													
													$('#popupSlider".htmlspecialchars($row['stringid'])."').popup({dismissible: false});
													$('#popupSlider".htmlspecialchars($row['stringid'])."').popup({history: false});
																									
													$('#popupSlider".htmlspecialchars($row['stringid'])."').popup({afterclose: function() {jssor_slider1".htmlspecialchars($row['stringid']).".\$GoTo(jssor_slider2".htmlspecialchars($row['stringid']).".\$CurrentIndex());}});
												}
												
											}
											
											else if (windowOrientation=='portrait')
											{
												toggleScaleSlider".htmlspecialchars($row['stringid'])."();
												document.removeEventListener('backbutton', onBackKeyDown".htmlspecialchars($row['stringid']).", false);																						
												
												$('#popupSlider".htmlspecialchars($row['stringid'])."').popup('close');
												/*
												//make window redirect back one step to remove the '&ui-state=dialog' appended to the url when a popup is opened												
												if(document.URL.indexOf('&ui-state=dialog')!=-1)
												{
													$('#popupSlider".htmlspecialchars($row['stringid'])."').popup('close');
													window.history.back();
												}
												*/																					
												$('#popupSlider".htmlspecialchars($row['stringid'])."').popup({dismissible: true});
												$('#popupSlider".htmlspecialchars($row['stringid'])."').popup({history: true});
											}
									}
									
									
									function expandOnOrientationChange".htmlspecialchars($row['stringid'])."() 
									{
										window.addEventListener('orientationchange', expandGallery".htmlspecialchars($row['stringid']).");
										window.addEventListener('resize', expandGallery".htmlspecialchars($row['stringid']).");
																				
										$('#".htmlspecialchars($row['stringid'])."_homepage').bind('pagehide', function(){ 
											window.removeEventListener('orientationchange', expandGallery".htmlspecialchars($row['stringid'])."); 
											window.removeEventListener('resize', expandGallery".htmlspecialchars($row['stringid'])."); 
										});
									
									}
									
									if(deviceType=='mobile')	//Mobile
									{
										//Bind expand gallery function in landscape mode on mobile
										//Note: Disabled at the moment because the following two lines are commented
										//$('#".htmlspecialchars($row['stringid'])."_homepage').bind('pageshow', expandOnOrientationChange".htmlspecialchars($row['stringid']).");									
										//$('#".htmlspecialchars($row['stringid'])."_homepage').bind('pageshow', function(){setTimeout(expandGallery".htmlspecialchars($row['stringid']).", 100);});
									
										//Bind single click event on mobile
										$('#slider1_container".htmlspecialchars($row['stringid'])."').click(function(){
											toggleScaleSlider".htmlspecialchars($row['stringid'])."();
											jssor_slider2".htmlspecialchars($row['stringid']).".\$GoTo(jssor_slider1".htmlspecialchars($row['stringid']).".\$CurrentIndex());
											$('#popupSlider".htmlspecialchars($row['stringid'])."').popup({transition: 'pop'});
											$('#popupSlider".htmlspecialchars($row['stringid'])."').popup({corners: true});
											$('#popupSlider".htmlspecialchars($row['stringid'])."').popup({shadow: true});
											$('#popupSlider".htmlspecialchars($row['stringid'])."').popup('open');
											$('#popupSlider".htmlspecialchars($row['stringid'])."').popup({afterclose: function() {jssor_slider1".htmlspecialchars($row['stringid']).".\$GoTo(jssor_slider2".htmlspecialchars($row['stringid']).".\$CurrentIndex());}});
										});	
									}
									
									else	//Not mobile
									{
										//Do not bind expand gallery function in landscape mode on PC
										//Bind double click event on PC
										
										$('#slider1_container".htmlspecialchars($row['stringid'])."').dblclick(function(){
											toggleScaleSlider".htmlspecialchars($row['stringid'])."();
											jssor_slider2".htmlspecialchars($row['stringid']).".\$GoTo(jssor_slider1".htmlspecialchars($row['stringid']).".\$CurrentIndex());
											$('#popupSlider".htmlspecialchars($row['stringid'])."').popup({transition: 'pop'});
											$('#popupSlider".htmlspecialchars($row['stringid'])."').popup({corners: true});
											$('#popupSlider".htmlspecialchars($row['stringid'])."').popup({shadow: true});
											$('#popupSlider".htmlspecialchars($row['stringid'])."').popup('open');
											$('#popupSlider".htmlspecialchars($row['stringid'])."').popup({afterclose: function() {jssor_slider1".htmlspecialchars($row['stringid']).".\$GoTo(jssor_slider2".htmlspecialchars($row['stringid']).".\$CurrentIndex());}});
										});	
									}
									
									toggleScaleSlider".htmlspecialchars($row['stringid'])."();

									$('#fontIncrease".htmlspecialchars($row['stringid'])."').click(function(){
										$('#".htmlspecialchars($row['stringid'])."_fontResize').popup('close');
									});
									
									$('#fontDecrease".htmlspecialchars($row['stringid'])."').click(function(){
										$('#".htmlspecialchars($row['stringid'])."_fontResize').popup('close');
									});
									
									
									$('#".htmlspecialchars($row['stringid'])."_audio').popup({afterclose: function() {pauseAudio('".htmlspecialchars($row['stringid'])."_audioHolder');}});
									$('#".htmlspecialchars($row['stringid'])."_video').popup({afterclose: function() {document.getElementById('".htmlspecialchars($row['stringid'])."_videoHolder').pause();}});
									
									$('#".htmlspecialchars($row['stringid'])."_video').popup({create: function() {
										document.getElementById('".htmlspecialchars($row['stringid'])."_videoHolder').width=$(window).width()*0.7;
										document.getElementById('".htmlspecialchars($row['stringid'])."_videoHolder').height=$(window).height()*0.7;
									}});
									window.addEventListener('orientationchange', function()
										{
											document.getElementById('".htmlspecialchars($row['stringid'])."_videoHolder').width=$(window).width()*0.7;
											document.getElementById('".htmlspecialchars($row['stringid'])."_videoHolder').height=$(window).height()*0.7;
										}
									);
									
									window.addEventListener('resize', function()
										{
											document.getElementById('".htmlspecialchars($row['stringid'])."_videoHolder').width=$(window).width()*0.7;
											document.getElementById('".htmlspecialchars($row['stringid'])."_videoHolder').height=$(window).height()*0.7;
										}
									);
									
									$('.videoPopups').bind('popupcreate', function() {
									
										var videosToResize = document.getElementsByClassName('videoPopupVideos');
										var videosCounter;
										for (videosCounter = 0; videosCounter < videosToResize.length; videosCounter++) 
										{	
											videosToResize[videosCounter].width=$(window).width()*0.7;
											videosToResize[videosCounter].height=$(window).height()*0.7;
										}	
									});
									
									window.addEventListener('orientationchange', function()
										{
											var videosToResize = document.getElementsByClassName('videoPopupVideos');
											var videosCounter;
											for (videosCounter = 0; videosCounter < videosToResize.length; videosCounter++) 
											{	
												videosToResize[videosCounter].width=$(window).width()*0.7;
												videosToResize[videosCounter].height=$(window).height()*0.7;
											}
										}
									);
									
									window.addEventListener('resize', function()
										{
											var videosToResize = document.getElementsByClassName('videoPopupVideos');
											var videosCounter;
											for (videosCounter = 0; videosCounter < videosToResize.length; videosCounter++) 
											{	
												videosToResize[videosCounter].width=$(window).width()*0.7;
												videosToResize[videosCounter].height=$(window).height()*0.7;
											}
										}
									);

										
									var extraAudioDivs = document.getElementsByClassName('extraAudioPopups');
									var extraAudioCounter;
									for (extraAudioCounter = 0; extraAudioCounter < extraAudioDivs.length; extraAudioCounter++) 
									{	
										$('#'+extraAudioDivs[extraAudioCounter].id).bind('popupafterclose', function() 
										{
											$(this).find('audio').each(function() 
											{
												$(this)[0].pause();
											});
										});
									}										
									
									$('.toLoad').bind('click', loading);
									
								});
								
								function initializeFonts".htmlspecialchars($row['stringid'])."()
								{
									var defaultFontSize = 'large'; 

									var largerDimension = $(window).height()>=$(window).width()?$(window).height():$(window).width();
												
									if(largerDimension<800)	//HTC One Mini phone
									{
										defaultFontSize = 'large'; 
									}
									
									else if(largerDimension>=800 && largerDimension<1100)	//Google Nexus 7 tablet
									{
										defaultFontSize = 'large'; 
									}
									
									else if(largerDimension>=1100 && largerDimension<1350)	//Samsung tablet 10.1
									{
										defaultFontSize = 'x-large'; 
									}
									
									else	//ridiculously-large device
									{
										defaultFontSize = 'x-large'; 
									}
									
									var scrollText".htmlspecialchars($row['stringid'])." = $('#".htmlspecialchars($row['stringid'])."_siteDescription');
									scrollText".htmlspecialchars($row['stringid']).".style.fontSize = defaultFontSize;
								}
								
								function scalePanorama".htmlspecialchars($row['stringid'])."()
								{
								var divHeight".htmlspecialchars($row['stringid'])." = $(window).height()*0.95;
								$('#".htmlspecialchars($row['stringid'])."_panorama_iframe').height(divHeight".htmlspecialchars($row['stringid']).");
								var divWidth".htmlspecialchars($row['stringid'])." = $(window).width()*0.95;
								$('#".htmlspecialchars($row['stringid'])."_panorama_iframe').width(divWidth".htmlspecialchars($row['stringid']).");
								}
					
								scalePanorama".htmlspecialchars($row['stringid'])."();
								
								window.addEventListener('orientationchange', scalePanorama".htmlspecialchars($row['stringid']).");
								window.addEventListener('resize', scalePanorama".htmlspecialchars($row['stringid']).");
								$('#".htmlspecialchars($row['stringid'])."_homepage').bind('pageshow', scalePanorama".htmlspecialchars($row['stringid']).");
																
							</script>
							
							
							<style>
								.caption1
								{
									top:10%;
									display: block;
									  margin-left: auto;
									  margin-right: auto;
									position: relative; width: 400px; height: 300px;
								}
								
								.caption2
								{
									margin: 0 auto;
									position: absolute; width: 400px; height: 300px; 
									background-color: Black; opacity: 0.0; filter: alpha(opacity=00);
								}
								
								.caption3
								{
									margin: 0 auto;
									position: absolute; width: 380px; height: 280px; 
									color: White; font-size: 16px; font-weight: normal; font-family: Georgia, serif; 
									text-align: center; padding: 10px 10px 10px 10px; overflow:auto;
								}
								
									@media only screen and (max-width: 480px) 
									{
										.caption3{
											...;
											font-size: 32px;
											...;
										}
									}

									@media only screen and (max-width: 768px) {
										.caption3{
											...;
											font-size: 16px;
											...;
										}
									}

									@media only screen and (min-width: 769px) {
										.caption3{
											...;
											font-size: 16px;
											...;
										}
									}
							</style>
							
							<div  id='".$row['stringid']."_bar' style='background-color:rgba(0, 0, 0, 0.0);  position:fixed; z-index: 998; top: 2%; left: 0; width: 100%; height: 40%;' align='center'>	<!--at the moment the burgundy bar has no background colour set. Revert this setting with background-color:#4F2323;-->
							
								<div style='position: relative; width: 100%; overflow: hidden;'>	
									<div style='position: relative; left: 50%; width: 5000px; text-align: center; margin-left: -2500px;'>
																		
										<div id='slider1_container".htmlspecialchars($row['stringid'])."' style=' margin: 0 auto; position: relative; top: 6.5%;  width: 1200px; height: 400px;' align='center'>
											<!-- Slides Container -->
											<div u='slides' style='cursor: move; position: absolute; overflow: hidden; left: 0px; top: 0px; width: 1200px; height: 400px;'>
												<div>
												
												<img u='image' src2='../admin/".htmlspecialchars($row['image'])."' />
												
												<div u='caption' t='MCLIP|B' class='caption1'>
														<div class='caption2'> </div>
														<div class='caption3'>
														   
															<!--Cover image-->
														</div>
													</div>
												</div>";
												
												
												$allImagesResult=mysql_query("SELECT * FROM resources WHERE point_stringid='".$row['stringid']."' AND type='image' AND value!='".htmlspecialchars($row['image'])."' ORDER BY id;");
												$position=1;
												
												while($allImagesRow=mysql_fetch_array($allImagesResult))
												{							
													$resourcePages.="<div class='sliderInnerDiv".htmlspecialchars($row['stringid'])."' id='sliderInnerDiv".htmlspecialchars($row['stringid']).$position."' name='../admin/".htmlspecialchars($allImagesRow['value'])."'>
													
														<!--<img u='image' src2='../admin/".htmlspecialchars($allImagesRow['value'])."' alt='".htmlspecialchars($allImagesRow['description'])."' title='".htmlspecialchars($allImagesRow['description'])."'/>-->
																												
														<div u='caption' t='MCLIP|B' class='caption1'>
															<div class='caption2'> </div>
															<div class='caption3'>
																<p style='display:inline-block; background-color: Black; opacity: 0.6; filter: alpha(opacity=60); border: 2px solid; border-radius: 25px;'>&nbsp".htmlspecialchars($allImagesRow['description'])."&nbsp</p>
															</div>
														</div>
													</div>";
													$position++;													
												}

											$resourcePages.="</div>
											
											<!-- Bullet Navigator Skin Begin -->
											<style>
												/* jssor slider bullet navigator skin 21 css */
												/*
												.jssorb21 div           (normal)
												.jssorb21 div:hover     (normal mouseover)
												.jssorb21 .av           (active)
												.jssorb21 .av:hover     (active mouseover)
												.jssorb21 .dn           (mousedown)
												*/
												.jssorb21 div, .jssorb21 div:hover, .jssorb21 .av
												{
													background: url(css/images/b21.png) no-repeat;
													overflow:hidden;
													cursor: pointer;
												}
												.jssorb21 div { background-position: -5px -5px; }
												.jssorb21 div:hover, .jssorb21 .av:hover { background-position: -35px -5px; }
												.jssorb21 .av { background-position: -65px -5px; }
												.jssorb21 .dn, .jssorb21 .dn:hover { background-position: -95px -5px; }
											</style>
											<!-- bullet navigator container -->
											<div u='navigator' class='jssorb21' style='align:center; float:center; position: relative; top: 90%; left: auto; display:block; margin-left: auto; margin-right: auto;' align='center'>
												<!-- bullet navigator item prototype -->
												<div u='prototype' style='POSITION: absolute; WIDTH: 19px; HEIGHT: 19px; text-align:center; line-height:19px; color:White; font-size:12px;'></div>
											</div>
											<!-- Bullet Navigator Skin End -->
											
										</div>
									</div>
								</div>
						</div>
							
							
								<div data-role='popup' id='popupSlider".htmlspecialchars($row['stringid'])."' data-corners='true' style='position: relative; width: 100%; height:100%; ' data-overlay-theme='a' data-theme='d' data-corners='false'>	
									<a href='#' id='popupSliderButton".htmlspecialchars($row['stringid'])."' data-rel='back' data-role='button' data-theme='a' data-icon='delete' data-iconpos='top' class='ui-btn-right'> </a>
									<div style='background-color:#000000; padding:5% 0% 5% 0%; position: relative; left: 50%; width: 5000px; text-align: center; margin-left: -2500px;'>
										<div id='slider2_container".htmlspecialchars($row['stringid'])."' style='margin: 0 auto; position: relative; top: 6.5%;  width: 533px; height: 300px;'>
											<!-- Slides Container -->
											<div u='slides' style='cursor: move; position: absolute; overflow: hidden; left: 0px; top: 0px; width: 533px; height: 300px;'>	<!--the width and height dimensions here are in line with the width/height ratio used in HD dimensions - 1.78-->
												<div>
												
													<img u='image' src2='../admin/".htmlspecialchars($row['image'])."' />
													
													<div u='caption' t='MCLIP|B' class='caption1'>
														<div class='caption2'> </div>
														<div class='caption3'>
														   
															<!--Cover image-->
														</div>
													</div>
												</div>";
												
												
												$allImagesResult2=mysql_query("SELECT * FROM resources WHERE point_stringid='".$row['stringid']."' AND type='image' AND value!='".htmlspecialchars($row['image'])."' ORDER BY id;");
												
												$position=1;
												
												while($allImagesRow2=mysql_fetch_array($allImagesResult2))
												{							
													$resourcePages.="<div class='sliderInnerDiv".htmlspecialchars($row['stringid'])."' id='popupsliderInnerDiv".htmlspecialchars($row['stringid']).$position."' name='../admin/".htmlspecialchars($allImagesRow2['value'])."'>
													
														<!--<img u='image' src2='../admin/".htmlspecialchars($allImagesRow2['value'])."' alt='".htmlspecialchars($allImagesRow2['description'])."' title='".htmlspecialchars($allImagesRow2['description'])."'/>-->
													
														<div u='caption' t='MCLIP|B' class='caption1'>
															<div class='caption2'> </div>
															<div class='caption3'>
																<p style='display:inline-block; background-color: Black; opacity: 0.6; filter: alpha(opacity=60); border: 2px solid; border-radius: 25px;'>&nbsp".htmlspecialchars($allImagesRow2['description'])."&nbsp</p>
															</div>
														</div>
													
													</div>";
													$position++;													
												}

											$resourcePages.="</div>
											
											<!-- Bullet Navigator Skin Begin -->
											<style>
												/* jssor slider bullet navigator skin 21 css */
												/*
												.jssorb21 div           (normal)
												.jssorb21 div:hover     (normal mouseover)
												.jssorb21 .av           (active)
												.jssorb21 .av:hover     (active mouseover)
												.jssorb21 .dn           (mousedown)
												*/
												.jssorb21 div, .jssorb21 div:hover, .jssorb21 .av
												{
													background: url(css/images/b21.png) no-repeat;
													overflow:hidden;
													cursor: pointer;
													z-index: 19990;
												}
												.jssorb21 div { background-position: -5px -5px; }
												.jssorb21 div:hover, .jssorb21 .av:hover { background-position: -35px -5px; }
												.jssorb21 .av { background-position: -65px -5px; }
												.jssorb21 .dn, .jssorb21 .dn:hover { background-position: -95px -5px; }
											</style>
											<!-- bullet navigator container -->
											<div u='navigator' class='jssorb21' style='align:center; float:center; position: relative; top: 90%; left: auto; display:block; margin-left: auto; margin-right: auto;' align='center'>
												<!-- bullet navigator item prototype -->
												<div u='prototype' style='POSITION: absolute; WIDTH: 19px; HEIGHT: 19px; text-align:center; line-height:19px; color:White; font-size:12px;'></div>
											</div>
											<!-- Bullet Navigator Skin End -->
											
										</div>
									</div>
								</div>
							
						";
							
							
							$resourcePages.="<div id='".htmlspecialchars($row['stringid'])."_scrollDiv' data-role='fieldcontain' style='float:center; align:center; position:fixed; top:42%; left:0; width:80%; height:30%; background-image:url(css/images/newscroll.png);background-size: 100% 100%; padding: 11% 10% 7% 10%;' align='center'><div style='height:85%;width:100%;overflow:auto;'> <table border='0' height='100%'><tr><td style='vertical-align: middle;text-align:center;'> <h4 id='".htmlspecialchars($row['stringid'])."_siteDescription' class='scrolls' style='color:#3B0B0B; font-size:large;'>".htmlspecialchars($row['description'])."</h4> </td></tr></table> </div></div>";
									
								
							$resourcePages.="</div>";
							
							
							$resourcePages.=$resourcesOutput;
							
							$resourcePages.=$resourcesOutputButtons;
							
							$resourcePages.="<div style='background-color:#4F2323;' data-role='popup' data-corners='true' id='".htmlspecialchars($row['stringid'])."_fontResize'> <a id='fontDecrease".htmlspecialchars($row['stringid'])."' style='background-color:#4F2323;' href='javascript:changeFontSize(-2)' ><img class='fontButton' style='background-color:#4F2323;' src='css/images/less.png' width='60' height='40' alt='Less' /></a> <a id='fontIncrease".htmlspecialchars($row['stringid'])."' style='background-color:#4F2323;' href='javascript:changeFontSize(2)' ><img class='fontButton' style='background-color:#4F2323;' src='css/images/more.png' width='60' height='40' alt='More' /></a> </div>";
							
							
							$resourcePages.="<div data-role='footer' data-position='fixed'>";
								
								if($audioPresent=='true' || $videoPresent=='true' || $panoramaPresent=='true' || $threeDViewPresent=='true' || $textPresent=='true')
								{
									$resourcePages.="<h6><div id='multimediaGroup".htmlspecialchars($row['stringid'])."' data-role='controlgroup' data-type='horizontal'>";
										if($audioPresent=='true')
											$resourcePages.="<a href='#".htmlspecialchars($row['stringid'])."_audio' onclick=\"playAudio('".htmlspecialchars($row['stringid'])."_audioHolder');\" id='audioButton".htmlspecialchars($row['stringid'])."' data-role='button' data-icon='audio3' data-iconpos='notext' data-rel='popup' data-position-to='window' style='height: 40px !important; width: 40px !important;'>Audio</a>";
										if($extraAudioPresent=='true')
											$resourcePages.=$extraAudioButtons;
										if($videoPresent=='true')
											$resourcePages.="<a href='#".htmlspecialchars($row['stringid'])."_video' onclick=\"videoFullScreen('".htmlspecialchars($row['stringid'])."_videoHolder');\" id='videoButton".htmlspecialchars($row['stringid'])."' data-role='button' data-icon='video3' data-iconpos='notext' data-rel='popup' data-position-to='window' style='height: 40px !important; width: 40px !important;'>Video</a>";
											//$resourcePages.="<a href='#' onclick=\"videoFullScreen('".htmlspecialchars($row['stringid'])."_videoHolder');\" id='videoButton".htmlspecialchars($row['stringid'])."' data-role='button' data-icon='video3' data-iconpos='notext' data-rel='popup' data-position-to='window' style='height: 40px !important; width: 40px !important;'>Video</a>";
											//$resourcePages.="<a href='#".htmlspecialchars($row['stringid'])."_video' id='videoButton".htmlspecialchars($row['stringid'])."' data-role='button' data-icon='video3' data-iconpos='notext' data-rel='popup' data-position-to='window'>Video</a>";
										if($textPresent=='true')
											$resourcePages.="<a href='#".htmlspecialchars($row['stringid'])."_textpagepopup' id='textButton".htmlspecialchars($row['stringid'])."' data-role='button' data-icon='info' data-iconpos='notext' data-rel='popup' data-position-to='window' style='height: 40px !important; width: 40px !important;'>Additional information</a>";
										//also do for panorama and 3D
										
										if($panoramaPresent=='true')
											$resourcePages.="<a href='#' onclick=\"window.localStorage.setItem('panoramaNavigation', '#".htmlspecialchars($row['stringid'])."_homepage'); window.location.href=$('#".htmlspecialchars($row['stringid'])."_panorama_iframe').attr('name');\" id='panoramaButton".htmlspecialchars($row['stringid'])."' data-role='button' data-icon='eye' data-iconpos='notext' data-rel='popup' data-position-to='window' data-history='false' style='height: 40px !important; width: 40px !important;'>Panorama</a>";
										if($threeDViewPresent=='true')
											$resourcePages.="<a href='#' onclick='' id='3DButton".htmlspecialchars($row['stringid'])."' data-role='button' data-icon='3D' data-iconpos='notext' data-rel='popup' style='height: 40px !important; width: 40px !important;'>3D</a>";
										
										//always present
										$resourcePages.="<a href='#".htmlspecialchars($row['stringid'])."_menu' data-rel='popup' data-role='button' data-inline='true' data-icon='bars' data-iconpos='right' data-transition='pop' style='height: 40px !important;'>More</a>";

									$resourcePages.="</div></h6>";
								}
								
								else
								{
									$resourcePages.="<h6><div id='multimediaGroup".htmlspecialchars($row['stringid'])."' data-role='controlgroup' data-type='horizontal'>";
										//always present
										$resourcePages.="<a href='#".htmlspecialchars($row['stringid'])."_menu' data-rel='popup' data-role='button' data-inline='true' data-icon='bars' data-iconpos='right' data-transition='pop' style='height: 40px !important;'>More</a>";

									$resourcePages.="</div></h6>";
								}
								
								
							$resourcePages.="</div>";
					
						$resourcePages.="</div>";
						$resourcePages.="<br>";
						
						
						$output.="<div data-role='content'>";
							$output.="<ul data-theme='e' data-role='listview' data-mini='true' data-inline='true' data-inset='true'>";
								$output.="<li><a href='#".htmlspecialchars($row['stringid'])."_homepage' data-mini=true data-inline=true data-transition=fade>".htmlspecialchars($j++).". ".htmlspecialchars($row['name'])."</a></li>";
							$output.="</ul>";
						$output.="</div>";
						
					}
					
					if(empty($output))
					{								
						$output.="<div align='center'><h4 style='color:#3B0B0B;'>No sites have been identified!</h4></div>";
					}
					
					else
					{

					}


$finalOutput = array(
    "listings" => $output,
    "pages" => $resourcePages,
);

echo json_encode($finalOutput);
?>
