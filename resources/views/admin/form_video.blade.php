@extends('layouts.main')
@section('title',"Admin/Video")
@section('scripts-js')
    @vite(['resources/js/video-app.js'])
@endsection
@section('content')
<section class="container">
    <div class="card-simple">
        @if (isset($video))
        <form action="{{route('video.update', $video->id)}}" method="POST" enctype="multipart/form-data">    
        @else
        <form action="{{route('video.store')}}" method="POST" enctype="multipart/form-data">    
        @endif
            @csrf
            <div class="row ls">
                <div class="col-sm-12">
                    <label for="titulo" class="">Título *:</label>
                    <input type="text" class="ml-4 w-full" id="titulo" name="titulo" 
                    @if (isset($video)) value="{{$video->titulo}}"
                    @else value="{{old('titulo')}}" @endif  
                    placeholder="Escriba Aquí ..." required>
                    <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
                </div>
                <div class="col-sm-12">
                    <label for="descripcion" class="">Descripcion *:</label>
                    <textarea class="block rounded-md border-gray-300 ml-4 mt-2 w-full h-auto" name="descripcion" id="descripcion" rows="3" placeholder="Escriba Aquí ..." required>@if(isset($video)) {{$video->descripcion}} @else {{old('descripcion')}} @endif</textarea>
                    <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                </div>
                <div class="col-sm-6">
                    <div>
                        <label for="foto">Foto :</label>
                        <article class="panel-documentos ml-4">
                            <div class="drag_drop relative">
                                <i class="rt-icon2-image"></i>
                                <div class="texto z-10">Arrastra y Suelta la Imagen Relacionada</div>
                                <input class="hidden" id="foto" type="file" name="foto" accept=".png,.jpeg,.gif,.jpg">
                                @if (isset($video))
                                    <img class="object-cover absolute h-full " src="{{url('storage/'.$video->foto)}}" alt="{{$video->foto}} No Encontrada" srcset="">
                                    
                                @else
                                    
                                @endif
                                <img class="object-cover absolute h-full hidden" src="" alt="Sin Imagen" srcset="">
                            </div>
                        </article>
                        <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                    </div>
                    <div class="pr-4">
                        <label for="url"  class="">Url *:</label>
                        <input type="url" class="ml-4 w-full" id="url" name="url" 
                            @if (isset($video)) value="{{$video->url}}"
                            @else value="{{old('url')}}" @endif 
                        required placeholder="https://youtube.com">
                        <x-input-error :messages="$errors->get('url')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-4" >
                        <label for="autor_id">Autor :</label>
                        <div class="select-group ml-4">
                            <select name="autor_id" id="autor_id" class="form-control">
                                <option value="" disabled @selected(!isset($video->autor_id))>Seleccione Autor...</option>
                                @foreach ($autores as $autor)
                                    <option value="{{$autor->id}}" @selected(isset($video->autor_id) && $autor->id == $video->autor_id)>
                                        {{ $autor->name }}
                                    </option>
                                @endforeach
                            </select>
                            <i class="fa fa-angle-down theme_button color1 no_bg_button mr-2"></i>
                        </div>
                        <x-input-error :messages="$errors->get('autor_id')" class="mt-2" />
                    </div>
                    <div class="mb-4" >
                        <label for="entidad_id">Entidad :</label>
                        <div class="select-group ml-4">
                            <select name="entidad_id" id="entidad_id" class="form-control">
                                <option value="" disabled @selected(!isset($video->entidad_id))>Selecciona Entidad...</option>
                                @foreach ($entidades as $item)
                                    <option value="{{$item->id}}" @selected(isset($video->entidad_id) && $item->id == $video->entidad_id)>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            <i class="fa fa-angle-down theme_button color1 no_bg_button mr-2"></i>
                        </div>
                        <x-input-error :messages="$errors->get('entidad_id')" class="mt-2" />
                    </div>
                    <div class="mb-4" >
                        <label for="sector_id">Sector :</label>
                        <div class="select-group ml-4">
                            <select name="sector_id" id="sector_id" class="form-control">
                                <option value="" disabled @selected(!isset($video->sector_id))>Seleccione Sector...</option>
                                @foreach ($sectores as $sector)
                                    <option value="{{$sector->id}}" @selected(isset($video->sector_id) && $sector->id == $video->sector_id)>
                                        {{ $sector->name }}
                                    </option>
                                @endforeach
                            </select>
                            <i class="fa fa-angle-down theme_button color1 no_bg_button mr-2"></i>
                        </div>
                        <x-input-error :messages="$errors->get('sector_id')" class="mt-2" />
                    </div>
                    <div class="mb-4" >
                        <label for="pais_id">Nacionalidad :</label>
                        <div class="select-group ml-4">
                            <select name="pais_id" id="pais_id" class="form-control">
                                <option value="" disabled @selected(!isset($video->pais_id))>{{__("Select country")}}...</option>
                                @foreach ($paises as $pais)
                                    <option value="{{$pais->code}}" @selected(isset($video->pais_id) && $pais->code == $video->pais_id)>
                                        {{ $pais->name }}
                                    </option>
                                @endforeach
                            </select>
                            <i class="fa fa-angle-down theme_button color1 no_bg_button mr-2"></i>
                        </div>
                        <x-input-error :messages="$errors->get('pais_id')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12">
                    {{-- ODSRESR --}}
                    <h5 class="titulo">Objetivos de Desarrollo Sostenible</h5>
                    <div class="row ods">
                        <h6 class="subtitulo">
                            <span class="alert-info p-[10px] rounded-[5px]" style="border-left:7px solid blue;">Elija los Objetivos de Desarrollo Sostenible Relacionados con su video</span>
                        </h6>
                        <div class="col-xs-12 flex flex-wrap gap-3">
                            @foreach ( $ods as $item)
                                <div>
                                    <input class="hidden" type="checkbox" name="ods[]" id="ods_{{$item->id}}" value="{{$item->id}}" @checked( isset($video->ods) && in_array($item->id, json_decode($video->ods)) )>
                                    <label class="marco w-[90px] cursor-pointer" data-id="{{$item->id}}" for="ods_{{$item->id}}">
                                        <img src="{{ url('img/SDG/'.$item->icon) }}" alt="No" srcset="{{ url('img/SDG/'.$item->icon) }}">
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 flex justify-end gap-4">
                    <button class="theme_button color4" type="submit">Guardar</button>
                    <a href="{{route('video.list')}}" class="theme_button danger_bg_color">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection