<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019-07-09
 * Time: 11:11
 */

namespace App\Controller;

use App\Entity\Article;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article/new",name="newArticle")
     */
    public function new(Request $request)
    {
        // creates a task and gives it some dummy data for this example
        $article = new Article();
        $article->setDate(new \DateTime('now'));

        $form = $this->createFormBuilder($article)
            ->add('title', TextType::class)
            ->add('description', TextType::class)
            //->add('date', DateType::class)
            ->add('user')
            ->add('save', SubmitType::class, ['label' => 'Create Article'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $article = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->render('article/success.html.twig');
        }


        return $this->render('article/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}