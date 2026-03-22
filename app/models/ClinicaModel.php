<?php

require_once "ConexionModel.php";

class ClinicaModel {

    private $db;

    public function __construct()
    {
        $this->db = (new Conexion())->getPDO();
    }

    public function getAll()
    {
        $sql = "SELECT id, nombre, sede FROM clinicas";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
public function crear($nombre, $sede)
{
    $sql = "INSERT INTO clinicas (nombre, sede) 
            VALUES (:nombre, :sede)";

    $stmt = $this->db->prepare($sql);

    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':sede', $sede);

    return $stmt->execute();
}
public function eliminar($id)
{
    $sql = "DELETE FROM clinicas WHERE id = :id";

    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id', $id);

    return $stmt->execute();
}
public function getById($id)
{
    $sql = "SELECT id, nombre, sede 
            FROM clinicas 
            WHERE id = :id";

    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id',$id);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}


public function actualizar($id,$nombre,$sede)
{
    $sql = "UPDATE clinicas 
            SET nombre = :nombre,
                sede = :sede
            WHERE id = :id";

    $stmt = $this->db->prepare($sql);

    $stmt->bindParam(':id',$id);
    $stmt->bindParam(':nombre',$nombre);
    $stmt->bindParam(':sede',$sede);

    return $stmt->execute();
}
}
