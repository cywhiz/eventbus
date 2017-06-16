function initList() {
  var url = 'https://app.ticketmaster.com/discovery/v2/events?city=London&countryCode=GB&size=10&apikey=IWAc0GdQ57dn9WYdX9RFNAeopoUCWs75';

  $.ajax({
    url: url,
    beforeSend: function() {
      console.log('calling ' + url);
    },
    success: function(data) {
      console.log('Success!');
      console.log(data);
      loadListData(data);
    },
    error: function(jq, status, message) {
      console.log('Failed');
    }
  });

  return true;
}

function loadListData(data) {

  var html = '<table id="eventlist" class="table-striped table-hover table-condensed">';

  data._embedded.events.forEach(function(event) {

    event._embedded.venues.forEach(function(venue) {
      var latitude = venue.location.latitude;
      var longitude = venue.location.longitude;
      var venue = venue.name;
      var eventId = event.id;
      var eventName = event.name;
      var img = event.images[0].url;

      html += '<tr>' +
              '<form action="event.html" method="get">' +
              '<td><img src="' + img + '" height=100 width=100></img></td>' +
              '<td>Venue: ' + venue + '<br>' +
              'Event ID: ' + eventId + '<br>' +
              'Event Name: <b>' + eventName + '</b></td>' +
              '<input type="hidden" name="eventId" value="' + eventId + '">' +
              '<input type="hidden" name="longitude" value="' + longitude + '">' +
              '<input type="hidden" name="latitude" value="' + latitude + '">' +
              '<input type="hidden" name="eventName" value="' + eventName + '">' +
              '<td><button type="submit" class="btn btn-primary">Select</button></td>' +
              '</form>' +
              '</tr>';
    });
  });
  html += '</table>';

  $('#eventlist').html(html);
}