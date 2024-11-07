<?php
namespace Backend;
// Incluir la clase DataBase
require_once 'DataBase.php';

// Clase Products que hereda de DataBase
class Products extends DataBase {
    private $data = [];

    // Constructor de Products
    public function __construct($host, $user, $password, $dbName) {
        $config = ['host' => $host, 'user' => $user, 'password' => $password, 'dbName' => $dbName];
        parent::__construct($config);
    }   

    // Método para agregar un nuevo producto
    public function add($product) {
        $sql = "INSERT INTO productos (nombre, precio, unidades, modelo, marca, detalles) VALUES (?, ?, ?, ?, ?, ?)";
        $this->executeQuery($sql, [
            "sdisss" => [$product->name, $product->price, $product->units, $product->model, $product->brand, $product->details]
        ]);
    }
    

    // Método para eliminar un producto por su ID
    public function delete($productId) {
        $sql = "DELETE FROM productos WHERE id = ?";
        $this->executeQuery($sql, [
            "i" => [$productId] // El tipo "i" indica que el ID es un entero
        ]);
    }
    

    // Método para editar un producto
    public function edit($product) {
        $sql = "UPDATE productos SET name = ?, price = ?, description = ? WHERE id = ?";
        $this->executeQuery($sql, ["sssi" => [$product->name, $product->price, $product->description, $product->id]]);
    }

    // Método para listar todos los productos
    public function list() {
        $sql = "SELECT * FROM productos";
        $this->data = $this->executeQuery($sql);
    }

    // Método para buscar productos que coincidan con un término
    public function search($term) {
        $sql = "SELECT * FROM productos WHERE name LIKE ?";
        $this->data = $this->executeQuery($sql, ["s" => ["%$term%"]]);
    }

    // Método para obtener un solo producto por ID
    public function single($id) {
        $sql = "SELECT * FROM productos WHERE id = ?";
        $this->data = $this->executeQuery($sql, ["i" => [$id]]);
    }

    // Método para obtener un solo producto por nombre
    public function singleByName($name) {
        $sql = "SELECT * FROM productos WHERE name = ?";
        $this->data = $this->executeQuery($sql, ["s" => [$name]]);
    }

    // Método para convertir los datos en JSON
    public function getData() {
        return $this->data; // Asegúrate de que $this->response es un arreglo y no un JSON codificado
    }

    // Implementación del método de consulta genérico
    protected function executeQuery($sql, $params = []) {
        $stmt = $this->conexion->prepare($sql);

        // Vinculamos los parámetros si se proporcionan
        if (!empty($params)) {
            $types = implode('', array_keys($params));
            $values = array_values($params)[0];
            $stmt->bind_param($types, ...$values);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $data = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
        $stmt->close();

        return $data;
    }
}
?>
