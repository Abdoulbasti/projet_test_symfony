<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class MakeOperationEvent implements EventSubscriberInterface {

    public function makeOperation(){
        //Mecanique pour recuperer a et b 
        //Et effecuer les operations pour qu'il puisse être enfin afin afficher dans le champs resultat
    }

    public static function getSubscribedEvents(): array
    {
        return [
            //RequestEvent::class => 'onKernelRequest',

        ];
    }


}