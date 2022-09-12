<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <title>Document</title>
    <style>
        #map {
  height: 400px;
  /* The height is 400 pixels */
  width: 100%;
  /* The width is the width of the web page */
}
    </style>
</head>
<body>
    <div id="map">
        
    </div>
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgwEcOb6n37QfBvC5JuTGKxV9QQUBxgs8&callback=initMap&v=weekly"
      defer
    ></script>
</body>
<script>
    // ## MARQUER PLUSIEURS POINT SUR LA MAP
// The following example creates five accessible and
// focusable markers.
// function initMap() {
//   const map = new google.maps.Map(document.getElementById("map"), {
//     zoom: 12,
//     center: { lat: 34.84555, lng: -111.8035 },
//   });
//   // Set LatLng and title text for the markers. The first marker (Boynton Pass)
//   // receives the initial focus when tab is pressed. Use arrow keys to
//   // move between markers; press tab again to cycle through the map controls.
//   const tourStops = [
//     [{ lat: 31.8791806, lng: -111.8265049 }, "Boynton Pass"],
//     [{ lat: 34.8559195, lng: -111.7988186 }, "Airport Mesa"],
//     [{ lat: 34.832149, lng: -111.7695277 }, "Chapel of the Holy Cross"],
//     [{ lat: 34.823736, lng: -111.8001857 }, "Red Rock Crossing"],
//     [{ lat: 34.800326, lng: -111.7665047 }, "Bell Rock"],
//   ];
//   // Create an info window to share between markers.
//   const infoWindow = new google.maps.InfoWindow();

//   // Create the markers.
//   tourStops.forEach(([position, title], i) => {
//     const marker = new google.maps.Marker({
//       position,
//       map,
//       title: `${i + 1}. ${title}`,
//       label: `${i + 1}`,
//       optimized: false,
//     });

//     // Add a click listener for each marker, and set up the info window.
//     marker.addListener("click", () => {
//       infoWindow.close();
//       infoWindow.setContent(marker.getTitle());
//       infoWindow.open(marker.getMap(), marker);
//     });
//   });
// }
// window.initMap = initMap;
</script>
</html>