<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ArticleService
{
    public function __construct()
    {
    }

    public function processBase64Image(string $imageData): string
    {
        $base64Data = explode(',', $imageData)[1];

        // Décoder les données de l'image en binaire
        $imageBinary = base64_decode($base64Data);

        // Récupérer l'extension de l'image
        $imageMimeType = explode(';base64,', $imageData)[0];
        $imageExtension = explode('/', $imageMimeType)[1];

        // Générer un nom de fichier unique pour l'image
        $fileName = uniqid() . '.' . $imageExtension;
        $image_path = "images/" . $fileName;

        // Enregistrer l'image sur le disque local
        Storage::disk('public')->put($image_path, $imageBinary);
        return $fileName;

    }

    public function delete(string $path): bool
    {
        return Storage::disk('public')->delete('images/'.$path);
    }

}
