@props([
    'nameTitle'     => "Imágenes",
    'fileTypes'     => "JPG, PNG",
    'extensiones'   => ".png,.jpg",
    'galeria'       => "imagenes",
    'list_archivo'  => [],
    ])

<article class="panel-documentos card-89 rounded-xl drop-shadow-lg p-[30px]">
    <div class="text-center">
        <h4 class="document-title">
            {{__("Upload your")}} <span class="name-title">{{$nameTitle}}</span>
        </h4>
        <div class="document-subtitle">
            <span>{{__("File should be")}}</span>
            <span>{{$fileTypes}}</span>
        </div>
    </div>
    <div class="drag_drop">
        <i class="fa fa-folder-open"></i>
        <div class="texto">{{__("Drag & Drop your")}} {{$nameTitle}} {{__("here")}}</div>
        <input class="hidden" type="file" name="archivos" data-gallery="{{$galeria}}" @if (isset($registro)) data-registro="{{$registro->id}}" @endif accept="{{$extensiones}}" multiple/>
    </div>
    <div class="section-files @empty($list_archivo) hidden @endempty">
        <div class="text-[12px] mb-2 info_color font-semibold">{{__("Uploaded files")}}</div>
        <div class="list-files">
            @foreach ($list_archivo as $archivo)
            <div class="item-file to_animate animated slideDown" data-animation="slideDown" data-delay="500">
                <span class="w-[30px] h-[30px] preview">
                    <a href="{{ route('documento.get', [$archivo->id])}}" target="_blank">
                    @if ( $galeria == "imagenes")
                        <img class="object-cover h-full" src="{{route('documento.get', [$archivo->id])}}" alt=""/> 
                    @else
                        @switch(Str::afterLast($archivo->name, '.'))
                            @case("docx")
                                <i class="rt-icon2-file-word-o info_color text-[30px]"></i>
                                @break
                            @case("doc")
                                <i class="rt-icon2-file-word-o info_color text-[30px]"></i>
                                @break
                            @case("pdf")
                                <i class="rt-icon2-file-pdf-o info_color text-[30px]"></i>
                                @break
                        
                            @default
                                <i class="rt-icon2-file-o info_color text-[30px]"></i>
                        @endswitch
                    @endif
                    </a>
                </span>
                <span class="grow overflow-hidden">
                    <div class="flex justify-stretch">
                        <div class="file-name grow overflow-hidden whitespace-nowrap text-ellipsis">
                            <a href="{{ route('documento.get', [$archivo->id])}}" target="_blank">{{$archivo->name_original??$archivo->name}}</a>
                        </div>
                    </div>
                    <div class="progress progress-bar-info my-1"></div>
                </span>
                <span class="w-[30px] text-right dataFile" data-id-archivo="{{$archivo->id}}">
                    <i class="eliminar rt-icon2-trashcan text-red-600 text-xl hover:text-red-900 cursor-pointer" title="Eliminar"></i>
                    <i class="hidden text-xl text-green-500 rt-icon2-checkmark2"></i>
                    <i class="hidden text-3xl danger_color rt-icon2-refresh"></i>
                </span>
            </div>
            @endforeach
        </div>
    </div>
</article>