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

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class dolibController extends Controller
{

    /**
     * @Route("/api/programmers", name = "dolib_users")
     * @Method("GET")
     */

//    public function getUser()
//    {
//        $buzz = $this->container->get('buzz');
////        var_dump('here');die();
//        $id = 21;
//        $browser = $buzz->getBrowser('dolibarr');
//        $response = $browser->get('/{n0}?api_key=712f3b895ada9274714a881c2859b617&id='.$id.'');
//
////        dump($browser->getLastRequest());
//        dump($response);
//        $content = json_decode($response->getContent());
//        return $this->render('list_dolib_users.html.twig',
//            array('response' => $content)
//        );
//
//    }

    public function findByID(Request $request)
    {
//        $defaultData = array('message' => 'Entrer un Id valid');
        $form = $this->createFormBuilder()
            ->add('id', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'checker'))
            ->getForm();

        $form->handleRequest($request);
        $id = 0;

        if($form->isValid()){
            $id = $form->get('id')->getData();
        }
//        if ($form->isSubmitted() && $form->isValid()) {
//            $data = $form->getData();
//        }

        return $this->render('list_dolib_users.html.twig', array(
            'id' => $id,
            'form' => $form->createView(),
        ));

        // ... render the form
    }
}