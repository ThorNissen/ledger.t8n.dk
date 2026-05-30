<?php

namespace App\Support;

class DescriptionNormalizer
{
    public static function normalize(string $description): string
    {
        // Lowercase, remove special chars like *, collapse spaces
        $normalized = mb_strtolower($description);
        $normalized = preg_replace('/\*/', ' ', $normalized);
        $normalized = preg_replace('/\s+/', ' ', $normalized);

        return trim($normalized);
    }
}
