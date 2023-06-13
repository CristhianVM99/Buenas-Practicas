<style>
    .media a img {
        width: 100px;
    }
</style>
<footer
    class="page_footer ds section_padding_top_75 section_padding_bottom_65 columns_padding_25 columns_margin_bottom_30">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="widget widget_text">
                    <a href="./" class="logo logo_with_text bottommargin_30">
                        <img src="{{ url('images/Logo-PP.png') }}" alt="" class="inline-block">
                        <span class="logo_text">
                            {{ config('app.name') }}
                            <small>para el desarrollo de gobiernos locales</small>
                        </span>
                    </a>
                    <p class="text-justify">
                        Compartimos proyectos exitosos, buenas prácticas e ideas de proyectos para mejorar la calidad de
                        vida en los gobiernos locales. Ofrecemos recursos y herramientas. ¡Visítanos y únete a nuestra
                        comunidad!
                    </p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="col-lg-12 col-md-4 col-sm-6 text-center text-sm-left">
                    <div class="widget widget_recent_posts">
                        <h4 class="widget-title">Videos Recientes</h4>
                        <ul>
                            @if($sectores->first())
                            <li class="media">
                                <div class="media-left media-middle"> <img src="https://previews.123rf.com/images/ksena32/ksena321710/ksena32171000413/87933208-fondo-de-confeti-de-peque%C3%B1as-estrellas-de-colores.jpg" alt=""> </div>
                                <div class="media-body media-middle">
                                    <p class="darklinks"> 
                                        <a href="blog-single-left.html">Rump groud round shan bacon chop.</a> 
                                    </p> 
                                    <span class="small-text highlightlinks"></span> 
                                </div>
                            </li>
                            <li class="media">
                                <div class="media-left media-middle"> <img src="https://previews.123rf.com/images/ksena32/ksena321710/ksena32171000413/87933208-fondo-de-confeti-de-peque%C3%B1as-estrellas-de-colores.jpg" alt=""> </div>
                                <div class="media-body media-middle">
                                    <p class="darklinks"> 
                                        <a href="blog-single-left.html">Rump groud round shan bacon chop.</a> 
                                    </p> 
                                    <span class="small-text highlightlinks"></span> 
                                </div>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="text-sm-left text-center">
                <p class="small-text">&copy; Copyright 2022. All Rights Reserved.</p>
            </div>
        </div>
    </div>
</footer>
