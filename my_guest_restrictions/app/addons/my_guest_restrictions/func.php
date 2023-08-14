<?php

if (!defined('BOOTSTRAP')) { die('Access denied'); }

// Хук, который запрещает гостям добавлять товары в корзину и выводит промо-текст для регистрации
function fn_my_guest_restrictions_checkout_add_product($product_data, $cart, $auth)
{
    if (!$auth['user_id']) { // Если пользователь не авторизован
        fn_set_notification('W', __('warning'), __('register_to_add_items_notification'));
        fn_redirect('auth.login_form');
    }
}

// Хук, который проверяет минимальную цену для оформления заказа незарегистрированных пользователей
function fn_my_guest_restrictions_pre_place_order(&$order, &$cart, &$auth)
{
    if (!$auth['user_id']) { // Если пользователь не авторизован
        $enable_minimum_order_price = fn_get_setting('enable_minimum_order_price', 'my_guest_restriction_settings');
        $minimum_order_price = fn_get_setting('minimum_order_price', 'my_guest_restriction_settings');

        if ($enable_minimum_order_price && $cart['subtotal'] < $minimum_order_price) {
            fn_set_notification('E', __('error'), __('minimum_order_price_notification', ['price' => $minimum_order_price]));
            fn_redirect('checkout.cart');
        }
    }
}

// Хук для добавления настроек модуля в админ-панель
function fn_my_guest_restrictions_get_settings($company_id, $lang_code)
{
    return array(
        'enable_guest_restriction' => array(
            'value' => fn_get_setting('enable_guest_restriction', 'my_guest_restriction_settings'),
            'tab' => 'my_guest_restriction_settings',
            'field_type' => 'checkbox',
            'name' => __('enable_guest_restriction')
        ),
        'registration_promo_text' => array(
            'value' => fn_get_setting('registration_promo_text', 'my_guest_restriction_settings'),
            'tab' => 'my_guest_restriction_settings',
            'field_type' => 'textarea',
            'name' => __('registration_promo_text')
        ),
        'enable_minimum_order_price' => array(
            'value' => fn_get_setting('enable_minimum_order_price', 'my_guest_restriction_settings'),
            'tab' => 'my_guest_restriction_settings',
            'field_type' => 'checkbox',
            'name' => __('enable_minimum_order_price')
        ),
        'minimum_order_price' => array(
            'value' => fn_get_setting('minimum_order_price', 'my_guest_restriction_settings'),
            'tab' => 'my_guest_restriction_settings',
            'field_type' => 'text',
            'name' => __('minimum_order_price')
        )
    );
}

// Хук для сохранения настроек модуля из админ-панели
function fn_my_guest_restrictions_update_settings($settings, $lang_code, $company_id)
{
    foreach ($settings as $key => $value) {
        fn_update_setting($key, $value, 'my_guest_restriction_settings', 'Y');
    }
}
