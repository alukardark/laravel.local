@extends('layout', ['title'=>'TASKS'])





@section('content')
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
@endsection