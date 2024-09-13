<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Mail\WeeklyVacanciesDigestMail;
use App\Models\Vacancy;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

/**
 * Send mail notification.
 */
class SendWeeklyVacanciesDigestJob implements ShouldQueue {

  use Queueable, InteractsWithQueue, Dispatchable;

  /**
   * Get the tags that should be assigned to the listener.
   *
   * @return array<int, string>
   */
  public function tags(): array {
    return ['mail:weekly:vacancies_digest'];
  }

  /**
   * Execute the vacancy.
   */
  public function handle(): void {
    $users = User::query()
      ->has('candidateProfile')
      ->get();

    $vacancies = Vacancy::query()
      ->where('created_at', '>', now()->subWeek()->timestamp)
      ->latest('created_at')
      ->limit(20)
      ->get();

    foreach ($users as $user) {
      Mail::send(new WeeklyVacanciesDigestMail($user, $vacancies));
    }

  }

}
