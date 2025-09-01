<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminController\AccountsController;
use App\Http\Controllers\AdminController\DeviceController;
use App\Http\Controllers\AdminController\ExtinguisherController;
use App\Http\Controllers\AdminController\LocationsController;
use App\Http\Controllers\AdminController\QuestionController;
use App\Http\Controllers\AdminController\TypesController;
use App\Http\Controllers\AdminController\ExportController;
use App\Http\Controllers\AdminController\InspectionLogsController;
use App\Http\Controllers\AdminController\RefillLogsController;
use App\Http\Controllers\MaintenanceController\GuideController;
use App\Http\Controllers\MaintenanceController\InspectionController;
use App\Http\Controllers\MaintenanceController\LogsController;
use App\Http\Controllers\MaintenanceController\RefillController;

Route::get('/', [MenuController::class, 'ShowDashboard'])->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'UserType:admin,engineer'])->group(function () {
    Route::get('/Admin/Menu/Accounts', [MenuController::class, 'ShowAdminAccountsMenu'])->name('admin.ShowAccountsMenu');
    Route::get('/Admin/Menu/Extinguisher', [MenuController::class, 'ShowAdminExtinguishersMenu'])->name('admin.ShowExtinguishersMenu');
    Route::get('/Admin/Menu/Inspections', [MenuController::class, 'ShowAdminInspectionMenu'])->name('admin.ShowAdminInspectionMenu');
    Route::get('/Admin/Menu/Devices', [MenuController::class, 'ShowAdminDeviceMenu'])->name('admin.ShowAdminDeviceMenu');




    Route::prefix('Accounts/')->group(function () {
        Route::get('/All', [AccountsController::class, 'ShowAllAccounts'])->name('admin.ShowAllAccounts');
        Route::get('/New', [AccountsController::class, 'ShowAddUserForm'])->name('admin.ShowAddUserForm');
        Route::get('/Password', [AccountsController::class, 'ShowChangePassword'])->name('admin.ShowChangePassword');
        Route::get('/Details/{id}', [AccountsController::class, 'ShowAccountDetails'])->name('admin.ShowAccountDetails');
        Route::put('/Update', [AccountsController::class, 'UpdateUserAccount'])->name('admin.UpdateUserAccount');
        Route::put('/ChangePassword', [AccountsController::class, 'ChangePasswowrd'])->name('admin.ChangePasswowrd');
        Route::post('/Submit', [AccountsController::class, 'CreateUser'])->name('admin.CreateUser');
        Route::delete('/Delete', [AccountsController::class, 'DeleteAccount'])->name('admin.DeleteAccount');
    });

    Route::prefix('Extinguisher')->group(function () {
        Route::get('/Active', [ExtinguisherController::class, 'ShowActiveExtinguishers'])->name('admin.ShowActiveExtinguishers');
        Route::get('/Retired', [ExtinguisherController::class, 'ShowRetiredExtinguishers'])->name('admin.ShowRetiredExtinguishers');
        Route::get('/Add', [ExtinguisherController::class, 'ShowAddTankForm'])->name('admin.ShowAddTankForm');
        Route::get('/Details/{id}', [ExtinguisherController::class, 'ShowExtinguishersDetails'])->name('admin.ShowExtinguishersDetails');
        Route::put('/Update', [ExtinguisherController::class, 'UpdateExtinguishers'])->name('admin.UpdateExtinguishers');
        Route::post('/Submit', [ExtinguisherController::class, 'AddNewTank'])->name('SubmitNewTank');
        Route::delete('/Delete', [ExtinguisherController::class, 'DeleteExtinguisher'])->name('admin.DeleteExtinguisher');
        Route::post('/Qr/Download/Zip', [ExtinguisherController::class, 'downloadZip'])->name('qr.download.zip');
    });

    Route::prefix('Devices')->group(function () {
        Route::get('/', [DeviceController::class, 'ShowDevices'])->name('admin.ShowDevices');
        Route::get('/new', [DeviceController::class, 'ShowAddForm'])->name('admin.ShowAddForm');
        Route::post('/Create', [DeviceController::class, 'CreateDevice'])->name('admin.CreateDevice');
        Route::put('/Update', [DeviceController::class, 'UpdateDevice'])->name('admin.UpdateDevice');
        Route::get('/Details/{id}', [DeviceController::class, 'ShowDeviceDetails'])->name('admin.ShowDeviceDetails');
        Route::delete('/Delete', [DeviceController::class, 'DeleteDevice'])->name('admin.DeleteDevice');


        Route::post('/New/Certificate', [DeviceController::class, 'StoreCertificate'])->name('admin.StoreCertificate');
        Route::put('/Update/Certificate', [DeviceController::class, 'UpdateCertificate'])->name('admin.UpdateCertificate');
    });



    Route::prefix('Types')->group(function () {
        Route::get('/', [TypesController::class, 'ShowTypes'])->name('admin.ShowTypes');
        Route::put('/Update', [TypesController::class, 'UpdateType'])->name('admin.UpdateType');
        Route::post('/Submit', [TypesController::class, 'SubmitNewType'])->name('admin.SubmitNewType');
        Route::delete('/Delete', [TypesController::class, 'DeleteTypes'])->name('admin.DeleteTypes');
    });

    Route::prefix('Locations')->group(function () {
        Route::get('/', [LocationsController::class, 'ShowLocations'])->name('admin.ShowLocations');
        Route::put('/Update', [LocationsController::class, 'UpdateLocation'])->name('admin.UpdateLocation');
        Route::post('/Submit', [LocationsController::class, 'SubmitNewLocation'])->name('admin.SubmitNewLocation');
        Route::delete('/Delete', [LocationsController::class, 'DeleteLocation'])->name('admin.DeleteLocation');
    });

    Route::prefix('Questions/')->group(function () {
        Route::get('/', [QuestionController::class, 'ShowAllQuestions'])->name('admin.ShowAllQuestions');
        Route::put('/Update', [QuestionController::class, 'UpdateQuestion'])->name('admin.UpdateQuestion');
        Route::put('/Asign', [QuestionController::class, 'AssignInspectionQuestion'])->name('admin.AssignInspectionQuestion');
        Route::post('/Submit', [QuestionController::class, 'SubmitNewQuestion'])->name('admin.SubmitNewQuestion');
        Route::delete('/Delete', [QuestionController::class, 'DeleteQuestions'])->name('admin.DeleteQuestions');
    });

    Route::prefix('/Inspection/Logs/')->group(function () {
        Route::get('/Recent', [InspectionLogsController::class, 'ShowRecentLogs'])->name('admin.ShowRecentLogs');
        Route::get('/Answer/{id}', [InspectionLogsController::class, 'ShowInspectionAnswer'])->name('admin.ShowInspectionAnswer');
        Route::get('/Extinguishers', [InspectionLogsController::class, 'ShowInspectionExtinguishers'])->name('admin.ShowInspectionExtinguishers');
        Route::get('/Table/{id}', [InspectionLogsController::class, 'ShowInspectionLogsTable'])->name('admin.ShowInspectionLogsTable');
    });

    Route::get('/Extinguisher/location/get', [ExtinguisherController::class, 'GetLocations']);
    Route::get('/Extinguisher/location/edit', [ExtinguisherController::class, 'GetEditLocations']);
    Route::get('/Extinguisher/location-id', [ExtinguisherController::class, 'GetLocationID']);
    Route::get('/Extinguisher/location/show/{id}', [ExtinguisherController::class, 'showLocationById']);
    Route::get('/Extinguisher/location/show/{id}', [ExtinguisherController::class, 'ShowLocationID']);


    Route::prefix('Export')->group(function () {
        Route::get('/Logs', [ExportController::class, 'ShowExportForm'])->name('admin.ShowExportForm');
        Route::get('/Export', [ExportController::class, 'export'])->name('inspections.export');
    });

    Route::prefix('Refill/Logs')->group(function () {
        Route::get('/History', [RefillLogsController::class, 'ShowAllRefills'])->name('admin.ShowAllRefills');
    });
});

