<?php require_once('../config/config.php'); ?>
<style>.<?php echo $active ?>{background:#fff;}header ul li.<?php echo $active ?> a{color:#FF5757;}</style>
</head>
<body>
<header class="transition50">
    <ul><li class="dropinLi"><a href="<?php echo $urlPrefix; ?>dropin/">Dropin UI</a></li><li class="hostedLi"><a href="<?php echo $urlPrefix; ?>hosted_fields/">Hosted Fields</a></li><li class="addLi"><a href="<?php echo $urlPrefix; ?>create_payment_method_for_existing_customer/">Add Payment Method</a></li><li class="deleteLi"><a href="<?php echo $urlPrefix; ?>find_customer_from_vault/">Delete payment method</a></li><li class="findLi"><a href="<?php echo $urlPrefix; ?>find_transaction/">Find a transaction</a></li><li class="codeLi"><a href="<?php echo $urlPrefix; ?>braintree.zip/">Get the code</a></li></ul>
    <span class="close_menu">CLOSE</span>
</header>
<span class="mobile_menu">Menu</span>