@extends('master')

@section('title', 'Product list')

@section('content')
    <div class="row">
    @foreach ($productList['data'] as $product)
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <div class="caption">
                    <h3>{{$product['name']['en']}}</h3>
                    @if(!empty($product['descriptions']['short_description']))
                        <p>{{ $product['descriptions']['short_description']['en'] }}</p>
                    @endif
                    <p><a href="{{ url('ecommerce/product/show', $product['id']) }}" class="btn btn-primary" role="button">More</a></p>
                </div>
            </div>
        </div>
    @endforeach
    </div>
@endsection