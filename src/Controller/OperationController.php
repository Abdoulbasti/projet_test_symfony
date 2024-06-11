<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Operation;
use App\Form\OperationType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class OperationController extends AbstractController
{
    /* 
    / : est la racine de l'arborescence de notre route
    C'est à partir de cette racine qu'on creer les chemins qu'on veut donner à notre route 
    */
    #[Route('/operation', name: 'formOperations')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        //Création du produit et du formulaire avec les outils de symfony
        $operation = new Operation();
        $myForm = $this->createForm(OperationType::class, $operation); //Pas besoin de option il déja définie dans OperationType

        $myForm->handleRequest($request); 

        $result = "";
        if($myForm->isSubmitted() && $myForm->isValid()){
            $data = $myForm->getData();
            
            //Effectuer les operations
            $add = $data->add();
            $sub = $data->substraction();
            $mul = $data->multiply();
            $div = $data->divide();

            $result = "add= $add sub= $sub divsion=$div multi= $mul";
            $data->setResultat($result);
            
            //dd($operation);

            //Ajouter les informations de notre entité dans la base de donnée(la persistance)
            $em->persist($operation);
            $em->flush($operation);


            //Redirection du resulat vers la  route showResulats
            return $this->redirectToRoute('showResulats', [
                'result' => $result
            ]);
        }

        return $this->render('index/operation.html.twig',
        [
            'form'              => $myForm->createView()
        ]);
    }


    #[Route('/operation/result', name: 'showResulats')]
    public function show(Request $request): Response
    {
        $result = $request->query->get('result'); //GET : pour recuperer les information via le lien de l'url


        //$result = $request->request->get('result'); //POST : pour recuperer la valeur de result via l'en tête http
        return $this->render('index/showResult.html.twig',
        [
            'result'            => $result
        ]);
    }
}