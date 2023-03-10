const imagesErrors = ( )=>{
    document.querySelectorAll('img').forEach(img => {
        img.onerror = defaultAvatarLoaded;
    });
}

let defaultAvatarLoaded = function( event ){
    console.log(this);
    if(this.alt)
        console.log(this.alt);
    else
        console.log('La Imagen no pudo ser Cargada ...');
    console.log('Se cargara la imagen por Defecto');
    this.src = 'images/default-user.png';
}

export { imagesErrors }