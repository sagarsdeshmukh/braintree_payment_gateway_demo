<?php

include('../../config/config.php');

$paymentToken = $_POST['tokenValue'];

$deleteTokenisedPayment = Braintree_PaymentMethod::delete($paymentToken);

echo json_encode($deleteTokenisedPayment);