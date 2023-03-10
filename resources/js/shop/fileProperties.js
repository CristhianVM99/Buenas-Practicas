const ICONS = {
    ".pdf"      : "rt-icon2-file-pdf-o",
    ".doc"      : "rt-icon2-file-word-o",
    ".docx"     : "rt-icon2-file-word-o",
    "default"   : "rt-icon2-file-o",
};

function selectIconToFile(filename) {
    return ICONS.hasOwnProperty( getExtension(filename) )? ICONS[getExtension(filename)]: ICONS.default;
}
function getExtension(filename) {
    return filename.slice((filename.lastIndexOf('.')- 1 >>> 0)+1);
}
function mostrarFile( file, img){
    if(img && file){
        var reader = new FileReader();
        reader.addEventListener("load", function() {
            img.src = reader.result;
        });
        reader.readAsDataURL(file);
        return true;
    }
    return false;
}

// Convierte una dataURL en un archivo Blob
function dataURLtoFileBlob(dataURL, fileName = "imagen") {
    let byteString = atob(dataURL.split(",")[1]);
    let mimeString = dataURL.split(",")[0].split(":")[1].split(";")[0];
    let extension  = '.'+ mimeString.split("/")[1]?? "png";
    let ab = new ArrayBuffer(byteString.length);
    let ia = new Uint8Array(ab);
    for (let i = 0; i < byteString.length; i++) {
        ia[i] = byteString.charCodeAt(i);
    }
    return new Blob([ab], { type: mimeString, name: fileName+extension });
}

function dataURLtoFile(dataURL, fileName = "imagen") {
    let blob = dataURLtoFileBlob(dataURL, fileName);
    let name = fileName+'.'+ blob.type.split("/")[1]?? "png";
    return new File([blob], name, {
        type: blob.type,
        lastModified: new Date(),
    });
}

export { selectIconToFile, getExtension, mostrarFile, dataURLtoFile };