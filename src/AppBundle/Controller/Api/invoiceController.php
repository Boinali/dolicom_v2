<?php
/**
 * Created by PhpStorm.
 * User: Naister
 * Date: 23/02/2017
 * Time: 11:13
 */

namespace AppBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Response;


use Buzz\Message;
use Buzz\Message\Request;
use Buzz\Message\Response;
use Buzz\Client\ClientInterface;
use Buzz\Client\FileGetContents;
use Buzz\Listener\ListenerChain;
use Buzz\Listener\ListenerInterface;
use Buzz\Listener\CallbackListener;
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

class invoiceController extends Controller
{
    /**
     * @Route("/api/invoices", name = "dolib_invoices")
     */
     public function createInvoice(Request $request)
     {

          $socid = null;
          $form = $this->createFormBuilder()
//              ->add('Libelle', TextType::class)
              ->add('Client_Id', TextType::class)
              ->add('save', SubmitType::class, array('label' => 'créer'))
              ->getForm();

          $form->handleRequest($request);

          if ($form->isSubmitted() && $form->isValid())
          {
              $headers = ['Content-Type', 'application/json'];
               // recuperation des données Post
               $data = $form->getData();
               $socid = $data['Client_Id'];
                $api_url = "http://dolibarr.localdomain/api/index.php/invoice/?api_key=712f3b895ada9274714a881c2859b617";
               $invoiceContent["socid"] = $socid;
               $invoiceContent = json_encode($invoiceContent);

               // envoie de la requette -> creation facture

               $buzz = $this->container->get('buzz');
               $browser = $buzz->getBrowser('dolibarr');
               $response = $browser->preSend('/invoice/?api_key=712f3b895ada9274714a881c2859b617');

              var_dump($response);die();
              return $this->render('invoices.html.twig',
                  array(
//                       'Libelle' => $libelle,
                      'Client_Id' => $socid,
                      'form' => $form->createView(),)
              );
//               return $this->redirectToRoute('dolib_invoices');
          }

          return $this->render('invoices.html.twig',
              array(
                  'Client_Id' => $socid,
                  'form' => $form->createView(),)
          );
     }
    // création invoices

}