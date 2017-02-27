<?php
/**
 * Created by PhpStorm.
 * User: Naister
 * Date: 27/02/2017
 * Time: 15:38
 */

namespace AppBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

//use AppBundle\Buzz\Listener\TokenListener;

use Buzz\Message;
use Buzz\Client\ClientInterface;
use Buzz\Client\FileGetContents;
use Buzz\Listener\ListenerChain;
use Buzz\Listener\ListenerInterface;
use Buzz\Message\Factory\Factory;
use Buzz\Message\Factory\FactoryInterface;
use Buzz\Message\RequestInterface;
use Buzz\Util\Url;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class categoryController extends Controller
{
    /**
     * @Route("/api/categories", name = "dolib_categories")
     */
    public function createInvoice(Request $request)
    {
        $msg = "";
        $form = $this->createFormBuilder()
            ->add('Label', TextType::class)
            ->add('Type', NumberType::class)
            ->add('save', SubmitType::class, array('label' => 'créer'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $label = $form->get('Label')->getData();
            $type = $form->get('Type')->getData();
            $content["label"] = $label;
            $content["type"] = $type;
            $buzz = $this->container->get('buzz');
            $browser = $buzz->getBrowser('dolibarr');

            $response = $browser->submit('/category?api_key=712f3b895ada9274714a881c2859b617',
                $content, RequestInterface::METHOD_POST);

            /*complete code with control*/
        }

        return $this->render('categories.html.twig',
            array(
                'form' => $form->createView(),
                'Erreur' => $msg,
            )
        );

    }
}