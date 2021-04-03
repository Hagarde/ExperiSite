<?php

namespace App\Controller;

use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\EtatExp;
use App\Entity\Resume;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class SIRController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */

    public function index(): Response
    {
        return $this->render('sir/index.html.twig', [
            'controller_name' => 'SIRController',
        ]);
    }

    /**
     * @Route("/exp", name="exp_presentation")
     */

    public function exp() 
    {
        return $this->render('sir/exp.html.twig');
    }
    
    /**
     * @Route("/resultat", name="resultat")
     */

    public function result() 
    {
        $repo = $this->getDoctrine()->getRepository(Resume::class) ;
        $resume = $repo->FindAll() ; 
        return $this->render('sir/result.html.twig',[
            'resume'=>$resume
        ]);
    }

    
    /**
     * @Route("/about", name="about_us")
     */

    public function about() 
    {
        return $this->render('sir/about.html.twig');
    }

    /**
     * @Route("/result/{id}", name="detail_exp")
     */

    public function detailexpi($id, EtatExp $infoexp,Resume $resume ) 
    {
        $repo = $this->getDoctrine()->getRepository(EtatExp::class);
        $alldata = $repo->FindBy(array('experience'=>$id),array('T'=>'asc'));
        return $this->render('sir/detailexp.html.twig',[
            'data_exp'=>$alldata,
            'resume'=>$resume
        ]);
    }

    /**
     * @Route("/exp/exp_form", name="exp_form")
     */

    public function exp_form(Request $request,EntityManagerInterface $manager) 
    {
        $resultexp = new EtatExp();
        $form = $this->createFormBuilder($resultexp)
                    
                    -> add('Repartition1', RangeType::class, [
                        'attr' => [
                            'autocomplete' => 'on',
                            'min' => 0,
                            'max' => 100]
                        ])
                    -> add('Repartition2', RangeType::class, [
                        'attr' => [
                            'autocomplete' => 'on',
                            'min' => 0,
                            'max' => 100]
                        ])
                    -> add('Repartition3', RangeType::class, [
                        'attr' => [
                            'autocomplete' => 'on',
                            'min' => 0,
                            'max' => 100]
                        ])
                        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            $resultexp->setRepartition1()
                    ->setRepartition2()
                    ->setRepartition3()
                    ->setRepartition4();

            $manager->persist($resultexp);
            $manager->flush();
            return $this->redirectToRoute('exp_form',[]);
        }                        
        return $this->render('sir/exp_python.html.twig',[
            'formExp' => $form->createView()
        ]
    );
    }   
}