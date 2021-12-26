<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    
     /**
     * @Route("/user/liste", name="liste")
     */
    public function liste(UserRepository  $repository){
        $users = $repository->findAll();
        return $this->render(
            'user/liste.html.twig',
            [
                'user' => $users,
                
            ]

        );
    }
    /**
     * @Route("/user/ajouter", name="ajouter")
     * 
     */
    public function ajouter(Request $request)
    {
        $users = new User();

        $form = $this->createFormBuilder($users)
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('poste', TextType::class)
            ->add('cin', TextType::class)
            ->add('save', SubmitType::class)
            ->getForm();

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($users);
                $em->flush();
                $session = new Session();
                $session->getFlashBag()->add('notice', 'user bien enregistré.');
                return $this->redirectToRoute('liste');

            }
        }
        return $this->render('user/ajouter.html.twig', array('form' => $form->createView()));
    }
}
