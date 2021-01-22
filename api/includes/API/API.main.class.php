<?php

class APIMain
{
    protected $className = null;
    protected $functionName = null;
    protected $params = null;

    function __construct($className, $functionName, $params)
    {
        $this->className = $className;
        $this->functionName = $functionName;
        $this->params = $params;
    }

    static function getClassByName($className)
    {
        if (!file_exists(dirname(__DIR__, 2) . '/api/' . $className . '.class.php')) die(ApiError::GET(ApiError::NAME_NOT_VALID));

        try {
            require_once('API.base.class.php');
            require_once(dirname(__DIR__, 2) . '/api/' . $className . '.class.php');

            if (!class_exists($className)) die(ApiError::GET(ApiError::FILE_NOT_FOUND));

            return new $className(); // Создание экземпляра запрашиваемого класса
        } catch (Exception $ex) {
            die(ApiError::GET(ApiError::GEN, $ex->getMessage()));
        }
    }

    function callFunction()
    {
        if ($class = self::getClassByName($this->className)) {
            $function = $this->functionName;
            try {
                (new ReflectionClass($class))->getMethod($function);

                return array("data" => $class->$function($this->params)); // Вызов входной функции входного класса с параметрами
            } catch (ReflectionException $rex) {
                die(ApiError::GET(ApiError::NAME_NOT_VALID));
            } catch (Exception $ex) {
                die(ApiError::GET(ApiError::GEN, $ex->getMessage()));
            }
        }
    }

    static function authorization($params)
    {
        require_once('API.base.class.php');

        require_once(dirname(__DIR__, 2) . '/api/login.class.php');

        return (new login())->authorization($params); // Вызов авторизации в обход проверкам
    }
}
