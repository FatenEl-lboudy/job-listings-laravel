<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        
        //using seeders to trigger factories
        User::factory()->create([
            'first_name' => 'john',
            'last_name'=> 'doe',
            'email' => 'test@example.com',
        ]);
        $this->call(JobSeeder::class);

        //using the database facade to insert data inside the seeder
        DB::table('users')->insert([
            'first_name' => 'Faten',
            'last_name' => 'Farag',
            'email' => 'faten@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('dump1234'),
            'remember_token' => Str::random(10),
        ]);

        //using the eloquent to insert data directly
        User::create([
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'jane@yahoo.com',
            'email_verified_at' => now(),
            'password' => bcrypt('secret123'),
            'remember_token' => Str::random(10),
        ]);
    }
}
