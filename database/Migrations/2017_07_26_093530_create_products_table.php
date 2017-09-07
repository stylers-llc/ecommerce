<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('name_description_id')->unsigned();
            $table->integer('type_taxonomy_id')->unsigned();
            $table->boolean('is_active')->default(0);
            $table->double('price', 9, 2)->nullable();
            $table->unsignedInteger('number_of_sales')->default(0);
            $table->boolean('is_singleton')->default(0);
            $table->integer('stock')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('name_description_id')->references('id')->on('descriptions');
            $table->foreign('type_taxonomy_id')->references('id')->on('taxonomies');
        });

        Schema::create('product_classifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('taxonomy_id')->unsigned();
            $table->integer('value_taxonomy_id')->unsigned()->nullable();
            $table->integer('priority')->unsigned()->nullable();
            $table->boolean('is_listable')->default(0);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('taxonomy_id')->references('id')->on('taxonomies');
            $table->foreign('value_taxonomy_id')->references('id')->on('taxonomies');
        });

        Schema::create('product_metas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('taxonomy_id')->unsigned();
            $table->string('value');
            $table->integer('priority')->unsigned()->nullable();
            $table->boolean('is_listable')->default(0);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('taxonomy_id')->references('id')->on('taxonomies');
        });

        Schema::create('product_descriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('taxonomy_id')->unsigned();
            $table->integer('description_id')->unsigned();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('taxonomy_id')->references('id')->on('taxonomies');
            $table->foreign('description_id')->references('id')->on('descriptions');
        });

        Schema::create('user_addresses', function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();

            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('company_name')->nullable();
            $table->string('country');
            $table->string('postal_code');
            $table->string('state')->nullable();
            $table->string('city');
            $table->string('address_line');
            $table->string('address_line_2')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
        });


        Schema::create('baskets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('basket_status_tx_id')->unsigned();
            $table->string('currency')->nullable();
            $table->integer('total')->unsigned()->default(0);
            $table->integer('shipping_fee')->unsigned()->default(0);
            $table->integer('sub_total')->unsigned()->default(0);
            $table->integer('sub_total_gross')->unsigned()->default(0);
            $table->integer('delivery_address_id')->unsigned()->nullable();
            $table->integer('billing_address_id')->unsigned()->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('basket_status_tx_id')->references('id')->on('taxonomies');

            $table->foreign('delivery_address_id')->references('id')->on('user_addresses');
            $table->foreign('billing_address_id')->references('id')->on('user_addresses');
        });

        Schema::create('basket_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('basket_id')->unsigned()->nullable();
            $table->integer('product_id')->unsigned();
            $table->double('price', 8, 2)->nullable();
            $table->smallInteger('qty')->default(1)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('basket_id')->references('id')->on('baskets');
            $table->foreign('product_id')->references('id')->on('products');
        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('payment_id', 256)->unique();

            $table->integer('basket_id')->unsigned();
            $table->integer('pay_status_tx_id')->unsigned();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('basket_id')->references('id')->on('baskets');
            $table->foreign('pay_status_tx_id')->references('id')->on('taxonomies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['basket_id']);
            $table->dropForeign(['pay_status_tx_id']);
            $table->dropUnique(['payment_id']);
        });
        Schema::dropIfExists('transactions');

        Schema::table('basket_products', function (Blueprint $table) {
            $table->dropForeign(['basket_id']);
            $table->dropForeign(['product_id']);
        });
        Schema::dropIfExists('basket_products');

        Schema::table('baskets', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['basket_status_tx_id']);
            $table->dropForeign(['delivery_address_id']);
            $table->dropForeign(['billing_address_id']);
        });

        Schema::dropIfExists('baskets');

        Schema::table('user_addresses', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('user_addresses');

        Schema::table('product_descriptions', function(Blueprint $table) {
            $table->dropForeign(['description_id']);
            $table->dropForeign(['taxonomy_id']);
            $table->dropForeign(['product_id']);
        });

        Schema::table('product_metas', function(Blueprint $table) {
            $table->dropForeign(['taxonomy_id']);
            $table->dropForeign(['product_id']);
        });

        Schema::table('product_classifications', function(Blueprint $table) {
            $table->dropForeign(['value_taxonomy_id']);
            $table->dropForeign(['taxonomy_id']);
            $table->dropForeign(['product_id']);
        });

        Schema::table('products', function(Blueprint $table) {
            $table->dropForeign(['type_taxonomy_id']);
            $table->dropForeign(['name_description_id']);
        });

        Schema::drop('product_descriptions');
        Schema::drop('product_metas');
        Schema::drop('product_classifications');
        Schema::drop('products');
    }

}