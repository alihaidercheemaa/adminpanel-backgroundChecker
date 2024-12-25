
let login = () => {
    let forms = $('.loginForm');
    let fields = ['email', 'password'];
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
        const data = {
            email: $("#email").val(),
            password: $("#password").val(),
            requestType: 'login'
        };
        $('#loginBtn').attr('disabled', true).text('Please wait....');
        $.post('datafiles/auth', data, function (response) {
            var result = JSON.parse(response);
            $('#loginBtn').attr('disabled', false).text('Sign in');
            if (result.status == 1) {
                Notification('success', 'Success!', `${result.message}`);
                setInterval(() => {
                    window.location.href = '/dashboard';
                }, 1000);
            } else {
                Notification('danger', 'Error!', `${result.message}`);
            }
        });
    }
};