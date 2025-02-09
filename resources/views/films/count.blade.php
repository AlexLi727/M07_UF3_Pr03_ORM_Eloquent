@extends('layouts.master')
    @section('header')
        @parent()
    @endsection

@section("content")
<h1>Contador de películas: {{$contador}}</h1>
@endsection

@section("footer")
    @parent()
@endsection
