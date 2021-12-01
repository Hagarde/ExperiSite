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
use Firebase\JWT\JWT;


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
     * @Route("/tuto", name="tutoriel")
     */


    public function exp() 
    {
        return $this->render('sir/tuto.html.twig');
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
     * @Route("/test", name="test")
     */ 

    public function test() {
        return $this->render('sir/exp______.html.twig'
        );
    }

    /**
     * @Route("/boot", name="boot")
     */ 

    public function boot(EntityManagerInterface $manager) {

        $test = $this->getDoctrine()
            ->getRepository(Epidemie::class)
            ->findOneBy(['R'=>4]);
        if (!$test) {

        $epidemie1 = new Epidemie();
        $epidemie2 = new Epidemie();
        $epidemie3 = new Epidemie();

        $epidemie1->setR(4)
            ->setPi(1)
            ->setMu(1/28)
            ->setI0(0.005)
            ->setEpsilon(0.005);

        $epidemie2->setR(8)
            ->setPi(1)
            ->setMu(1/14)
            ->setI0(0.005)
            ->setEpsilon(0.005);

        $epidemie3->setR(12)
            ->setPi(1)
            ->setMu(0.1)
            ->setI0(0.005)
            ->setEpsilon(0.005);

        $manager->persist($epidemie1);
        $manager->persist($epidemie2);
        $manager->persist($epidemie3);
        $manager->flush();
        }

        return $this->render('sir/boot.html.twig'
        );
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
        $resume = $repo1->findOneBy(['id' => $num_exp]);
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

        // prbl avec chart 
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
            if ($IDrandom == 1) {
                $epi =  $repo->findOneBy(['R' =>4]);
            }
            if ($IDrandom == 2) {
                $epi =  $repo->findOneBy(['R' =>8]);
            }
            if ($IDrandom == 3) {
                $epi =  $repo->findOneBy(['R' =>12]);
            }
            $i0 = $epi->getI0()*$NN; //ERREUR PK ? 
            $etatinitial = new EtatExp;
            // randomization de si on display la valeur de accélration de pintus 
            $acceleration = true ;
            $niveau_liberte = 1 ;
            if (rand(0,1) < 0.5) {
                $niveau_liberte = 2 ;
            }
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
                    ->setEpsilon($epi->getEpsilon())
                    ->setNiveauLiberte($niveau_liberte);

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
            $test_avant1= 0;
            $test_avant2= 0;
            $test_avant3= 0;
            $test_avant4= 0;
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
                    -> add('Test12', RangeType::class , ['attr' => [
                        'autocomplete' => 'on',
                        'style' => 'width=100%,',
                    ]])
                    -> add('Test21', RangeType::class, ['attr' => [
                        'autocomplete' => 'on',
                        'style' => 'align-items: center;',
                    ]])
                        
                        ->getForm();

        $form->handleRequest($request);
        $T = $etatavant->getT() ;
        $epsilon = $resume->getEpsilon();
        $nmbr_test = $epsilon * $NN ;
        # calcul des données à montrer au sujet : 
        $cas_cumule1 = $etatavant->getP1() + $etatavant->getRp1();
        $cas_cumule2 = $etatavant->getP2() + $etatavant->getRp2();
        $cas_cumule3 = $etatavant->getP3() + $etatavant->getRp3();
        $cas_cumule4 = $etatavant->getP4() + $etatavant->getRp4();
        $positivite1 = 'Pas encore disponible';
        $positivite2 = 'Pas encore disponible';
        $positivite3 = 'Pas encore disponible';
        $positivite4 = 'Pas encore disponible';
        $new_P1 = 'Pas encore disponible';
        $new_P2 = 'Pas encore disponible';
        $new_P3 = 'Pas encore disponible';
        $new_P4 = 'Pas encore disponible';
        
        $acc1 = 'Pas encore disponible' ;
        $acc2 = 'Pas encore disponible' ;
        $acc3 = 'Pas encore disponible' ;
        $acc4 = 'Pas encore disponible' ;
        if (!empty($T)) {
            $etatavantavant = $etatlie[$avantdernier - 1] ;

            $test_avant1 = $etatavantavant->getTest11();
            $test_avant2 = $etatavantavant->getTest12();
            $test_avant3 = $etatavantavant->getTest21();
            $test_avant4 = $etatavantavant->getTest22();

            

            $new_P1 = ($etatavant->getP1() - $etatavantavant->getP1()+($etatavant->getRP1() - $etatavantavant->getRP1()));
            $new_P2 = ($etatavant->getP2() - $etatavantavant->getP2()+($etatavant->getRP2() - $etatavantavant->getRP2()));
            $new_P3 = ($etatavant->getP3() - $etatavantavant->getP3()+($etatavant->getRP3() - $etatavantavant->getRP3()));
            $new_P4 = ($etatavant->getP4() - $etatavantavant->getP4()+($etatavant->getRP4() - $etatavantavant->getRP4()));



            if (($test_avant1>0)and ($test_avant2>0) and ($test_avant3>0) and ($test_avant4>0 ) and ($T > 2.5) and ($new_P1 > 0) and ($new_P2 > 0) and ($new_P3 > 0) and ($new_P4 > 0)) {
                // $etatavantavantavant = $etatlie[$avantdernier - 2] ;
                

                if (empty($etatavantavant->getTest11())) {
                    $positivite1 = 0;
                    $acc1= 0;
                }
                else{
                    $positivite1 = ($new_P1) / $etatavantavant->getTest11() ;
                    $test_cumule1 = 0;
                    for ($i = 0; $i < count($etatlie) ; $i++) {
                        $test_cumule1  += $etatlie[$i]->getTest11() ; 
                    }
                    $acc1 = ($test_cumule1/$cas_cumule1) * $positivite1 ;
                }
                
                if (empty($etatavantavant->getTest12())){
                    $positivite2 = 0;
                    $acc2= 0;
                }
                else{
                    $positivite2 = ($new_P2) / $etatavantavant->getTest12() ;
                    $test_cumule2 = 0 ; 
                    for ($i = 0; $i < count($etatlie) ; $i++) {
                        $test_cumule2  += $etatlie[$i]->getTest12();
                        
                        //dump($acc2);
                    }
                    $acc2 = ($test_cumule2/$cas_cumule2) * $positivite2 ;
                }

                if (empty($etatavantavant->getTest21())){
                    $positivite3 = 0;
                    $acc3= 0;
                }
                else{
                    $positivite3 = ($new_P3) / $etatavantavant->getTest21() ;
                    $test_cumule3 = 0 ;
                    for ($i = 0; $i < count($etatlie) ; $i++) {
                        $test_cumule3  += $etatlie[$i]->getTest21();
                         ;
                        //dump($acc3);
                    }
                    $acc3 = ($test_cumule3/$cas_cumule3) * $positivite3;
                }

                if (empty($etatavantavant->getTest22())){
                    $positivite4 = 0;
                    $acc4= 0;
                }
                else{
                    $positivite4 = ($new_P4) / $etatavantavant->getTest22() ;
                    $test_cumule4 = 0 ;
                    for ($i = 0; $i < count($etatlie) ; $i++) {
                        $test_cumule4  += $etatlie[$i]->getTest22();
                        
                        //dump($acc4);
                    }
                    $acc4 = ($test_cumule4/$cas_cumule4) * $positivite4 ;
                }
                };
            };
        

        if($form->isSubmitted() && $form->isValid() ){
            // Ici on traduit les valeurs rentrées dans les slides-barres en nombre de test réel 
            $repartition1 = $resultexp->getTest11();
            $repartition2 = $resultexp->getTest12();
            $repartition3 = $resultexp->getTest21();
            $etatavant->setTest11((100-$repartition1)*((100-$repartition2)/10000)*$nmbr_test)
                    ->setTest12((100-$repartition1)*($repartition2/10000)*$nmbr_test)
                    ->setTest21($repartition1*((100-$repartition3)/10000)*$nmbr_test)
                    ->setTest22($repartition1*($repartition3/10000)*$nmbr_test);

            // Truc chiant pour utiliser le python 
            $key = "Victor est le boss !" ;
            $packet = array(
                "s1" => $etatavant->getS1(),
                "s2" => $etatavant->getS2(),
                "s3" => $etatavant->getS3(),
                "s4" => $etatavant->getS4(),
                "u1" => $etatavant->getU1(),
                "u2" => $etatavant->getU2(),
                "u3" => $etatavant->getU3(),
                "u4" => $etatavant->getU4(),
                "p1" => $etatavant->getP1(),
                "p2" => $etatavant->getP2(),
                "p3" => $etatavant->getP3(),
                "p4" => $etatavant->getP4(),
                "ru1" => $etatavant->getRu1(),
                "ru2" => $etatavant->getRu2(),
                "ru3" => $etatavant->getRu3(),
                "ru4" => $etatavant->getRu4(),
                "rp1" => $etatavant->getRp1(),
                "rp2" => $etatavant->getRp2(),
                "rp3" => $etatavant->getRp3(),
                "rp4" => $etatavant->getRp4(),
                "R0" => $resume->getR0(),
                "pi" => $resume->getPi(),
                "mu" => $resume->getMu(),
                "test11" => $etatavant->getTest11(),
                "test12" => $etatavant->getTest12(),
                "test21" => $etatavant->getTest21(),
                "test22" => $etatavant->getTest22(),
                "niveau_liberte" =>$resume->getNiveauLiberte()
            );
            $jwt = JWT::encode($packet, $key);
            
            // Adresse de l'API avec les informations encodées 
            // dump($jwt);
            $URL = "http://ginfo.xyz:3000/AMSE/" . $jwt ;
            $curl = curl_init($URL);
            // dump($curl);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            $response = json_decode($response, true);
            // dump($response);
        // On update et on crée la nouvelle valeur ! 

            $etatcalcule = new EtatExp() ;
            $new_T = ($etatavant->getT())+1;
            $etatcalcule-> setS1($response['s1'])
                        -> setU1($response['u1'])
                        -> setP1($response['p1'])
                        -> setRu1($response['ru1'])
                        -> setRp1($response['rp1'])
                        -> setS2($response['s2'])
                        -> setU2($response['u2'])
                        -> setP2($response['p2'])
                        -> setRu2($response['ru2'])
                        -> setRP2($response['rp2'])
                        -> setS3($response['s3'])
                        -> setU3($response['u3'])
                        -> setP3($response['p3'])
                        -> setRu3($response['ru3'])
                        -> setRp3($response['rp3'])
                        -> setS4($response['s4'])
                        -> setU4($response['u4'])
                        -> setP4($response['p4'])
                        -> setRu4($response['ru4'])
                        -> setRp4($response['rp4'])
                        -> setT($new_T)
                        -> setExperience($etatavant->getExperience());
            $manager->persist($etatcalcule);
            $manager->flush();

            return $this->redirectToRoute('exp_form_suite', [
                'num_exp' => $num_exp ,
                'temps' => $etatcalcule
            ]);
        }                        

        return $this->render('sir/exp______.html.twig',[
            'formExp' => $form->createView(),
            'resume' => $resume ,
            'temps' => $T ,
            'etat_avant' => $etatavant,
            'cas_cumule1'  => round((int)$cas_cumule1,2),
            'cas_cumule2'  => round((int)$cas_cumule2,2),
            'cas_cumule3'  => round((int)$cas_cumule3,2),
            'cas_cumule4'  => round((int)$cas_cumule4,2),
            'positivite1' => $positivite1,
            'positivite2' => $positivite2,
            'positivite3' => $positivite3,
            'positivite4' => $positivite4,
            'acc'=> $resume->getAcc(),
            'acc1' => $acc1,
            'acc2' => $acc2,
            'acc3' => $acc3,
            'acc4' => $acc4,
            'newP1' => round((int)$new_P1,2),
            'newP2' => round((int)$new_P2,2),
            'newP3' => round((int)$new_P3,2),
            'newP4' => round((int)$new_P4,2),
            'testhier1' => round((int)$test_avant1,2),
            'testhier2' => round((int)$test_avant2,2), //C'est pour arrondir au supérieur pq c'est plus cohérent pour le sujet 
            'testhier3' => round((int)$test_avant3,2),
            'testhier4' => round((int)$test_avant4,2),
        ]
    );
    }   
}