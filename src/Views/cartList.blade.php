@extends('master')

@section('title', "Cart")

@section('content')
    <h3>Products</h3>
    @if (!is_null($error))
        <div class="alert alert-danger">
            <strong>Error!</strong>{{ $error }}
        </div>
    @endif
    @foreach ($cartList["products"] as $id => $product)
        <div class="form-group">
            <label for="{{ $id }}">{{ $product['name']['en'] }}</label>
            <input type="number" class="form-control productNumber" id="{{ $id }}" name="{{ $id }}" value="{{ $cartList['cart'][$id] }}" min="0"
                @if($product['is_singleton'])
                    max="1"
                @endif
                />
            <span class="help-block">Price: {{ $product['price'] }}</span>
        </div>
    @endforeach
    <div>
        Total:<div id="sum">0</div>
    </div>
    <button type="button" class="btn-primary btn btn-sm" id="checkout">Checkout</button>
@endsection

@section('script')
    <script type="text/javascript">
        let cartList = {!! $cartListJson !!};
        console.log(cartList);
        let cart = cartList.cart || {};

        const calculateSum = () => {
            let sum = 0;
            let productIds = Object.keys(cart);
            for(let i = 0; i < productIds.length; i++) {
                sum += $('input.productNumber#'+productIds[i]).val() * cartList.products[productIds[i]].price;
            }
            $('div#sum').text(sum);
        };

        const updateCart = () => {
            let productIds = Object.keys(cart);
            for(let i = 0; i < productIds.length; i++) {
                cart[productIds[i]] = Number.parseInt($('input.productNumber#'+productIds[i]).val());
            }
        };

        const disableUselessButton = () => {
            let sum = 0;
            let productIds = Object.keys(cart);
            for(let i = 0; i < productIds.length; i++) {
                sum += $('input.productNumber#'+productIds[i]).val();
            }
            if(sum < 1) {
                $('button#checkout').prop('disabled', true);
            } else {
                $('button#checkout').prop('disabled', false);
            }
        };

        $(document).ready(()=>{
            calculateSum();
            disableUselessButton();

            $('input.productNumber').on('change',(event) => {
                calculateSum();
                disableUselessButton();
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