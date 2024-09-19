<?php

namespace Modules\Candidate\Database\Factories;

use App\Models\ContactInformation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactInformation>
 */
class ContactInformationFactory extends Factory {

  /**
   * {@inheritdoc}
   */
  protected $model = ContactInformation::class;

  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array {
    return [
      'user_id' => User::factory(),
      'email' => $this->faker->safeEmail(),
      'phone' => $this->faker->phoneNumber(),
    ];
  }

}
