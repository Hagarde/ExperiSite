<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\ResumeExperience;
use App\Entity\DetailExp;

class ResumeExperienceFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=1 ; $i<10 ; $i++) {
            $resume = new ResumeExperience();
            $resume-> setR0(mt_rand(0,20))
                    -> setPi(rand(0,2))
                    -> setMu(rand(0,15))
                    -> setI0(rand());
            $manager->persist($resume); 


            for ($j=1 ; $j<10 ; $j++){

                $detail = new DetailExp();
                $detail-> setS1(rand())
                        -> setS2(rand())
                        -> setS3(rand())
                        -> setS4(rand())
                        -> setU1(rand())
                        -> setU2(rand())
                        -> setU3(rand())
                        -> setU4(rand())
                        -> setP1(rand())
                        -> setP2(rand())
                        -> setP3(rand())
                        -> setP4(rand())
                        -> setRu1(rand())
                        -> setRu2(rand())
                        -> setRu3(rand())
                        -> setRu4(rand())
                        -> setRp1(rand())
                        -> setRp2(rand())
                        -> setRp3(rand())
                        -> setRp4(rand())
                        -> setRepartition1(rand())
                        -> setRepartition2(rand())
                        -> setRepartition3(rand())
                        -> setRepartition4(rand())
                        -> setT(rand())
                        -> setIdentifiantexp($resume);

                    $manager->persist($detail);

            }            
        }
        $manager->flush();
    
    }
}
