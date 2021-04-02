<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\DetailExp;

class DetailExpFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $idexp = rand(1,9);
        for ($i=1 ; $i<10 ; $i++) {
            $detail = new DetailExp();
            $result-> setS1(rand())
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
                    -> setT($i)
                    -> setidexp($idexp);
        }
        $manager->persist($detail);
        $manager->flush();
    }
}
