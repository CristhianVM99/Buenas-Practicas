<style>
.marco {
    position: relative;
    padding: 8px;
    background-color: white;
    width: 70px;
    box-shadow: 2px 2px 5px 0 rgba(0, 0, 0, 0.5);
}
.marco img {
}
.tag
{
    background-color: white;
    border-radius: 7px;
    padding: 15px;
    position: relative;
}
.tag::before{
    content: '#';
    font-weight: bold;
    color: #182ef5;
}
.post-author2{
    border-radius: 50%;
    display: inline;
}
.post-author2 img {
    border: 5px solid rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    max-width: 100%;
}
</style>

<article class="vertical-item content-padding big-padding with_background rounded overflow_hidden post format-standard ">
    <div class="item-media-wrap">
        <div class="item-media entry-thumbnail">
            <iframe src="{{$video->url}}" title="YouTube video player" frameborder="0" class="iframe"  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
    @if ($video->ods)
    <div class="padding_30 rightpadding_5 col-sm-3 darkgrey_bg ls  vertical-center">
        <h4 class="entry-title toppadding_30 mt-5 mb-5 ">ODS</h4>
        <div class="flex gap-2 flex-row scroll-icon">
            @foreach ( $ods as $item)
                @if (in_array($item->id, json_decode($video->ods)))
                    <span class="marco">
                        <img src="{{url('img/SDG/'.$item->icon)}}" alt="No">
                    </span>                    
                @endif
            @endforeach
        </div>
    </div>
    @endif
    <div class="item-content col-sm-9">
        <header class="entry-header">
            <h3 class="entry-title"> {{$video->titulo}} </h3>
        </header>
        <div class="entry-content">
            <p>{{$video->descripcion}}</p>
        </div>
    </div>
</article>

<article class="vertical-item content-padding big-padding ds bg_teaser after_cover darkgrey_bg post format-status rounded overflow_hidden"> <img src="images/gallery/05.jpg" alt="">
    <div class="item-content entry-content text-center">
        <div class="entry-content col-xs-8">
            <h3 class="entry-title"> <a href="{{ route('autor.get', [$video->autor->id]) }}" rel="bookmark">{{$video->autor->name}}</a> </h3>
            <p>{{$video->autor->perfil_html}}</p>
        </div>
        <header class="entry-header">
            @if ( isset($video->autor) && isset($video->autor->user->avatar))
            <div class="col-xs-4">
                <a href="{{ route('autor.get', [$video->autor->id]) }}" class="post-author2">
                   <img src="{{url('storage/'.$video->autor->user->avatar)}}" alt="" class="">
                </a>
            </div>
            @else
                <img class="avatar round" src="{{url('images/default-user.png')}}" alt="No Imagen"/>
            @endif
        </header>       
    </div>
</article>