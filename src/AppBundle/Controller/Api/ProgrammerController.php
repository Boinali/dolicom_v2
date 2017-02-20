<?php

namespace AppBundle\Controller\Api;
/**
 * Created by PhpStorm.
 * User: Naister
 * Date: 20/02/2017
 * Time: 15:15
 */

use  Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProgrammerController extends  Controller
{
    /**
     * @Route("/api/list_users")
     * @Method("GET")
     */
    public function getUsers()
    {
        return new Response('http://dolibarr.localdomain/api/index.php/user/{n0}?api_key=712f3b895ada9274714a881c2859b617&id=1');
    }
}