@extends('master')

@section('title', 'Product list')

@section('content')
    <div class="row">
    @foreach ($productList['data'] as $product)
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                @if (!empty($product['gallery']['items']))
                    <div class="thumbnail">
                        <picture>
                            @foreach($product['gallery']['items'][0]['thumbnails'] as $thumbnail)
                                <source media="(min-width: {{$thumbnail['width']}})" srcset="/{{$thumbnail['path']}}">
                            @endforeach
                            <img src="/{{$product['gallery']['items'][0]['path']}}" alt="{{$product['gallery']['items'][0]['description']['en']}}" style="width:auto;">
                        </picture>
                    </div>
                @endif
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