<?php

namespace App\Providers;

use App\Models\Appointment;
use App\Models\Service;
use App\Repositories\AppointmentRepository\AppointmentRepository;
use App\Repositories\AppointmentRepository\AppointmentRepositoryInterface;
use App\Repositories\DentistRepository\DentistRepository;
use App\Repositories\DentistRepository\DentistRepositoryInterface;
use App\Repositories\MedicalRecordRepository\MedicalRecordRepository;
// use App\Repositories\MedicalRecordRepository\MedicalRecordRepository;
use App\Repositories\MedicalRecordRepository\MedicalRecordRepositoryInterface;
use App\Repositories\PatientRepository\PatientRepository;
use App\Repositories\PatientRepository\PatientRepositoryInterface;
use App\Repositories\ServiceRepository\ServiceRepository;
use App\Repositories\ServiceRepository\ServiceRepositoryInterface;
use App\Services\AppointmentService;
use App\Services\DentistService;
use App\Services\MedicalRecordService;
use App\Services\PatientService;
use App\Services\ServiceService;
use Database\Seeders\DentistSeeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MedicalRecordRepositoryInterface::class, MedicalRecordRepository::class);
        $this->app->bind(MedicalRecordService::class, function ($app) {
            return new MedicalRecordService($app->make(MedicalRecordRepositoryInterface::class));
        });

        $this->app->bind(DentistRepositoryInterface::class, DentistRepository::class);
        $this->app->bind(DentistService::class, function ($app) {
            return new DentistService($app->make(DentistRepositoryInterface::class));
        });

        $this->app->bind(PatientRepositoryInterface::class, PatientRepository::class);
        $this->app->bind(PatientService::class, function ($app) {
            return new PatientService($app->make(PatientRepositoryInterface::class));
        });

        $this->app->bind(AppointmentRepositoryInterface::class, AppointmentRepository::class);
        $this->app->bind(AppointmentService::class, function ($app) {
            return new AppointmentService($app->make(AppointmentRepositoryInterface::class));
        });

        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);
        $this->app->bind(ServiceService::class, function ($app) {
            return new ServiceService($app->make(ServiceRepositoryInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
