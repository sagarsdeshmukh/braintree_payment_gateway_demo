<?php

include('../../config/config.php');
$txn_id = 'dgsjfy';
$refund_amount = 0;

// $transaction = Braintree_Transaction::find('9vr2zy');
try{
    $transaction = Braintree_Transaction::find($txn_id);
}catch(Exception $e){
    echo 'false';
}
echo '<h3>Total amount of transaction: ' . $transaction->_attributes['amount'] . '</h3>';

$refund_ids = $transaction->_attributes['refundIds'];

if($refund_ids !== null && count($refund_ids) > 0)
{
    $len = count($refund_ids);
    for($i=0; $i<$len; $i++)
    {
        $refund = Braintree_Transaction::find($refund_ids[$i]);
        var_dump($refund);
        // var_dump($refund->_attributes['createdAt']->date);
        $refund_amount = $refund_amount + $refund->_attributes['amount'];
    }
}

echo '<h3>Total amount refunded: ' .  $refund_amount . '</h3>';
