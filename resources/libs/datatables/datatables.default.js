import './datatables.default.css';
import Es from './Spanish.json';
import { mostrarToast } from "../toast/toast";
$.extend(true, $.fn.dataTable.defaults, {
    processing: true,
    serverSide: true,
    searchDelay: 2000,
    pageLength: 10,
    resposive: true,
    language: Es,
});

/***** Objeto Eliminar { url, data, datatable } ******/
function eliminar( obj ) {
    axios.post( obj.url, obj.data)
    .then(res=> {
        crearToasts(res.data);
        obj.table.ajax.reload();
    })
    .catch(e=>{
        crearToasts(e.response.data);
    });
}

/******* Objeto de respuesta del server {obj1: {mensaje,class}, objN ...} *****/
function crearToasts( mensajes ) {
    for (const key in mensajes) {
        if (Object.hasOwnProperty.call(mensajes, key)) {
            const element = mensajes[key];
            mostrarToast({ mensaje: element.mensaje, clase: element.class??'success', timer: 7000 });
        }
    }
}

export { eliminar }