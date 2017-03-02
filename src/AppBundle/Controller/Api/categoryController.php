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
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

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
                        'message' => 'le Nom doit contenir au moin 1 caractère valide (A-Z maj ou min)',
                        'pattern' => "/^[a-zA-Z]+$/"
                    ))
                )
            ))
            ->add('Type', NumberType::class,array(
                'constraints' => array(
                    new NotBlank(),
                    new Regex(array(
                        'message' => 'Le type doit contenir au moin 1 /^[0-9a-f]{3,6}$/i entier',
                        'pattern' => "/[^0-9]/"
                    ))
                )
            ))
            ->add('Color', TextType::class,array(
                "required" => false,
                'constraints' => array(
                    new NotBlank(),
                    new Regex(array(
                        'message' => 'Caractere hexadecimal attendu',
                        'pattern' => "/^[0-9a-f]{3,6}$/i"
                    ))
                )
            ))
            ->getForm();

        $formCreateServ = $this->get('form.factory')->createNamedBuilder('formCreateServ')
            ->add('Reference', TextType::class, array(
                'constraints' => array(
                    new NotBlank(),
                    new Regex(array(
                        'message' => 'La reférence doit contenir au moin 1 caractère valide (A-Z maj ou min)',
                        'pattern' => "/^[a-zA-Z]+$/"
                    ))
                )
            ))
            ->add('Label', TextType::class, array(
                'constraints' => array(
                    new NotBlank(),
                    new Regex(array(
                        'message' => 'le label doit contenir au moin 1 caractère valide (A-Z maj ou min)',
                        'pattern' => "/^[a-zA-Z]+$/"
                    ))
                )
            ))
//            ->add('Type', NumberType::class)
            ->add('Type', 'choice', array(
                'choices' => array(0 => 'Produit', 1 => 'Service'),
                'expanded' => true,
                'multiple' => false
            ))
            ->add('Description', TextareaType::class, array(
                'required' => false,
            ))
            ->add('Vente', CheckboxType::class)
            ->add('Achat', CheckboxType::class)
            ->add('Prix_TTC', NumberType::class, array(

            ))
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
                // type defaut = 0 = Produit
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

    /**
     * @Route("/api/categories", name = "dolib_categories")
     */

    public function getListAction()
    {
        // recup des produits et services
        $buzz = $this->container->get('buzz');

        $browser = $buzz->getBrowser('dolibarr');
        $response = $browser->get('/product/list/?api_key=712f3b895ada9274714a881c2859b617');

        $contentList = json_decode($response->getContent());
        dump($response);die;
//        return $this->render('AppBundle::services.html.twig');
    }
}