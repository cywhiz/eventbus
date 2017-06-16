var eventId;
var eventLat;
var eventLon;
var eventName;
var map;
var group;

function initEvent() {
  eventId = getParameterByName('eventId');
  eventLat = getParameterByName('latitude');
  eventLon = getParameterByName('longitude');
  eventName = getParameterByName('eventName');
  
  if (!eventId) alert('Missing param eventId');
	
  $('#eventName').html(eventName);
  
  map = L.map('map');

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
     attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors',
     maxZoom: 18
  }).addTo(map);
  map.attributionControl.setPrefix(''); // Don't show the 'Powered by Leaflet' text.

  var london = new L.LatLng(51.505, -0.09); // geographical point (longitude and latitude)
  map.setView(london, 10);

  getBusStops(eventLat, eventLon);

  group = L.featureGroup([]).addTo(map);
}

// http://stackoverflow.com/a/901144/338265
function getParameterByName(name, url) {
  if (!url) url = window.location.href;
  name = name.replace(/[\[\]]/g, "\\$&");
  var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)", "i"),
      results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return '';
  return decodeURIComponent(results[2].replace(/\+/g, " "));
}


function getBusStops(lat, lon) {
   $.ajax({
      url: "https://api.tfl.gov.uk/Stoppoint?lat=" + lat + "&lon=" + lon + "&stoptypes=NaptanPublicBusCoachTram",
      success: function ( data ) {
        console.log(data);

        if (data.stopPoints.length==0) {
          $('#map').hide();
          alert('no coordinates');
        }

        data.stopPoints.forEach(function(sp) {
          var marker = new L.Marker(new L.LatLng(sp.lat, sp.lon));

          group.addLayer(marker);
        });

        map.fitBounds(group.getBounds().pad(0.5));
      }
   });
}
