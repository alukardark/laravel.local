@extends('layout')





@section('content')
    <form action="/form-result" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="text" name="name">
        <input type="submit">
    </form>
@endsection