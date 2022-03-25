<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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
    return view('welcome');
});

Route::get('/form', function () {
    return view('dashboard.form');
});


Route::get('/axios', function () {
    return 'welcome';
});

Route::post('/submit', function (Request $request) {
    $data=$request->except('password');

    $extension=$request->file('file')->getClientOriginalExtension();
    
    $request->file('file')->move(storage_path(),time().'.'.$extension);
    
    $data['photo']=$request->file('file')->getClientOriginalExtension();
    
    $data['password']=bcrypt($request->password);
    
    return App\User::create($data);

})->name('form');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/auth', function(){




});
