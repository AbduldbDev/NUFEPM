<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminController\AccountsController;
use App\Http\Controllers\AdminController\BuildingController;
use App\Http\Controllers\AdminController\DeviceController;
use App\Http\Controllers\AdminController\EmergencyHotlinesController;
use App\Http\Controllers\AdminController\ExtinguisherController;
use App\Http\Controllers\AdminController\LocationsController;
use App\Http\Controllers\AdminController\QuestionController;
use App\Http\Controllers\AdminController\TypesController;
use App\Http\Controllers\AdminController\ExportController;
use App\Http\Controllers\AdminController\InspectionGuideController;
use App\Http\Controllers\AdminController\InspectionLogsController;
use App\Http\Controllers\AdminController\RefillLogsController;
use App\Http\Controllers\AdminController\SOSReportController;
use App\Http\Controllers\AdminController\EmergencyPlanController;
use App\Http\Controllers\AdminController\TicketsController;
use App\Http\Controllers\MaintenanceController\GuideController;
use App\Http\Controllers\MaintenanceController\InspectionController;
use App\Http\Controllers\MaintenanceController\LogsController;
use App\Http\Controllers\MaintenanceController\RefillController;
use App\Http\Controllers\MaintenanceController\UserTicketController;
use App\Http\Controllers\NotificationController;

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
        Route::get('/Active/{type}', [ExtinguisherController::class, 'ShowActiveTypeExtinguishers'])->name('admin.ShowActiveTypeExtinguishers');
        Route::get('/Retired', [ExtinguisherController::class, 'ShowRetiredExtinguishers'])->name('admin.ShowRetiredExtinguishers');
        Route::get('/Retired/{type}', [ExtinguisherController::class, 'ShowRetiredTypeExtinguishers'])->name('admin.ShowRetiredTypeExtinguishers');
        Route::get('/Add', [ExtinguisherController::class, 'ShowAddTankForm'])->name('admin.ShowAddTankForm');
        Route::get('/Details/{id}', [ExtinguisherController::class, 'ShowExtinguishersDetails'])->name('admin.ShowExtinguishersDetails');
        Route::put('/Update', [ExtinguisherController::class, 'UpdateExtinguishers'])->name('admin.UpdateExtinguishers');
        Route::post('/Submit', [ExtinguisherController::class, 'AddNewTank'])->name('SubmitNewTank');
        Route::delete('/Delete', [ExtinguisherController::class, 'DeleteExtinguisher'])->name('admin.DeleteExtinguisher');
        Route::post('/Qr/Download/Zip', [ExtinguisherController::class, 'downloadZip'])->name('qr.download.zip');
    });

    Route::prefix('Devices')->group(function () {
        Route::get('/', [DeviceController::class, 'ShowDevices'])->name('admin.ShowDevices');
        Route::get('/type/{type}', [DeviceController::class, 'ShowTypeDevices'])->name('admin.ShowTypeDevices');
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
        Route::get('/building/{building}', [LocationsController::class, 'ShowAddLocationBuilding'])->name('admin.ShowAddLocationBuilding');
        Route::put('/Update', [LocationsController::class, 'UpdateLocation'])->name('admin.UpdateLocation');
        Route::post('/Submit', [LocationsController::class, 'SubmitNewLocation'])->name('admin.SubmitNewLocation');
        Route::delete('/Delete', [LocationsController::class, 'DeleteLocation'])->name('admin.DeleteLocation');
    });


    Route::prefix('Locations/buildings')->group(function () {
        Route::get('/new', [BuildingController::class, 'NewBuildingForm'])->name('admin.NewBuildingForm');
        Route::put('/update', [BuildingController::class, 'UpdateBuilding'])->name('admin.UpdateBuilding');
        Route::post('/create', [BuildingController::class, 'SubmitNewBuilding'])->name('admin.SubmitNewBuilding');
        Route::delete('/Delete', [BuildingController::class, 'DeleteBuilding'])->name('admin.DeleteBuilding');
    });

    Route::prefix('Questions/')->group(function () {
        Route::get('/', [QuestionController::class, 'ShowAllQuestions'])->name('admin.ShowAllQuestions');
        Route::get('/type/{type}', [QuestionController::class, 'ShowQuestionType'])->name('admin.ShowQuestionType');
        Route::put('/Update', [QuestionController::class, 'UpdateQuestion'])->name('admin.UpdateQuestion');
        Route::put('/Asign', [QuestionController::class, 'AssignInspectionQuestion'])->name('admin.AssignInspectionQuestion');
        Route::post('/Submit', [QuestionController::class, 'SubmitNewQuestion'])->name('admin.SubmitNewQuestion');
        Route::delete('/Delete', [QuestionController::class, 'DeleteQuestions'])->name('admin.DeleteQuestions');
    });

    Route::prefix('/Inspection/Logs/')->group(function () {
        Route::get('/Recent', [InspectionLogsController::class, 'ShowRecentLogs'])->name('admin.ShowRecentLogs');
        Route::get('/Answer/{id}', [InspectionLogsController::class, 'ShowInspectionAnswer'])->name('admin.ShowInspectionAnswer');
        Route::get('/Extinguishers', [InspectionLogsController::class, 'ShowInspectionExtinguishers'])->name('admin.ShowInspectionExtinguishers');
        Route::get('/Extinguishers/{type}', [InspectionLogsController::class, 'ShowTypeInspectionExtinguishers'])->name('admin.ShowTypeInspectionExtinguishers');
        Route::get('/Table/{id}', [InspectionLogsController::class, 'ShowInspectionLogsTable'])->name('admin.ShowInspectionLogsTable');
    });

    Route::prefix('/Extinguisher/location')->group(function () {
        Route::get('/get', [ExtinguisherController::class, 'GetLocations']);
        Route::get('/edit', [ExtinguisherController::class, 'GetEditLocations']);
        Route::get('/id', [ExtinguisherController::class, 'GetLocationID']);
        Route::get('/show/{id}', [ExtinguisherController::class, 'showLocationById']);
        Route::get('/show/{id}', [ExtinguisherController::class, 'ShowLocationID']);
    });

    Route::prefix('Export/Menu')->group(function () {
        Route::get('/Logs', [ExportController::class, 'ShowExportMenu'])->name('admin.ShowExportForm');
        Route::get('/Extinguisher', [ExportController::class, 'ShowExportExtinguisher'])->name('admin.ShowExportExtinguisher');
        Route::get('/Refill', [ExportController::class, 'ShowExportRefill'])->name('admin.ShowExportRefill');
        Route::get('/Incident', [ExportController::class, 'ShowExportIncident'])->name('admin.ShowExportIncident');
        Route::get('/Devices', [ExportController::class, 'ShowExportDevices'])->name('admin.ShowExportDevices');
    });

    Route::prefix('Export')->group(function () {
        Route::get('/Export', [ExportController::class, 'export'])->name('inspections.export');
        Route::get('/Expiration', [ExportController::class, 'expiration'])->name('export.expiration');
        Route::get('/Notinspect', [ExportController::class, 'notinspect'])->name('export.notinspect');
        Route::get('/RefillLogs', [ExportController::class, 'exportRefillLogs'])->name('export.refilllogs');
        Route::get('/nearexpiration', [ExportController::class, 'exportNearExpiryCertificates'])->name('export.exportNearExpiryCertificates');
        Route::get('/all-equipment', [ExportController::class, 'exportAllEquipment'])->name('export.exportAllEquipment');
        Route::get('/completedsos', [ExportController::class, 'exportCompletedSOS'])->name('export.completedsos');
        Route::get('/ExpiredExtinguishers', [ExportController::class, 'ExpiredExtinguishers'])->name('export.ExpiredExtinguishers');
    });

    Route::prefix('Refill/Logs')->group(function () {
        Route::get('/History', [RefillLogsController::class, 'ShowAllRefills'])->name('admin.ShowAllRefills');
    });

    Route::prefix('Guide/Management')->group(function () {
        Route::get('/', [InspectionGuideController::class, 'ShowGuideTable'])->name('admin.ShowGuideTable');
        Route::get('/type/{type}', [InspectionGuideController::class, 'ShowInspectionType'])->name('admin.ShowInspectionType');
        Route::post('/Create', [InspectionGuideController::class, 'AddNewGuide'])->name('admin.AddNewGuide');
        Route::put('/Update', [InspectionGuideController::class, 'UpdateGuide'])->name('admin.UpdateGuide');
        Route::delete('/delete', [InspectionGuideController::class, 'DeleteGuide'])->name('admin.DeleteGuide');
    });

    Route::prefix('SOS/Reports')->group(function () {
        Route::get('/', [SOSReportController::class, 'ShowAll'])->name('admin.ShowSOSReports');
        Route::get('details/{id}', [SOSReportController::class, 'ShowDetails'])->name('admin.ShowDetails');
        Route::put('/update', [SOSReportController::class, 'UpdateSOS'])->name('admin.UpdateSOS');
        Route::delete('delete/{id}', [SOSReportController::class, 'DestroyReport'])->name('admin.DeleteSOSReport');
    });

    Route::prefix('EmergencyPlans')->group(function () {
        Route::get('/manage', [EmergencyPlanController::class, 'ManageEmergencyPlans'])->name('admin.ManageEmergencyPlans');
        Route::put('/update', [EmergencyPlanController::class, 'UpdateEmergencyPlan'])->name('admin.UpdateEmergencyPlan');
    });

    Route::prefix('/EmergencyHotlines')->group(function () {
        Route::get('/', [EmergencyHotlinesController::class, 'ManageEmergencyHotlines'])->name('admin.ManageEmergencyHotlines');
        Route::post('/Create', [EmergencyHotlinesController::class, 'CreateHotline'])->name('admin.SubmitNewHotline');
        Route::put('/Update', [EmergencyHotlinesController::class, 'UpdateHotline'])->name('admin.UpdateHotline');
        Route::delete('/delete', [EmergencyHotlinesController::class, 'DeleteEmergencyHotline'])->name('admin.DeleteEmergencyHotline');
    });

    Route::prefix('/Tickets')->group(function () {
        Route::get('/', [TicketsController::class, 'ShowAll'])->name('admin.ShowAllTickets');
        Route::get('/new', [TicketsController::class, 'AddNew'])->name('admin.ShowAllTickets');
        Route::get('/details/{id}', [TicketsController::class, 'ShowDetails'])->name('admin.ShowDetailsTicket');
        Route::post('/create', [TicketsController::class, 'CreateTicket'])->name('admin.CreateNewTicket');
        Route::put('/update', [TicketsController::class, 'UpdateTicket'])->name('admin.UpdateTicket');
        Route::delete('/delete', [TicketsController::class, 'DeleteTicket'])->name('admin.DeleteTicket');
    });
});


