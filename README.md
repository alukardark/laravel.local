## Установка

```
composer create-project --prefer-dist laravel/laravel blog
php composer.phar create-project --prefer-dist laravel/laravel blog
```
или глобально:
```
composer global require laravel/installer
laravel new blog
```


## МИГРАЦИИ

- Создание новой миграции для таблицы 'tasks' (database/migrations):

```
php artisan make:migration create_tasks_table --create=tasks
```

- Создание новой миграции для таблицы 'messages' в установленный путь (database/migrations/messages):

```
php artisan make:migration --path=database/migrations/messages create_messages_table --create=messages
```

- Добавть поля в таблицу:

```
php artisan make:migration --path=database/migrations/messages add_fields_messages_table --table=messages
```

- Запуск всех миграций в базу данных:

```
php artisan migrate
```

- Запуск всех миграций, в заданном пути, в базу данных:

```
php artisan migrate --path=database/migrations/messages
```

- Откат всех миграций:

```
php artisan migrate:reset
```

- Откат только последней миграции:

```
php artisan migrate:rollback
```


## СИДЫ
```
php artisan make:seeder UsersTableSeeder
php artisan db:seed
```

```php
$faker = Faker\Factory::create();

DB::table('links')->insert([
	'title' => $faker->name,
	'url' => $faker->url,
	'description' => $faker->text,
	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
//            'created_at' => date("Y-m-d H:i:s"),
	]);
```

вызов сидов внутри миграции: 
``` php
(new \MySeeder())->run();
```


## МОДЕЛИ И КОНТРОЛЛЕРЫ

'ORM Eloquent' - создание модели, которая соответствует нашей, только что созданной, таблице 'tasks' (app/):
``` 
php artisan make:model Task
```

Создать модель Message в папке Model:

```
php artisan make:model Models/Message
```

Создание модели и миграции одновременно:
```
php artisan make:model Mymodel -m
```

Если модель Message, то ларавел интуитивно идёт в таблицу БД MessageS, или можно вручную в модели указать: 

```php
protected $table='name_table'
```

Разрешение на запись полей:

```php
protected $fillable = ['name', 'email', 'message']; или protected $guarded = [];
```
```php
$post = App\Post::all();

$post = App\Post::where('status', '>=', 0)->get();
//SELECT * FROM posts WHERE status >= 0;

$post = App\Post::find([1,2,3]);
//Получение записей по id
```
```php
(App\Http\Controllers)//
php artisan make:controller HomeController
С дефолтными методами://
php artisan make:controller HomeController --resource
```
```php
use App\Models\MyName
$name = MyName::find([1,2]);
==
$name = MyName::whereIn('id', [1,2])->get();
```
```php
$name = MyName::findOrFail($id);
//404 при отсутствии записи
```

```php
Вывод даннх по заданным правилам роутинга//
php artisan route:list

Вывод URL, используя имя роута//
return route('profile');

Выводит дамп переменной в удобном ввиде и останавливает скрипт//
dd($id);
```

Позволяет выполнять php код в консоли//
php artisan tinker


```php
use App\Models\Message;
$msg = new Message;

$msg->name = 'Vasya';
$msg->email = 'Vasya@mail.com';
$msg->message = 'First message';

$msg->save();

Message::all();
Message::all()->toArray();

Найти запись по id//
$m = Message::find(1);
Обновить выбранную запись//
$m->message = 'Message update';
$m->save();

Удалить//
$m->delete();

/Или///////////////
Прописать в модели:
protected $fillable = ['name', 'email', 'message']; или protected $guarded = [];
и в консоли:
Message::create(['name'=>'Yulia', 'message'=>'Hi']);
Message::find($id)->update(['name'=>'Yulia', 'message'=>'Hi']);
Message::find($id)->delete();
Message::destroy($id);
Message::destroy(1,2,3);
Message::destroy([1,2,3]);

```


```php
DB::table('messages')->where('name', '=', 'John')->get(),
==
DB::table('messages')->select(DB::raw('*'))->where('name', '=', 'John')->get(),
==
DB::select('select * from messages where name = ?', ['John']),
```

## SCOPE

```php
class User extends Model{
	public function scopeActive($query){
		return $query->where('is_active', 1);
	}
}

$user = User::active()->where('age', '>=' '18')->get();
```

------------------------------

