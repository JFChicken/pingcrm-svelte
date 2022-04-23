<?php

namespace Database\Factories;

use App\Models\Skills;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker;
use BlogArticleFaker;
use Illuminate\Foundation\Testing\WithFaker;

class SkillsFactory extends Factory
{

  use WithFaker;
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Skills::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

      $faker = Faker\Factory::create();

      $faker->addProvider(new BlogArticleFaker\FakerProvider($faker));

      $stats = [];
      for ($x = 0; $x <= 7; $x++) {
        $stats['stat' . $x] = rand(rand(0, 2), (rand(2, 4)+1));
      }

        return [
            //
          'name' => $faker->title,
          'category' => $faker->currencyCode,
//          'description'=> $faker->articleTitle,
          'bonuses'=>json_encode($stats),
          'base'=>rand(1,85),
          'bonus'=>rand(3,5),
        ];
    }
}
