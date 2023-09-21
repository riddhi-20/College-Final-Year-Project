<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\JoinCategoryTopicController;
use App\Http\Controllers\DropdownTopicController;
use App\Http\Controllers\AddQuestionController;
use App\Http\Controllers\JoinTopicQuestionController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\MultiStepFormController;
// use App\Http\Controllers\RunpythonController;

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

Auth::routes();
$user = Auth::user();


Route::group(['middleware' => ['Student']], function() {
    Route::get('/home', [StudentController::class, 'index'])->name('userhome');
    Route::post('/usertest/{id}', [TestController::class, 'index'])->name('test.index');
    // Route::any('/taketest', [TestController::class,'show'])->name('test.show');
    Route::any('/takequiz', [MultiStepFormController::class,'index'])->name('test.show');
    Route::put('/updatetest', [TestController::class,'update'])->name('test.update');

    Route::post('/checkscore', [TestController::class,'score'])->name('check.score');
});

Route::group(['middleware' => ['IsAdmin']], function() {

    Route::get('admin/home', [AdminController::class, 'index'])->name('admin.home');

    Route::post('/addtopic',[CourseController::class, 'store'])->name('course.store');
    Route::any('/viewtopics',[JoinCategoryTopicController::class, 'index'])->name('topics.index');
    Route::get('/edittopics/{id}',[JoinCategoryTopicController::class, 'edit'])->name('topics.edit');
    Route::put('/updatetopics/{id}', [CourseController::class, 'update'])->name('topics.update');
    Route::delete('/deletetopics/{id}', [CourseController::class, 'destroy'])->name('course.destroy');

    Route::get('/addquestions', [DropdownTopicController::class, 'index'])->name('questions.create');
    Route::post('api/fetch-topics', [DropdownTopicController::class, 'fetchTopics'])->name('fetchTopics');

    Route::post('/storequestion',[AddQuestionController::class, 'store'])->name('questions.store');
    Route::get('/viewquestions',[JoinTopicQuestionController::class, 'index'])->name('questions.index');
    Route::get('/editquestions/{id}',[JoinTopicQuestionController::class, 'edit'])->name('questions.edit');
    Route::put('/updatequestions/{id}', [AddQuestionController::class, 'update'])->name('questions.update');
    Route::delete('/viewquestions/{id}', [AddQuestionController::class, 'destroy'])->name('questions.destroy');

    Route::get('/students', [ResultController::class,'students'])->name('results.students');
    
    // Route::get('/pythonfile', [RunpythonController::class,'pythonfile']);

});


Route::get('/pythonfile', function(){
    return response()->file('C:/xampp/htdocs/psychometric_test/public/pydata/personality.ipynb');
});