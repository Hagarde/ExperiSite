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
            $resume-> setbeta(rand(0,4))
                    -> setpi(rand(0,2))
                    -> setmu(rand(0,15))
                    -> setproportioninitiale(rand());
        }
    $manager->flush();
    }
}
