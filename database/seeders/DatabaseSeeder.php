<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        // Truncating tables is useful only if we want to do it outside of migrate:fresh (which is already dropping the tables)
        // User::truncate();
        // Category::truncate();
        // Post::truncate();
        
        Category::factory(5)->create();
        Post::factory(10)->create();


        // $user = User::factory()->create([
        //     'name' => 'John Doe'
        // ]);

        // Post::factory(10)->create([
        //     // Associate dummy post with already created user
        //     'user_id' => $user->id
        // ]);

        // Code below : Create dummy data without factories

        // $user = User::factory()->create();

        // $personal = Category::create([
        //     'name' => 'Personal',
        //     'slug' => 'personal'
        // ]);

        // $work = Category::create([
        //     'name' => 'Work',
        //     'slug' => 'work'
        // ]);

        // $family = Category::create([
        //     'name' => 'Family',
        //     'slug' => 'family'
        // ]);

        // Post::create([
        //     'user_id' => $user->id,
        //     'category_id' => $family->id,
        //     'title' => 'My family post',
        //     'slug' => 'my-family-post',
        //     'excerpt' => 'Lorem ipsum dolor sit amet.',
        //     'body' => '<p>Do velit exercitation irure est in commodo consequat quis occaecat mollit commodo sit magna velit. Pariatur pariatur consectetur ut cillum. Do consectetur consequat fugiat enim officia.</p>',
        // ]);
        
        // Post::create([
        //     'user_id' => $user->id,
        //     'category_id' => $work->id,
        //     'title' => 'My work post',
        //     'slug' => 'my-work-post',
        //     'excerpt' => 'Lorem ipsum dolor sit amet.',
        //     'body' => '<p>Do velit exercitation irure est in commodo consequat quis occaecat mollit commodo sit magna velit. Pariatur pariatur consectetur ut cillum. Do consectetur consequat fugiat enim officia.</p>',
        // ]);

    }
}
