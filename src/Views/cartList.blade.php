@extends('layout')

@section('content')
    <h3>Products</h3>
    @if (!is_null($error))
        <div class="alert alert-danger">
            <strong>Error!</strong>{{ $error }}
        </div>
    @endif
    @foreach ($cartList["products"] as $id => $product)
        <div class="form-group product-list-item">
            <label for="{{ $id }}">{{ $product['name']['en'] }}</label>
            <input type="number" class="form-control productNumber" id="{{ $id }}" name="{{ $id }}" value="{{ $cartList['cart'][$id] }}" min="0"
                @if($product['is_singleton'])
                    max="1"
                @endif
                />
            <span class="help-block">Price: {{ $product['price'] }}</span>
            <button type="button" class="remove-product-item btn btn-default">Remove</button>
        </div>
    @endforeach
    <div>
        Total:<div id="sum">0</div>
    </div>
    <button type="button" class="btn-primary btn btn-sm" id="checkout">Checkout</button>
    <script type="text/javascript">
        let cartList = {!! $cartListJson !!};
        console.log(cartList);
        let cart = cartList.cart || {};

        const calculateSum = () => {
            let sum = 0;
            let productIds = Object.keys(cart);
            for(let i = 0; i < productIds.length; i++) {
                sum += $('.productNumber#'+productIds[i]).val() * cartList.products[productIds[i]].price;
            }
            $('span.sum').text(sum);
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
            let changeTimer;

            $('input.productNumber').on('change',(event) => {
                clearTimeout(changeTimer);
                let eventLogic = (event) => {
                    disableUselessButton();
                    let productId = $(event.target).attr("name");
                    let productNumber = $(event.target).val();
                    $.ajax({
                        url: "/ecommerce/cart/change/" + productId + "/" + productNumber,
                        success: (data) => {
                            cartList = data.cartList;
                            cart = data.cartList.cart;
                            calculateSum();
                        }
                    });
                };

                changeTimer = setTimeout(eventLogic(event), 1000);

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

            $('.remove-product-item').on('click',(event) => {
                let target = $(event.target).closest('.product-list-item');
                let productId = $(target).find("input.productNumber").attr("name");
                $.ajax({
                    url: "/ecommerce/cart/remove/" + productId,
                    success: (data) => {
                        target.remove();
                        cartList = data.cartList;
                        cart = data.cartList.cart;
                        calculateSum();
                    }
                });
            });
        });
    </script>
@endsection