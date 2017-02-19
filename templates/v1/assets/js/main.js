//Contact Form
$(document).ready(function ()
{
    $('#submit').click(function ()
    {

        $.post("assets/php/send.php", $(".contact-form").serialize(), function (response)
        {
            $('#success').html(response);
        });
        return false;

    });


    /* ========================================================================
     Component: Map
     ========================================================================== */
    google.maps.event.addDomListener(window, 'load', init);

    function init()
    {

        var latlng =[47.038860, 28.825564];
         var myLatlng = new google.maps.LatLng(latlng[0], latlng[1]);
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
            }]
        };
        var mapElement = document.getElementById('map-container');
        var map = new google.maps.Map(mapElement, mapOptions);


        var data = {
            logo: 'assets/img/logo/logo-vg.png',
            title: 'S.C. “Vectro Grup” S.R.L.',
            city: 'RM, 2004, or. Chisinău',
            street: 'str. Columna 170/3',
            phone: '(3732) 519880',
            mail: 'vectrogrup.md@mail.ru',
            goto: 'https://maps.google.com/maps?ll=' + latlng.join(',')
        }


        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            draggable: false,
            optimized: false,
            html: '<div class="map-window">' +
            '<a href="' + data.goto + '">' + data.title + '</a>' +
            '<div class="window">' +
            '<div class="pull-left">' +
            '<div class="img-map">' +
            '<img class="logo" src="' + data.logo + '">' +
            '</div>' +
            '</div>' +
            '<div class="pull-right">' +
            '<p class="icon-address">' + data.city + '</p>' +
            '<p class="icon-address">' + data.street + '</p>' +
            '<p class="icon-phone">' + data.phone + '</p>' +
            '<p class="icon-mail">' + data.mail + '</p>' +
            '</div>' +
            '</div>' +
            '</div>'
        });

        infowindow = new google.maps.InfoWindow();
        map.addListener('zoom_changed', function ()
        {
            infowindow.close();
        });
        google.maps.event.addListener(marker, "click", function ()
        {
            infowindow.open(map, marker);
        });
        infowindow.setContent(marker.html);
        infowindow.open(map, marker);
    }
})