    var customIcons = {
        building: {
            icon: 'https://student-portal.co.uk/assets/img/university-map/building_icon.png'
        },
        student_centre: {
            icon: 'https://student-portal.co.uk/assets/img/university-map/student_centre_icon.png'
        },
        lecture_theatre: {
            icon: 'https://student-portal.co.uk/assets/img/university-map/lecture_theatre_icon.png'
        },
        computer_lab: {
            icon: 'https://student-portal.co.uk/assets/img/university-map/computer_lab_icon.png'
        },
        library: {
            icon: 'https://student-portal.co.uk/assets/img/university-map/library_icon.png'
        },
        cycle_hire: {
            icon: 'https://student-portal.co.uk/assets/img/university-map/cycle_hire_icon.png'
        },
        cycle_parking: {
            icon: 'https://student-portal.co.uk/assets/img/university-map/cycle_parking_icon.png'
        },
        atm: {
            icon: 'https://student-portal.co.uk/assets/img/university-map/atm_icon.png'
        }
    };

    var markerGroups = {
        "building": [],
        "student_centre": [],
        "lecture_theatre": [],
        "computer_lab": [],
        "library": [],
        "cycle_hire": [],
        "cycle_parking": [],
        "atm": []
    };

    function showCurrentLocation(currentLocationDiv, map) {

        currentLocationDiv.style.marginTop = '5px';
        var currentLocationUI = document.createElement('div');
        currentLocationUI.style.backgroundColor = '#fff';
        currentLocationUI.style.border = '2px solid #fff';
        currentLocationUI.style.borderRadius = '3px';
        currentLocationUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        currentLocationUI.style.cursor = 'pointer';
        currentLocationUI.style.marginBottom = '22px';
        currentLocationUI.style.textAlign = 'center';
        currentLocationUI.title = 'Click to recenter the map';
        currentLocationDiv.appendChild(currentLocationUI);

        var currentLocationText = document.createElement('div');
        currentLocationText.style.color = 'rgb(25,25,25)';
        currentLocationText.style.fontFamily = 'Roboto,Arial,sans-serif';
        currentLocationText.style.fontSize = '16px';
        currentLocationText.style.lineHeight = '38px';
        currentLocationText.style.paddingLeft = '5px';
        currentLocationText.style.paddingRight = '5px';
        currentLocationText.innerHTML = 'Center Map';
        currentLocationUI.appendChild(currentLocationText);

        var marker = null;

        google.maps.event.addDomListener(currentLocationUI, 'click', function () {

            if(navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = new google.maps.LatLng(position.coords.latitude,
                        position.coords.longitude);

                    if (marker == null) {
                        marker = new google.maps.Marker({
                            map: map,
                            position: pos,
                            title: 'You are here.'
                        });

                        var infowindow = new google.maps.InfoWindow({
                            content: 'You are here.'
                        });

                        infowindow.open(map,marker);

                        google.maps.event.addListener(marker, 'click', function() {
                            infowindow.open(map,marker);
                        });

                        map.setCenter(pos);
                    } else {
                        marker.setPosition(pos);
                        map.setCenter(pos);
                    }

                }, function() {
                    handleNoGeolocation(true);
                });
            } else {
                handleNoGeolocation(false);
            }

        function handleNoGeolocation(errorFlag) {
            if (errorFlag) {
                var content = 'Error: The Geolocation service failed.';
            } else {
                var content = 'Error: Your browser doesn\'t support geolocation.';
            }

            var options = {
                map: map,
                position: new google.maps.LatLng(51.527287, -0.103842),
                content: content
            };

            if (marker == null) {
                marker = new google.maps.Marker({
                    map: map,
                    position: options.position,
                    title: content
                });

                var infowindow = new google.maps.InfoWindow({
                    content: content
                });

                infowindow.open(map,marker);

                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map,marker);
                });

                map.setCenter(options.position);
            } else {
                marker.setPosition(options.position);
                map.setCenter(options.position);
            }
        }

        });
    }

    function loadMap() {
    var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(51.527287, -0.103842),
        zoom: 15,
        mapTypeId: 'roadmap'
    });

        // Create a DIV to hold the control and call HomeControl()
    var currentLocationDiv = document.createElement('div');
    var currentLocation = new showCurrentLocation(currentLocationDiv, map);
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(currentLocationDiv);

    downloadUrl("../../includes/university-map/source/overview_source.php", function(data) {
    var xml = data.responseXML;
    var markers = xml.documentElement.getElementsByTagName("marker");
    for (var i = 0; i < markers.length; i++) {
        var name = markers[i].getAttribute("name");
        var notes = markers[i].getAttribute("notes");
        var category = markers[i].getAttribute("category");
        var point = new google.maps.LatLng(
            parseFloat(markers[i].getAttribute("lat")),
            parseFloat(markers[i].getAttribute("lng")));
        var marker = createMarker(point, name, notes, category, map);
    }
    });
    }

    var infoWindow = new google.maps.InfoWindow({
        maxWidth: 400
    });

    function createMarker(point, name, notes, category, map) {
        var icon = customIcons[category] || {};
        var marker = new google.maps.Marker({
            map: map,
            position: point,
            icon: icon.icon,
            type: category
        });
        if (!markerGroups[category]) markerGroups[category] = [];
        markerGroups[category].push(marker);
        var html = "<b>" + name + "</b> <br/>" + notes;
        bindInfoWindow(marker, map, infoWindow, html);
        return marker;
    }

    function toggleGroup(category) {
        for (var i = 0; i < markerGroups[category].length; i++) {
            var marker = markerGroups[category][i];
            if (!marker.getVisible()) {
                marker.setVisible(true);
            } else {
                marker.setVisible(false);
            }
        }
    }

    function bindInfoWindow(marker, map, infoWindow, html) {
        google.maps.event.addListener(marker, 'click', function() {
            infoWindow.setContent(html);
            infoWindow.open(map, marker);

        });
    }

    function downloadUrl(url, callback) {
        var request = window.ActiveXObject ? new ActiveXObject('Microsoft.XMLHTTP') : new XMLHttpRequest();

        request.onreadystatechange = function() {
            if (request.readyState == 4) {
                request.onreadystatechange = doNothing;
                callback(request, request.status);
            }
        };

        request.open('GET', url, true);
        request.send(null);
    }

    function doNothing() {}
