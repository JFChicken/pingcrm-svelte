<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\Character;
use App\Models\Skills;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CharacterTest extends TestCase
{
  use RefreshDatabase;

  public array $stats = [];

  protected function setUp(): void
  {
    parent::setUp();
    Skills::factory(50)->create();
    $this->user = User::factory()->create([
      'account_id' => Account::create(['name' => 'Acme Corporation'])->id,
      'first_name' => 'j',
      'last_name' => 'c',
      'email' => 'jc@example.com',
      'owner' => true,
    ]);
    $stats = [];
    for ($x = 0; $x <= 7; $x++) {
      $stats['stat' . $x] = rand(rand(1, 10), rand(10, 20));
    }
    $this->stats = $stats;
  }
  public function test_can_view_skills()
  {

    $skills = Skills::all();
    $this->assertEquals(50,$skills->count());

  }


  public function test_can_view_characters()
  {
    $character = Character::create([
      'name' => 'foo',
      'stats' => $this->stats,
    ]);

    $this->assertSame('foo', $character->name);

//       $this->assertDatabaseHas('characters',$character->toArray());

  }

  public function test_can_search_for_characters()
  {
    $character = Character::create([
      'name' => 'foo',
      'stats' => $this->stats,
    ]);

    $this->assertEquals(8, count($character->stats));
//      $this->assertDatabaseHas('characters',$character->toArray());
  }

  public function test_can_characters_has_skills()
  {
    $character = Character::create([
      'name' => 'foo',
      'stats' => $this->stats,
    ]);
    $user = Character::find(1);
    $skill = Skills::find(1);


//var_dump($user);
var_dump($user->skills);
//var_dump($skill);
//      $this->assertDatabaseHas('characters',$character->toArray());
  }



}
