<!DOCTYPE html>
<html>

<head>
    <title>Mapa de Calor</title>
    <style>
        /* Establece el tamaño del mapa */
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>

<body>
    <h1>Mapa de Calor</h1>
    <div id="map"></div>

    <script>
        // This example requires the Visualization library. Include the libraries=visualization
        // parameter when you first load the API. For example:
        // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=visualization">
        let map, heatmap;

        function initMap() {
            var heatmapOptions = {
                radius: 20, // Radio de los puntos de calor
                maxIntensity: 30
            };
            /* Data points defined as a mixture of WeightedLocation and LatLng objects */
            var heatMapData = [{
                    location: new google.maps.LatLng(37.782, -122.447),
                    weight: 3
                },
                new google.maps.LatLng(37.782, -122.445),
                {
                    location: new google.maps.LatLng(37.782, -122.443),
                    weight: 3
                },
                {
                    location: new google.maps.LatLng(37.782, -122.441),
                    weight: 3
                },
                {
                    location: new google.maps.LatLng(37.782, -122.442),
                    weight: 3
                },
                {
                    location: new google.maps.LatLng(37.782, -122.444),
                    weight: 3
                },
                {
                    location: new google.maps.LatLng(37.782, -122.439),
                    weight: 3
                },
                new google.maps.LatLng(37.782, -122.437),
                {
                    location: new google.maps.LatLng(37.782, -122.435),
                    weight: 3
                },

                {
                    location: new google.maps.LatLng(37.785, -122.447),
                    weight: 3
                },
                {
                    location: new google.maps.LatLng(37.785, -122.445),
                    weight: 3
                },
                new google.maps.LatLng(37.785, -122.443),
                {
                    location: new google.maps.LatLng(37.785, -122.441),
                    weight: 3
                },
                new google.maps.LatLng(37.785, -122.439),
                {
                    location: new google.maps.LatLng(37.785, -122.437),
                    weight: 3
                },
                {
                    location: new google.maps.LatLng(37.785, -122.435),
                    weight: 3
                }
            ];

            var sanFrancisco = new google.maps.LatLng(37.774546, -122.433523);

            map = new google.maps.Map(document.getElementById('map'), {
                center: sanFrancisco,
                zoom: 13,
                mapTypeId: 'satellite'
            });

            var heatmap = new google.maps.visualization.HeatmapLayer({
                data: heatMapData,
                options: heatmapOptions
            });

            heatmap.setMap(map);

        }

        window.initMap = initMap;
    </script>

    <!-- Incluye la biblioteca Google Maps JavaScript API con tu clave API -->
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&callback=initMap&v=weekly&libraries=visualization">
    </script>
</body>

</html>
