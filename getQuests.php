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

						$result=mysql_query("SELECT * FROM appquests ORDER BY sn;");
										
					$quests="";
					$questPages="";
					$questMapPage="";
										
					//$quests.="<ul data-theme='e' data-role='listview' data-mini='true' data-inline='true' data-inset='true'>";					
					
					while( $row=mysql_fetch_array($result))
					{
						$quests.="<ul data-theme='e' data-role='listview' data-mini='true' data-inline='true' data-inset='true'>";					
					
						$firstTaskId = "";
						$firstTaskLocation="";
						
						$currentQuestId = $row['quest_id'];
						$currentQuestName = $row['quest_name'];
						$currentQuestDescription = $row['quest_description'];
						
						$firstTaskId.=$currentQuestId;
						$firstTaskId.="_page_";
						
						$questTaskResult2=mysql_query("SELECT * FROM questtasks WHERE quest='".$currentQuestId."' ORDER BY sn LIMIT 1;");
												
						while($questTaskRow2=mysql_fetch_array($questTaskResult2))
						{
							$firstTaskId.=$questTaskRow2['taskid'];
							$firstTaskLocation=$questTaskRow2['tasklocation'];
						}
						
						
							$questPages.="<div data-role='page' style=' overflow-x:hidden; background-image:url(css/images/scroll.jpg);background-size: 100% 100%;' id='".htmlspecialchars($currentQuestId)."_intro_page' data-url='appquests.html#".htmlspecialchars($currentQuestId)."_intro_page' data-dom-cache='false'>";
																
								$questPages.="<div data-role='header'>";
									$questPages.="<a href='' data-icon='arrow-l' onclick='window.history.back();' data-role='button' data-mini='true' data-inline='true'>Back</a>";
									$questPages.="<h1>".htmlspecialchars($currentQuestName)." Introduction</h1>";
									$questPages.="<a href='' data-icon='delete' onclick='confirmExit();' data-role='button' data-mini='true' data-inline='true'>Quit</a>";
								$questPages.="</div>";
							
								$questPages.="<div data-role='content' style='background-image:url(css/images/newscroll.png);background-size: 100% 100%;'>";
								
									$questPages.="<div name=introdiv>";
										$questPages.="<h4 style='color:#3B0B0B;padding: 20px 60px 20px 60px;text-align:justify;'>".$currentQuestDescription."</h4>";
									$questPages.="</div>";
									
									$questPages.="<div align=center style='align:center;'>
										<h5 style='color:#3B0B0B;text-align:center;'>Go to ".$firstTaskLocation." to begin</h5>
										<a href='appquests.html#".$firstTaskId."' data-transition=slide data-icon='arrow-r' data-role='button' data-mini='true' data-inline='true'>Proceed</a> 
										</div>";
									
									
									
								$questPages.="</div>";
								
								$questPages.="<div data-role='footer' data-position='fixed'>";
									$questPages.="<h4>Open Virtual Worlds Group</h4>";
								$questPages.="</div>";
							$questPages.="</div>";
							
							$questPages.="<br>";
						
						
						
							$questPages.="<div data-role='page' style=' overflow-x:hidden; background-image:url(css/images/scroll.jpg);background-size: 100% 100%;' id='".htmlspecialchars($currentQuestId)."_farewell_page' data-url='appquests.html#".htmlspecialchars($currentQuestId)."_farewell_page' data-dom-cache='false'>";
																
								$questPages.="<div data-role='header'>";
									$questPages.="<h1>".htmlspecialchars($currentQuestName)." Farewell</h1>";
								$questPages.="</div>";
							
								$questPages.="<div data-role='content' style='background-image:url(css/images/newscroll.png);background-size: 100% 100%;'>";
								
									$questPages.="<div name=farewelldiv>";
										$questPages.="<h4 style='color:#3B0B0B;padding: 20px 60px 20px 60px;text-align:justify;'> Congratulations, you have reached the end of the ".$currentQuestName.". Thank you for taking part in this tour, goodbye!</h4>";
									$questPages.="</div>";
									
									$questPages.="<div align=center style='align:center;'> <a href='appquests.html' rel='external' data-icon='home' data-role='button' data-mini='true' data-inline='true'>End</a> </div>";
									
								$questPages.="</div>";
								
								$questPages.="<div data-role='footer' data-position='fixed'>";
									$questPages.="<h4>Open Virtual Worlds Group</h4>";
								$questPages.="</div>";
							$questPages.="</div>";
							
							$questPages.="<br>";
							
							
							
							
							
							
$questMapPage.="


<div data-role='page' style=' overflow: hidden; background-image:url(css/images/scroll.jpg);background-size: 100% 100%;' id='questMap".htmlspecialchars($currentQuestId)."' data-fullscreen='true'>


<script>		
		var map".$currentQuestId.";
		var mapLat".$currentQuestId."='';
		var mapLong".$currentQuestId."='';		
		
		window.onload = function()
		{
			var mapAreaWidth".$currentQuestId." = $(window).width();
			var mapAreaHeight".$currentQuestId." = $(window).height();
			var elem".$currentQuestId." = document.getElementById('mapArea".htmlspecialchars($currentQuestId)."');
			elem".$currentQuestId.".style.width = mapAreaWidth".$currentQuestId."+'px';
			elem".$currentQuestId.".style.height = mapAreaHeight".$currentQuestId."+'px';
		}
		
		function storeCoordAndId".$currentQuestId."(str)
		{
			alert(str);
			
			var strArr".$currentQuestId." = str.split('+++');
	
				if(strArr".$currentQuestId.".length==2)
				{
					var centerPoint".$currentQuestId."=strArr".$currentQuestId."[0];
					
					var latLongToOpen".$currentQuestId." = centerPoint".$currentQuestId.".split(',');
					
					window.localStorage.setItem('latCenter".$currentQuestId."', latLongToOpen".$currentQuestId."[0]);
					window.localStorage.setItem('longCenter".$currentQuestId."', latLongToOpen".$currentQuestId."[1]);
					
					var questOfInterest".$currentQuestId." = strArr".$currentQuestId."[1];
					
					window.localStorage.setItem('questOfInterest".$currentQuestId."', questOfInterest".$currentQuestId.");
				}
						
				else
				{
					//alert('something is wrong');
				}
		}
		
		
		function resizeMapArea".$currentQuestId."()
		{
			var windowOrientation='portrait';
			var mapAreaWidth".$currentQuestId." = $(window).width();
			var mapAreaHeight".$currentQuestId." = $(window).height();
			var elem".$currentQuestId." = document.getElementById('mapArea".htmlspecialchars($currentQuestId)."');
			switch(window.orientation) 
			{  
				case 0:  
					windowOrientation = 'portrait';
					break; 
				case 180:  
					windowOrientation = 'portrait';
					break; 
				case -90:  
					windowOrientation = 'landscape';
					break;  
				case 90:  
					windowOrientation = 'landscape';
					break;
				default:
					windowOrientation = 'portrait';
					break;
			}
			
			if (windowOrientation=='landscape')
			{
				mapAreaWidth".$currentQuestId." = $(window).width();
				mapAreaHeight".$currentQuestId." = $(window).height();
			}
			else if (windowOrientation=='portrait')
			{
				mapAreaWidth".$currentQuestId." = $(window).width();
				mapAreaHeight".$currentQuestId." = $(window).height();
			}
			
			elem".$currentQuestId.".style.width = mapAreaWidth".$currentQuestId."+'px';
			elem".$currentQuestId.".style.height = mapAreaHeight".$currentQuestId."+'px';
		}
		
		function getLocation".$currentQuestId."()
		{
			var options".$currentQuestId."={enableHighAccuracy:true, maximumAge:0, timeout:10000};	//timeout could be 20000
			if (navigator.geolocation)
			{
				navigator.geolocation.getCurrentPosition(showPosition".$currentQuestId.", error".$currentQuestId.", options".$currentQuestId.");
			}
			else
			{
				$.modaldialog.warning('Geolocation is not supported by this device!');
			}
		}
			function error".$currentQuestId."(err)
			{
				$.modaldialog.error('Error getting your location. Please ensure that location services are turned on and try again');
			   var mapErrorMessage = '<div style=position:relative;top:50%;transform:translateY(-50%);> <h3 align=center style=text-align:center;align:center;color:#3B0B0B;>No map available</h3> <img src=css/images/error.png alt=Error height=60 width=60 style=margin:auto;display:block;vertical-align:middle;></div>';
			   $('#mapArea".htmlspecialchars($currentQuestId)."').html(mapErrorMessage);
			}
	    
		  function showPosition".$currentQuestId."(position)
		  {
			var mapArea".$currentQuestId." = document.getElementById('mapArea".htmlspecialchars($currentQuestId)."');
			var centerPoint".$currentQuestId." = 'none';
						
			var latLongCenter".$currentQuestId." = [[[Initial Lat]], [[Initial Long]]];	//the initial center of the map

			if(window.localStorage.getItem('questOfInterest".$currentQuestId."')!=null)
			{
				latLongCenter".$currentQuestId."[0]=window.localStorage.getItem('latCenter".$currentQuestId."');
				latLongCenter".$currentQuestId."[1]=window.localStorage.getItem('longCenter".$currentQuestId."');
				
				mapLat".$currentQuestId."=window.localStorage.getItem('latCenter".$currentQuestId."');
				maplong".$currentQuestId."=window.localStorage.getItem('longCenter".$currentQuestId."');
				
				window.localStorage.removeItem('latCenter".$currentQuestId."');
				window.localStorage.removeItem('longCenter".$currentQuestId."');
			}
		
			var zoomLevel = 14;		

			var largerDimension = $(window).height()>=$(window).width()?$(window).height():$(window).width();
						
			if(largerDimension<800)	//HTC One Mini phone
			{
				zoomLevel = 14;
			}
			
			else if(largerDimension>=800 && largerDimension<1100)	//Google Nexus 7 tablet
			{
				zoomLevel = 15;
			}
			
			else if(largerDimension>=1100 && largerDimension<1350)	//Samsung tablet 10.1
			{
				zoomLevel = 16;
			}
			
			else	//ridiculously-large device
			{
				zoomLevel = 17;
			}
			
						
						
			var mapOptions".$currentQuestId." = {
					  center: new google.maps.LatLng(latLongCenter".$currentQuestId."[0], latLongCenter".$currentQuestId."[1]),
					  zoom: zoomLevel,
					  mapTypeId: google.maps.MapTypeId.ROADMAP,
					  styles:[{
						featureType:'poi',
						elementType:'labels',
						stylers:[{
							visibility:'off'
						}]
					}]
				}
			
			map".$currentQuestId." = new google.maps.Map(mapArea".$currentQuestId.", mapOptions".$currentQuestId.")
			var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
			
			var marker".$currentQuestId." = new google.maps.Marker({
              position: {lat: position.coords.latitude, lng: position.coords.longitude},
			  map: map".$currentQuestId.",
			  title: 'Your Location',
			  icon: 'css/images/icons/user.png'
			});
			window.localStorage.setItem('userlat', position.coords.latitude);
			window.localStorage.setItem('userlng', position.coords.longitude);
			var infowindow = new google.maps.InfoWindow();
			makeInfoWindowEvent(map".$currentQuestId.", infowindow, 'You are here', marker".$currentQuestId.");			   
			var icons = {
			  userLocation: 
			  {
				name: 'Your Location',
				icon: 'css/images/icons/user.png'
			  },
			  site: 
			  {
				name: 'Site',
				icon: 'css/images/icons/trail.png'
			  },
			  Museum: 
			  {
				name: 'Museum',
				icon: 'css/images/icons/museum.png'
			  },
			  questPoint: 
			  {
				name: 'Quest Task',
				icon: 'css/images/icons/quest.png'
			  }
			};
			
			var legend".$currentQuestId." = document.getElementById('legend".htmlspecialchars($currentQuestId)."');
					
			for (var key in icons) 
			{
			  var type = icons[key];
			  var name = type.name;
			  var icon = type.icon;
			  var div".$currentQuestId." = document.createElement('div');
			  div".$currentQuestId.".innerHTML = '<img src=' + icon + '> ' + name;
			  legend".$currentQuestId.".appendChild(div".$currentQuestId.");
			}
			
			map".$currentQuestId.".controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend".$currentQuestId.");
						
			var museums = [
			   		  
			   		];
			
			setMarkers".$currentQuestId."(map".$currentQuestId.", museums, 'm');
			
			
			jQuery.support.cors = true; 
			 $.ajax({ 
				 url: '../getQuestCoordinates.php',
				 crossDomain: true,
				 type: 'post',
				 data: {questToRetrieve: '".$currentQuestId."'}, 
				 success: function(data)
				 {
					 var quest= $.parseJSON(data);
					 setMarkers".$currentQuestId."(map".$currentQuestId.", quest, 'q');
				 },
				 error: function()
				 {
					$.modaldialog.error('Connection error, map could not be retrieved!');
					var mapErrorMessage = '<div style=position:relative;top:50%;transform:translateY(-50%);> <h3 align=center style=text-align:center;align:center;color:#3B0B0B;>No map available</h3> <img src=css/images/error.png alt=Error height=60 width=60 style=margin:auto;display:block;vertical-align:middle;></div>';
					$('#mapArea".htmlspecialchars($currentQuestId)."').html(mapErrorMessage);
				 }
			 });
			 
				var userCenter".$currentQuestId." = new google.maps.LatLng(latLongCenter".$currentQuestId."[0], latLongCenter".$currentQuestId."[1]);
				map".$currentQuestId.".setCenter(userCenter".$currentQuestId.");
		  }
		  
		  function setMarkers".$currentQuestId."(map".$currentQuestId.", locations".$currentQuestId.", type) 
		  {
			  var image = {
				      url: 'https://maps.google.com/mapfiles/kml/shapes/info-i_maps.png',
				      size: new google.maps.Size(20, 32)
				    };	    
				    if(type=='m')
				    {
				    	 image = {
				  		      url: 'css/images/icons/museum.png'
				  		    };
				    }
				    else if(type=='p')
				    {
				    	 image = {
				  		      url: 'css/images/icons/trail.png'
				  		    };
				    }
					else if(type=='q')
				    {
				    	 image = {
				  		      url: 'css/images/icons/quest.png'
				  		    };
				    }
		    
		    var infowindow = new google.maps.InfoWindow();		    
		    for (var counter".$currentQuestId." = 0; counter".$currentQuestId." < locations".$currentQuestId.".length; counter".$currentQuestId."++) 
		    {
				// To make the location of the first task the center of the map
				/*if(counter".$currentQuestId."==0)
				{
					var temptpoint".$currentQuestId." = locations".$currentQuestId."[counter".$currentQuestId."];
					var tempmyLatLng".$currentQuestId." = new google.maps.LatLng(temptpoint".$currentQuestId."[1], temptpoint".$currentQuestId."[2]);
					
					map".$currentQuestId.".setCenter(tempmyLatLng".$currentQuestId.");
				}*/					
					
		      var tpoint".$currentQuestId." = locations".$currentQuestId."[counter".$currentQuestId."];
		      var myLatLng".$currentQuestId." = new google.maps.LatLng(tpoint".$currentQuestId."[1], tpoint".$currentQuestId."[2]);
		      var marker".$currentQuestId." = new google.maps.Marker({
		          position: myLatLng".$currentQuestId.",
		          map: map".$currentQuestId.",
		          icon: image,
		          title: tpoint".$currentQuestId."[0],
		          zIndex: 2	
		      });
			
		      var bubbleContent = '';
		      if (type=='m')
		      {
		    	  bubbleContent = '<a onClick=calculateRoute".$currentQuestId."('+tpoint".$currentQuestId."[1]+','+tpoint".$currentQuestId."[2]+'); rel=external data-role=button data-mini=true data-inline=true href=#>'+tpoint".$currentQuestId."[0]+'<hr></a>';
		      }
			  else if(type=='q')
		      {
		    	  bubbleContent = '<a onClick=calculateRoute".$currentQuestId."('+tpoint".$currentQuestId."[1]+','+tpoint".$currentQuestId."[2]+'); rel=external data-role=button data-mini=true data-inline=true href=#>Task '+tpoint".$currentQuestId."[3]+' - '+tpoint".$currentQuestId."[0]+'<hr></a>';
		      }
			 makeInfoWindowEvent(map".$currentQuestId.", infowindow, bubbleContent, marker".$currentQuestId.");
			 
				if(mapLat".$currentQuestId."!='' && mapLong".$currentQuestId."!='')
				{
					if(tpoint".$currentQuestId."[1]==mapLat".$currentQuestId." && tpoint".$currentQuestId."[2]==mapLong".$currentQuestId.")	//if current location corresponds to map center, open infowindow
					{
						infowindow.setContent(bubbleContent);
						infowindow.open(map".$currentQuestId.", marker".$currentQuestId.");
						marker".$currentQuestId.".setAnimation(google.maps.Animation.BOUNCE);
						stopAnimation".$currentQuestId."(map".$currentQuestId.", marker".$currentQuestId.");
					}
					else
					{
						//do nothing
					}
				}
				else
				{
					//do nothing
				}
					      
		    }
		  }
		  
		  function stopAnimation".$currentQuestId."(map".$currentQuestId.", marker".$currentQuestId.")
		  {
			google.maps.event.addListener(map".$currentQuestId.", 'tilesloaded', function(){
				setTimeout(function(){ marker".$currentQuestId.".setAnimation(null); }, 2800);
			});
		  }
		  
		  function makeInfoWindowEvent(map".$currentQuestId.", infowindow, contentString, marker".$currentQuestId.") 
		  {
			/*if(contentString=='You are here')
			{
				infowindow.setContent(contentString);
				infowindow.open(map".$currentQuestId.", marker".$currentQuestId.");
			}*/
			
			  google.maps.event.addListener(marker".$currentQuestId.", 'mousedown', function() {
				infowindow.setContent(contentString);
				infowindow.open(map".$currentQuestId.", marker".$currentQuestId.");
			  });
		  }  
		  
		  var directionsRenderer".$currentQuestId." = new google.maps.DirectionsRenderer({
				map: map".$currentQuestId.",
				suppressMarkers: true
			  });
		  
		  function calculateRoute".$currentQuestId."(pointlat, pointlng) 
			{
				var userlat".$currentQuestId." = window.localStorage.getItem('userlat');
				var userlng".$currentQuestId." = window.localStorage.getItem('userlng');
				var directionsService".$currentQuestId." = new google.maps.DirectionsService();
					var directionsRequest".$currentQuestId." = 
					{
					  origin: new google.maps.LatLng(userlat".$currentQuestId.",userlng".$currentQuestId."),
					  destination: new google.maps.LatLng(pointlat,pointlng),
					  travelMode: google.maps.DirectionsTravelMode.WALKING,
					  unitSystem: google.maps.UnitSystem.METRIC
					};
					
					directionsService".$currentQuestId.".route(
					  directionsRequest".$currentQuestId.",
					  function(response, status)
					  {
						if (status == google.maps.DirectionsStatus.OK)
						{
							directionsRenderer".$currentQuestId.".setMap(null);
							directionsRenderer".$currentQuestId.".setDirections(response);
							directionsRenderer".$currentQuestId.".setMap(map".$currentQuestId.");
						}
						else
						  $.modaldialog.error('Error getting directions');
					  }
					);
			}
		  
		   $(document).ready(getLocation".$currentQuestId.");
		   		
		   $('#questMap".htmlspecialchars($currentQuestId)."').live('pageshow', function() {
			   //alert(map".$currentQuestId.".getCenter());
			   var tempCenter = map".$currentQuestId.".getCenter();
			   google.maps.event.trigger(map".$currentQuestId.", 'resize'); 
			   //alert(map".$currentQuestId.".getCenter());
			   map".$currentQuestId.".setCenter(tempCenter);
			   //$(\"[data-position='fixed']\").fixedtoolbar('hide');
		   });
		   		   
		   window.addEventListener('orientationchange', resizeMapArea".$currentQuestId.", true);
		   window.addEventListener('resize', resizeMapArea".$currentQuestId.", true);
           window.addEventListener('load', resizeMapArea".$currentQuestId.", true);
