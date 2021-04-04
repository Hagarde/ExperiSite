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

function random_0_1() 
{
    return (float)rand() / (float)getrandmax();
}

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
     * @Route("/exp/exp_form/{$id}", name="exp_form")
     * @Route("/exp/exp_form", name="exp_form")
     */

    public function exp_form(Resume $resume=null ,Request $request,EntityManagerInterface $manager) 
    {
        if (!$resume) {
            $resume = new Resume();
            $resume->setR0(rand(3,15))
                    ->setpi(random_0_1())
                    ->setMu(1/rand(5,25))
                    ->setI0(random_0_1());
            $manager->persist($resume);
            $manager->flush();
            
        }



        $resultexp = new EtatExp();
        $form = $this->createFormBuilder($resultexp)
                    
                    -> add('Test11', RangeType::class, [
                        'attr' => [
                            'autocomplete' => 'on',
                            'min' => 0,
                            'max' => 100]
                        ])
                    -> add('Test12', RangeType::class, [
                        'attr' => [
                            'autocomplete' => 'on',
                            'min' => 0,
                            'max' => 100]
                        ])
                    -> add('Test21', RangeType::class, [
                        'attr' => [
                            'autocomplete' => 'on',
                            'min' => 0,
                            'max' => 100]
                            ])
                    ->add('save', SubmitType::class,[
                        'label'=>'Enregistrer ma décision'
                    ])
                        
                        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            $repartition1 = $resultexp->getTest11();
            $repartition2 = $resultexp->getTest12();
            $repartition3 = $resultexp->getTest21();
            $resultexp->setTest11((100-$repartition1)*(100-$repartition2)/10000)
                    ->setTest12((100-$repartition1)*($repartition2)/10000)
                    ->setTest21(($repartition1)*(100-$repartition3)/10000)
                    ->setTest22(($repartition1)*($repartition3)/10000)
                    ->setExperience($resume);
                    

            $manager->persist($resultexp);
            $manager->flush();
            return $this->redirectToRoute('exp_form',[]);
        }                        
        return $this->render('sir/exp_python.html.twig',[
            'formExp' => $form->createView(),
            'varable du resume ' => $resume // aucun sens il faudrait que ce soit les données de l'état actuelle de l'épidémie 
        ]
    );
    }   
}