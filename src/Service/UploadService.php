<?php

    namespace App\Service;

    class UploadService
    {
        public function upload($extensions){
            $nomFichier = $_FILES['upload_form']['name']['file'];
            $pointPosition = strpos($nomFichier,'.');
            $extension = substr($nomFichier, $pointPosition+1);
            $extension = strtolower($extension);
            $nouveauFichier = 'images/'.uniqid().'.'.$extension;
            if(in_array($extension,$extensions)){
                move_uploaded_file($_FILES['upload_form']['tmp_name']['file'],$nouveauFichier);
            }
        }
    }