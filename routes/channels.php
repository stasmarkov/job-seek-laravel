<?php

use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('App.Models.Job.{job}', function (User $user, Job $job) {
    return $user->id === $job->employer->user_id;
});

Broadcast::channel('job', function (User $user) {
    return TRUE;
});
