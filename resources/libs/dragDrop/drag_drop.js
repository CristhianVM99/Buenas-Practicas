import "./drag-drop.css";

/****** EVENT DE DRAG AND DROP ******/

$("article.panel-documentos .drag_drop").click(function(){
    $(this).find("input[type=file]")[0].click();

}).on("dragover", function(e) {
    e.preventDefault();
    $(this).addClass("active");
    $(this).find(".texto").text(`Suelta aquí para cargar la Imagen`);

}).on("dragleave", function(e) {
    $(this).removeClass("active");
    $(this).find(".texto").text(`Arrastra y Suelta la Imagen Relacionada`);

}).on("drop", function(e) {
    e.preventDefault();
    $(this).removeClass("active");
    $(this).find("input[type=file]").prop("files", e.originalEvent.dataTransfer.files);
    //llamando al input type file
    $(this).find("input[type=file]").trigger("change");
    $(this).find(".texto").text(`Arrastra y Suelta la Imagen Relacionada`);

});