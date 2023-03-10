import '../libs/dragDrop/drag_drop';
import { megabytesToBytes } from'./shop/convert-formats';
import { Archivos } from "./models/Archivo";
import { validateFiles } from "./shop/validates";
import { mostrarToast } from "../libs/toast/toast";

const LIMIT_SIZE_FILE = import.meta.env.VITE_MAX_SIZE_FILE_MB ? megabytesToBytes( import.meta.env.VITE_MAX_SIZE_FILE_MB ): Infinity;

let archivos    = new Archivos();

/****** EVENT PARA LA VALIDACION Y FILTRADO DE FILES A CARGAR ******/
$("input[type=file]").change(function(e){
    e.preventDefault();
    console.log("antes", archivos);
    let docs = validateFiles( this.files, getExtendsValidos( this ), LIMIT_SIZE_FILE );
    archivos.setFilesFromArrayFile( docs, this.dataset.gallery, this.dataset.registro );
    $(this).closest('article.panel-documentos').trigger( "generate_files", this.dataset.gallery);
});

function getExtendsValidos( input ) {
    return input.getAttribute('accept').split(',').map(element => element.trim());
}

/****** EVENT PARA CARGAR EN LA PAGINA LOS FILES Y ELIMINACION DE FILES ******/

$('article.panel-documentos').on("generate_files", function(e, galeria) {
    if ( galeria ) {
        generarListFiles( $(this), galeria );
    }
}).on("click", ".eliminar", function(e) {
    e.preventDefault();
    let $fileDataDom = $(this).closest(".dataFile");
    if( $fileDataDom.data("idArchivo") ){
        removeToServer($fileDataDom.data("idArchivo"), this);
    } else {
        archivos.removeFileById( $fileDataDom.data("idFile") );
        removeFromDOM($(this).closest('.item-file'));
    }
});

/****** FUNCTIONS para cargar los files en la pagina ******/
function generarListFiles( $container, galeria = "imagenes" ) {
    let $panel = $container.find(".list-files");
    let sinPreviewFiles = archivos.filesNoPreviewByGaleria( galeria);
    if(sinPreviewFiles.length > 0 )
        { $container.find(".section-files").removeClass("hidden"); }
    if ( galeria != "imagenes") {
        sinPreviewFiles.forEach(obj => {
            let iconHtml = `<i class="${obj.icon} info_color text-[30px]"></i>`;
            addFileToDOM($panel, obj, iconHtml);
        });
    } else {
        sinPreviewFiles.forEach(obj => {
            previewFileImage( obj, $panel);
        });
    }
    console.log(archivos.files);
}

function previewFileImage( objFile, $container ) {
    let visor = new FileReader();
    visor.onload = (e)=>{
        let image = `
        <img class="object-cover h-full" src="${e.target.result}" alt="">
        `;
        addFileToDOM($container, objFile, image);
    };
    visor.readAsDataURL(objFile.file);
}

function addFileToDOM( $container, objFile, image) {
    $container.prepend( crearItemFile( objFile, image ) );
    objFile.preview = true;
    if(objFile.id_archivo) {
        $container.find('.subirFile').trigger("submit", objFile.id_archivo);
        objFile.uploaded = true;
    }
    else if( archivos.files.length > 0 && archivos.filesNoPreviewByGaleria(objFile.galeria).length == 0){
        //Si Todos los archivos Ya fueron previsualizados en el Html, se genera el registro.
        $('form#registro').trigger('submit', 'files');
    }
}

function crearItemFile( objFile, image ) {

    return `
    <div class="item-file to_animate animated slideDown" data-animation="slideDown" data-delay="500">
        <span class="w-[30px] h-[30px] preview">
            ${image}
        </span>
        <span class="grow overflow-hidden">
            <div class="flex justify-stretch">
                <div class="file-name grow overflow-hidden whitespace-nowrap text-ellipsis">${objFile.name}</div>
                <span class="inline-block w-[30px] text-right progress-text">0%</span>
            </div>
            <div class="progress my-1">
                <div class="progress-bar progress-bar-info" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </span>
        <span class="w-[30px] text-right dataFile" data-id-file="${objFile.id} ">
            <i class="eliminar rt-icon2-trashcan text-red-600 text-xl hover:text-red-900 cursor-pointer" title="Eliminar"></i>
            <i class="hidden text-xl text-green-500 rt-icon2-checkmark2"></i>
            <i class="hidden text-3xl danger_color rt-icon2-refresh"></i>
            <button class="hidden subirFile" >Cargar</button>
        </span>
    </div>
    `;
}

