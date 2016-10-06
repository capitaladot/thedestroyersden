<h1>Thank you for your order (# {{$order->id}}).</h1>
<ul>
	@foreach($order->tickets as $eachTicket)
		<li><strong>Arc&nbsp;</strong>${{$$eachTicket->getTitle()}}</li>
	@endforeach
	<li><strong>Total</strong>${{$order->currentTotal()}}</li>
</ul>
