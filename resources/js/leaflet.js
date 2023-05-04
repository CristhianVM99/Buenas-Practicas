import "leaflet/dist/leaflet.css";
import L, { DomUtil, marker } from "leaflet";

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
import axios from "axios";

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

/*=============== funcion que retorna la url de una imagen ============ */
function getImg(id) {
    let url = "#";
    documentos.forEach((element) => {
        if (element.proyecto_id == id && element.tipo == "imagenes") {
            url = "documento/" + element.id;
        }
    });
    return url;
}

/*================ funcion para retornar la bandera de un pais =============== */
function getPais(pais){
    let datos = [];
    paises.forEach((element) => {
        if(element.code==pais){
            datos.push({
                url: element.flag_4x3,
                nombre: element.name,
            });
        }
    })
    return datos;
}

/*=============== funcion para retornar los ODS de un proyecto =============== */

function getODS(cadena){
    let cate = [];
    categorias.forEach((cat) => {
        cadena.forEach((cad_cat) => {
            if(cat.id == cad_cat){
                cate.push({
                    nombre: cat.name,
                    icono_url:  "img/SDG/"+cat.icon
                })   
            }
        })
    }) 
    return cate;
}

/*============= funcion para retornar el sector ====================  */
function getSector(id){
    let sector = "";
    sectores.forEach((element) => {
        if(element.id == id){
            sector = element.name
        }
    })
    return sector
}


datos.forEach((element) => {    
    if (element.type == "idea inovadora") {
        let p = getPais(element.proyecto.pais) 
        let marker = L.marker([element.lat, element.lng], {
            id: element.proyecto.id,
            icon: ideaMarker,
            type: element.type,
            img: getImg(element.proyecto.id),
            pais: p[0].url,
            pais_name: p[0].nombre,
            ods: getODS(JSON.parse(element.proyecto.ods)),
            sector : getSector(element.proyecto.sector),
            content: element.proyecto.descripcion,
            name: element.proyecto.titulo,
            ciudad: element.ciudad,
            popularidad: element.proyecto.popularidad,
            entidad: element.proyecto.entidad,
            poblacion: element.proyecto.poblacion,
        }).bindPopup(element.proyecto.titulo);
        markers_ideas_innovadoras.addLayer(marker);
    }
    if (element.type == "buena practica") {
        let p = getPais(element.proyecto.pais) 
        let marker = L.marker([element.lat, element.lng], {
            id: element.proyecto.id,
            icon: proyectoMarker,
            type: element.type,
            img: getImg(element.proyecto.id),            
            pais: p[0].url,
            pais_name: p[0].nombre,
            ods: getODS(JSON.parse(element.proyecto.ods)),
            sector : getSector(element.proyecto.sector),
            content: element.proyecto.descripcion,
            name: element.proyecto.titulo,
            ciudad: element.ciudad,
            popularidad: element.proyecto.popularidad,  
            entidad: element.proyecto.entidad,
            poblacion: element.proyecto.poblacion,
        }).bindPopup(element.proyecto.titulo);
        markers_buenas_practicas.addLayer(marker);        
    }    
});

