@extends('layouts.main')
@section('title',"Admin/Videos")
@section("styles-css")
    <link rel="stylesheet" href="{{ url('datatables/datatables.min.css')}}">
@endsection
@section('scripts-js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ url('datatables/datatables.min.js')}}"></script>
    @vite(['resources/js/videos-table.js'])
@endsection
@section('content')
<section class="card-simple container">
    <div class="row ls">
        <div class="col-sm-12 edit-link">
            <a href="{{route('video.crear')}}" class="theme_button color4 min_width_button">Crear Video</a>
        </div>
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" style="width:100%" id="videos-table">
                    <thead class="">
                        <tr>
                            <th class="product-quantity">Id</th>
                            <th class="product-quantity">Titulo</th>
                            <th class="product-quantity">Descripcion</th>
                            <th class="product-quantity">Foto</th>
                            <th class="product-quantity">Url</th>
                            <th class="product-quantity">ODS</th>
                            <th class="product-quantity">Pais</th>
                            <th class="product-quantity">Sector</th>
                            <th class="product-quantity">Autor</th>
                            <th class="product-quantity">Entidad</th>
                            <th class="product-remove">Acciones</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection