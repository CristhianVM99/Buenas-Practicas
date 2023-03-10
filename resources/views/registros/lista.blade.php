@extends('layouts.main')
@section('title',"Lista de Proyectos")
@section('content')
    <div class="container">
        <div class="mt-6">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-simple ls table-responsive">
                        <table class="table shop_table cart cart-table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Titulo</th>
                                    <th>Descripcion</th>
                                    <th>Tipo</th>
                                    <th>Autor</th>
                                    <th>E-mail / Tel.</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($proyectos as $proy)
                                    <tr>
                                        <td>{{$proy->id}}</td>
                                        <td>{{$proy->titulo}}</td>
                                        <td>{{$proy->descripcion}}</td>
                                        <td>{{$proy->tipo_de_proyecto()}}</td>
                                        <td>{{$proy->creador->name}}</td>
                                        <td>{{$proy->creador->email}}</td>
                                        <td>{{$proy->estado()}}</td>
                                        <td>
                                            <a href="{{route('registro.edit',[$proy->id])}}">
                                                <i class="fa fa-edit info_color" title="Editar"> Editar</i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection