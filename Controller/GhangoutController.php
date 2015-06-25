<?php

namespace CPASimUSante\GhangoutBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as EXT;

class GhangoutController extends Controller
{
    /**
     * @EXT\Route("/index", name="cpasimusante_ghangout_index")
     * @EXT\Template
     *
     * @return Response
     */
    public function indexAction()
    {
        throw new \Exception('hello');
    }
}
