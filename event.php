<?php
include('get-ticketmaster-event.php');

if (!isset($_GET['eventId'])) die('missing id');
$eventId = $_GET['eventId'];
$eventLat = $_GET['latitude'];
$eventLon = $_GET['longitude'];
$eventName = $_GET['eventName'];

//getTicketmasterEvent($event_id);
?>
<html>
<head>
  <title>event</title>
  <script src="./main.js" /></script>
 
  <!-- leaflet map includes -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
  
  <script language="javascript">
    //values from php -> javascript
    var eventName = "<?php echo $eventId; ?>";
    var eventLat = "<?php echo $eventLat; ?>";
    var eventLon = "<?php echo $eventLon; ?>";
  </script>

  <link rel="stylesheet" type=text/css href="./main.css">

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body onload="init();">
   <h1>Event: <?php echo $eventName; ?></h1>
   <?php 
      echo $eventId; 
      echo $eventLat;
      echo $eventLon;
      ?> 
   <div id="map" style="height:400px; width:400px;">
   map
   </div>
</body>

</html>
