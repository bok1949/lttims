<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomePagesController;
use App\Http\Controllers\AdminOwnerController;
use App\Http\Controllers\EstablishmentController;
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

/* Route::get('/', function () {
    return view('welcome');
}); */


/* Home page */
Route::get('/', [HomePagesController::class, 'lttimsHome'])->name('homepage');


Route::prefix('ao')->group(function(){
    
    Route::get('/logout', [AdminOwnerController::class, 'logout'])->name('ao.logout');
    Route::get('/', [AdminOwnerController::class, 'index'])->name('ao.home');
    Route::post('/login', [AdminOwnerController::class, 'checkCredentials'])->name('check-credentials');
    Route::post('/register', [AdminOwnerController::class, 'estabSaveRegister'])->name('ao.estabSaveRegister');

    Route::middleware(['alreadyLoggedin'])->group(function(){
        Route::get('/login', [AdminOwnerController::class, 'login'])->name('ao.login');
        Route::get('/register', [AdminOwnerController::class, 'register'])->name('ao.register');
    });
    
    Route::middleware(['is.loggedin'])->group(function(){

        Route::middleware(['estabAccount'])->group(function(){
            /* Establishment Routing */
            Route::get('/dl-qr-code/{filename}', [EstablishmentController::class, 'dlQrCode'])->name('dl.qr');
            Route::post('/change-account', [EstablishmentController::class, 'changeAccount'])->name('estab.submitAccountChanges');
            Route::post('/save-photo', [EstablishmentController::class, 'savePhotos'])->name('estab.addPhotos');
            Route::post('/create-qr-code', [EstablishmentController::class, 'createQrCode'])->name('create.qr');
            Route::get('/estab-dashboard', [EstablishmentController::class, 'estabDashboard'])->name('estab.dashboard');
            Route::get('/estab-show-profile', [EstablishmentController::class, 'establishmentProfileShow'])->name('estab.showInfo');
            Route::get('/personal-show-profile', [EstablishmentController::class, 'personalProfileShow'])->name('personal.showInfo');
            Route::get('/view-visitor-by-month', [EstablishmentController::class, 'viewVisitorByMonth'])->name('viewvisitorbymonth');
            Route::get('/view-all-visitor', [EstablishmentController::class, 'viewAllVisitors'])->name('viewallvisitors');
            
        });
        
        Route::middleware(['adminAccount'])->group(function(){
            /* Admin Routing */
            Route::get('/admindashboard', [AdminController::class, 'adminDashboard'])->name('ao.admin-dashboard');
            Route::get('/manage-establishment', [AdminController::class, 'manageEstablishment'])->name('ao.manage-establishment');
            Route::get('/manage-events', [AdminController::class, 'manageEvents'])->name('ao.manage-events');
            Route::get('/manage-reports', [AdminController::class, 'manageReports'])->name('ao.manage-reports');
            Route::get('/manage-personal-profile', [AdminController::class, 'managePersonalProfile'])->name('ao.manage-personal-profile');
        });
        

       
    });
     
});

Route::get('/visitor-logs/{estabid}/form', [EstablishmentController::class, 'visitorLogForm'])->name('visitor-logform');
Route::post('/visitor-logs/submit/form', [EstablishmentController::class, 'visitorLogFormSubmit'])->name('visitor-logform.submit');



