import "leaflet/dist/leaflet.css";
import L from "leaflet";

import "leaflet.markercluster/dist/leaflet.markercluster-src";
import "leaflet.markercluster/dist/MarkerCluster.css";
import "leaflet.markercluster/dist/MarkerCluster.Default.css";
import "leaflet.markercluster/dist/leaflet.markercluster";

import "leaflet-easybutton/src/easy-button.css";
import "leaflet-easybutton/src/easy-button.js";

import "leaflet-sidebar/src/L.Control.Sidebar.css";
import "leaflet-sidebar/src/L.Control.Sidebar.js";

import "leaflet-extra-markers/dist/css/leaflet.extra-markers.min.css";
import "leaflet-extra-markers/dist/js/leaflet.extra-markers.js";

import "leaflet-search/dist/leaflet-search.src";
import "leaflet-search/dist/leaflet-search.src.css";

import "../css/leaflet.css";

//crea una instancia de tu mapa de leaflet
const map = L.map("mapid", {
    center: [-17.9659, -67.1097],
    zoom: 7,
});

L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution:
        'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
    maxZoom: 18,
}).addTo(map);

//adicionamos el sidebar al mapa
var sidebar = L.control.sidebar("sidebar", {
    position: "left",
});
map.addControl(sidebar);

//creamos el marker icon - idea
var ideaMarker = L.ExtraMarkers.icon({
    icon: "fa-lightbulb",
    markerColor: "yellow",
    shape: "circle",
    prefix: "fa-solid",
});

//creamos el marker icon - proyecto
var proyectoMarker = L.ExtraMarkers.icon({
    icon: "fa-trophy",
    markerColor: "blue",
    shape: "circle",
    prefix: "fa-solid",
});

//adicionamos un boton al mapa
/*L.easyButton("fa-bars", function () {
    sidebar.toggle();
}).addTo(map);*/

//L.marker([51.5, -0.09]).addTo(map).bindPopup("Aqui está Londres!").openPopup();
//var marker = L.marker([51.5, -0.09]).bindPopup("hola mundo").addTo(map);

map.on("click", function () {
    sidebar.hide();
});

//creacion del grupo de marcadores para ideas innovadoras
var markers_ideas_innovadoras = L.markerClusterGroup({
    spiderfyOnMaxZoom: true,
    showCoverageOnHover: false,
    zoomToBoundsOnClick: true,
    spiderLegPolylineOptions: { weight: 0.5, color: "#FDC830", opacity: 0.5 },
});
map.addLayer(markers_ideas_innovadoras);

//creacion del grupo de marcadores para buenas practicas
var markers_buenas_practicas = L.markerClusterGroup({
    spiderfyOnMaxZoom: true,
    showCoverageOnHover: false,
    zoomToBoundsOnClick: true,
    spiderLegPolylineOptions: { weight: 0.5, color: "#00c6ff", opacity: 0.5 },
});
map.addLayer(markers_buenas_practicas);

function getImg(id) {
    let url = "#";
    documentos.forEach((element) => {
        if (element.proyecto_id == id && element.tipo == "imagenes") {
            url = "documento/" + element.id;
        }
    });
    return url;
}

datos.forEach((element) => {
    if (element.type == "idea inovadora") {
        let marker = L.marker([element.lat, element.lng], {
            id: element.proyecto.id,
            icon: ideaMarker,
            type: element.type,
            img: getImg(element.proyecto.id),
            content: element.proyecto.descripcion,
            name: element.proyecto.titulo,
        }).bindPopup(element.proyecto.titulo);
        markers_ideas_innovadoras.addLayer(marker);
    }
    if (element.type == "buena practica") {
        let marker = L.marker([element.lat, element.lng], {
            id: element.proyecto.id,
            icon: proyectoMarker,
            type: element.type,
            img: getImg(element.proyecto.id),
            content: element.proyecto.descripcion,
            name: element.proyecto.titulo,
        }).bindPopup(element.proyecto.titulo);
        markers_buenas_practicas.addLayer(marker);
    }
});

//añadimos una funciona a cada marcador
markers_buenas_practicas.on("click", function (a) {
    var url = new URL(window.location.href);
    url.searchParams.set("id", window.btoa(a.layer.options.id));
    window.history.replaceState(null, null, url);
    sidebar.setContent(
        `<div class="isotope-item buenas-practicas sidebar-map">
            <article class="post vertical-item content-padding with_background rounded overflow_hidden loop-color sidebar-map-item">
                <header class="entry-header">
                    <h1>${a.layer.options.name}</h1>
                    <p class="icon-type"><i class="fa-solid fa-trophy"></i>
                    ${a.layer.options.type}</p>
                </header>
                <div class="item-media entry-thumbnail img-type">
                    <img src="${a.layer.options.img}" alt=""> 
                </div>
                <div class="item-content content-type">                
                    <div class="entry-content">
                        <p>${a.layer.options.content}</p>
                    </div>
                    <div class="btn-content">
                        <button class="btn-compartir" id="btn-compartir">
                        compartir Idea
                        </button>
                    </div>                
                </div>                
            </article>
        </div>`
    );
    sidebar.show();
    let buenas_practicas = document.getElementById("sidebar");
    buenas_practicas.style.background = "#00c6ff";
});

