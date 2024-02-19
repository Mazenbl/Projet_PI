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

    #[Route('/medecin', name: 'aboutPage')]
    public function about(): Response
    {
        return $this->render('user/medecin.html.twig');
    }

    #[Route('/pharmacie', name: 'doctorPage')]
    public function doctor(): Response
    {
        return $this->render('user/pharmacie.html.twig');
    }
    #[Route('/labos', name: 'departementsPage')]
    public function departements(): Response
    {
        return $this->render('user/labos.html.twig');
    }
    #[Route('/evenement', name: 'blogPage')]
    public function blog(): Response
    {
        return $this->render('user/evenement.html.twig');
    }
    #[Route('/hopital', name: 'contactPage')]
    public function contact(): Response
    {
        return $this->render('hopital/show.html.twig');
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