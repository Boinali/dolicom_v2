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
     * Lists all user entities.
     *
     */
    /*public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('AppBundle/Api:dolibUser')->findAll();

        return $this->render('user/index.html.twig', array(
            'users' => $users,
        ));
    }*/


    /**
     * @Route("/api/programmers")
     * @Method("GET")
     */

    public function getAllUsers()
    {

        $users = $this->get('doctrine.orm.customer_entity_manager')
            ->getRepository('AppBundle:/Api/dolibUser')
            ->findAll();
        /* @var $users User[] */

        $formatted = [];
        foreach ($users as $user) {
            $formatted[] = [
                'rowid' => $user->getRowId(),
            ];
        }

        return new JsonResponse($formatted);

    }
}