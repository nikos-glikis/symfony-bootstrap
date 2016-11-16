<?php

namespace CyCoders\Bundle\BootstrapStarterBundle\Controller\FrontEnd;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

use CyCoders\Bundle\BootstrapStarterBundle\Entity\Task;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FrontEndController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        die("Hello world.");
    }
}
