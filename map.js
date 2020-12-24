ymaps.ready(init);
function init() {
    var placeFrom = document.querySelector('.from').getAttribute('data-attr');
    var placeTo  = document.querySelector('.to').getAttribute('data-attr');
    console.log(placeFrom);
    console.log(placeFrom);
    var myGeocoder = ymaps.geocode(placeFrom);
    var myGeocoder2 = ymaps.geocode(placeTo);
    Promise.all([myGeocoder,myGeocoder2]).then(
        function(res) {
        var coordFrom = res[0].geoObjects.get(0).geometry.getCoordinates();
        var coordTo = res[1].geoObjects.get(0).geometry.getCoordinates();
        var num = ymaps.coordSystem.geo.getDistance(coordFrom, coordTo);
        num = num / 1000;
        num = Math.round(num);
        var z = 4;
        if (num > 1000) {
            z = 2;
        }
        var myMap = new ymaps.Map("map", {center: coordFrom, zoom: z});
        point1 = new ymaps.GeoObject({
            geometry: {
                type: "Point",
                coordinates: coordFrom
            },
            properties: {
                iconContent: placeFrom
            }
        }, {
                preset: 'islands#blackStretchyIcon',
                draggable: false
            });
        point2 = new ymaps.GeoObject({
            geometry: {
                type: "Point",
                coordinates: coordTo
            },
            properties: {
                iconContent: placeTo
            }
        }, {
                preset: 'islands#blackStretchyIcon',
                draggable: false
            });
        var polyline = new ymaps.Polyline([
            coordTo, coordFrom], {}, {
                ballonCloseButton: true,
                strokeColor: "#ff0000",
                strokeWidth: 4
        })
        myMap.geoObjects.add(point1).add(point2);
        myMap.geoObjects.add(polyline);
        document.getElementById("len").innerHTML = "Расстояние - " + num + " км.";
                    
    })
}
