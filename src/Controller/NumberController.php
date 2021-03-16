<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


 class NumberController extends AbstractController
 {
    public $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

     /**
      * @Route("/number", name="daniel")
      */
     public function number(): Response
{
        $number = 0;
        $message = "";
        if($this->session->get('number')!=null){
            $number = $this->session->get('number');
        }
        else
        {
            $this->session->set('number',random_int(0,100));
            $number = $this->session->get('number');
        }
        if(!empty($_GET["nr"])){
            if($_GET["nr"] < $number){
                $message = "PREA MIC";
            }
            else
            if($_GET["nr"] > $number){
                $message = "PREA MARE";
            }
            else{
            $message = "EXACT";}
        }

         return $this->render('number.html.twig', [
             'number' => $number,
             'message' => $message,
         ]
         );
     }
 }