@extends('app') @section('content')
<script type="text/javascript">
    var authRequest, referenceId;
    var amazonClientId = '...';
    var amazonSellerId = '...';
</script>
<script type='text/javascript'>
    window.onAmazonLoginReady = function() {
        amazon.Login.setClientId(amazonClientId);
    };
</script>
<script type="text/javascript" src="<?= AmazonPayment::script() ?>"></script>
<script type='text/javascript'>

    new OffAmazonPayments.Widgets.AddressBook({
        sellerId: amazonSellerId,
        displayMode: 'Edit',
        design: { size: { width: 600, height: 250 } },
        onOrderReferenceCreate: function(orderReference) {
            referenceId = orderReference.getAmazonOrderReferenceId();
            // add the referenceId to a hidden input to be posted when the user submits their order
            $('#reference_id').val(referenceId);
        },
        onAddressSelect: function(){

            // disable "submit order" button until payment has been loaded or added via widget
            $('#submit-order').prop('disable', true);

            // calculate shipping, by passing `referenceId` via ajax to your server
            // and using the `getOrderDetails()` call below to calculate shipping, taxes, etc...

            // AmazonPayment::getOrderDetails([
            //     'referenceId' => $_POST['referenceId']
            // ]);

            $.ajax({
                url: '/checkout/calculate_shipping',
                type: 'post',
                data: { referenceId: referenceId }
            })
            .success(function(response){
                // do something with the response...
                // like display shipping or taxes to the customer
            });

            // init payment widget
            new OffAmazonPayments.Widgets.Wallet({
                sellerId: amazonSellerId,
                amazonOrderReferenceId: referenceId,
                displayMode: 'Edit',
                design: { size: { width: 600, height: 250 } },
                onPaymentSelect: function(orderReference){
                    // enable "submit order" button
                    $('#submit-order').prop('disable', false);
                }
            }).bind("AmazonWalletWidget");

        },
        onError: function(error) {
            // window.location = '/amazon/checkout?session_expired=true';
            // alert(error.getErrorCode() + ": " + error.getMessage());
        }
    }).bind("AmazonAddressWidget");

</script>

<!-- Address widget will be displayed here -->
<div id="AmazonAddressWidget"></div>

<!-- Payment widget will be displayed here -->
<div id="AmazonWalletWidget"></div>

<!-- put these is your checkout form to be posted when the user submits their order -->
<input type="hidden" name="access_token" value="<?= $_GET['access_token'] ?>">
<input type="hidden" name="reference_id" id="reference_id">
@endsection