<?php
require_once "ConexionModel.php";

class PlanModel {
     private $db;
public function __construct()
    {
        $this->db = (new Conexion())->getPDO();
    }

    public function getAll()
    {
        $sql = "SELECT id, nombre FROM clinicas";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}