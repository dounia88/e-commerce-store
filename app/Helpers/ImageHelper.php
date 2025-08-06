<?php

namespace App\Helpers;

class ImageHelper
{
    /**
     * Génère une image SVG placeholder pour un produit
     */
    public static function generateProductPlaceholder($productName, $width = 400, $height = 300, $backgroundColor = '#6366f1')
    {
        // Nettoyer le nom du produit pour l'affichage
        $displayName = self::cleanProductName($productName);
        
        // Générer une couleur basée sur le nom du produit
        $color = self::generateColorFromName($productName);
        
        // Créer le SVG
        $svg = '<?xml version="1.0" encoding="UTF-8"?>
<svg width="' . $width . '" height="' . $height . '" viewBox="0 0 ' . $width . ' ' . $height . '" xmlns="http://www.w3.org/2000/svg">
    <defs>
        <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" style="stop-color:' . $color['primary'] . ';stop-opacity:1" />
            <stop offset="100%" style="stop-color:' . $color['secondary'] . ';stop-opacity:1" />
        </linearGradient>
    </defs>
    
    <!-- Fond avec dégradé -->
    <rect width="100%" height="100%" fill="url(#grad1)"/>
    
    <!-- Icône produit -->
    <g transform="translate(' . ($width/2 - 30) . ',' . ($height/2 - 50) . ')">
        <rect x="10" y="10" width="40" height="30" rx="5" fill="white" opacity="0.3"/>
        <rect x="15" y="15" width="30" height="20" rx="3" fill="white" opacity="0.5"/>
        <circle cx="30" cy="25" r="8" fill="white" opacity="0.7"/>
        <circle cx="30" cy="25" r="4" fill="white"/>
    </g>
    
    <!-- Nom du produit -->
    <text x="50%" y="' . ($height - 40) . '" text-anchor="middle" fill="white" font-family="Arial, sans-serif" font-size="16" font-weight="bold" opacity="0.9">
        ' . htmlspecialchars($displayName) . '
    </text>
    
    <!-- Logo Luxylia -->
    <text x="50%" y="' . ($height - 20) . '" text-anchor="middle" fill="white" font-family="Arial, sans-serif" font-size="12" opacity="0.6">
        Luxylia
    </text>
</svg>';

        return $svg;
    }

    /**
     * Nettoie le nom du produit pour l'affichage
     */
    private static function cleanProductName($name)
    {
        // Limiter à 20 caractères et ajouter ... si nécessaire
        return strlen($name) > 20 ? substr($name, 0, 17) . '...' : $name;
    }

    /**
     * Génère une couleur basée sur le nom du produit
     */
    private static function generateColorFromName($name)
    {
        $colors = [
            ['primary' => '#6366f1', 'secondary' => '#8b5cf6'], // Indigo vers Violet
            ['primary' => '#ec4899', 'secondary' => '#f97316'], // Rose vers Orange
            ['primary' => '#10b981', 'secondary' => '#06b6d4'], // Vert vers Cyan
            ['primary' => '#f59e0b', 'secondary' => '#ef4444'], // Jaune vers Rouge
            ['primary' => '#8b5cf6', 'secondary' => '#6366f1'], // Violet vers Indigo
            ['primary' => '#06b6d4', 'secondary' => '#10b981'], // Cyan vers Vert
            ['primary' => '#ef4444', 'secondary' => '#f59e0b'], // Rouge vers Jaune
            ['primary' => '#f97316', 'secondary' => '#ec4899'], // Orange vers Rose
        ];

        // Utiliser le hash du nom pour sélectionner une couleur
        $hash = crc32($name);
        $index = abs($hash) % count($colors);

        return $colors[$index];
    }

    /**
     * Sauvegarde une image SVG dans le dossier public
     */
    public static function savePlaceholderImage($productName, $filename = null)
    {
        if (!$filename) {
            $filename = \Illuminate\Support\Str::slug($productName) . '.svg';
        }

        $svg = self::generateProductPlaceholder($productName);
        $path = public_path('images/products/' . $filename);

        // Créer le dossier s'il n'existe pas
        $directory = dirname($path);
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        file_put_contents($path, $svg);

        return 'images/products/' . $filename;
    }

    /**
     * Génère des images pour tous les produits existants
     */
    public static function generateAllProductImages()
    {
        $products = \App\Models\Product::all();
        $generated = [];

        foreach ($products as $product) {
            $filename = \Illuminate\Support\Str::slug($product->name) . '.svg';
            $path = self::savePlaceholderImage($product->name, $filename);
            
            // Mettre à jour le produit avec l'image
            $product->update([
                'images' => [$path]
            ]);

            $generated[] = [
                'product' => $product->name,
                'image' => $path
            ];
        }

        return $generated;
    }
}
