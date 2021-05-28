<?php

namespace App\DataFixtures;

use App\Entity\City;
use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $country = new Country();
        $country->setName('United States');
        $country->setCodeIso('us');
        $country->setCreatedAt(new \DateTime());
        $manager->persist($country);

        $city = new City();
        $city->setName('Miami');
        $city->setCode('miami');
        $city->setCounty($country);
        $city->setCreatedAt(new \DateTime());
        $manager->persist($city);

        $city = new City();
        $city->setName('New York');
        $city->setCode('nyc');
        $city->setCounty($country);
        $city->setCreatedAt(new \DateTime());
        $manager->persist($city);

        $city = new City();
        $city->setName('Orlando');
        $city->setCode('orlando');
        $city->setCounty($country);
        $city->setCreatedAt(new \DateTime());
        $manager->persist($city);

        $manager->flush();
    }
}
