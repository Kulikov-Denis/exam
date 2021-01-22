// Модуль работы с API-Login через ajax

function Authentication(user, password) {
    ajaxTemplate({
            name: "login.authentication",
            params: {
                password: password,
                user: user
            }
        }, false)
        .done((result) => {
            $.session.set('token', result.data);
            modalAuth.hide();
            start();
        })
        .fail((xhr) => {
            if (xhr.status == 401) modalOutput(xhr.responseJSON.error, $('#outputAuth'));
            toastOutput(xhr.responseJSON.error);
        });
};

function Authorization() {
    ajaxTemplate({
            name: "login.authorization",
            params: {
                token: $.session.get("token")
            }
        }, false)
        .done((result) => {
            $.session.set('token', result.data.token);
            start();
        })
        .fail(checkError);
}