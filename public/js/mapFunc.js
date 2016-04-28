var truckID=[];
var truckModel=[];
var plowRoute = [];
var truckRoute = [];
var color = ["#FF6600", "#FF3300", "#FF0000", "#CC3300", "#CC0033", "#FF3366",
  "#FF0033", "#FF0066", "#CC0099", "#9900CC", "#6600FF", "#3300FF",
  "#0033CC", "#3366FF", "#0099FF", "#33CCFF", "#00CC99", "#00FF66",
  "#FFCC33", "#FF9900", "#FFCC00", "#CC9900", "#99CC00", "#CCFF00"
];

/**
 * initializes the map with the routes and time range dependent on the parameter values
 * @method initMap
 * @param  {[string]} layer [the layer the user selected to view]
 * @param  {[int]} range [the time range query the user selected]
 * @author nicky jamesr
 */
function initMap(layer, range) {
  var mapDiv = document.getElementById('map');
  map = new google.maps.Map(mapDiv, {
    center: {
      lat: 49.8801,
      lng: -119.4436
    },
    zoom: 12
  });
  //adds full screen functionality
  map.controls[google.maps.ControlPosition.TOP_RIGHT].push(FullScreenControl(map));
  //query database and process it
  if (layer == 'traffic' || layer == 'bike' || layer =='snow') {
    $.ajax({
      type: "POST",
      url: "../application/model/dataUpdate.php",
      data: {
        action: 'call_this',
        value: range
      },
      success: function(data) {
        // console.log(data);
        processData(data);
      }
    });
  } else {
    $.ajax({
      type: "POST",
      url: "../application/model/csvUpdate.php",
      data: {
        action: 'call_that',
        value: range
      },
      success: function(data) {
        // console.log(data);
        processData(data);
      }
    });
  }

  if (layer == 'traffic') {
    var trafficLayer = new google.maps.TrafficLayer();
    trafficLayer.setMap(map);
  }

  if (layer == 'bike') {
    var bikeLayer = new google.maps.BicyclingLayer();
    bikeLayer.setMap(map);
  }
}

/**
 * initMap2 - this is the original blank map that loads centered on Kelowna
 * @author James Rogers
 */
function initMap2() {
  var mapDiv = document.getElementById('map');
  map = new google.maps.Map(mapDiv, {
    center: {
      lat: 49.8801,
      lng: -119.4436
    },
    zoom: 12
  });
  //adds full screen functionality
  map.controls[google.maps.ControlPosition.TOP_RIGHT].push(FullScreenControl(map));
}

/**
 * processes the lat/lng coords returned from the ajax call in initMap()
 * @method processData
 * @param  {[type]}    data [the lat/lng coords from the database]
 * @author nicky
 */
function processData(data) {
  //get the latitude and longitude
  var allDataLines = data.split(/\r\n|\n/);
  var temp = parseRow(allDataLines[0]);
  var id = temp[0];
  truckModel.push(temp[4]);
  truckID.push(id);
  for (var i = 0; i < allDataLines.length; i++) {
    var line = parseRow(allDataLines[i]);
    if (id !== line[0]) {
      id = line[0];
      truckID.push(id);
      truckModel.push(line[4]);
      plowRoute.push(truckRoute);
      truckRoute = [];
    }
    truckRoute.push(line[1] + ',' + line[2]);
  }
  //get snap-to-road points according to the points provided and plot
  for (var ii = 0; ii < plowRoute.length; ii++) {
    var start = 0,
      end = 100;
    var segment = [];
    var snappedCoordinates = [];
    var contentString='Plow ID: '+truckID[ii]+'<br>Plow model: '+truckModel[ii];
    var infoWindow=new google.maps.InfoWindow({
      content:contentString
    });
    while (start < plowRoute[ii].length-1) {
      if (end > plowRoute[ii].length) {
        end = plowRoute[ii].length;
      }
      segment = plowRoute[ii].slice(start, end);
      start = end-1;
      end = start + 100;
      var response = snapToRoad(segment);
      processSnapToRoadResponse(response,snappedCoordinates);
    }
    drawSnappedPolyline(snappedCoordinates,color[ii],infoWindow);
  }
}
//The actual snap-to-road api
function snapToRoad(segment) {
  var result;
  $.ajax({
    url: "https://roads.googleapis.com/v1/snapToRoads",
    type: "get",
    data: {
      interpolate: true,
      key: 'AIzaSyB9iQXncNMthIbjKA6RMqRlLcNXyI1z7r4',
      path: segment.join('|')
    },
    async: false,
    success: function(data) {
      result = data;
    }
  });
  return result;
}
//latitude and longitude values of the snapped points are fetched into an array
function processSnapToRoadResponse(data,snappedCoordinates) {
  for (var i = 0; i < data.snappedPoints.length; i++) {
    var latlng = new google.maps.LatLng(
      data.snappedPoints[i].location.latitude,
      data.snappedPoints[i].location.longitude);
    snappedCoordinates.push(latlng);
  }
}
//polylines are drawn using the snapped point coordinates
function drawSnappedPolyline(snappedCoordinates,color,info) {
  var plowPath = new google.maps.Polyline({
    path: snappedCoordinates,
    strokeColor: color,
    strokeOpacity: 1.0,
    strokeWeight: 4,
    icons: [{
      icon: lineSymbol,
      offset: '100%'
    }],
  });
  var midPoint=snappedCoordinates[parseInt(snappedCoordinates.length/2)];
  plowPath.setMap(map);
  plowPath.addListener('click',function(){
    info.setPosition(midPoint);
    info.open(map);
  })
  animateCircle(plowPath);
}
//parse and split data by comma, and take care of commas in quotes/
function parseRow(str) {
  var insideQuote = false,
    entries = [],
    entry = [];
  str.split('').forEach(function(character) {
    if (character === '"') {
      insideQuote = !insideQuote;
    } else {
      if (character == "," && !insideQuote) {
        entries.push(entry.join(''));
        entry = [];
      } else {
        entry.push(character);
      }
    }
  });
  entries.push(entry.join(''));
  return entries;
}

/**
 * Symbol that gets animated along the polyline
 * @type {Object}
 * @author jamesr
 */
var lineSymbol = {
  path: google.maps.SymbolPath.CIRCLE,
  scale: 2,
  strokeColor: '#005db5',
  strokeWidth: '#005db5',
  strokeWeight: 5
};

/**
 * Animate an icon along a polyline, adapted from an example provided by Google:
 * https://developers.google.com/maps/documentation/roads/inspector
 * @author jamesr / Google
 * @param {Object} polyline The line to animate the icon along
 */
function animateCircle(polyline) {
  var count = 0;
  // fallback icon if the poly has no icon to animate
  var defaultIcon = [{
    icon: lineSymbol,
    offset: '100%'
  }];
  window.setInterval(function() {
    count = (count + 1) % 200;
    var icons = polyline.get('icons') || defaultIcon;
    icons[0].offset = (count / 2) + '%';
    polyline.set('icons', icons);
  }, 90);
}
