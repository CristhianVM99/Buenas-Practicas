@extends('layouts.main')
@section('title', $autor->name)
@section('content')
    <style>
        .videos {
            display: grid;
            grid-template-columns: repeat(auto-fit,
                    minmax(290px, 300px));
            gap: 30px;
        }

        figure.avatar {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background-color: #dadada;
            overflow: hidden;
        }

        figure.avatar img {
            object-fit: contain;
        }

        article .flag {
            width: 40px;
            height: 30px;
            position: absolute;
            top: 15px;
            left: 15px;
            overflow: hidden;
            z-index: 2;
        }

        article .entry-title {
            text-align: center;
            text-transform: capitalize;
            border-bottom: transparent solid 2px;
            padding-bottom: 10px;
            border-image: linear-gradient(0.4turn, rgba(150, 150, 150, 0), rgba(150, 150, 150), rgba(150, 150, 150, 0));
            border-image-slice: 1;
        }

        article .item-content>p {
            margin: 20px 0;
        }

        article .item-media div {
            text-align: center;
        }

        .autor_title {
            font-weight: bold;
            text-align: center;
            color: #669543;
            letter-spacing: 1px;
        }

        .aurtor-title-description {
            font-weight: bold;
            text-align: center;
            font-size: 2.5em;
        }
        .aurtor-title-videos{
            font-weight: bold;
            text-align: center;
            font-size: 2.5em;
            padding: 20px 0px;
            padding-top: 40px;
        }
        .article-img-autor-content{            
            height: 100%;
        }
        .article-img-autor{
            height: 100%;
            object-fit: cover
        }
        .product-btn{
            z-index: 100;
        }
    </style>
    <section class="ls section_padding_bottom_100 columns_padding_30">
        <div class="container">
            <div class="row">
                <div class="col-sm-5 col-md-4 col-lg-3">
                    <article
                        class="vertical-item content-padding rounded overflow_hidden with_background hover_background ds text-center loop-color">
                        <div class="item-content">
                            @if ($autor->user->avatar)
                                <img src="{{ url('storage/' . $autor->user->avatar) }}" alt="" class="round">
                            @else
                                <img class="avatar round" src="{{ url('images/default-user.png') }}" alt="No Imagen" />
                            @endif
                            <h4 class="entry-title bottommargin_0">{{ $autor->name }}</h4> <span
                                class="small-text highlight">{{ $autor->tipo }}</span>
                        </div>
                    </article>
                </div>
                <div class="col-sm-7 col-md-8 col-lg-9">
                    <blockquote class="with_padding big-padding with_background rounded">
                        <h3 class="aurtor-title-description">Biografia Autor</h3>
                        {{ $autor->perfil_html }}
                        <div class="item-meta">
                            <h5>{{ $autor->name }}</h5> <span class="small-text highlight">{{ $autor->tipo }}</span>
                        </div>
                    </blockquote>
                    <p><h3 class="aurtor-title-videos">Videos Relacionados</h3></p>
                    <div class="row overflow-y-scroll max-h-[200vh]">
                        <div class=" ls p-4 overflow_hidden">
                            @foreach ($videos as $item)
                                @include('components.video.video-article', [
                                    'id' => $item->id,
                                    'imagen' => url('storage/' . $item->foto),
                                    'titulo' => $item->titulo,
                                    'descripcion' => $item->descripcion,
                                    'bandera' => url($item->pais->flag_4x3),
                                    'videoLink' => route('video.ver', [$item->id]),
                                    'sector' => 'autor',
                                ])
                            @endforeach                            
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
