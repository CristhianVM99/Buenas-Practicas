import '../css/cards.css';
import '../css/formulario.css';
import './proys-table';
import { imagesErrors } from "./shop/errors/errorImg";
import { mostrarToast } from "../libs/toast/toast";
let avatar = document.getElementById("avatar");
let update = document.getElementById("update");
/**** Se utiliza para cuando ocurrio un error en las imagenes ****/
imagesErrors();

document.getElementById("user-camera").addEventListener("click", event => {
    avatar.click();
});

var cropper;
let image = document.getElementById('crop_image');
let $modal = $("#modal_image");

avatar.addEventListener("change", (event) => {
    if(event.target.files.length > 0) {
        image.src = URL.createObjectURL(event.target.files[0]);
        $modal.modal('show');
    }
});

$modal.on('shown.bs.modal', function() {
    cropper = new Cropper(image, {
        aspectRatio: 1,
        viewMode: 2,
        dragMode:'move',
        preview:'.preview',
        background: false,
    });
}).on('hidden.bs.modal', function(){
    cropper.destroy();
       cropper = null;
});

document.getElementById('crop').addEventListener('click', function(){
    
    if(cropper) {
        let canvas = cropper.getCroppedCanvas();
        canvas.toBlob( ( blob ) => {
            let url = `/profile/avatar/${avatar.dataset.user}`;
            let data = {
                avatar  : blob,
            };
            axios.post( url, data, {
                headers: {
                'Content-Type': 'multipart/form-data'
                }
            })
            .then(response => {
                if( response.status == 200 ) {
                    mostrarToast({mensaje: response.data, clase: 'success'});
                    $('.avatar').attr("src", canvas.toDataURL());
                }
            })
            .catch (error => {
                mostrarToast({mensaje: error.response.data, clase: 'error'});
                console.log(error);
            });
        });
    }
    $modal.modal('hide');
});

update.addEventListener('click', (e) => {
    e.preventDefault();
    let icon    = update.querySelector('i');
    
    if(icon.classList.contains('fa-edit')) {
        formToggleDisabled();
    }
    else if(icon.classList.contains('fa-save')) {
        document.querySelector('#update-user').submit();
    }
    cancelar();
});

document.querySelector('.cancelar').addEventListener('click', cancelar);

function cancelar() {
    let icon    = update.querySelector('i');
    let title   = update.querySelector('span.media-name');
    let aux     = title.dataset.option;
    if( icon.classList.contains('fa-save') ) {
        formToggleDisabled();
    }
    document.querySelector('.cancelar').classList.toggle('invisible');
    title.dataset.option = title.innerText;
    title.innerText      = aux;
    icon.classList.toggle('fa-edit');
    icon.classList.toggle('fa-save');
}

function formToggleDisabled() {
    let elements = document.querySelector('form#update-user').elements;
    for(let i = 0; i < elements.length; i++) {
        if( elements[i].type !="hidden")
            elements[i].disabled = !elements[i].disabled;
    }
}