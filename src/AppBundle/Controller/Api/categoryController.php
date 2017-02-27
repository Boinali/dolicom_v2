<?php
/**
 * Created by PhpStorm.
 * User: Naister
 * Date: 27/02/2017
 * Time: 15:38
 */

namespace AppBundle\Controller\Api;


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