function compartir() {
    let btn_compartir_facebook = document.getElementById("btn-facebook");
    let btn_compartir_twitter = document.getElementById("btn-twitter");
    let btn_compartir_instagram = document.getElementById("btn-instagram");

    // Obtener la URL actual de la página
    var url = window.location.href;
    var title = "Titulo de Prueba";
    var descripcion = "Descripcion de Prueba";
    var img = "https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.france24.com%2Fes%2F20190409-gatos-reconocen-nombre-ignorar-estudio&psig=AOvVaw1ZfMmwnk9mxVW6s8awape-&ust=1682896629536000&source=images&cd=vfe&ved=0CBEQjRxqFwoTCNjdktCc0P4CFQAAAAAdAAAAABAE"

    btn_compartir_facebook.addEventListener("click", () => {
        /*var metaTitle = document.querySelector('meta[property="og:title"]');
        metaTitle.setAttribute("content", "buena practica");

        var metaImage = document.querySelector('meta[property="og:image"]');
        metaImage.setAttribute(
            "content",
            "https://empresa.org.ar/wp-content/uploads/2019/01/gestion-de-proyectos-1.jpeg"
        );*/

        // Crear la URL de compartir en Facebook
        var facebookUrl =
            "https://www.facebook.com/sharer/sharer.php?u=" +
            encodeURIComponent(url) +
            "&og:title="+ encodeURIComponent(title) +
            "&og:description="+ encodeURIComponent(descripcion) +
            "&og:image="+ encodeURIComponent(img)
            ;

        // Abrir la página de compartir en Facebook en una nueva pestaña
        //window.open(facebookUrl, "_blank");
        /*window.open(
            facebookUrl,
            "Compartir en Facebook",
            "width=600,height=400"
        );*/
        window.open(facebookUrl, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
    });
    btn_compartir_twitter.addEventListener("click", () => {
        // Crear la URL de compartir en Twitter
        var twitterUrl =
            "https://twitter.com/intent/tweet?url=" + encodeURIComponent(url);

        // Abrir la página de compartir en Twitter en una nueva pestaña
        window.open(twitterUrl, "_blank");
    });
    btn_compartir_instagram.addEventListener("click", () => {
        // Obtener la URL actual de la página
        var url = window.location.href;

        // Crear la URL de compartir en Instagram
        var instagramUrl =
            "https://www.instagram.com/accounts/login/?next=%2Fcreate%2F";

        // Abrir la página de compartir en Instagram en una nueva pestaña
        window.open(instagramUrl, "_blank");
    });
}
/*============================ formulario like ============ */
function FormLike() {
    let span = document.getElementById("like");
    const form = document.getElementById("formlike");
    let btn = document.getElementById("btn-favorite");
    form.addEventListener("submit", function (event) {
        event.preventDefault();
        const formData = new FormData(this);
        let id = document.getElementById("id_value").value;            
        axios
            .post("/like", formData)
            .then(function (response) {
                const beforelikes = JSON.parse(localStorage.getItem("like"));
                beforelikes.push({
                    id: id,
                    estado: true,
                });
                localStorage.setItem("like", JSON.stringify(beforelikes));                
                span.innerHTML = parseInt(span.innerHTML)+1;
                btn.style.color = "#ff0000";
                span.style.color = "#fff";                 
            })
            .catch(function (error) {
                console.log(error);
            });
    });
}

/*================== like marker ================ */
function recorrer_cache() {
    let id = document.getElementById("id_value").value;
    let btn = document.getElementById("btn-favorite");
    let span = document.getElementById("like");
    const cache = JSON.parse(localStorage.getItem("like"));    
    for (const item of cache) {
        if (item.id == id) {
            btn.style.color = "#ff0000";
            span.style.color = "#fff";    
            span.innerHTML = parseInt(span.innerHTML)+1;
        }
    }
}

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
                    <div class="redes-sociales">  
                        <p>Comparte en tus redes sociales</p>                                      
                        <ul class="wrapper">
                            <li class="icon facebook">
                                <span class="tooltip">Facebook</span>
                                <span><button class="btn-facebook" id="btn-facebook"><i class="fa-brands fa-facebook-f"></i></button></span>
                            </li>
                            <li class="icon twitter">
                                <span class="tooltip">Twitter</span>
                                <span><button class="btn-twitter" id="btn-twitter"><i class="fa-brands fa-twitter"></i></button></span>
                            </li>
                            <li class="icon instagram">
                                <span class="tooltip">Instagram</span>
                                <span><button class="btn-instagram" id="btn-instagram"><i class="fa-brands fa-instagram"></i></button></span>
                            </li>
                        </ul>                    
                    </div>
                </header>
                <div class="item-media entry-thumbnail img-type">
                    <img src="${a.layer.options.img}" alt=""> 
                    <img class="pais" src="${a.layer.options.pais}" alt="">
                    <span class="sector">${a.layer.options.sector}</span>
                    <form id="formlike">
                        <input type="hidden" id="id_value" name="id" value="${window.btoa(
                            a.layer.options.id
                        )}">
                        <button type="submit" id="btn-favorite" class="btn-favorite"><i class="fa-solid fa-heart"></i><span id="like">${
                            a.layer.options.popularidad
                        }</span></button>
                    </form>
                </div>
                <div class="item-content content-type">                
                    <div class="entry-content">
                        <span class="l-pais_name">${a.layer.options.pais_name}</span>
                        <span class="l-ciudad">${a.layer.options.ciudad}</span>
                        <p>${a.layer.options.content}</p>
                        <p>Poblacion Beneficiada: <span class="poblacion">${a.layer.options.poblacion}</span></p>
                        <div class="ods">
                        ${
                            a.layer.options.ods['nombre']
                        }
                        </div>
                        <div>
                            <h3>Entidades que patrocinan el proyecto</h3>
                            <p class="entidad">${a.layer.options.entidad}</p>
                        </div>  
                    </div>                                 
                </div>                
            </article>
        </div>`
    );
    sidebar.show();
    let buenas_practicas = document.getElementById("sidebar");
    buenas_practicas.style.background = "#00c6ff";
    compartir();
    FormLike();
    recorrer_cache();
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
                    <p class="icon-type"><i class="fa-solid fa-lightbulb icon-title"></i>${
                        a.layer.options.type
                    }</p>
                    <div class="redes-sociales"> 
                    <p>Comparte en tus redes sociales</p>                                      
                        <ul class="wrapper">
                            <li class="icon facebook">
                                <span class="tooltip">Facebook</span>
                                <span><button class="btn-facebook" id="btn-facebook"><i class="fa-brands fa-facebook-f"></i></button></span>
                            </li>
                            <li class="icon twitter">
                                <span class="tooltip">Twitter</span>
                                <span><button class="btn-twitter" id="btn-twitter"><i class="fa-brands fa-twitter"></i></button></span>
                            </li>
                            <li class="icon instagram">
                                <span class="tooltip">Instagram</span>
                                <span><button class="btn-instagram" id="btn-instagram"><i class="fa-brands fa-instagram"></i></button></span>
                            </li>
                        </ul>                    
                    </div>
                </header>
                <div class="item-media entry-thumbnail img-type">
                    <img src="${a.layer.options.img}" alt="">   
                    <img class="pais" src="${a.layer.options.pais}" alt=""> 
                    <span class="sector">${a.layer.options.sector}</span>                 
                    <form id="formlike">                                                
                        <input type="hidden" id="id_value" name="id" value="${window.btoa(
                            a.layer.options.id
                        )}">
                        <button type="submit" id="btn-favorite" class="btn-favorite"><i class="fa-solid fa-heart"></i><span id="like">${
                            a.layer.options.popularidad
                        }</span></button>
                    </form>
                </div>
                <div class="item-content content-type">                    
                    <div class="entry-content">
                        <span class="l-pais_name">${a.layer.options.pais_name}</span>
                        <span class="l-ciudad">${a.layer.options.ciudad}</span>
                        <p>${a.layer.options.content}</p>
                        <p>Poblacion Beneficiada: <span class="poblacion">${a.layer.options.poblacion}</span></p>
                        <div class="ods">
                        ${
                            a.layer.options.ods['nombre']
                        }
                        </div>
                        <div>
                            <h3>Entidades que patrocinan el proyecto</h3>
                            <p class="entidad">${a.layer.options.entidad}</p>
                        </div>            
                    </div>   
                </button>
                </div>                
            </article>
        </div>`
    );
    sidebar.show();
    let ideas_innovadoras = document.getElementById("sidebar");
    ideas_innovadoras.style.background = "#FDC830";
    compartir();
    FormLike();
    recorrer_cache();
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
    '<i class="fa-solid fa-lightbulb icon-title"></i> Ideas Innovadoras': markers_ideas_innovadoras,
    '<i class="fa-solid fa-trophy"></i> Buenas Practicas': markers_buenas_practicas,
    'Ambos': layerGroupTotal,
};
L.control.layers(OverLayMaps).addTo(map);

