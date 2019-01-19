<?php
/**
 * Created by PhpStorm.
 * User: dev-alexf
 * Date: 17.01.19
 * Time: 13:17.
 */

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\ProductImages;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProductImagesFixture extends Fixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();

        $products = $manager->getRepository(Product::class)->findAll();

        foreach ($products as $product) {
            for ($i = 0; $i < 2; ++$i) {
                $productImage = new ProductImages();
                $productImage
                    ->setProduct($product)
                    ->setName($faker->imageUrl($width = 640, $height = 480));

                $manager->persist($productImage);
            }
        }

        $manager->flush();
    }
}
