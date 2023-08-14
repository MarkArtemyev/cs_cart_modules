<?php
if (!defined('BOOTSTRAP')) { die('Access denied'); }

function fn_popup_registration_render_block_pre(&$block, &$block_content, &$template) {
    if ($block['type'] == 'main') {
        $block_content .= Tygh::$app['view']->fetch('addons/popup_registration/views/auth/popup_registration.tpl');
    }
}

function fn_popup_registration_create_user($user_data) {
    // Проверка наличия обязательных полей
    if (empty($user_data['email']) || empty($user_data['password'])) {
        return false;
    }

    // Проверка существования пользователя
    $is_exist = db_get_field("SELECT user_id FROM ?:users WHERE email = ?s", $user_data['email']);
    if (!empty($is_exist)) {
        return false;
    }

    // Создание нового пользователя
    $user_data['user_type'] = ($user_data['user_type'] == 'company') ? 'C' : 'P';
    $user_id = fn_update_user(0, $user_data, $auth, false, false);

    return $user_id;
}
