<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostRequest;

class PlacesController extends Controller
{
    public function getPlaces()
    {

        $places = Place::all();

        return view('places/index', compact('places'));
    }

    public function createPlace()
    {
        return view('places/create');
    }

    public function addPlace(PostRequest $request)
    {
//        $name = $request->name;
//        $type = $request->type;
//        Place::create(['name' => $name, 'type' => $type]);

        Place::create($request->all());

        header('Location: http://laravel.local/places/create');
        exit;
    }

    public function getPlace($place_id)
    {

        if ($place_id) {
            $placeId = Place::find($place_id);

            return view('places/place-item', compact('placeId'));
        } else {
            return view('places/place-item');
        }

    }
    public function addPhoto(PostRequest $request, $place_id)
    {

        $file = $request->file('image');


//        // отображаем имя файла
//        echo 'File Name: '.$file->getClientOriginalName();
//        echo '<br>';
//
//        //отображаем расширение файла
//        echo 'File Extension: '.$file->getClientOriginalExtension();
//        echo '<br>';
//
//        //отображаем фактический путь к файлу
//        echo 'File Real Path: '.$file->getRealPath();
//        echo '<br>';
//
//        //отображаем размер файла
//        echo 'File Size: '.$file->getSize();
//        echo '<br>';
//
//        //отображаем Mime-тип файла
//        echo 'File Mime Type: '.$file->getMimeType();

        //перемещаем загруженный файл
        $destinationPath = 'uploads';
        $file->move($destinationPath,$file->getClientOriginalName());


        header('Location: http://laravel.local/places/'.$place_id.'/');
        exit;
    }
}
