<?php
require_once "ConexionModel.php";

class UserModel extends Conexion {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Obtiene todos los usuarios para el listado del index
     */
    public function getAll() {
        try {
            $sql = "SELECT id, dni, cod_asesor, id_rol FROM usuarios ORDER BY id DESC";
            $query = $this->pdo->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en UserModel::getAll -> " . $e->getMessage());
            return [];
        }
    }

    /**
     * Crea un nuevo usuario con contraseña encriptada
     */
    public function crear($dni, $password, $cod_asesor, $id_rol) {
        try {
            $sql = "INSERT INTO usuarios (dni, password, cod_asesor, id_rol) 
                    VALUES (:dni, :password, :cod_asesor, :id_rol)";
            
            $query = $this->pdo->prepare($sql);
            
            // Encriptación segura (estilo React/SaaS moderno)
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            
            $query->bindParam(':dni', $dni);
            $query->bindParam(':password', $passwordHash);
            $query->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);

            // Manejo de nulos para el código de asesor
            if (empty($cod_asesor)) {
                $query->bindValue(':cod_asesor', null, PDO::PARAM_NULL);
            } else {
                $query->bindParam(':cod_asesor', $cod_asesor);
            }

            return $query->execute();
        } catch (PDOException $e) {
            error_log("Error en UserModel::crear -> " . $e->getMessage());
            return false;
        }
    }

    public function usuarioExiste($dni) {
        try {
            $sql = "SELECT id FROM usuarios WHERE dni = :dni LIMIT 1";
            $query = $this->pdo->prepare($sql);
            $query->bindParam(':dni', $dni);
            $query->execute();
            
            // Si encuentra un registro, devuelve true; si no, false
            return $query->fetch() ? true : false;
        } catch (PDOException $e) {
            error_log("Error en UserModel::usuarioExiste -> " . $e->getMessage());
            return false;
        }
    }

    /**
     * Elimina un usuario por ID
     */
    public function eliminar($id) {
        try {
            $sql = "DELETE FROM usuarios WHERE id = :id";
            $query = $this->pdo->prepare($sql);
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            return $query->execute();
        } catch (PDOException $e) {
            error_log("Error en UserModel::eliminar -> " . $e->getMessage());
            return false;
        }
    }

    /**
     * Busca un usuario por ID para el proceso de edición
     */
    public function getById($id) {
        try {
            $sql = "SELECT id, dni, cod_asesor, id_rol FROM usuarios WHERE id = :id";
            $query = $this->pdo->prepare($sql);
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }

}