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
     * @Route("/api/users", name = "dolib_users")
     */

    public function getUserById(Request $request)
    {
        error_reporting(E_ALL);
        ini_set('display_errors', false);

        $form = $this->createFormBuilder()
            ->add('id', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'checker'))
            ->getForm();

        $form->handleRequest($request);
        $id = 1;

        if ($form->isSubmitted() && $form->isValid()) {
//            $data = $form->getData();
            $id = $form->get('id')->getData();

    }
        $buzz = $this->container->get('buzz');
//        var_dump('here');die();
        $browser = $buzz->getBrowser('dolibarr');
        $response = $browser->get('/user/{n0}?api_key=712f3b895ada9274714a881c2859b617&id='.$id.'');
        // verification de la requete
        $isArive = $response->getStatusCode();
        if($isArive != 200){
            $response = null;
            $content = null;
            $msg = "Erreur, cet Id n'existe pas";
            return $this->render('list_dolib_users.html.twig',
                array(
                    'response' => $content,
                    'form' => $form->createView(),
                    'Erreur' => $msg,)
            );
        }
        else {
            $content = json_decode($response->getContent());
            return $this->render('list_dolib_users.html.twig',
                array(
                    'response' => $content,
                    'form' => $form->createView(),)
            );
        }
//        dump($browser->getLastRequest());
        dump($response);

    }

}