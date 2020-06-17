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
        <td>task_id</td>
        <td>status</td>
        <td>created_at</td>
    </tr>

    @foreach($logs as $logs_item)
        <tr>
            <td>{{$logs_item->id}}</td>
            <td>{{$logs_item->task_id}}</td>
            <td>{{$logs_item->status}}</td>
            <td>{{$logs_item->created_at}}</td>
        </tr>
    @endforeach

</table>


</body>
</html>