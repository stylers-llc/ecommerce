@extends('master')

@section('title', $product['name']['en'])

@section('content')
<div class="row">
    <div class="col-sm-12 col-md-12">
        <h1>{{$product['name']['en']}}</h1>
        <p>{{$product['descriptions']['short_description']['en']}}</p>

        @if ($product['price'])
            <p><h4>Price: {{$product['price']}}</h4></p>
        @endif

        {!! $product['descriptions']['long_description']['en'] !!}
    </div>
</div>
@endsection