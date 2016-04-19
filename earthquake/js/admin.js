/**
 * @package WordPress
 * @subpackage SP Google Maps
 * @version 1.1
 * @since SP Google Maps 1.0
 */
jQuery(document).ready(function($){
	
	//Basic Steet Maps
	function dragableMaps(){
		//var LatLng = new google.maps.LatLng(23.727369,90.396604);
		var LatLng = new google.maps.LatLng(Number(mapdata.maps_lat),Number(mapdata.maps_lng));
		
		var map = new google.maps.Map(document.getElementById("eq_map"), {
			center: LatLng,
			zoom:Number(mapdata.maps_zoom),
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			streetViewControl: false,
		});
	
		var marker = new google.maps.Marker({
			position: LatLng,
			title: "Your Location!",
			draggable: true
		});
		marker.setMap(map)	;
		//on latlan input field change
		$("#_earthquake_marker_latlng").change(function(){
			latlan = $(this).val().split(',');
			var LatLng = new google.maps.LatLng(23.727369,90.396604);
			var LatLng = new google.maps.LatLng(Number(latlan[0]),Number(latlan[1]));
			marker.setPosition(LatLng);
			map.panTo(marker.getPosition());
			panorama.setPosition(LatLng);
		});
		google.maps.event.addListener( marker, 'dragend', function(ev){
			map.panTo(marker.getPosition());
			document.getElementById('_earthquake_marker_latlng').value = ev.latLng.lat()+','+ev.latLng.lng();
			panorama.setPosition(ev.latLng);
		});
	}
	google.maps.event.addDomListener(window, 'load', dragableMaps);
	
});