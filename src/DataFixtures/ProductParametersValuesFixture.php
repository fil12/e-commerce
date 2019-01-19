<?php
/**
 * Created by PhpStorm.
 * User: dev-alexf
 * Date: 17.01.19
 * Time: 12:47.
 */

namespace App\DataFixtures;

use App\Entity\Parameters;
use App\Entity\Product;
use App\Entity\ProductParametersValue;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProductParametersValuesFixture extends Fixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
//        $products = $manager->getRepository(Product::class)->findAll();
//        $parameterRepo = $manager->getRepository(Parameters::class);
//
//
//        foreach ($products as $key=>$product){
//            $parameter = $parameterRepo->find(\mt_rand(1,12));
//            if (isset($parameter)){
//                $paramValue = new ProductParametersValue();
//
//                $paramValue
//                    ->setProduct($product)
//                    ->setParameter($parameter);
//
//                $manager->persist($paramValue);
//            }
//        }
//
//        $manager->flush();
    }
}
