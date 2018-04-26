@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content">

    	<div class="row">
    		<div class="col-md-12">

				 <div class="pac-card" id="pac-card">
			      <div>
			        <div id="type-selector" class="pac-controls">
			          <input name="type" id="changetype-all" checked="checked" type="radio">
			          <label for="changetype-all">All</label>

			          <input name="type" id="changetype-establishment" type="radio">
			          <label for="changetype-establishment">Establishments</label>

			          <input name="type" id="changetype-address" type="radio">
			          <label for="changetype-address">Addresses</label>

			          <input name="type" id="changetype-geocode" type="radio">
			          <label for="changetype-geocode">Geocodes</label>
			        </div>
			        <div id="strict-bounds-selector" class="pac-controls">
			          <input id="use-strict-bounds" value="" type="checkbox">
			          <label for="use-strict-bounds">Strict Bounds</label>
			        </div>
			      </div>
			      <div id="pac-container">
			        <input id="pac-input" placeholder="Oops! Something went wrong." autocomplete="off" 	class=" gm-err-autocomplete" type="text">
			      </div>
			    </div>
			  </div>
		</div>


			 <div class="content-wrapperper " id="googlemap">
		   			<p><iframe id="googlemap" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3925.5385156981683!2d123.89378531434565!3d10.298717592646755!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a999579311910f%3A0xef5e33cb00ffe36c!2sAsian+College+Of+Technology!5e0!3m2!1sen!2sph!4v1504170048457"  height="420" frameborder="0" 	style="border:0" allowfullscreen></iframe></p>
		    </div>








	</section>
</div>


	

    <script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -33.8688, lng: 151.2195},
          zoom: 13
        });
        var card = document.getElementById('pac-card');
        var input = document.getElementById('pac-input');
        var types = document.getElementById('type-selector');
        var strictBounds = document.getElementById('strict-bounds-selector');

        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input);

        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

          infowindowContent.children['place-icon'].src = place.icon;
          infowindowContent.children['place-name'].textContent = place.name;
          infowindowContent.children['place-address'].textContent = address;
          infowindow.open(map, marker);
        });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
          var radioButton = document.getElementById(id);
          radioButton.addEventListener('click', function() {
            autocomplete.setTypes(types);
          });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);

        document.getElementById('use-strict-bounds')
            .addEventListener('click', function() {
              console.log('Checkbox clicked! New state=' + this.checked);
              autocomplete.setOptions({strictBounds: this.checked});
            });
      }
    </script>




 @include('admin.footer.footer')

       	</section>
</div>

@endsection