@props([
    'id' => 0,
    'imagen' => url('images/gallery/02.jpg'),
    'titulo' => 'SIN TÍTULO',
    'descripcion' => 'Sin Descripcion',
    'bandera' => url('flags/4x3/bo.svg'),
    'videoLink' => false,
    'sector' => 'experiencias',
])

@if ($sector == 'experiencias')
    <article class="product ls vertical-item content-padding rounded overflow_hidden loop-color">
        <div class="item-media">
            <a href="@if ($videoLink) {{ $videoLink }} @endif" class="inline-block">
                <img src="{{ $imagen }}" alt="" srcset="" class="img-experiencias">
            </a>
            <div class="product-buttons">
                <a href="#" onclick="event.preventDefault();incrementarPopularidad({{ $id }})" class="favorite_button">
                    <span class="sr-only">Add to favorite</span>
                </a>
                <a href="#" class="facebook_button">
                    <span class="sr-only">Add to favorite</span>
                </a>
            </div>
            <img class="flag" src="{{ $bandera }}" alt="No">
        </div>
        <div class="item-content">
            <h4 class="entry-title pb-3 topmargin_5"> <a
                    href="@if ($videoLink) {{ $videoLink }} @endif">{{ $titulo }}</a></h4>
            <p class="content-3lines-ellipsis p-2">{{ $descripcion }}</p>
        </div>
    </article>
@endif

@if ($sector == 'autor')
    <article class="author-meta side-item side-md content-padding big-padding with_background rounded overflow_hidden">
        <div class="row">
            <div class="col-md-7">
                <div class="item-media top_rounded overflow_hidden article-img-autor-content">
                    <a href="@if ($videoLink) {{ $videoLink }} @endif">
                        <img src="{{ $imagen }}" alt="" class="article-img-autor">
                    </a>
                </div>
                <div class="product-buttons product-btn">
                    <a href="#" onclick="event.preventDefault();incrementarPopularidad({{ $id }})" class="favorite_button">
                        <span class="sr-only">Add to favorite</span>
                    </a>
                    <a href="#" class="facebook_button">
                        <span class="sr-only">Add to favorite</span>
                    </a>
                </div>
                <img class="flag" src="{{ $bandera }}" alt="No">
            </div>
            <div class="col-md-5">
                <div class="item-content">
                    <header class="entry-header content-justify">
                        <h4 class="bottommargin_0">{{ $titulo }}</h4>
                    </header>
                    <p class="content-3lines-ellipsis">{{ $descripcion }}</p>
                    <a href="@if ($videoLink) {{ $videoLink }} @endif"
                        class="theme_button min_width_button color3" href="#">Ver Video</a>
                </div>
            </div>
        </div>
    </article>
    <script>
        function incrementarPopularidad(id) {
            const video_id = id
            axios.get(`/incrementar-popularidad/${video_id}`)
                .then(response => {
                    console.log(response.data);
                    // Realiza alguna acción con la respuesta
                })
                .catch(error => {
                    console.error(error);
                    // Maneja el error de alguna manera
                });
        }
    </script>
@endif
