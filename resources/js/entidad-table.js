import '../libs/datatables/datatables.default';
var table = $('#entidad-table').DataTable( {
    
    ajax: "/entidades",
    columns: [
        { data: "id" },
        { data: "name" },
        { 
            data: "logo",
            searchable: false,
            orderable: false,
        },
        { 
            data: "link",
            searchable: false,
            orderable: false,
        },
        { data: "email" },
        { 
            data: "actions",
            searchable: false,
            orderable: false,
        }
    ],

} );

$('#entidad-table').on('click', 'a.eliminar', function(e){
    e.preventDefault();
    axios.post(
        this.dataset.url,
        {id: this.dataset.id},
    ).then( res=>{
        Swal.fire({
            title: res.data + '!',
            icon: 'success',
            showConfirmButton: false,
            timer: 2500,
            showClass: {
                popup: 'to_animate animated fadeIn'
            },
            hideClass: {
                popup: 'to_animate animated fadeOut'
            },
        })
        table.ajax.reload();
    }).catch(e=>{
        Swal.fire({
            icon: 'error',
            title: e.response.data,
            showConfirmButton: false,
            timer: 2500,
            showClass: {
                popup: 'to_animate animated fadeIn'
            },
            hideClass: {
                popup: 'to_animate animated fadeOut'
            },
        });
    });
});