```php
<form action="{!! action('HomeController@edit', ['id'=>5]) !!}" method="post">

	//<link rel="stylesheet" href="{!! url('user/profile') !!}">
	<link rel="stylesheet" href="{!! asset('user/profile') !!}">
	<img src="{!! asset('img/photo.jpg') !!}" alt="">
	<script src="{!! asset('js/app.min.js') !!}"></script>

	//Route::get('adminzone/Categories/create','CategoriesController@create');
	//Route::post('adminzone/Categories/create','CategoriesController@store');
	//Route::resource('adminzone/Categories','CategoriesController'); - но в форме
	нужно указывать тогда явно {{action('CategoriesController@store')}}

	Category::create($request->all());
	Category::create(['title' => $request->input('title')]);
	(protected $fillable=['title']; - в модели)


	//return redirect('/')->with('message', 'Profile updated!');
	return back()->with('message','Категория добавлена');
	@if(Session::has('message'))
	{{Session::get('message')}}
	@endif




	--//Вставка из формы в DB:
	--//
	(Массовая вставка:(в можеле не забыть protected $fillable = ['title'];))
	xxx::create($request->all()); 

	(Одиночная вставка:)
	$xxx = new xxx;
	$xxx->title = $request->title;
	$xxx->save();
	--//
	--//

	return back()->with('message','Категория добавлена');
	@if(Session::has('message'))
	{{Session::get('message')}}
	@endif

	--//Выборка:
	--//
	$titles = Xxx::all();
	$titles = Xxx::find($id);
	return view('store', ['titles'=>$titles]);
	--//
	--//

	<a href="{{action('Controller@edit', ['id'=>$title -> id])}}">{{$title -> title}}</a>

	--//Удаление:
	--//
	$titles = Xxx::find($id);
	$titles->delete();
	return back()->with('message','Удалено!');
	--//
	--//

	--//Update:
	--//
	$titles = Xxx::find($id);
	$titles->update($request->all());
	<!-- $titles->save(); -->
	return back()->with('message','Категория обновлена');
	--//
	--//

	//ВАЛИДАЦИЯ:

	confirmed
	если проверяется поле password, то на вход должно быть передано совпадающее по значению поле password_confirmation.

	use Validator;
	------------------------------------------
	$this->validate($request, [
		'author' => 'required|max:100|min:5',
		'email' => 'required|email',
		'content'=>'required|min:5|max:400|'
		]);

	И в resources/lang/xx/validation.php :
	'custom' => [
	'email' => [
	'required' => 'Нам надо знать ваш e-mail!',
	],
	],
	------------------------------------------

	<!-- $validator = Validator::make($request->all(), [
		'author' => 'required|max:100|min:5',
		'email' => 'required|email',
		'content'=>'required|min:5|max:400|'
		]); -->

	$arr = [
	'author' => 'required|max:100|min:5',
	'email' => 'required|email',
	'content'=>'required|min:5|max:400|'
	];
	$messages = [
	'author.required' => 'Поле "Ваше имя:" не заполнено',
	'email.required' => 'Поле "Ваш email:" не заполнено',
	'content.required' => 'Поле "Ваше сообщение:" не заполнено',
	];
    $validator = Validator::make($request->all(), $arr, $messages); //Три массива

    if ($validator->fails()) {
    	return back()
    	->withErrors($validator)
    	->withInput();
    }
    ------------------------------------------END
    @if (count($errors) > 0)
    @foreach ($errors->get('email') as $error)
    <li>{{ $error }}</li>
    @endforeach
    @endif
    ------------------------------------------END

//Во всех видах будет доступна переменная menu, которая будет содержать все пункты меню.
    public function boot()
    {
    	view()->share('menu',App\Page::all());
    }

    --------------

//Один ко многим
    Внутри модели Article(id_author принадлежит ей)
    public function author()
    {
    	return $this->belongsTo('App\Author','id_author','id');
    }

    --------------
    --------------

// Один к одному:
// Один продукт, одна категория
    class Category extends Model{
    	public function cat()
    	{
    		return $this->hasOne('App\Category', 'title', 'categories');
        // title = Category, categories = Product
    	}
    }

    $prods = App\Product::all();
    foreach($prods  as $prod ) {
    	echo "<br>";
    	print_r($prod->cat->title);
    }
// Clinton
// Penelope
// Lowell 
// Dock Block


// ---------------------------------------------
// Один ко многим:
// Одна категория, много продуктов
    class Category extends Model{
    	public function product()
    	{
    		return $this->hasMany('App\Product', 'categories',  'title');
		// categories = Product, title = Category
    	}
    }

    $categories = App\Category::find(8)->product;
    foreach($categories as $category):
    	echo "<br>";
    print_r($category->image);
    endforeach;
// product-6.png
// product-2.png

// -- ИЛИ: --

    $categories = App\Category::all();
    foreach($categories as $category):
    	echo "<br>";
    foreach ($category->product as $item) {
    	print_r($item->image);
    }
    endforeach;
// product-6.pngproduct-2.png
// product-3.pngproduct-4.pngproduct-4.png
// product-7.pngproduct-2.pngproduct-2.pngproduct-9.png

    --------------
    ОПТИМИЗАЦИЯ
    php artisan optimize

    Если в настройках Laravel установлено APP_DEBUG=true, то эффекта не почувствуете, для того что бы это исправить нужна такая команда:
    php artisan optimize --force

    После этого, в папке bootstrap/cache появится файл compiled.php. Команда optimize опитимизирует загрузку классов, поэтому приложение начинает работать быстрее.
    И вторая полезная команда:
    php artisan route:cache
    Route::get('slug',function(){
    	....
    }); - ОШИБКА



    ---АВТОРИЗАЦИЯ---

    AuthServiceProvider

    public function boot(GateContract $gate)
    {
    	$this->registerPolicies($gate);


    	$gate->define('create', function ($user){
	return $user->name=='manager'; 	//В данном случае, мы проверяем, является ли залогиненный пользователь manager. 
});

    	$gate->define('show',function ($user){
    		return $user->name=='user' || $user->name=='manager';
    	});

    	$gate->define('create', function (){
    		return   time()<strtotime('18:00:00');
    	});
    }
    Логику здесь можно накрутить любую. Например, если сейчас время больше 18-00, то запретим создавать новую статью
//
public function create(){
	$this->authorize('create');
	return view('create');
}
public function update($id){
	$post = Post::findOrFail($id);
	$this->authorize('update', $post);
    // Обновление статьи...
}
//
@can('create') <!-- проверяем права во вьюшке -->
<a href="/create">Добавить статью</a>
@endcan

403 -- ВЫ НЕ АВТОРИЗИРОВАНЫ

// AuthController 
protected $redirectTo = '/'; - редирект, при успешной авторизации

// RedirectIfAuthenticated
return redirect('/'); - редирект, при обращении к /login или /register, если уже авторизирован

// App\Http\Middleware\Authenticate
return redirect()->guest('login'); - редирект, при попытке доступа к защищённому маршруту

// Обращаться к аутентифицированному пользователю:
$user = Auth::user();
$user = Auth::user()->name;
// или
$request->user()
$request->user()->name

// use Illuminate\Contracts\Auth\Authenticatable;
public function myMethod(Authenticatable $user){
	// $user  - это экземпляр аутентифицированного пользователя...
}

if (Auth::check()){
  // Пользователь вошёл в систему...
}

// Доступ к определённому маршруту только аутентифицированным пользователям:
// С помощью контроллера...
Route::get('profile', [
	'middleware' => 'auth',
	'uses' => 'ProfileController@show'
	]);
// С помощью конструктора контроллера...
public function __construct()
{
	$this->middleware('auth');
}

------


use Carbon\Carbon;
'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
'created_at' => date("Y-m-d H:i:s"),


// COOKIE
\Cookie::queue('NameCookie', 'ValueCookie', 60);
print_r($request->cookie('NameCookie'));
// или другое чтение куки:
print_r(\Cookie::get('NameCookie'));


// SESSION
// Сохранение переменной в сессии
Session::put('key', 'value');
session(['key' => 'value']);

//Добавление элемента к переменной-массиву
Session::push('user.teams', 'developers');

// Чтение переменной сессии
$value = Session::get('key');
$value = session('key');

// Получение всех переменных сессии
$data = Session::all();
$request->session()->all();

//Проверка существования переменой
if (Session::has('users'))
{
  //
}

// Удаление переменной из сессии
Session::forget('key');
// Удаление всех переменных
Session::flush();



//	ПОЧТА
'from' => ['address' => "andrereb1@gmail.com", 'name' => "myname"],
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=andrereb1@gmail.com
MAIL_PASSWORD=170190Aa
MAIL_ENCRYPTION=tls

php artisan config:cache
```
