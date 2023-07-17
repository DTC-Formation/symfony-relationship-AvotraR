<?php

namespace App\Controller;

use App\Form\UploadFormType;
use App\Service\UploadService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UploadController extends AbstractController
{
    #[Route('/', name: "app_upload_index")]
    public function index()
    {
       

        return $this->render('/index.html.twig');
    }

    #[Route('/video', name: "app_upload_video")]
    public function video(Request $request,UploadService $uploadService)
    {
        $extensions = ['mp4','avi'];
        if(!is_dir('videos')){
            mkdir('videos');
        }
        $form = $this->createForm(UploadFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           $uploadService->upload($extensions);
        }  
        return $this->render('/video.html.twig',['form'=>$form->createView()]);
    }

    #[Route('/image', name: "app_upload_image")]
    public function image(Request $request,UploadService $uploadService)
    {
        $extensions = ['png','img'];
        if(!is_dir('images')){
            mkdir('images');
        }
        $form = $this->createForm(UploadFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadService->upload($extensions);
        }  
        return $this->render('/image.html.twig',['form'=>$form->createView()]);
    }
    #[Route('/image/new', name: "app_new_image")]
    public function imageNew()
    {
        
    }

    #[Route('/document', name: "app_upload_doc")]
    public function document()
    {
        return $this->render('/document.html.twig');
    }
}
