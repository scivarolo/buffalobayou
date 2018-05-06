/* main.js
 *
 * Started: 12 Jun 2013
 *
 * Initializes the map and loads layers from the BBP GME account
 * Code based on examples at https://developers.google.com/maps/documentation/javascript/
 * User location marker based on code created by Steve Stedman: http://jsfiddle.net/ryanoc/86Ejf/
 */

var webMap = function () {
    // TODO Move into the config file
    var maxZoomLevel = 4,
        initalZoomLevel = 15,
        defaultMapCenter = new google.maps.LatLng(29.761732,-95.388371);
    var mapStyles = [
      {
        "featureType": "poi",
        "elementType": "geometry",
        "stylers": [
          { "color": "#9ebf3a" }
        ]
      },{
        "featureType": "water",
        "elementType": "geometry.fill",
        "stylers": [
          { "color": "#22b4c3" }
        ]
      },/*
{
        "featureType": "road",
        "elementType": "labels.text.stroke",
        "stylers": [
            { "visibility": "off" }
        ]
      },{
        "featureType": "road.local",
        "elementType": "geometry",
        "stylers": [
          { "color": "#ffffff" }
        ]
      },
*/{
        "featureType": "road.arterial",
        "elementType": "geometry",
        "stylers": [
           { "color": "#ffffff" }
        ]
      },{
        "featureType": "road.highway",
        "elementType": "geometry",
        "stylers": [
          { "color": "#ffffff" }
        ]
      },{
        "featureType": "road.local",
        "elementType": "labels",
        "stylers": [
          { "visibility": "off" }
        ]
      },{
        "featureType": "poi",
        "elementType": "labels",
        "stylers": [
          { "visibility": "off" }
        ]
      },{
        "featureType": "transit",
        "stylers": [
          { "visibility": "off" }
        ]
      },{
        "featureType": "landscape",
        "stylers": [
          { "color": "#d8e2da" }
        ]
      },{
        "featureType": "poi.business",
        "stylers": [
          { "color": "#e2ece4" }
        ]
      },{
        "featureType": "poi.government",
        "stylers": [
          { "invert_lightness": true },
          { "color": "#e2ece4" }
        ]
      },{
        "featureType": "poi.school",
        "stylers": [
          { "color": "#e2ece4" }
        ]
      },{
        "featureType": "poi.sports_complex",
        "stylers": [
          { "color": "#e2ece4" }
        ]
      },{
        "featureType": "administrative",
        "elementType": "labels.text.stroke",
        "stylers": [
          { "visibility": "off" }
        ]
      }
    ];
    var mapOptions = {
        // Zoom, center, and mapTypeId are required
        center: defaultMapCenter,
        mapTypeControl: true, // True by default
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.DEFAULT,
            mapTypeIds: [google.maps.MapTypeId.SATELLITE, google.maps.MapTypeId.ROADMAP]
        },
        mapTypeId: google.maps.MapTypeId.ROADMAP, // Could put stylized as initial map type
        panControl: true, // False by default on mobile
        scaleControl: true, // False by default, will want true
        streetViewControl: false,
        styles: mapStyles,
        scrollwheel: false,
        zoom: initalZoomLevel,
        zoomControl: true
    };

    var map = null,
        featureInfoBubble = null,
        userLocationMarker = null,
        userLocation = null,
        // cache the userAgent
        useragent = navigator.userAgent,
        IS_IPAD = (useragent.match(/iPad/i) != null),
        IS_IPHONE = ((useragent.match(/iPhone/i) != null) || (useragent.match(/iPod/i) != null)),
        mapsEngineLayers = [],
        browserSupportFlag = new Boolean();


    //-----------------Event Handling-----------------------------------------//

