<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\User;
use App\Category;
use Faker\Generator as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 100; $i++) {
            $title = $faker->words(rand(2, 6), true);
            Post::create([
                'user_id'   => User::inRandomOrder()->first()->id,
                'category_id' => Category::inRandomOrder()->first()->id,
                'title'     => $title,
                'image'     => 'https://picsum.photos/id/'.rand(1, 1000).'/250/350',
                'content'   => $faker->text(rand(100, 500)),
                'slug'      => Post::generateSlug($title)
            ]);
        }
    }
}
