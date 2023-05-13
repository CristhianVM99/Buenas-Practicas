// LIBRERIAS
/*================== Librerias de Leaflet ================ */
import "leaflet/dist/leaflet.css";
import L, { DomUtil, icon, marker } from "leaflet";
/*================== Librerias parar el Cluster ================ */
import "leaflet.markercluster/dist/MarkerCluster.css";
import "leaflet.markercluster/dist/MarkerCluster.Default.css";
import "leaflet.markercluster/dist/leaflet.markercluster";
/*================== Librerias para un Boton ================ */
import "leaflet-easybutton/src/easy-button.css";
import "leaflet-easybutton/src/easy-button.js";
/*================== Librerias para el Sidebar ================ */
import "leaflet-sidebar/src/L.Control.Sidebar.css";
import "leaflet-sidebar/src/L.Control.Sidebar.js";
/*================== Librerias para los Iconos ================ */
import "leaflet-extra-markers/dist/css/leaflet.extra-markers.min.css";
import "leaflet-extra-markers/dist/js/leaflet.extra-markers.js";
/*================== Librerias para el Buscador o Search ================ */
import "leaflet-search/dist/leaflet-search.src";
import "leaflet-search/dist/leaflet-search.src.css";
/*================== Estilos CSS para Leaflet ================ */
import "../css/leaflet.css";
/*================== Libreria Axios ================ */
import axios from "axios";
/*================== Librerias para Swiper ================ */
import { register } from 'swiper/element/bundle';
register();

//CREACION DE LA INSTANCIA
/*================== Creamos la Instancia para LEAFLET MAP ================ */
const map = L.map("mapid", {
    center: [-17.9659, -67.1097],
    zoom: 7,
});
L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution:
        'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
    maxZoom: 18,
}).addTo(map);

/*================== funciones de MAP ================ */
map.on("click", function () {
    sidebar.hide();
});
/*================== FIN DE LEAFLET MAP ================ */

//CREACION DE LOS COMPONENTES
/*================== Creacion del Sidebar ================ */
var sidebar = L.control.sidebar("sidebar", {
    position: "left",
});
/*================== Creacion de los Iconos y los Marcadores ================ */
var ideaMarker = L.ExtraMarkers.icon({
    icon: "fa-lightbulb",
    markerColor: "yellow",
    shape: "circle",
    prefix: "fa-solid",
});
var proyectoMarker = L.ExtraMarkers.icon({
    icon: "fa-trophy",
    markerColor: "blue",
    shape: "circle",
    prefix: "fa-solid",
});

var markadores = L.markerClusterGroup({
    spiderfyOnMaxZoom: false,
    showCoverageOnHover: false,
    zoomToBoundsOnClick: true,
});

var markers_ideas_innovadoras = L.markerClusterGroup({
    spiderfyOnMaxZoom: false,
    showCoverageOnHover: false,
    zoomToBoundsOnClick: true,
});

var markers_buenas_practicas = L.markerClusterGroup({
    spiderfyOnMaxZoom: false,
    showCoverageOnHover: false,
    zoomToBoundsOnClick: true,
});

/*================== FIN DE LEAFLET MAP ================ */

/*=============== adicionamos un elemento checkbox al MAP ================ */
var div = L.DomUtil.create('div', 'leaflet-control-chekbox');

