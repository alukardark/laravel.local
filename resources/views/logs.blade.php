@extends('layout')





@section('content')
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
@endsection