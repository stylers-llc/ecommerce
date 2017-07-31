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

        Schema::create('baskets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('basket_status_tx_id')->unsigned();
            $table->string('currency')->nullable();
            $table->integer('total')->unsigned()->default(0);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('basket_status_tx_id')->references('id')->on('taxonomies');
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('basket_products', function (Blueprint $table) {
            $table->dropForeign(['basket_id']);
            $table->dropForeign(['product_id']);
        });
        Schema::dropIfExists('basket_products');

        Schema::table('baskets', function (Blueprint $table) {
            $table->dropForeign(['basket_status_tx_id']);
        });
        Schema::dropIfExists('baskets');

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