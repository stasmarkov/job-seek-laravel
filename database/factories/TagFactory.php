<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory {

  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array {
    return [
      'name' => $this->faker->unique()->randomElement([
        'PHP',
        'C',
        'C++',
        'C#',
        'GO',
        'Ruby',
        'Ruby on Rails',
        'Java',
        'Laravel',
        'MySQL',
        'PostgresSQL',
        'Drupal',
        'Node.js',
        'Vue.js',
        'React.js',
        'Azure',
        'AWS',
        'HTML',
        'SCSS',
        'Back-end',
        'Front-end',
        'SCRUM',
        'SOLID',
        'OOP',
        'Project Manager',
        'Delivery Manager',
        'Architect',
        'PM',
      ]),
    ];
  }

}
