<?php
// Incluir el archivo de configuración de la base de datos
require_once 'db_config.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $user_id = $_GET['id'];

    try {
        // Preparar la sentencia SQL para eliminar el usuario
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        
        if ($stmt === false) {
            throw new Exception("Error al preparar la consulta de eliminación: " . $conn->error);
        }

        $stmt->bind_param("i", $user_id); // "i" para integer

        // Ejecutar la sentencia
        if ($stmt->execute()) {
            // Redirigir a la página de registros con un mensaje de éxito
            header("Location: ../registro.php?status=deleted");
            exit();
        } else {
            // Redirigir con mensaje de error si la ejecución falla
            error_log("Error al ejecutar la eliminación: " . $stmt->error);
            header("Location: ../registro.php?status=error_delete_execution");
            exit();
        }

        $stmt->close();
    } catch (Exception $e) {
        // Capturar y logear cualquier excepción durante el proceso
        error_log("Excepción al eliminar registro: " . $e->getMessage());
        header("Location: ../registro.php?status=error_delete_exception");
        exit();
    }
} else {
    // Si no se proporciona un ID, redirigir con un mensaje de error
    header("Location: ../registro.php?status=id_not_provided");
    exit();
}

$conn->close();
?> 