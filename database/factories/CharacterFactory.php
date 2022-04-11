<?php

namespace Database\Factories;

use App\Models\Character;
use Illuminate\Database\Eloquent\Factories\Factory;

class CharacterFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Character::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    $stats = [];
    for ($x = 0; $x <= 7; $x++) {
      $stats['stat' . $x] = rand(rand(1, 10), rand(10, 20));
    }

    return [
      'name' => $this->faker->name(),
      'stats' => $stats,
      //
    ];
  }
}
