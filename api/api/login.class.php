<?php
// JWT import
require_once(dirname(__DIR__) . '/includes/JWT/BeforeValidException.php');
require_once(dirname(__DIR__) . '/includes/JWT/ExpiredException.php');
require_once(dirname(__DIR__) . '/includes/JWT/SignatureInvalidException.php');
require_once(dirname(__DIR__) . '/includes/JWT/JWT.php');

use \Firebase\JWT\JWT;

class login extends BaseClass
{
    function authorization($params)
    {
        if (isset($params->token)) {
            $token = self::tokenDecode($params->token); // Проверка сигнатуры токена
            if ($params->token == (DB::prepare("SELECT USERS_TOKEN FROM users WHERE PK_USERS=? LIMIT 1", "i", $token->id))[0]['USERS_TOKEN'])
                return array("token" => self::tokenEncode($token->id, $token->fio));  // Создание токена
        }
        die(ApiError::GET(ApiError::USER_OR_PASSWORD_NOT_VALID));
    }

    function authentication($params)
    {
        if (!isset($params->user) || !isset($params->password)) die(ApiError::GET(ApiError::PARAMS_NOT_FOUND));

        if (count($input = DB::prepare("SELECT PK_USERS, USERS_PASSWORD FROM users WHERE USERS_FIO=? LIMIT 1", "s", $params->user)) == 1) {
            if (password_verify($params->password, $input[0]['USERS_PASSWORD']))
                return self::tokenEncode($input[0]['PK_USERS'], $params->user);
        }
        die(ApiError::GET(ApiError::USER_OR_PASSWORD_NOT_VALID));
    }

    private static function tokenEncode($id, $fio)
    {
        require(dirname(__DIR__) . '/includes/JWT/JWT.config.php');

        $token = JWT::encode(array(
            "iat" => time(), 
            "exp" => time() + 60 * 60 * 15, // Время жизни токена 15 минут
            "id" => $id,
            "fio" => $fio
        ), $key);
        if (DB::prepare("UPDATE users SET USERS_TOKEN=? WHERE PK_USERS=?", "si", $token, $id))
            return $token;
        die(ApiError::GET(ApiError::USER_OR_PASSWORD_NOT_VALID));
    }

    private static function tokenDecode($token)
    {
        require(dirname(__DIR__) . '/includes/JWT/JWT.config.php');

        try {
            return JWT::decode($token, $key, array('HS256'));
        } catch (Exception $ex) {
            die(ApiError::GET(ApiError::USER_OR_PASSWORD_NOT_VALID));
        }
    }
}
