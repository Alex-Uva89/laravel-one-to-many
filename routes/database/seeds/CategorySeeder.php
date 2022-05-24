<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Arte',
            ],
            [
                'name' => 'Cinema',
            ],
            [
                'name' => 'Viaggi',
            ],
            [
                'name' => 'Intrattenimento',
            ],
            [
                'name' => 'Tecnologia',
            ],
            [
                'name' => 'Sport',
            ],
            [
                'name' => 'Cultura',
            ],
            [
                'name' => 'Casa',
            ],
            [
                'name' => 'Cucina',
            ],
            [
                'name' => 'Altro',
            ],

        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
