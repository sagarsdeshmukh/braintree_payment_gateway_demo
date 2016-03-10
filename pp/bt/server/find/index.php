<?php

include('../../config/config.php');
if(isset($_GET) && isset($_GET['id'])){
    $cId = $_GET['id'];
}else{
    $cId = '50833033';
}

try
{
    $customer = Braintree_Customer::find($cId);
}catch(Exception $e)
{
    $customer = Braintree_Customer::find('50833033');    
}


echo json_encode(array(
    'creditCards' => $customer->creditCards,
    'ppAccounts' => $customer->paypalAccounts,
    'name' => array(
        'first' => $customer->firstName,
        'last' => $customer->lastName
        )
    ));