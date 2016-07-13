<?php
class Database {

    public $DBH;

    const STATUS_NOT_DONE = 1;
    const STATUS_DONE = 2;
    const STATUS_ERROR = 3;

    /**
     * Коннект к базе
     */
    public function __construct()
    {
        $this->DBH = new PDO("mysql:host=localhost;dbname=spider", 'root', "");
    }

    /**
     * Добавляет задачу
     */
    public function addTask($pattern)
    {
        $STH = $this->DBH->prepare("INSERT INTO pool_tasks ( status, pattern) values (?, ?)");
        $status = self::STATUS_NOT_DONE;
        $STH->bindParam(1, $status);
        $STH->bindParam(2, $pattern);
        $STH->execute();
        $lastId = $this->DBH->lastInsertId();
        return $lastId;
    }

    /**
     * Добавляет файл в базу
     */
    public function addFile($path, $taskId)
    {
        $STH = $this->DBH->prepare("INSERT INTO files_for_tasks ( path, task_id, status) values (?, ?, ?)");
        $status = 1;

        $STH->bindParam(1, $path);
        $STH->bindParam(2, $taskId);
        $STH->bindParam(3, $status);
        $STH->execute();
        $lastId = $this->DBH->lastInsertId();
        return $lastId;
    }

    /**
     * Меняет статус файла на - "удален"
     */
    public function fileWasDelete($id)
    {
//        TODO:
    }
}