<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\category;

class CreateCategorySeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            [
               'category_name'=>'Aptitude',
            ],
            [
               'category_name'=>'Technical',
            ],
            [
                'category_name'=>'Psychometric',
            ],
        ];

        foreach ($category as $key => $value) {
            category::create($value);
        }
    }
}
