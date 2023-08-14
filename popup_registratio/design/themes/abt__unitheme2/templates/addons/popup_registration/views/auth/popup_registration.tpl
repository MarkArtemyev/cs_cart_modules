<script>
    $(document).ready(function() {
        $('#popup_registration_form').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: 'index.php?dispatch=auth.ajax_register',
                data: $(this).serialize(),
                success: function(data) {
                    if (data.result == 'ok') {
                        // Регистрация прошла успешно
                    } else {
                        // Ошибка регистрации
                    }
                }
            });
        });
    });
</script>