//creacion de un buscador
var searchControl = new L.Control.Search({
    layer: layerGroupTotal, // Capa en la que se realizará la búsqueda
    propertyName: "name",
    textPlaceholder: "Buscar ...",
    //initial: false,
    //autoCollapse: false,
    /*filterData: function(text, records){
        console.log("texto")
        console.log(text)
        console.log("records")
        console.log(records)
    }*/
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
    console.log(e)
    map.setView(e.latlng, 5); // Zoom a la posición del marcador encontrado con un nivel de zoom de 16    
});

// Agregar un controlador de eventos para el evento "search:cancel"
searchControl.on("search:cancel", function (e) {
    console.log(searchControl.marker)
});

//posicion de los botones de zoom del mapa
map.zoomControl.setPosition("bottomright");

function cargarMapa() {
    // Obtener el ID de la URL y llamar a la función de búsqueda
    var urlParams = new URLSearchParams(window.location.search);
    var id = urlParams.get("id");
    if (id) {
        localizarMarkerPorId(id);
    }

    //generar cache
    const CacheItems = [];
    localStorage.setItem("like", JSON.stringify(CacheItems));
}

/*======================= buscar un marker por su ID ================= */
function localizarMarkerPorId(id) {
    // Buscar el marker correspondiente al ID
    let marker = null;
    markers_buenas_practicas.eachLayer(function (layer) {
        if (layer.options.id == window.atob(id)) {
            marker = layer;
        }
    });

    markers_ideas_innovadoras.eachLayer(function (layer) {
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
}

cargarMapa();
