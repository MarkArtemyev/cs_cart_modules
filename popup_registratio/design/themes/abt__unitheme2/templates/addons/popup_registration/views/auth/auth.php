if ($mode == 'ajax_register') {
    $user_data = $_POST;
    $user_id = fn_popup_registration_create_user($user_data);

    if ($user_id) {
        Tygh::$app['ajax']->assign('result', 'ok');
    } else {
        Tygh::$app['ajax']->assign('result', 'error');
    }

    exit;
}
