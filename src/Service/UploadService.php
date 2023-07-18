<?php

namespace App\Service;

class UploadService
{

    public function upload($extensions)
    {
        $nomFichier = $_FILES['upload_form']['name']['file'];
        $pointPosition = strpos($nomFichier, '.');
        $extension = substr($nomFichier, $pointPosition + 1);
        $extension = strtolower($extension);
        $cle = uniqid();
        if (in_array($extension, $extensions)) {
            move_uploaded_file($_FILES['upload_form']['tmp_name']['file'], 'images/' . $cle . '.' . $extension);
        }
    }
    public function getAll($chemin)
    {
        if (is_dir($chemin)) {
            $fichiers = scandir($chemin);
            $fichiers = array_filter($fichiers, function ($fichier) {
                return !in_array($fichier, ['.', '..']);
            });
        }
        return $fichiers;
    }
}
