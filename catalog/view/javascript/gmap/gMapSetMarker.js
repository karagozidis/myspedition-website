

 var mapCenter = new google.maps.LatLng(45.64463782485651, 38.8017578125);
 var map;
 var marker;
 var lat;
 var lng;
 
function initialize() {
    var mapProp = {
        center: mapCenter,
        zoom: 3,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

     map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

  google.maps.event.addListener(map, 'click', function(event) {
    placeMarker(event.latLng);
  });
  
  placeMarkerOnload();
  
}

google.maps.event.addDomListener(window, 'load', initialize);


function placeMarker(location) {
  
  if (!marker) {
        marker = new google.maps.Marker({
            position: location,
            map: map, 
            url: 'www.google.gr'
        });
    } else {
        marker.setPosition(location);
    }
    
    if( document.getElementById("lat") )
            {
            document.getElementById("lat").value  = marker.getPosition().lat();
            }
        
    if( document.getElementById("lng") )
            {
            document.getElementById("lng").value  = marker.getPosition().lng();
            }
   // alert(marker.getPosition().lat());
   // alert(marker.getPosition().lng());
 // map.setCenter(location);
}


function loadInitialLatLng(lat,lng)
{  
    //alert('sdsdsd');
    lat_ = lat;
    lng_ = lng;
  //  initialLocation = new google.maps.LatLng(lat, lng);
}

function placeMarkerOnload() {

  var location = new google.maps.LatLng(lat_,lng_);
  //alert(lat_);
  
  if (!marker) {
        marker = new google.maps.Marker({
            position: location,
            map: map, 
            url: 'www.google.gr'
        });
    } else {
        marker.setPosition(location);
    }
    
   // alert(marker.getPosition().lat());
   // alert(marker.getPosition().lng());
   map.setCenter(location);
}


geocoder = new google.maps.Geocoder();
function markerByAddress() {
    //In this case it gets the address from an element on the page, but obviously you  could just pass it to the method instead
   // var address = 'Polixni,Thessaloniki,Greece';
   
   // var country = document.getElementById("country_id");
    var e = document.getElementById("country_id");
    var country = '';
    if(e.selectedIndex == 0 ) country= '';
    else country = e.options[e.selectedIndex].text;
    
   // var zone = document.getElementById("zone_id").value;
    var e = document.getElementById("zone_id");
    var zone = '';
    if(e.selectedIndex == 0 )zone = '';
    else zone = e.options[e.selectedIndex].text;
    
    var address_1 = document.getElementById("address_1").value;
    
    var address = country+","+zone+","+address_1;
   // alert(address);
    
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            marker.setPosition( results[0].geometry.location);
            
        if( document.getElementById("lat") )
                {
                document.getElementById("lat").value  = marker.getPosition().lat();
                }

        if( document.getElementById("lng") )
                {
                document.getElementById("lng").value  = marker.getPosition().lng();
                }
            
      } else {
            //alert("Geocode was not successful for the following reason: " + status);
      }
    });
    
  }
//placeMarkerOnload( '<?php echo $lat; ?>' , '<?php echo $lng; ?>' );
