<?php

namespace Modules\Auth\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Auth\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Auth\Models\User>
 */
class UserFactory extends Factory {

  /**
   * {@inheritdoc}
   */
  protected $model = User::class;

  /**
   * The current password being used by the factory.
   */
  protected static ?string $password;

  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array {
    $name = $this->faker->userName();
    return [
      'name' => $name,
      'email' => $this->faker->unique()->safeEmail(),
      'email_verified_at' => now(),
      'password' => static::$password ??= Hash::make('password'),
      'remember_token' => Str::random(10),
      'status' => 1,
      'avatar' => 'https://api.dicebear.com/9.x/pixel-art/svg?seed=' . $name,
    ];
  }

  /**
   * Indicate that the model's email address should be unverified.
   */
  public function unverified(): static {
    return $this->state(fn(array $attributes) => [
      'email_verified_at' => NULL,
    ]);
  }

}