div.innerHTML = `<div class="radio-input">
<input checked="" value="color-1" name="color" id="color-1" type="radio">
<label for="color-1">
  <p class="texto-lf">Todos</p>
  <span>
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><g stroke-width="0" id="SVGRepo_bgCarrier"></g><g stroke-linejoin="round" stroke-linecap="round" id="SVGRepo_tracerCarrier"></g><g id="SVGRepo_iconCarrier"> <g id="Interface / Check"> <path stroke-linejoin="round" stroke-linecap="round" stroke-width="2" stroke="#ffffff" d="M6 12L10.2426 16.2426L18.727 7.75732" id="Vector"></path> </g> </g></svg>
  </span>
</label>

<input value="color-2" name="color" id="color-2" type="radio">
<label for="color-2">
<p class="texto-lf">Buenas Practicas</p>
  <span>
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><g stroke-width="0" id="SVGRepo_bgCarrier"></g><g stroke-linejoin="round" stroke-linecap="round" id="SVGRepo_tracerCarrier"></g><g id="SVGRepo_iconCarrier"> <g id="Interface / Check"> <path stroke-linejoin="round" stroke-linecap="round" stroke-width="2" stroke="#ffffff" d="M6 12L10.2426 16.2426L18.727 7.75732" id="Vector"></path> </g> </g></svg>
  </span>
</label>

<input value="color-3" name="color" id="color-3" type="radio">
<label for="color-3">
<p class="texto-lf">Ideas Inovadoras</p>
  <span>
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><g stroke-width="0" id="SVGRepo_bgCarrier"></g><g stroke-linejoin="round" stroke-linecap="round" id="SVGRepo_tracerCarrier"></g><g id="SVGRepo_iconCarrier"> <g id="Interface / Check"> <path stroke-linejoin="round" stroke-linecap="round" stroke-width="2" stroke="#ffffff" d="M6 12L10.2426 16.2426L18.727 7.75732" id="Vector"></path> </g> </g></svg>
  </span>
</label>

</div>`

//FUNCIONES PARA LOS MARKADORES
/*=============== funcion que retorna la url de una imagen ============ */
function getImg(id) {
    let url = "#";
    documentos.forEach((element) => {
        if (element.proyecto_id == id && element.tipo == "imagenes") {
            url = "storage/imagenes/"+element.name;
        }
    });
    return url;
}
/*================= funcion que retorna una array de imagenes =========== */
function getImagenes(id){
    let imagenes = [];
    let url = "#"
    documentos.forEach((element) => {
        if (element.proyecto_id == id && element.tipo == "imagenes") {
            url = "storage/imagenes/" + element.name;
            imagenes.push(url)
        }
    });
    return imagenes
}
/*================= funcion que retorna un array de documentos ========== */
function getDocumentos(id){
    let documentos_array = [];
    let url = "#"
    documentos.forEach((element) => {
        if (element.proyecto_id == id && element.tipo == "documentos") {
            url = element.id;
            documentos_array.push({
                url: url,
                nombre: element.name_original
            })
        }
    });
    return documentos_array
}
/*================ funcion para retornar la bandera de un pais =============== */
function getPais(pais) {
    let datos = [];
    paises.forEach((element) => {
        if (element.code == pais) {
            datos.push({
                url: element.flag_4x3,
                nombre: element.name,
            });
        }
    });
    return datos;
}
/*=============== funcion para retornar los ODS de un proyecto =============== */

function getODS(cadena) {
    let cate = [];
    categorias.forEach((cat) => {
        cadena.forEach((cad_cat) => {
            if (cat.id == cad_cat) {
                cate.push({
                    nombre: cat.name,
                    icono_url: "img/SDG/" + cat.icon,
                });
            }
        });
    });
    return cate;
}
/*============= funcion para retornar el sector ====================  */
function getSector(id) {
    let sector = "";
    sectores.forEach((element) => {
        if (element.id == id) {
            sector = element.name;
        }
    });
    return sector;
}
/*================ funcion para controlar los layers ============= */
function updateMarkers() {
    // Obtén el estado de los checkboxes
    var group1Visible = document.getElementById('color-1').checked;
    var group2Visible = document.getElementById('color-2').checked;
    var group3Visible = document.getElementById('color-3').checked;
  
    // Muestra u oculta los grupos de marcadores según el estado de los checkboxes
    if (group1Visible) {
      markadores.addTo(map);
    } else {
      markadores.removeFrom(map);
    }
    if (group2Visible) {
      markers_buenas_practicas.addTo(map);
    } else {
      markers_buenas_practicas.removeFrom(map);
    }
    if (group3Visible) {
      markers_ideas_innovadoras.addTo(map);
    } else {
      markers_ideas_innovadoras.removeFrom(map);
    }
}
document.getElementById('color-1').addEventListener('change', updateMarkers);
document.getElementById('color-2').addEventListener('change', updateMarkers);
document.getElementById('color-3').addEventListener('change', updateMarkers);

