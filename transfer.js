const clearMarkers = () => {
    // Loop through the markers array and set the map property to null
    for (const marker of locationMarkers.value) {
      marker.setMap(null);
    }

    // Clear the markers array
    locationMarkers.value = [];
  };

const addRoute  = (markers) =>{
  loader.load().then(async () => {

    marker = markers.map((marker) => {

      const { position, title } = marker;

      return new google.maps.Marker({
        position,
        title,
        map,
      });
    });

    directionsService = new google.maps.DirectionsService();
    directionsRenderer = new google.maps.DirectionsRenderer({
      map,
      suppressMarkers: true,
    });

    // document.getElementById("show-route").addEventListener("click", () => {
    const waypoints = marker.map(({ position }) => ({ location: position }));
    const origin = waypoints.shift().location;
    const destination = waypoints.pop().location;

    directionsService.route(
        {
          origin,
          destination,
          travelMode: google.maps.TravelMode.DRIVING,
        },
        (response, status) => {
          if (status === "OK") {
            directionsRenderer.setDirections(response);
              directionsRenderer.setOptions({
                  polylineOptions: {
                      strokeColor: "#002c75", // Red color
                      strokeWeight: 4, // Line thickness
                      strokeOpacity: 0.7, // Line opacity (0-1)
                  },
              });
            let leg = response.routes[ 0 ].legs[ 0 ];
          } else {
            window.alert(`Directions request failed due to ${status}`);
          }
        }
    );
    // });
  });
}














//Reference

const clearMarkers = () => {
    // Loop through the markers array and set the map property to null
    for (const marker of locationMarkers.value) {
      marker.setMap(null);
    }

    // Clear the markers array
    locationMarkers.value = [];
  };

const showroute  = () =>{
    clearMarkers();
  loader.load().then(async () => {
    marker = markers.map((marker) => {
      const { position, title } = marker;
      return new google.maps.Marker({
        position,
        title,
        map,
        // icon: markerIcon
      });
    });

    let icons = {
      start:{
          url: markerImage,
          scaledSize: new google.maps.Size(40, 40),
      },
      end:{
          url: markerImage,
          scaledSize: new google.maps.Size(40, 40),
      }
    };

    directionsService = new google.maps.DirectionsService();
    directionsRenderer = new google.maps.DirectionsRenderer({
      map,
      suppressMarkers: true,
    });

    // document.getElementById("show-route").addEventListener("click", () => {
    const waypoints = marker.map(({ position }) => ({ location: position }));
    const origin = waypoints.shift().location;
    const destination = waypoints.pop().location;

    directionsService.route(
        {
          origin,
          destination,
          // waypoints,
          travelMode: google.maps.TravelMode.DRIVING,
        },
        (response, status) => {
          if (status === "OK") {
            directionsRenderer.setDirections(response);
              directionsRenderer.setOptions({
                  polylineOptions: {
                      strokeColor: "#002c75", // Red color
                      strokeWeight: 4, // Line thickness
                      strokeOpacity: 0.7, // Line opacity (0-1)
                  },
              });
            let leg = response.routes[ 0 ].legs[ 0 ];
            // console.log(response,leg.end_location);
            makeMarker( origin, icons.start, "title" );
            makeMarker( destination, icons.end, 'title' );
          } else {
            window.alert(`Directions request failed due to ${status}`);
          }
        }
    );
    // });
  });
}

function makeMarker( position, icon, title ) {
  new google.maps.Marker({
    position: position,
    map: map,
    icon: icon,
    title: title
  });
}
