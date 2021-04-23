<?php
namespace App\Controller;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\EtatExp;
use App\Entity\Resume;
use App\Entity\Epidemie;
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
            'resume'=>$resume,
            'nmbr_exp' => count($resume)
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
     * @Route("/result/{num_exp}", name="detail_exp")
     */

    public function detailexpi(int $num_exp) 
    {
        $repo1 =$this->getDoctrine()->getRepository(Resume::class);
        $resume = $repo1->findOneById($num_exp);
        $repo2 = $this->getDoctrine()->getRepository(EtatExp::class);
        $alldata = $repo2->FindBy(['experience'=>$resume,'T'=>'ASC']);
        $intermediaire = $repo2->FindBy(['experience'=>$resume,'T'=>'DESC'])[0];
        $T_max = $intermediaire->getT();
        return $this->render('sir/detailexp.html.twig',[
            'data_exp'=>$alldata,
            'resume'=>$resume,
            'T_max'=> $T_max
        ]);
    }

    /**
     * @Route("/exp/exp_form/{num_exp}", name="exp_form_suite")
     */

    public function exp_form(int $num_exp, int $temps = null, Request $request, EntityManagerInterface $manager) 
    {
        
        $resultexp = new EtatExp();
        $NN = 10000;
        $I0 = 0.05;
        $i0 = $I0 * $NN;
        if ($num_exp == 0) {
            // On s'occupe du cas de l'initialisation de l'exp avec choix de l'expé et tout 
            $repo = $this->getDoctrine()->getRepository(Epidemie::class);
            $IDrandom = rand(1,199);
            $epi = $repo->find($IDrandom);
            $etatinitial = new EtatExp;
            
            $resume = new Resume();
            $resume->setR0($epi->getR())
                    ->setpi($epi->getPi())
                    ->setMu($epi->getMu())
                    ->setI0($I0)
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
                // On ne set pas les test pour l'état initial pq on va les mettre seulement lorsque la première décision sera reçue 
                ->setExperience($resume);
            $manager->persist($etatinitial);
            $manager->flush();
            $etatavant = $etatinitial;
            $num_exp = $resume->getId();
        }
        else {
            $repo = $this->getDoctrine()->getRepository(Resume::class);
            $resume = $repo->findOneBy(['id'=>$num_exp]);
        // prbl avec etat avant c'est pas le bon je rechoppe le 1er etat initial 
            $repo2= $this->getDoctrine()->getRepository(EtatExp::class);
            $etatlie = $repo2->findBy(array('experience'=> $resume));
            $avantdernier = count($etatlie)-1;
            $etatavant= $etatlie[$avantdernier];
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
                            'min' => 0,
                            'max' => 100]
                            ])
                        
                        ->getForm();

        $form->handleRequest($request);
        $T = $etatavant->getT() ;
        if($form->isSubmitted() && $form->isValid() ){

            $repartition1 = $resultexp->getTest11();
            $repartition2 = $resultexp->getTest12();
            $repartition3 = $resultexp->getTest21();
            $etatavant->setTest11((100-$repartition1)*(100-$repartition2)/10000)
                    ->setTest12((100-$repartition1)*($repartition2)/10000)
                    ->setTest21(($repartition1)*(100-$repartition3)/10000)
                    ->setTest22(($repartition1)*($repartition3)/10000);

            // Truc chiant pour utiliser le python 
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
            

            $stringcommand = 'python3 python_script/application_env.py'.' '. $s1 .' '. $s2 .' '. $s3 .' '. $s4 .' '. $u1 .' '. $u2 .' '. $u3 .' '. $u4 .' '. $p1 .' ' . $p2 .' '.$p3. ' ' .$p4.' ' .$ru1. ' '.$ru2. ' '. $ru3 . ' ' . $ru4 . ' ' .$rp1. ' ' . $rp2 . ' '. $rp3 . ' '. $rp4 . ' ' . $R0 . ' ' . $pi . ' '. $mu .' ' . $test11 . ' ' . $test12 . ' '. $test21 . ' ' . $test22 .' '. $influence12 . ' ' . $influence13 . ' '. $influence14 . ' '. $influence23 . ' ' . $influence24 . ' ' . $influence34 ;
            $command = escapeshellcmd($stringcommand);
            $output = shell_exec($command);
            $tableau = explode(' ' , $output);

        // On update et on crée la nouvelle valeur ! 

            $etatcalcule = new EtatExp() ;
            $new_T = ($etatavant->getT())+1;
            $etatcalcule-> setS1(floatval($tableau[0]))
                        -> setS2(floatval($tableau[1]))
                        -> setS3(floatval($tableau[2]))
                        -> setS4(floatval($tableau[3]))
                        -> setU1(floatval($tableau[4]))
                        -> setU2(floatval($tableau[5]))
                        -> setU3(floatval($tableau[6]))
                        -> setU4(floatval($tableau[7]))
                        -> setP1(floatval($tableau[8]))
                        -> setP2(floatval($tableau[9]))
                        -> setP3(floatval($tableau[10]))
                        -> setP4(floatval($tableau[11]))
                        -> setRu1(floatval($tableau[12]))
                        -> setRu2(floatval($tableau[13]))
                        -> setRu3(floatval($tableau[14]))
                        -> setRu4(floatval($tableau[15]))
                        -> setRp1(floatval($tableau[16]))
                        -> setRp2(floatval($tableau[17]))
                        -> setRp3(floatval($tableau[18]))
                        -> setRp4(floatval($tableau[19]))
                        -> setT($new_T)
                        -> setExperience($etatavant->getExperience());
            $manager->persist($etatcalcule);
            $manager->flush();
            return $this->redirectToRoute('exp_form_suite', [
                'num_exp' => $num_exp ,
                'temps' => $etatcalcule
            ]);
        }                        
        return $this->render('sir/exp_python.html.twig',[
            'formExp' => $form->createView(),
            'resume' => $resume ,
            'temps' => $T ,
            'etat_avant' => $etatavant
        ]
    );
    }   
}