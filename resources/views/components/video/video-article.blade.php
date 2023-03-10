@props([
    'imagen'        => url('images/gallery/02.jpg'),
    'titulo'        => 'SIN TÍTULO',
    'descripcion'   => 'Sin Descripcion',
    'bandera'       => url('flags/4x3/bo.svg'),
    'videoLink'     => false,
    'sector'        => 'experiencias',
    ])

@if ($sector == "experiencias")
<article class="product ls vertical-item content-padding rounded overflow_hidden loop-color">
    <div class="item-media">
        <a href="@if ($videoLink) {{$videoLink}} @endif" class="inline-block">
            <img src="{{ $imagen}}" alt="" srcset="" class="img-experiencias">
        </a>
        <div class="product-buttons">
            <a href="#" class="favorite_button">
                <span class="sr-only">Add to favorite</span>
            </a>
            <a href="#" class="facebook_button">
                <span class="sr-only">Add to favorite</span>
            </a>
        </div>
        <img class= "flag" src="{{$bandera}}" alt="No">
    </div>
    <div class="item-content">
        <h4 class="entry-title topmargin_5"> <a href="@if ($videoLink) {{$videoLink}} @endif">{{$titulo}}</a></h4>
        <p class="content-3lines-ellipsis">{{$descripcion}}</p>
    </div>
</article>  
@endif

@if ($sector == "autor")
<article class="post format-small-image">
    <div class="side-item side-md content-padding big-padding with_background rounded overflow_hidden">
        <div class="row">
            <div class="col-md-5">
                <div class="item-media entry-thumbnail"> 
                    <a href="@if ($videoLink) {{$videoLink}} @endif" class="inline-block">
                        <img src="{{ $imagen}}" alt="" srcset="" class="height-100">
                    </a>
                    <div class="product-buttons">
                        <a href="#" class="favorite_button">
                            <span class="sr-only">Add to favorite</span>
                        </a>
                        <a href="#" class="facebook_button">
                            <span class="sr-only">Add to favorite</span>
                        </a>
                    </div>
                    <img class= "flag" src="{{$bandera}}" alt="No">
                </div>
            </div>
            <div class="col-md-7">                
                <div class="padding_30 overflow_hidden">
                    <h3 class="entry-title color2 "> <a href="@if ($videoLink) {{$videoLink}} @endif">{{$titulo}}</a> </h3>
                    <p>{{$descripcion}}</p>
                </div>
            </div>
        </div>
    </div>
</article>
@endif