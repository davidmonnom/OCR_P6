<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; 
use Twig\Environment;

class HomeController extends AbstractController{

	public function index(): Response{
		return $this->render("pages/Home.html.twig", [
			'menu_active' => 'home'
		]);
	}
	
}