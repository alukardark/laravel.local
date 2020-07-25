<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\log;

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

    public function formResult(Request $request)
    {
        $my_var = 'Пример переменной';
//        $name = $request->input('name', 'default-value');
//        $name = $request->get('name', 'default-value');
//        $name = $request->name;

//        $name = request()->name;
//        $name = request()->input('name', 'default-value');

        return view('form/form-result', compact('my_var'));
    }

    public function tasksResult()
    {
//        $tasks = \DB::table('tasks')->get();
        $tasks = Task::all();

        return view('tasks', compact('tasks'));
    }

    public function tasksCount($count = null)
    {
//        \DB::table('tasks')
//            ->where('id', $count)
//            ->update(['counter' => \DB::raw('counter+1')]);

        $tasksId = Task::find($count);
        // $tasksId->counter++;
        // $tasksId->save();
        $tasksId->increment('counter');


//        \DB::table('logs')->insert(array(
//            array('task_id' => $count, 'status' => 0, 'created_at' => date("Y-m-d H:i:s")),
//        ));
        Log::create(['task_id' => $count, 'status' => 0]);


        header('Location: http://laravel.local/tasks');
        exit;
    }

    public function logsResult()
    {

//        $logs = \DB::table('logs')->select('*')->where('status', '=', '0')->orderBy('created_at', 'desc')->get();
        $logs = Log::select('*')->status('0')->orderBy('created_at', 'desc')->get();

        return view('logs', compact('logs'));

    }

    public function workResult()
    {
//        $work_id = \DB::table('logs')->select('id')->where('status', '=', '0')->first()->id;
        $work_id = Log::select('id')->where('status', '=', '0')->first()->id;

        print_r($work_id);
//        $work = \DB::table('logs')->where('id', '=', $work_id)->update(['status' => 1]);
        $work = Log::where('id', '=', $work_id)->update(['status' => 1]);
    }


}
