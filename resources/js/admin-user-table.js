import '../libs/datatables/datatables.default';
import { eliminar } from '../libs/datatables/datatables.default';
var table = $('#user-table').DataTable( {
    
    ajax: "/users/datatable",
    columns: [
        { data: "id" },
        { data: "name" },
        { 
            // data: "roles.name",
            // name: "roles",
            render: function ( data, type, row, meta ) {
                return row.roles? row.roles.map( $item=> $item.name).toString(): "";
            },
            searchable: false,
        },
        { data: "email" },
        { 
            data: "telefono",
        },
        { 
            data: "pais.name", 
            render: function ( data, type, row, meta ) {
                return row.pais? row.pais.name: "";
            },
        },
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