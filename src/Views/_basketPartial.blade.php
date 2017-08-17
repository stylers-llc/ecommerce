<style>
    table {
        border-collapse: collapse;
    }
    .bordered {
        border: 1px solid black;
    }
    .left-tx{
        text-align: left;
    }
    .right-tx{
        text-align: right;
    }
</style>
<table class="bordered">
    <tr>
        <td colspan="2"><strong>From:</strong> {{config('ecommerce.invoice_from.company_name')}}</td>
        <th>Invoice Number:</th>
        <td>#{{$basketInfo->id}}</td>
    </tr>
    <tr>
        <td colspan="2">{{config('ecommerce.invoice_from.address_line_1')}}</td>
        <th>Invoice Date:</th>
        <td>{{ \Carbon\Carbon::parse($basketInfo->created_at)->format('m/d/Y') }}</td>
    </tr>
    <tr>
        <td colspan="2">{{config('ecommerce.invoice_from.address_line_2')}}</td>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td colspan="2">{{config('ecommerce.invoice_from.phone')}}</td>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td colspan="4"></td>
    </tr>
    <tr>
        <td colspan="2"><strong>To:</strong> {{$basketInfo->user->company}}</td>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td colspan="2">{{$basketInfo->user->company}}</td>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td colspan="2">{{$basketInfo->user->address1}} {{$basketInfo->user->address2}}</td>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td colspan="2">{{$basketInfo->user->city}}, {{$basketInfo->user->state}}, {{$basketInfo->user->postal}}, {{$basketInfo->user->country}}</td>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td colspan="2"><strong>Attn:</strong> {{$basketInfo->user->name}}</td>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td colspan="4"></td>
    </tr>
    <tr>
        <th class="bordered">Item</th>
        <th class="bordered">Unit cost</th>
        <th class="bordered">Quantity</th>
        <th class="bordered">Amount</th>
    </tr>
    @foreach($basketInfo->basketProducts as $basket_product)
        <tr>
            <td class="left-tx">{{ $basket_product->product->name->description }}</td>
            <td class="right-tx">{{ $basket_product->product->price }} {{$basketInfo->currency}}</td>
            <td class="right-tx">{{ $basket_product->qty }}</td>
            <td class="right-tx">{{ $basket_product->qty * $basket_product->product->price }} {{$basketInfo->currency}}</td>
        </tr>
    @endforeach
    <tr>
        <th colspan="3" class="bordered right-tx">Total:</th>
        <th class="bordered right-tx">{{$basketInfo->total}} {{$basketInfo->currency}}</th>
    </tr>
</table>