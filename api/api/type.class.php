<?php
class type extends BaseClass
{
    function get()
    {
        return DB::query("SELECT PK_TYPES AS id, TYPES_NAME AS name FROM task_types");
    }

    function create($params)
    {
        if (isset($params->name)) {
            if (DB::prepare("INSERT INTO task_types(TYPES_NAME) VALUES (?)", "s", $params->name))
                return true;
            die(ApiError::GET(ApiError::PARAMS_NOT_VALID));
        }
        die(ApiError::GET(ApiError::PARAMS_NOT_FOUND));
    }

    function update($params)
    {
        if (isset($params->id) && isset($params->name)) {
            if (DB::prepare("UPDATE task_types SET TYPES_NAME=? WHERE PK_TYPES=?", "si", $params->name, $params->id))
                return true;
            die(ApiError::GET(ApiError::PARAMS_NOT_VALID));
        }
        die(ApiError::GET(ApiError::PARAMS_NOT_FOUND));
    }

    function delete($params)
    {
        if (isset($params->id)) {
            if (DB::prepare("DELETE FROM task_types WHERE PK_TYPES=?", "i", $params->id))
                return true;
            die(ApiError::GET(ApiError::PARAMS_NOT_VALID));
        }
        die(ApiError::GET(ApiError::PARAMS_NOT_FOUND));
    }
}
