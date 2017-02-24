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

class invoiceController extends Controller
{
    /**
     * @Route("/api/invoices", name = "dolib_invoices")
     */
     public function createInvoice(Request $request)
     {
         $buzz = $this->container->get('buzz');
//        var_dump('here');die();
         $browser = $buzz->getBrowser('dolibarr');
         $response = $browser->get('/invoice/?api_key=712f3b895ada9274714a881c2859b617');
         var_dump($response);die();
         return $this->render('invoices.html.twig');
     }
    // création invoices

}