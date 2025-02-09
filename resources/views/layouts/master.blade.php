<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @section("header")
        <h1> WEB Header</h1>
        <img src = "{{asset("img/header.png")}}">
    @show
    <hr>
    <div class = "container">
        @yield('content')
    </div>
    <hr>
    @section("footer")
        <h1> WEB Footer</h1>
        <img src = "{{asset("img/Footer.jpg")}}">
    @show
</body>
</html>