//añadimos una funciona a cada marcador
markers_ideas_innovadoras.on("click", function (a) {
    var url = new URL(window.location.href);
    url.searchParams.set("id", window.btoa(a.layer.options.id));
    window.history.replaceState(null, null, url);
    sidebar.setContent(
        `<div class="isotope-item ideas-innovadoras sidebar-map">
            <article class="post vertical-item content-padding with_background rounded overflow_hidden loop-color sidebar-map-item">
                <header class="entry-header">
                    <h1>${a.layer.options.name}</h1>                    
                    <p class="icon-type"><i class="fa-solid fa-lightbulb icon-title"></i>${a.layer.options.type}</p>
                </header>
                <div class="item-media entry-thumbnail img-type">
                    <img src="${a.layer.options.img}" alt=""> 
                </div>
                <div class="item-content content-type">                    
                    <div class="entry-content">
                        <p>${a.layer.options.content}</p>
                    </div>
                    <div class="btn-content">
                        <button class="btn-compartir" id="btn-compartir">
                        compartir Idea
                        </button>
                    </div>    
                </button>
                </div>                
            </article>
        </div>`
    );
    sidebar.show();
    let ideas_innovadoras = document.getElementById("sidebar");
    ideas_innovadoras.style.background = "#FDC830";
});

markers_buenas_practicas.on("mouseover", function (e) {
    this.openPopup();
});

markers_ideas_innovadoras.on("mouseover", function (e) {
    this.openPopup();
});

markers_buenas_practicas.on("mouseover", function (e) {
    this.openTooltip();
});

markers_ideas_innovadoras.on("mouseover", function (e) {
    this.openTooltip();
});

var layerGroupTotal = L.layerGroup([
    markers_buenas_practicas,
    markers_ideas_innovadoras,
]);

var OverLayMaps = {
    "Ideas Innovadoras": markers_ideas_innovadoras,
    "Buenas Practicas": markers_buenas_practicas,
    Ambos: layerGroupTotal,
};
L.control.layers(OverLayMaps).addTo(map);

//creacion de un buscador
var searchControl = new L.Control.Search({
    layer: layerGroupTotal, // Capa en la que se realizará la búsqueda
    propertyName: "name",
    textPlaceholder: "Buscar ...",
    //initial: false,
    //autoCollapse: false,
    /*filterData: function(text, records) {
        var searchWords = text.trim().toLowerCase().split(' ');
        return records.filter(function(record) {
            var nameWords = record.name.trim().toLowerCase().split(' ');
            return searchWords.every(function(searchWord) {
                return nameWords.some(function(nameWord) {
                    return nameWord.indexOf(searchWord) !== -1;
                });
            });
        });
    }*/
    //En este ejemplo, hemos modificado la función filterData para buscar cada palabra de la cadena de búsqueda en cada campo del registro. Para hacer esto, utilizamos un bucle for..in para iterar a través de las propiedades del objeto record, y luego verificamos si el valor de cada propiedad es una cadena y si contiene la palabra de búsqueda. Si se encuentra la palabra en el valor, establecemos la variable found en true y salimos del bucle. Si se encuentra al menos una palabra en el registro, devolvemos true, de lo contrario, devolvemos false.
});
map.addControl(searchControl);

//searchControl._container.classList.add('centrado-ampliado');

//una vez encontrado el buscador realizamos un zoom en el marcador
searchControl.on("search:locationfound", function (e) {
    map.setView(e.latlng, 5); // Zoom a la posición del marcador encontrado con un nivel de zoom de 16
});

/*map.on('click', function(e) {
    searchControl.reset();
});*/

//posicion de los botones de zoom del mapa
map.zoomControl.setPosition("bottomright");

function cargarMapa() {
    // Obtener el ID de la URL y llamar a la función de búsqueda
    var urlParams = new URLSearchParams(window.location.search);
    var id = urlParams.get("id");
    if (id) {
        localizarMarkerPorId(id);
    }
}

/*======================= buscar un marker por su ID ================= */
function localizarMarkerPorId(id) {
    // Buscar el marker correspondiente al ID

    /*var markers = markers_buenas_practicas.getLayers();

    for (var i = 0; i < markers.length; i++) {
        var marker = markers[i];
        console.log(marker.id); // Imprimir la posición del marker
        // Hacer algo más con el marker...
    }
    /*var marker = null;
    markers_buenas_practicas.forEach(element => {
        if (window.btoa(markers_buenas_practicas[i].options.id) === id) {
            marker = markers_buenas_practicas[i];
            console.log(window.btoa(markers_buenas_practicas[i].options.id));
        }
    }); 
    
    markers_ideas_innovadoras.forEach(element => {
        if (window.btoa(markers_buenas_practicas[i].options.id) === id) {
            marker = markers_buenas_practicas[i];
            console.log(window.btoa(markers_buenas_practicas[i].options.id));
        }
    }); 
    */
    let marker = null;
    markers_buenas_practicas.eachLayer(function (layer) {
        console.log(layer.options.id);
        if (layer.options.id == window.atob(id)) {
            marker = layer;
        }
    });

    markers_ideas_innovadoras.eachLayer(function (layer) {
        console.log(layer.options.id);
        if (layer.options.id == window.atob(id)) {
            marker = layer;
        }
    });

    // Si se encontró el marker, centrar el mapa en él
    if (marker) {
        map.setView(marker.getLatLng(), 15);
    } else {
        console.log("marker NO encontrado");
    }

    console.log("id optenido" + window.atob(id));
}
cargarMapa();

/*=================== FUNCION DE COMPARTIR LA URL ============= */

// Obtener la referencia al botón
var shareBtn = document.getElementById('btn-compartir');

// Agregar un controlador de eventos de clic al botón
shareBtn.addEventListener('click', function() {
  // Obtener la URL actual de la página
  var url = window.location.href;
  
  // Crear la URL de compartición con la URL actual y el nivel de zoom actual del mapa
  var shareUrl = url + "?zoom=" + map.getZoom() + "&lat=" + map.getCenter().lat + "&lng=" + map.getCenter().lng;
  
  // Mostrar la URL en un cuadro de diálogo
  alert("Compartir esta URL: " + shareUrl);
});
