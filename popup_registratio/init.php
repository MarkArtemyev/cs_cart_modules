<?php
if (!defined('BOOTSTRAP')) { die('Access denied'); }

fn_register_hooks(
    'render_block_pre'
);

fn_register_routes(
    'auth.ajax_register', 
    'addons/popup_registration/controllers/frontend/auth.php', 
    'POST'
);
