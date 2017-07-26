###Install component
1. add Stylers\Taxonomy\Providers\EcommerceServiceProvider::class to config/app providers
3. php artisan vendor:publish --provider="Stylers\Ecommerce\Providers\EcommerceServiceProvider"
4. php artisan db:seed --class=EcommerceSeeder
