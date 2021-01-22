// Модуль работы с API-Tasks через ajax

function GetTasks(last, status) {
    ajax = ajaxTemplate({
        name: "task.get",
        params: {
            status: status
        }
    });
    ajax.done((result) => {
            if (last == 0) {
                $('#tableTypeWrapper').addClass("d-none");
                $('#tableTaskWrapper').removeClass("d-none");
            }

            tableTask.clear();
            tableTask.rows.add(result.data);
            tableTask.column(4).visible(status > 1);
            tableTask.column(5).visible(status > 2);
            tableTask.draw();
        })
        .fail(checkError);
    return ajax;
};

function CreateTask(user, type, status, about) {
    ajax = ajaxTemplate({
        name: "task.create",
        params: {
            status: status,
            type: type,
            user: user,
            about: about
        }
    });
    ajax.done(() => {
            GetTasks(active, active);
            modalOutput("Новая задача успешно добавлена", $('#outputTask'), false);
        })
        .fail((xhr) => {
            if (xhr.status == 400) modalOutput(xhr.responseJSON.error, $('#outputTask'));
            checkError(xhr);
        });
    return ajax;
};

function UpdateTask(id, user, type, status, about) {
    ajax = ajaxTemplate({
        name: "task.update",
        params: {
            status: status,
            type: type,
            user: user,
            about: about,
            id: id
        }
    });
    ajax.done(() => {
            GetTasks(active, active);
            modalOutput("Задача успешно обновлена", $('#outputTask'), false);
        })
        .fail((xhr) => {
            if (xhr.status == 400) modalOutput(xhr.responseJSON.error, $('#outputTask'));
            checkError(xhr);
        });
    return ajax;
};

function DeleteTask(id) {
    ajax = ajaxTemplate({
        name: "task.delete",
        params: {
            id: id
        }
    });
    ajax.done(() => {
            GetTasks(active, active);
            toastOutput("Задача успешно удалена", false);
        })
        .fail(checkError);
    return ajax;
};