Route::middleware(['auth', 'UserType:maintenance,guard'])->group(function () {
    Route::get('/Maintenance/Menu/Inspections', [MenuController::class, 'ShowMaintenanceExtinguishersMenu'])->name('maintenance.ShowMaintenanceExtinguishersMenu');
    Route::get('/Admin/Menu/Emergencyplans', [MenuController::class, 'ShowEmergencyPlansMenu'])->name('maintenance.ShowEmergencyPlansMenu');


    Route::prefix('Scanner')->group(function () {
        Route::get('/', [InspectionController::class, 'ShowScanner'])->name('maintenance.ShowScanner');
    });

    Route::prefix('Inspection')->group(function () {
        Route::get('/Details/{id}', [InspectionController::class, 'ShowInspectionDetail'])->name('maintenance.ShowInspectionDetail');
        Route::get('/Start/{id}', [InspectionController::class, 'StartInspection'])->name('maintenance.StartInspection');
        Route::get('/confirmation', [InspectionController::class, 'ShowInspectionConfirmation'])->name('maintenance.ShowConfirmation');
        Route::post('/Submit', [InspectionController::class, 'SubmitInspection'])->name('maintenance.SubmitInspection');
    });

    Route::prefix('Logs')->group(function () {
        Route::get('/Recent', [LogsController::class, 'ShowRecentInspected'])->name('maintenance.ShowRecentInspected');
        Route::get('/History/Answer/{id}', [LogsController::class, 'ShowInspectionAnswer'])->name('maintenance.ShowInspectionAnswer');
        Route::get('/History/{id}', [LogsController::class, 'ShowInspectionLogs'])->name('maintenance.ShowInspectionLogs');
        Route::get('/Nextdue', [LogsController::class, 'ShowNearInspection'])->name('maintenance.ShowNearInspection');
    });

    Route::prefix('Refill')->group(function () {
        Route::get('/Form/{id}', [RefillController::class, 'ShowRefillForm'])->name('maintenance.ShowRefillForm');
        Route::get('/confirmation', [RefillController::class, 'ShowRefillConfirmation'])->name('maintenance.ShowRefillConfirmation');
        Route::post('/Submit', [RefillController::class, 'SubmitRefill'])->name('maintenance.SubmitRefill');
    });

    Route::prefix('Guide')->group(function () {
        Route::get('/', [GuideController::class, 'ShowGuide'])->name('maintenance.ShowInspectionGuide');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('Accounts/')->group(function () {
        Route::get('/Profile', [AccountsController::class, 'ShowProfile'])->name('admin.ShowProfile');
    });
});

require __DIR__ . '/auth.php';
