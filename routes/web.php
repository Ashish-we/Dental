<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TeethController;
use App\Http\Controllers\DentistController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProcedureController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\FollowUpController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceCategoryController;
use App\Models\FollowUp;
use App\Models\ServiceCategory;
use JeroenNoten\LaravelAdminLte\View\Components\Widget\ProfileColItem;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', function () {
    return redirect('/login');
})->name('home');


// Route::get('',[HomeController::class,'home'])->name('auth.login');



Route::middleware('auth')->group(function () {
    Route::resource('/dashboard', DashboardController::class);
    Route::resource('/patients', PatientController::class);
    Route::resource('/dentists', DentistController::class);
    Route::resource('/staffs', StaffController::class);
    Route::resource('/teeths', TeethController::class);
    Route::resource('/services', ServiceController::class);
    Route::resource('/procedures', ProcedureController::class);
    Route::get('/procedures/create/{id}', [ProcedureController::class, 'create'])->name('procedures.create');
    Route::post('/procedures/{id}', [ProcedureController::class, 'update'])->name('procedures.update');
    Route::resource('/medicalRecords', MedicalRecordController::class);
    Route::resource('/appointments', AppointmentController::class);
    Route::resource('/types', TypeController::class);
    Route::post('/assign_admin/{id}', [AdminController::class, 'assign_admin'])->name('allign_admin');
    Route::resource('/serviceCategories', ServiceCategoryController::class);

    Route::get(
        'notifications/get',
        [NotificationController::class, 'getNotificationsData']
    )->name('notifications.get');
    Route::get(
        'notifications/read/{id}',
        [NotificationController::class, 'markANotificationAsRead']
    )->name('notifications.read');

    //route for followUps 
    Route::get('/followUps/show/{id}', [FollowUpController::class, 'show'])->name('followUps.show');
    Route::get('/followUps', [FollowUpController::class, 'index'])->name('followUps.index');
    Route::get('/followUps/create/{id}', [FollowUpController::class, 'create'])->name('followUps.create');
    Route::post('/followUps/sotre', [FollowUpController::class, 'store'])->name('followUps.store');
    Route::get('/followUps/edit/{id}', [FollowUpController::class, 'edit'])->name('followUps.edit');
    Route::Put('/followUps/update/{id}', [FollowUpController::class, 'update'])->name('followUps.update');
    Route::delete('/followUps/{id}', [FollowUpController::class, 'destroy'])->name('followUps.destroy');
    //ends here

    //route for profile
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::PUT('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get("password/change", [ProfileController::class, 'password_change'])->name('password.change');
    Route::Put("password/change", [ProfileController::class, 'password_update'])->name('password.update');
});
Route::resource('/appointments', AppointmentController::class)->except(['create']);
Route::get('/appointments/create/{patient_id?}', [AppointmentController::class, 'create'])->name('appointments.create');
