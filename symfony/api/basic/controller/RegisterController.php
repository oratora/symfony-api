<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var \Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface
     */
    private $encoder;
    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $entityManager;

    /**
     * RegisterController constructor.
     * @param UserRepository $userRepository
     * @param \Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface $encoder
     * @param \Doctrine\ORM\EntityManagerInterface $entityManager
     */
    public function __construct(
        UserRepository $userRepository,
        UserPasswordEncoderInterface $encoder,
        EntityManagerInterface $entityManager
    )
    {
        $this->userRepository = $userRepository;
        $this->encoder = $encoder;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/register", name="register")
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $content = $request->getContent();
        $req = json_decode($content);

        $email = $req->email;
        $plainTextPassword = $req->password;

        $user = $this->userRepository->findOneBy([
            'email' => $email
        ]);

        if ($user) {
            return new JsonResponse('user already exists', Response::HTTP_CONFLICT);
        }

        $user = new User();
        $user->setEmail($email);
        $user->setPassword(
            $this->encoder->encodePassword($user, $plainTextPassword)
        );

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return new JsonResponse($user, Response::HTTP_CREATED);
    }
}
