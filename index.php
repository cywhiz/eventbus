<!DOCTYPE html>
<html lang="en">

<head>
    <title>TicketMaster</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/redmond/jquery-ui.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <?php
    	$url = 'https://app.ticketmaster.com/discovery/v2/events?apikey=IWAc0GdQ57dn9WYdX9RFNAeopoUCWs75&city=London&countryCode=GB&size=10';
		$json = json_decode(file_get_contents($url), true);


        echo '<table>';
		foreach ($json['_embedded']['events'] as $k => $v ) {
            
            foreach ($v['_embedded']['venues'] as $i => $j) {
                $longitude = isset($j['location']['longitude']) ? $j['location']['longitude'] : -9999;
                $latitude  = isset($j['location']['latitude'])  ? $j['location']['latitude'] : -9999;
                $venue     = $j['name'];
                $eventId   = $v['id'];
                $eventName = $v['name'];
                $img = $v['images'][0]['url'];

                echo '<tr>';
                echo '<form action="event.php" method="get">';
                echo '<td><img src="'. $img . '" height=100 width=100></img></td>';
                echo '<td>Venue: ' . $venue . '<br>';
                echo 'Event ID: ' . $eventId . '<br>';
                echo 'Event Name: <b>' . $eventName . '</b></td>';
                echo '<input type="hidden" name="eventId" value="'. $eventId .'">';
                echo '<input type="hidden" name="longitude" value="'. $longitude .'">';
                echo '<input type="hidden" name="latitude" value="'. $latitude .'">';
                echo '<input type="hidden" name="eventName" value="'. $eventName .'">';
                echo '<td><button type="submit" class="btn btn-primary">Select</button></td>';
                echo '</form>';
                echo '</tr>';
            }
            
		}
        echo '</table>';

    ?>
</body>
