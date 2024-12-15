<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Language;
use App\Entity\Movie;
use App\Entity\Serie;
use App\Entity\User;
use App\Enum\UserAccountStatusEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private \Faker\Generator $faker;
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->faker = Factory::create();
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $users = $this->generateUsers($manager);
        $medias = $this->generateMedias($manager);
        $categories = $this->generateCategories($manager, $medias);
        $languages = $this->generateLanguages($manager, $medias);

        $manager->flush();
    }

    private function generateUsers(ObjectManager $manager): array
    {
        $users = [];
        for ($i = 0; $i < 50; $i++) {
            $user = new User();
            $user->setUsername($this->faker->userName);
            $user->setEmail($this->faker->email);
            $user->setPassword($this->faker->password);
            $user->setAccountStatus(UserAccountStatusEnum::ACTIVE);
            $user->setRoles(['ROLE_USER']);
            $users[] = $user;
            $manager->persist($user);
        }

        return $users;
    }

    protected function generateLanguages(ObjectManager $manager, array $medias): array
    {
        $languages = [];
        $languageData = [
            ['fr', 'Français'], ['en', 'Anglais'], ['es', 'Espagnol'], ['de', 'Allemand'],
            ['it', 'Italien'], ['pt', 'Portugais'], ['ru', 'Russe'], ['zh', 'Chinois'],
            ['ja', 'Japonais'], ['ar', 'Arabe'], ['hi', 'Hindi'], ['bn', 'Bengali'],
            ['ko', 'Coréen'], ['tr', 'Turc'], ['nl', 'Néerlandais'], ['pl', 'Polonais']
        ];

        foreach ($languageData as [$code, $name]) {
            $entity = new Language();
            $entity->setCode($code);
            $entity->setNom($name);
            $languages[] = $entity;
            $manager->persist($entity);

            foreach ($this->faker->randomElements($medias, rand(0, 20)) as $media) {
                $media->addLanguage($entity);
            }
        }

        return $languages;
    }

    protected function generateCategories(ObjectManager $manager, array $medias): array
    {
        $categories = [];
        $categoryNames = ['Action', 'Aventure', 'Comédie', 'Drame', 'Fantastique', 'Horreur', 'Policier', 'Science-fiction', 'Thriller'];

        foreach ($categoryNames as $name) {
            $category = new Category();
            $category->setLabel($name);
            $category->setNom(strtolower($this->faker->unique()->slug(1)));
            $categories[] = $category;
            $manager->persist($category);


            foreach ($this->faker->randomElements($medias, rand(0, 20)) as $media) {
                $media->addCategory($category);
            }
        }

        return $categories;
    }

    protected function generateMedias(ObjectManager $manager): array
    {
        $medias = [];
        for ($j = 0; $j < 50; $j++) {
            $type = $this->faker->randomElement([Movie::class, Serie::class]);
            $media = new $type();
            $media->setTitle($this->faker->sentence(3));
            $media->setShortDescription($this->faker->text(50));
            $media->setLongDescription($this->faker->text(200));
            $media->setCoverImage("cover_image_{$j}.png");
            $media->setReleaseDate($this->faker->dateTimeThisDecade());
            $media->setCasting($this->faker->words(rand(2, 5)));
            $media->setStaff($this->faker->words(rand(2, 5)));
            $medias[] = $media;
            $manager->persist($media);
        }
        return $medias;
    }
}
