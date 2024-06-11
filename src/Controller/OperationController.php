<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Operation;
use App\Form\OperationType;

class OperationController extends AbstractController
{
    /* 
    / : est la racine de l'arborescence de notre route
    C'est à partir de cette racine qu'on creer les chemins qu'on veut donner à notre route 
    */
    #[Route('/operation', name: 'formOperations')]
    public function index(Request $request): Response
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

            $result = "add=".$add."   ".'sub='.$sub."   "."divsion=".$div."   "."multi=" .$mul;
            //$data->setResultat($result);

            return $this->redirectToRoute('formOperations', [
                'result' => $result
            ]);
        }

        $result = $request->query->get('result', null);

        return $this->render('index/operation.html.twig',
        //Liste des choses qu'on renvoi à la au fichier twig : operation.html.twig
        [
            'form'              => $myForm->createView(),
            'result'            => $result,
        ]);
    }
}