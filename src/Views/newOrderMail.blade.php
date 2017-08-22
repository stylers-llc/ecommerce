<h1>New order arrived</h1>
@include('_buyerPartial', ['basketInfo' => $basketInfo])
@include('_basketPartial', ['basketInfo' => $basketInfo])

<p>
@foreach($basket->basketProducts as $basketProduct)
    @if(!is_null($basketProduct->product->stock) && $basketProduct->product->stock == 0)
        <strong>{{ $basketProduct->product->name->description }}</strong> has been sold out! (stock is 0)<br/>
    @endif
    @if(!is_null($basketProduct->product->stock) && $basketProduct->product->stock < 0)
        <strong>{{ $basketProduct->product->name->description }}</strong> is missing! (stock is {{$basketProduct->product->stock}})<br/>
    @endif
@endforeach
</p>