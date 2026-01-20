<?php

require_once __DIR__ . "/Conexion.php";

class ClinicasModel {

    private $db;

    public function __construct()
    {
        $this->db = new Conexion();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM clinicas";
        return $this->db->select($sql);
    }
}
