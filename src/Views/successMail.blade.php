<h1>Payment success</h1>
<p>
    Dear <strong>{{ $basketInfo->user->name }}</strong>, <br/>
</p>
<h2>Invoice</h2>
@include('_basketPartial', ['basketInfo' => $basketInfo])