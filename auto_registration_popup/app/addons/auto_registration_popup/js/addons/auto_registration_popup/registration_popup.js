Tygh.$(document).ready(function() {
    Tygh.ajaxPopup({
        url: Tygh.fn.url('auth.register_form'),
        title: Tygh.tr('register'),
        width: 600,
        callbacks: {
            onClose: function() {
                location.reload();
            }
        }
    });
});
