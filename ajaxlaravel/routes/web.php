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
Auth::routes();
Route::middleware('auth')->group(function(){
    Route::get('/category-list', function () {
        return view('categoryTemplate');
    });
    Route::get('/post-list', function () {
        return view('postTemplate');
    });
    Route::get('/admin', function () {
        $users = Auth::user();
        return view('admin', compact('users'));
    });
});
use App\Post;


Route::get('/', function () {

    $posts = Post::all();
    return view('home', compact('posts'));
});


Route::get('/template', function() {
    return view('layouts.admin.index');
});


Route::resource('category', 'CategoryController',
[
    'except' => ['create']
]);

Route::resource('contact', 'ContactController', [
	'except' => ['create']
]);
Route::resource('post', 'PostController',[
	'except' => ['create']
]);

// show data on datatables
Route::get('api/contact', 'ContactController@apiContact')->name('api.contact');
Route::get('api/category', 'CategoryController@apiCategory')->name('api.category');
Route::get('api/post', 'PostController@apiPost')->name('api.post');

Route::get('/findcategory', 'PostController@findCategory');
Route::get('/findpropinsi', 'PostController@findPropinsi');
Route::get('/findkabupaten', 'PostController@findKabupaten');
Route::get('/findkecamatan', 'PostController@findKecamatan');
Route::get('/postsearch', 'PostController@postSearch');

//mail
Route::get('mail', 'MailController@index');
Route::post('sendmail', 'MailController@post');

//export pdf
Route::get('/exportpdf', 'ContactController@exportPDF')->name('contact.export');


Route::get('/postcategory/{category}', 'PostController@showByCategory');


Route::get('/api/search', function(){
    $posts = DB::table('posts')->where(['category_id' => '1', 'propinsi_id' => '11','kabupaten_id' => '1', 'kecamatan_id' => '1' ])
            ->get();

    dd($posts);
});




/**
 * Search
 */
Route::get('/allpost', 'PostController@findAllPost');
Route::get('/findpostbypropinsi/{propinsi}', 'PostController@findPostByPropinsi');
Route::get('/findpostbykabupaten/{kabupaten}', 'PostController@findPostByKabupaten');
Route::get('/findpostbykecamatan/{kecamatan}', 'PostController@findPostByKecamatan');
Route::get('/findpostbycategory/{category}', 'PostController@findPostByCategory');
