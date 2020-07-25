@extends('layout', ['title'=>'places'])


@section('content')

    <a href="/places/create">Добавить</a>

    <table border="1" cellpadding="10">
        <tr>
            <td>название</td>
            <td>тип</td>
        </tr>


        @foreach($places as $place)
            <tr>
                <td><a href="/places/{{$place->id}}">{{$place->name}}</a></td>
                <td>{{$place->type}}</td>
            </tr>
        @endforeach

    </table>


@endsection