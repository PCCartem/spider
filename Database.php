<?php
class Database {

    public $DBH;

    public function __construct()
    {
        $this->DBH = new PDO("mysql:host=localhost;dbname=concole", 'root', "");
    }
}