<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Form\AdresseType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdresseController extends AbstractController{
    #[Route('/new/Adresse', name:'app_new_adresse')]
    public function newAdresse(Request $request){
        if($request->request->count()>0){
            dd($request);
        }
    }
}

