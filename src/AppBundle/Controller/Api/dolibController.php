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

    public function getAllUsers()
    {
        return ("work in progress ...");
    }
}