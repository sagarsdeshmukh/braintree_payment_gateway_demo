<?php

class Helper
{
    
    private $nonce;

    private $amount;

    public $paymentMethodToken;

    public function __construct($nonce, $amount)
    {
        $this->nonce = $nonce;
        $this->amount = $amount;
    }

    public function bt_sale()
    {
        return Braintree_Transaction::sale(array(
            'amount' => $this->amount,
            'paymentMethodNonce' => $this->nonce,
            'customer' => array(
                'firstName' => 'Johnny',
                'lastName' => 'Begoode',
                'company' => 'BluesBros',
                'phone' => '01 28 28 20',
                'fax' => '01 28 28 21',
                'website' => 'http://www.johnnybegoode.com',
                'email' => 'johnybegoode@bluesbros.com'
            ),
            'billing' => array(
                'firstName' => 'Johnny',
                'lastName' => 'Begoode',
                'company' => 'BluesBros',
                'streetAddress' => '123 Hope St.',
                'extendedAddress' => 'Downtown',
                'locality' => 'Chicago',
                'countryName' => 'United States of America',
                'postalCode' => '901021',
                'countryCodeAlpha2' => 'US'
            ),
            'shipping' => array(
                'firstName' => 'Johnny',
                'lastName' => 'Begoode',
                'company' => 'BluesBros',
                'streetAddress' => '123 Hope St.',
                'extendedAddress' => 'Downtown',
                'locality' => 'Chicago',
                'countryName' => 'United States of America',
                'postalCode' => '901021',
                'countryCodeAlpha2' => 'US'
            ),
            'options' => array(
                'storeInVaultOnSuccess' => true,
                'submitForSettlement' => true
              )
        ));
    }

    public function bt_subscription()
    {
        return Braintree_Subscription::create(array(
            'paymentMethodToken' => $this->paymentMethodToken,
            'planId' => 'monthly_donation'
        ));
    }

    public function bt_create_pay_method()
    {
        return Braintree_PaymentMethod::create(array(
            'paymentMethodNonce' => $this->nonce,
            'customerId' => '60033487'
        ));
    }

    public function getPaymentDetails($result)
    {
        $payment_method = $result->paymentMethod;
        $title = 'Payment method (Paypal account email)';
        $accessor = 'email';

        if(strtolower(get_class($payment_method)) === 'braintree_creditcard')
        {
            $title = 'Payment method (credit card)';
            $accessor = 'maskedNumber';
        }

        $this->printOutput($title, $result->paymentMethod->_attributes[$accessor]);
    }

    public function printOutput($title, $output)
    {
         echo '<h4>' . $title . ': </h4><pre><code>'; var_dump($output); echo '</code></pre><br/>';
    }
}