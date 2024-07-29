<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Operation;
use App\Form\OperationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class OperationController extends AbstractController
{
    /* 
    / : est la racine de l'arborescence de notre route
    C'est à partir de cette racine qu'on creer les chemins qu'on veut donner à notre route 
    */
    #[Route('/operation', name: 'formOperations')]
    public function index(Request $request, EntityManagerInterface $em, ValidatorInterface $validator): Response
    {
        //Création du produit et du formulaire avec les outils de symfony
        $operation = new Operation();
        $myForm = $this->createForm(OperationType::class, $operation); //Pas besoin de option il déja définie dans OperationType
        $result = "";

        $myForm->handleRequest($request);

        if($myForm->isSubmitted()){
            $data = $myForm->getData();
            $errors = $validator->validate($operation);
            if (count($errors) > 0) {
                $result = (string) $errors;
                //dd($result);
                

                //Redirection du resulat vers la  route showResulats
                return $this->redirectToRoute('showResulats', [
                    'result' => $result
                ]);
            }            

            // Ne pas initialiser les valeurs de a et b pour provoquer une erreur de type Not Null violation
            $operation->setA($data->getA());
            $operation->setB($data->getB());

            
            //Stocker les données dans l'entité operation
            $add = $data->add();
            $sub = $data->substraction();
            $mul = $data->multiply();
            $div = $data->divide();
            $result = "add= $add sub= $sub divsion=$div multi= $mul";
            $data->setResultat($result);

            //Persistance à la base de donnée
            $em->persist($operation);
            $em->flush($operation);

            //Redirection du resulat vers la  route showResulats
            return $this->redirectToRoute('showResulats', [
                'result' => $result
            ]);
        }

        return $this->render('index/operation.html.twig',
        [
            'form'          => $myForm->createView()
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