</script>

 
  <div data-role='header' data-position=fixed>
	<h1>".$currentQuestName." map</h1>
	<a href='' onclick=window.history.back(); data-icon='arrow-l' data-ajax='false' data-rel='external' data-role='button' data-mini='true' data-inline='true' >Back</a>
</div>

  <div data-role='content'> 
	
		<div align='center' id='mapArea".htmlspecialchars($currentQuestId)."' style='margin-left: 0px; margin-right: 0px;'>
			
			<div style='position:relative;top:50%;transform:translateY(-50%);'>
				<h3 align='center' style='text-align:center;align:center;color:#3B0B0B;'>Loading...</h3>
				<img src='css/images/loader.gif' alt='Loading...' height='60' width='60' style='margin:auto;display:block;vertical-align:middle;'>
			</div>
			
		</div>
		
		<div id='legend".htmlspecialchars($currentQuestId)."' style='background:white; margin: 5px; border: 2px solid #3B0B0B; align:justify; text-align:justify;'>
		  <h3 style='background:white; align:center; text-align:center; color:#3B0B0B;'>Legend</h3>
		</div>
	
	
  </div><!-- /content -->
  
	<div data-role='footer' data-position=fixed>
    	<h4>Open Virtual Worlds Group</h4>
	</div>

</div><!-- /page -->

