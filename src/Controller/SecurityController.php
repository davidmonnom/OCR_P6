<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; 
use App\Repository\UserRepository;
use App\Entity\User;
use App\Form\LoginType;
use Twig\Environment;

class SecurityController extends AbstractController{
    public function login(){
        $User = new User();
        $form = $this->createForm(LoginType::class, $User);

        return $this->render('security/login.html.twig', [
            'form' => $form->createView()
        ]);
    }
}