<?php
class DB
{
    protected static $mysqli = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    public static function getInstance() // Одиночка для работы с BD
    {
        if (is_null(self::$mysqli)) {
            $config = require('DBHelper.config.php');
            $mysqli = new mysqli($config['host'], $config['username'], $config['password'], $config['database']);
            if ($mysqli->connect_error) die("$mysqli->connect_errno: $mysqli->connect_error");
            self::$mysqli = $mysqli;
            self::$mysqli->set_charset('utf8');
        }
        return self::$mysqli;
    }
    public static function query($sql)
    {
        return self::checkResult(self::$mysqli->query($sql));
    }

    public static function prepare($sql, $types, ...$gen)
    {
        try {
            $stmt = self::$mysqli->prepare($sql) or die("Ошибка подготовки запроса");

            foreach ($gen as &$value)
                $value = htmlspecialchars(strip_tags($value)); // Изменение синтаксиса

            $stmt->bind_param($types, ...$gen);
            $stmt->execute();
            return self::checkResult($stmt->get_result());
            $stmt->close();
        } catch (Exception $ex) {
            return false;
        }
    }
    public static function fetch($result)
    {
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function lastID()
    {
        return self::$mysqli->insert_id;
    }

    private static function checkResult($result)
    {
        return gettype($result) == "boolean" ? ($result ?: self::checkError() == 0) : self::fetch($result); // Проверка результата
    }

    public static function close()
    {
        self::$mysqli->close();
    }

    public static function checkError()
    {
        return self::$mysqli->errno;
    }
}
