<?php
if (!defined('BOOTSTRAP')) { die('Access denied'); }

if (!Tygh::$app['session']['auth']['user_id']) {
    Tygh::$app['view']->assign('show_registration_popup', true);
}