/*================= funcion para compatir un markador ============== */
function compartir() {
    let btn_compartir_facebook = document.getElementById("btn-facebook");
    let btn_compartir_twitter = document.getElementById("btn-twitter");
    let btn_compartir_instagram = document.getElementById("btn-instagram");

    // Obtener la URL actual de la página
    var url = window.location.href;
    var title = "Titulo de Prueba";
    var descripcion = "Descripcion de Prueba";
    var img =
        "https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.france24.com%2Fes%2F20190409-gatos-reconocen-nombre-ignorar-estudio&psig=AOvVaw1ZfMmwnk9mxVW6s8awape-&ust=1682896629536000&source=images&cd=vfe&ved=0CBEQjRxqFwoTCNjdktCc0P4CFQAAAAAdAAAAABAE";

    btn_compartir_facebook.addEventListener("click", () => {
        /*var metaTitle = document.querySelector('meta[property="og:title"]');
        metaTitle.setAttribute("content", "buena practica");

        metaImage.setAttribute(
            "content",
            "https://empresa.org.ar/wp-content/uploads/2019/01/gestion-de-proyectos-1.jpeg"
        );*/

        // Crear la URL de compartir en Facebook
        var facebookUrl =
            "https://www.facebook.com/sharer/sharer.php?u=" +
            encodeURIComponent(url) +
            "&og:title=" +
            encodeURIComponent(title) +
            "&og:description=" +
            encodeURIComponent(descripcion) +
            "&og:image=" +
            encodeURIComponent(img);
        window.open(
            facebookUrl,
            "_blank",
            "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400"
        );
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
                span.innerHTML = parseInt(span.innerHTML) + 1;
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
            span.innerHTML = parseInt(span.innerHTML) + 1;
        }
    }
}
/*================ RECORRIDO DE LOS MARKADORES ================== */
datos.forEach((element) => {
    let p = getPais(element.proyecto.pais);
    let marker = L.marker([element.lat, element.lng], {
        id: element.proyecto.id,
        type: element.type,
        img: getImg(element.proyecto.id),
        pais: p[0].url,
        pais_name: p[0].nombre,
        ods: getODS(JSON.parse(element.proyecto.ods)),
        sector: getSector(element.proyecto.sector),
        content: element.proyecto.descripcion,
        name: element.proyecto.titulo,
        ciudad: element.ciudad,
        popularidad: element.proyecto.popularidad,
        entidad: element.proyecto.entidad,
        poblacion: element.proyecto.poblacion,
        imagenes: getImagenes(element.proyecto.id),
        pdfs: getDocumentos(element.proyecto.id)
    }).bindPopup(element.proyecto.titulo);

    if (element.type == "buena practica") {
        marker.setIcon(proyectoMarker);
        markers_buenas_practicas.addLayer(marker)
    }

    if (element.type == "idea inovadora") {
        marker.setIcon(ideaMarker);
        markers_ideas_innovadoras.addLayer(marker)
    }
    markadores.addLayer(marker);
});

