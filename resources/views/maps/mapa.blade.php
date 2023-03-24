@extends('layouts.main')
@section('title', 'Mapa')
@section('content')
    <style>

    </style>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <section class="ls">
                    <!-- marker description and marker icon goes here -->
                    <div id="mapid" style="height: 500px;width: 100%;" class="container margin-bottom-20"></div>
                </section>
                <h2>LISTA VIDEOS</h2>
                <ul>
                    @foreach ($listaIdeasProyecto as $element)                        
                        <li>{{ $element['lat'] }}</li>
                        <li>{{ $element['long'] }}</li>
                        <li>{{ $element['proyecto']->ciudad }}</li>
                    @endforeach
                </ul>
                <h2>LISTA DE CIUDADES LAT Y LONG</h2>                
            </div>
        </div>
    </div>
    <script></script>
@endsection
