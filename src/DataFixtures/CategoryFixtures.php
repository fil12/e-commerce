<?php
/**
 * Created by PhpStorm.
 * User: dev-alexf
 * Date: 17.01.19
 * Time: 9:26.
 */

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Category;
use Cocur\Slugify\Slugify;

class CategoryFixtures extends Fixture
{
    public const CATEGORY = 'category';

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();

        $categoryPar = $manager->getRepository(Category::class)->find(6);

            $category = new Category();

            $title = $faker->word;
            $slugify = new Slugify();

            $category
                ->setTitle($title)
                ->setSlug($slugify->slugify($title))
                ->setIsPublished(true)
                ->setDescription($faker->text($faker->boolean ? 300 : 400))
                ->setImage($faker->image())
                ->setParent($categoryPar)
            ;

            $manager->persist($category);




        $manager->flush();

        $this->addReference(self::CATEGORY, $category);
    }
}
