@props(['class' => 'h-10 w-auto'])

<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 120 40" fill="none" xmlns="http://www.w3.org/2000/svg">
    <!-- Icône stylisée "L" avec des éléments de luxe -->
    <g>
        <!-- Forme principale du L -->
        <path d="M8 6 L8 28 L20 28 L20 24 L12 24 L12 6 Z" fill="currentColor"/>
        
        <!-- Élément décoratif - diamant -->
        <path d="M24 12 L28 8 L32 12 L28 16 Z" fill="currentColor" opacity="0.8"/>
        
        <!-- Texte "uxylia" stylisé -->
        <g fill="currentColor">
            <!-- u -->
            <path d="M36 12 L36 20 C36 22 37 23 39 23 C41 23 42 22 42 20 L42 12 L44 12 L44 20 C44 23.5 42 25 39 25 C36 25 34 23.5 34 20 L34 12 Z"/>
            
            <!-- x -->
            <path d="M48 12 L52 18 L48 24 L50 24 L52.5 20 L55 24 L57 24 L53 18 L57 12 L55 12 L52.5 16 L50 12 Z"/>
            
            <!-- y -->
            <path d="M60 12 L62 12 L62 18 L66 12 L68 12 L64 19 L64 24 L62 24 L62 19 L58 12 Z"/>
            
            <!-- l -->
            <path d="M70 8 L72 8 L72 24 L70 24 Z"/>
            
            <!-- i -->
            <path d="M76 10 C76.5 10 77 10.5 77 11 C77 11.5 76.5 12 76 12 C75.5 12 75 11.5 75 11 C75 10.5 75.5 10 76 10 Z M75 14 L77 14 L77 24 L75 24 Z"/>
            
            <!-- a -->
            <path d="M81 18 C81 16 82 14 84 14 C86 14 87 16 87 18 L87 24 L85 24 L85 22.5 C84.5 23.5 83.5 24 82.5 24 C81 24 80 23 80 21.5 C80 20 81 19 82.5 19 L85 19 L85 18 C85 17 84.5 16 84 16 C83.5 16 83 17 83 18 Z M85 20.5 L82.5 20.5 C82 20.5 82 21 82 21.5 C82 22 82 22.5 82.5 22.5 C84 22.5 85 21.5 85 20.5 Z"/>
        </g>
        
        <!-- Éléments décoratifs supplémentaires -->
        <circle cx="92" cy="18" r="1.5" fill="currentColor" opacity="0.6"/>
        <circle cx="96" cy="15" r="1" fill="currentColor" opacity="0.4"/>
        <circle cx="100" cy="21" r="1" fill="currentColor" opacity="0.4"/>
    </g>
</svg>
