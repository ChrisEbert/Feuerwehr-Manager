var target, marker, map;

function setLatlng(val) {
    target.value = val.toString().replace('(','').replace(')','');
}

function repositionMarker(latlng) {
    if (!marker) {
        marker = new google.maps.Marker({
            map: map,
            position: latlng,
            draggable: true
        });

        google.maps.event.addListener(marker, 'dragend', function(data) {

            setLatlng(data.latLng);

            map.panTo(data.latLng);
        });
    }
    else {
        marker.setPosition(latlng);
    }

    map.panTo(latlng);
}

function initialize() {
    target = document.getElementById('ctrl_latlng');

    var def = target.value !== '' ? target.value : '51.116944,13.1078047';
    def = def.split(',');

    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 14,
        center: new google.maps.LatLng(def[0], def[1]),
        streetViewControl: false,
        disableDoubleClickZoom: true,
        draggableCursor: 'crosshair'
    });

    repositionMarker(new google.maps.LatLng(def[0], def[1]));

    var input = document.getElementById('pac-input');

    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    var searchBox = new google.maps.places.SearchBox((input));

    google.maps.event.addListener(searchBox, 'places_changed', function() {
        var places = searchBox.getPlaces();

        if (places.length == 0) {
            return;
        }

        repositionMarker(places[0].geometry.location);

        setLatlng(places[0].geometry.location);
    });

    google.maps.event.addListener(map, 'click', function(data) {

        repositionMarker(data.latLng);

        setLatlng(data.latLng);
    });
}

google.maps.event.addDomListener(window, 'load', initialize);