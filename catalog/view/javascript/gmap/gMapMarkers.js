 var mapCenter = new google.maps.LatLng(45.64463782485651, 38.8017578125);
 var map;
 var lat;
 var lng;
 var lngLat = [];
 var lngLatRow = [];
 var lngLatTotal = 0;
 //var marker = [];
 var curHref = '';
 
function initialize() {
        var mapProp = {
            center: mapCenter,
            zoom: 3,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

      //  google.maps.event.addListener(map, 'click', function(event) {
       //   placeMarker(event.latLng);
      //  });

        placeMarkerOnload();
    }

google.maps.event.addDomListener(window, 'load', initialize);

function loadMarker(lat,lng,href)
    {  
    lngLatRow = []; 
    lngLatRow[0] = lat;
    lngLatRow[1] = lng;
    lngLatRow[2] = href;

    lngLat[lngLatTotal] = lngLatRow;
    lngLatTotal++;
    }
    

function placeMarkerOnload() {
    var LatLngList = [];// new Array (new google.maps.LatLng (52.537,-2.061), new google.maps.LatLng (52.564,-2.017));
    var bounds = new google.maps.LatLngBounds ();
    
    
    for (i =0 ; i < lngLatTotal ; i++)
        {
           var location = new google.maps.LatLng(lngLat[i][0],lngLat[i][1]);
           //var marker 
           LatLngList[i]=location;
           
           var marker = new google.maps.Marker({           
                position: location,
                map: map,
                icon: 'image/map_warehouse.png',
                url: lngLat[i][2],
                animation:google.maps.Animation.DROP
               // title: lngLat[i][2]
            }); 
            
            
      new google.maps.event.addListener(marker, 'click', function () {        
                window.location.href = this.url ;
                });
                
        }


       if(LatLngList.length == 1){
             map.panTo(marker.position);  
             map.setZoom(7);
           }
           
      if(LatLngList.length > 1)
          {
            for (var i = 0, LtLgLen = LatLngList.length; i < LtLgLen; i++) {
                bounds.extend (LatLngList[i]);
              }


           map.fitBounds (bounds);
          }



    }

