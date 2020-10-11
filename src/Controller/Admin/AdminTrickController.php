<?php 
namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; 
use App\Repository\TrickRepository;
use App\Entity\Trick;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\TrickType;
use Twig\Environment;

class AdminTrickController extends AbstractController{

    /**
     * @var TrickRepository
     */
    private $trickRepo;
    public function __construct(TrickRepository $trickRepo, EntityManagerInterface $em){

        $this->trickRepo = $trickRepo;
        $this->em = $em;
    }

    public function index(){

        $tricks = $this->trickRepo->findAll();
        // return $this->render('admin/trick/index.html.twig', compact('tricks'));
        return $this->render('admin/trick/index.html.twig', [
            'menu_active' => 'trickindex',
            'tricks' => $tricks,
        ]);
        
    }

    /** 
    *   @param Trick $trick
    *   @param Request $request
    */

    public function new(Request $request){
        $trick = new Trick();
        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($trick);
            $this->em->flush();
            $this->addFlash('success', 'Trick créé avec succès !');
            return $this->redirectToRoute('AdminTrick');
        }

        return $this->render('admin/trick/edit.html.twig', [
            'trick' => $trick,
            'form' => $form->createView()
        ]);
    }

    /** 
    *   @param Trick $trick
    *   @param Request $request
    */

    public function edit(Trick $trick, Request $request){
        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Trick modifié avec succès !');
            return $this->redirectToRoute('AdminTrick');
        }

        return $this->render('admin/trick/edit.html.twig', [
            'trick' => $trick,
            'form' => $form->createView()
        ]);
    }

    /** 
    *   @param Trick $trick
    *   @param Request $request
    */

    public function delete(Trick $trick, Request $request){
        if($this->isCsrfTokenValid('delete' . $trick->getId(), $request->get('csrf_token'))){
            $this->em->remove($trick);
            $this->em->flush();
            $this->addFlash('success', 'Trick supprimé avec succès !');
            return $this->redirectToRoute('AdminTrick');
        }
        return $this->redirectToRoute('AdminTrick');
    }
}