@extends('layouts.main')
@section('title', 'Mapa')
@section('content')
    <div id="mapid" class="margin-bottom-20"></div>    
    <div id="sidebar"></div>    
@endsection
@section('scripts-js')
    @vite(['resources/js/leaflet.js'])
@endsection
