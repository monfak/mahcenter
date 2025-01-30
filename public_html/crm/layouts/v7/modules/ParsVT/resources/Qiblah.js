/* ********************************************************************************
 * The content of this file is subject to the VTFarsi.ir Modules License("License");
 * You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is VTFarsi.ir
 * Portions created by VTFarsi.ir. are Copyright(C) VTFarsi Team
 * All Rights Reserved.
 * ****************************************************************************** */
var theplace = "";
var d = new Date();
var wd = d.getDay();
var printer;

var theloc = '\<img src=\"layouts/v7/modules/ParsVT/resources/map/images/kabah_panorama_cr.jpg\" \/\>\<h4\>Makkeh<\/h4>';
var thelat = 21.42249;
var thelong = 39.82618;
var kabah = new L.LatLng(thelat, thelong);
var place = new L.LatLng((-6 - 35 / 60 - 45 / 3600), (106 + 47 / 60 + 49 / 3600)); //bogor
var placename = "ParsVT Office";
var countryname = "Iran";
var jarakmekah = "1708 km";
var curCenter, mymap, mapnode, mapw, maph, myIcon, control;

$(document).ready(function () {

    if (geoip_latitude) {
        theloc = '\<b\>' + geoip_placename + '\<\/b\>';
        countryname = geoip_country_name;
        placename = geoip_placename;
        place = new L.LatLng(geoip_latitude / 1, geoip_longitude / 1);
    }

    mymap = L.map('map').setView([place.lat, place.lng], 13);

    myIcon = L.icon({
        iconUrl: 'layouts/v7/modules/ParsVT/resources/map/images/qibla-wind-direction.png',
        iconSize: [100, 100],
        iconAnchor: [50, 50],
        popupAnchor: [-3, -76]
    });

    control = L.control.geonames({
        //position: 'topcenter', // In addition to standard 4 corner Leaflet control layout, this will position and size from top center.
        position: 'topright',
        geonamesSearch: 'https://secure.geonames.org/searchJSON', // Override this if using a proxy to get connection to geonames.
        geonamesPostalCodesSearch: 'https://secure.geonames.org/postalCodeSearchJSON', // Override this if using a proxy to get connection to geonames.
        username: 'alhabib', // Geonames account username.  Must be provided.
        maxresults: 5, // Maximum number of results to display per search.
        zoomLevel: null, // Max zoom level to zoom to for location. If null, will use the map's max zoom level.
        className: 'leaflet-geonames-icon', // Class for icon.
        workingClass: 'leaflet-geonames-icon-working', // Class for search underway.
        featureClasses: ['A', 'P'], // Feature classes to search against.  See: http://www.geonames.org/export/codes.html.
        baseQuery: 'isNameRequired=true', // The core query sent to GeoNames, later combined with other parameters above.
        showMarker: false, // Show a marker at the location the selected location.
        showPopup: false, // Show a tooltip at the selected location.
        adminCodes: {}, // Filter results by the specified admin codes mentioned in `ADMIN_CODES`. Each code can be a string or a function returning a string. `country` can be a comma-separated list of countries.
        bbox: {}, // An object in form of {east:..., west:..., north:..., south:...}, specifying the bounding box to limit the results to.
        lang: 'fa', // Locale of results.
        alwaysOpen: true, // If true, search field is always visible.
        enablePostalCodes: false, // If true, use postalCodesRegex to test user provided string for a postal code.  If matches, then search against postal codes API instead.
        postalCodesRegex: POSTALCODE_REGEX_US, // Regex used for testing user provided string for a postal code.  If this test fails, the default geonames API is used instead.
        title: app.vtranslate('Find location'), // Search input title value.
        placeholder: app.vtranslate('Enter place name') // Search input placeholder text.
    });
    mymap.addControl(control);
    control.on('select', function (e) {
        //console.log(e.geoname);
        mymap.setView([e.geoname.lat, e.geoname.lng], 13);
        countryname = e.geoname.countryName;
        placename = e.geoname.name + ((e.geoname.adminName1) ? ', ' + e.geoname.adminName1 : '');
        $('#namatempat').html(placename);
        Geodesic.update();
    });

    mymap.on('move', function () {
        curCenter = mymap.getCenter();
        $('#namatempat').html('Latitude ' + curCenter.lat.toFixed(2) + ' Longitude ' + curCenter.lng.toFixed(2));
    });
    var mapnum = 7;
    /*
    if (wd % mapnum == 0) {
        L.tileLayer.provider('OpenStreetMap.Mapnik').addTo(mymap);
    } else if (wd % mapnum == 1) {
        L.tileLayer.provider('OpenStreetMap.HOT').addTo(mymap);
    } else if (wd % mapnum == 2) {
        L.tileLayer.provider('OpenStreetMap.DE').addTo(mymap);
    } else if (wd % mapnum == 3) {
        L.tileLayer.provider('OpenStreetMap.France').addTo(mymap);
    } else if (wd % mapnum == 4) {
        L.tileLayer.provider('OpenStreetMap.CH').addTo(mymap);
    } else if (wd % mapnum == 5) {
        L.tileLayer.provider('Stamen.Terrain').addTo(mymap);
    } else {
        L.tileLayer.provider('Hydda.Full').addTo(mymap);
    }
    */
    L.tileLayer.provider('OpenStreetMap.Mapnik').addTo(mymap);

    var A = L.marker(kabah, {
        draggable: false
    }).addTo(mymap);
    var B = L.marker(place, {
        icon: myIcon,
        draggable: true
    }).addTo(mymap);
    $('#namatempat').html(placename);
    var Geodesic = L.geodesic([
        [B.getLatLng(), A.getLatLng()]
    ], {
        weight: 5,
        opacity: 1.0,
        color: 'red',
        steps: 50
    }).addTo(mymap);

    var info2 = L.control({
        position: 'bottomright'
    });
    info2.onAdd = function (mymap) {
        this._div = L.DomUtil.create('div', 'info');
        this.update();
        return this._div;
    };

    function updateInfo(props) {
        curCenter = mymap.getCenter();
        //console.log(curCenter);
        $('#curLat').html(curCenter.lat.toFixed(7));
        $('#curLong').html(curCenter.lng.toFixed(7));
        var dist = (props ? (props.distance > 10000) ? (props.distance / 1000).toFixed(0) + ' km' : (props.distance).toFixed(0) + ' m' : 'invalid');
        var bear = (props ? (props.initialBearing < 0) ? (360 + props.initialBearing).toFixed(0) + '&deg; ' : (props.initialBearing).toFixed(0) + '&deg; ' : 'invalid');
        $('#jarakmekah').html(dist);
        $('#arahkiblat').html(bear);
    }

    info2.update = function () {
        this._div.innerHTML = '<a style="background: #fff" href="http://parsvt.com">ParsVT.com</a>';
    };
    info2.addTo(mymap);

    Geodesic.update = function () {
        B.setLatLng(mymap.getCenter());
        Geodesic.setLatLngs([
            [B.getLatLng(), A.getLatLng()]
        ]);
        //info.update(Geodesic._vincenty_inverse(B.getLatLng(), A.getLatLng()));
        updateInfo(Geodesic._vincenty_inverse(B.getLatLng(), A.getLatLng()));
    };

    Geodesic.update();

    mymap.on('move', Geodesic.update);

});