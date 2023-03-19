<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDsY5ojIy0CkKZGa0-09H9X90ituejoXuU" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body onload="initMap();">
    <style>
    #map {
        height: 100%;
    }

    /* Optional: Makes the sample page fill the window. */
    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
</style>
    <div id="map"></div>
    
    <script>
    let map, infoWindow;

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat:14.5978219, lng:106.2469714 },
            zoom: 6,
        });
        infoWindow = new google.maps.InfoWindow();

        const locationButton = document.createElement("button");

        locationButton.textContent = "Get current location";
        locationButton.classList.add("btn");
        locationButton.classList.add("btn-info");
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
        locationButton.addEventListener("click", () => {
            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        };

                        infoWindow.setPosition(pos);
                        infoWindow.setContent('Long: '+ pos.lng + ' Lat: '+ pos.lat);
                        infoWindow.open(map);
                        map.setZoom(15);
                        map.setCenter(pos);
                    },
                    () => {
                        handleLocationError(true, infoWindow, map.getCenter());
                    }
                );
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
            }
        });
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(
            browserHasGeolocation
                ? "Error: The Geolocation service failed."
                : "Error: Your browser doesn't support geolocation."
        );
        infoWindow.open(map);
    }

    window.initMap = initMap;
</script>
</body>
</html>