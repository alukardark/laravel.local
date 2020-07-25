@extends('layout', ['title'=>'Место'])


@section('content')

    @if($placeId)
        {{$placeId->id}}
        <hr>
        {{$placeId->name}}
        <hr>
        {{$placeId->type}}
        <hr>


        <form action="/places/{{$placeId->id}}/photos/add" enctype="multipart/form-data" method="post">
            {{ csrf_field() }}
            <input type="file" name="image">
            <input type="submit" value="Отправить">
        </form>

    @else
        Место не найденно
    @endif


@endsection