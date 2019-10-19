<?php

abstract class _database {

    public $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=' . HOST . ';dbname=' . DATABASE, USER, PASSWORD, [PDO::ATTR_PERSISTENT => true]);
        } catch (PDOException $error) {
            exit("<p style='color:red;font-weight:bold;text-align:center'> There has been an error:<br/> " . $error->getMessage() . "</p>");
        }
    }
    public function add(fish_bowl $routing){
        $this->pretty($routing);
    }

}
