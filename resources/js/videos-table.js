import { eliminar } from '../libs/datatables/datatables.default';
var table = $('#videos-table').DataTable( {
    
    ajax: "/videos",
    columns: [
        { data: "id" },
        { data: "titulo" },
        { data: "descripcion", className: "lineas-3", },
        { data: "foto", searchable: false, orderable:false },
        { data: "url" },
        { data: "ods" , className: "lineas-3",},
        { data: "pais_id" },
        { data: "sector_id" },
        { data: "autor_id" },
        { data: "entidad_id" },
        { 
            data: "actions",
            searchable: false,
            orderable: false,
        }
    ],

} ).on('click', 'a.eliminar', function(e){
    e.preventDefault();
    /******* funcion que envia al servidor para eliminar el registro *******/
    eliminar({
        url     : this.dataset.url,
        data    : { id: this.dataset.id },
        table   : table,
    });
});

