<h5 class="titulo">Objetivos de Desarrollo Sostenible</h5>
<div class="row ods">
    <h6 class="subtitulo">Elija los Objetivos de Desarrollo Sostenible Trabados en su Estrategía</h6>
    <div class="col-xs-12 flex flex-wrap gap-3">
        @foreach ( $categorias as $ods)
            <div class="marco {{(isset($registro) && in_array($ods->id, json_decode($registro->ods)))? 'active': '';}} w-[90px] cursor-pointer" data-id="{{$ods->id}}">
                <img src="{{ url('img/SDG/'.$ods->icon) }}" alt="No" srcset="{{ url('img/SDG/'.$ods->icon) }}">
            </div>
        @endforeach
    </div>
</div>