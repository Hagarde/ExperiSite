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
     * @Route("/exp/exp_form/{$id}/{$t}", name="exp_form")
     * @Route("/exp/exp_form", name="exp_form")
     */

    public function exp_form(Resume $resume=null ,Request $request,EntityManagerInterface $manager) 
    {
        // j'aimerais accéder à l'état exp du t précèdent 
        
        $resultexp = new EtatExp();
        if (!$resume) {
            $etatinitial = new EtatExp;
            $i0 = random_0_1()/10;
            $NN = 100;
            $resume = new Resume();
            $resume->setR0(rand(3,15))
                    ->setpi(random_0_1())
                    ->setMu(1/rand(5,25))
                    ->setI0($i0)
                    ->setInfluence12(random_0_1())
                    ->setInfluence13(random_0_1())
                    ->setInfluence14(random_0_1())
                    ->setInfluence23(random_0_1())
                    ->setInfluence24(random_0_1())
                    ->setInfluence34(random_0_1());

            $manager->persist($resume);
            $manager->flush();

            $etatinitial-> setU1($i0)
                -> setU2($i0)
                -> setU3($i0)
                -> setU4($i0)
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
            $etatavant = $etatinitial;
        }
        else {
            $repo = $this->getDoctrine()->getRepository(EtatExp::class);

            $etatavant= 1;
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
                        
                        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){

            $repartition1 = $etatavant->getTest11();
            $repartition2 = $etatavant->getTest12();
            $repartition3 = $etatavant->getTest21();
            $etatavant->setTest11((100-$repartition1)*(100-$repartition2)/10000)
                    ->setTest12((100-$repartition1)*($repartition2)/10000)
                    ->setTest21(($repartition1)*(100-$repartition3)/10000)
                    ->setTest22(($repartition1)*($repartition3)/10000)
                    ->setExperience($resume);
            
            $s1 = strval($etatavant->getS1());
            $s2 = strval($etatavant->getS2());
            $s3 = strval($etatavant->getS3());
            $s4 = strval($etatavant->getS4());
            $u1 = strval($etatavant->getU1());
            $u2 = strval($etatavant->getU2());
            $u3 = strval($etatavant->getU3());
            $u4 = strval($etatavant->getU4());
            $p1 = strval($etatavant->getP1());
            $p2 = strval($etatavant->getP2());
            $p3 = strval($etatavant->getP3());
            $p4 = strval($etatavant->getP4());
            $ru1 =strval($etatavant->getRu1());
            $ru2 =strval($etatavant->getRu2());
            $ru3 =strval($etatavant->getRu3());
            $ru4 =strval($etatavant->getRu4());
            $rp1 =strval($etatavant->getRp1());
            $rp2 =strval($etatavant->getRp2());
            $rp3 =strval($etatavant->getRp3());
            $rp4 =strval($etatavant->getRp4());
            $R0 =strval($resume->getR0());
            $pi =strval($resume->getPi());
            $mu =strval($resume->getMu());
            $test11 =strval($etatavant->getTest11());
            $test12 =strval($etatavant->getTest12());
            $test21 =strval($etatavant->getTest21());
            $test22 =strval($etatavant->getTest22());
            $influence12 =strval($etatavant->getTest11());
            $influence13 =strval($etatavant->getTest12());
            $influence14 =strval($etatavant->getTest21());
            $influence23 =strval($etatavant->getTest22());
            $influence24 =strval($etatavant->getTest21());
            $influence34 =strval($etatavant->getTest22());
            
            $stringcommand = 'python3  python_script/application_env.py'.' '. $s1 .' '. $s2 .' '. $s3 .' '. $s4 .' '. $u1 .' '. $u2 .' '. $u3 .' '. $u4 .' '. $p1 .' ' . $p2 .' '.$p3. ' ' .$p4.' ' .$ru1. ' '.$ru2. ' '. $ru3 . ' ' . $ru4 . ' ' .$rp1. ' ' . $rp2 . ' '. $rp3 . ' '. $rp4 . ' ' . $R0 . ' ' . $pi . ' '. $mu .' ' . $test11 . ' ' . $test12 . ' '. $test21 . ' ' . $test22 .' '. $influence12 . ' ' . $influence13 . ' '. $influence14 . ' '. $influence23 . ' ' . $influence24 . ' ' . $influence34 ;
            $command = escapeshellcmd($stringcommand);
            $output = shell_exec($command);
            dump($output);

            $manager->persist($resultexp);
            $manager->flush();
            return $this->redirectToRoute('exp_form',[]);
        }                        
        return $this->render('sir/exp_python.html.twig',[
            'formExp' => $form->createView(),
            'num_exp' => $resume->getId() ,
            'temps' => $resultexp->getT()
        ]
    );
    }   
}