<?php

namespace CyCoders\Bundle\BootstrapStarterBundle\Controller\Admin;

use CyCoders\Bundle\BootstrapStarterBundle\Form\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

use CyCoders\Bundle\BootstrapStarterBundle\Entity\Task;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AdminController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        // create a task and give it some dummy data for this example
        $task = new Task();
        $task->setTask('Do something');
        $task->setDueDate(new \DateTime('tomorrow'));

        $form =$this->createForm(TaskType::class, $task);

        return $this->render('@CyCodersBootstrapStarter/pages/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /*
     Post Sample

    public function addClientAction(Request $request)
    {
        // create a client and give it some dummy data for this example
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $client = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();

            return $this->redirectToRoute('task_success');
        }

        return $this->render('@Object0rHosty/default/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }*/
}
