import '../libs/datatables/datatables.default';
$('#user-table').DataTable( {
    dom: 'Bftip',
    ajax: "/registros",
    columns: [
        { data: "id" },
        { 
            data: "tipo",
            searchable: false,
        },
        { data: "titulo" },
        { data: "descripcion" },
        { 
            data: "aprobacion",
            render: function ( data, type, row, meta ) {
                let className = row.aprobacion == 'Aprobado'?'text-success':'text-danger';
                return `<strong class="${className}">${row.aprobacion}</strong>`;
            },
            searchable: false,
        },
        { 
            data: "actions",
            searchable: false,
            orderable: false,
        }
    ],
    buttons: [{
        text: `
            <a href='/registro/new' class='theme_button min_width_button color4'>
            <span class="left-icon">
                <i class="apsc-post fa fa-plus"></i>
            </span>
                <span class="media-name pl-2">Crear</span>
            </a>`,
        title: "Crea Nuevo Usuario",
        action: function ( e, dt, node, config ) {
            window.location.href = "/registro/new";
        },
    }],

} );