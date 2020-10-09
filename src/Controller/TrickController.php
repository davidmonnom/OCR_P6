<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; 
use Twig\Environment;
use App\Entity\Trick;
use App\Repository\TrickRepository;
use App\Entity\Comment;
use App\Repository\CommentRepository;

class TrickController extends AbstractController{
	
	public function __construct(TrickRepository $trickRepo, CommentRepository $commentRepo){
        $this->trick = $trickRepo;
        $this->comment = $commentRepo;
    }

	public function list(): Response{

		$tricks = $this->trick->findAll();
        dump($tricks);
        
		return $this->render("trick/TrickIndex.html.twig", [
			'menu_active' => 'trickindex'
		]);
	}

	public function view(Trick $trick, string $slug): Response{
		$trickId = $trick->getId();
		$trickSlug = $trick->getSlug();

        if($trickSlug !== $slug){
			return $this->redirectToRoute('TrickView', [
				'id' => $trickId,
				'slug' => $trickSlug
			], 301);
		}

		// GET COMMENTS
		$comment = $this->comment($trickId);
		dump($comment);

		return $this->render("trick/TrickView.html.twig", [
			'menu_active' => 'trickview',
			'trick' => $trick,
			'comment' => $comment
		]);
	}

	public function create(): Response{
        $tricks = $this->getDoctrine()->getRepository(Trick::class);
		return $this->render("trick/TrickCreate.html.twig", [
			'menu_active' => 'trickcreate'
		]);
	}
	
	public function comment($trickId){
		return $this->comment->getByTrickId($trickId);
	}
	
}