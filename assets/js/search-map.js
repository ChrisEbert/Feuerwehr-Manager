var SearchMapWidget = function() {

	var _this = this;

	this.latlngField = document.getElementById('ctrl_latlng');

	this.searchInput = document.getElementById('pac-input');

	this.latlng = (this.latlngField.value !== '' ? this.latlngField.value : window.mapCenter).split(',');

	this.map = SearchMapWidget.prototype.buildMap('map', this.latlng);

	this.marker = SearchMapWidget.prototype.buildMarker(this.map, this.latlng);

	this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(this.searchInput);

	this.searchBox = new google.maps.places.SearchBox(this.searchInput);

	this.setLatlng = function(value) {
		var latlng = value.toString().replace('(', '').replace(')', '');

		_this.latlngField.value = latlng;
		_this.latlng = latlng.split(',')
	}

	google.maps.event.addListener(this.marker, 'dragend', function(data) {
		_this.setLatlng(data.latLng);
		_this.map.panTo(data.latLng);
	});

	google.maps.event.addListener(this.searchBox, 'places_changed', function() {
		var places = _this.searchBox.getPlaces();

		if (places.length == 0) {
			return;
		}

		var location = places[0].geometry.location;

		SearchMapWidget.prototype.repositionMarker(_this.map, _this.marker, location);
		_this.setLatlng(location);
	});

	google.maps.event.addListener(this.map, 'click', function(data) {
		SearchMapWidget.prototype.repositionMarker(_this.map, _this.marker, data.latLng);
		_this.setLatlng(data.latLng);
	});
}

SearchMapWidget.prototype.buildMap = function(target, latlng) {
	return new google.maps.Map(document.getElementById(target), {
		zoom: 14,
		center: new google.maps.LatLng(latlng[0], latlng[1]),
		streetViewControl: false,
		disableDoubleClickZoom: true,
		draggableCursor: 'crosshair'
	});
}

SearchMapWidget.prototype.buildMarker = function(map, latlng) {
	return new google.maps.Marker({
		map: map,
		position: new google.maps.LatLng(latlng[0], latlng[1]),
		draggable: true
	});
}

SearchMapWidget.prototype.repositionMarker = function(map, marker, latlng) {
	marker.setPosition(latlng);
	map.panTo(latlng);
}

var initSearchMapWidget = function() {
	new SearchMapWidget();
}
