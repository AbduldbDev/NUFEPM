<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminController\AccountsController;
use App\Http\Controllers\AdminController\ExtinguisherController;
use App\Http\Controllers\AdminController\LocationsController;
use App\Http\Controllers\AdminController\TypesController;
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('admin.dashboard');
})->middleware(['auth'])->name('dashboard');




Route::get('/Accounts', [MenuController::class, 'ShowAccountsMenu'])->name('admin.ShowAccountsMenu');
Route::get('/Accounts/All', [AccountsController::class, 'ShowAllAccounts'])->name('admin.ShowAllAccounts');
Route::get('/Accounts/New', [AccountsController::class, 'ShowAddUserForm'])->name('admin.ShowAddUserForm');
Route::get('/Accounts/Profile', [AccountsController::class, 'ShowProfile'])->name('admin.ShowProfile');
Route::get('/Accounts/Details/{id}', [AccountsController::class, 'ShowAccountDetails'])->name('admin.ShowAccountDetails');


Route::get('/Extinguisher', [MenuController::class, 'ShowExtinguishersMenu'])->name('admin.ShowExtinguishersMenu');
Route::get('/Extinguisher/Add', [ExtinguisherController::class, 'ShowAddTankForm'])->name('admin.ShowAddTankForm');
Route::post('/Extinguisher/Submit', [ExtinguisherController::class, 'AddNewTank'])->name('SubmitNewTank');

Route::delete('/Accounts/Submit', [AccountsController::class, 'DeleteAccount'])->name('admin.DeleteAccount');
Route::post('/Accounts/Submit', [AccountsController::class, 'CreateUser'])->name('admin.CreateUser');
Route::post('/Accounts/Update', [AccountsController::class, 'UpdateUserAccount'])->name('admin.UpdateUserAccount');


Route::get('/Locations', [LocationsController::class, 'ShowLocations'])->name('admin.ShowLocations');

Route::get('/Types', [TypesController::class, 'ShowTypes'])->name('admin.ShowTypes');
Route::post('/Types/Submit', [TypesController::class, 'SubmitNewType'])->name('admin.SubmitNewType');
Route::put('/Types/Update', [TypesController::class, 'UpdateType'])->name('admin.UpdateType');
Route::delete('/Types/Delete', [TypesController::class, 'DeleteTypes'])->name('admin.DeleteTypes');






Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route::get('/Extinguisher/New', [ExtinguisherController::class, 'ShowAddTankForm'])->name('ShowAddTankForm');

});

require __DIR__ . '/auth.php';
