<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
</head>
<body>
    <form action="/form-result" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="text" name="name">
        <input type="submit">
    </form>
</body>
</html>
