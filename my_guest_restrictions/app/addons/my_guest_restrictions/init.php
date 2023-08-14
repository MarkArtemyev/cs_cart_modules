<?php

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if (defined('PAYMENT_NOTIFICATION')) { return; }

fn_register_hooks(
    'checkout_add_product',
    'pre_place_order'
);