<?php include('includes/header.php'); ?>
<?php
$properties = new Properties();
$all_properties = $properties->getAll_properties();

?>
<div id="map">
  <h3>Impossible de charger la map</h3>
</div>

<?php if ($all_properties) : ?>
  <?php
  $locations = [];
  $curl = curl_init();
  foreach ($all_properties as $property) {
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($property['address']) . "&key=AIzaSyAgwEcOb6n37QfBvC5JuTGKxV9QQUBxgs8",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $datas = curl_exec($curl);

    if ($datas === false || curl_getinfo($curl, CURLINFO_HTTP_CODE) !== 200) {
      return null;
    }
    $datas = json_decode($datas, true);

    $locations[] = ['address' => $property['address'], 'price' => $property['price'], 'picture' => $property['picture'], 'lat' => $datas['results'][0]["geometry"]["location"]["lat"] ?? 0, 'lng' => $datas['results'][0]["geometry"]["location"]["lng"] ?? 0];
  }

  ?>
  <script>
    function initMap() {
      var locations = [
        <?php foreach ($locations as $location) : ?>["<?php echo $location['address'] ?>", <?php echo $location['lat'] ?>, <?php echo $location['lng'] ?>, "<?php echo $location['picture'] ?>", "<?php echo $location['price'] ?>"],
        <?php endforeach; ?>
      ];

      let mapOptions = {
        center: new google.maps.LatLng(10, -10),
        zoom: 3,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      }

      // Moved this line up here
      this.map = new google.maps.Map(document.getElementById('map'), mapOptions); // changed the "native element" to a standard DOM element for the sake of this example

      var infowindow = new google.maps.InfoWindow();

      var marker, i;

      for (i = 0; i < locations.length; i++) {
        marker = new google.maps.Marker({
          position: new google.maps.LatLng(locations[i][1], locations[i][2]),
          map: this.map // You are using this.map here so it needs to be created before
        });

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            infowindow.setContent("<div style='display:flex'><img style='max-width:100px;max-heigth:50px;object-fit:cover;' src='" + locations[i][3] + "'></div><div style='float:right; padding: 10px;'><b>" + locations[i][0] + "</b><br>" + locations[i][4] + "fcfa</div>");
            infowindow.open(Map, marker);
          }
        })(marker, i));
      }
    }

    window.initMap = initMap;
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgwEcOb6n37QfBvC5JuTGKxV9QQUBxgs8&callback=initMap&v=weekly" defer></script>
<?php endif; ?>
<?php include('includes/footer.php'); ?>