<?php

namespace Modules\Employer\Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Employer\Models\EmployerProfile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Employer\Models\EmployerProfile>
 */
class EmployerProfileFactory extends Factory {

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
