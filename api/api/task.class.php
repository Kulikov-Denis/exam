<?php
date_default_timezone_set('Etc/GMT-5');

class task extends BaseClass
{
    function get($params)
    {
        if (isset($params->status)) {
            switch ($params->status) {
                case 1:
                    return DB::query("SELECT tasks.PK_TASKS AS id, users.USERS_FIO AS user, task_types.TYPES_NAME as type, tasks.TASKS_ABOUT as about, tasks.TASKS_DATEADD as dateAdd, null as dateStart, null as dateEnd FROM tasks INNER JOIN users ON tasks.FK_USERS = users.PK_USERS INNER JOIN task_types ON tasks.FK_TYPES = task_types.PK_TYPES INNER JOIN task_statuses ON tasks.FK_STATUSES = task_statuses.PK_STATUSES WHERE task_statuses.PK_STATUSES=1");
                case 2:
                    return DB::query("SELECT tasks.PK_TASKS AS id, users.USERS_FIO AS user, task_types.TYPES_NAME as type, tasks.TASKS_ABOUT as about, tasks.TASKS_DATEADD as dateAdd, tasks.TASKS_DATESTART as dateStart, null as dateEnd FROM tasks INNER JOIN users ON tasks.FK_USERS = users.PK_USERS INNER JOIN task_types ON tasks.FK_TYPES = task_types.PK_TYPES INNER JOIN task_statuses ON tasks.FK_STATUSES = task_statuses.PK_STATUSES WHERE task_statuses.PK_STATUSES=2");
                case 3:
                    return DB::query("SELECT tasks.PK_TASKS AS id, users.USERS_FIO AS user, task_types.TYPES_NAME as type, tasks.TASKS_ABOUT as about, tasks.TASKS_DATEADD as dateAdd, tasks.TASKS_DATESTART as dateStart, tasks.TASKS_DATECOMPLETE as dateEnd FROM tasks INNER JOIN users ON tasks.FK_USERS = users.PK_USERS INNER JOIN task_types ON tasks.FK_TYPES = task_types.PK_TYPES INNER JOIN task_statuses ON tasks.FK_STATUSES = task_statuses.PK_STATUSES WHERE task_statuses.PK_STATUSES=3");
                default:
                    die(ApiError::GET(ApiError::PARAMS_NOT_VALID));
            }
        }
        die(ApiError::GET(ApiError::PARAMS_NOT_FOUND));
    }
    function create($params)
    {
        if (isset($params->user) && isset($params->type) && isset($params->status) && isset($params->about)) {
            $status = $params->status;
            $date = date("Y-m-d");
            switch ($status) {
                case 3:
                    if (DB::prepare("INSERT INTO tasks(FK_USERS, FK_TYPES, FK_STATUSES, TASKS_DATEADD, TASKS_DATESTART, TASKS_DATECOMPLETE, TASKS_ABOUT) VALUES (?,?,?,?,?,?,?)", "iiissss", $params->user, $params->type, $status, $date, $date, $date, $params->about))
                        return true;
                    break;
                case 2:
                    if (DB::prepare("INSERT INTO tasks(FK_USERS, FK_TYPES, FK_STATUSES, TASKS_DATEADD, TASKS_DATESTART, TASKS_DATECOMPLETE, TASKS_ABOUT) VALUES (?,?,?,?,?,null,?)", "iiisss", $params->user, $params->type, $status, $date, $date, $params->about))
                        return true;
                    break;
                case 1:
                    if (DB::prepare("INSERT INTO tasks(FK_USERS, FK_TYPES, FK_STATUSES, TASKS_DATEADD, TASKS_DATESTART, TASKS_DATECOMPLETE, TASKS_ABOUT) VALUES (?,?,?,?,null,null,?)", "iiiss", $params->user, $params->type, $status, $date, $params->about))
                        return true;
                    break;
            }
            die(ApiError::GET(ApiError::PARAMS_NOT_VALID));
        }
        die(ApiError::GET(ApiError::PARAMS_NOT_FOUND));
    }

    function update($params)
    {
        if (isset($params->id) && isset($params->user) && isset($params->type) && isset($params->status) && isset($params->about)) {
            $status = $params->status;
            if ($dataOld = DB::prepare("SELECT TASKS_DATESTART, TASKS_DATECOMPLETE FROM tasks WHERE PK_TASKS=?", "i", $params->id)) {
                $dataOld = $dataOld[0];
                switch ($status) {
                    case 3:
                        if (DB::prepare("UPDATE tasks SET FK_USERS=?, FK_TYPES=?,FK_STATUSES=?,TASKS_ABOUT=?, TASKS_DATESTART=?, TASKS_DATECOMPLETE=? WHERE PK_TASKS=?", "iiisssi", $params->user, $params->type, $status, $params->about, $dataOld["TASKS_DATESTART"] ?? date("Y-m-d"), $dataOld["TASKS_DATECOMPLETE"] ?? date("Y-m-d"), $params->id))
                            return true;
                        break;
                    case 2:
                        if (DB::prepare("UPDATE tasks SET FK_USERS=?, FK_TYPES=?,FK_STATUSES=?,TASKS_ABOUT=?, TASKS_DATESTART=?, TASKS_DATECOMPLETE=null WHERE PK_TASKS=?", "iiissi", $params->user, $params->type, $status, $params->about, $dataOld["TASKS_DATESTART"] ?? date("Y-m-d"), $params->id))
                            return true;
                        break;
                    case 1:
                        if (DB::prepare("UPDATE tasks SET FK_USERS=?, FK_TYPES=?,FK_STATUSES=?,TASKS_ABOUT=?, TASKS_DATESTART=null, TASKS_DATECOMPLETE=null WHERE PK_TASKS=?", "iiisi", $params->user, $params->type, $status, $params->about, $params->id))
                            return true;
                        break;
                }
            }
            die(ApiError::GET(ApiError::PARAMS_NOT_VALID));
        }
        die(ApiError::GET(ApiError::PARAMS_NOT_FOUND));
    }

    function delete($params)
    {
        if (isset($params->id)) {
            if (DB::prepare("DELETE FROM tasks WHERE PK_TASKS=?", "i", $params->id))
                return true;
            die(ApiError::GET(ApiError::PARAMS_NOT_VALID));
        }
        die(ApiError::GET(ApiError::PARAMS_NOT_FOUND));
    }
}
