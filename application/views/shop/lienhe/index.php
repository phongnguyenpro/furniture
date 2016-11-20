<script type="text/javascript">
                window.___gcfg = {
                    lang: 'vi',
                    parsetags: 'onload'
                };

                (function () {
                    var po = document.createElement('script');
                    po.type = 'text/javascript';
                    po.async = true;
                    po.src = 'https://apis.google.com/js/plusone.js';
                    var s = document.getElementsByTagName('script')[0];
                    s.parentNode.insertBefore(po, s);
                })();
            </script>
      
            
            
        
  <div class="page-content">
            <div class="row">
                <div class="col-sm-6">
                    <div class="box-authentication">
                        <h3>Gửi email cho chúng tôi</h3>
                        <form action="#" id="contact-form" method="post">
                            <div class="form-group">
                              <label>Tên của bạn*</label>
                        <div class="focus">
                            <input class="form-control" required type="text" name="name" placeholder="Nhập tên" />
                            <span></span>
                        </div>  
                            </div>
                          <div class="form-group">
                        <label>Email*</label>
                        <div class="focus">
                            <input required class="form-control" type="email" name="email" placeholder="someone@example.com" />
                            <span></span>
                        </div>
                          </div>
                             <div class="form-group">
                        <label>SDT*</label>
                        <div class="focus">
                            <input class="form-control" required type="text" name="sdt" placeholder="Nhập sdt" />
                            <span></span>
                        </div>
                             </div>
                             <div class="form-group">
                        <label>Tin nhắn*</label>
                        <div class="focus">
                            <textarea class="form-control" name="tinnhan" cols="30" rows="10" required></textarea>
                            <span></span>
                        </div>
                             </div>
                        <button class="btn btn-send button" type="submit"><i class="glyphicon glyphicon-send"></i> GỬI</button>
                    </form>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="box-authentication">
                     <h3>Vị trí </h3>
                      <div id="map" class="map"></div>
                      <hr>
                       <h3>Liên hệ </h3>
                       <h1><?= TENSHOP ?></h1>
                         <ul class="store_info">
                        <li><i class="fa fa-home"></i>Địa chỉ: <?= DIACHI ?></li>
                        <li><i class="fa fa-phone"></i>SDT: <span><?= SDT ?></span></li>
                        <li><i class="fa fa-envelope"></i>Email: <span><?= EMAIL ?></span></li>
                    </ul>     
                    </div>
                                           

                </div>
            </div>
  </div>



            
        </div>
    </div>

  <script>
    // This example adds a search box to a map, using the Google Place Autocomplete
    // feature. People can enter geographical searches. The search box will return a
    // pick list containing a mix of places and predicted search terms.

                function initAutocomplete() {
                var pos;
                        var haightAshbury = new google.maps.LatLng('<?= MAPLAT ?>','<?= MAPLNG ?>');
                        var map = new google.maps.Map(document.getElementById('map'), {
                             Center: haightAshbury,
                                zoom: 16,
                                mapTypeId: google.maps.MapTypeId.ROADMAP,
                                mapTypeControl: true,
    mapTypeControlOptions: {
        style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
        position: google.maps.ControlPosition.RIGHT
    },
                      });
//       if (navigator.geolocation) {
//                        navigator.geolocation.getCurrentPosition(function(position) {
//                        pos = {
//                        lat: position.coords.latitude,
//                                lng: position.coords.longitude
//                        };
//                                var infoWindow = new google.maps.InfoWindow({map: map});
//                                infoWindow.setPosition(pos);
//                                infoWindow.setContent('Có thể bạn đang ở đây.');
//                        }, function() {
//                        handleLocationError(true, infoWindow, map.getCenter());
//                        });
//                } else {
//        alert("Không xác định được vị trí của bạn")
//
//        }

        marker = new google.maps.Marker({
        map: map,
                animation: google.maps.Animation.DROP,
                position:haightAshbury,
          
        });
                var contentString = '<div id="content">' + "<b><?= TENSHOP ?></b><br><?= DIACHI ?>" + '</div>';
                var infowindow = new google.maps.InfoWindow({
                content: contentString
                });
                infowindow.open(map, marker);
               
                // [END region_getplaces]
                }


    </script>
    <style>
        #map
        {
            width: 100%;
            display: block;
            height: 300px;
        }
    </style>
   <script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initAutocomplete"
         async defer>
     
    </script>                       
            
    <script src="<?= URL ?>view/<?= THEME ?>/lienhe/js/index.js"></script>