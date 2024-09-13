<?php

declare(strict_types = 1);

use App\Jobs\SendWeeklyVacanciesDigestJob;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::job(new SendWeeklyVacanciesDigestJob, 'mail', 'redis')
  ->weekly()
  ->fridays()
  ->dailyAt('18:10')
  ->name('mail_notification.weekly_vacancies_digest');
