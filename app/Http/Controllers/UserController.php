<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user($user_id = null)
    {
        if ($user_id) {
            dump($user_id);
        } else {
            dump('пользователь не зарегистрирован');
        }
    }

    public function form()
    {
        return view('form/form-page');
    }

    public function formResult()
    {
        $my_var = 'Пример переменной';

        return view('form/form-result', compact('my_var'));
    }
}
