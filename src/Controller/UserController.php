<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Manager\UserManager;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{

    #[Route('/new', name: 'app_new')]
    public function new(Request $request, UserManager $userManager)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userManager->save($user, true);
            
            $this->addFlash('success',"Utilisateur enregistrer");
            return $this->redirectToRoute('app_list');
        }

        return $this->render('/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/list', name: 'app_list')]
    public function list(UserRepository $userRepository)
    {
        $users = $userRepository->findAll();

        return $this->render('/list.html.twig', ['users' => $users]);
    }

    #[Route('/edit/{id}', name: 'app_edit')]
    public function edit($id, UserManager $userManager, Request $request, UserRepository $userRepository)
    {
        $user = $userRepository->find($id);
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userManager->save($user, true);
            
            
            $this->addFlash('success','Edit success');
            return $this->redirectToRoute('app_list');
        }

        return $this->render('/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
