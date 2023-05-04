<section class="ls page_portfolio section_padding_top_50">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="isotope_container isotope row masonry-layout columns_margin_bottom_20">
                    <div class="isotope-item col-md-3 col-sm-4">
                        <article class="vertical-item content-padding rounded-xl overflow_hidden with_background hover_background text-center loop-color">
                            <div class="item-content"> 
                                <div class="item-media">
                                    <a id="user-camera" class="cursor-pointer" title="{{ __('Upload photo')}}">
                                        <div class="item-media inline-block round">
                                            @if (Auth::user()->avatar)
                                                @if ( Str::startsWith( Auth::user()->avatar, ['http://', 'https://']))
                                                    <img class="avatar" src="{{  Auth::user()->avatar }}" alt="El link de la imagen No se ha cargado"/>   
                                                @else
                                                    <img  class="avatar" src="{{route('profile.get.avatar', [Auth::user()->id])}}" alt="{{Auth::user()->avatar}} No Encontrada"/>   
                                                @endif
                                            @else
                                                <img class="avatar" src="{{url($imgDefault)}}" alt="La Imagen por Defecto No Encontrada"/>   
                                            @endif
                                            <div class="media-links">
                                                <div class="links-wrap links-wrap2">
                                                    <span class="lightgrey">
                                                        <i class="fa fa-camera"></i>
                                                        <div class="toppadding_20 fontsize_12">{{ __('Upload photo')}}</div>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <input class="hidden" id="avatar" name="avatar" type="file" accept="image/png, image/jpeg" data-user="{{Auth::user()->id}}"/>
                                </div>
                                <br>
                                <h4 class="entry-title bottommargin_0">
                                    {{ Auth::user()->name }}
                                </h4> 
                                <span class="small-text highlight">{{Str::upper( Auth::user()->getRoleNames()->implode(' - '))}}</span>
                            </div>
                        </article>
                    </div>
                    <div class="col-md-9 col-sm-8 ">
                        <form method="POST" action="{{route('profile.update')}}" id="update-user">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="flex items-center gap-8" for="user">
                                        <span class="w-[75px]" >{{ __("Name") }}* :</span>
                                        <input id="user" type="text" disabled value="{{  old('name', Auth::user()->name) }}" name="name" class=" grow" placeholder="Escriba Aquí..." required/>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="flex items-center gap-8" for="email">
                                        <span class="w-[75px]">{{ __("E-mail") }}* :</span>
                                        <input id="email" type="email" disabled value="{{  old('email', Auth::user()->email) }}" name="email" class="grow" placeholder="Escriba Aquí..." required/>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="flex items-center gap-8" for="user">
                                        <span class="w-[75px]">{{ __("Telefono") }} :</span>
                                        <input id="user" type="text" disabled value="{{  old('telefono', Auth::user()->telefono) }}" name="telefono" class="grow" placeholder="Escriba Aquí..." required/>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="flex items-center gap-8" for="pais">
                                        <span class="w-[75px]">{{__("Country")}}:</span>
                                        <div class=" select-group grow">
                                            <select name="nacionalidad" id="pais" class="form-control" disabled>
                                            <option value="" disabled @selected(!Auth::user()->nacionalidad)>{{__("Select country")}}...</option>
                                            @foreach ($paises as $pais)
                                            <option value="{{$pais->code}}" @selected($pais->code == Auth::user()->nacionalidad)>
                                                {{ $pais->name }}
                                            </option>
                                            @endforeach
                                            </select>
                                            <i class="fa fa-angle-down theme_button color1 no_bg_button"></i>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </form>
                        <br>
                        <div class="col-12 text-right">
                            <span  class="cancelar cursor-pointer invisible theme_button min_width_button danger_bg_color">
                                <span class="media-name">{{ __("Cancel")}}</span>
                            </span>
                            <a href="" id="update" class="theme_button min_width_button color4">
                                <span class="left-icon">
                                    <i class="apsc-post fa fa-edit"></i>
                                </span>
                                <span class="media-name" data-option="{{__('Save')}}">{{ __("Edit")}}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

  <!-- Modal -->
<div class="modal" id="modal_image" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-xl">
            <div class="modal-header flex">
                <h5 class="modal-title text-sm font-bold grow ml-[10px]" id="modalLabel">{{__("Crop Image Before Change")}}</h5>
                <a class="cursor-pointer self-start danger_color hover:scale-110 hover:text-red-700 mr-2" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-close"></i>
                </a>
            </div>
            <div class="modal-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <img src="./images/gallery/02.jpg" alt="" id="crop_image">
                    </div>
                    <div class="col-md-4">
                        <h5 class="modal-title text-sm font-bold grow ml-[10px] text-center" id="modalLabel">{{__("Preview")}}</h5>
                        <div class="preview round w-[160px] h-[160px] m-[10px] border border-green-700 overflow-hidden"></div>
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