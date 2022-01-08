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
            ['route' => 'livre_index', 'intitule' => 'Gérer tous les livres'],
            ['route' => 'categorie_index', 'intitule' => 'Gérer toutes les categories'],
            ['route' => 'user_index', 'intitule' => 'Gérer tous les users'],
            ['route' => 'app_logout', 'intitule' => 'Logout'],
        );
        return $this->render('bib/menu.html.twig', ['mymenu' => $mymenu,]);
    }
    
    /**
     * @Route("/menu_auth", name="menu_auth")
     * 
     */
    public function menu_auth(): response
    {
        $mymenu = array(
            ['route' => 'app_login', 'intitule' => 'Login'],
            ['route' => 'app_register', 'intitule' => 'Register'],
        );
        return $this->render('bib/menu.html.twig', ['mymenu' => $mymenu,]);
    }

}
