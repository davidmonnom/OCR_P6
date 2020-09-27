<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; 
use Twig\Environment;

class TrickIndexController extends AbstractController{
	
	public function list(): Response{
		return $this->render("trick/TrickIndex.html.twig", [
			'menu_active' => 'trickindex'
		]);
	}
	
}