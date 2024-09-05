<?php

use Illuminate\Support\Facades\Context;
use Inertia\Testing\AssertableInertia as Assert;


it('user see the page', function() {
  $response = $this->get(route('search.jobs'));

//  $this->browse(function (Browser $borwser))
//
//  $response->assertInertia(function (Assert $page) {
//    $page->component('Sear')->
//  })
  $response->assertOk();
  $response->assertSee('Let\'s Find Your Next Job');
});
