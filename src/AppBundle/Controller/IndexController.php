<?php
/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 17.09.2017
 * Time: 09:55
 */

namespace AppBundle\Controller;


use AppBundle\Form\SetupType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class IndexController extends Controller
{
    /**
     *  @Route("/",name="index") 
     */    
    public function indexAction(Request $request)
    {
        $form = $this->createForm(SetupType::class,[],[]);

        $form->handleRequest($request);

        $result = null;

        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $dates = $this->get("dates");

            $dates->init($data['year'],$data['day'],$data['format'],$data['mode']);

            $dates->getDaysFromYear();

            $result = $dates->getResults();
        }

        return $this->render("@App/index.html.twig",[
            "form" => $form->createView(),
            "result" => $result,
        ]);
    }

}