Route::middleware(['auth'])->group(function () {
    Route::get('/Maintenance/Menu/Inspections', [MenuController::class, 'ShowMaintenanceExtinguishersMenu'])->name('maintenance.ShowMaintenanceExtinguishersMenu');

    Route::get('/EmergencyPlans', [EmergencyPlanController::class, 'ShowEmergencyPlansMenu'])->name('maintenance.ShowEmergencyPlansMenu');
    Route::get('/EmergencyPlans/{building}', [EmergencyPlanController::class, 'ShowFloorPlans'])->name('maintenance.ShowFloorPlans');

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
        Route::get('/type/{type}', [GuideController::class, 'ShowInspectionType'])->name('maintenance.ShowInspectionType');
    });

    Route::prefix('Hotlines')->group(function () {
        Route::get('/', [GuideController::class, 'ShowHotlines'])->name('maintenance.ShowHotlinesGuide');
    });

    Route::prefix('SOS/Reports')->group(function () {
        Route::get('/create', [SOSReportController::class, 'ShowCreateForm'])->name('maintenance.CreateSOSReport');
        Route::post('/submit', [SOSReportController::class, 'StoreReport'])->name('maintenance.SubmitSOSReport');
    });

    Route::prefix('Accounts/')->group(function () {
        Route::get('/Profile', [AccountsController::class, 'ShowProfile'])->name('admin.ShowProfile');
    });

    Route::prefix('Scanner')->group(function () {
        Route::get('/', [InspectionController::class, 'ShowScanner'])->name('maintenance.ShowScanner');
    });

    Route::prefix('notifications/')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('notifications.index');
        Route::post('/mark-all-read', [NotificationController::class, 'markAllRead'])->name('notifications.markAllRead');
        Route::post('/{id}/mark-read', [NotificationController::class, 'markRead'])->name('notifications.markRead');
        Route::delete('/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    });

    Route::prefix('Notification/Extinguishers/')->group(function () {
        Route::get('/NearMaintenance', [NotificationController::class, 'NearMaintenance'])->name('admin.NearMaintenance');
        Route::get('/OverDueInspection', [NotificationController::class, 'OverDueInspection'])->name('admin.OverDueInspection');
        Route::get('/ExpiredLifeSpan', [NotificationController::class, 'ExpiredLifeSpan'])->name('admin.ExpiredLifeSpan');
        Route::get('/NearExpiration', [NotificationController::class, 'NearExpiration'])->name('admin.NearExpiration');
        Route::get('/NearExpirationDevice', [NotificationController::class, 'NearExpirationDevice'])->name('admin.NearExpirationDevice');
        Route::get('/ExpiredDevice', [NotificationController::class, 'ExpiredDevice'])->name('admin.ExpiredDevice');
    });
    Route::prefix('Notification/Devices/')->group(function () {
        Route::get('/NearExpirationDevice', [NotificationController::class, 'NearExpirationDevice'])->name('admin.NearExpirationDevice');
        Route::get('/ExpiredDevice', [NotificationController::class, 'ExpiredDevice'])->name('admin.ExpiredDevice');
    });

    Route::prefix('User/Tickets')->group(function () {
        Route::get('/', [UserTicketController::class, 'ShowAll'])->name('admin.ShowAllTickets');
        Route::get('/details/{id}', [UserTicketController::class, 'ShowDetails'])->name('admin.ShowDetailsTicket');
        Route::put('/complete', [UserTicketController::class, 'UpdateTicketUser'])->name('admin.UpdateTicketUser');
    });
});

require __DIR__ . '/auth.php';
