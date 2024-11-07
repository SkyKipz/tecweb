<?php
namespace Backend;

abstract class DataBase {
    protected $conexion;

    public function __construct($config) {
        $this->conexion = $this->connect($config);
    }

    private function connect($config) {
        // Usa \mysqli para referenciar la clase global de PHP y evitar conflictos de espacio de nombres
        $conexion = new \mysqli($config['host'], $config['user'], $config['password'], $config['dbName']);

        if ($conexion->connect_error) {
            die("Error de conexión a la base de datos: " . $conexion->connect_error);
        }
        return $conexion;
    }

    abstract protected function executeQuery($sql, $params = []);
}
?>
