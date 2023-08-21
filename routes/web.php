<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Artisan;




Route::get("/command",function(){
    // Artisan::call('make:controller', ['name' => 'ProvideDeviceController']);
    // Artisan::call('make:controller', ['name' => 'ReturnDeviceController']);
    // Artisan::call('make:controller', ['name' => 'Api/DashboardController']);
    // Artisan::call('make:controller', ['name' => 'DashboardController']);
    // Artisan::call('make:controller', ['name' => 'Api/ReturnDeviceController']);
    // // // table
    // Artisan::call('make:model', ['name' => 'ProvideDevice']);
    // Artisan::call('make:model', ['name' => 'ReturnDevice']);
    // // // migration
    // Artisan::call('make:migration', ['name' => 'create_provide_devices_table']);
    // Artisan::call('make:migration', ['name' => 'create_return_devices_table']);

    // Artisan::call('migrate:rollback --step=1');
    // Artisan::call('migrate');
    // Artisan::call('storage:link');
    // dd("Command successfully");
    return redirect()->route('user.dashboard');
});


Route::get('/', function () {
    if (Auth::check()) {
        $role = Auth::user()->roles[0]->name;
        if ($role == 'user') {
            return redirect()->route('user.home');
        } else {
            return redirect()->route('user.dashboard');
        }
    } else {
        return redirect()->route('user.home');
    }
});

// homepage
Route::get('/home', [HomeController::class, 'home'])->name('user.home');


Route::middleware('role:admin|operation-user|manager|deputy-manager')
    ->get('/user/dashboard', [HomeController::class, 'dashboard'])
    ->name('user.dashboard');



Route::middleware('guest')
    ->name('user.')
    ->group(function () {
        Route::get('/user/login', [AuthController::class, 'userLoginView'])->name('login');
        Route::post('/user/login', [AuthController::class, 'userLogin'])->name('login');
        Route::post('/user/register', [AuthController::class, 'userRegister'])->name('register');
    });

Route::middleware('auth')
    ->get('/user/logout', [AuthController::class, 'userLogout'])->name('user.logout');


foreach (glob(base_path('routes/admin/*.php')) as $route) {
    require_once $route;
}


// Public Routes in web
foreach (glob(base_path('routes/web/*.php')) as $route) {
    require_once $route;
}
