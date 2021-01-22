// Модуль базовой работы с API через ajax

function ajaxTemplate(data, addToken = true) {
    if (addToken)
        data.params.token = $.session.get("token");
    return $.ajax({
        url: 'api/',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: (result) => {
            if (addToken)
                $.session.set("token", result.token);
        },
        error: console.log
    });
};