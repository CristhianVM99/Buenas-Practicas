@props([
    'imagenes' => 'imagenes'
])
<div class="{{$imagenes}}">
    @include('components.util.drag-drop', [
        'galeria'       => $imagenes,
        'nameTitle'     => 'Fotografías',
        'fileTypes'     => 'JPG, JPEG, PNG, GIF',
        'extensiones'   => '.png,.jpeg,.gif,.jpg',
        'list_archivo'  => isset($fotografias)? $fotografias : [] ,
        ])
</div>