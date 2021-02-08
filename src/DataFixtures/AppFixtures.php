<?php

namespace App\DataFixtures;

use App\Entity\Auteur;
use App\Entity\Categorie;
use App\Entity\Livre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $auteur = [
            [ 'name' => 'J.K. Rowling', 'nee' => '1965-7-31'],
            [ 'name' => 'Uderzo', 'nee' => '1927-4-25'],
            [ 'name' => 'Masashi Kishimoto', 'nee' => '1974-11-8'],
            [ 'name' => 'Guillaume Musso', 'nee' => '1974-6-6']
        ];

        foreach ($auteur as $item) {
            $autor = new Auteur();
            $autor->setName($item['name']);
            $autor->setDateNaissance(
                new \DateTimeImmutable($item['nee'])
            );
            $manager->persist($autor);
        }


        $categories = [
            'Roman', 'BD', 'Manga'
        ];
        foreach ($categories as $name) {
            $categ = new Categorie();
            $categ->setName($name);

            $manager->persist($categ);
        }
        $manager->flush();


        $livres = [
            [ 'name' => 'Harry Potter à l\'école des sorcier', 'date' => '1997',
                'categorie' => $manager->getRepository(Categorie::class)->findOneBy(['name' => 'Roman']),
                'auteur' => $manager->getRepository(Auteur::class)->findOneBy(['name' => 'J.K. Rowling'])
            ],
            [ 'name' => 'Harry Potter et la chambre des secrets', 'date' => '1998',
                'categorie' => $manager->getRepository(Categorie::class)->findOneBy(['name' => 'BD']),
                'auteur' => $manager->getRepository(Auteur::class)->findOneBy(['name' => 'J.K. Rowling'])
            ],
            [ 'name' => 'Harry Potter et le prisonnier d\'Azkaban', 'date' => '1999' ,
                'categorie' => $manager->getRepository(Categorie::class)->findOneBy(['name' => 'Roman']),
                'auteur' => $manager->getRepository(Auteur::class)->findOneBy(['name' => 'J.K. Rowling'])
            ],
            [ 'name' => 'Astérix le Gaulois', 'date' => '1961' ,
                'categorie' => $manager->getRepository(Categorie::class)->findOneBy(['name' => 'BD']),
                'auteur' => $manager->getRepository(Auteur::class)->findOneBy(['name' => 'Uderzo'])
            ],
            [ 'name' => 'La Serpe d\'or',
                'categorie' => $manager->getRepository(Categorie::class)->findOneBy(['name' => 'BD']),
                'auteur' => $manager->getRepository(Auteur::class)->findOneBy(['name' => 'Uderzo'])
            ],
            [ 'name' => 'Le fils d\'astérix',
                'categorie' => $manager->getRepository(Categorie::class)->findOneBy(['name' => 'BD'])
            ],
            [ 'name' => 'One-Punch-Man',
                'categorie' => $manager->getRepository(Categorie::class)->findOneBy(['name' => 'Manga'])
            ],
            [ 'name' => 'Naruto - Tome 1', 'date' => '1995',
                'categorie' => $manager->getRepository(Categorie::class)->findOneBy(['name' => 'Manga']),
                'auteur' => $manager->getRepository(Auteur::class)->findOneBy(['name' => 'Masashi Kishimoto'])
            ],
            [ 'name' => 'La jeune fille et la nuit', 'date' => '2018',
                'categorie' => $manager->getRepository(Categorie::class)->findOneBy(['name' => 'Roman']),
                'auteur' => $manager->getRepository(Auteur::class)->findOneBy(['name' => 'Guillaume Musso'])
            ],
        ];

        foreach ($livres as $key) {
            $livre = new Livre();
            $livre->setName($key['name']);
            $livre->setCategorie($key['categorie']);

            $date = null;

            if (isset($key['date'])) {
                $date = new \DateTimeImmutable($key['date']);
                $date->format('Y');
            }
            $livre->setDate(
                $date
            );
            if (isset($key['auteur'])) {
                $livre->addAuteur($key['auteur']);
            }
            $manager->persist($livre);
        }

        $manager->flush();
    }
}
