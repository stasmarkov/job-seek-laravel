<?php

declare(strict_types = 1);

namespace Modules\Vacancy\Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Employer\Models\EmployerProfile;
use Modules\Vacancy\Models\Vacancy;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Vacancy\Models\Vacancy>
 */
class VacancyFactory extends Factory {

  /**
   * {@inheritdoc}
   */
  protected $model = Vacancy::class;

  /**
   * {@inheritdoc}
   */
  public function definition(): array {
    return [
      'uuid' => $this->faker->uuid(),
      'employer_profile_id' => EmployerProfile::factory(),
      'title' => $this->faker->jobTitle(),
      'salary' => $this->faker->randomElement([
        '$50,000 USD',
        '$40,000 USD',
        '$75,000 USD',
        '$150,000 USD',
        '$200,000 USD',
        '$115,000 USD',
        '$35,000 USD',
      ]),
      'location' => $this->faker->randomElement([
        'Remote',
        'Office',
        'Hybrid',
      ]),
      'schedule' => $this->faker->randomElement([
        'Part-Time',
        'Full-Time',
        'Contract',
      ]),
      'url' => $this->faker->url(),
      'featured' => FALSE,
      'description' => $this->faker->realText(2500),
      'short_description' => $this->faker->realText(250),
      'created_at' => $this->faker->time,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function configure() {
    return $this->afterCreating(function (Vacancy $vacancy) {
      $vacancy->tags()->attach(Tag::all()->random(random_int(4, 12)));
    });
  }

}
