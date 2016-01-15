<?php

namespace AppBundle\Controller ;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route ;
use Symfony\Bundle\FrameworkBundle\Controller\Controller ;
use Symfony\Component\HttpFoundation\Request ;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Departamento;
use Symfony\Component\HttpFoundation\Response;

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
        
		$correoContacto = $this->container->getParameter ( 'correoContacto' ) ;

        $departamentos  = $this->getDoctrine()->getRepository('AppBundle:Departamento')
				->findAll();
				

			//return new Response('<pre>'.print_r($departamentos,true).'</pre>');
        return $this->render ( 'AppBundle:Default:listaDepartamentos.html.twig' , array(
              'departamentos' => $departamentos
          , 'correo_contacto' => $correoContacto
        ) ) ;

	}
	
	
	 /**
     * @Route ("/departamentos/crear", name="rutaDepartamentosCrear")
     * 
     */
    public function departamentosCrearAction ( Request $request ) {
        
		$correoContacto = $this->container->getParameter ( 'correoContacto' ) ;

        $departamento = new Departamento() ;

        $form = $this->createFormBuilder ( $departamento )
            ->add ( 'nombre' , TextType::class )
            ->add ( 'correo' , TextType::class )
            ->add ( 'descripcion' , TextType::class )
            ->add ( 'save' , SubmitType::class , array( 'label' => 'Crear departamento' ) )
            ->getForm () ;

        $form->handleRequest ( $request ) ;

        if ( $form->isSubmitted () && $form->isValid () ) {

			$em = $this->getDoctrine()->getManager();
			$em->persist($departamento);
			$em->flush();
			
			return new Response('<h1>Creación correcta</h1>
								<br>
								Creado con el id: '.$departamento->getiddepartamento());
        }

        return $this->render ( 'AppBundle:Default:formDepartamento.html.twig' , array(
              'form' => $form->createView () 
          , 'correo_contacto' => $correoContacto
        ) ) ;
    }
	
	
	/**
     * @Route ("/departamentos/editar/{idDepartamento}", name="rutaDepartamentosEditar")
     * 
     */
    public function departamentosEditarAction ( Request $request , $idDepartamento ) {
        
		$correoContacto = $this->container->getParameter ( 'correoContacto' ) ;
        
		$departamento  = $this->getDoctrine()->getRepository('AppBundle:Departamento')
				->find($idDepartamento);
		
        $form = $this->createFormBuilder ( $departamento )
            ->add ( 'nombre' , TextType::class )
            ->add ( 'correo' , TextType::class )
            ->add ( 'descripcion' , TextType::class )
            ->add ( 'save' , SubmitType::class , array( 'label' => 'Modificar departamento' ) )
            ->getForm () ;

        $form->handleRequest ( $request ) ;

        if ( $form->isSubmitted () && $form->isValid () ) {

			$em = $this->getDoctrine()->getManager();
			$em->persist($departamento);
			$em->flush();
			
			return new Response('<h1>Edición correcta</h1>
								<br>
								Modificado el departamento con id: '.$departamento->getiddepartamento());
        }

        return $this->render ( 'AppBundle:Default:formDepartamento.html.twig' , array(
              'form' => $form->createView () 
          , 'correo_contacto' => $correoContacto
        ) ) ;
    }

}
