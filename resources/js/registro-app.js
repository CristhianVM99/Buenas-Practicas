import '../css/cards.css';
import '../css/formulario.css';
import '../css/botones.css';
import '../css/checkbox.css';
import './drag_drop-app';
import { list_ods } from './ods';
import { mostrarToast } from "../libs/toast/toast";

$(window).on("load", ()=>{
    if($("#ciudad").data("id")) {
        $("#pais").trigger("change", [$("#ciudad").data("id")]);
    }
    else {
        $("#pais").trigger("change")
    }
});

$('input#estado').on('change', function(e) {
    let texto = $(this).is(':checked')? "Aprobado ": "En Revisión";
    $(this).next("span").text(texto);
});

$("#pais").on("change", function (e, ciudad) {
    if( $("#pais option:selected").val() )
    {
        let code = $("#pais option:selected").val();
        $("#ciudad").empty();
        axios.get(`/pais/${code}/ciudades/`)
        .then(response => {
            if(response.status === 200 && response.data.length > 0) {
                let ciudades = response.data;
                for (const ciudad of ciudades) {
                    $("#ciudad").append(`
                        <option value="${ciudad.id}">${ciudad.name}</option>
                    `);   
                }
                if(ciudad) {
                    $("#ciudad").val(ciudad);
                }
            }
            else {
                $("#ciudad").append(`
                <option value="" selected disabled>No se encontro ciudades relacionados</option>
            `);
            }
        }).catch(error => {
            console.log(error);
            $("#ciudad").append(`
                <option value="" selected disabled>No se encontro ciudades relacionados</option>
            `);
        });
    }
});

$('form#registro').on('submit', function(e, tipoClick = null) { 
    e.preventDefault();
    if(this.action.includes('crear'))
        mostrarToast({clase:'info', mensaje:'Se está Creando un nuevo registro para guardar los Documentos'});
    submitForm(this)
    .then( response => {
        console.log("datos de respuesta sobre el fomulario")
        console.log(response)
        if( response.status == 200 ) {
            /***** Obtienen los archivos que se subiran una vez creado el registro. *****/
            let $uploadFiles = $("article.panel-documentos .subirFile");
            let registro     = response.data.registro?? response.data;
            console.log("datos del formulario despues de ser enviado")
            console.log(registro)
            if( response.data.mensaje ){
                mostrarToast({clase:'success',mensaje:response.data.mensaje});
            }
            //*** llamado para cargar Files al server */
            if( $uploadFiles.length > 0) {
                this.action= this.action.replace('crear', `${registro.id}/update`);
                $("input[type=file]").each( function(i){
                    this.dataset.registro = registro.id;
                });
                $uploadFiles.trigger("submit", [ registro.id,  tipoClick, response.data.redirect] )
            }
            else {                
                Swal.fire({
                    title: '<h1 class="color2" >Su registro está siendo procesado</h1>',
                    html: `
                    <p>Cada uno de los registros pasa por un proceso de revisión rápido, antes de aparecer en el mapa,<b>ésto normalmente tarda un día</b> </p>
                    <span>Le enviaremos un email cuando haya sido aprobado</span>
                    `,
                    confirmButtonText: 'Continuar'
                }).then((result) => {
                    if (result.isConfirmed){
                        setTimeout( function() { window.location.href = response.data.redirect?? "/profile"; }, 500 );
                    }
                });
            }               
        }
    })
    .catch( error => mensajeError( error.response) );  
});

async function submitForm(form){
    console.log("datos del formulario desde submitForm")
    console.log(form)
    let jsonData = $(form).serializeArray()    
    .reduce(function(a, z) { a[z.name] = z.value; return a; }, {});
    jsonData.ods = JSON.stringify(list_ods($('.ods .marco.active')));
    if($('input#estado').length == 1){
        jsonData.estado = $('input#estado').is(':checked');
    } 
    console.log("datos del formulario desde submitForm 2")
    console.log(jsonData)
    return await axios.post(
        form.action,
        jsonData,
    );
}

function mensajeError(response){
    console.log(response);
    mostrarToast({clase:"warning", mensaje:'No se ha Creado un Registro y no se Guardó los Archivos'});
    if(response.status == 422){
        let errors = response.data.errors;
        for (const propiedad in errors) {
            errors[propiedad].forEach(item => {
                mostrarToast({clase:"danger", mensaje:item});
            });
        }
        mostrarToast({clase:"error", timer:9000, mensaje:'Por favor, llene los Campos necesarios para Crear un nuevo registro'});
    }
}