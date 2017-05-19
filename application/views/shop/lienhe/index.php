

<div class="page-content">
    <div class="row">
        <div class="col-sm-6">
            <div id="map"></div>
   <style>
      #map {
        height: 400px;
        width: 100%;
       }
    </style>
    <script>
      function initMap() {
        var uluru = {lat: <?= MAPLAT ?>, lng: <?= MAPLNG ?>};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map,
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCp7bHR1BiHk59mBqg-B_rTckZ5W85TUuc&callback=initMap">
    </script>


        </div>
        <div class="col-sm-6">
            <h1><?= TENSHOP ?></h1>
            <table class="storeInfo">
                <tr>
                    <td class="tdIcon">
                        <i class="fa fa-home"></i>
                    </td>
                    <td class="tdColName">
                        Địa chỉ:
                    </td>
                    <td>
                        <?= DIACHI ?>
                    </td>
                </tr>
                <tr>
                    <td class="tdIcon">
                        <i class="fa fa-phone"></i>
                    </td>
                    <td class="tdColName">
                        SDT:
                    </td>
                    <td>
                        <?= SDT ?>
                    </td>
                </tr>
                <tr>
                    <td class="tdIcon">
                        <i class="fa fa-envelope"></i>
                    </td>
                    <td class="tdColName">
                        Email:
                    </td>
                    <td>
                        <?= EMAIL ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>


</div>
