let init = () => {
    if(typeof success !== 'undefined' && success){
        mostrarToast({ mensaje: success, clase: 'success'});
    }
    if(typeof danger !== 'undefined' && danger){
        mostrarToast({ mensaje: danger, clase: 'danger'});
    }
    if( typeof warning !== 'undefined' && warning){
        mostrarToast({ mensaje: warning, clase: 'warning'});
    }
    if(typeof error !== 'undefined' && error){
        mostrarToast({ mensaje: error, clase: 'error'});
    }
    if(typeof info !== 'undefined' && info){
        mostrarToast({ mensaje: info, clase: 'info'});
    }
}
$('.mensaje-toast').on('click', '.close', function(){
    $(this).closest('.toast').remove();
}).on('ready', init());

/************ Objeto Toast { mensaje, clase, clase-animation, timer} ****************/
function createToast( objToast){
    let icon = `<i class="fa-solid fa-circle-check"></i>`;
    let toast = document.createElement('div');
    let timer = objToast.timer?? 5000;
    switch (objToast.clase) {
        case 'success':
            icon = `<i class="fa-solid fa-circle-check i_icon"></i>`;
            break;
        case 'danger':
            icon = `<i class="fa-solid fa-triangle-exclamation i_icon"></i>`;
            break;
        case 'warning':
            icon = `<i class="fa-solid fa-circle-exclamation i_icon"></i>`;
            break;
        case 'error':
            icon = `<i class="fa-solid fa-exclamation i_icon"></i>`;
            break;
        case 'info':
            icon = `<i class="fa-solid fa-circle-info i_icon"></i>`;
            break;
    }
    toast.classList.add(
        'toast',
        objToast.clase??' success',         
        objToast.animation_init?? 'slideLeftRight',
        );
    toast.innerHTML = `        
        ${icon}
        ${objToast.mensaje?? 'No se definió un mensaje'}
        <span class="close">✖</span>        
    `;
    if(timer < 10000000){
        setTimeout(() => {
            toast.remove();
        }, timer)
    }
    return toast;
    
}

function mostrarToast( objToast = {} )
{
    $('.mensaje-toast').append( createToast( objToast ) );
}

export { mostrarToast };
