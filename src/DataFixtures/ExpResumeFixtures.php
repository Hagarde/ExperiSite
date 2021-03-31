<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\ExpResume;

class ExpResumeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i=1;$i<10;$i++){
        $resume = new ExpResume();
        $resume->setbeta(rand(0,20))
                ->setpi(rand(0,2))
                ->setmu(rand(0,15))
                ->setPropotioninitiale(rand(0,100))
                ->setIdutilisateur($i);

        $manager->persist($resume);
        }

        $manager->flush();
    }
}
