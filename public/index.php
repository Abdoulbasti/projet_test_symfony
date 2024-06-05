<?php

use App\Kernel;
use App\Entity\Operation;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

/** @var Operation */
//Ecriture fluent
$operation = (new Operation())
    ->setA(3)
    ->setB(19);
/*$operation = (new Operation());
$operation->setA(3);
$operation->setB(19);*/

dd( $operation->add(), 
    $operation->substraction(), 
    $operation->multiply(), 
    $operation->divide());



return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
