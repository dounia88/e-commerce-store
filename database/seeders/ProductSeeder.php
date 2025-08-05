<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Hyper',
                'description' => 'Lunettes de soleil sportives avec un design moderne et des verres polarisés pour une protection optimale.',
                'price' => 99.00,
                'original_price' => null,
                'category_id' => 1, // Sport
                'sku' => 'HY001',
                'stock' => 50,
                'is_featured' => true,
                'specifications' => [
                    'Height' => '4 cm',
                    'Width' => '15 cm',
                    'Material' => 'Polycarbonate',
                    'Lens Type' => 'Polarized'
                ]
            ],
            [
                'name' => 'Frame v1',
                'description' => 'Lunettes de soleil classiques avec un design ovale élégant et des verres colorés.',
                'price' => 82.00,
                'original_price' => 99.50,
                'category_id' => 2, // Classic
                'sku' => 'FR001',
                'stock' => 30,
                'is_featured' => false,
                'specifications' => [
                    'Height' => '4.5 cm',
                    'Width' => '14 cm',
                    'Material' => 'Acetate',
                    'Lens Type' => 'Tinted'
                ]
            ],
            [
                'name' => 'Eclipse',
                'description' => 'Lunettes de soleil angulaires avec un design moderne et des verres miroir.',
                'price' => 70.00,
                'original_price' => 86.00,
                'category_id' => 3, // Fashion
                'sku' => 'EC001',
                'stock' => 25,
                'is_featured' => true,
                'specifications' => [
                    'Height' => '4 cm',
                    'Width' => '15 cm',
                    'Material' => 'Metal',
                    'Lens Type' => 'Mirror'
                ]
            ],
            [
                'name' => 'Spectra',
                'description' => 'Lunettes de soleil larges avec des verres miroir or rose pour un look tendance.',
                'price' => 54.50,
                'original_price' => null,
                'category_id' => 3, // Fashion
                'sku' => 'SP001',
                'stock' => 40,
                'is_featured' => false,
                'specifications' => [
                    'Height' => '5 cm',
                    'Width' => '16 cm',
                    'Material' => 'Plastic',
                    'Lens Type' => 'Mirror'
                ]
            ],
            [
                'name' => 'Eclipse V2',
                'description' => 'Version améliorée des lunettes Eclipse avec un design plus courbé et sportif.',
                'price' => 165.00,
                'original_price' => 200.00,
                'category_id' => 4, // Premium
                'sku' => 'EC002',
                'stock' => 15,
                'is_featured' => true,
                'specifications' => [
                    'Height' => '4 cm',
                    'Width' => '15 cm',
                    'Material' => 'Glass',
                    'Lens Type' => 'Premium Polarized'
                ]
            ],
            [
                'name' => 'Luxora Classic',
                'description' => 'Lunettes de soleil classiques avec un design intemporel et des verres de qualité.',
                'price' => 120.00,
                'original_price' => null,
                'category_id' => 2, // Classic
                'sku' => 'LX001',
                'stock' => 35,
                'is_featured' => false,
                'specifications' => [
                    'Height' => '4.2 cm',
                    'Width' => '14.5 cm',
                    'Material' => 'Acetate',
                    'Lens Type' => 'Classic Tinted'
                ]
            ],
            [
                'name' => 'Sport Pro',
                'description' => 'Lunettes de soleil professionnelles pour les sports extrêmes avec une protection maximale.',
                'price' => 145.00,
                'original_price' => 180.00,
                'category_id' => 1, // Sport
                'sku' => 'SP002',
                'stock' => 20,
                'is_featured' => true,
                'specifications' => [
                    'Height' => '4.8 cm',
                    'Width' => '16 cm',
                    'Material' => 'Polycarbonate',
                    'Lens Type' => 'UV400 Protection'
                ]
            ],
            [
                'name' => 'Fashion Nova',
                'description' => 'Lunettes de soleil tendance avec un design unique et des verres colorés.',
                'price' => 95.00,
                'original_price' => null,
                'category_id' => 3, // Fashion
                'sku' => 'FN001',
                'stock' => 45,
                'is_featured' => false,
                'specifications' => [
                    'Height' => '4.3 cm',
                    'Width' => '15.2 cm',
                    'Material' => 'Mixed',
                    'Lens Type' => 'Gradient'
                ]
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
