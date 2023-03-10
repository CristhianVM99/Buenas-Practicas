@extends('layouts.main')
@section('title', $autor->name)
@section('content')
<style>
    .videos{
        display: grid;
        grid-template-columns: repeat(
            auto-fit,
            minmax( 290px, 300px)
        );
        gap: 30px;
    }

    figure.avatar{
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background-color: #dadada;
        overflow: hidden;
    }
    figure.avatar img{
        object-fit: contain;
    }
    article .flag{
        width: 40px;
        height: 30px;
        position: absolute;
        top: 15px;
        left: 15px;
        overflow: hidden;
        z-index: 2;
    }
    article .entry-title{
        text-align: center;
        text-transform: capitalize;
        border-bottom: transparent solid 2px;
        padding-bottom: 10px;
        border-image: linear-gradient(0.4turn, rgba(150,150,150,0), rgba(150,150,150), rgba(150,150,150,0));
        border-image-slice: 1;
    }
    article .item-content > p{
        margin: 20px 0;
    }
    article .item-media div{
        text-align: center;
    }
    .autor_title{
        font-weight: bold;
        text-align: center;
        color: #669543;
        letter-spacing: 1px;
    }
</style>

<article class="vertical-item content-padding big-padding ds bg_teaser after_cover darkgrey_bg post format-status rounded overflow_hidden"> <img src="images/gallery/05.jpg" alt="">
    <div class="item-content entry-content text-center">        
        <header class="entry-header">
            @if ($autor->user->avatar)
            <div class="col-xs-4">
                <a href="blog-left.html" class="post-author2">
                   <img src="{{ url('storage/'.$autor->user->avatar) }}" alt="" class="">
                </a>
            </div>
            @else
                <img class="avatar round" src="{{url('images/default-user.png')}}" alt="No Imagen"/>
            @endif
        </header>       
        <div class="entry-content col-xs-8">
            <h3 class="entry-title"> <a href="blog-single-right.html" rel="bookmark">{{$autor->name}}</a> </h3>
            <p>{{$autor->perfil_html}}</p>
        </div>
    </div>
</article>
<section class="page_breadcrumbs parallax ds section_padding_top_40 section_padding_bottom_40">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h2>Videos relacionados</h2>                    
            </div>
        </div>
    </div>
</section>
<div>    
    <div class="row">        
        <div class="padding_40 ls padding_10 overflow_hidden">
            @foreach ($videos as $item)
                @include('components.video.video-article', [
                    'imagen'        => url('storage/'.$item->foto),
                    'titulo'        => $item->titulo,
                    'descripcion'   => $item->descripcion,
                    'bandera'       => url($item->pais->flag_4x3),
                    'videoLink'     => route('video.ver',[$item->id]),
                    'sector'        => 'autor',
                    ]) 
            @endforeach
        </div>
    </div>
</div>
@endsection