";
							
							
							
						$questTaskResult=mysql_query("SELECT * FROM questtasks WHERE quest='".$currentQuestId."' ORDER BY sn;");

						while($questTaskRow=mysql_fetch_array($questTaskResult))
						{
							$questPages.="<div data-role='page' style=' overflow-x:hidden; background-image:url(css/images/scroll.jpg);background-size: 100% 100%;' id='".htmlspecialchars($currentQuestId)."_page_".htmlspecialchars($questTaskRow['taskid'])."' data-url='appquests.html#".htmlspecialchars($currentQuestId)."_page_".htmlspecialchars($questTaskRow['taskid'])."' data-dom-cache='false'>";
								
								//$questPages.="<script> window.addEventListener('load', function() {window.localStorage.setItem('currentTaskUrl', document.URL);});</script>";
								
								$questPages.="<div data-role='header'>";
									$questPages.="<a href='' data-icon='arrow-l' onclick='window.history.back();' data-role='button' data-mini='true' data-inline='true'>Back</a>";
									$questPages.="<h1>".htmlspecialchars($currentQuestName)." Task ".htmlspecialchars($questTaskRow['taskid'])."</h1>";
									$questPages.="<a href='' data-icon='delete' onclick='confirmExit();' data-role='button' data-mini='true' data-inline='true'>Quit</a>";
								$questPages.="</div>";
							
								$questPages.="<div data-role='content'>";
								
								
									$questPages.="<div name=questiondiv style='background-image:url(css/images/newscroll.png);background-size: 100% 100%; position:relative; height:35%; overflow:auto; padding: 11% 10% 7% 10%;'>";
										$questPages.="<div style='height:85%;width:100%;overflow:auto;'><h4 style='color:#3B0B0B;text-align:justify;'>".$questTaskRow['task']."</h4></div>";
									$questPages.="</div>";
									
									$questPages.="<div name=optionsAndLocationdiv style='position:relative; align:center; float:center; width:80%;left:10%;' align='center'>";
																				
										$taskOptions= explode("+++", $questTaskRow['options']);
										
										$questPages.="<fieldset data-role=controlgroup data-mini=true>";
										
										
										foreach ($taskOptions as $currentOption) 
										{
											//$questPages.="<input type=radio name='".htmlspecialchars($currentQuestId)."_options_".htmlspecialchars($questTaskRow['taskid'])."' value='".htmlspecialchars($currentOption)."' id='".htmlspecialchars($currentOption)."' checked=checked />";
											//$questPages.="<label for='".htmlspecialchars($currentOption)."'>".htmlspecialchars($currentOption)."</label>";
											
											$questPages.="<input type=radio name=\"".htmlspecialchars($currentQuestId)."_options_".htmlspecialchars($questTaskRow['taskid'])."\" value=\"".htmlspecialchars($currentOption)."\" id=\"".htmlspecialchars($currentOption)."\" checked=checked />";
											$questPages.="<label for=\"".htmlspecialchars($currentOption)."\">".htmlspecialchars(str_replace("doublequote", "\"", str_replace("singlequote", "'", $currentOption)))."</label>";
										}
										
										$questPages.="</fieldset>";
										
										$taskAnswer = $taskOptions[$questTaskRow['expected']-1];
										
										$taskAnswer = str_replace(" ", "---", $taskAnswer);
										
										$explanation = $questTaskRow['explanation'];
										
										$explanation = str_replace(" ", "---", $explanation);
										$explanation = str_replace('"', '&quot', $explanation);
										
										$nextLocation = "the farewell page";
										
										$questTaskNextLocationResult=mysql_query("SELECT * FROM questtasks WHERE quest='".$currentQuestId."' AND taskid > ".$questTaskRow['taskid']." ORDER BY taskid LIMIT 1;");

										while($questTaskNextLocationRow=mysql_fetch_array($questTaskNextLocationResult))
										{
											$nextLocation = $questTaskNextLocationRow['tasklocation'];
										}
										
										$nextLocation = str_replace(" ", "---", $nextLocation);
										$nextLocation = str_replace('"', '&quot', $nextLocation);
																				
										$questPages.="<a align=left style='align:left; float:left;' href='' data-transition=slide data-icon='arrow-r' onclick=\"validateAnswer('".htmlspecialchars($currentQuestId)."_options_".htmlspecialchars($questTaskRow['taskid'])."+++".$taskAnswer."+++".$explanation."+++".$nextLocation."');\" data-role='button' data-mini='true' data-inline='true'>Next</a>";
										
										//This line is now obsolete. It is only still present as a result of extra caution //$questPages.="<div align=right style='align:right;'><a data-role='button' data-mini='true' data-inline='true' onclick='resizeMapArea".$currentQuestId."(); storeCoordAndId".$currentQuestId."(".htmlspecialchars($questTaskRow['tasklat']).",".htmlspecialchars($questTaskRow['tasklon'])."+++".$currentQuestId.");' href='appquests.html#questMap".htmlspecialchars($currentQuestId)."' rel='external'>Go to Map</a></div>";								
										
										$questPages.="<div align=right style='align:right;'><a data-role='button' data-mini='true' data-inline='true' onclick='checkForMap(this); resizeMapArea".$currentQuestId."();' href='appquests.html#questMap".htmlspecialchars($currentQuestId)."' rel='external'>Go to Map</a></div>";								
										
										//This line works perfectly and is the alternative to the line directly above //$questPages.="<div align=right style='align:right;'><a data-role='button' data-mini='true' data-inline='true' onclick='resizeMapArea".$currentQuestId."();' href='appquests.html#questMap".htmlspecialchars($currentQuestId)."' rel='external'>Go to Map</a></div>";								
										
									$questPages.="</div>";
									
								$questPages.="</div>";
								
								$questPages.="<div data-role='footer' data-position='fixed'>";
									$questPages.="<h4>Open Virtual Worlds Group</h4>";
								$questPages.="</div>";
							$questPages.="</div>";
							
							$questPages.="<br>";
						}
						
						
						$quests.="<li><a href='' data-mini=true data-inline=true rel='external' onclick=confirmStart('appquests.html#".htmlspecialchars($currentQuestId)."_intro_page');>".htmlspecialchars($row['quest_name'])."</a></li>";
						
						$quests.="</ul>";
					}
					
					//$quests.="</ul>";
					
					if(empty($quests))
					{								
						$quests.="<div align='center'><h4 style='color:#3B0B0B;'>No tours have been identified!</h4></div>";
					}
					
					else
					{
						$quests="<div align='center'><h2 style='color:#3B0B0B;'>Please select a tour</h2></div>".$quests;
					}


$finalOutput = array(
    "listings" => $quests,
    "map" => $questMapPage,
    "pages" => $questPages,
);

echo json_encode($finalOutput);
?>