@extends('layouts.main')
@section('title',"Registros")
@section('content')
    <div class="container">
        <div class="mt-6">
            <div class="card-simple">
                @include('registros.formulario')
                <div class="mt-6">
                    @include('registros.ods')
                </div>
                <div class="mt-6">
                    <h5 class="titulo">Documentos</h5>
                    @if(!isset($registro))
                        <h6 class="subtitulo">
                            <span class="info_color">Los archivos se cargarán al momento de guardar el formulario</span>
                        </h6>
                    @endif
                    <div class="row">
                        <div class="col-sm-6">@include('registros.fotografias')</div>
                        <div class="col-sm-6">@include('registros.documentos')</div>
                    </div>
                </div>
                @if(isset($registro))
                @role('admin')
                <div class="mt-4">
                    <div class="row">
                        <div class="col-12">
                            <label class="cont font-medium text-sm text-gray-700">
                                Estado:
                                <input type="checkbox" id="estado" @checked($registro->aprobacion)>
                                <span>{{$registro->estado()}}</span>
                            </label>
                        </div>
                    </div>
                </div>
                @endrole
                @endif
                <div class="mt-4">
                    <!-- Buttons -->
                    <div class="row">
                        <div class="col-12 text-right">
                            <button type="submit" id="guardar" class="theme_button min_width_button color4 cursor-pointer" form="registro">
                                <span class="left-icon">
                                    <i class="apsc-post fa fa-edit"></i>
                                </span>
                                <span class="media-name">{{ __("Save")}}</span>
                            </button>
                            <a href="{{route('profile.edit')}}" class="cancelar cursor-pointer theme_button min_width_button danger_bg_color">
                                <span class="media-name">{{ __("Salir")}}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts-js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/js/registro-app.js'])
@endsection