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
    public function createCategories(Request $request)
    {

        var_dump($request->getMethod());die();
        $formCreateCat = $this->createFormBuilder()
            ->add('Label', TextType::class)
            ->add('Type', TextType::class)
            ->add('Description', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'créer'))
            ->getForm();

        $formCreateServ = $this->createFormBuilder()
            ->add('Reference', TextType::class)
            ->add('Label', TextType::class)
            ->add('Type', TextType::class)
            ->add('Description', TextType::class)
            ->add('Vente', TextType::class)
            ->add('Achat', TextType::class)
            ->add('Prix_TTC', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'créer'))
            ->getForm();

        if('POST' === $request->getMethod()){
            // traitement du premier form
            var_dump($request->request->get(),'dede');die();
            if ($request->request->has('formCreateCat')){

                $formCreateCat->handleRequest($request);

                $label = $formCreateCat->get('Label')->getData();
                $type = $formCreateCat->get('Type')->getData();
                $color = $formCreateCat->get('Color')->getData();

                $content["label"] = $label;
                $content["type"] = $type;
                $content["color"] = $color;
                $buzz = $this->container->get('buzz');
                $browser = $buzz->getBrowser('dolibarr');

                $response = $browser->submit('/category?api_key=712f3b895ada9274714a881c2859b617',
                    $content, RequestInterface::METHOD_POST);

                /*complete code with control*/
            }

            if ($request->request->has('formCreateServ')){

                $formCreateServ->handleRequest($request);

                $ref = $formCreateServ->get('Reference')->getData();
                $label = $formCreateServ->get('Label')->getData();
                $desc = $formCreateServ->get('Description')->getData();
                $type = $formCreateServ->get('Type')->getData();
                $status = $formCreateServ->get('Vente')->getData();
                $status_buy = $formCreateServ->get('Achat')->getData();
                $price_TTC = $formCreateServ->get('Prix_TTC')->getData();

                $content["ref"] = $ref;
                $content["label"] = $label;
                $content["description"] = $desc;
                $content["type"] = $type;
                $content["status"] = $status;
                $content["status_buy"] = $status_buy;
                $content["price_ttc"] = $price_TTC;
                // prix en TTC
                $content["price_base_type"] = "TTC";


                $buzz = $this->container->get('buzz');
                $browser = $buzz->getBrowser('dolibarr');

                $response = $browser->submit('/product/?api_key=712f3b895ada9274714a881c2859b617',
                    $content, RequestInterface::METHOD_POST);

                /*complete code with control*/
            }
        }


//        if ($formCreateCat->isSubmitted() && $formCreateCat->isValid())
//        {
//
//        }

        return $this->render('categories.html.twig',
            array(
                'formCreateCat' => $formCreateCat->createView(),
                'formCreateServ' => $formCreateServ->createView(),
            )
        );

    }

//    public function createServices(Request $request)
//    {
//        $form = $this->createFormBuilder()
//            ->add('Label', TextType::class)
//            ->add('Type', TextType::class)
//            ->add('Color', TextType::class)
//            ->add('save', SubmitType::class, array('label' => 'créer'))
//            ->getForm();
//
//        return $this->render('categories.html.twig',
//            array(
//                'form' => $form->createView(),
//                'Erreur' => $msg,
//            )
//        );
//    }
}