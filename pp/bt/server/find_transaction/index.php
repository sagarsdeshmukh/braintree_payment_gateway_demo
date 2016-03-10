<?php

include('../../config/config.php');
if(isset($_POST['txn_id']) && $_POST['txn_id'] !== ''){
    $txn_id = $_POST['txn_id'];
}else{
    $txn_id = 'dgsjfy';
}

try{
    $transaction = Braintree_Transaction::find($txn_id);
    echo json_encode($transaction->_attributes);
}catch(Exception $e){
    echo 'false';
}