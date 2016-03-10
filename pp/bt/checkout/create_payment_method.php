<?php

include '../includes/header_generic.php';
include '../includes/header_close.php';
include '../model/Helper.php';
include '../model/Base.php';

if(isset($_POST) && isset($_POST['payment_method_nonce'])) {

    // Initialize the base class
    $base = new Base();

    // Get nonce from the POST
    $nonce = $base->getPost('payment_method_nonce');

    // Initialize the Braintree helper class with the nonce
    $helper = new Helper($nonce, null);

    // Make the Braintree Sale
    $result = $helper->bt_create_pay_method();

    if($result->success) {
    ?>
        <h3>You have just added a new payment method for customer ID <?php echo $result->paymentMethod->_attributes['customerId']; ?></h3>
        <div class="payment_details">
            <?php $helper->getPaymentDetails($result); ?>
            <h4><a href="../find_customer_from_vault/?customerId=<?php echo $result->paymentMethod->_attributes['customerId']; ?>">Click here to view and manage payament details for this customer</a></h4>
        </div>
    <?php
    }else{ ?>
        <h3>Sorry there was a problem :-(</h3>
        <div class="payment_details">
            <?php $helper->printOutput('Error message', $result->message); ?>            
        </div>
        <h3><a href="../create_payment_method_for_existing_customer/">Please click here to try again.</a></h3>
    <?php
    }
}else{ ?>
        <h3>No payment info received :-(</h3>
        <h3><a href="../create_payment_method_for_existing_customer/">Please click here to try again.</a></h3>
<?php } ?>
</body>
</html>