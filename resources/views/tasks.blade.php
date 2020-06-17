<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>



<table>
    <tr>
        <td>id</td>
        <td>name</td>
        <td>counter</td>
    </tr>

    @foreach($tasks as $tasks_item)
        <tr>
            <td><a href="/tasks/{{$tasks_item->id}}">{{$tasks_item->id}}</a></td>
            <td>{{$tasks_item->name}}</td>
            <td>{{$tasks_item->counter}}</td>
        </tr>
    @endforeach

</table>


<a href="/work/">принять в работу</a>


</body>
</html>
