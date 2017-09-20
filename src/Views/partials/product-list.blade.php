<!-- mt--60-at majd le kell venni ha a productList.blade.php-ban visszakerül a breadcumb meg a cattegory selector -->

<div class="product-list mt--60" id="product-list">
    @foreach ($productList['data'] as $product)
        @if($product['product_type'] != 'course')
            <!-- start item -->
            <section class="section--main">
                <div class="container">
                    @include('partials.product-list__item', ['product' => $product])
                </div>
            </section>
            <!-- end item -->
        @endif
    @endforeach
</div>