<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Category::factory(10)->create();
        \App\Models\Comment::factory(2500)->create();
        \App\Models\Image::factory(2500)->create();
        \App\Models\Tag::factory(50)->create();
        \App\Models\Post::factory(1500)->create();

        // post_tag table has no Model so to seed it we need our own logic
        for ($i = 0; $i < 1500; $i++) {
            DB::table('post_tag')->insertOrIgnore([
                'post_id' => mt_rand(1, 1500),
                'tag_id' => mt_rand(1, 50),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::table('countries')->insert(array(
            array('name' => 'India', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Australia', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Canada', 'created_at' => now(), 'updated_at' => now()),
        ));

        DB::table('states')->insert(array(
            array('country_id' => '1', 'name' => 'Gujarat', 'created_at' => now(), 'updated_at' => now()),
            array('country_id' => '1', 'name' => 'Rajasthan', 'created_at' => now(), 'updated_at' => now()),
            array('country_id' => '2', 'name' => 'Sydney', 'created_at' => now(), 'updated_at' => now()),
        ));

        DB::table('cities')->insert(array(
            array('state_id' => '1', 'name' => 'Surat', 'created_at' => now(), 'updated_at' => now()),
            array('state_id' => '1', 'name' => 'Baroda', 'created_at' => now(), 'updated_at' => now()),
            array('state_id' => '2', 'name' => 'Jaipur', 'created_at' => now(), 'updated_at' => now()),
        ));

        DB::table('hobbies')->insert(array(
            array('name' => 'Sports', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Travelling', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Music', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Reading', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Social Activities', 'created_at' => now(), 'updated_at' => now()),
        ));
    }
}
