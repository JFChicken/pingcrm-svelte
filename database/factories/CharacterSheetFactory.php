<?php

namespace Database\Factories;

use App\Models\CharacterSheet;
use Illuminate\Database\Eloquent\Factories\Factory;

class CharacterSheetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CharacterSheet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'character_name' => $this->faker->firstName,
            'character_description' => $this->faker->paragraph,
            'phone' => $this->faker->tollFreePhoneNumber,
            'address' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'region' => $this->faker->state,
            'country' => 'US',
            'postal_code' => $this->faker->postcode,
        ];
    }
}
