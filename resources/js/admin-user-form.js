import '../css/cards.css';
import '../css/animaciones.css';
import '../libs/dragDrop/drag_drop';
import { fileExtensionIsValided } from "./shop/validates";
import { dataURLtoFile } from "./shop/fileProperties";

let autor    = document.getElementById("autor");
let template = document.getElementById("template-autor");
let rol      = document.getElementById("rol");
var cropper;
let image    = document.getElementById('crop_image');
let $modal   = $("#modal_image");

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

autor.addEventListener('transitionend', function() {
    if (autor.classList.contains('colapse') && !autor.classList.contains('show'))
        autor.innerHTML = '';
});

rol.onchange = e => {
    if(e.target.value == 2){
        autor.classList.add('show');
        autor.innerHTML = template.innerHTML;
    }
    else{
        autor.classList.remove('show');
    }

}
rol.onload = function(){
    rol.dispatchEvent(new Event("change"));
}();

/****** EVENT PARA LA VALIDACION DE FILE******/
$("input[type=file]").change(function(e){
    e.preventDefault();
    if( fileExtensionIsValided(this.files[0], getExtendsValidos(this)) )
    {
        // let $img = $(this).next('img');
        image.src = URL.createObjectURL(this.files[0]);
        $modal.modal('show');
        // mostrarFile(this.files[0], $img[0])
        // $img.removeClass('hidden');
    }
    else{
        this.value = '';
    }
});

function getExtendsValidos( input ) {
    return input.getAttribute('accept').split(',').map(element => element.trim());
}

document.getElementById('crop').addEventListener('click', function(){ 
    if(cropper) {
        let $img = $("input[type=file] + img");
        let cropped = cropper.getCroppedCanvas().toDataURL();
        $img.prop('src', cropped);
        $img.removeClass('hidden');

        let myFile = dataURLtoFile(cropped, "imagen_recortada");
        let dataTransfer = new DataTransfer();
        dataTransfer.items.add(myFile);
        document.querySelector("input[type=file]").files = dataTransfer.files;
        // fileInput.files = dataTransfer.files;
        console.log(document.querySelector("input[type=file]"));
    }
    $modal.modal('hide');
});