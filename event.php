<?php
include('get-ticketmaster-event.php');

if (!isset($_GET['id'])) die('missing id');
$event_id = $_GET['id'];

$event = getTicketmasterEvent($event_id);
?>
<html>
<body>
<head>
  <title>event</title>
  <script language="javascript" src="./main.js">
  <script language="javascript" src="./ticketmaster.js">
  <script language="javascript" src="./tfl.js">
  
  <script language="javascript">
  event = "<?php=$event ?>";
  </script>

  <link rel="stylesheet" type=text/css href="main.css">

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body onload="init();">
  <h1>Event</h1>
  <div id='map'></div>
</body>
</html>
