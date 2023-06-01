<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php
    $avatar = $company['avatar'];
    $newAvatar = str_replace("public/", "storage/", $avatar);
@endphp
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$company['name']}}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="icon" href="https://e.truckyapp.com/{{$newAvatar}}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

<body class="antialiased">
    <img width="40" height="40" src="https://e.truckyapp.com/{{$newAvatar}}" />
   
    <h1 class="text-xl font-bold">{{$company['name']}}</h1>
    <h2>{{$company['company_type']}}

</body>
</html>
