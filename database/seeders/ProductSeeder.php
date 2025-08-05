<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer les catégories et utilisateurs
        $categories = Category::all();
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->error('Aucun utilisateur trouvé. Veuillez d\'abord exécuter UserSeeder.');
            return;
        }

        $products = [
            // Électronique
            [
                'name' => 'iPhone 15 Pro',
                'description' => 'Le dernier iPhone avec des fonctionnalités avancées et un design premium.',
                'price' => 1199.99,
                'compare_price' => 1299.99,
                'stock' => 50,
                'sku' => 'IPHONE15PRO',
                'brand' => 'Apple',
                'model' => 'iPhone 15 Pro',
                'category_id' => $categories->where('slug', 'telephonie')->first()->id,
                'is_featured' => true,
            ],
            [
                'name' => 'MacBook Air M2',
                'description' => 'Ordinateur portable ultra-léger avec puce M2 pour des performances exceptionnelles.',
                'price' => 1299.99,
                'compare_price' => 1499.99,
                'stock' => 25,
                'sku' => 'MACBOOKAIRM2',
                'brand' => 'Apple',
                'model' => 'MacBook Air M2',
                'category_id' => $categories->where('slug', 'informatique')->first()->id,
                'is_featured' => true,
            ],
            [
                'name' => 'Samsung Galaxy S24',
                'description' => 'Smartphone Android haut de gamme avec IA intégrée.',
                'price' => 899.99,
                'compare_price' => 999.99,
                'stock' => 75,
                'sku' => 'GALAXYS24',
                'brand' => 'Samsung',
                'model' => 'Galaxy S24',
                'category_id' => $categories->where('slug', 'telephonie')->first()->id,
            ],
            [
                'name' => 'PlayStation 5',
                'description' => 'Console de jeux nouvelle génération avec graphismes 4K.',
                'price' => 499.99,
                'compare_price' => 549.99,
                'stock' => 30,
                'sku' => 'PS5',
                'brand' => 'Sony',
                'model' => 'PlayStation 5',
                'category_id' => $categories->where('slug', 'livres-medias')->first()->id,
                'is_featured' => true,
            ],
            [
                'name' => 'Nike Air Max 270',
                'description' => 'Chaussures de sport confortables avec amorti Air Max.',
                'price' => 129.99,
                'compare_price' => 159.99,
                'stock' => 100,
                'sku' => 'NIKEAIRMAX270',
                'brand' => 'Nike',
                'model' => 'Air Max 270',
                'category_id' => $categories->where('slug', 'mode-accessoires')->first()->id,
            ],
            [
                'name' => 'Canon EOS R6',
                'description' => 'Appareil photo hybride professionnel avec stabilisation 5 axes.',
                'price' => 2499.99,
                'compare_price' => 2799.99,
                'stock' => 15,
                'sku' => 'CANONEOSR6',
                'brand' => 'Canon',
                'model' => 'EOS R6',
                'category_id' => $categories->where('slug', 'electronique')->first()->id,
            ],
            [
                'name' => 'Dyson V15 Detect',
                'description' => 'Aspirateur sans fil avec détection automatique de la poussière.',
                'price' => 699.99,
                'compare_price' => 799.99,
                'stock' => 40,
                'sku' => 'DYSONV15',
                'brand' => 'Dyson',
                'model' => 'V15 Detect',
                'category_id' => $categories->where('slug', 'maison-jardin')->first()->id,
            ],
            [
                'name' => 'Adidas Ultraboost 22',
                'description' => 'Chaussures de running avec technologie Boost pour un amorti optimal.',
                'price' => 179.99,
                'compare_price' => 199.99,
                'stock' => 80,
                'sku' => 'ADIDASULTRABOOST22',
                'brand' => 'Adidas',
                'model' => 'Ultraboost 22',
                'category_id' => $categories->where('slug', 'sport-loisirs')->first()->id,
            ],
            [
                'name' => 'L\'Oréal Paris Revitalift',
                'description' => 'Crème anti-âge avec acide hyaluronique pour une peau plus ferme.',
                'price' => 24.99,
                'compare_price' => 29.99,
                'stock' => 200,
                'sku' => 'LOREALREVITALIFT',
                'brand' => 'L\'Oréal Paris',
                'model' => 'Revitalift',
                'category_id' => $categories->where('slug', 'beaute-sante')->first()->id,
            ],
            [
                'name' => 'Lego Star Wars Millennium Falcon',
                'description' => 'Set de construction Lego du célèbre vaisseau Star Wars.',
                'price' => 159.99,
                'compare_price' => 179.99,
                'stock' => 60,
                'sku' => 'LEGOSTARWARS',
                'brand' => 'Lego',
                'model' => 'Millennium Falcon',
                'category_id' => $categories->where('slug', 'bebe-enfant')->first()->id,
            ],
        ];

        foreach ($products as $productData) {
            $productData['user_id'] = $users->random()->id;
            $productData['slug'] = Str::slug($productData['name']);
            $productData['images'] = ['products/default-product.jpg'];
            $productData['specifications'] = [
                'Couleur' => 'Noir',
                'Matériau' => 'Premium',
                'Garantie' => '2 ans',
            ];
            
            Product::create($productData);
        }
    }
}
