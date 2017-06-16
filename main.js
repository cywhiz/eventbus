
function init() {
  var map = L.map('map');
 	 
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
     attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors',
     maxZoom: 18
  }).addTo(map);
  map.attributionControl.setPrefix(''); // Don't show the 'Powered by Leaflet' text.
  
  var london = new L.LatLng(51.505, -0.09); // geographical point (longitude and latitude)
  map.setView(london, 13);
}
