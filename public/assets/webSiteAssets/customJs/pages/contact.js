function initMap() {
    var contentString =
    '<div class="map-info-window">' +
    '<p><img src="assets/images/logo-dark.png" alt=""></p>' +
    '<p><strong>Colina Resort</strong></p>' +
    '<p><i class="fa fa-map-marker"></i> 200 12th Ave, New York, NY 10001, USA</p>' +
    '<p><i class="fa fa-phone"></i> +12 33 444 555</p>' +
    '<p><i class="fa fa-clock-o"></i> 10am - 6pm</p>' +
    '</div>';

    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });
    //set default pposition
    var myLatLng = { lat: 40.7459772, lng: -74.0545504 };
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: myLatLng,
        styles: [{ "featureType": "administrative.locality", "elementType": "all", "stylers": [{ "hue": "#2c2e33" }, { "saturation": 7 }, { "lightness": 19 }, { "visibility": "on" }] }, { "featureType": "landscape", "elementType": "all", "stylers": [{ "hue": "#ffffff" }, { "saturation": -100 }, { "lightness": 100 }, { "visibility": "simplified" }] }, { "featureType": "poi", "elementType": "all", "stylers": [{ "hue": "#ffffff" }, { "saturation": -100 }, { "lightness": 100 }, { "visibility": "off" }] }, { "featureType": "road", "elementType": "geometry", "stylers": [{ "hue": "#bbc0c4" }, { "saturation": -93 }, { "lightness": 31 }, { "visibility": "simplified" }] }, { "featureType": "road", "elementType": "labels", "stylers": [{ "hue": "#bbc0c4" }, { "saturation": -93 }, { "lightness": 31 }, { "visibility": "on" }] }, { "featureType": "road.arterial", "elementType": "labels", "stylers": [{ "hue": "#bbc0c4" }, { "saturation": -93 }, { "lightness": -2 }, { "visibility": "simplified" }] }, { "featureType": "road.local", "elementType": "geometry", "stylers": [{ "hue": "#e9ebed" }, { "saturation": -90 }, { "lightness": -8 }, { "visibility": "simplified" }] }, { "featureType": "transit", "elementType": "all", "stylers": [{ "hue": "#e9ebed" }, { "saturation": 10 }, { "lightness": 69 }, { "visibility": "on" }] }, { "featureType": "water", "elementType": "all", "stylers": [{ "hue": "#e9ebed" }, { "saturation": -78 }, { "lightness": 67 }, { "visibility": "simplified" }] }]
    });
    //set marker
    var image = 'assets/images/map-icon.png';
    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: "Hello World!",
        icon: image
    });
    marker.addListener('click', function () {
        infowindow.open(map, marker);
    });
}
