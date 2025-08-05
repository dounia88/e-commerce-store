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
                'name' => 'Électronique',
                'description' => 'Tous les produits électroniques et technologiques',
                'slug' => 'electronique',
            ],
            [
                'name' => 'Mode & Accessoires',
                'description' => 'Vêtements, chaussures et accessoires de mode',
                'slug' => 'mode-accessoires',
            ],
            [
                'name' => 'Maison & Jardin',
                'description' => 'Décoration, mobilier et articles pour la maison',
                'slug' => 'maison-jardin',
            ],
            [
                'name' => 'Sport & Loisirs',
                'description' => 'Équipements sportifs et articles de loisirs',
                'slug' => 'sport-loisirs',
            ],
            [
                'name' => 'Livres & Médias',
                'description' => 'Livres, films, musique et jeux vidéo',
                'slug' => 'livres-medias',
            ],
            [
                'name' => 'Beauté & Santé',
                'description' => 'Cosmétiques, parfums et produits de santé',
                'slug' => 'beaute-sante',
            ],
            [
                'name' => 'Automobile',
                'description' => 'Pièces auto, accessoires et équipements',
                'slug' => 'automobile',
            ],
            [
                'name' => 'Bébé & Enfant',
                'description' => 'Articles pour bébés et enfants',
                'slug' => 'bebe-enfant',
            ],
            [
                'name' => 'Alimentation',
                'description' => 'Produits alimentaires et boissons',
                'slug' => 'alimentation',
            ],
            [
                'name' => 'Bricolage & Outils',
                'description' => 'Outils, matériaux et équipements de bricolage',
                'slug' => 'bricolage-outils',
            ],
            [
                'name' => 'Informatique',
                'description' => 'Ordinateurs, composants et accessoires informatiques',
                'slug' => 'informatique',
            ],
            [
                'name' => 'Téléphonie',
                'description' => 'Smartphones, tablettes et accessoires',
                'slug' => 'telephonie',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
