<?php

include('../config/config.php');

// generate the nonce and send it back
try
{
    $clientToken = Braintree_ClientToken::generate(array(
        // use customerId to get a previous customer from the vault
        // 'customerId' => '60033487'
    ));
}catch(Exception $e)
{
    // cannot get the customer from the vault!!
    $clientToken = Braintree_ClientToken::generate();
}

echo $clientToken;