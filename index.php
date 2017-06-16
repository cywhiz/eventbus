<!DOCTYPE html>
<html lang="en">

<head>
    <title>TicketMaster</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="index.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
</head>

<body>
    <img src="top.jpg" width="100%">
    <?php
    	$url = 'https://app.ticketmaster.com/discovery/v2/events?apikey=IWAc0GdQ57dn9WYdX9RFNAeopoUCWs75&city=London&countryCode=GB&size=10';
		$json = json_decode(file_get_contents($url), true);

        // var_dump($json);

        // echo '<script>console.log(\'' . 'fdsfdsf' . '\');</script>';

        // echo $json['_embedded']['events'][0];

        // foreach ()
        // echo '<select>';
        echo '<h2>Upcoming events</h2>';
        echo '<form action="event.php" method="get">';
        echo '<table class="table-striped table-hover table-condensed">';
		foreach ($json['_embedded']['events'] as $k => $v ) {
            // echo ($v['location'].'<br>');
            //print_r($v['_embedded']['venues']['location']);
            
            foreach ($v['_embedded']['venues'] as $i => $j) {
                $longitude = isset($j['location']['longitude']) ? $j['location']['longitude'] : -9999;
                $latitude = isset($j['location']['latitude']) ? $j['location']['longitude'] : -9999;
                $venue = $j['name'];
                $eventId = $v['id'];
                $eventName = $v['name'];
                $img = $v['images'][0]['url'];
                $dateTime = isset($v['dates']['start']['dateTime']) ? $v['dates']['start']['dateTime'] : 'N/A';


                echo '<tr>';
                echo '<td><img src="'. $img . '" height=100 width=100></img></td>';
                echo '<td>';
                echo '<div class="eventName">' . $eventName . '</div>';
                echo '<div class="venue">' . $venue . '</div>';
                echo '<div class="dateTime">' . $dateTime . '</div>';
                echo '</td>';
                // echo 'Event ID: ' . $eventId . '<br>';
                
                // echo 'Longtitude: ' . $longitude . '<br>';
                // echo 'Latitude: ' . $latitude . '<br>';
                echo '<input type="hidden" name="eventId" value="'. $eventId .'">';
                echo '<input type="hidden" name="longitude" value="'. $longitude .'">';
                echo '<input type="hidden" name="latitude" value="'. $latitude .'">';
                echo '<input type="hidden" name="eventName" value="'. $eventName .'">';

                echo '<td><button type="submit" class="btn btn-primary">Select</button></td>';
                echo '</tr>';
                // echo '<option value="'. $eventId . '">'. $eventName . '</option>';
            }
            
		}
        echo '</table>';

        echo '</form>';
        // echo '</select>';

        
    ?>
</body>
