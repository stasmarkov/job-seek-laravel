<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\AuthServiceProvider::class,
    App\Providers\Filament\AdminPanelProvider::class,
    App\Providers\HorizonServiceProvider::class,
    \Modules\Candidate\Providers\CandidateServiceProvider::class,
    \Modules\Vacancy\Providers\VacancyServiceProvider::class,
    \Modules\Employer\Providers\EmployerServiceProvider::class,
];
