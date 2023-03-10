<style>
    article .flag{
        width: 40px;
        height: 30px;
        position: absolute;
        top: 15px;
        left: 15px;
        overflow: hidden;
        z-index: 2;
    }
    article .entry-title{
        text-align: center;
        text-transform: capitalize;
        border-bottom: transparent solid 2px;
        padding-bottom: 10px;
        border-image: linear-gradient(0.4turn, rgba(150,150,150,0), rgba(150,150,150), rgba(150,150,150,0));
        border-image-slice: 1;
    }
    article .item-content > p{
        margin: 20px 0;
    }
    article .item-media div{
        text-align: center;
    }
</style>
@foreach ($recomendaciones as $item)
    @include('components.video.video-article', [
        'imagen'        => url('storage/'.$item->foto),
        'titulo'        => $item->titulo,
        'descripcion'   => $item->descripcion,
        'bandera'       => url($item->pais->flag_4x3),
        'videoLink'     => route('video.ver',[$item->id]),
        ])   
@endforeach