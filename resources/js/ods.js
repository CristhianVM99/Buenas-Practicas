import '../css/ods.css';

$(".marco").click( function(){
    $(this).toggleClass( "active" );
});

$("input:checked + .marco").addClass('active');

function list_ods($ods) {
    let list = [];
    $ods.each(function(i,el){
        list.push($(el).data('id'));
    });

    return list;
}

export { list_ods };