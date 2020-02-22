@include('templates.company.partials._head')
<body class="hold-transition register-page">
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwMcyoyB7YIzDvhk1vskhg-Gjpsb__fvk&callback=initMap&libraries=places&language=id" type="text/javascript"></script>

 <style>
        #description {
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
        }

        #infowindow-content .title {
            font-weight: bold;
        }

        #infowindow-content {
            display: none;
        }

        #maps #infowindow-content {
            display: inline;
        }

        .pac-card {
            margin: 10px 10px 0 0;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            background-color: #fff;
            font-family: Roboto;
        }

        #pac-container {
            padding-bottom: 12px;
            margin-right: 12px;
        }

        .pac-controls {
            display: inline-block;
            padding: 5px 11px;
        }

        .pac-controls label {
            font-family: Roboto;
            font-size: 13px;
            font-weight: 300;
        }

        #pac-input {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 400px;
        }

        #pac-input:focus {
            border-color: #4d90fe;
        }

        #title {
            color: #fff;
            background-color: #4d90fe;
            font-size: 25px;
            font-weight: 500;
            padding: 6px 12px;
        }
        #target {
            width: 345px;
        }
        .error{
            color: red;
        }
    </style>


<div class="register-box">
  <div class="register-logo">
    <a href=""><b>GO-</b>TANK</a>
  </div>
    @if (session('message'))
          <div class="box-body">
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                &times;
              </button>
              <h4>
                <i class="icon fa fa-check"></i>
                Sukses !!!
              </h4>
              {{ session('message') }}
            </div>
          </div>
          @endif

  <div class="register-box-body">
    <p class="login-box-msg">BERGABUNG DENGAN KAMI SEKARANG!</p>

    <form action="{{ route('company.register') }} " method="POST" onsubmit="return validateForm()" >

        @csrf

      <div class="form-group has-feedback">
        <input id="name" placeholder="Nama Jasa Sedot Wc" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus maxlength="25">

        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @endif
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input id="email" placeholder="Masukan Email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input id="password" placeholder="Masukan password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input id="password-confirm" placeholder="Konfirmasi Password" type="password" class="form-control" name="password_confirmation" required>
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input id="name" placeholder="Masukan Harga" type="text" class="form-control{{ $errors->has('harga') ? ' is-invalid' : '' }}" name="harga" value="{{ old('harga') }}" required autofocus>

        @if ($errors->has('harga'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('harga') }}</strong>
            </span>
        @endif
        <span class="glyphicon glyphicon-usd form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input id="password" placeholder="No Telephone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" required maxlength="13">

        @if ($errors->has('phone'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('phone') }}</strong>
            </span>
        @endif
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input id="alamat-maps" type="hidden">
                        <input id="pac-input" class="controls" type="text" placeholder="Search Box">
                        <div id="maps" style="width: 100%;height: 70vh;"></div>
        <input type="hidden" class="form-control" id="latitude" name="latitude" placeholder="Latitude">
        <input type="hidden" class="form-control" id="longitude" name="longitude" placeholder="Longitude">

        
      </div>



     {{--  <div class="form-group has-feedback">
        <label class="custom-file-label" for="customFile">Choose file</label>
        <input type="file" class="custom-file-input" id="customFile">
      </div> --}}

      <div class="form-group has-feedback">
        <textarea name="address" id="address" placeholder="Alamat" rows="8" cols="80" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}">{{old('address')}}</textarea>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12" style="">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <a href="{{route('company.login')}}" class="text-center">Sudah Punya Akun? <b>Login Disini</b></a>
  </div>
  <!-- /.form-box -->
</div>
@include('templates.company.partials._script')
<script>
  var map;
    var markers = [];
    var posisi = {lat: -6.869206, lng: 109.136637 };
    var geocoder;

    initMap();
    function initMap() {
        geocoder = new google.maps.Geocoder();
        map = new google.maps.Map(document.getElementById('maps'), {
            zoom: 14,
            center: posisi,
            streetViewControl: false,
            gestureHandling: 'greedy',
            fullscreenControl: false,
        });

        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
        });

        searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }

            // Clear out the old markers.
            markers.forEach(function(marker) {
                marker.setMap(null);
            });
            markers = [];

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                var icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };

                // Create a marker for each place.
                markers.push(new google.maps.Marker({
                    map: map,
                    icon: icon,
                    title: place.name,
                    position: place.geometry.location
                }));

                $('#latitude').val(place.geometry.location.lat());
                $('#longitude').val(place.geometry.location.lng());
                $('#address').val(place.formatted_address);
                $('#alamat-maps').val(place.formatted_address);

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });

        map.addListener('click', function(event) {
            for (var i=0;i<markers.length;i++){
                markers[i].setMap(null);
                markers=[];
            }
            var marker = new google.maps.Marker({
                position: event.latLng,
                map: map
            });
            markers.push(marker);
            $('#latitude').val(event.latLng.lat());
            $('#longitude').val(event.latLng.lng());

            geocoder.geocode({'latLng': event.latLng}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[1]) {
                        $('#address').val(results[1].formatted_address);
                    } else {
                        alert('Tidak ditemukan nama jalan');
                    }
                } else {
                    alert('Gagal mengambil nama jalan : ' + status);
                }
            });
        });
    }

    function validateForm() {
        var nm_jalan = $('#alamat-maps').val().toLowerCase();

        console.log(nm_jalan);
        if (!nm_jalan.includes("kota tegal")) {
            alert("Lokasi peta anda tidak berasa di wilayah Kota Tegal...");
            return false;
        }
    }
</script>
</body>