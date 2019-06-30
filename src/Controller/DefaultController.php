<?php

namespace App\Controller;

use App\Entity\User;
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

        $texto = "Esse usuário não é admin";

        if($this->isGranted('ROLE_ADMIN')){
            $texto = "Esse usuário é um administrador";
        }

        return $this->render("admin/index.html.twig", [
            'texto' => $texto
        ]);
    }

    public function dashboard(){

        return $this->render("admin/dashboard.html.twig");
    }

    public function reports(){

        return $this->render("admin/reports.html.twig");
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

    public function insert()
    {
        $em = $this->getDoctrine()->getManager();

        #$factory = $this->get('security.encoder_factory');
        #$encoder = $factory->getEncoder($user);
        #$password = $encoder->encodePassword("123", $user->getSalt());

        $options = [
            'cost' => 12
        ];
        
        $user = new User();
        $user->setUsername('usuario');
        $user->setEmail('usuario@usuario.com');
        $user->setRoles("ROLE_USER");

        $em->persist($user);

        
        #$password = $encoder->encodePassword($user, "123");
        $user->setPassword(password_hash('123', PASSWORD_BCRYPT, $options));

        $admin = new User();
        $admin->setUsername('admin');
        $admin->setEmail('admin@admin.com');
        $admin->setRoles("ROLE_ADMIN");
        
        #$password = $encoder->encodePassword("abc", $user->getSalt());

        $admin->setPassword(password_hash('abc', PASSWORD_BCRYPT, $options));

        $em->persist($admin);

        $em->flush();

        return new Response("<h1>Usuários cadastrados com sucesso!</h1>");
    }
}
