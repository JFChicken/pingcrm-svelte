<?php

namespace Database\Seeders;

use App\Models\Skills;
use Illuminate\Database\Seeder;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
      Skills::factory()->create();
    }
}
