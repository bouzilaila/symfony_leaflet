/*function display_map(latitude,longitude)
{
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox.streets',
    accessToken: 'your.mapbox.access.token'
}).addTo(mymap);

L.marker([latitude,longitude]).addTo(mymap);
}*/

function display_maps(mymap)
{
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'map',
    accessToken: 'your.mapbox.access.token'
}).addTo(mymap);
}

function display_marker(mymap,latitude,longitude,nom,adresse)
{
    L.marker([latitude,longitude]).addTo(mymap)
    .bindPopup(nom + '<br/>'+'<br/>' + adresse)
    .openPopup();
}

function get_markers()
{
    fetch('http://51.75.31.43/dossierexotest2/web/app_dev.php/evenements/json?option=all&option2=jhgjghj')
    .then(function(response){
        return response.json();
    })
    .then(function(myJson) {
        console.log(JSON.stringify(myJson)); // myJson array ou sont stockes mes evenements
        //display_marker(mymap,latitude,longitude);

        // recuperation de tout mes evenements
        for( let e of myJson) {
            display_marker(mymap, e.latitude, e.longitude, e.nom, e.adresse);
        }
    });
    
}

/*function getPopup(){
    
    L.marker([latitude,longitude]).addTo(mymap)
    .bindPopup('evenements')
    .openPopup();
// }*/