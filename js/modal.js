// Обработка выполения формы


// Форма аунтификации

$('#formAuth').on('submit', function() {
    if ($(this)[0].checkValidity())
        Authentication($('#inputFIOAuth').val(), sha256($('#inputPasswordAuth').val())) // Шифровка паролья после ввода
    else
        $(this).addClass('was-validated');
});

// Форма типа задачи

$('#formType').on('submit', function() {
    if ($(this)[0].checkValidity()) {
        let id = $('#modalType').attr('data-id');
        if (!id) {
            CreateType($('#inputTypeType').val())
        } else {
            UpdateType(id, $('#inputTypeType').val());
        }
    } else
        $(this).addClass('was-validated');
});

// Форма задачи

$('#formTask').on('submit', function() {
    if ($(this)[0].checkValidity()) {
        let id = $('#modalTask').attr('data-id');
        if (!id) {
            CreateTask($('#inputFIOTask option:selected').data('value'), $('#inputTypeTask option:selected').data('value'), $('#inputStatusTask option:selected').val(), $('#inputAboutTask').val());
        } else {
            UpdateTask(id, $('#inputFIOTask option:selected').data('value'), $('#inputTypeTask option:selected').data('value'), $('#inputStatusTask option:selected').val(), $('#inputAboutTask').val());
        }
    } else
        $(this).addClass('was-validated');
});

// Обработчики

$('.clearBtn').on('click', clear);
$('.modal').on('hidden.bs.modal', function() {
    clear();
    $(this).attr("data-id", null);
});

// Функции

function clear() {
    $('.was-validated').removeClass('was-validated');
    $('.input-form').val(null);
    $('.output').collapse('hide');
}

function modalOutput(text, output, isError = true) {
    if (!isError) {
        output.removeClass('alert-danger');
        output.addClass('alert-success');
    } else {
        output.removeClass('alert-success');
        output.addClass('alert-danger');
    }
    output.text(text);
    output.parent().collapse('show');
}