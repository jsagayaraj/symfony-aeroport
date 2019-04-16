<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Flights;
use App\Entity\Arrivals;
use App\Entity\Departures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');
        // //Departures
        // for ($j=0; $j <=5 ; $j++) 
        // { 
        //     $depart = new Departures();
        //     $depart->getVilleDeDepart($faker->city);
                    
        //     $manager->persist($depart);


        //     for ($k=0; $k<=mt_rand(1,2); $k++)
        //     {
        //         $arive = new Arrivals();
        //         $arive->setVilledAriver($faker->city);
                    
        //         $manager->persist($arive);

        //         for ($i=0; $i <= mt_rand(2, 8); $i++) 
        //         {
        //               $flight = new Flights();
        //                 $flight->setFlightName($faker->word())
        //                         ->setFlightNumber($faker->randomDigit(5))
        //                         ->setFilename($faker->imageUrl)
        //                         ->setDate(new \DateTime())
        //                         ->setCreatedAT(new \DateTime())
        //                         ->setMaxPlace($faker->randomDigit)
        //                         ->setPrice("354")       
        //                         ->setDepartures($depart)
        //                         ->setArrivals($arive);

        //                         $manager->persist($flight);
        //         }
        //     }

        // }
        for ($l=0; $l <= 20 ; $l++) { 
                $user = new User();
                $user->setFirstname($faker->firstName)
                    ->setLastname($faker->lastName)
                    ->setEmail($faker->email)
                    ->setPassword(md5('password'))
                    ->setGender($faker->titleMale)
                    ->setAddress($faker->streetAddress)
                    ->setCity($faker->city)
                    ->setStatus($faker->word)
                    ->setPostalCode($faker->randomDigit)
                    ->setPhoneNumber($faker->randomDigit);
    
                    $manager->persist($user);
            }
            $manager->flush();
    }
}
