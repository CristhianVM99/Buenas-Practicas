@extends('layouts.main')
@section('title',"Admin/Entidad")
{{-- @section("styles-css")
    <link rel="stylesheet" href="{{ url('datatables/datatables.min.css')}}">
@endsection --}}
@section('scripts-js')
    @vite(['resources/js/entidad-app.js'])
@endsection
@section('content')
<section class="container">
    <div class="card-simple">
        @if (isset($entidad))
        <form action="{{route('entidad.update', $entidad->id)}}" method="POST">    
        @else
        <form action="{{route('entidad.store')}}" method="POST">    
        @endif
            @csrf
            <div class="row ls">
                <div class="col-sm-12">
                    <label for="name" class="flex items-center gap-8">
                        <span class="inline-block w-[90px] text-right">Nombre *: </span>
                        <input type="text" class="grow" id="name" name="name" @isset($entidad)value="{{old('name', $entidad->name)}}" @endisset placeholder="Escriba Aquí ..." required>
                    </label>
                </div>
                <div class="col-sm-12">
                    <label for="email"  class="flex items-center gap-8">
                        <span class="inline-block w-[90px] text-right">Email : </span>
                        <input type="email" class="grow" id="email" name="email" @isset($entidad)value="{{old('email', $entidad->email)}}" @endisset placeholder="Escriba Aquí ...">
                    </label>
                </div>
                <div class="col-sm-12">
                    <label for="link"  class="flex items-center gap-8">
                        <span class="inline-block w-[90px] text-right">Link : </span>
                        <input type="url" class="grow" id="link" name="link" @isset($entidad)value="{{old('link', $entidad->link)}}" @endisset placeholder="https://ejemplo.com">
                    </label>
                </div>
                <div class="col-sm-12">
                    <label for="logo"  class="flex items-center gap-8">
                        <span class="inline-block w-[90px] text-right">Logo : </span>
                        <input type="url" class="grow" id="logo" name="logo" @isset($entidad)value="{{old('logo', $entidad->logo)}}" @endisset placeholder="https://ejemplo.com">
                    </label>
                </div>
                <div class="col-sm-12 flex justify-end gap-4">
                    <button class="theme_button color4" type="submit">Guardar</button>
                    <a href="{{route('entidad.list')}}" class="theme_button danger_bg_color">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection