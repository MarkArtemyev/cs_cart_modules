<?php
if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($mode == 'register') {
    if (!empty($_REQUEST['user_data'])) {
        $user_data = $_REQUEST['user_data'];
        $user_id = fn_update_user(0, $user_data, $auth, true, false);

        if (!empty($user_id)) {
            if (!empty($_REQUEST['return_url'])) {
                return array(CONTROLLER_STATUS_OK, $_REQUEST['return_url']);
            }

            return array(CONTROLLER_STATUS_OK, 'index.index');
        }
    }

    Tygh::$app['view']->assign('errors', __('text_registration_failed'));
    Tygh::$app['view']->assign('user_data', $_REQUEST['user_data']);
    Tygh::$app['view']->assign('auth', $auth);
    Tygh::$app['view']->assign('show_registration_popup', true);
    Tygh::$app['view']->display('auth/register_form.tpl');
}
