<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\ResumeExperience;

class ResumeExperienceFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=1 ; $i<10 ; $i++) {
            $resume = new ResumeExperience();
            $resume-> setR0(rand(0,20))
                    -> setPi(rand(0,2))
                    -> setMu(rand(0,15))
                    -> setI0(rand());
            $manager->persist($resume);
            $manager->flush();
        }
    
    }
}
