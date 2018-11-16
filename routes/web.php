<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
 return view('dashboard');
});
Route::resource('tasks', 'TaskController');

Route::get('test-add', function (\Doctrine\ORM\EntityManagerInterface $em) {
    $task = new \App\Entities\Task('Tambah data', 'Berjaya tambah data.');

    $em->persist($task);
    $em->flush();

    return 'added!';
});
Route::get('test-get', function (\Doctrine\ORM\EntityManagerInterface $em) {
    /* @var \App\Entities\Task $task */
    $task = $em->find(App\Entities\Task::class, 3);

    return $task->getName() . ' - ' . $task->getDescription();
});
Route::resource('tasks', 'TaskController');
Route::get('add', 'TaskController@getAdd');
Route::post('postAdd', 'TaskController@postAdd');
Route::get('edit/{taskId?}', 'TaskController@getEdit');
Route::post('postEdit/{taskId?}', 'TaskController@postEdit');
Route::get('toggle/{taskId?}', 'TaskController@getToggle');
Route::get('postDelete/{taskId?}', 'TaskController@getToggle');