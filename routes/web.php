<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
use GrahamCampbell\Markdown\Facades\Markdown;

Route::get('/', function () {
    $readmeContent = File::get(base_path() . '/README.md');
    $htmlContent = Markdown::convertToHtml($readmeContent);
    return view('welcome', ['content' => $htmlContent]);
});

Route::resource('users', 'PersonController');