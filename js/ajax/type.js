// Модуль работы с API-Type через ajax

function GetTypes(last) {
    ajax = ajaxTemplate({
        name: "type.get",
        params: {}
    });
    ajax.done((result) => {
            if (last != 0) {
                $('#tableTaskWrapper').addClass("d-none");
                $('#tableTypeWrapper').removeClass("d-none");
            }

            let types = $('#types, #inputTypeTask');
            types.html(null);
            result.data.forEach(element => {
                types.append('<option data-value=' +
                    element.id + ' > ' +
                    element.name + ' </option>');
            });
            types.val(null);

            tableType.clear();
            tableType.rows.add(result.data);
            tableType.draw();
        })
        .fail(checkError);
    return ajax;
};

function CreateType(name) {
    ajax = ajaxTemplate({
        name: "type.create",
        params: {
            name: name
        }
    });
    ajax.done(() => {
            GetTypes(0);
            modalOutput("Новый тип задачи успешно добавлен", $('#outputType'), false);
        })
        .fail((xhr) => {
            if (xhr.status == 400) modalOutput(xhr.responseJSON.error, $('#outputType'));
            checkError(xhr);
        });
    return ajax;
};

function UpdateType(id, name) {
    ajax = ajaxTemplate({
        name: "type.update",
        params: {
            name: name,
            id: id
        }
    });
    ajax.done(() => {
            GetTypes(0);
            modalOutput("Тип задачи успешно обновлен", $('#outputType'), false);
        })
        .fail((xhr) => {
            if (xhr.status == 400) modalOutput(xhr.responseJSON.error, $('#outputType'));
            checkError(xhr);
        });
    return ajax;
};

function DeleteType(id) {
    ajax = ajaxTemplate({
        name: "type.delete",
        params: {
            id: id
        }
    });
    ajax.done(() => {
            GetTypes(0);
            toastOutput("Тип задачи успешно удален", false);
        })
        .fail(checkError);
    return ajax;
};