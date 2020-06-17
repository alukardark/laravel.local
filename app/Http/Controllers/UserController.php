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

    public function tasksResult()
    {
        $tasks = \DB::table('tasks')->get();

        return view('tasks', compact('tasks'));
    }

    public function tasksCount($count = null)
    {
        \DB::table('tasks')
            ->where('id', $count)
            ->update(['counter' => \DB::raw('counter+1')]);

        \DB::table('logs')->insert(array(
            array('task_id' => $count, 'status' => 0, 'created_at' => date("Y-m-d H:i:s")),
        ));

        header('Location: http://laravel.local/tasks');
        exit;
    }

    public function logsResult()
    {

        $logs = \DB::table('logs')->select('*')->where('status', '=', '0')->orderBy('created_at', 'desc')->get();

        return view('logs', compact('logs'));

    }

    public function workResult()
    {
        $work_id = \DB::table('logs')->select('id')->where('status', '=', '0')->first()->id;

        print_r($work_id);
        $work = \DB::table('logs')->where('id', '=', $work_id)->update(['status' => 1]);
    }


}
