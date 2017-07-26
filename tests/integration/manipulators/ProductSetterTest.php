<?php

use Stylers\Ecommerce\Manipulators\ProductSetter;
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
}

