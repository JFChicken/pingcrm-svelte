<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkillsTable extends Migration
{


  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {

    $faker = Faker\Factory::create();

    Schema::create('skills', function (Blueprint $table) use ($faker) {
      $table->id();
      $table->string('name')->default($faker->colorName);
      $table->string('category')->default($faker->currencyCode);
      $table->text('description')->default('non descriptive');
      $table->tinyInteger('subSkill')->nullable();
      $table->json('bonuses')->nullable();
      $table->unsignedTinyInteger('base')->default(0);
      $table->unsignedTinyInteger('bonus')->default(5);

      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('skills');
  }
}
