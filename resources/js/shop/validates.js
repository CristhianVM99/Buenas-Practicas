import { getExtension } from "./fileProperties";
import { bytesToMegabytes } from "./convert-formats";
import { mostrarToast } from '../../libs/toast/toast';

/****FileList, validators.... */
function validateFiles( files, exts, limit ) {
    return [...files].filter( (file) => {
        if(fileExtensionIsValided(file, exts) && fileSizeIsValided(file, limit)) {
            return file;
        }
    });
}

function fileExtensionIsValided(file, exts = []){
    if( exts.length > 0 && exts.indexOf( getExtension( file.name.toLowerCase() ) ) < 0 ) {
        mostrarToast({
            mensaje : `${file.name}, no existe la lista permitida de extensiones: [ ${exts} ]`,
            clase   : "danger",
        });
        // console.error( file.name, "es un tipo de archivo no valido" );
        // console.log( getExtension( file.name ), "no existe la lista permitida", exts );
        return false;
    }
    return true;
}

function fileSizeIsValided(file, limite = Infinity){
    if( file.size > limite) {
        mostrarToast({
            mensaje : `${file.name}, Excede el tamano máximo permitido de ${bytesToMegabytes(limite)} "MB"`,
            clase   : "danger",
        });
        // console.log( file.name, " (" + bytesToMegabytes(file.size).toFixed(2) + " MB )" );
        // console.error( "Excede el tamano máximo permitido, " + bytesToMegabytes(limite) + "MB" );
        return false;
    }
    return true;
}	

export { validateFiles , fileExtensionIsValided };