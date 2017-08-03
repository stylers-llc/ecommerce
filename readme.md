###Version info
0.0.6 For this version it requires usable <i>mail</i> in .env.

###Install component
1. add <i>Stylers\Taxonomy\Providers\EcommerceServiceProvider::class</i> and <i>Stylers\Ecommerce\Providers\EcommerceEventServiceProvider::class</i> to config/app providers
2. run npm install in package public/
3. php artisan vendor:publish --provider="Stylers\Ecommerce\Providers\EcommerceServiceProvider"
4. php artisan db:seed --class=EcommerceSeeder
