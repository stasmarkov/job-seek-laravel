<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Enums\UserRolesEnum;
use App\Mail\ContactUsMail;
use App\Mail\WeeklyJobsDigestMail;
use App\Models\Job;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

/**
 * Send mail notification.
 */
class SendWeeklyJobsDigestJob implements ShouldQueue {

  use Queueable, InteractsWithQueue, Dispatchable;

  /**
   * Get the tags that should be assigned to the listener.
   *
   * @return array<int, string>
   */
  public function tags(): array {
    return ['mail:weekly:jobs_digest'];
  }

  /**
   * Execute the job.
   */
  public function handle(): void {
    $users = User::query()
      ->has('candidateProfile')
      ->get();

    $jobs = Job::query()
      ->where('created_at', '>', now()->subWeek()->timestamp)
      ->latest('created_at')
      ->limit(20)
      ->get();

    foreach ($users as $user) {
      Mail::send(new WeeklyJobsDigestMail($user, $jobs));
    }

  }

}
