@extends('layouts.main')
@section('title',"Perfil")
@section("styles-css")
    <link rel="stylesheet" href="css/cropper.min.css" />
    <link rel="stylesheet" href="{{ url('datatables/datatables.min.css')}}">
@endsection
@section('content')
    @include('components.perfil.usuario')
    @include('components.perfil.list-files')
@endsection
@section('scripts-js')
<script src="js/cropper.min.js"></script>
<script src="{{ url('datatables/datatables.min.js')}}"></script>
    @vite(['resources/js/user-app.js'])
@endsection