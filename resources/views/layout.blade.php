<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ !empty($title)? $title : 'НЕТ ЗАГОЛОВКА' }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <link rel="stylesheet" href="css/app.css">


    <!-- Styles -->

</head>
<body>

    @yield('content')

    <script type="text/javascript" src="js/app.js"></script>
</body>
</html>