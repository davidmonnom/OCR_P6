<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; 
use App\Repository\TrickRepository;
use App\Entity\Trick;
use Twig\Environment;

class HomeController extends AbstractController{

	public function index(TrickRepository $repository): Response{

		$tricks = $repository->findLatest();
		dump($tricks);
		return $this->render("pages/home.html.twig", [
			'menu_active' => 'home',
			'tricks' => $tricks
		]);
	}
	
}