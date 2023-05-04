@extends('layouts.main')
@section('title', 'Mapa')
@section('content')
    <style>

    </style>

    <div id="mapid" class="margin-bottom-20"></div>
    <div id="sidebar">
        <h1>leaflet-sidebar</h1>
    </div>
    <script>
        var datos = @json($listaIdeasProyecto);
        var documentos = @json($documentos);
        var paises = @json($paises);
        var categorias = @json($ods);
        var sectores = @json($sectores)
    </script>    
@endsection
