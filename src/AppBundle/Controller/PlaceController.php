<?php
/**
 * Created by PhpStorm.
 * User: Naister
 * Date: 20/02/2017
 * Time: 10:47
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Place;

class PlaceController
{
    /**
     * @Route("/places", name="places_list")
     * @Method({"GET"})
     */
    public function getPlacesAction(Request $request)
    {
        return new JsonResponse([
            new Place("Tour Eiffel", "5 Avenue Anatole France, 75007 Paris"),
            new Place("Mont-Saint-Michel", "50170 Le Mont-Saint-Michel"),
            new Place("Château de Versailles", "Place d'Armes, 78000 Versailles"),
        ]);
    }
}