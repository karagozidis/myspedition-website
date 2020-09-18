     var markersArray = [];
       
     var rendererOptions = {suppressMarkers : true}

     var directionsService = new google.maps.DirectionsService();
     var directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);

     var map = new google.maps.Map(document.getElementById('map'), {
       zoom:7,
       mapTypeId: google.maps.MapTypeId.ROADMAP
     });

     directionsDisplay.setMap(map);
     directionsDisplay.setPanel(document.getElementById('panel'));


 	// Start/Finish icons
        //My images are 32 * 37 
 	var icons = {
  	start: new google.maps.MarkerImage(
                // URL
                'image/start.png',
                // (width,height)
                new google.maps.Size( 100, 100 ),
                // The origin point (x,y)
                new google.maps.Point( 0, 0 ),
                // The anchor point (x,y)
                new google.maps.Point( 16, 37 )
                ),
  	end: new google.maps.MarkerImage(
                // URL
                'image/end.png',
                // (width,height)
                new google.maps.Size( 100, 100 ),
                // The origin point (x,y)
                new google.maps.Point( 0, 0 ),
                // The anchor point (x,y)
                new google.maps.Point( 16, 37 )
                )
 	};


	var weatherLayer = new google.maps.weather.WeatherLayer({
              temperatureUnits: google.maps.weather.TemperatureUnit.FAHRENHEIT});
          

        weatherLayer.setMap(map);

        var cloudLayer = new google.maps.weather.CloudLayer();
        //cloudLayer.setMap(map);

     var request = {
       origin: "", 
       destination: "",
       travelMode: google.maps.DirectionsTravelMode.DRIVING
     };

     directionsService.route(request, function(response, status) {
       if (status == google.maps.DirectionsStatus.OK) {
         directionsDisplay.setDirections(response);
var leg = response.routes[ 0 ].legs[ 0 ];
  makeMarker( leg.start_location, icons.start, "title" );
  makeMarker( leg.end_location, icons.end, 'title' );
       }
     });


function makeMarker( position, icon, title ) {
 var marker = new google.maps.Marker({
  position: position,
  animation:google.maps.Animation.DROP,
  animation:google.maps.Animation.BOUNCE,
  map: map,
  icon: icon,
  title: title
 });
 
 markersArray.push(marker);
}

    function showDirectionsText(component)
    {
        //alert('not checked'); 
       if (component.checked == 1) document.getElementById("panel").style.visibility='visible';
       else document.getElementById("panel").style.visibility='hidden';
    }
    
    function showweather(component)
    {
        //alert('not checked'); 
       if (component.checked == 1) weatherLayer.setMap(map);
       else weatherLayer.setMap(null);
    }
        function showclouds(component)
    {
        //alert('not checked'); 
       if (component.checked == 1) cloudLayer.setMap(map);
       else cloudLayer.setMap(null);
    }
    
    function showDirections()
    {
        for (var i = 0; i < markersArray.length; i++ ) {markersArray[i].setMap(null);}
       // alert("dfdfdfd");
      //  alert(document.getElementById("fromArea").value); 
      //  alert(document.getElementById("toArea").value); 
        var fromArea = document.getElementById("fromArea").value;
        var toArea = document.getElementById("toArea").value;
        
        
        var waypts = [];
         
        if( document.getElementById("waypoint0") )
            {       
            if (document.getElementById("waypoint0").value != "")
            waypts.push({
                    location: document.getElementById("waypoint0").value,
                    stopover:false});     
            } 
            
        if( document.getElementById("waypoint1") )
            {
            if (document.getElementById("waypoint1").value != "")
            waypts.push({
                    location: document.getElementById("waypoint1").value,
                    stopover:false});     
            }
            
         if( document.getElementById("waypoint2") )
            {
            if (document.getElementById("waypoint2").value != "")
            waypts.push({
                    location: document.getElementById("waypoint2").value,
                    stopover:false});     
            }
            
         if( document.getElementById("waypoint3") )
            {
            if (document.getElementById("waypoint3").value != "")
            waypts.push({
                    location: document.getElementById("waypoint3").value,
                    stopover:false});     
            
            } 
         if( document.getElementById("waypoint4") )
            {
            if (document.getElementById("waypoint4").value != "")
            waypts.push({
                    location: document.getElementById("waypoint4").value,
                    stopover:false});     
            }
            
         if( document.getElementById("waypoint5") )
            {
            if (document.getElementById("waypoint5").value != "")
            waypts.push({
                    location: document.getElementById("waypoint5").value,
                    stopover:false});     
            
            }
            
         if( document.getElementById("waypoint6") )
            {
            if (document.getElementById("waypoint6").value != "")
            waypts.push({
                    location: document.getElementById("waypoint6").value,
                    stopover:false});     
            }
            
         if( document.getElementById("waypoint7") )
            {
            if (document.getElementById("waypoint7").value != "")
            waypts.push({
                    location: document.getElementById("waypoint7").value,
                    stopover:false});          
            }
            
         if( document.getElementById("waypoint8") )
            {
            if (document.getElementById("waypoint8").value != "")
            waypts.push({
                    location: document.getElementById("waypoint8").value,
                    stopover:false});  
            }
            
         if( document.getElementById("waypoint9") )
            {
            if (document.getElementById("waypoint9").value != "")
            waypts.push({
                    location: document.getElementById("waypoint9").value,
                    stopover:false});  
            }
        
     var request = {
        origin: fromArea, 
        destination: toArea,
        waypoints: waypts,
        optimizeWaypoints: true,
        travelMode: google.maps.DirectionsTravelMode.DRIVING
        };

     directionsService.route(request, function(response, status) {
       
       if(document.getElementById("distance"))
           {
            var metres = response.routes[0].legs[0].distance.value;
            var km = metres / 1000;
            document.getElementById('distance').innerHTML = km+" km";
           }
           
      // document.getElementById('duration').innerHTML += 
        if(document.getElementById("duration"))
           {
            var seconds =  response.routes[0].legs[0].duration.value ;
            var hours = Math.floor( seconds / (60 * 60) );
            var restSecs = (seconds % (60 * 60));
            var miniutes = Math.floor( restSecs / 60 ) ;
            //alert(hours + " Hours " + miniutes + " Miniutes");
            document.getElementById('duration').innerHTML = hours + " Hours " + miniutes + " Miniutes";
           }
           
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
            var leg = response.routes[ 0 ].legs[ 0 ];
            makeMarker( leg.start_location, icons.start, "title" );
            makeMarker( leg.end_location, icons.end, 'title' );
            }
        });
     
    }
    
    function resizeMap()
    {
   //sleep(2000);
    google.maps.event.trigger(map, 'resize');
    showDirections();
   // map.setZoom( map.getZoom() );      
    }
    
    
    
   // window.onload = showDirections();
    
    
    