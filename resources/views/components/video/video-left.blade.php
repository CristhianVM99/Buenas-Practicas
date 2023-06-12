<style>
    .marco {
        position: relative;
        padding: 8px;
        background-color: white;
        width: 70px;
        box-shadow: 2px 2px 5px 0 rgba(0, 0, 0, 0.5);
    }

    .marco img {}

    .tag {
        background-color: white;
        border-radius: 7px;
        padding: 15px;
        position: relative;
    }

    .tag::before {
        content: '#';
        font-weight: bold;
        color: #182ef5;
    }

    .post-author2 {
        border-radius: 50%;
        display: inline;
    }

    .post-author2 img {
        border: 5px solid rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        max-width: 100%;
    }

    .video-left-title {
        text-align: start;
        font-size: 1.5em;
        font-weight: bold;
    }
</style>

<article class="vertical-item content-padding big-padding with_background post format-chat rounded overflow_hidden">
    <div class="item-media-wrap">
        <div class="item-media">
            <iframe src="{{ $video->url }}" title="YouTube video player" frameborder="0" class="iframe"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
        </div>
        <div class="entry-meta ds content-justify">
            <div class="inline-content big-spacing small-text darklinks"> <span>
                    <i class="fa fa-calendar highlight rightpadding_5" aria-hidden="true"></i>
                    <a href="blog-single-right.html">
                        <time datetime="2017-10-03T08:50:40+00:00">
                            17 jan, 2018</time>
                    </a>
                </span> <span class="categories-links">
                    <i class="fa fa-tags highlight rightpadding_5" aria-hidden="true"></i>

                    <span>{{ $video->pais_id }}</span>
                </span> </div>
            <div> <a href="blog-left.html" class="post-author">
                    <img src="images/faces/11.jpg" alt="">
                </a> </div>
        </div>
    </div>
    <div class="item-content entry-content">
        <div class="col-xs-8">
            <header class="entry-header">
                <h3 class="entry-header video-left-title"> {{ $video->titulo }} </h3>
            </header>
            <!-- .entry-header -->
            <div class="entry-content">
                <p>{{ $video->descripcion }}</p>
            </div>
            <!-- .entry-content -->
        </div>
        <div class="widget widget_recent_posts col-xs-4">
            <h4 class="widget-title">Objetivos de Desarrollo Sostenible</h4>
            <ul class="overflow-y-scroll max-h-[50vh]">

                @foreach ($ods as $item)
                    @if (in_array($item->id, json_decode($video->ods)))
                        <li class="media">
                            <div class="media-left media-middle">
                                <img src="{{ url('img/SDG/' . $item->icon) }}" alt="No">
                            </div>
                            <div class="media-body media-middle">
                                <p class="darklinks">{{ $item->name }} </p>
                            </div>
                        </li>
                    @endif
                @endforeach

            </ul>
        </div>
    </div>
    <!-- eof .item-content -->
</article>

<article
    class="vertical-item content-padding big-padding ds bg_teaser after_cover darkgrey_bg post format-status rounded overflow_hidden">
    <img src="images/gallery/05.jpg" alt="">
    <div class="item-content entry-content text-center">
        <div class="entry-content col-xs-8">
            <h3 class="entry-title"> <a href="{{ route('autor.get', [$video->autor->id]) }}"
                    rel="bookmark">{{ $video->autor->name }}</a> </h3>
            <p>{{ $video->autor->perfil_html }}</p>
        </div>
        <header class="entry-header">
            @if (isset($video->autor) && isset($video->autor->user->avatar))
                <div class="col-xs-4">
                    <a href="{{ route('autor.get', [$video->autor->id]) }}" class="post-author2">
                        <img src="{{ url('storage/' . $video->autor->user->avatar) }}" alt="" class="">
                    </a>
                </div>
            @else
                <img class="avatar round" src="{{ url('images/default-user.png') }}" alt="No Imagen" />
            @endif
        </header>
    </div>
</article>
