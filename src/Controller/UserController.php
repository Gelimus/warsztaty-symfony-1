<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019-07-09
 * Time: 11:11
 */

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user/new",name="newUser")
     */
    public function new(Request $request)
    {
        // creates a task and gives it some dummy data for this example
        $user = new User();


        $form = $this->createFormBuilder($user)
            ->add('name', TextType::class)
            ->add('description', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Create User'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $user = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($user);
             $entityManager->flush();

            return $this->render('user/success.html.twig');
        }


        return $this->render('user/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/all",name="showAll")
     */
    public function showAll()
    {
        $list = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        return $this->render('user/all.html.twig', [
            'list' => $list,
        ]);
    }
}