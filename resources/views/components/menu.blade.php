<div class="display-flex max-lg:flex-col page_header header_white">
    <!-- login -->
    <div class="self-center lg:order-last max-lg:pt-2 max-lg:pb-2 max-lg:self-stretch max-lg:bg-neutral-100">
        <div class="font-bold text-right text-sm uppercase text-gray-700 mr-3">
            @if( Auth::check() )
            <nav class="">
                <ul class="mr-3">
                    <li class="display-flex items-center dropdown justify-end">
                        <a class="nav-link dropdown-toggle" id="toggle-user-menu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="display-flex items-center">
                                <div class="w-[32px] h-[32px]">
                                    @if (Auth::user()->avatar)
                                        @if ( Str::startsWith( Auth::user()->avatar, ['http://', 'https://']))
                                            <img class="avatar round object-contain" src="{{ Auth::user()->avatar }}" alt=""/>
                                        @else
                                            <img class="avatar round object-contain" src="{{route('profile.get.avatar', [Auth::user()->id])}}" alt=""/>
                                        @endif
                                    @else
                                        <img class="avatar round object-contain" src="{{ url('images/default-user.png')}}" alt=""/>
                                    @endif
                                </div>
                                <span class="inline-block ml-2 mr-1" title="{{Auth::user()->name}}">
                                    <span class="max-lg:hidden">{{ Str::before(Auth::user()->name, ' ')}}</span>
                                    <span class="lg:hidden">{{ Auth::user()->name}}</span>
                                </span>
                                <i class="rt-icon2-triangle-down"></i>
                            </div>
                        </a>
                        {{-- <div ><a class="dropdown-item">A</a></div> --}}
                        <ul class="dropdown-menu dropdown-menu-right mt-3 rounded-lg z-50" aria-labelledby="toggle-user-menu">
                            <li class="dropdown-item border-b-2">
                                <div>
                                    <x-dropdown-link :href="route('profile.edit')" class="pt-5 pb-5">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>
                                    {{-- <a href="{{ route('profile.edit') }}" class="block pt-5">{{ __('Profile') }}</a> --}}
                                </div>
                            </li>
                            @role('admin')
                            <li class="dropdown-item border-b-2">
                                <div>
                                    <x-dropdown-link :href="route('users.list')" class="pt-5 pb-5">
                                        {{ __('Usuarios') }}
                                    </x-dropdown-link>
                                </div>
                            </li>
                            <li class="dropdown-item border-b-2">
                                <div>
                                    <x-dropdown-link :href="route('proyectos.list')" class="pt-5 pb-5">
                                        {{ __('Proyectos') }}
                                    </x-dropdown-link>
                                </div>
                            </li>
                            <li class="dropdown-item border-b-2">
                                <div>
                                    <x-dropdown-link :href="route('video.list')" class="pt-5 pb-5">
                                        {{ __('Videos') }}
                                    </x-dropdown-link>
                                </div>
                            </li>
                            <li class="dropdown-item border-b-2">
                                <div>
                                    <x-dropdown-link :href="route('entidad.list')" class="pt-5 pb-5">
                                        {{ __('Entidades') }}
                                    </x-dropdown-link>
                                </div>
                            </li>
                            @endrole
                            <li class="dropdown-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
        
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();" class="pt-5 pb-5">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            @else
                <div class="mr-1">
                    <a href=" {{route('login')}} " class="theme_button min_width_button color3 mb-0">
                        {{-- <i class="fa fa-user"></i> --}}
                        <span class="">{{ __('Login') }}</span>
                    </a>
                </div>
            @endif
        </div>
    </div>
    <header class="toggler_right">
        <div class="row">
            <div class="col-sm-12 display_table">
                <div class="header_left_logo display_table_cell">
                    <a href="{{route('home')}}" class="logo logo_with_text">
                        <img src="{{ url('images/Logo-PP.png')}}" alt="" class="inline-block">
                        <span class="inline-block font-semibold text-[30px] align-middle leading-[1.1] ml-0">
                            {{ config('app.name')}}
                            <small class="block text-[10px] uppercase">para el desarrollo de gobiernos locales</small>
                        </span>
                    </a>
                </div>
                <div class="header_mainmenu display_table_cell text-right">
                    <!-- main nav start -->
                    <nav class="mainmenu_wrapper pr-3">
                        <ul class="mainmenu nav sf-menu">
                            <li class="">
                                <a href=" {{route('team')}}">Equipo</a>
                            </li>
                            <li>
                                <a href="{{route('home')}}#biblioteca">Biblioteca</a>
                            </li>
                            <li>
                                <a href="{{route('mapa')}}">Mapa</a>
                            </li>
                            <!-- eof pages -->
                            <li>
                                <a href="{{route('home')}}#experiencias">Experiencias</a>
                            </li>
                            <li>
                                <a href="{{route('home')}}#buenas_practicas">Buenas Practicas</a>
                            </li>
                            <!-- eof features -->
                            <!-- blog -->
                            <li>
                                <a href="{{route('home')}}#ideas">Ideas</a>
                            </li>
                        </ul>
                    </nav>
                    <!-- header toggler -->
                    <span class="toggle_menu max-[991px]:mr-6 z-20"><span>
                </div>
            </div>
        </div>
    </header>
</div>