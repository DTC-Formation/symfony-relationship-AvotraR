<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Etudes;
use App\Entity\Adresse;
use App\Entity\Contact;
use App\Entity\Experiences;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create('fr_FR');
        for ($i=0;$i<10000;$i++){

            $user = new User();
            $user->setNom($faker->name);
            $user->setPrenom($faker->firstName);
            $user->setAge(mt_rand(16,40));

            $adresse = new Adresse();
            $adresse->setLot($faker->address);
            $adresse->setVille($faker->country);
            $user->setAdresse($adresse);

            $Contact = new Contact();
            $Contact->setTel($faker->unixTime);
            $Contact->setMail($faker->email);
            $Contact->setLinkdin($faker->email);
            $user->addContact($Contact);

            $Etudes = new Etudes();
            $Etudes->setDiplomes($faker->word);
            $Etudes->setDate(new \DateTime('now'));
            $user->addEtude($Etudes);

            $Experiences = new Experiences();
            $Experiences->setDateDebut(new \DateTime('now'));
            $Experiences->setDateFin(new \DateTime('now'));
            $Experiences->setTitre($faker->company);
            $user->addExperience($Experiences);

            $manager->persist($Contact);
            $manager->persist($Etudes);
            $manager->persist($Experiences);
            $manager->persist($user);
        }
        $manager->flush();
        $manager->clear();
    }
}
