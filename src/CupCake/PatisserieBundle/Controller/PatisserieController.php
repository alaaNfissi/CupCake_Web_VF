<?php
/**
 * Created by PhpStorm.
 * User: Alaa
 * Date: 23/03/2018
 * Time: 21:19
 */

namespace CupCake\PatisserieBundle\Controller;


use CupCake\PatisserieBundle\Entity\Patisserie;
use CupCake\PatisserieBundle\Form\AjoutPatisserieFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PatisserieController extends Controller
{
    public function ajoutPatisserieAction(Request $request)
    {
        $patisserie=new Patisserie();
        $patisserie->setIdUtilisateur($this->getUser());
        $form=$this->createForm(AjoutPatisserieFormType::class,$patisserie);
        $form->handleRequest($request);
        if($form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($patisserie);
            $em->flush();
            return $this->redirectToRoute('user_dashboard');
        }
        return $this->render('PatisserieBundle:Patisserie:ajout.html.twig',array('form' => $form->createView(),'patisserie'=>null));
    }

    public function modifierPatisserieAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $patisserie=$em->getRepository('PatisserieBundle:Patisserie')->findOneBy(array('utilisateur' => $this->getUser()));
        $form=$this->createForm(AjoutPatisserieFormType::class,$patisserie);
        $form->handleRequest($request);
        if($form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($patisserie);
            $em->flush();
            return $this->redirectToRoute('user_dashboard');
        }
        return $this->render('PatisserieBundle:Patisserie:ajout.html.twig',array('form'=>$form->createView(),'patisserie' => $patisserie));
    }

    public function spacePatisserieAction()
    {
        $em=$this->getDoctrine()->getManager();
        $patisserie=$em->getRepository('PatisserieBundle:Patisserie')->findOneBy(array('utilisateur' => $this->getUser()));
        return $this->render('@Patisserie/Patisserie/patisserieSpace.html.twig',array('patisserie'=>$patisserie));
    }

    public function findByLibelleAction($libelle_patisserie)
    {
        $em=$this->getDoctrine()->getManager();
        $patisserie=$em->getRepository('PatisserieBundle:Patisserie')->findOneBy(array('libelle_patisserie' =>$libelle_patisserie));
        return $this->render('@Patisserie/Patisserie/patisserieSpace.html.twig',array('patisserie'=>$patisserie));
    }

}