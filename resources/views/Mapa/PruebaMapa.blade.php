<!DOCTYPE html>
<html>
<head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 100%;
        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
    <div>
        <?php
            echo(app('geocoder')->geocode('Guayaquil 1498, Antofagasta')->get());
        ?>
    </div>
</head>
<body>
<div style="width:500px;height:500px;">
    {!! Mapper::render() !!}
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIuJCrwX-2-hqArtpPyTEn340ezoucpS4&callback=initMap"
        async defer></script>
</body>
</html>
