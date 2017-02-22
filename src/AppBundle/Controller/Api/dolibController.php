<?php
/**
 * Created by PhpStorm.
 * User: Naister
 * Date: 20/02/2017
 * Time: 15:34
 */

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Api\dolibUser;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Buzz\Browser;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;


class dolibController extends Controller
{

    /**
     * @Route("/api/programmers", name = "dolib_users")
     * @Method("GET")
     */

    public function getUser()
    {
        $buzz = $this->container->get('buzz');
//        var_dump('here');die();
        $browser = $buzz->getBrowser('dolibarr');
        $response = $browser->get('/{n0}?api_key=712f3b895ada9274714a881c2859b617&id=1');

//        dump($browser->getLastRequest());
        dump($response);

        return $this->render('list_dolib_users.html.twig',
            array('response' => $response)
        );

    }
}