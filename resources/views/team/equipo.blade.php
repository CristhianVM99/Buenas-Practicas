@extends('layouts.main')
@section('title','Equipo')
@section('content')
<style>
    figure.avatar{
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background-color: #dadada;
        overflow: hidden;
        display: inline-block;
    }
    figure.avatar img{
        object-fit: contain;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="isotope_container isotope row masonry-layout columns_margin_bottom_20" style="position: relative; height: 1049px;">
                @foreach ($autores as $autor)
                    <div class="isotope-item col-lg-3 col-md-4 col-sm-6" style="position: absolute; left: 0%; top: 0px;">
                        <article  class="vertical-item content-padding rounded-lg overflow_hidden with_background hover_background ds text-center loop-color">
                            <div class="item-content">
                                <figure class="avatar">
                                    <a href="{{ route('autor.get', [$autor->id]) }}">
                                        @if ($autor->user->avatar)
                                            <img src="{{ url('storage/'.$autor->user->avatar) }}" alt="No Imagen">
                                        @else
                                            <img src="{{ url('images/default-user.png') }}" alt="Default Imagen No">
                                        @endif
                                    </a>
                                </figure>                                
                                <h4 class="entry-title bottommargin_0"><a href="{{ route('autor.get', [$autor->id]) }}">{{ $autor->name }}</a></h4>
                                <span class="small-text highlight">{{ Str::upper( $autor->user->getRoleNames()->implode(',') )}}</span>
                                <p class="content-3lines-ellipsis topmargin_20">{{$autor->perfil_html}}</p>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection