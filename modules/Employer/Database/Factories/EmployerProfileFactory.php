<?php

namespace Modules\Employer\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Auth\Models\User;
use Modules\Employer\Models\EmployerProfile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Employer\Models\EmployerProfile>
 */
class EmployerProfileFactory extends Factory {

  /**
   * {@inheritdoc}
   */
  protected $model = EmployerProfile::class;

  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array {
    return [
      'name' => $this->faker->name,
      'logo' => $this->faker->imageUrl(),
      'user_id' => User::factory(),
    ];
  }

}
