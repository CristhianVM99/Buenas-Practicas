import '../css/cards.css';
import '../css/formulario.css';
import '../libs/dragDrop/drag_drop';
import { fileExtensionIsValided } from "./shop/validates";
import { mostrarFile } from "./shop/fileProperties";
import './ods';

/****** EVENT PARA LA VALIDACION DE FILE******/
$("input[type=file]").change(function(e){
    e.preventDefault();
    if( fileExtensionIsValided(this.files[0], getExtendsValidos(this)) )
    {
        let $img = $(this).next('img');
        mostrarFile(this.files[0], $img[0])
        $img.removeClass('hidden');
    }
    else{
        this.value = '';
    }
});

function getExtendsValidos( input ) {
    
    return input.getAttribute('accept').split(',').map(element => element.trim());
}