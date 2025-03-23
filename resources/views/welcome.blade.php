<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies List</title>

    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Include any additional stylesheets or scripts here -->
</head>

<body class="container">
    @extends('layouts.master')
    @section('header')
        @parent
    @endsection

    @section('content')
    @if(!empty($status))
        <h1> {{$status}} </h1>
    @endif
    
    <h1 class="mt-4">Lista de Peliculas</h1>
    <ul>
        <li><a href=/filmout/oldFilms>Pelis antiguas</a></li>
        <li><a href=/filmout/newFilms>Pelis nuevas</a></li>
        <li><a href=/filmout/films>Pelis</a></li>
        <li><a href=/filmout/sortFilms> Ordenar Pelis</a></li>
        <li><a href=/filmout/countFilms> Contador Pelis </a></li>
    </ul>

    <!-- Create Film Form -->
    <form method="POST" action ="/filmin/createFilm">
        @csrf
        <h2> Añadir Pelicula </h2>
        Nombre <input name = "name"> <br>
        Año <input name = "year"> <br>
        Genero <input name = "genre"> <br>
        Pais <input name = "country"> <br>
        Duración <input name = "duration"> <br>
        Imagen URL <input name = "img"> <br>
        <input type = "submit" value = "Enviar">
    </form>

    <!-- Actors section -->
    <h1> Lista de actores </h1>
    <ul>
        <li><a href=/actorout/countActors> Contar Actores </a></li>
        <li><a href=/actorout/listActors> Lista de Actores </a></li>
    </ul>

    <h1> Buscar actores por criterio </h1>
    <form method="GET" action = "/actorout/listActorsByDecade">
        Decada de nacimiento
        <select name = "decade">
            <option value = "1980"> 1980-1989 </option>
            <option value = "1990"> 1990-1999 </option>
            <option value = "2000"> 2000-2009 </option>
            <option value = "2010"> 2010-2019 </option>
            <option value = "2020"> 2020-2029 </option>
        </select>
        <input type = "submit" value = "Enviar">
    </form>
    @endsection

    @section('footer')
    @parent()
    @endsection
    <!-- Add Bootstrap JS and Popper.js (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Include any additional HTML or Blade directives here -->

</body>

</html>
