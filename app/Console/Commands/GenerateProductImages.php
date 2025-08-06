<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\ImageHelper;
use App\Models\Product;

class GenerateProductImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:generate-images {--force : Force regeneration of existing images}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate placeholder images for products based on their names';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🎨 Génération des images de produits...');

        $products = Product::all();

        if ($products->isEmpty()) {
            $this->warn('Aucun produit trouvé dans la base de données.');
            return;
        }

        $this->info("Trouvé {$products->count()} produit(s) à traiter.");

        $bar = $this->output->createProgressBar($products->count());
        $bar->start();

        $generated = 0;
        $skipped = 0;

        foreach ($products as $product) {
            $filename = \Illuminate\Support\Str::slug($product->name) . '.svg';
            $path = public_path('images/products/' . $filename);

            // Vérifier si l'image existe déjà
            if (file_exists($path) && !$this->option('force')) {
                $skipped++;
            } else {
                // Générer l'image
                $imagePath = ImageHelper::savePlaceholderImage($product->name, $filename);

                // Mettre à jour le produit avec l'image
                $product->update([
                    'images' => [$imagePath]
                ]);

                $generated++;
            }

            $bar->advance();
        }

        $bar->finish();

        $this->newLine(2);
        $this->info("✅ Génération terminée !");
        $this->info("📸 Images générées : {$generated}");

        if ($skipped > 0) {
            $this->info("⏭️  Images ignorées (déjà existantes) : {$skipped}");
            $this->info("💡 Utilisez --force pour régénérer toutes les images");
        }

        $this->newLine();
        $this->info("🌟 Les images sont disponibles dans public/images/products/");
    }
}
