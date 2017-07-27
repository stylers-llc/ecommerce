<div class="row">
@foreach ($productList['data'] as $product)
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
            <div class="caption">
                <h3>{{$product['name']['en']}}</h3>
            </div>
        </div>
    </div>
@endforeach
</div>