/**
 * Classe che gestisce la visualizzazione della mappa
 */

var id_map = "googleMap";
var zoom_level = 15;
var map;
var markersArray = [];

/*
 * Funzione che inizializza la mappa al caricamento
 */
function initialize(){
	var lat = 45.56374;
	var lon = 10.23261;
	var mapProp = {
	  center:new google.maps.LatLng(lat,lon),
	  zoom:zoom_level,
	  mapTypeId:google.maps.MapTypeId.ROADMAP
	  };
	map=new google.maps.Map(document.getElementById(id_map),mapProp);		
}
	
function addMarker(nome, lat, lon){	
	var myCenter=new google.maps.LatLng(lat,lon);	
	var marker=new google.maps.Marker({
 		 position:myCenter,
 		 title:nome
  	});
  	marker['infowindow'] = new google.maps.InfoWindow({
            content: nome
        });
    google.maps.event.addListener(marker, 'click', function() {
        this['infowindow'].open(map, this);
    });
    map.setCenter(marker.getPosition());
    
	markersArray.push(marker);
	marker.setMap(map);
}

function removeMarkers() {
  if (markersArray) {
    for (i in markersArray) {
      markersArray[i].setMap(null);
    }
    markersArray.length = 0;
  }
}

