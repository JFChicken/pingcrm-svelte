<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\Character;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CharacterTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'account_id' => Account::create(['name' => 'Acme Corporation'])->id,
            'first_name' => 'j',
            'last_name' => 'c',
            'email' => 'jc@example.com',
            'owner' => true,
        ]);
    }

    public function test_can_view_characters()
    {
       $character = Character::create([
         'name'=> 'foo'
       ]);

       $this->assertSame('foo',$character->name);

//       $this->assertDatabaseHas('characters',$character->toArray());

    }

    public function test_can_search_for_characters()
    {
      $character = Character::create();

      var_dump($character);

      $this->assertJson($character->status);

    }

    public function test_cannot_view_deleted_characters()
    {

    }

    public function test_can_filter_to_view_deleted_characters()
    {

    }
}
