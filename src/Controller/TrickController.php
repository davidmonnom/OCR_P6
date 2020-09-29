<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; 
use Twig\Environment;
use App\Entity\Trick;
use App\Repository\TrickRepository;

class TrickController extends AbstractController{
	public function __construct(TrickRepository $repository){
        $this->repository = $repository;
    }

	public function list(): Response{

		$tricks = $this->repository->findAll();
        dump($tricks);
        
		return $this->render("trick/TrickIndex.html.twig", [
			'menu_active' => 'trickindex'
		]);
	}

	public function view($slug, $id): Response{

		$trick = $this->repository->find($id);
		dump($trick);
        
		return $this->render("trick/TrickView.html.twig", [
			'menu_active' => 'trickview',
			'trick' => $trick
		]);
	}

	public function create(): Response{

        $tricks = $this->getDoctrine()->getRepository(Trick::class);
        dump($tricks);
        
		return $this->render("trick/TrickCreate.html.twig", [
			'menu_active' => 'trickcreate'
		]);
	}
	
	
}