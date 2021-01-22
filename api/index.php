<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

try {
    require_once('includes/API/API.error.class.php');

    $input = json_decode(stripcslashes(file_get_contents("php://input"))); // Получение data из потока данных
    if (!isset($input->name)) die(ApiError::GET(ApiError::NAME_NOT_FOUND)); // Если имя не обозначено, то ошибка

    list($className, $functionName) = explode('.', $input->name); // Разделение имени на класс и функцию 
    $params = isset($input->params) ? $input->params : null; // Получение параметров

    require_once('includes/API/API.main.class.php');

    if ($className == "login") die(json_encode((new APIMain($className, $functionName, $params))->callFunction())); // Все запросы к классу login без авторизации

    echo json_encode(array_merge(APIMain::authorization($params), (new APIMain($className, $functionName, $params))->callFunction())); // проверка авторизации + вызов функции
} catch (Exception $ex) {
    die(ApiError::GET(ApiError::GEN, $ex->getMessage()));
}
