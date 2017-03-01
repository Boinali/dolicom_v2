<?php
/**
 * Created by PhpStorm.
 * User: Naister
 * Date: 27/02/2017
 * Time: 15:38
 */

namespace AppBundle\Controller\Api;

use Symfony\Component\Validator\Constraints\Regex;
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
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

use Symfony\Component\OptionsResolver\OptionsResolver;

class categoryController extends Controller
{
    /**
     * @Route("/api/categories", name = "dolib_categories")
     */
    public function createAction(Request $request)
    {


        $formCreateCat = $this->get('form.factory')->createNamedBuilder('formCreateCat')
            ->add('Label', TextType::class, array(
                'constraints' => array(
                    new NotBlank(),
                    new Regex(array(
                        'message' => 'le Nom doit contenir au moin 1 è valide (A-Z maj ou min)',
                        'pattern' => "/^[a-zA-Z]+$/"
                    ))
                )
            ))
            ->add('Type', NumberType::class,array(
                new NotBlank(),
            ))
            ->add('Color', TextType::class,array(
//                'pattern' => '/^[0-9a-f]{3,6}$/i',
                "required" => false))
            ->getForm();

        $formCreateServ = $this->get('form.factory')->createNamedBuilder('formCreateServ')
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

            if ($request->request->has('formCreateCat')){

                $formCreateCat->handleRequest($request);

                $label = $formCreateCat->get('Label')->getData();
                // defaut type
                $type = 0;
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

        return $this->render('AppBundle::services.html.twig',
            array(
                'formCreateCat' => $formCreateCat->createView(),
                'formCreateServ' => $formCreateServ->createView(),
            )
        );

    }

//    public function createServices(Request $request)
//    {
//        // recup des produits et services
//
//        return $this->render('services.html.twig',
//            array(
//                'form' => $form->createView(),
//            )
//        );
//    }
}