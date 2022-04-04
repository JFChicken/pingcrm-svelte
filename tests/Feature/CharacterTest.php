<?php

namespace Tests\Feature;

use App\Models\Account;
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

        $organization = $this->user->account->organizations()->create(['name' => 'Example Organization Inc.']);

        $this->user->account->character()->createMany([
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
                'postal_code' => '57851',
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
                'postal_code' => '11623',
            ],
        ]);
    }

    public function test_can_view_characters()
    {
        $this->actingAs($this->user)
            ->get('/characters')
            ->assertInertia(fn ($assert) => $assert
                ->component('characters/Index')
                ->has('characters.data', 2)
                ->has('characters.data.0', fn ($assert) => $assert
                    ->where('id', 1)
                    ->where('name', 'Martin Abbott')
                    ->where('phone', '555-111-2222')
                    ->where('city', 'Murphyland')
                    ->where('deleted_at', null)
                    ->has('organization', fn ($assert) => $assert
                        ->where('name', 'Example Organization Inc.')
                    )
                )
                ->has('characters.data.1', fn ($assert) => $assert
                    ->where('id', 2)
                    ->where('name', 'Lynn Kub')
                    ->where('phone', '555-333-4444')
                    ->where('city', 'Woodstock')
                    ->where('deleted_at', null)
                    ->has('organization', fn ($assert) => $assert
                        ->where('name', 'Example Organization Inc.')
                    )
                )
            );
    }

    public function test_can_search_for_characters()
    {
        $this->actingAs($this->user)
            ->get('/characters?search=Martin')
            ->assertInertia(fn ($assert) => $assert
                ->component('characters/Index')
                ->where('filters.search', 'Martin')
                ->has('characters.data', 1)
                ->has('characters.data.0', fn ($assert) => $assert
                    ->where('id', 1)
                    ->where('name', 'Martin Abbott')
                    ->where('phone', '555-111-2222')
                    ->where('city', 'Murphyland')
                    ->where('deleted_at', null)
                    ->has('organization', fn ($assert) => $assert
                        ->where('name', 'Example Organization Inc.')
                    )
                )
            );
    }

    public function test_cannot_view_deleted_characters()
    {
        $this->user->account->characters()->firstWhere('first_name', 'Martin')->delete();

        $this->actingAs($this->user)
            ->get('/characters')
            ->assertInertia(fn ($assert) => $assert
                ->component('characters/Index')
                ->has('characters.data', 1)
                ->where('characters.data.0.name', 'Lynn Kub')
            );
    }

    public function test_can_filter_to_view_deleted_characters()
    {
        $this->user->account->characters()->firstWhere('first_name', 'Martin')->delete();

        $this->actingAs($this->user)
            ->get('/characters?trashed=with')
            ->assertInertia(fn ($assert) => $assert
                ->component('characters/Index')
                ->has('characters.data', 2)
                ->where('characters.data.0.name', 'Martin Abbott')
                ->where('characters.data.1.name', 'Lynn Kub')
            );
    }
}
