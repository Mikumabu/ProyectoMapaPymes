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
</body>
</html>
