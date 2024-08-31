<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $brands = [
        ['name' => 'hp', 'device_type' => 'computer'],
        ['name' => 'dell', 'device_type' => 'computer'],
        ['name' => 'lenovo', 'device_type' => 'computer'],
        ['name' => 'apple', 'device_type' => 'computer'],
        ['name' => 'acer', 'device_type' => 'computer'],
        ['name' => 'others', 'device_type' => 'computer'],
        ['name' => 'samsung', 'device_type' => 'phone'],
        ['name' => 'apple', 'device_type' => 'phone'],
        ['name' => 'xiaomi', 'device_type' => 'phone'],
        ['name' => 'tecno', 'device_type' => 'phone'],
        ['name' => 'infinix', 'device_type' => 'phone'],
        ['name' => 'others', 'device_type' => 'phone'],
        ['name' => 'samsung', 'device_type' => 'accessory'],
        ['name' => 'apple', 'device_type' => 'accessory'],
        ['name' => 'xiaomi', 'device_type' => 'accessory'],
        ['name' => 'oraimo', 'device_type' => 'accessory'],
        ['name' => 'anker', 'device_type' => 'accessory'],
        ['name' => 'others', 'device_type' => 'accessory'],
    ];
    public function run()
    {
        foreach ($this->brands as $brand) {
            Brand::create([
                'name' => $brand['name'],
                'device_type' => $brand['device_type']
            ]);
        }
    }
}
