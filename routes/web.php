<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MaintestimonialController;
use App\Http\Controllers\MaincarController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::get('/index',function(){
    return view('index');
});
Route::fallback(function(){
    return redirect('/');
});
Route::view('/admin/users','admin.users');
Route::view('/test','testimonials');

//User Controller
Route::get('admin/users',[UserController::class,'index']);       //select all
Route::get('admin/addUser',[UserController::class,'create']);     //insert
Route::post('admin/userstore',[UserController::class,'store'])->name('userstore'); //store
Route::get('admin/edituser/{id}',[UserController::class,'edit']);      //edit 
Route::put('/admin/userupdate/{id}',[UserController::class,'update'])->name('userupdate'); //update
Route::get('admin/userdelete/{id}',[UserController::class,'destroy']);    //delete
Route::post('/userrestore',[UserController::class,'restore'])->name('userrestore');   //Soft Deletes
Route::get('/user/show_deleted',[UserController::class,'showdeleted']);


//Category Controller
Route::get('admin/categories',[CategoryController::class,'index']);       //select all
Route::get('admin/addcategory',[CategoryController::class,'create']);     //insert
Route::post('admin/categorystore',[CategoryController::class,'store'])->name('categorystore'); 
Route::get('admin/editcategory/{id}',[CategoryController::class,'edit']);      //update
Route::put('/admin/categoryupdate/{id}',[CategoryController::class,'update'])->name('categoryupdate'); //update
Route::get('admin/categorydelete/{id}',[CategoryController::class,'destroy']);    //delete


//Testimonial Controller
Route::get('admin/testimonials',[TestimonialController::class,'index']);       //select all
Route::get('admin/addtestimonial',[TestimonialController::class,'create']);     //insert
Route::post('admin/testimonialstore',[TestimonialController::class,'store'])->name('testimonialstore'); 
Route::get('admin/edittestimonial/{id}',[TestimonialController::class,'edit']);      //update
Route::put('/admin/testimonialupdate/{id}',[TestimonialController::class,'update'])->name('tistemonialupdate'); //update
Route::get('admin/testimonialdelete/{id}',[TestimonialController::class,'destroy']);    //delete





//Car Controller
Route::get('admin/cars',[CarController::class,'index']);       //select all
Route::get('admin/addcar',[CarController::class,'create']);     //insert
Route::post('admin/carstore',[CarController::class,'store'])->name('carstore'); //store
Route::get('admin/editcar/{id}',[CarController::class,'edit']);      //edit 
Route::put('/admin/carupdate/{id}',[CarController::class,'update'])->name('carupdate'); //update
Route::get('admin/cardelete/{id}',[CarController::class,'destroy']);    //delete

Route::post('/carrestore',[CarController::class,'restore'])->name('carrestore');   //Soft Deletes
Route::get('/car/show_deleted',[CarController::class,'showdeleted']);


Auth::routes(['verify'=>true]);

//Contact Controller
Route::get('admin/messages',[ContactController::class,'index']); 
Route::get('/admin/ShowMessage/{id}', [ContactController::class, 'show']);
Route::get('admin/deletemessage/{id}',[ContactController::class,'destroy']); 

Route::post('/msgrestore',[ContactController::class,'restore'])->name('msgrestore');   //Soft Deletes
Route::get('/message/show_deleted',[ContactController::class,'showdeleted']);

//Unread Message
Route::get('/unreadMessage', [ContactController::class, 'unreadMessage']);
Route::get('/admin/messages/{id}/read', [ContactController::class, 'markAsRead'])->name('messages.markAsRead');

//auth
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('verified')->name('home');


//Language Controller
Route::post('language-switch',[LanguageController::class,'langswitch'])->name('language.switch');





///////////////////////////////Main Website//////////////////////////////////////

Route::get('testimonials',[MaintestimonialController::class,'testimonial']);    //testimonial page

Route::get('about',function(){
    return view('about');                    //about page (fixed content)
});
Route::get('blog',function(){
    return view('blog');                  //blog page (fixed content)
});

Route::get('contact/create',[ContactController::class,'create']);      //contact page
Route::post('contact/store',[ContactController::class,'store'])->name('contactstore');

Route::get('listing',[MaincarController::class,'listing']);                 //listing page
Route::get('/cars/{id}', [MaincarController::class, 'show'])->name('cars.show'); // Single car details page


Route::get('index',[MaincarController::class,'home'])->name('home');     //home page    


//relation one to many (categories & cars)
//category has many cars
//car belongs to category
Route::get('/category/cars',[MaincarController::class,'category_cars']);
Route::get('/car/category',[MaincarController::class,'car_category']);


