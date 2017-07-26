<?php

namespace Stylers\Ecommerce\Console;

use Illuminate\Console\Command;
use Stylers\Ecommerce\Manipulators\ProductSetter;

class ProductImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:load {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load products from json';

    /**
     * Create a new command instance.
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $path = base_path().DIRECTORY_SEPARATOR.$this->argument('file');
        $productDatas = json_decode(file_get_contents($path), true);

        foreach ($productDatas as $productData) {
            $product = (new ProductSetter($productData))->set();

            $this->info("Product `{$product->name->description}` seeded");
        }
    }
}