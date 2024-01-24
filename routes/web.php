<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\Home\AboutController;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\Home\PortfolioController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.index');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

//admin all route
Route::controller(AdminController::class)->group(function(){
    Route::get('/admin/logout', 'destroy')->name('admin.logout');
    Route::get('/admin/profile', 'Profile')->name('admin.profile');
    Route::get('/edit/profile', 'EditProfile')->name('edit.profile');
    Route::post('/store/profile', 'StoreProfile')->name('store.profile');
    
    Route::get('/change/password', 'ChangePassword')->name('change.password');
    Route::post('/update/password', 'UpdatePassword')->name('update.password');
});

Route::controller(HomeSliderController::class)->group(function(){
    Route::get('/home/slide', 'HomeSlider')->name('home.slide');
    Route::post('/update/slider', 'UpdateSlider')->name('update.slider');
});

Route::controller(AboutController::class)->group(function(){
    Route::get('/about/slide', 'AboutSlider')->name('about.slide');
    Route::post('/update/AboutSlider', 'UpdateAboutSlider')->name('update.AboutSlider');

    Route::get('/about', 'HomeAbout')->name('home.about');
   
    Route::get('/about/multiImage', 'AboutMultiImage')->name('about.multiImage');
});

// Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


//portfolio all route
Route::controller(PortfolioController::class)->group(function(){
    Route::get('/all/portfolio', 'AllPortfolio')->name('all.portfolio');
    Route::get('/add/portfolio', 'AddPortfolio')->name('add.portfolio');

    Route::post('/store/portfolio', 'StorePortfolio')->name('store.portfolio');

    Route::get('/edit/portfolio/{id}', 'EditPortfolio')->name('edit.portfolio');
    Route::post('/update/portfolio', 'UpdatePortfolio')->name('update.portfolio');
    Route::get('/delete/portfolio/{id}', 'DeletePortfolio')->name('delete.portfolio');

    Route::get('/portfolio/details/{id}', 'DetailsPortfolio')->name('portfolio.details');
});

 // Blog Category All Routes 
 Route::controller(BlogCategoryController::class)->group(function () {
    Route::get('/all/blog_category', 'AllBlogCategory')->name('all.blog_category');
    Route::get('/add/blog_category', 'AddBlogCategory')->name('add.blog_category');


});


require __DIR__.'/auth.php';


