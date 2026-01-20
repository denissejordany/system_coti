<?php
require_once "Conexion.php";

class Login extends Conexion {

    public function __construct() {
        parent::__construct();
    }

 public function loginUsuario($dni, $password) {
    // Buscar solo por DNI
    $sql = "SELECT * FROM usuarios WHERE dni = :dni LIMIT 1";
    $query = $this->pdo->prepare($sql);
    $query->bindParam(':dni', $dni);
    $query->execute();

    $user = $query->fetch();

    // Si el usuario existe, verificar contraseña
    if ($user && password_verify($password, $user['password'])) {
        return $user; // Login correcto
    }

    return false; // Login incorrecto
}

    public function usuarioExiste($dni)
{
    $sql = "SELECT id FROM usuarios WHERE dni = :dni LIMIT 1";
    $query = $this->pdo->prepare($sql);
    $query->bindParam(':dni', $dni);
    $query->execute();

    return $query->fetch();
}

public function registrar($dni, $password, $cod_asesor)
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