function removeToServer( id, elemDom ) {
    axios.post( `/documento/${id}/delete`)
    .then(response => {
        if( response.status == 200) {
            removeFromDOM($(elemDom).closest('.item-file'));
        }
        else {
            console.log(response);
        }
    })
    .catch (response => {
        console.error(response);
    });
}

function removeFromDOM( $element ) {
    $element.addClass('slideOutUp').hide(500, function () {
        $element.remove();
    });
}


/********* EVENT DE CARGA O SUBIDA DE FILE AL SERVER *************/

$("article.panel-documentos").on("submit",".subirFile", function(e, id_registro, tipo = null, redirect = null ) {
    e.preventDefault();
    let $fileDataDom = $(this).closest(".item-file");
    //obtiene el file relacionado al evento.
    let fileObj = archivos.searchFileById( $fileDataDom.find('.dataFile').data("idFile") );
    if(!fileObj.uploaded){
        uploadFile({
            itemDom : $fileDataDom, 
            url     : `/documento/${id_registro}/registro`,
            archivo : fileObj,
            tipo    : tipo,
            redirect: redirect,
        });
    }
});

async function uploadFile( uploadProps ) {
    let doc          = uploadProps.archivo; 
    let $progressbar = uploadProps.itemDom.find(".progress-bar");
    let $text        = uploadProps.itemDom.find(".progress-text");
    let formData     = new FormData();
    formData.append('file', doc.file);
    formData.append('folder', doc.galeria);
    formData.append('tipo', doc.galeria);
    

    const res = await axios.post( uploadProps.url, formData, { 
        headers: {'Content-Type': 'multipart/form-data'},
        onUploadProgress(e){
            let perc = Math.round(e.loaded*100/e.total);
            $progressbar.css('width',perc+'%');
            $text.html(perc+'%');
        }
    });

    if( res.status == 200 )
    {
        doc.uploaded = true;
        // let $itemFile = uploadProps.progress.closest(".item-file");
        let temp = uploadProps.itemDom.find('.preview').html();
        archivos.removeFileById( doc.id );
        uploadProps.itemDom.find('.preview').html(aggregateLink(
            '/documento/' + res.data.id, temp
        ));
        uploadProps.itemDom.find("button.subirFile").remove();
        uploadProps.itemDom.find(".file-name").html(
            aggregateLink(
                '/documento/' + res.data.id, 
                res.data.name_original??$res.data.name
            )
        );

        uploadProps.itemDom.find(".dataFile")[0].dataset.idArchivo = res.data.id;

        if(archivos.getfilesNoUpLoaded().length == 0 ) {
            if(tipo == null){
                Swal.fire({
                    title: '<h3 class="highlight4">Su registro está siendo procesado!</h3>',
                    html: `                    
                        <div class="with_padding rounded">
                            <p class="text-xs">Cada uno de los registros pasa por un proceso de revisión rápido, antes de aparecer en el mapa.
                            <span class="bold">Esto normalmente tarda un día</span></p>                                                
                            <p class="text-xs bold">Le enviaremos un email cuando haya sido aprobado.</p>
                        </div> 
                    `,
                    confirmButtonText: '<a class="theme_button min_width_button color2" href="#">CONTINUAR</a>'
                }).then((result) => {
                    if (result.isConfirmed){
                        setTimeout( function() { window.location.href = uploadProps.redirect; }, 500 );
                    }
                });
            }
            else if(tipo == 'files'){
                mostrarToast({clase: 'success', mensaje: 'Los Documentos han sido Guardados'})
            }
        }
    }
}

function aggregateLink( url, element)
{
    return `<a href="${url}" target="_blank">${element}</a>`;
}