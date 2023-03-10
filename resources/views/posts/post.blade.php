@extends('layouts.main')
@section('meta-head')
<meta property="og:url" content="{{route('post', ['proyecto' =>$proyecto->id])}}" />
<meta property="og:type" content="website" />
<meta property="og:title" content="{{$proyecto->titulo}}" />
<meta property="og:description" content="{{$proyecto->descripcion}}" />
@if(count($archivos->where('tipo', 'imagenes')))
<meta property="og:image" content="{{ url('storage/'.$archivos->where('tipo', 'imagenes')->first()->ruta)}}" />
@endif
{{-- @foreach ($archivos->where('tipo', 'imagenes') as $img)
<meta property="og:image" content="{{ url('storage/'.$img->ruta)}}" />
@endforeach --}}
@endsection
@section('title',"Post")
@section('content')
<div class="main_bg_color background_cover overlay_color">
    <section class="page_subscribe section_padding_top_75 section_padding_bottom_75 table_section table_section_lg">
        <div class="container">
            <div class="row text-center widget-title intro-layer">
                <h2 class="section_header text-uppercase">{{$proyecto->titulo}}</h2>
            </div>
            <div class="row">
                <div class="widget widget_mailchimp">
                    <div class="row">
                        <div class="col-xs-12">
                            <p class="text-justify semibold">
                                {{$proyecto->descripcion}}
                            </p>
                            <br>
                        </div>
                        <div class="col-xs-12 intro-layer">
                            <div class="semibold text-uppercase">Poblacion:</div>
                            <p class="text-justify ml-10">
                                {{$proyecto->poblacion}}
                            </p>
                        </div>
                        <div class="col-xs-12">
                            <div class="semibold text-uppercase">Sector:</div>
                            <p class="text-justify ml-10">
                                {{$proyecto->Sector->name}}
                            </p>
                        </div>
                        <div class="col-xs-12">
                            <div class="semibold text-uppercase">Entidad en la que se realiza la {{$proyecto->tipo_de_proyecto()}}:</div>
                            <p class="text-justify ml-10">
                                {{$proyecto->entidad}}
                            </p>
                        </div>
                        {{-- <div class="col-xs-12 col-md-4">
                            <button type="submit" class="theme_button color2 block_button margin_0">Suscríbete a las Notificaciones</button>
                        </div> --}}
                    </div>
    
                </div>
            </div>
        </div>
    </section>
    <section class="with_background pb-10">
        <div class="container">
            <div class="owl-carousel">
                @foreach ($archivos->where('tipo', 'imagenes') as $image)
                <div class=" to_animate no_appear_delay" data-animation="fadeInDown" data-delay="600">
                    <div class="teaser top_offset_icon text-center marco">
                        <img class="images" src="{{ url('storage/'.$image->ruta)}}" alt="No" srcset="">
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <section>
        <div class="container py-10">
                
            <h5 class="titulo">Documentos</h5>
            <div class="list2 m-10 files">
                @foreach ($archivos->where('tipo', 'documentos') as $doc)
                <div class="flex items-center gap-2 bold" data-id="{{$doc->id}}">
                    <a href="{{ route('documento.get', [$doc->id])}}" target="_blank">
                        @switch(Str::afterLast($doc->name_original??$doc->name, '.'))
                            @case("docx")
                                <i class="rt-icon2-file-word-o text-[30px]"></i>
                                @break
                            @case("doc")
                                <i class="rt-icon2-file-word-o text-[30px]"></i>
                                @break
                            @case("pdf")
                                <i class="rt-icon2-file-pdf-o text-[30px]"></i>
                                @break
                        
                            @default
                                <i class="rt-icon2-file-o text-[30px]"></i>
                        @endswitch
                        {{$doc->name_original??$doc->name}}
                    </a>
                </div> 
                @endforeach
            </div>
            @if ( count(json_decode($proyecto->ods)) > 0)
            <h5 class="titulo">Objetivos de Desarrollo Sostenible</h5>
            <div class="flex flex-wrap gap-3 justify-center">
                @foreach ($proyecto->ODS() as $ods)
                    <div class="marco w-[70px]">
                        <img src="{{ url('img/SDG/'.$ods->icon) }}" alt="No" srcset="{{ url('img/SDG/'.$ods->icon) }}">
                    </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>
</div>
@endsection
@section('scripts-js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/js/post-app.js'])
@endsection