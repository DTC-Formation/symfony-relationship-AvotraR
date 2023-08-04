<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Manager\UserManager;
use App\Repository\UserRepository;
use App\Helpers\JsonResponseHelper;
use App\Service\TokenService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Uid\Uuid;

#[Route('/api/user')]
Class UserApiController extends AbstractController{
    
    private JsonResponseHelper $jsonResponseHelper;
    private UserRepository $userRepository;
    private UserManager $userManager;

    public function __construct(UserRepository $userRepository, JsonResponseHelper $jsonResponseHelper, UserManager $userManager)
    {
        $this->jsonResponseHelper = $jsonResponseHelper;
        $this->userRepository = $userRepository;
        $this->userManager = $userManager;
    }

    #[Route('/list',name:'api_list',requirements: ['page' => '\d+'])]
    public function listApi(?int $page = 1){

        $users = $this->userRepository->findBy([], [], $page * 10);

        return $this->json(
            [
                'data' => $this->jsonResponseHelper->serializeData($users, ['listing']),
                'code' => Response::HTTP_OK,
                'status' => 'success'
            ]
        );
    }

    #[Route('/create', name:'api_create', methods:['POST'])]
    public function createUser(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->submit(json_decode($request->getContent(), true));
        
        if ($form->isValid()) {
            $this->userManager->save($user,true);

            return $this->json([
                'data' => 'User created successfully!',
                'code' => Response::HTTP_CREATED,
                'status' => 'success'
            ]);
        }

        return $this->json([
            'data' => $form->getErrors(true, false),
            'code' => Response::HTTP_BAD_REQUEST,
            'status' => 'error'
        ]);
    }

    
    #[Route('/detail/{id}', name:'api_show', methods:['GET'])]
    public function detailUser($id)
    {
        $user[] = $this->userRepository->findOneBy(['id'=>Uuid::fromString($id)]);

        return $this->json([
            'data' => $this->jsonResponseHelper->serializeData($user, ['listing']),
            'code' => Response::HTTP_OK,
            'status' => 'success'
        ]);
    }
    
    #[Route('/update/{id}', name:'api_update', methods:['PUT'])]
    public function updateUser($id, Request $request)
    {
        
        $user = $this->userRepository->findOneBy(['id'=>Uuid::fromString($id)]);
        $form = $this->createForm(UserType::class, $user);

        $form->submit(json_decode($request->getContent(), true),false);

        if ($form->isValid()) {
            $this->userManager->save($user,true);

            return $this->json([
                'data' => $this->jsonResponseHelper->serializeData([$user], ['listing']),
                'code' => Response::HTTP_OK,
                'status' => 'success'
            ]);
        }

        return $this->json([
            'data' => $form->getErrors(true, false),
            'code' => Response::HTTP_BAD_REQUEST,
            'status' => 'error'
        ]);
    }

    #[Route('/delete/{id}', name: 'api_delete', methods: ['DELETE'])]
    public function deleteUser($id, TokenService $tokenService)
    {
        $token = $tokenService->generateToken();

        $tokenService->set($id, $token);

        return $this->json([
            'data' => 'Veuillez confirmer la suppression en utilisant le token fourni',
            'token' => $token,
            'code' => Response::HTTP_OK,
            'status' => 'success'
        ]);
    }

    #[Route('/confirm-delete/{id}', name: 'api_confirm_delete', methods: ['POST'])]
    public function confirmDeleteUser($id, Request $request, TokenService $tokenService)
    {
        $userToken = $request->request->get('token');
    
        $tokenStocker = $tokenService->get($id);
    
        if ($userToken === $tokenStocker) {

            $user = $this->userRepository->findOneBy(['id' => Uuid::fromString($id)]);
            if ($user) {
                $this->userManager->remove($user,true);
    
                return $this->json([
                    'data' => 'User deleted successfully!',
                    'code' => Response::HTTP_OK,
                    'status' => 'success'
                ]);
            } else {
                return $this->json([
                    'data' => 'User not found',
                    'code' => Response::HTTP_NOT_FOUND,
                    'status' => 'error'
                ]);
            }
        } else {

            return $this->json([
                'data' => 'Invalid token',
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => 'error'
            ]);
        }
    }
    
}
