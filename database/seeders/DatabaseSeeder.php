<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Character;
use App\Models\Contact;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      /*
       * New seeders will follow this style of just being added to by call and seeder and not just added
       * to this ever inflating file
       */
      $this->call([
        SkillsSeeder::class,
      ]);




        $account = Account::create(['name' => 'Acme Corporation']);

        $user = User::factory()->create([
            'account_id' => $account->id,
            'owner' => true,
        ]);
//      This is to log user for use
      User::factory(5)->create(['account_id' => $account->id]);

      $organizations = Organization::factory(5)
            ->create(['account_id' => $account->id]);

      Contact::factory(5)
            ->create(['account_id' => $account->id])
            ->each(function ($contact) use ($organizations) {
                $contact->update(['organization_id' => $organizations->random()->id]);
            });

      Character::factory(5)
          ->create()
          ->each(function ($contact) use ($user) {
          $characterName = $user->first_name.'-'.$contact->name;

          $contact->name = $characterName;
          $contact->save();
        });

    }
}
