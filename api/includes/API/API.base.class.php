<?php
class BaseClass
{
    function __construct()
    {
        require_once (dirname(__DIR__) .'/MySQL/DBHelper.class.php');
        DB::getInstance();
    }

    function __destruct()
    {
        // DB::close();
    }
}
