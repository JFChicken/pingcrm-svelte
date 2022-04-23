<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReportsTest extends TestCase
{
  use RefreshDatabase, WithFaker;

  protected function setUp(): void
  {
    parent::setUp();

    $this->user = User::factory()->create([
      'account_id' => Account::create(['name' => 'Acme Corporation'])->id,
      'first_name' => 'JC',
      'last_name' => 'Doe',
      'email' => 'jcdoe@example.com',
      'owner' => true,
    ]);

    $organization = $this->user->account->organizations()->create(['name' => 'Acme Corporation']);

    $this->user->account->contacts()->createMany([
      [
        'organization_id' => $organization->id,
        'first_name' => 'Martin',
        'last_name' => 'Abbott',
        'email' => 'martin.abbott@example.com',
        'phone' => '555-111-2222',
        'address' => '330 Glenda Shore',
        'city' => 'Murphyland',
        'region' => 'Tennessee',
        'country' => 'US',
        'postal_code' => $this->faker->postcode,
      ], [
        'organization_id' => $organization->id,
        'first_name' => 'Lynn',
        'last_name' => 'Kub',
        'email' => 'lynn.kub@example.com',
        'phone' => '555-333-4444',
        'address' => '199 Connelly Turnpike',
        'city' => 'Woodstock',
        'region' => 'Colorado',
        'country' => 'US',
        'postal_code' => $this->faker->postcode,
      ],
    ]);
  }
  public function test_can_view_auth_all()
  {
    $this->actingAs($this->user)
      ->get('/reports')
      ->assertInertia(fn ($assert) => $assert
        ->component('Reports/Index')
        ->has('auth', 1)
        ->has('auth.user', fn ($assert) => $assert
          ->where('id', 1)
          ->where('first_name', $this->user['first_name'])
          ->etc()
        )
      );

  }


  public function test_can_view_reports()
  {
    $this->actingAs($this->user)
      ->get('/reports')
      ->assertInertia(fn ($assert) => $assert
        ->component('Reports/Index')
        ->has('auth', 1)
        ->has('data',1)
      );
  }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');
//      $response->assertInertiaHas('message.comments.0.files.0.name', 'example-attachment.pdf');
        //this is a redirect status since in Inertia we do that to redirect info or new page refreshes
        $response->assertStatus(302);
    }
}
