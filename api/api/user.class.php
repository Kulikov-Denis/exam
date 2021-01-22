<?php
class user extends BaseClass
{
    function get()
    {
        return DB::query("SELECT PK_USERS as id, USERS_FIO AS name FROM users");
    }
}
