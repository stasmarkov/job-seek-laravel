<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CandidateProfile>
 */
class CandidateProfileFactory extends Factory {

  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array {
    return [
      'first_name' => $this->faker->firstName(),
      'last_name' => $this->faker->lastName(),
      'description' => $this->faker->realText(1000),
      'achievements' => $this->faker->realText(),
      'experience_since' => $this->faker,
      'user_id' => User::factory(),
    ];
  }

}
