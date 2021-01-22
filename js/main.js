let active = 1;

let ajax = null;

let tableTask = null;
let tableType = null;

let modalAuth = new bootstrap.Modal($('#modalAuth')[0], { backdrop: "static", keyboard: false });

// Главное

$(() => {
    if (!$.session.get("token"))
        modalAuth.show();
    else
        Authorization()
});

// Общее

$('.nav-link').on('click', function() {
    $('.input-filter').val(null);
    let activeNew = $(this).data('value');
    if (active != activeNew) {
        if (activeNew != 0)
            GetTasks(active, activeNew);
        else
            GetTypes(active);
        active = activeNew;
    } else {
        $('#tab-collapse').collapse('toggle');
    }
});

$('#newButtonType').on('click', function() {
    $('#modalTypeLabel').text('Добавление типа задачи');
});

$('.newButtonTask').on('click', function() {
    $('#modalTaskLabel').text('Добавление новой задачи');
});


// Функции

function start() {
    tableTask = tableTask ? tableTask : CreateTableTasks();
    tableType = tableType ? tableType : CreateTableTypes();

    GetTasks(0, 1).done(() => {
        GetTypes(0).done(() => {
            GetUsers().done(() => {
                $('.input-form').val(null);
            });
        });
    });
}

function toastOutput(error, isError = true) {
    let toast = $('#toastOutput');
    if (!isError) {
        toast.removeClass('bg-danger');
        toast.addClass('bg-success');
    } else {
        toast.removeClass('bg-success');
        toast.addClass('bg-danger');
    }
    $('#toastOutputText').text(error);
    toast.toast('show');
}

function checkError(xhr) {
    // if (xhr.status == 401) {}
    toastOutput(xhr.responseJSON.error);

    $('.modal').modal('hide'); // одноразовый токен
    modalAuth.show();
}