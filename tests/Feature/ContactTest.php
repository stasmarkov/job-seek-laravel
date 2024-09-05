<?php

use App\Models\Employer;
use App\Models\User;
use Illuminate\Support\Facades\Context;

it('contact us queued only 1 job item', function() {
  $user = User::factory()->create();
  $employer = Employer::factory()->create();
  $user->employer()->save($employer);

  $this->actingAs($user);
  $this->post('/contact', [
    'contact_message' => 'Some Placeholder',
  ])->assertStatus(302);

  $stack = Context::get('queued_jobs');
  expect(count($stack))->toBe(1);
});
