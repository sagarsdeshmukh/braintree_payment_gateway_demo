<?php

include '../includes/header_generic.php';
include '../includes/header_close.php';
include '../model/Helper.php';
include '../model/Base.php';

if(isset($_POST) && isset($_POST['payment_method_nonce'])) {

    // Initialize the base class
    $base = new Base();

    // Get values from the POST - also formatting
    $nonce = $base->getPost('payment_method_nonce');
    $amount = number_format((float)$base->getPost('amount'), 2, '.', '');

    // Initialize the Braintree helper class with the POST values 
    $helper = new Helper($nonce, $amount);

    // Make the Braintree Sale
    $result = $helper->bt_sale();

    if($result->success) {
        // var_dump($result->transaction->_attributes['customer']['id']);
    ?>
        <h3>Thank you for your payment of $ <?php echo $amount; ?> ! We appreciate your support.</h3>
        <h3>This is the transaction ID: <?php echo $result->transaction->_attributes['id']; ?> - You can <a class="highlight" href="../find_transaction?id=<?php echo $result->transaction->_attributes['id']; ?>">click here</a> to search for the transaction</h3>
        <h3><a href="../dropin?amt=50">Click here to pay again.</a></h3>
        <div class="payment_details">
            <?php
                $helper->printOutput('Customer details', $result->transaction->_attributes['customer']);
                $helper->printOutput('Billing details', $result->transaction->_attributes['billing']);
                $helper->printOutput('Shipping details', $result->transaction->_attributes['shipping']);
                $helper->printOutput('Transaction ID', $result->transaction->_attributes['id']);
                $helper->printOutput('Payment status', $result->transaction->_attributes['status']);
                $helper->printOutput('Payment type', $result->transaction->_attributes['type']);
                $helper->printOutput('Currency ISO code', $result->transaction->_attributes['currencyIsoCode']);
                $helper->printOutput('Payment amount', $result->transaction->_attributes['amount']);
            ?>
        </div>
    <?php
    }else{ ?>
        <h3>Sorry there was a problem with your payment :-(</h3>
        <div class="payment_details">
            <?php $helper->printOutput('Error message', $result->message); ?>
        </div>
        <h3><a href="../dropin?amt=50">Please click here to try again.</a></h3>
    <?php
    }
}else{ ?>
        <h3>No payment info received :-(</h3>
        <h3><a href="../dropin?amt=50">Please click here to try again.</a></h3>
<?php } ?>
</body>
</html>