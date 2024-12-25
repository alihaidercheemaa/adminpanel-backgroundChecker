const changePassword = () => {
    let forms = $('.changePasswordForm');
    let fields = ['old_password', 'new_password', 'confirm_password'];
    let isValid = true;
    forms.each(function () {
        if (!this.checkValidity()) {
            isValid = false;
            fields.forEach(field => {
                let value = $(`#${field}`).val();
                (value == '') ? $(`#${field}`).addClass('is-invalid') : $(`#${field}`).removeClass('is-invalid');
            });
        }
    });
    if (isValid) {
        if ($("#confirm_password").val() != $("#new_password").val()) {
            Notification('danger', 'Error!', 'New Password and Confirm Password does not Matched');
            return false;
        }
        const data = {
            old_password: $("#old_password").val(),
            new_password: $("#new_password").val(),
            confirm_password: $("#confirm_password").val(),
            requestType: 'change_password'
        };
        $.post('datafiles/auth', data, function (response) {
            const result = JSON.parse(response);
            if (result.status == 1) {
                window.location.href = '/login';
                Notification('success', 'Success', `${result.message}`);
            } else {
                Notification('danger', 'Error!', `${result.message}`);
            }
        });
    }
};