//FUNCION SIDEBAR PARA LOS MAKADORES
function principal(a) {
    var url = new URL(window.location.href);
    url.searchParams.set("id", window.btoa(a.layer.options.id));
    window.history.replaceState(null, null, url);
    sidebar.setContent(
        `<div class="isotope-item ideas-innovadoras sidebar-map">
            <article class="post vertical-item content-padding with_background rounded overflow_hidden loop-color sidebar-map-item">
                <header class="entry-header">
                    <h1>${
                        a.layer.options.name
                    }</h1>
                    <div class="redes-sociales">
                    <p>${
                        a.layer.options.type
                    }</p>
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
                    <span class="sector">${
                        a.layer.options.sector
                    }</span>
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
                        <span class="l-pais_name">${
                            a.layer.options.pais_name
                        }</span>
                        <span class="l-ciudad">${a.layer.options.ciudad}</span>
                        <span class="l-poblacion">${a.layer.options.poblacion}</span>
                        <p>${a.layer.options.content}</p>

                        <p class="poblacion">Presupuesto:
                            <span class="campo">150000 Bs.</span>
                        </p>

                        <div class="ods">
                        ${a.layer.options.ods["nombre"]}
                        </div>
                        <!--incio de markadores-->
                        <div class="imagenes-content">
                        <h2>Imagenes del proyecto</h2>
                        <swiper-container class="mySwiper" pagination="true" pagination-clickable="true" navigation="true" space-between="30" loop="true">
                        ${a.layer.options.imagenes.map(element => `
                        <swiper-slide>
                          <a href="${element}" target="_blank">
                            <img src="${element}" alt="">
                          </a>
                        </swiper-slide>
                      `).join('')}
                        </swiper-container>
                        </div>
                        <!--fin de markadores-->
                        <div class="documentos-content">
                            <h2>Documentos del proyecto</h2>
                            ${a.layer.options.pdfs.map(element => `
                                <p>#<a href="documento/${element.url}" target="_blank">${element.nombre}</a></p>
                            `).join('')}
                        </div>
                        <div class="entidades-content">
                            <h2>Entidades que patrocinan el proyecto</h2>
                            <ul>
                                <li><p>#<span>${a.layer.options.entidad}</span></p></li>
                            </ul>
                        </div>
                        <div class="ods-content">
                        <h2>Objetivos de Desarrollo Sostenible</h2>
                        <swiper-container class="swiper-ods" slides-per-view="3">
                            ${a.layer.options.ods.map(element => `
                                    <swiper-slide>
                                        <img class="icono_url" src="${element.icono_url}"/>
                                    </swiper-slide>
                            `).join('')}
                        </swiper-container>
                        </div>
                    </div>
                </button>
                </div>
            </article>
        </div>`
    );
    sidebar.show();
    if (a.layer.options.type == "idea inovadora") {
        let ideas_innovadoras = document.getElementById("sidebar");
        ideas_innovadoras.style.background = "#FDC830";
    }

    if (a.layer.options.type == "buena practica") {
        let buenas_practicas = document.getElementById("sidebar");
        buenas_practicas.style.background = "#00c6ff";
    }
    compartir();
    FormLike();
    recorrer_cache();
}
markadores.on("click", principal);
markers_buenas_practicas.on("click", principal);
markers_ideas_innovadoras.on("click", principal);

/*============== libreria para las imagenes ============= */
markadores.on("mouseover", function (e) {
    this.openPopup();
});
markadores.on("mouseover", function (e) {
    this.openTooltip();
});

//creacion de un buscador
var searchControl = new L.Control.Search({
    layer: layerGroupTotal, // Capa en la que se realizará la búsqueda
    propertyName: "name",
    textPlaceholder: "Buscar ...",   
});
//una vez encontrado el buscador realizamos un zoom en el marcador
searchControl.on("search:locationfound", function (e) {
    console.log(e);
    map.setView(e.latlng, 5); // Zoom a la posición del marcador encontrado con un nivel de zoom de 16
});
// Agregar un controlador de eventos para el evento "search:cancel"
searchControl.on("search:cancel", function (e) {
    console.log(searchControl.marker);
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
    markadores.eachLayer(function (layer) {
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

/*================================== */
var mapContainer = map.getContainer();
mapContainer.appendChild(div);
map.addControl(sidebar);
map.addLayer(markadores);
map.addControl(searchControl);
/*================================== */
cargarMapa();
