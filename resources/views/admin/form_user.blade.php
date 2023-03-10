@extends('layouts.main')
@section('title',"Admin/Crear Usuario")
@section('content')
    <section class="container">
        <form method="POST" action="{{ route('users.create') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-simple ">
                <div class="row">
                    <!-- Avatar -->
                    <div class="col-sm-6 mt-4">
                        <label for="avatar">Avatar :</label>
                        <article class="panel-documentos ml-4">
                            <div class="drag_drop relative">
                                <i class="rt-icon2-image"></i>
                                <div class="texto z-10">Arrastra y Suelta la Imagen Relacionada</div>
                                <input class="hidden" id="avatar" name="avatar" type="file" accept=".png,.jpeg,.gif,.jpg">
                                @if (isset($registro))
                                    <img class="object-cover absolute h-full " src="{{url('storage/'.$registro->avatar)}}" alt="{{$registro->avatar}} No Encontrada" srcset="">
                                @else
                                    <img class="object-cover absolute h-full hidden" src="" alt="Sin Imagen" srcset="">   
                                @endif
                            </div>
                        </article>
                        <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
                    </div>
                    <!-- Name -->
                    <div class="col-sm-6 mt-4">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <!-- Email Address -->
                    <div class="col-sm-6 mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <!-- Telefono -->
                    <div class="col-sm-6 mt-4">
                        <x-input-label for="telefono" :value="__('Telf. o Cel.')" />
                        <x-text-input id="telefono" class="block mt-1 w-full" type="text" name="telefono" :value="old('telefono')" />
                        <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                    </div>
                </div>
                <div class="row">
                    
                </div>
                <div class="row">
                    <!-- Pais -->
                    <div class="col-sm-6 mt-4">
                        <x-input-label for="pais" :value="__('Country')" />
                        <x-select id="pais" class="block w-full" name="pais">
                            <option value="" selected disabled hidden>{{ __('Select country') }}</option>
                            @foreach ( $paises as $pais )
                                <option value="{{ $pais->code }}">
                                    {{$pais->name}}
                                </option>
                            @endforeach
                        </x-select>
                        <x-input-error :messages="$errors->get('pais')" class="mt-2" />
                    </div>
                    <!-- Rol -->
                    <div class="col-sm-6 mt-4">
                        <x-input-label for="rol" :value="__('Rol')" />
                        <x-select id="rol" class="block w-full" name="rol">
                            <option value="" selected disabled hidden>{{ __('Seleccione Rol') }}</option>
                            @foreach ( $roles as $rol )
                                <option value="{{ $rol->id }}">
                                    {{ Str::title($rol->name)}}
                                </option>
                            @endforeach
                        </x-select>
                        <x-input-error :messages="$errors->get('rol')" class="mt-2" />
                    </div>
                </div>
                <div class="row colapse" id="autor"></div>
                <div class="row">
                    <!-- Password -->
                    <div class="col-sm-6 mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div class="col-sm-6 mt-4">
                        <br>
                        <div class="flex justify-center gap-8">
                            <button class="min_width_button theme_button color4" type="submit">
                                {{ __('Crear') }}
                            </button>
                            <a href="{{route('users.list')}}" class="cancelar cursor-pointer theme_button min_width_button danger_bg_color">
                                <span class="media-name">{{ __("Salir")}}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <template id="template-autor">
        <div class="col-sm-6">
            <div class="col-12">
                <x-input-label for="seudonimo" :value="'Nombre de Autor o Seudónimo'" />
                <x-text-input id="seudonimo" class="w-full" name="seudonimo" type="text" placeholder="Si el Campo está vacío, Se copiará del campo Nombre."/>
            </div>
            <div class="col-12">
                <x-input-label for="tipo" :value="'Tipo de Autor'" />
                <x-text-input id="tipo" class="w-full" name="tipo" type="text" placeholder="Describa el Tipo de Autor."/>
            </div>
        </div>
        <div class="col-sm-6 wrap-forms">
            <div class="form-group">
                <x-input-label for="perfil_html" :value='"Perfil HTML"' />
                <x-text-area class="w-full" id="perfil_html" name="perfil_html" placeholder="Describa el Perfil del Autor">
                    {{ old("perfil_html") }}
                </x-text-area>
            </div>
        </div>
    </template>
      <!-- Modal -->
<div class="modal" id="modal_image" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-xl">
            <div class="modal-header flex">
                <h5 class="modal-title text-sm font-bold grow ml-[10px]" id="modalLabel">{{__("Crop Image Before Change")}}</h5>
                <a class="cursor-pointer self-start danger_color hover:scale-110 hover:text-red-700" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-close"></i>
                </a>
            </div>
            <div class="modal-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <img src="{{url('/images/gallery/02.jpg')}}" alt="" id="crop_image">
                    </div>
                    <div class="col-md-4">
                        <div class="preview round w-[160px] h-[160px] m-[10px] border border-red-500 overflow-hidden"></div>
                    </div>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <a class="cursor-pointer theme_button min_width_button color2 " id="crop">{{__("Crop")}}</a>
                <a class="cursor-pointer theme_button min_width_button danger_bg_color" data-dismiss="modal">{{__("Close")}}</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts-js')
<script src="{{url('js/cropper.min.js')}}"></script>
    @vite(['resources/js/admin-user-form.js'])
@endsection
@section("styles-css")
    <link rel="stylesheet" href="{{url('css/cropper.min.css')}}" />
@endsection