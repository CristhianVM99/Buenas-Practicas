@extends('layouts.main')
@section('title',"Admin/Entidades")
@section("styles-css")
    <link rel="stylesheet" href="{{ url('datatables/datatables.min.css')}}">
@endsection
@section('scripts-js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ url('datatables/datatables.min.js')}}"></script>
    @vite(['resources/js/entidad-table.js'])
@endsection
@section('content')
<section class="card-simple container">
    <div class="row ls">
        <div class="col-sm-12 edit-link">
            <a href="{{route('entidad.crear')}}" class="theme_button color4 min_width_button">Crear Entidad</a>
        </div>
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" style="width:100%" id="entidad-table">
                    <thead class="">
                        <tr>
                            <th class="product-quantity">Id</th>
                            <th class="product-quantity">Nombre</th>
                            <th class="product-quantity">Logo</th>
                            <th class="product-quantity">Link</th>
                            <th class="product-quantity">Email</th>
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