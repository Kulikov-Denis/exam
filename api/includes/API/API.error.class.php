<?php
class ApiError
{
    const NAME_NOT_FOUND = 400;
    const USER_OR_PASSWORD_NOT_VALID = 401;
    const RQUEST_NOT_FOUND = 404;
    const NAME_NOT_VALID = 405;
    const PARAMS_NOT_FOUND = 406;
    const PARAMS_NOT_VALID = 412;

    const GEN = 500;
    const FILE_NOT_FOUND = 501;

    static function GET($number, $text = null)
    {
        http_response_code(self::GET_NUMBER($number));
        return json_encode(array("error" => $text ?: self::GET_TEXT($number)));
    }

    static function GET_TEXT($number)
    {
        switch ($number) {
            case self::NAME_NOT_FOUND:
                return "Имя не задано";
            case self::USER_OR_PASSWORD_NOT_VALID:
                return "Пользователь или пароль не верны";
            case self::RQUEST_NOT_FOUND:
                return "Отсутствует запрос";
            case self::NAME_NOT_VALID:
                return "Имя не верно";
            case self::PARAMS_NOT_FOUND:
                return "Отсутствуют параметры";
            case self::FILE_NOT_FOUND:
                return "Файл не найден";
            case self::PARAMS_NOT_VALID:
                return "Параметры не верны";
        }
    }

    static function GET_NUMBER($number)
    {
        switch ($number) {
            case self::PARAMS_NOT_FOUND:
            case self::PARAMS_NOT_VALID:
                return 400;
            case self::NAME_NOT_FOUND:
            case self::RQUEST_NOT_FOUND:
                return 404;
            case self::USER_OR_PASSWORD_NOT_VALID:
                return 401;
            case self::NAME_NOT_VALID:
                return 405;
            case self::GEN:
                return 500;
            case self::FILE_NOT_FOUND:
                return 501;
        }
    }
}
