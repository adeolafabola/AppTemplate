$(function()
{/* document ready */
	 $('.indexPage').live('pagecreate',
	 function(e)
	 {
		
		 
		 
	 });
	 
	 
	 
	 $('.loginPage').live('pagecreate',
	 function(e)
	 {
			 $('#loginForm').submit(function(event){
			 event.preventDefault();
			 jQuery.support.cors = true; 
			 $.ajax({ 
				 url: 'login.php',
				 crossDomain: true,
				 type: 'post',
				 data: $("#loginForm").serialize(), 
				 success: function(data){
					 if(data.status == 'success'){
						 window.location.href = 'trailmap.html'; 
					 }
					 else if(data.status == 'error'){
						 alert("Invalid username and/or password!");
						 clear();
						 return false;        
					}
					 else if(data.status == 'invalid'){
						 alert("Username and password fields cannot be empty!");
						 return false;        
					}

				 }
			 }); 

			 });
			 
			 function clear() 
			 {
			 
				$("#loginForm :input").each( function() {
					  $(this).val("");
				});
			 
			 }
	});
	 
	 
	 $('.registerPage').live('pagecreate',
	 function(e)
	 {
		 $('#registerForm').submit(function(event){
		 event.preventDefault();
		 jQuery.support.cors = true; 
		 $.ajax({ 
			 url: 'register.php',
			 crossDomain: true,
			 type: 'post',
			 data: $("#registerForm").serialize(), 
			 success: function(data){
				 if(data.status == 'success'){
					 window.location.href = 'login.html';
					 alert("Your account has been created! You can now login here!");
				 }
				 else if(data.status == 'error'){
					 alert("The username already exists. Please choose a different username!");
					 clear();
					 return false;        
				}
				 else if(data.status == 'invalid'){
					 alert("Username and password fields cannot be empty!");
					 return false;        
				}

			 }
		 }); 

		 });
		 
		 function clear() 
		 {
			$("#registerForm :input").each( function() {
				  $(this).val("");
			});
		}
		 
	 });
	 
	 
	 $('.trailMapPage').live('pagecreate',
	 function(e)
	 {
		window.onload=function()
		{
			//var mapAreaWidth = screen.width*0.8;
			//var mapAreaHeight = screen.height*0.5;
				
			var mapAreaWidth = window.innerWidth*0.8 || document.body.clientWidth*0.8
			var mapAreaHeight = window.innerHeight*0.5 || document.body.clientHeight*0.5
			
			var elem = document.getElementById('mapArea');
				
			elem.style.width = mapAreaWidth+"px";
			elem.style.height = mapAreaHeight+"px";
		}

		function getLocation()
		{
			if (navigator.geolocation)
			{
				navigator.geolocation.getCurrentPosition(showPosition);
			}
			else
			{ 
				document.getElementById("mapArea").innerHTML="Geolocation is not supported by this browser.";
			}
	    }
	    
		  function showPosition(position)
		  {
			var mapArea = document.getElementById('mapArea');
			var mapOptions = {
			  center: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
			  zoom: 16,
			  mapTypeId: google.maps.MapTypeId.ROADMAP
			}
			var map = new google.maps.Map(mapArea, mapOptions)
			
			
			var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
			var marker = new google.maps.Marker({
			  //position: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
			  position: {lat: position.coords.latitude, lng: position.coords.longitude},
			  map: map,
			  icon: iconBase + 'schools_maps.png'
			});
			
			var icons = {
			  parking: {
				name: 'Parking',
				icon: iconBase + 'parking_lot_maps.png'
			  },
			  library: {
				name: 'Library',
				icon: iconBase + 'library_maps.png'
			  },
			  info: {
				name: 'Info',
				icon: iconBase + 'info-i_maps.png'
			  }
			};
			
			var legend = document.getElementById('legend');
					
			for (var key in icons) 
			{
			  var type = icons[key];
			  var name = type.name;
			  var icon = type.icon;
			  var div = document.createElement('div');
			  div.innerHTML = '<img src="' + icon + '"> ' + name;
			  legend.appendChild(div);
			}
			
			map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend);
		  }
		  
			google.maps.event.addDomListener(window, 'load', getLocation);
		  
	 });
	 
	 
	 $('.trailPointsPage').live('pagecreate',
	 function(e)
	 {
		window.onload=function getTrailPoints()
		{
		 jQuery.support.cors = true; 
		 $.ajax({ 
			 url: 'getTrailPoints.php',
			 crossDomain: true,
			 type: 'post',
			 data: '', 
			 success: function(data)
			 {
				 //alert(data);
				 //document.getElementById('trailListings').innerHTML += data;
				 //document.getElementById('trailListings').innerHTML(data);
				 $('#trailListings').html(data);
				 $('#trailListings').trigger('create');
				 
			 }
		 }); 

		}
	 });
}