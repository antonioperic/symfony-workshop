<?php

namespace WorkshopBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/workshop", name="workshop")
     */
    public function indexAction(Request $request)
    {
        return new Response('Hello Workshop Crew!');
    }
}
