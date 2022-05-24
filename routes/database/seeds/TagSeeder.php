<?php

use Illuminate\Database\Seeder;
use App\Tag;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'Cani',
            'Gatti',
            'Roma',
            'Elon Mask',
            'BitCoin',
            'Sport',
            'php',
            'Laravel',
            'Vue',
            'Javascript',
            'Italia',
            'Cinema',
            'Cucina',
            'Casa',
            'Mondo',
            'Guerra',
            'Ucraina',
        ];

        foreach ($tags as $tag) {
            Tag::create([
                'name' => $tag,
                'slug' => Str::slug($tag)
            ]);
        }
    }
}
