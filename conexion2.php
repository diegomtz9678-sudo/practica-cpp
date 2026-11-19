<?php

class Conexion {
    private $servidor = "localhost";
    private $usuario = "root";
    private $password;
    private $basedatos = "prueba";
    private $conexion;

    public function __construct() {
        // Lee la contraseña de la variable de entorno DB_PASSWORD.
        // Si no existe, usa cadena vacía (valor típico de XAMPP).
        $this->password = getenv("DB_PASSWORD") ?: "";

        try {
            $dsn = "mysql:host={$this->servidor};dbname={$this->basedatos};charset=utf8mb4";
            $this->conexion = new PDO($dsn, $this->usuario, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            throw new RuntimeException("Falla de conexión: " . $e->getMessage());
        }
    }

    // Devuelve el objeto PDO para usarlo en otras partes del proyecto
    public function obtenerConexion() {
        return $this->conexion;
    }

    // Cierra la conexión con la base de datos
    public function cerrar() {
        $this->conexion = null;
    }
}