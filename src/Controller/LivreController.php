<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class LivreController extends AbstractController
{
    /**
     * @Route("/livre", name="livre")
     */
    public function index(): Response
    {
        return $this->render('livre/index.html.twig', [
            'controller_name' => 'LivreController',
        ]);
    }

    /**
     * @Route("/livre/liste", name="liste")
     */
    public function liste(LivreRepository  $repository){
        $livres = $repository->findAll();
        return $this->render(
            'livre/liste.html.twig',
            [
                'livres' => $livres,
                
            ]

        );
    }

    /**
     * @Route("/livre/ajouter", name="ajouter")
     */
    public function ajouter(Request $request)
    {
        $livre = new Livre();

        $form = $this->createFormBuilder($livre)
            ->add('titre', TextType::class)
            ->add('description', TextType::class)
            ->add('statut', TextType::class)
            ->add('date_emprunt', DateType::class)
            ->add('date_retour', DateType::class)
            ->add('save', SubmitType::class)
            ->getForm();

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($livre);
                $em->flush();
                $session = new Session();
                $session->getFlashBag()->add('notice', 'livre bien enregistré.');
                return $this->redirectToRoute('liste');

            }
        }
        return $this->render('livre/ajouter.html.twig', array('form' => $form->createView()));
    }
     /**
     * @Route("/supprimer/{titre}", name="supprimer", requirements={"titre"="\d+"})
     * 
     */

    public function supprimer($titre)
    {
        
       
        $em = $this->getDoctrine()->getManager();
        $livre = $em->getRepository(Livre::class)->find($titre);
        foreach ($livre-> getTitre() as $titre){
            $livre->removeTitre($titre);
        }
        $em->flush();

        return $this->render(
            'livre/supprimer.html.twig',
            ['titre'=>$titre]);
        
    }
}
