<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Result;

class UneExpFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=1 ; $i<10 ; $i++) {
            $result = new result();
            $result-> setbeta(rand(0,4))
                    -> setpi(rand(0,2))
                    -> setmu(rand(0,15))
                    -> setS(rand())
                    -> setP(rand())
                    -> setU(rand())
                    -> setRU(rand())
                    -> setRP(rand())
                    -> setRepartition2(rand())
                    -> setRepartition3(rand())
                    -> setRepartition4(rand())
                    -> setTemps(rand())
                    -> setidutilisateur($i)
                    -> setproportioninitiale(rand());


            $manager->persist($result);
        }
            $manager->flush();
        
    }
}
