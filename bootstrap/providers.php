<?php

declare(strict_types = 1);

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\Filament\AdminPanelProvider::class,
    App\Providers\HorizonServiceProvider::class,
    \Modules\Candidate\Providers\CandidateServiceProvider::class,
    \Modules\Vacancy\Providers\VacancyServiceProvider::class,
    \Modules\Employer\Providers\EmployerServiceProvider::class,
    \Modules\Auth\Providers\AuthServiceProvider::class,
];
