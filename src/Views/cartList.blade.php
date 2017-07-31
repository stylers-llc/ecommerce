@extends('master')

@section('title', "Cart")

@section('content')
    <h3>Products</h3>
    @foreach ($cartList["products"] as $id => $product)
        <div class="form-group">
            <label for="{{ $id }}">{{ $product['name']['en'] }}</label>
            <input type="number" class="form-control productNumber" id="{{ $id }}" name="{{ $id }}" value="{{ $cartList['cart'][$id] }}" min="0" />
            <span class="help-block">Price: {{ $product['price'] }}</span>
        </div>
    @endforeach
    <div>
        Total:<div id="sum"></div>
    </div>
    <button type="button" class="btn-primary btn btn-sm" id="checkout">Checkout</button>
@endsection

@section('script')
    <script type="text/javascript">
        let cartList = {!! $cartListJson !!};
        let cart = cartList.cart;

        const calculateSum = () => {
            let sum = 0;
            let productIds = Object.keys(cartList.cart);
            for(let i = 0; i < productIds.length; i++) {
                sum += $('input.productNumber#'+productIds[i]).val() * cartList.products[productIds[i]].price;
            }
            $('div#sum').text(sum);
        };

        const updateCart = () => {
            let productIds = Object.keys(cartList.cart);
            for(let i = 0; i < productIds.length; i++) {
                cart[productIds[i]] = Number.parseInt($('input.productNumber#'+productIds[i]).val());
            }
            console.log(cart);
        };

        $(document).ready(()=>{
            calculateSum();

            $('input.productNumber').on('change',(event) => {
                calculateSum();
            });

            $('button#checkout').on('click',(event) => {
                let target = $(event.target).closest('button');
                target.prop('disabled', true);
                updateCart();
                $.redirect(
                    "{{ url("ecommerce/checkout") }}",
                    cart,
                    "POST",
                    "_self",
                    true,
                    true
                );
            });
        });
    </script>
@endsection