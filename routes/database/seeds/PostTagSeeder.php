<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Post;
use App\User;
use App\Tag;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $posts = Post::all();

        foreach ($posts as $post) {
            $postTags = Tag::inRandomOrder()->limit(rand(0, 5))->get();

            $post->tags()->attach($postTags->pluck('id')->all());
        }
    }
}
