<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $categories = [
        ['name' => 'technology', 'section' => 'posts'],
        ['name' => 'power', 'section' => 'posts'],
        ['name' => 'general', 'section' => 'posts'],
        ['name' => 'power', 'section' => 'projects'],
        ['name' => 'networking', 'section' => 'projects'],
        ['name' => 'surveillance', 'section' => 'projects'],
        ['name' => 'general', 'section' => 'projects'],
        ['name' => 'phone', 'section' => 'products'],
        ['name' => 'computer', 'section' => 'products'],
        ['name' => 'accessory', 'section' => 'products'],
        ['name' => 'others', 'section' => 'products'],
       
    ];
    public function run()
    {
        foreach ($this->categories as $category) {
            Category::create([
                'name' => $category['name'],
                'section' => $category['section']
            ]);
        }
    }
}
