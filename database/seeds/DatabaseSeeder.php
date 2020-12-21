<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'firstName' => 'Marko',
            'lastName' => 'Dumnic',
            'userName' => 'dumaaas',
            'phoneNumber' => '068/836-393',
            'role' => 'admin',
            'country' => 'Montenegro',
            'city' => 'Niksic',
            'privacy' => 'public',
            'avatar' => 'default.jpg',
            'email' => 'markodumnic8@gmail.com',
            'description' => 'Cao, ja sam Marko.',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'created_at' => now()
        ]);
//
//        User::factory(40)->create();
        \App\Movie::factory()->count(40)->create();
//        \App\Cast::factory()->count(40)->create();
//        \App\Comment::factory()->count(15000)->create();
//        \App\Chat::factory()->count(15000)->create();
//        \App\Likeable::factory(50)->create();

//        \App\MovieList::factory()->count(15000)->create();
//        \App\Rating::factory()->count(15000)->create();
//        \App\Reminder::factory()->count(15000)->create();
//        \App\Acting::factory()->count(2000)->create();
//        \App\Follow::factory()->count(1000)->create();
    }
}
