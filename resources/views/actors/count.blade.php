@extends('layouts.master')
    @section('header')
        @parent()
    @endsection

@section("content")
<h1>Contador de actores: {{$contador}}</h1>
@endsection

@section("footer")
    @parent()
@endsection