/*
    var findUserLocation = function (customControl) {
        google.maps.event.addDomListener(customControl, 'click', function () {
            //Move the map to the user's current position if geolocation is on
            if (userLocation) {
                webMap.getMap().panTo(userLocation);
            }
            else {
                // alert to tell user they are outside the bounds of the map (if we implement this)
                // would be accomplished by passing a url to C#
            }
        });
    }
*/

    /** Stops the user from zooming out farther than the zoom level passed in by resetting the zoom to the max zoom **/
    var limitZoomTo = function (maxZoom) {
        google.maps.event.addListener(map, 'zoom_changed', function () {
            var currentZoomLevel = map.getZoom();
            if (currentZoomLevel < maxZoom) {
                map.setZoom(maxZoom);
            }
        });
    }

    /** Adds listener to close any open info bubbles when the user clicks anywhere outside of the map **/
    var closeBubblesOnMapClick = function () {
        google.maps.event.addListener(map, 'click', function () {
            if (featureInfoBubble) {
                featureInfoBubble.close();
            }
        });
    }

    /** Creates and returns a custom info using the infobubble.js class **/
    var createBubble = function (content, position) {
    var bubble = new InfoBubble({
    		// TODO Move these options to a config file
    		map: map,
    		content: content,
    		position: position,
    		shadowStyle: 1,
    		padding: '7px',
    		backgroundColor: '#004B64',
    		borderRadius: 5,
    		arrowSize: 10,
    		borderWidth: 0,
    		borderColor: '#004B64',
    		disableAutoPan: true,
    		hideCloseButton: true,
    		arrowPosition: 50,
    		backgroundClassName: 'infobubble',
    		arrowStyle: 0,
    		disableAnimation: false,
    		minWidth: 250,
    		maxHeight: 65,
    		minHeight: 65
    	});
    	return bubble;
    }

    var prepareNewInfoBubble = function(data, latLng){
		  if (featureInfoBubble){
			  featureInfoBubble.close();
		  }
      featureInfoBubble = createBubble('<div></div>', latLng);
      featureInfoBubble.setPosition(latLng);
      var content = getInfoBubbleContent(data, data.getProperty('UniqueID'));
      featureInfoBubble.setContent(content);
      return featureInfoBubble;
    };

    var getInfoBubbleContent = function (feature, featureId) {

        var styledContent = "";
        var mainDiv = "<div class='heading-container'>";
        var url = feature.getProperty('Url for Web');
        var thumbnailUrl = feature.getProperty('Thumbnail').replace('http://', 'https://');
        console.log(thumbnailUrl);
        // Put thumbnail image into content, using the placeholder thumbnail if the feature doesn't have its own thumbnail URL



        styledContent += '<div>';

        if(feature.getProperty('Thumbnail')) {

          styledContent += '<img class="infobubble-thumbnail" src="' + thumbnailUrl + '" alt="" onerror="webMap.replaceThumbnail(this);" width="50px">';
        }

        styledContent += '<h3 class="infobubble-feature-name">' + feature.getProperty('Name') + '</h3>';

        if(feature.getProperty('Url for Web') && feature.getProperty('Has Url for Web') == 1) {
          styledContent += '<a class="infobubble-arrow" title="to ' + feature.getProperty('Name') + '" href="' + url + '"><i class="icon-arrow-right"></i></a>';
        }

        styledContent += "</div></div>";

        return styledContent;
      }


	var doStyling = function(feature, hiddenLayers)
    {
        var icon = '';
        var scaledSize = { width: 25, height: 25 };
        var zoomLevel = map.getZoom();
        var strokeWeight = 2;
    		var strokeColor = '#f16021';

		if (zoomLevel >= 15){
			icon = feature.getProperty('Feature Icon').replace('http://', 'https://');
      if (zoomLevel >=17 ) {
      	if (zoomLevel >= 18 ) {
      		if (zoomLevel >= 22 ) {
						strokeWeight = 10;
					}
				else strokeWeight = 8;
				}
				else strokeWeight = 5;
			}
    }
		else if (feature.getProperty('Small Icon')) {
      icon = feature.getProperty('Small Icon').replace('http://', 'https://');
      scaledSize.width = 22;
      scaledSize.height = 22;
    }

    if (hiddenLayers){
    	if (hiddenLayers.indexOf(feature.getProperty('Group')) > -1){
    		return {visible: false};
    	}
    }

		return /** @type {google.maps.Data.StyleOptions} */({
      icon: {
        url: icon,
        scaledSize: new google.maps.Size(scaledSize.width, scaledSize.height),
        size: new google.maps.Size(scaledSize.width, scaledSize.height),
        anchor: new google.maps.Point(scaledSize.width/2, 3)
      },
      clickable: true,
		  strokeWeight: strokeWeight,
		  strokeColor: strokeColor,
      fillOpacity: 1,
      visible: true
    });
  };

    //-------------------------Initializing the Map--------------------------//
    return {
    	hiddenLayers: [],
        initialize: function () {
            // Check if the map is being viewed from an iPhone or iPad and remove the +/- control if so
            if (IS_IPHONE || IS_IPAD) {
                mapOptions.zoomControl = false;
            }
            // Creates a new map using the map options defined above in the div with the id "map-canvas"
            map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

            // Creates an info bubble singleton
            featureInfoBubble = createBubble('', defaultMapCenter);

            // Stops the user from zooming out farther than a zoom level of 10
            limitZoomTo(maxZoomLevel);
            // Adds listener to close any open info bubbles when the user clicks anywhere outside of the map
            closeBubblesOnMapClick();

            // Adds geolocation functionality, including a custom control to center the user on their position
            //implementGeolocation();

            map.data.loadGeoJson('https://script.google.com/macros/s/AKfycbzG3KL_qmQQfYeDpC-DOb8OMKfbZYWNZ0INiK3UmBg0TXk8J5Vb/exec?key=9DFDEB02-C10B-11E4-9F48-041CF186852F&type=geo');
            map.data.setStyle(doStyling);

            google.maps.event.addListener(map, 'zoom_changed', function()
            {
                map.data.setStyle(function(feature){
                	return doStyling(feature, webMap.hiddenLayers);
                });
            });


            // When the user clicks, set 'isColorful', changing the color of the letters.
            map.data.addListener('click', function(event) {
            	var data = event.feature;
            	console.log(data);
            	console.log(event.feature);
            	var bubble = prepareNewInfoBubble(event.feature, event.latLng);
            	bubble.open();
            });
        },
        /** Centers the map on the coordinates passed in
          * Zooms in on the point
          * Opens the point's info bubble using data from C#
          * Called by C# from a detail page
          **/
        centerMapOnPointAndOpenBubble: function (latitude, longitude, rawContent) {
            var newMapCenter = new google.maps.LatLng(latitude, longitude);
            webMap.getMap().panTo(newMapCenter);
            webMap.getMap().setZoom(16);
            var bubble = prepareNewInfoBubble(JSON.parse(rawContent), newMapCenter);
            bubble.open();

        },
/*
		turnOnLayer: function (layerKey){
			webMap.hiddenLayers.splice(webMap.hiddenLayers.indexOf(layerKey), 1);
	    	map.data.setStyle(function(feature){
	    		return doStyling(feature, webMap.hiddenLayers);
	    	});
		},
		turnOffLayer: function (layerKey){
			if (featureInfoBubble) {
	        	featureInfoBubble.close();
	        }
			webMap.hiddenLayers.push(layerKey);
	    	map.data.setStyle(function(feature){
	    		return doStyling(feature, webMap.hiddenLayers);
	    	});
		}
,*/
        /** If thumbnail image is broken, replace with the placeholder **/
        replaceThumbnail: function (image) {
            image.src = 'img/infobubble-thumbnail-placeholder.png';
        },
        /** Returns a string that identifies a Google Maps Engine layer completely uniquely
          * by using a map id, which is completely unique and the layer's key within that map
          **/
        getLayerUniqueIdentifier: function (mapId, layerKey) {
            return mapId + layerKey;
        },
        getMapsEngineLayers: function () {
            return mapsEngineLayers;
        },
        getMap: function () {
            return map;
        },
        closeInfoBubble: function () {
            if (featureInfoBubble) {
                featureInfoBubble.close();
            }
        }
    };
}();

google.maps.event.addDomListener(window, 'load', webMap.initialize);
