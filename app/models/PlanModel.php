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

    public function getPlanes()
    {
        $sql = "SELECT p.id, p.nombre_plan, p.suma_asegurada, c.nombre as compania
                FROM planes p
                INNER JOIN companias c ON p.id_compania = c.id
                ORDER BY p.id DESC";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCompanias()
    {
        $sql = "SELECT id, nombre FROM companias";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getClinicas()
    {
        $sql = "SELECT id, nombre FROM clinicas";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function guardarPlanCompleto($data)
    {
        try {

            $this->db->beginTransaction();

            // =========================
            // 1. INSERT PLAN
            // =========================
            $sqlPlan = "INSERT INTO planes 
                (nombre_plan, suma_asegurada, nombre_url, id_compania)
                VALUES (:nombre, :suma, :url, :compania)";

            $stmt = $this->db->prepare($sqlPlan);

            $stmt->execute([
                ':nombre'   => $data['nombre_plan'],
                ':suma'     => $data['suma_asegurada'],
                ':url'      => $data['nombre_url'],
                ':compania' => $data['id_compania']
            ]);

            $idPlan = $this->db->lastInsertId();

            // =========================
            // 2. INSERT REDES
            // =========================
            if (!empty($data['red_nombre'])) {

                foreach ($data['red_nombre'] as $i => $nombreRed) {

                    $sqlRed = "INSERT INTO red_plan 
                        (id_planes, nombre, precio_ambula, precio_hospita)
                        VALUES (:plan, :nombre, :ambula, :hospita)";

                    $stmtRed = $this->db->prepare($sqlRed);

                    $stmtRed->execute([
                        ':plan'    => $idPlan,
                        ':nombre'  => $nombreRed,
                        ':ambula'  => $data['red_ambulatorio'][$i],
                        ':hospita' => $data['red_hospitalario'][$i]
                    ]);

                    $idRed = $this->db->lastInsertId();

                    // =========================
                    // 2.1 CLINICAS POR RED
                    // =========================
                    if (!empty($data['red_clinicas'][$i])) {

                        foreach ($data['red_clinicas'][$i] as $idClinica) {

                            $sqlClinica = "INSERT INTO red_plan_clinicas 
                                (id_red_plan, id_clinica)
                                VALUES (:red, :clinica)";

                            $stmtClinica = $this->db->prepare($sqlClinica);

                            $stmtClinica->execute([
                                ':red'      => $idRed,
                                ':clinica'  => $idClinica
                            ]);
                        }
                    }
                }
            }

            // =========================
            // 3. PRECIOS POR EDAD
            // =========================
            if (!empty($data['edad_inicio'])) {

                foreach ($data['edad_inicio'] as $i => $edadInicio) {

                    $sqlPrecio = "INSERT INTO plan_precios_edad
                        (id_plan, edad_inicio, edad_fin, precio)
                        VALUES (:plan, :inicio, :fin, :precio)";

                    $stmtPrecio = $this->db->prepare($sqlPrecio);

                    $stmtPrecio->execute([
                        ':plan'   => $idPlan,
                        ':inicio' => $edadInicio,
                        ':fin'    => $data['edad_fin'][$i],
                        ':precio' => $data['precio'][$i]
                    ]);
                }
            }

            // =========================
            // TODO OK
            // =========================
            $this->db->commit();

        } catch (Exception $e) {

            $this->db->rollBack();
            throw $e;
        }
    }

    public function eliminarPlan($id)
    {
        $this->db->beginTransaction();

        try {

            // Eliminar relaciones primero
            $this->db->prepare("DELETE FROM plan_precios_edad WHERE id_plan = ?")->execute([$id]);

            // Obtener redes
            $stmt = $this->db->prepare("SELECT id FROM red_plan WHERE id_planes = ?");
            $stmt->execute([$id]);
            $redes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($redes as $r) {
                $this->db->prepare("DELETE FROM red_plan_clinicas WHERE id_red_plan = ?")
                        ->execute([$r['id']]);
            }

            $this->db->prepare("DELETE FROM red_plan WHERE id_planes = ?")->execute([$id]);

            // Finalmente el plan
            $this->db->prepare("DELETE FROM planes WHERE id = ?")->execute([$id]);

            $this->db->commit();

        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
}