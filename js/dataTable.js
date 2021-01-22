// Вспомогательный функцилнал по DataTable

function CreateTableTasks() {
    return $('#dataTableTask').DataTable({
        autoWidth: true,
        dom: "<'row'<'col px-0'tr>>" +
            "<'row'<'col mb-3'i><'col mb-3'p>>", // шаблон генерации таблицы 
        pageLength: 20, // Максимальная длина 
        rowId: 'id', //Присваевания row id из постпления data
        order: [
            [1, 'asc']
        ],
        columns: [
            { title: "№", data: null, render: null, orderable: false }, // Название столбца, универсальные данные, target парсинга данных из data
            { title: "Пользователь", data: null, render: 'user' },
            { title: "Тип задачи", data: null, render: 'type' },
            { title: "Дата постановки задач", data: null, render: 'dateAdd', type: "date" },
            { title: "Дата приема задачи", data: null, render: 'dateStart', type: "date" },
            { title: "Дата исполения задачи", data: null, render: 'dateEnd', type: "date" },
            { title: "Описание задачи", data: null, render: 'about', visible: false }
        ],
        rowCallback: function(row, data, index) {
            var api = this.api();
            $('td:eq(0)', row).html(index + (api.page() * api.page.len() + 1)); // Создание динамического номера

            $('td:eq(3)', row).html(new Date(Date.parse(data.dateAdd)).toLocaleString([], { dateStyle: 'short' })); // Динамическое отбражение даты
            $('td:eq(4)', row).html(new Date(Date.parse(data.dateStart)).toLocaleString([], { dateStyle: 'short' }));
            $('td:eq(5)', row).html(new Date(Date.parse(data.dateEnd)).toLocaleString([], { dateStyle: 'short' }));
        },
        language: { // Подключение русского языка
            url: '/includes/DataTables/DataTables.lang.json'
        }
    });
}

function CreateTableTypes() {
    return $('#dataTableType').DataTable({
        autoWidth: true,
        dom: "<'row'<'col px-0'tr>>" +
            "<'row'<'col mb-3'i><'col mb-3'p>>",
        pageLength: 20,
        rowId: 'id',
        order: [
            [1, 'asc']
        ],
        columns: [
            { title: "№", data: null, render: null, orderable: false },
            { title: "Название типа", data: null, render: 'name' }
        ],
        rowCallback: function(row, data, index) {
            var api = this.api();
            $('td:eq(0)', row).html(index + (api.page() * api.page.len() + 1));
        },
        language: {
            url: '/includes/DataTables/DataTables.lang.json'
        }
    });
}

$.fn.dataTable.ext.search.push((settings, data) => { // Функция фильтрации таблиц
    if (settings.nTable.id == 'dataTableType') return true;

    let userFilter = null;
    let typeFilter = null;
    let result = true;

    if (active == 3) {
        userFilter = $('#userEnd').val();
        typeFilter = $('#typeEnd').val();

        result = dateFilter(data[3], $('#startDateNewEnd').val(), $('#endDateNewEnd').val()) && result; // Фильтр по дате (начало и конец)
        result = dateFilter(data[4], $('#startDateStartEnd').val(), $('#endDateStartEnd').val()) && result;
        result = dateFilter(data[5], $('#startDateEndEnd').val(), $('#endDateEndEnd').val()) && result;
    }

    if (active == 2) {
        userFilter = $('#userStart').val();
        typeFilter = $('#typeStart').val();

        result = dateFilter(data[3], $('#startDateNewStart').val(), $('#endDateNewStart').val()) && result;
        result = dateFilter(data[4], $('#startDateStartStart').val(), $('#endDateStartStart').val()) && result;
    }

    if (active == 1) {
        userFilter = $('#userNew').val();
        typeFilter = $('#typeNew').val();

        result = dateFilter(data[3], $('#startDateNewNew').val(), $('#endDateNewNew').val()) && result;
    }

    result = userFilter ? new RegExp(userFilter, 'i').test(data[1]) && result : result; // Проверка на содержание target в cell
    result = typeFilter ? new RegExp(typeFilter, 'i').test(data[2]) && result : result;

    return result;
});

// Функции

function dateFilter(dateIsFilted, dateFilterStart, dateFilterEnd) {
    let result = true;

    date = new Date(Date.parse(dateIsFilted));

    if (dateFilterStart != '')
        result = (new Date(Date.parse(dateFilterStart)) <= date) && result;
    if (dateFilterEnd != '')
        result = (new Date(Date.parse(dateFilterEnd)) >= date) && result;

    return result;
}

// Обработчики

$('.input-filter').on('change', () => {
    tableTask.draw(); // Пересобрать таблицу (Фильтрация)
});