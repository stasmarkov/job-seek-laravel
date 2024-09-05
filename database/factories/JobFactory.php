<?php

namespace Database\Factories;

use App\Models\Employer;
use App\Models\Job;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory {

  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array {
    return [
      'employer_id' => Employer::factory(),
      'title' => fake()->jobTitle(),
      'salary' => fake()->randomElement([
        '$50,000 USD',
        '$40,000 USD',
        '$75,000 USD',
        '$150,000 USD',
        '$200,000 USD',
        '$115,000 USD',
        '$35,000 USD',
      ]),
      'location' => fake()->randomElement([
        'Remote',
        'Office',
        'Hybrid',
      ]),
      'schedule' => fake()->randomElement([
        'Part-Time',
        'Full-Time',
        'Contract',
      ]),
      'url' => fake()->url(),
      'featured' => FALSE,
      'description' => fake()->realText(2500),
      'short_description' => fake()->realText(250),
      'created_at' => fake()->time,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function configure() {
    return $this->afterCreating(function (Job $job) {
      $job->tags()->attach(Tag::all()->random(random_int(4, 10)));
    });
  }

}
