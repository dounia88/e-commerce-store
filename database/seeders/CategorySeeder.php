<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Sport',
                'description' => 'Lunettes de soleil sportives pour les activités en plein air'
            ],
            [
                'name' => 'Classic',
                'description' => 'Lunettes de soleil classiques et élégantes'
            ],
            [
                'name' => 'Fashion',
                'description' => 'Lunettes de soleil tendance et modernes'
            ],
            [
                'name' => 'Premium',
                'description' => 'Lunettes de soleil haut de gamme et luxueuses'
            ],
            [
                'name' => 'New Arrivals',
                'description' => 'Nouvelles arrivées et dernières tendances'
            ]
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description']
            ]);
        }
    }
}
