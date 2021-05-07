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
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

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

    public function detailexpi(int $num_exp,ChartBuilderInterface $chartBuilder) 
    {
        // Ici je chope les données nécessaires pour les graphes et tout ... 

        $repo1 =$this->getDoctrine()->getRepository(Resume::class);
        $resume = $repo1->findOneById($num_exp);
        $repo2 = $this->getDoctrine()->getRepository(EtatExp::class);
        $alldata = $repo2->FindBy(['experience'=>$resume]);
        // Récupération des données pour graph 
        $labels = [];
        $datasetP1 =[];
        $datasetP2 =[];
        $datasetP3 =[];
        $datasetP4 =[];

        foreach($alldata as $data){
            $labels[] = $data->getT();
            $datasetP1[] = $data->getP1();
            $datasetP2[] = $data->getP2();
            $datasetP3[] = $data->getP3();
            $datasetP4[] = $data->getP4();
            
            $datasetU1[] = $data->getU1();
            $datasetU2[] = $data->getU2();
            $datasetU3[] = $data->getU3();
            $datasetU4[] = $data->getU4();

            $datasetS1[] = $data->getS1();
            $datasetS2[] = $data->getS2();
            $datasetS3[] = $data->getS3();
            $datasetS4[] = $data->getS4();

            $datasetRU1[] = $data->getRu1();
            $datasetRU2[] = $data->getRu2();
            $datasetRU3[] = $data->getRu3();
            $datasetRU4[] = $data->getRu4();

            $datasetRP1[] = $data->getRp1();
            $datasetRP2[] = $data->getRp2();
            $datasetRP3[] = $data->getRp3();
            $datasetRP4[] = $data->getRp4();
            
        }
        $T_max = strval(count($alldata)-1);
        // Ici je voudrais générer les graphiques que nous allons montrer au monde entier 
        $chart1 = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chart1->setData([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Suceptible',
                    'backgroundColor' => 'rgb(136, 206, 251)',
                    'borderColor' => 'rgb(136, 206, 251)',
                    'data' => $datasetS1,
                ],
                [
                    'label' => 'Undetected',
                    'backgroundColor' => 'rgb(255, 153, 169)',
                    'borderColor' => 'rgb(255, 153, 169)',
                    'data' => $datasetU1,
                ],
                [
                    'label' => 'Positif',
                    'backgroundColor' => 'rgb(252, 204, 204)',
                    'borderColor' => 'rgb(252, 204, 204)',
                    'data' => $datasetP1,
                ],
                [
                    'label' => 'Recovered Undetected',
                    'backgroundColor' => 'rgb(146, 242, 148)',
                    'borderColor' => 'rgb(146, 242, 148)',
                    'data' => $datasetRU1,
                ],
                [
                    'label' => 'Recovered Positif',
                    'backgroundColor' => 'rgb(100, 233, 135)',
                    'borderColor' => 'rgb(100, 233, 135)',
                    'data' => $datasetRP1,
                ]
                
            ],
        ]);



        $chart2 = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chart2->setData([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Suceptible',
                    'backgroundColor' => 'rgb(136, 206, 251)',
                    'borderColor' => 'rgb(136, 206, 251)',
                    'data' => $datasetS2,
                ],
                [
                    'label' => 'Undetected',
                    'backgroundColor' => 'rgb(255, 153, 169)',
                    'borderColor' => 'rgb(255, 153, 169)',
                    'data' => $datasetU2,
                ],
                [
                    'label' => 'Positif',
                    'backgroundColor' => 'rgb(252, 204, 204)',
                    'borderColor' => 'rgb(252, 204, 204)',
                    'data' => $datasetP2,
                ],
                [
                    'label' => 'Recovered Undetected',
                    'backgroundColor' => 'rgb(146, 242, 148)',
                    'borderColor' => 'rgb(146, 242, 148)',
                    'data' => $datasetRU2,
                ],
                [
                    'label' => 'Recovered Positif',
                    'backgroundColor' => 'rgb(100, 233, 135)',
                    'borderColor' => 'rgb(100, 233, 135)',
                    'data' => $datasetRP2,
                ]
                
            ],
        ]);

        $chart4 = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chart4->setData([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Suceptible',
                    'backgroundColor' => 'rgb(136, 206, 251)',
                    'borderColor' => 'rgb(136, 206, 251)',
                    'data' => $datasetS4,
                ],
                [
                    'label' => 'Undetected',
                    'backgroundColor' => 'rgb(255, 153, 169)',
                    'borderColor' => 'rgb(255, 153, 169)',
                    'data' => $datasetU4,
                ],
                [
                    'label' => 'Positif',
                    'backgroundColor' => 'rgb(252, 204, 204)',
                    'borderColor' => 'rgb(252, 204, 204)',
                    'data' => $datasetP4,
                ],
                [
                    'label' => 'Recovered Undetected',
                    'backgroundColor' => 'rgb(146, 242, 148)',
                    'borderColor' => 'rgb(146, 242, 148)',
                    'data' => $datasetRU4,
                ],
                [
                    'label' => 'Recovered Positif',
                    'backgroundColor' => 'rgb(100, 233, 135)',
                    'borderColor' => 'rgb(100, 233, 135)',
                    'data' => $datasetRP4,
                ]
                
            ],
        ]);

        $chart3 = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chart3->setData([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Suceptible ',
                    'backgroundColor' => 'rgb(136, 206, 251)',
                    'borderColor' => 'rgb(136, 206, 251)',
                    'data' => $datasetS3,
                ],
                [
                    'label' => 'Undetected ',
                    'backgroundColor' => 'rgb(255, 153, 169)',
                    'borderColor' => 'rgb(255, 153, 169)',
                    'data' => $datasetU3,
                ],
                [
                    'label' => 'Positif ',
                    'backgroundColor' => 'rgb(252, 204, 204)',
                    'borderColor' => 'rgb(252, 204, 204)',
                    'data' => $datasetP3,
                ],
                [
                    'label' => 'ERecovered Undetected',
                    'backgroundColor' => 'rgb(146, 242, 148)',
                    'borderColor' => 'rgb(146, 242, 148)',
                    'data' => $datasetRU3,
                ],
                [
                    'label' => 'Recovered Positif',
                    'backgroundColor' => 'rgb(100, 233, 135)',
                    'borderColor' => 'rgb(100, 233, 135)',
                    'data' => $datasetRP3,
                ]
                
            ],
        ]);




        return $this->render('sir/detailexp.html.twig',[
            'data_exp'=>$alldata,
            'resume'=>$resume,
            'T_max'=> $T_max,
            'chart_1' => $chart1,
            'chart_2' => $chart2,
            'chart_3' => $chart3,
            'chart_4' => $chart4
        ]);
    }

    /**
     * @Route("/exp/exp_form/{num_exp}", name="exp_form_suite")
     */

    public function exp_form(int $num_exp, int $temps = null, Request $request, EntityManagerInterface $manager) 
    {
        $resultexp = new EtatExp();
        $NN = 10000;
        if ($num_exp == 0) {
            $repo = $this->getDoctrine()->getRepository(Epidemie::class);
            $IDrandom = rand(1,3);
            $epi = $repo->find($IDrandom);
            $i0 = $epi->getI0()*$NN;
            $etatinitial = new EtatExp;
            // randomization de si on display la valeur de accélration de pintus 
            $acceleration = true ;
            if (rand(0,1) < 0.5) {
                $acceleration = false ;
            }
            $inter = 0;
            if (rand(0,1) < 0.5) {
                $inter = 1;
            }
            $resume = new Resume();
            $resume->setR0($epi->getR())
                    ->setpi($epi->getPi())
                    ->setMu($epi->getMu())
                    ->setI0($epi->getI0()*$NN)
                    ->setInfluence12($inter)
                    ->setInfluence13($inter)
                    ->setInfluence14($inter)
                    ->setInfluence23($inter)
                    ->setInfluence24($inter)
                    ->setInfluence34($inter)
                    ->setAcc($acceleration)
                    ->setEpsilon($epi->getEpsilon());

            $manager->persist($resume);
            $manager->flush();

            $etatinitial-> setU1($i0)
                -> setU2($i0)
                -> setU3($i0)
                -> setU4($i0)
                -> setS1($NN-$i0)
                -> setS2($NN-$i0)
                -> setS3($NN-$i0)
                -> setS4($NN-$i0)
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
                            'orient' => "vertical",
                            'min' => 0,
                            'max' => 100]
                        ])
                    -> add('Test21', RangeType::class, [
                        'attr' => [
                            'min' => 0,
                            'autocomplete' => 'on',
                            'orient' => "vertical",
                            'max' => 100]
                            ])
                        
                        ->getForm();

        $form->handleRequest($request);
        $T = $etatavant->getT() ;
        $epsilon = $resume->getEpsilon();
        $nmbr_test = $epsilon * $NN ;
        # calcul des données à montrer au sujet : 
        $cas_cumule1 = $etatavant->getP1() + $etatavant->getRu1();
        $cas_cumule2 = $etatavant->getP2() + $etatavant->getRu2();
        $cas_cumule3 = $etatavant->getP3() + $etatavant->getRu3();
        $cas_cumule4 = $etatavant->getP4() + $etatavant->getRu4();
        $positivite1 = 'Pas encore disponible';
        $positivite2 = 'Pas encore disponible';
        $positivite3 = 'Pas encore disponible';
        $positivite4 = 'Pas encore disponible';
        $new_P1 = 'Pas encore disponible';
        $new_P2 = 'Pas encore disponible';
        $new_P3 = 'Pas encore disponible';
        $new_P4 = 'Pas encore disponible';
        $test_avant1 = $etatavant->getTest11();
        $test_avant2 = $etatavant->getTest12();
        $test_avant3 = $etatavant->getTest21();
        $test_avant4 = $etatavant->getTest22();
        
        $acc1 = 'Pas encore disponible' ;
        $acc2 = 'Pas encore disponible' ;
        $acc3 = 'Pas encore disponible' ;
        $acc4 = 'Pas encore disponible' ;
    
        if ($T > 1.5) {
            $etatavantavant = $etatlie[$avantdernier - 1] ;
            $new_P1 = ($etatavant->getP1() - $etatavantavant->getP1());
            $new_P2 = ($etatavant->getP2() - $etatavantavant->getP2());
            $new_P3 = ($etatavant->getP3() - $etatavantavant->getP3());
            $new_P4 = ($etatavant->getP4() - $etatavantavant->getP4());

            if (($etatavant->getTest11()>0)and ($etatavant->getTest12()>0) and ($etatavant->getTest21()>0) and ($etatavant->getTest22()>0 )) {
                $positivite1 = (($etatavant->getP1() - $etatavantavant->getP1()) / $etatavant->getTest11() )*100;
                $positivite2 = (($etatavant->getP2() - $etatavantavant->getP2()) / $etatavant->getTest12() )*100;
                $positivite3 = (($etatavant->getP3() - $etatavantavant->getP3()) / $etatavant->getTest21() )*100;
                $positivite4 = (($etatavant->getP4() - $etatavantavant->getP4()) / $etatavant->getTest22() )*100;
                if ($resume->getAcc()){
                    for ($i = 0; $i < count($etatlie) ; $i++) {
                        $test_cumule1  = $etatlie[$i]->getTest11();
                        $test_cumule2  = $etatlie[$i]->getTest12();
                        $test_cumule3  = $etatlie[$i]->getTest21();
                        $test_cumule4  = $etatlie[$i]->getTest22();
                    
                    $acc1 = ($test_cumule1/$cas_cumule1) / $positivite1 ;
                    $acc2 = ($test_cumule2/$cas_cumule2) / $positivite2 ;
                    $acc3 = ($test_cumule3/$cas_cumule3) / $positivite3 ;
                    $acc4 = ($test_cumule4/$cas_cumule4) / $positivite4 ;
                    }
                };
            };
        }

        if($form->isSubmitted() && $form->isValid() ){

            $repartition1 = $resultexp->getTest11();
            $repartition2 = $resultexp->getTest12();
            $repartition3 = $resultexp->getTest21();
            $etatavant->setTest11(((100-$repartition1)*(100-$repartition2)/10000)*$nmbr_test)
                    ->setTest12(((100-$repartition1)*($repartition2)/10000)*$nmbr_test)
                    ->setTest21((($repartition1)*(100-$repartition3)/10000)*$nmbr_test)
                    ->setTest22((($repartition1)*($repartition3)/10000)*$nmbr_test);

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
            $influence12 =strval($resume->getInfluence12());
            $influence13 =strval($resume->getInfluence13());
            $influence14 =strval($resume->getInfluence14());
            $influence23 =strval($resume->getInfluence23());
            $influence24 =strval($resume->getInfluence24());
            $influence34 =strval($resume->getInfluence34());
            

            $stringcommand = 'python3 python_script/application_env.py'.' '. $s1 .' '. $s2 .' '. $s3 .' '. $s4 .' '. $u1 .' '. $u2 .' '. $u3 .' '. $u4 .' '. $p1 .' ' . $p2 .' '.$p3. ' ' .$p4.' ' .$ru1. ' '.$ru2. ' '. $ru3 . ' ' . $ru4 . ' ' .$rp1. ' ' . $rp2 . ' '. $rp3 . ' '. $rp4 . ' ' . $R0 . ' ' . $pi . ' '. $mu .' ' . $test11 . ' ' . $test12 . ' '. $test21 . ' ' . $test22 .' '. $influence12 . ' ' . $influence13 . ' '. $influence14 . ' '. $influence23 . ' ' . $influence24 . ' ' . $influence34 ;
            $command = escapeshellcmd($stringcommand);
            $output = shell_exec($command);
            $fichier = fopen ("data.txt", "r");
            $contenu_du_fichier = fgets ($fichier, 400);
            $tableau = explode(' ' , $contenu_du_fichier);
            fclose ($fichier);
            
        // On update et on crée la nouvelle valeur ! 

            $etatcalcule = new EtatExp() ;
            $new_T = ($etatavant->getT())+1;
            $etatcalcule-> setS1(floatval($tableau[0]))
                        -> setU1(floatval($tableau[1]))
                        -> setP1(floatval($tableau[2]))
                        -> setRu1(floatval($tableau[3]))
                        -> setRp1(floatval($tableau[4]))
                        -> setS2(floatval($tableau[5]))
                        -> setU2(floatval($tableau[6]))
                        -> setP2(floatval($tableau[7]))
                        -> setRu2(floatval($tableau[8]))
                        -> setRP2(floatval($tableau[9]))
                        -> setS3(floatval($tableau[10]))
                        -> setU3(floatval($tableau[11]))
                        -> setP3(floatval($tableau[12]))
                        -> setRu3(floatval($tableau[13]))
                        -> setRp3(floatval($tableau[14]))
                        -> setS4(floatval($tableau[15]))
                        -> setU4(floatval($tableau[16]))
                        -> setP4(floatval($tableau[17]))
                        -> setRu4(floatval($tableau[18]))
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
            'etat_avant' => $etatavant,
            'cas_cumule1'  => $cas_cumule1,
            'cas_cumule2'  => $cas_cumule2,
            'cas_cumule3'  => $cas_cumule3,
            'cas_cumule4'  => $cas_cumule4,
            'positivite1' => $positivite1,
            'positivite2' => $positivite2,
            'positivite3' => $positivite3,
            'positivite4' => $positivite4,
            'acc'=> $resume->getAcc(),
            'acc1' => $acc1,
            'acc2' => $acc2,
            'acc3' => $acc3,
            'acc4' => $acc4,
            'newP1' => $new_P1,
            'newP2' => $new_P2,
            'newP3' => $new_P3,
            'newP4' => $new_P4,
            'testhier1' => $etatavant->getTest11(),
            'testhier2' => $etatavant->getTest12(),
            'testhier3' => $etatavant->getTest21(),
            'testhier4' => $etatavant->getTest22(),
        ]
    );
    }   
}