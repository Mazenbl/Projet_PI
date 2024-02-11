<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/home', name: 'homePage')]
    public function home(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/about', name: 'aboutPage')]
    public function about(): Response
    {
        return $this->render('user/about.html.twig');
    }

    #[Route('/doctor', name: 'doctorPage')]
    public function doctor(): Response
    {
        return $this->render('user/doctor.html.twig');
    }
    #[Route('/departements', name: 'departementsPage')]
    public function departements(): Response
    {
        return $this->render('user/departements.html.twig');
    }
    #[Route('/blog', name: 'blogPage')]
    public function blog(): Response
    {
        return $this->render('user/blog.html.twig');
    }
    #[Route('/contact', name: 'contactPage')]
    public function contact(): Response
    {
        return $this->render('user/contact.html.twig');
    }
    #[Route('/signIn', name: 'signInPage')]
    public function signIn(): Response
    {
        return $this->render('user/Sign_in.html.twig');
    }
    #[Route('/signUp', name: 'signUpPage')]
    public function signUp(): Response
    {
        return $this->render('user/Sign_up.html.twig');
    }
}