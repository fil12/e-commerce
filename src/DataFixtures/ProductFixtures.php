<?php
/**
 * Created by PhpStorm.
 * User: dev-alexf
 * Date: 16.01.19
 * Time: 22:39
 */

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class ProductFixtures extends Fixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
//        $faker = \Faker\Factory::create();
//
//        for ($i = 0; $i < 25; $i++) {
//            $product = new Product();
//
//            $category = $this->getReference(CategoryFixtures::CATEGORY);
//
//            $product
//                ->setTitle($faker->sentence)
//                ->setPrice(mt_rand(10, 100))
//                ->setSku(mt_rand(1, 40))
//                ->setDescription($faker->text($faker->boolean ? 300 : 400))
//                ->setIsPublished(true)
//                ->addCategory($category)
//            ;
//
//            $manager->persist($product);
//        }
//
//        $manager->flush();
    }
}