<?php

namespace AppBundle\Controller;

use AppBundle\Exception\CalculatorException;
use AppBundle\Util\Calculator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CalculatorController extends Controller
{
    /**
     * @Route("/", name="calculator")
     * @Method({"GET", "POST"})
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request) {
        $result = 0;
        if ( ! is_null($calculation = $request->request->get('doCalculation'))) {
            try {
                $result = Calculator::calculate($calculation);
            } catch(CalculatorException $e) {
                $result = "ERROR!";
            }
        }
        
        return $this->render('calculator.html.twig', ['result' => $result]);
    }
}