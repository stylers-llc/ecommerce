@extends('master')

@section('title', $product['name']['en'])

@section('content')
<div class="row">
    <div class="col-sm-12 col-md-12">
        <h1>{{$product['name']['en']}}</h1>
        @if(!empty($product['descriptions']['short_description']))
        <p>{{$product['descriptions']['short_description']['en']}}</p>
        @endif
        @if (Auth::check() == true && $product['price'])
            <p>
                <h4>Price: {{$product['price']}}</h4>
                <button class="btn btn-primary btn-sm add-to-cart" data-product-id="{{$product['id']}}"><span class="glyphicon glyphicon-shopping-cart"></span></button>
            </p>
        @endif
        @if(!empty($product['descriptions']['long_description']))
        {!! $product['descriptions']['long_description']['en'] !!}
        @endif
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript" src="/plugins/ecommerce/cart.js"></script>
@endsection