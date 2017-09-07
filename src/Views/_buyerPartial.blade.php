<p>
    <h3>Delivery infos</h3>
    <strong>Name:</strong> {{$basketInfo->deliveryAddress->name}}<br/>
    <strong>Email:</strong> {{$basketInfo->user->email}}<br/>
    <strong>Company:</strong> {{$basketInfo->deliveryAddress->company_name}}<br/>
    <strong>Postal code:</strong> {{$basketInfo->deliveryAddress->postal_code}}<br/>
    <strong>Country:</strong> {{$basketInfo->deliveryAddress->country}}<br/>
    <strong>State:</strong> {{$basketInfo->deliveryAddress->state}}<br/>
    <strong>City:</strong> {{$basketInfo->deliveryAddress->city}}<br/>
    <strong>Address:</strong> {{$basketInfo->deliveryAddress->address_line}} {{$basketInfo->deliveryAddress->address_line_2}}<br/>
</p>