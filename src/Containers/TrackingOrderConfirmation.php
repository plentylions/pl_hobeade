<?php

namespace HobeaDe\Containers;

use Plenty\Plugin\Templates\Twig;

class TrackingOrderConfirmation
{
    public function call(Twig $twig, $arg):string
    {
        return $twig->render('HobeaDe::Containers.TrackingOrderConfirmation', ["orderData" => $arg[0]]);
    }
}