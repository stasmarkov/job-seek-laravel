<?php

namespace Modules\Candidate\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Auth\Models\User;
use Modules\Candidate\Models\ContactInformation;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Candidate\Models\ContactInformation>
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
