<?php
/**
 * Created by PhpStorm.
 * User: Naister
 * Date: 23/02/2017
 * Time: 11:13
 */

namespace AppBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Buzz\Browser;

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
               // recuperation des données Post
               $data = $form->getData();var_dump($data);die();
//               $libelle = $data->get('Libelle');
               $socid = $data->get('Client_Id');

               $invoiceContent["socid"] = $socid;
               $invoiceContent = json_encode($invoiceContent);
//               $invoiceContent["libelle"] = $libelle;

               // envoie de la requette -> creation facture
               $buzz = $this->container->get('buzz');
               $browser = $buzz->getBrowser('dolibarr');
               $browser->setContent($invoiceContent);
               $response = $browser->get('/invoice/?api_key=712f3b895ada9274714a881c2859b617');

               $isArive = $response->getStatusCode();

               return $this->redirectToRoute('Succes');
          }

          return $this->render('invoices.html.twig',
              array(
//                       'Libelle' => $libelle,
                  'Client_Id' => $socid,
                  'form' => $form->createView(),)
          );
     }
    // création invoices

}