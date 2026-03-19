<?php

require_once "config/db.php";

header("Content-Type: application/json; charset=UTF-8");

$database = new Database();
$db = $database->getConnection();

if (!$db) {
    echo json_encode(["error" => "No se pudo conectar a la base de datos"]);
    exit;
}

try {

    $query = "SELECT id, nombre, email FROM usuarios";

    $stmt = $db->prepare($query);
    $stmt->execute();

    $usuarios = $stmt->fetchAll();

    echo json_encode([
        "status" => "ok",
        "total" => count($usuarios),
        "data" => $usuarios
    ]);

} catch (PDOException $e) {

    echo json_encode([
        "status" => "error",
        "mensaje" => $e->getMessage()
    ]);
}

?>