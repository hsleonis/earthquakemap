/**
 * @package WordPress
 * @subpackage SP Google Maps
 * @version 1.1
 * @since SP Google Maps 1.0
 */
jQuery(document).ready(function($){
	//place_category
	$('.place_category').change(function(){
		$("#EQSIM").submit();
	});
	var data = JSON.parse($("#esimcData").html());
	//esimc
	// https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false
	// //code.jquery.com/jquery-1.11.0.min.js
	var map;
	// The JSON data
	function initialize() {
	  
	  // Giving the map som options
	  var mapOptions = {
	    zoom: data.zoom,
	    center: new google.maps.LatLng(data.center[0], data.center[1])
	  };
	  // Creating the map
	  map = new google.maps.Map(document.getElementById('esimc'), mapOptions);
	  var markers = [];
	  var infowindow;
	  // Looping through all the entries from the JSON data
	  for(var i = 0; i < data.places.length; i++) {
	    // Current object
	    var obj = data.places[i];
	    // Adding a new marker for the object
	    var marker = new google.maps.Marker({
	      position: new google.maps.LatLng(obj.latitude,obj.longitude),
	      map: map,
	      icon: obj.icon,
	      //animation: google.maps.Animation.DROP,
	      title: obj.title // this works, giving the marker a title with the correct title
	    });
	    // Adding a new info window for the object
	    var clicker = addClicker(marker, obj.infobox);
	    markers.push(marker);
	  } // end loop
	  var markerCluster = new MarkerClusterer(map, markers);
	  // Adding a new click event listener for the object
	  function addClicker(marker, content) {
	    google.maps.event.addListener(marker, 'click', function() {
	      if(infowindow) {infowindow.close();}
	      infowindow = new google.maps.InfoWindow({content: content});
	      infowindow.open(map, marker);
	      
	    });
	  }  
	}

	// Initialize the map
	google.maps.event.addDomListener(window, 'load', initialize);
	//Basic Steet Maps
//	function dragableMaps(){
//		var LatLng = new google.maps.LatLng(36.2048,138.2529);
//		
//		var map = new google.maps.Map(document.getElementById("EQSIMAP"), {
//			center: LatLng,
//			zoom: 5,
//			mapTypeId: google.maps.MapTypeId.ROADMAP,
//			streetViewControl: false,
//			scrollwheel: false,
//		});
//	
//		var marker = new google.maps.Marker({
//			position: LatLng,
//			//title: "Your Location!",
//			draggable: true
//		});
//		marker.setMap(map)	;
//		//on latlan input field change
//		$("#longlang").keyup(function(){
//			latlan = $(this).val().split(',');
//			var LatLng = new google.maps.LatLng(Number(latlan[0]),Number(latlan[1]));
//			marker.setPosition(LatLng);
//			map.panTo(marker.getPosition());
//		});
//		google.maps.event.addListener( marker, 'dragend', function(ev){
//			map.panTo(marker.getPosition());
//			document.getElementById('longlang').value = ev.latLng.lat()+','+ev.latLng.lng();
//		});
//	}
//	google.maps.event.addDomListener(window, 'load', dragableMaps);
	
});