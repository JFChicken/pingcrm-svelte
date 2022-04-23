<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CharacterSkillsPivotCreate extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('character_skill', function (Blueprint $table) {
      $table->foreignIdFor(\App\Models\Character::class);
      $table->foreignIdFor(\App\Models\Skills::class);
      $table->json('character_skill_stats')->nullable();
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
    Schema::dropIfExists('character_skill');
  }
}
