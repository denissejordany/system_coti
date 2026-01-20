<?php
class CotizacionModel {

    private $db;

    public function __construct() {
        $this->db = new Conexion();
    }

    public function guardarCliente($data)
{
    $sql = "INSERT INTO clientes (id_usuario, nombre, edad, genero, estado_salud, tipo_asegurado)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $this->db->getPDO()->prepare($sql);

    $stmt->execute([
        $data['id_usuario'],     // viene de la sesión o del formulario
        $data['nombre'],
        $data['edad'],
        $data['genero'],
        $data['estado_salud'],
        $data['tipo_asegurado']
    ]);

    return $this->db->getPDO()->lastInsertId();
}


public function guardarDependientes($idCliente, $dependientes, $tipoAsegurado)
{
    $sql = "INSERT INTO dependientes (id_cliente, nombre, edad, genero, estado_salud, tipo_asegurado)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $this->db->getPDO()->prepare($sql);

    foreach ($dependientes as $dep) {
        $stmt->execute([
            $idCliente,
            $dep['nombre'],
            $dep['edad'],
            $dep['genero'],
            $dep['estado_salud'],
            $tipoAsegurado     // el titular define el tipo asegurado
        ]);
    }
}

  public function guardarCobertura($data) {
    $sql = "INSERT INTO cobertura (tipo_cobertura, frecuencia_pago)
            VALUES (?, ?)";
    $stmt = $this->db->getPDO()->prepare($sql);
    $stmt->execute([
        $data['tipo_cobertura'],
        $data['frecuencia_pago']
    ]);

    return $this->db->getPDO()->lastInsertId();
}
public function guardarClinicasCobertura($idCobertura, $clinicas) {
    $sql = "INSERT INTO cobertura_clinicas (id_cobertura, id_clinica)
            VALUES (?, ?)";
    $stmt = $this->db->getPDO()->prepare($sql);

    foreach ($clinicas as $idClinica) {
        $stmt->execute([$idCobertura, $idClinica]);
    }
}


    public function guardarCotizacion($idCliente, $idCobertura, $idPlan) {
        $sql = "INSERT INTO cotizacion (id_cliente, id_cobertura, id_plan)
                VALUES (?, ?, ?)";
        $stmt = $this->db->getPDO()->prepare($sql);
        return $stmt->execute([$idCliente, $idCobertura, $idPlan]);
    }
}
