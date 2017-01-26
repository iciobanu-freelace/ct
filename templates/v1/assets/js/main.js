//Contact Form
$(document).ready(function () {
    $('#submit').click(function () {

        $.post("assets/php/send.php", $(".contact-form").serialize(), function (response) {
            $('#success').html(response);
        });
        return false;

    });


    /* ========================================================================
     Component: Map
     ========================================================================== */
    google.maps.event.addDomListener(window, 'load', init);

    function init() {

        var myLatlng = new google.maps.LatLng(47.010796, 28.861985);
        var mapOptions = {
            zoom: 15,
            scrollwheel: false,
            navigationControl: false,
            mapTypeControl: false,
            scaleControl: false,
            draggable: true,
            center: myLatlng,
            styles: [{
                featureType: "landscape",
                stylers: [{saturation: -100}, {lightness: 65}, {visibility: "on"}]
            }, {
                featureType: "poi",
                stylers: [{saturation: -100}, {lightness: 51}, {visibility: "simplified"}]
            }, {
                featureType: "road.highway",
                stylers: [{saturation: -100}, {visibility: "simplified"}]
            }, {
                featureType: "road.arterial",
                stylers: [{saturation: -100}, {lightness: 30}, {visibility: "on"}]
            }, {
                featureType: "road.local",
                stylers: [{saturation: -100}, {lightness: 40}, {visibility: "on"}]
            }, {
                featureType: "transit",
                stylers: [{saturation: -100}, {visibility: "simplified"}]
            }, {
                featureType: "administrative.province",
                stylers: [{visibility: "off"}]/**/
            }, {
                featureType: "administrative.locality",
                stylers: [{visibility: "off"}]
            }, {featureType: "administrative.neighborhood", stylers: [{visibility: "on"}]/**/}, {
                featureType: "water",
                elementType: "labels",
                stylers: [{visibility: "on"}, {lightness: -25}, {saturation: -100}]
            }, {
                featureType: "water",
                elementType: "geometry",
                stylers: [{hue: "#ffff00"}, {lightness: -25}, {saturation: -97}]
            }],
        };
        var mapElement = document.getElementById('map-container');
        var map = new google.maps.Map(mapElement, mapOptions);

        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: 'KreFolio!'
        });
    }
})