@if ($sectores->first())
    <style>
        .menu-categoria {
            max-height: 300px;
            overflow-y: scroll;
        }

        .flag {
            width: 40px;
            height: 30px;
            position: absolute;
            top: 15px;
            left: 15px;
            overflow: hidden;
            z-index: 2;
        }

        .height-100,
        .owl-stage-outer,
        .owl-stage,
        .owl-item {
            height: 100%;
        }

        .menu-categoria>li.active>a {
            color: #9cc026;
            text-decoration: underline;
            font-weight: 600;
        }

        .menu-categoria>li.active>a::before {
            color: #54be73;
        }

        .menu-categoria>li>a:hover {
            color: #54be73;
            font-weight: 700;
        }

        #experiencias .item-content {
            padding: 20px;
            padding-top: 15px;
        }

        #experiencias .entry-title {
            white-space: nowrap;
            overflow: hidden;
            text-align: center;
            text-overflow: ellipsis;
            text-transform: capitalize;
            border-bottom: transparent solid 2px;
            border-image: linear-gradient(0.4turn, rgba(150, 150, 150, 0), rgba(150, 150, 150), rgba(150, 150, 150, 0));
            border-image-slice: 1;
        }

        @media (min-width: 1200px) {
            #experiencias .img-experiencias {
                height: 200px;
            }
        }

        @media (max-width: 992px) {
            #experiencias .img-experiencias {
                height: 350px;
                object-fit: cover;
            }
        }

        @media (max-width: 768px) {
            #experiencias .img-experiencias {
                height: 220px;
                object-fit: cover;
            }
        }
    </style>
    <section id="experiencias" class="ds parallax page_shop section_padding_top_150 section_padding_bottom_150">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-4">
                    <span class="small-text big highlight4">Area</span>
                    <h2 class="section_header">Selectores</h2>
                    <div class="widget widget_categories topmargin_50">
                        <ul class="greylinks color4 menu-categoria">
                            @foreach ($sectores as $cat)
                                <li>
                                    <a href="javascript:void(0)"
                                        onclick="previewVideos(event, {{ $cat->id }})">{{ $cat->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 col-sm-8">
                    @if ($listVideos->first())
                        <div class="owl-carousel" data-nav="true" data-responsive-lg="3">
                            @foreach ($listVideos as $element)
                                @include('components.video.video-article', [
                                    'id' => $element->id,
                                    'imagen' => url('storage/' . $element->foto),
                                    'titulo' => $element->titulo,
                                    'descripcion' => $element->descripcion,
                                    'bandera' => $element->pais->flag_4x3,
                                    'videoLink' => route('video.ver', [$element->id]),
                                    'sector' => 'experiencias',
                                ])
                            @endforeach
                        </div>
                    @endif
                    @foreach ($sectores as $sector)
                        <div class="owl-carousel hidden" data-sector="{{ $sector->id }}" data-nav="true"
                            data-responsive-sm="2" data-responsive-lg="3">
                            @foreach ($sector->video as $video)
                                @include('components.video.video-article', [
                                    'id' => $video->id,
                                    'imagen' => url('storage/' . $video->foto),
                                    'titulo' => $video->titulo,
                                    'descripcion' => $video->descripcion,
                                    'bandera' => $video->pais->flag_4x3,
                                    'videoLink' => route('video.ver', [$video->id]),
                                    'sector' => 'experiencias',
                                ])
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        </div>
    </section>
    <script>
        function previewVideos(e, sector) {
            e.preventDefault();
            let groupsLinks = e.target.closest('.menu-categoria').children;
            let groupSectors = e.target.closest('#experiencias').querySelectorAll('.owl-carousel');
            for (const item of groupsLinks) {
                item.classList.remove('active');
            }
            e.target.parentNode.classList.add('active');
            groupSectors.forEach(element => {
                if (element.dataset.sector == sector) {
                    if (element.classList.contains('hidden')) {
                        element.classList.remove('hidden');
                    }
                } else {
                    element.classList.add('hidden');
                }

            });
        }
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
