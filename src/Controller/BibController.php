<?php

namespace App\Controller;

use App\Entity\Bib;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route; 

class BibController extends AbstractController
{
    /**
     * @Route("/bib", name="bib")
     */
    public function index(): Response
    {
        return $this->render('bib/index.html.twig', [
            'controller_name' => 'BibController',
        ]);
    }
    /**
     * @Route("/accueil", name="accueil")
     */
    public function accueil(): Response
    {
        return $this->render('bib/accueil.html.twig');
    }
 /**
     * @Route("/voir/{id}", name="voir", requirements={"id"="\d+"})
     */
    public function voir($id): Response
    {
        return $this->render('bib/voir.html.twig', 
        ['id' =>$id]);
        
    }
    
    /**
     * @Route("/ajouter", name="ajouter")
     * 
     */

    public function ajouter(Request $request )
    {
//         $bib = new Bib();

//         $form= $this->createFormBuilder($bib) 
//         ->add('adresse',TextType::class)
//         ->add('nom',TextType::class)
//         ->add('save',SubmitType::class)
//         ->getForm();

// if ($request->isMethod ('POST')) {
//      $form->handleRequest ($request);
//     if ($form->isValid())
//     { $em = $this->getDoctrine ()->getManager();  
//     $em->persist($bib);  
//     $em->flush();  
//     $session=new Session();
//     $session->getFlashBag()->add('notice', 'bib bien enregistré.'); 
//     }
// }
// return $this->render('bib/ajouter.html.twig', array('form' => $form->createView()));
        // return $this->render('bib/ajouter.html.twig');
        
    }

     /**
     * @Route("/liste", name="liste")
     * 
     */

    public function liste()
    {
        return $this->render('bib/liste.html.twig');
        
    }
    /**
     * @Route("/menu", name="menu")
     * 
     */
    public function menu(): response
    {
        $mymenu = array(
            ['route' => 'bib', 'intitule' => 'Accueil'],
            ['route' => 'livre_liste', 'intitule' => 'Gérer tous les livres'],
            ['route' => 'category_liste', 'intitule' => 'Gérer toutes les categories'],
            ['route' => 'user_liste', 'intitule' => 'Gérer tous les users'],
        );
        return $this->render('bib/menu.html.twig', ['mymenu' => $mymenu,]);
    }

}
