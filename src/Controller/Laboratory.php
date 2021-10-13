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
    /**
     * Affichage des informations du robot en html
     *
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route(path:"demo")]
    public function  demo(EntityManagerInterface $entityManager): Response
    {
        //Affichage et style du titre
        echo "<html><style> h1 { color: #3ebda0; } </style>
        <style> h3 { color: #6cd361; } </style><h1>Affichage pour Humain</h1></html>";

        //Récupération des informations de la base de données
        $repository= $this->getDoctrine()->getRepository(Robot::class);
        $new=$repository->findall();
        $repository2=$this->getDoctrine()->getRepository(Marque::class);
        $new2=$repository2->findAll();
        $repository3=$this->getDoctrine()->getRepository(Covid::class);
        $new3=$repository3->findAll();
        $repository4=$this->getDoctrine()->getRepository(Analyse::class);
        $new4=$repository4->findAll();

        dump($new, $new2, $new3, $new4); //Vérification

        echo "<br><a href = http://127.0.0.1:8001/demoAll > Affichage en json </a></br>"; //lien vers l'affichage du robot en json

        return new Response("il y a ".count($new)."robot"); //return
    }

    /**
     * Function permettant d'afficher la liste des robot avec la marque du robot,
     * l'analyse effectuées, le patient et le résultat de l'analyse
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    #[Route(path:"demoAll")]
    public function listeRobots(Request $request,EntityManagerInterface $em){
        echo"<br><h1>Affichage pour Robot</h1></br>";
        $robot=$em->getRepository(Robot::class)->findAll();
        echo "<br><a href = http://127.0.0.1:8001/demo > Affichage Humain</a></br>";
        return $this->render('robots.json.twig',['liste'=>$robot]);
    }

    /**
     * Function qui affiche les informations du robot dont l'identifiant est dans l'url.
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param int $id
     * @return Response
     */
    #[Route(path:"robot/{id}",methods :['GET'])]
    public function robotId(Request $request,EntityManagerInterface $em, int $id){
        echo"<br><h1>Affichage pour Robot</h1></br>";
        $robot=$em->getRepository(Robot::class)->find($id);
        return $this->render('robot.json.twig',['robot'=>$robot]);
    }

    /**
     * Fonction permettant de supprimer le robot
     *
     * @param EntityManagerInterface $em
     * @param int $identifiant
     * @return Response
     */
    #[Route(path:"/robot/{identifiant}", methods: ['DELETE'])] //DELETE: supprimer, POST: envoyer, PUT: modifier quelque chose ; POSTMAN (extension navigateur) permet de choisir la methode
    public function suppRobot(EntityManagerInterface $em, int $identifiant){
        echo"<br><h1>Affichage pour Robot</h1></br>";
        $robot=$em->getRepository(Robot::Class)->find($identifiant);
        $em->remove($robot);
        $em->flush();

        return new Response('ok');//->render('robot.json.twig', ['robot'=>$robot]);  //ouverture d'un fichier à la fin de cette ligne
    }

    /**
     * Fonction permettant de modifier le nom d'un robot
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param int $identifiant
     * @return Response
     */
    #[Route(path:"/robot/{identifiant}", methods: ['PUT'])] //DELETE: supprimer, POST: envoyer, PUT: modifier quelque chose ; POSTMAN (extension navigateur) permet de choisir la methode
    public function modificationRobot(Request $request, EntityManagerInterface $em, int $identifiant){
        echo"<br><h1>Affichage pour Robot</h1></br>";
        $data=json_decode($request->getContent());
        $robot=$em->getRepository(Robot::Class)->find($identifiant);
        $robot->Nom = $data->nomrobot;
        $em->flush();

        return $this->render('robot.json.twig', ['robot'=>$robot]);
    }

    /**
     * Ajout d'un robot ayant les objets marque, analyse, covid dans l'url
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param int $idAnalyse
     * @param int $idMarque
     * @param int $idcovid
     * @return Response
     */
    #[Route(path:"/robot/{idAnalyse}/{idMarque}/{idcovid}", methods: ['POST'])] //DELETE: supprimer, POST: envoyer, PUT: modifier quelque chose ; POSTMAN (extension navigateur) permet de choisir la methode
    public function ajoutRobot(Request $request, EntityManagerInterface $em, int $idAnalyse,int $idMarque,int $idcovid){
        echo"<br><h1>Affichage pour Robot</h1></br>";
        $analyse=$em->getRepository(Analyse::class)->find($idAnalyse);
        $marque=$em->getRepository(Marque::class)->find($idMarque);
        $covid=$em->getRepository(Covid::class)->find($idcovid);
        $data=json_decode($request->getContent());

        $robot = new Robot($data->nomrobot,);
        $em->persist($robot);
        $em->flush();

        return $this->render('robotpost.json.twig', ['robot'=>$robot]);
    }

}