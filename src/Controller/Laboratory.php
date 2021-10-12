<?php

namespace App\Controller;

use App\Entity\Analyse;
use App\Entity\Covid;
use App\Entity\Marque;
use App\Entity\Robot;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class Laboratory extends AbstractController
{
    #[Route(path:"demo")]
    public function  demo(EntityManagerInterface $entityManager): Response
    {
        echo "<html><style>
    h1 { color: #3ebda0; }
  </style>
  <style>
    h3 { color: #6cd361; }
  </style><h1>Affichage pour Humain</h1></html>";

        $repository= $this->getDoctrine()->getRepository(Robot::class);
        $new=$repository->findall();
        $repository2=$this->getDoctrine()->getRepository(Marque::class);
        $new2=$repository2->findAll();
        $repository3=$this->getDoctrine()->getRepository(Covid::class);
        $new3=$repository3->findAll();
        $repository4=$this->getDoctrine()->getRepository(Analyse::class);
        $new4=$repository4->findAll();
//      foreach( $new as $item)
//      {
//          echo "<br>".$item->Nom."</br>";
//      }

        dump($new);
        dump($new2);
        dump($new3);
        dump($new4);
        return new Response("il y a ".count($new)."robot");
       // return new Response(" robot ".$test->Nom." j'ai ".$test->Pipette);
    }
    #[Route(path:"demo2/{id}")]
    public function json1(Request $request,EntityManagerInterface $em, int $id){
        echo"<br><h1>Affichage pour Robot</h1></br>";
       $robot=$em->getRepository(Robot::class)->find($id);
        return $this->render('robot.json.twig',['robot'=>$robot]);

    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    #[Route(path:"demoAll")]
    public function json2(Request $request,EntityManagerInterface $em){
        echo"<br><h1>Affichage pour Robot</h1></br>";
        $robot=$em->getRepository(Robot::class)->findAll();
        return $this->render('robots.json.twig',['liste'=>$robot]);

    }

    #[Route(path:"/robot/{identifiant}", methods: ['DELETE'])] //DELETE: supprimer, POST: envoyer, PUT: modifier quelque chose ; POSTMAN (extension navigateur) permet de choisir la methode
    public function prendlaRoute3(EntityManagerInterface $em, int $identifiant){
        $robot=$em->getRepository(Robot::Class)->find($identifiant);
        $em->remove($robot);
        $em->flush();

        return new Response('ok');//->render('robot.json.twig', ['robot'=>$robot]);  //ouverture d'un fichier à la fin de cette ligne
    }

    #[Route(path:"/robot/{identifiant}", methods: ['PUT'])] //DELETE: supprimer, POST: envoyer, PUT: modifier quelque chose ; POSTMAN (extension navigateur) permet de choisir la methode
    public function prendlaRoute4(Request $request, EntityManagerInterface $em, int $identifiant){

        $data=json_decode($request->getContent());
        $robot=$em->getRepository(Robot::Class)->find($identifiant);
        $robot->nomTexte = $data->nom;
        $em->flush();
        return $this->render('robot.json.twig', ['robot'=>$robot]);
        //return new Response('ok');//->render('robot.json.twig', ['robot'=>$robot]);  //ouverture d'un fichier à la fin de cette ligne
    }

}