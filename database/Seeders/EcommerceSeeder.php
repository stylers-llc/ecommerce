<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Stylers\Taxonomy\Models\Taxonomy;

class EcommerceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->seedProductTypes();
        $this->seedProductDescriptions();
        $this->seedBasketStatuses();
        $this->seedTransactionStatuses();
    }

    protected function seedProductTypes() {
        $parentTx = Taxonomy::loadTaxonomy(Config::get('ecommerce.product_type'));
        $parentTx->name = 'product_type';
        $parentTx->save();

        foreach (Config::get('ecommerce.product_types') as $name => $id) {
            $tx = Taxonomy::loadTaxonomy($id);
            $tx->name = $name;
            $tx->save();
            $tx->makeChildOf($parentTx);
        }
    }

    protected function seedProductDescriptions() {
        $parentTx = Taxonomy::loadTaxonomy(Config::get('ecommerce.product_description_type'));
        $parentTx->name = 'product_description_type';
        $parentTx->save();

        foreach (Config::get('ecommerce.product_description_types') as $name => $id) {
            $tx = Taxonomy::loadTaxonomy($id);
            $tx->name = $name;
            $tx->save();
            $tx->makeChildOf($parentTx);
        }
    }

    protected function seedBasketStatuses(){
        $parentTx = Taxonomy::loadTaxonomy(Config::get('ecommerce.basket_status'));
        $parentTx->name = 'basket_status';
        $parentTx->save();

        foreach (Config::get('ecommerce.basket_statuses') as $name => $id) {
            $tx = Taxonomy::loadTaxonomy($id);
            $tx->name = $name;
            $tx->save();
            $tx->makeChildOf($parentTx);
        }
    }

    protected function seedTransactionStatuses(){
        $parentTx = Taxonomy::loadTaxonomy(Config::get('ecommerce.transaction_pay_status'));
        $parentTx->name = 'transaction_pay_status';
        $parentTx->save();

        foreach (Config::get('ecommerce.transaction_pay_statuses') as $name => $id) {
            $tx = Taxonomy::loadTaxonomy($id);
            $tx->name = $name;
            $tx->save();
            $tx->makeChildOf($parentTx);
        }
    }
}