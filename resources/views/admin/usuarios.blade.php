@extends('layouts.main')
@section('title',"Admin/Usuarios")
@section('content')
    <section class="card-simple container">
        <div class="row ls">
            <div class="col-sm-12 edit-link">
                <a href="{{route('users.store')}}" class="theme_button color4 min_width_button">Crear Usuario</a>
            </div>
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" style="width:100%" id="user-table">
                        <thead>
                            <tr>
                                <td class="product-quantity">Id</td>
                                <td class="product-quantity">Nombre</td>
                                <td class="product-quantity">Rol</td>
                                <td class="product-quantity">Email</td>
                                <td class="product-quantity">Telefono</td>
                                <td class="product-info">Nacionalidad</td>
                                <td class="product-remove">Acciones</td>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
@section("styles-css")
    <link rel="stylesheet" href="{{ url('datatables/datatables.min.css')}}">
@endsection
@section('scripts-js')
<script src="{{ url('datatables/datatables.min.js')}}"></script>
    @vite(['resources/js/admin-user-table.js'])
@endsection