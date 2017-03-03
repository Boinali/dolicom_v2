<?php
/**
 * Created by PhpStorm.
 * User: Naister
 * Date: 23/02/2017
 * Time: 11:13
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
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

use Symfony\Component\OptionsResolver\OptionsResolver;


class invoiceController extends Controller
{
    /**
     * @Route("/api/invoices", name = "dolib_invoices")
     */
     public function createInvoiceAction(Request $request)
     {
         $formCreateInvoice = $this->get('form.factory')->createNamedBuilder('formCreateInvoice')
             ->add('id_client', TextType::class)
             ->add('total_ttc', NumberType::class)
             ->add('facture_name', TextType::class)
             ->add('brouillon', 'choice', array(
                 'choices' => array(1 => 'Oui', 0 => 'Non'),
                 'expanded' => true,
                 'multiple' => false
             ))
             ->getForm();


         if('POST' === $request->getMethod())
         {
             if($request->request->has('formCreateInvoice')){
                 $formCreateInvoice->handleRequest($request);

                 // 1 - creation facture/client
                 $content["socid"] = $formCreateInvoice->get('id_client')->getData();
                 $buzz = $this->container->get('buzz');
                 $browser = $buzz->getBrowser('dolibarr');
                 $response = $browser->submit('/invoice/?api_key=712f3b895ada9274714a881c2859b617',
                     $content, RequestInterface::METHOD_POST);

                 if(200 === $response->getStatusCode())
                 {
                     if(0 < $response->getContent())
                     {
                         // recuperation de l'id de la nouvelle facture creer
                         $id_fact = $response->getContent();
                         // 2 - MAJ de la brouillon = 0 => facture impaye
                         $content["total_ttc"] = $formCreateInvoice->get('total_ttc')->getData();
                         $content["ref"] = $formCreateInvoice->get('facture_name')->getData();
                         $content["brouillon"] = $formCreateInvoice->get('brouillon')->getData();
                         var_dump($content["brouillon"]);die();
                         $response = $browser->submit('/invoice/{n0}/?api_key=712f3b895ada9274714a881c2859b617&id='.$id_fact.'',
                             $content, RequestInterface::METHOD_PUT);
                     }
                 }


             }
         }

         $contentInvoice = $this->getInvoiceListAction();
         $contentClient = $this->getListThirdPartyAction();

         return $this->render('AppBundle::invoices.html.twig',
             array(
                 'formCreateInvoice' => $formCreateInvoice->createView(),
                 'contentInvoice' => $contentInvoice,
                 'contentClient' => $contentClient
             )
         );

     }

    public function getInvoiceListAction()
    {
        $buzz = $this->container->get('buzz');

        $browser = $buzz->getBrowser('dolibarr');
        $response = $browser->get('/invoice/list/?api_key=712f3b895ada9274714a881c2859b617');

        $contentList = json_decode($response->getContent());

        return $contentList;
    }

    public function getListThirdPartyAction()
    {
        $buzz = $this->container->get('buzz');

        $browser = $buzz->getBrowser('dolibarr');
        $response = $browser->get('/thirdparty/list/?api_key=712f3b895ada9274714a881c2859b617');

        $contentList = json_decode($response->getContent());

        return $contentList;
    }

}