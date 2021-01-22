let contextMenu = $('#contextMenu');
let lastRow = null;

// Обработчики

$('#dataTableTask').on("contextmenu", "tr", function(event) {
    actionContextMenu(tableTask.row(this), true, event);
});
$('#dataTableType').on("contextmenu", "tr", function(event) {
    actionContextMenu(tableType.row(this), false, event);
});

$(document).on('click', (event) => {
    contextMenu.addClass('d-none');
});

$(contextMenu).on('contextmenu', (event) => {
    event.preventDefault();
});

$('#contextUpdate').on('click', (event) => {
    let data = lastRow.data();
    if (lastRow.isTask) {
        $('#modalTaskLabel').text('Обновление задачи');

        let element = $('#modalTask');
        element.attr('data-id', lastRow.id());

        $('#inputFIOTask').val(data.user);
        $('#inputTypeTask').val(data.type);
        $('#inputStatusTask option[value="' + active + '"]').prop('selected', true);
        $('#inputAboutTask').val(data.about);

        element.modal('show');
    } else {
        $('#modalTypeLabel').text('Обновление типа задачи');

        let element = $('#modalType');
        element.attr('data-id', lastRow.id());

        $('#inputTypeType').val(data.name);

        element.modal('show');
    }
});

$('#contextDelete').on('click', (event) => {
    if (lastRow.isTask) {
        if (confirm('Вы уверены, что хотите удалить задачу?'))
            DeleteTask(lastRow.id());

    } else {
        if (confirm('Вы уверены, что хотите удалить тип задачи?'))
            DeleteType(lastRow.id());
    }
});

// Функции

function actionContextMenu(row, isTask, event) {
    lastRow = row;
    lastRow.isTask = isTask;

    if (lastRow.id()) {
        contextMenu.css('top', event.pageY + "px");
        contextMenu.css('left', (($(window).width() - 100) < event.pageX) ? event.pageX - 100 : event.pageX + "px");
        event.preventDefault();
        contextMenu.removeClass('d-none');
    }
}