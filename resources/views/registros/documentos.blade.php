@props([
    'documentos' => 'documentos'
])
<div class="{{$documentos}}">
    @include('components.util.drag-drop', [ 
        'galeria'       => $documentos,
        'nameTitle'     => 'Documentos',
        'fileTypes'     => 'PDF, DOC, DOCX',
        'extensiones'   => '.pdf, .docx,.doc',
        'list_archivo'  => isset($archivos)? $archivos: [],
        ])
</div>