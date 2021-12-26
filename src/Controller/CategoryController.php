<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Flex\Path;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category")
     */
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

     /**
     * @Route("/category/liste", name="category_liste")
     */
    public function liste(CategorieRepository  $repository){
        $categories = $repository->findAll();
        return $this->render(
            'category/liste.html.twig',
            [
                'categories' => $categories,
                
            ]

        );
    }

    /**
     * @Route("/category/ajouter", name="category_ajouter")
     * 
     */

    public function ajouter(Request $request)
    {
        $cat = new Categorie();

        $form = $this->createFormBuilder($cat)
            ->add('nom', TextType::class)
            ->add('save', SubmitType::class)
            ->getForm();

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($cat);
                $em->flush();
                $session = new Session();
                $session->getFlashBag()->add('notice', 'catégorie bien enregistrée.');
                return $this->redirectToRoute('category_liste');

            }
        }
        return $this->render('category/ajouter.html.twig', array('form' => $form->createView()));
    }


   

}
