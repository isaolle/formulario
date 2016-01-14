<?php

namespace AppBundle\Controller ;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route ;
use Symfony\Bundle\FrameworkBundle\Controller\Controller ;
use Symfony\Component\HttpFoundation\Request ;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Departamento;

class DefaultController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction ( Request $request ) {
        // replace this example code with whatever you need
        return $this->render ( 'default/index.html.twig' , array(
              'base_dir' => realpath ( $this->container->getParameter ( 'kernel.root_dir' ) . '/..' ) ,
        ) ) ;
    }

    /**
     * @Route ("/numero/{idNumero}", name="rutaNumero")
     * 
     */
    public function numeroAction ( $idNumero = 0 ) {

        $correoContacto = $this->container->getParameter ( 'correoContacto' ) ;
        return $this->render ( 'AppBundle:Default:principal.html.twig' , array( 'numero' => $idNumero , 'correo_contacto' => $correoContacto ) ) ;
        //     return new \Symfony\Component\HttpFoundation\Response('Numero provisto: '.$idNumero, $status=200);
    }

    /**
     * @Route ("/departamentos", name="rutaDepartamentos")
     * 
     */
    public function departamentosAction ( Request $request ) {
        // just setup a fresh $task object (remove the dummy data)
                $correoContacto = $this->container->getParameter ( 'correoContacto' ) ;

        $task = new Departamento() ;

        $form = $this->createFormBuilder ( $task )
            ->add ( 'nombre' , TextType::class )
            ->add ( 'correo' , TextType::class )
            ->add ( 'descripcion' , TextType::class )
            ->add ( 'save' , SubmitType::class , array( 'label' => 'Crear Departamento' ) )
            ->getForm () ;

        $form->handleRequest ( $request ) ;

        if ( $form->isSubmitted () && $form->isValid () ) {
            // ... perform some action, such as saving the task to the database

                return $this->render ( 'AppBundle:Default:principal.html.twig' , array( 'numero' => 22 , 'correo_contacto' => $correoContacto ) ) ;

            //return $this->redirectToRoute ( 'task_success' ) ;
        }

        return $this->render ( 'AppBundle:Default:formDepartamento.html.twig' , array(
              'form' => $form->createView () 
          , 'correo_contacto' => $correoContacto
        ) ) ;
    }

}
