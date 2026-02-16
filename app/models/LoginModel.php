<?php
require_once "ConexionModel.php";

class LoginModel extends Conexion {

    public function __construct() {
        parent::__construct();
    }

public function loginUsuario($dni, $password) {

    $sql = "SELECT * FROM usuarios WHERE dni = :dni LIMIT 1";

    $query = $this->pdo->prepare($sql);
    $query->bindParam(':dni', $dni);
    $query->execute();

    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        return $user;
    }

    return false;
}

 public function usuarioExiste($dni)
{
    $sql = "SELECT id FROM usuarios WHERE dni = :dni LIMIT 1";
    $query = $this->pdo->prepare($sql);
    $query->bindParam(':dni', $dni);
    $query->execute();

    return $query->fetch();
}

public function registrarUser($dni, $password, $cod_asesor)
{
    $sql = "INSERT INTO usuarios (dni, password, cod_asesor, id_rol)
            VALUES (:dni, :password, :cod_asesor, 2)";

    $query = $this->pdo->prepare($sql);
    $query->bindParam(':dni', $dni);

    // Encriptar contraseña
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $query->bindParam(':password', $passwordHash);

    $query->bindParam(':cod_asesor', $cod_asesor);

    return $query->execute();
}


}

