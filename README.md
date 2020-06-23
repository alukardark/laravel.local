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


```sql
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
