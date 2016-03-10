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

    // vault this payment method before we can create a subscription
    $payment_method = $helper->bt_create_pay_method();
    if($payment_method->success === true) {

        $helper->paymentMethodToken = $payment_method->paymentMethod->_attributes['token'];
    }

    // Make a subscription and use the above payment method token
    $result = $helper->bt_subscription();

    if($result->success) {
    ?>
        <h3>Thank you for your monthly subscription of $ <?php echo $result->subscription->_attributes['price']; ?> ! We appreciate your support.</h3>
        <h3>This is the subscription ID: <?php echo $result->subscription->_attributes['id']; ?></h3>
        <h3><a href="../dropin">Click here to pay again.</a></h3>
        <div class="payment_details">
            <?php
                $helper->printOutput('Billing day of the month', $result->subscription->_attributes['billingDayOfMonth']);
                $helper->printOutput('Billing period start date', $result->subscription->_attributes['billingPeriodStartDate']->format('d/m/Y H:i:s'));
                $helper->printOutput('Billing period end date', $result->subscription->_attributes['billingPeriodEndDate']->format('d/m/Y H:i:s'));
                $helper->printOutput('Transaction ID', $result->subscription->_attributes['id']);
                $helper->printOutput('Payment status', $result->subscription->_attributes['status']);
                $helper->printOutput('Current subscription balance', $result->subscription->_attributes['balance']);
                $helper->printOutput('First billing date', $result->subscription->_attributes['firstBillingDate']->format('d/m/Y H:i:s'));
                $helper->printOutput('Next billing date', $result->subscription->_attributes['nextBillingDate']->format('d/m/Y H:i:s'));
                $helper->printOutput('Number of billing cycles', $result->subscription->_attributes['numberOfBillingCycles']);
                $helper->printOutput('Payment method token', $result->subscription->_attributes['paymentMethodToken']);
                $helper->printOutput('Plan ID', $result->subscription->_attributes['planId']);
                $helper->printOutput('Trial period?', $result->subscription->_attributes['trialPeriod']);
                if($result->subscription->_attributes['trialPeriod']) {
                    $helper->printOutput('Trial duration?', $result->subscription->_attributes['trialDuration']);
                }
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