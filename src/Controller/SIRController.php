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

        $resultexp = new EtatExp();
        if (!$resume) {
            $etatinitial = new EtatExp;
            $i0=random_0_1();
            $NN=100;
            $resume = new Resume();
            $resume->setR0(rand(3,15))
                    ->setpi(random_0_1())
                    ->setMu(1/rand(5,25))
                    ->setI0($i0);
            $manager->persist($resume);
            $manager->flush();
            $etatinitial-> setU1($i0*random_0_1())
                -> setU2($i0*random_0_1())
                -> setU3($i0*random_0_1())
                -> setU4($i0*random_0_1())
                -> setS1($NN-$etatinitial->getU1())
                -> setS2($NN-$etatinitial->getU1())
                -> setS3($NN-$etatinitial->getU1())
                -> setS4($NN-$etatinitial->getU1())
                -> setP1(0)
                -> setP2(0)
                -> setP3(0)
                -> setP4(0)
                -> setRu1(0)
                -> setRu2(0)
                -> setRu3(0)
                -> setRu4(0)
                -> setRp1(0)
                -> setRp2(0)
                -> setRp3(0)
                -> setRp4(0)
                ->setT(0)
                ->setTest11(0)
                ->setTest12(0)
                ->setTest21(0)
                ->setTest22(0)
                ->setExperience($resume);
            $manager->persist($etatinitial);
            $manager->flush();
        }
        
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

            $command = escapeshellcmd('/python_script/application_env.py');
            $output = shell_exec($command);

            $manager->persist($resultexp);
            $manager->flush();
            return $this->redirectToRoute('exp_form',[]);
        }                        
        return $this->render('sir/exp_python.html.twig',[
            'formExp' => $form->createView(),
            'data' => $resultexp // aucun sens il faudrait que ce soit les données de l'état actuelle de l'épidémie 
        ]
    );
    }   
}