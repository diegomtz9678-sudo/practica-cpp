<?php
require_once "conexion2.php";

class operaciones_base_datos { //NOMBRE TEMPORAL
    private $pdo;

    public function __construct() {
        $conexion = new Conexion();
        $this->pdo = $conexion->obtenerConexion();
    }

    // CREATE
    public function crear($nombre, $apellidoPaterno, $apellidoMaterno) {
        $sql = "INSERT INTO alumnos (nombre, apellido_paterno, apellido_materno) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nombre, $apellidoPaterno, $apellidoMaterno]);
    }

    // READ
    public function listar() {
        $stmt = $this->pdo->query("SELECT id, nombre, apellido_paterno, apellido_materno FROM alumnos ORDER BY id");
        return $stmt->fetchAll();
    }

    public function obtener($id) {
        $stmt = $this->pdo->prepare("SELECT id, nombre, apellido_paterno, apellido_materno FROM alumnos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // UPDATE
    public function actualizar($id, $nombre, $apellidoPaterno, $apellidoMaterno) {
        $sql = "UPDATE alumnos SET nombre = ?, apellido_paterno = ?, apellido_materno = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nombre, $apellidoPaterno, $apellidoMaterno, $id]);
    }

    // DELETE
    public function eliminar($id) {
        $stmt = $this->pdo->prepare("DELETE FROM alumnos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    }
}