<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LuckyController extends AbstractController
{
    /**
     * @Route("/lotto")
     */
    public function number()
    {

        $number = random_int(10, 13);

        return $this->render('lotto/numerek.html.twig', [
            'number' => $number,
        ]);
    }


    /**
     * @Route("/lotto/{min}/{max}")
     */
    public function number2($min, $max)
    {
        $number = random_int($min, $max);

        return $this->render('lotto/numerek.html.twig', [
            'number' => $number,
        ]);
    }

    /**
     * @Route("/twojlotto/{imie}/{numer}")
     */
    public function dedykowanyNumer($imie, $numer)
    {


        return $this->render('lotto/dedykowanyNumerek.html.twig', [
            'number' => $numer,
            'nazwa' => $imie
        ]);
    }

    /**
     * @Route("/lotek",name="lotek")
     */
    public function lotek()
    {
        $tablica = [];

        for($i=0;$i<6;$i++)
        {
            $tablica[$i] = random_int(1, 49);
        }



        return $this->render('lotto/lotek.html.twig', [
            'tab' => $tablica,
        ]);
    }
}