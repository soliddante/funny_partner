<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
            for ($i=1; $i <= 101 ; $i++) { 
                \App\Models\Land::factory()->create([
                    'partner_id' => 1,
                    'flag' => "x1id$i",
                    'status' => 1,
                  ]);
            }
            for ($i=43; $i <= 89 ; $i++) { 
                \App\Models\Land::factory()->create([
                    'partner_id' => 1,
                    'flag' => "x2id$i",
                    'status' => 1,
                  ]);
            }
    }
}
