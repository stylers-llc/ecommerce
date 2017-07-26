<?php

use Stylers\Ecommerce\Manipulators\ProductSetter;
use Stylers\Ecommerce\Entities\ProductEntity;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Stylers\Taxonomy\Exceptions\UserException;

class ProductSetterTest extends TestCase {
    use DatabaseTransactions;

    /**
    * @test
    */
    public function test_can_run()
    {
        $this->assertTrue(true);
    }

    /**
    * @test
    * @expectedException Stylers\Taxonomy\Exceptions\UserException
    */
    public function is_active_attribute_required_by_exception()
    {
        $product = [
            'product_type' => 'equipment'
        ];
        $setter = new ProductSetter($product);
    }

    /**
    * @test
    */
    public function is_active_attribute_required()
    {
        $product = [
            'product_type' => 'equipment',
            'is_active' => true,
            'name' => [
                'en' => 'Test'
            ]
        ];
        $setter = new ProductSetter($product);
    }

    /**
    * @test
    * @expectedException Stylers\Taxonomy\Exceptions\UserException
    */
    public function is_active_have_to_be_boolean_by_exception()
    {
        $product = [
            'product_type' => 'equipment',
            'is_active' => "ok",
            'name' => [
                'en' => 'Test'
            ]
        ];
        $setter = new ProductSetter($product);
    }

    /**
    * @test
    */
    public function is_active_have_to_be_boolean()
    {
        $product = [
            'product_type' => 'equipment',
            'is_active' => true,
            'name' => [
                'en' => 'Test'
            ]
        ];
        $setter = new ProductSetter($product);
    }

    /**
    * @test
    * @expectedException Stylers\Taxonomy\Exceptions\UserException
    */
    public function name_required_by_exception()
    {
        $product = [
            'product_type' => 'equipment',
            'is_active' => true
        ];
        $setter = new ProductSetter($product);
    }


    /**
    * @test
    */
    public function it_could_create_product()
    {
        $product = [
            'product_type' => 'equipment',
            'is_active' => true,
            'name' => [
                'en' => 'Test'
            ]
        ];
        $setter = new ProductSetter($product);
        $product = $setter->set();
    }

    /**
    * @test
    */
    public function it_equals_with_its_entity()
    {
        $productArray = [
            'product_type' => 'equipment',
            'is_active' => true,
            'name' => [
                'en' => 'Test'
            ]
        ];
        $setter = new ProductSetter($productArray);
        $product = $setter->set();

        $entity = new ProductEntity($product);
        $entityData = $entity->getFrontendData();

        $this->assertEquals($productArray['is_active'], $entityData['is_active']);
        $this->assertEquals($productArray['product_type'], $entityData['product_type']);
        $this->assertEquals($productArray['name'], $entityData['name']);
    }
}

