<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map-canvas { height: 100% }
    </style>
	
	
	
	<script src="https://maps.googleapis.com/maps/api/js?v=3.9&sensor=false&libraries=geometry"></script>
    	<?php
		error_reporting(E_ALL);
  	$filename = "latLong.txt";
  	$contents = file_get_contents($filename); // get lat long
  	$latLong = explode(",", $contents); // parsing lat long at comma

    	?>
  	
    <script type="text/javascript">
	
      function initialize() { //set initial settings
  var myLatLng = new google.maps.LatLng(0,0);
  var mapOptions = {
    zoom: 19, //19
    center: myLatLng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  
  var yard;
	
  var map = new google.maps.Map(document.getElementById("map-canvas"),
      mapOptions);

 //sample yard boundary coordinates
var yardCoords = [
    new google.maps.LatLng(40.695229, -73.993011),
    new google.maps.LatLng(40.695568, -73.992880),
    new google.maps.LatLng(40.695330, -73.991960),
    new google.maps.LatLng(40.694979, -73.992129),
    new google.maps.LatLng(40.695229, -73.993011)
  ];
  // Draw the yard
 
  yard = new google.maps.Polygon({
    paths: yardCoords,
    strokeColor: "#FF0000",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    fillColor: "#FF0000",
    fillOpacity: 0.35,
    clickable:false
  });

  yard.setMap(map);
	 
    var dogLat = "<?php echo $latLong[1]; ?>";
    var dogLong = "<?php echo $latLong[0]; ?>";
	//place marker at location found in latLong.txt
    var dogLatLng = new google.maps.LatLng(dogLat, dogLong); 
	placeMarker(dogLatLng, map);
	//depending on dog's location change the color of the yard overlay
	if(google.maps.geometry.poly.containsLocation(marker.getPosition(), yard) == true) { 
		yard.setOptions({fillOpacity: 0}); // Dog is Safe
	} else {
		yard.setOptions({fillOpacity: 0.35}); // Dog is Out
		
	}

}

google.maps.event.addDomListener(window, 'load', initialize);
    </script>
	
  </head>
  <body>
    	
	
    <div id="map-canvas"/>
  </body>
</html>
