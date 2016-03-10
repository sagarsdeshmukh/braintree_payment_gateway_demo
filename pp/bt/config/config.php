<?php

$urlPrefix = '/pp/bt/';

// include the Braintree.php library
define('THIS_PATH_FILE', realpath(dirname(__FILE__)));
define('PATH_TO_BRAINTREE', THIS_PATH_FILE . '/../braintree-php-2.35.2');
define('PATH_TO_BRAINTREE_LIBRARY', PATH_TO_BRAINTREE . '/lib/Braintree.php');
include(PATH_TO_BRAINTREE_LIBRARY);

// configure the braintree account environment and credentials
// environment is either sandbox or production
Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('373qwwjt3gvwqr3y');
Braintree_Configuration::publicKey('f49yxtw6cvs74r5x');
Braintree_Configuration::privateKey('0b479a88c3f300bbe048b7729d10506d');