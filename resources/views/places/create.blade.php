@extends('layout', ['title'=>'create'])


@section('content')

    <h2>Добавить место</h2>
    <a href="/places/">Список мест</a> <br><br>

    <form action="/places/add" method="post" class="form-inline">

        {{ csrf_field() }}

        <div class="form-group mb-2">
            <input type="text" name="name" placeholder="Название" class="form-control" value="{{old('name')}}">
        </div>

        <div class="form-group mx-sm-3 mb-2">
            <select name="type" placeholder="Тип" class="form-control">
                <option value="Тип-1"  @if (old('type') == "Тип-1") {{ 'selected' }} @endif>Тип-1</option>
                <option value="Тип-2"  @if (old('type') == "Тип-2") {{ 'selected' }} @endif>Тип-2</option>
                <option value="Тип-3"  @if (old('type') == "Тип-3") {{ 'selected' }} @endif>Тип-3</option>
            </select>
        </div>

        <div class="form-group mb-2">
            <input type="submit">
        </div>
        
    </form>



    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
@endsection