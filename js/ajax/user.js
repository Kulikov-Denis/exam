// Модуль работы с API-User через ajax

function GetUsers() {
    ajax = ajaxTemplate({
        name: "user.get",
        params: {}
    });
    ajax.done((result) => {
            let users = $('#users, #inputFIOTask');
            users.html(null);
            result.data.forEach(element => {
                users.append('<option data-value=' +
                    element.id + ' > ' +
                    element.name + ' </option>');
            });
            users.val(null);
        })
        .fail(checkError);
    return ajax;
};