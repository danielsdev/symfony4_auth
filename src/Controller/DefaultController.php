<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class DefaultController extends AbstractController
{

    public function index()
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    public function admin(){

        return new Response("<html><body><h1>Page Admin! </h1></body></html>");
    }

    public function dashboard(){

        return new Response("<html><body><h1>Page Admin Dashboard! </h1></body></html>");
    }

    public function reports(){

        return new Response("<html><body><h1>Page Admin Relatórios! </h1></body></html>");
    }

    public function login(Request $request, AuthenticationUtils $authUtils)
    {
        $error = $authUtils->getLastAuthenticationError();

        $lastUsername = $authUtils->getLastUsername();

        return $this->render("login.html.twig", [
            'error' => $error,
            'last_username' => $lastUsername
        ]);   
    }
}
