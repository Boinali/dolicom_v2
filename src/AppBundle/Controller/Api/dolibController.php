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

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;


class dolibController extends Controller
{

    /**
     * @Route("/api/programmers", name = "dolib_users")
     * @Method("GET")
     */

    public function getAllUsers(Request $request)
    {
          $users = $this->get('doctrine.orm.customer_entity_manager')
              ->getRepository('AppBundle:dolibUser')
              ->findAll();
        /* @var $users dolibUser[] */

        $formatted = [];
        foreach ($users as $user) {
            $formatted[] = [
                'id' => $user->getRowid(),
                'login' => $user->getLogin(),
                'email' => $user->getEmail(),
            ];
        }

        return new JsonResponse($formatted);

//        $request = Request::createFromGlobals();
//        $request->create('http://dolibarr.localdomain/api/index.php/user/{n0}?api_key=712f3b895ada9274714a881c2859b617&id=1', 'GET');
//
//        $response =  new Response(json_encode($request));
//        $response->headers->set('Content-Type','application/json');
//
//        return $response;
    }
}